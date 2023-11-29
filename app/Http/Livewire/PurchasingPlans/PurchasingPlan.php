<?php

namespace App\Http\Livewire\PurchasingPlans;


use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithPagination;

class PurchasingPlan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteConfirmed'];

    public $BGS_ID, $request_type, $description, $price, $unit, $qty, $reason, $deptId, $year, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;
    public $EQUP_ID, $EQUP_NAME, $EQUP_CAT_ID, $EQUP_TYPE_ID, $EQUP_SEQ, $TCHN_LOCAT_ID, $EQUP_STS_ID, $PRODCT_CAT_ID, $PROC_ID, $EQUP_PRICE, $EQUP_LINK_NO, $EQUP_STS_DESC;

    public function mount()
    {
        if (Auth::user()->id == '114000041') {
            $replace_increase_equip = DB::table('replace_increase_equip')->where('enable', '1')->get();
            foreach ($replace_increase_equip as $item) {
                $id = $item->id;

                if ($item->levelNo == 1 && $item->approved == null) {
                    $newApproved = '1';

                    DB::table('replace_increase_equip')
                        ->where('id', $id)
                        ->update([
                            'approved' => $newApproved,
                            'approved_at' => now(),
                            'approved_userId' => Auth::user()->id
                        ]);
                }
                if ($item->levelNo == 2 && $item->approved == 1) {
                    $newApproved = '0';

                    DB::table('replace_increase_equip')
                        ->where('id', $id)
                        ->update([
                            'approved' => $newApproved,
                            'approved_at' => now(),
                            'approved_userId' => Auth::user()->id
                        ]);
                }
            }
        };
    }
    public function close_plan()
    {
        $query = DB::table('close_plan')->where('id', 1)->first();

        if ($query->status == 'on') {
            $close_plan = 'off';
        } else {
            $close_plan = 'on';
        }

        DB::table('close_plan')
            ->where('id', 1)
            ->update([
                'status' => $close_plan
            ]);
    }
    public function Approval($id)
    {
        $query = DB::table('replace_increase_equip')->where('id', $id)->first();

        if ($query->approved == '0') {
            $newApproved = '1';
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'อนุมัติแล้ว!!',
                'urls' => 'replaceIncrease_equip'
            ]);
            DB::table('replace_increase_equip')
                ->where('id', $id)
                ->update([
                    'approved' => $newApproved,
                    'approved_at' => now(),
                    'approved_userId' => Auth::user()->id
                ]);
        } else {
            $newApproved = '0';
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'ไม่อนุมัติ!!',
                'urls' => 'replaceIncrease_equip'
            ]);

            DB::table('replace_increase_equip')
                ->where('id', $id)
                ->update([
                    'approved' => $newApproved,
                    'approved_at' => now(),
                    'approved_userId' => Auth::user()->id
                ]);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////
    // ลบข้อมูล
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
            DB::table('replace_increase_equip')
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
                'urls' => 'replaceIncrease_equip'
            ]);
            session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        } catch (\Exception $e) {
            session()->flash('error', "ไม่สามารถลบข้อมูลได้!!");
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////
    public function render()
    {

        $close_plan = DB::table('close_plan')->where('id', 1)->get();
        $vwCountDetail = DB::table('vwCountReplaceEquipDetail')->where('used', 1)->get();
        $replace_equip_detail = DB::table('vwShowReplaceEquipDetail')->get();

        $replace_increase_equip = DB::table('vwReplaceEquip')
            ->where('enable', '1')
            ->when(Auth::user()->id == '114000041', function ($query) {
                return $query->orderBy('approved', 'asc')->orderByDesc('updated_at');
            }, function ($query) {
                return $query->orderByDesc('updated_at');
            })
            ->get();
        foreach ($replace_increase_equip as $item) {
            $carbonUpdatedAt = Carbon::parse($item->updated_at); // แปลงเป็น Carbon object
            $item->updated_at = $carbonUpdatedAt->addYears(543)->format('d/m/Y H:i'); // แปลงวันที่เป็นรูปแบบพศไทย
        }
        return view('livewire.purchasingPlan.purchasing-plan', [
            'replace_increase_equip' => $replace_increase_equip,
            'close_plan' => $close_plan,
            'vwCountDetail' => $vwCountDetail,
            'replace_equip_detail' => $replace_equip_detail,
        ]);
    }
}
