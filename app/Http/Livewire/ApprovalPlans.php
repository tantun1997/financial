<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ApprovalPlans extends Component
{
    public $description, $price, $package, $quant, $edit_id;

    protected $listeners = ['deleteConfirmed'];

    public function deletePost($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'คุณแน่ใจลบใช่ไหม?',
            'text' => 'หากถูกลบ คุณจะไม่สามารถกู้คืนไฟล์นี้ได้!',
            'id' => $id, // ส่งค่า $id ไปเพื่อใช้ใน JavaScript
        ]);
    }
    public function deleteConfirmed($id)
    {
        try {
            DB::table('procurements')
                ->where('id', $id)
                ->update([
                    'enable' => '0',
                    'deleted_at' => now(),
                    'deleted_userId' => Auth::user()->id
                ]);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'ลบข้อมูลสำเร็จ!',
                'text' => 'ข้อมูลหายไปจากตารางเรียบร้อยแล้ว',
                'urls' => 'approval_plans'
            ]);
            session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        } catch (\Exception $e) {
            session()->flash('error', "ไม่สามารถลบข้อมูลได้!!");
        }
    }


    public function Approval($id)
    {
        $query = DB::table('procurements')->where('id', $id)->first();

        if ($query->approved == '0' || $query->approved === null) {
            $newApproved = '1';
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'อนุมัติแล้ว!!',
                'urls' => 'approval_plans'
            ]);
        } else {
            $newApproved = '0';
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'ไม่อนุมัติ!!',
                'urls' => 'approval_plans'
            ]);
        }

        DB::table('procurements')
            ->where('id', $id)
            ->update([
                'approved' => $newApproved,
                'approved_at' => now(),
                'approved_userId' => Auth::user()->id
            ]);
    }


    public function deleteRow($id)
    {
        DB::table('procurements_detail')
            ->where('id', $id)
            ->delete();

        session()->flash('success', "ลบข้อมูลสำเร็จ!!");
    }

    public function closeModal()
    {
        $this->resetErrorBag(); // ใส่บรรทัดนี้เพื่อเคลียร์ข้อผิดพลาดที่เกี่ยวข้อง

        return redirect(route('approval_plans'));
    }

    public function add_detail($id)
    {
        $data = DB::table('procurements')->where('id', $id)->first();
        $this->description = $data->description;
        $this->price = $data->price;
        $this->package = $data->package;
        $this->quant = $data->quant;
        $this->edit_id = $id;
    }

    public function render()
    {
        $procurements_detail = DB::table('procurements_detail')->select(['id', 'PROC_ID', 'EQUP_ID', 'EQUP_NAME', 'EQUP_PRICE', 'EQUP_STS_DESC'])->get();

        $vwCountDetail = DB::table('vwCountDetail')->get();

        $VW_NEW_MAINPLAN = DB::table('VW_NEW_MAINPLAN')
            ->where('approved', '1')
            ->where('enable', '1')
            ->orderByDesc('approved_at')
            ->get();
        foreach ($VW_NEW_MAINPLAN as $item) {
            $carbonUpdatedAt = Carbon::parse($item->updated_at); // แปลงเป็น Carbon object
            $item->updated_at = $carbonUpdatedAt->addYears(543)->format('d/m/Y H:i'); // แปลงวันที่เป็นรูปแบบพศไทย
        }
        return view('livewire.approval-plans', [
            'procurements_detail' => $procurements_detail,
            'VW_NEW_MAINPLAN' => $VW_NEW_MAINPLAN,
            'vwCountDetail' => $vwCountDetail

        ]);
    }
}