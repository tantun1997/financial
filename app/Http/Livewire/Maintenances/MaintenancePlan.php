<?php

namespace App\Http\Livewire\Maintenances;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class MaintenancePlan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteConfirmed'];

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
        $query = DB::table('procurements')->where('id', $id)->first();

        if ($query->approved == '0') {
            $newApproved = '1';
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'อนุมัติแล้ว!!',
                'urls' => 'maintenance_equip'
            ]);
            DB::table('procurements')
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
                'urls' => 'maintenance_equip'
            ]);

            DB::table('procurements')
                ->where('id', $id)
                ->update([
                    'approved' => $newApproved,
                    'approved_at' => now(),
                    'approved_userId' => Auth::user()->id
                ]);
        }
    }


    public function mount()
    {
        if (Auth::user()->id == '114000041') {
            $procurements = DB::table('procurements')->where('objectTypeId', '01')
                ->where('enable', '1')->get();
            foreach ($procurements as $procurement) {
                $id = $procurement->id;
                $vwCountDetail = DB::table('vwCountDetail')
                    ->select('count_detail')
                    ->where('PROC_ID', $id)
                    ->where('used', 1)
                    ->value('count_detail');
                if ($procurement->levelNo == 1 && $vwCountDetail > 0 && $procurement->approved == null) {
                    $newApproved = '1';

                    DB::table('procurements')
                        ->where('id', $id)
                        ->update([
                            'approved' => $newApproved,
                            'approved_at' => now(),
                            'approved_userId' => Auth::user()->id
                        ]);
                }

                if ($procurement->levelNo == 1 && $vwCountDetail == null && $procurement->approved == 1) {
                    $newApproved = '0';

                    DB::table('procurements')
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
                'urls' => 'maintenance_equip'
            ]);
            session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        } catch (\Exception $e) {
            session()->flash('error', "ไม่สามารถลบข้อมูลได้!!");
        }
    }


    public function render()
    {


        $vwCountDetail = DB::table('vwCountDetail')->where('used', 1)->get();


        $VW_NEW_MAINPLAN = DB::table('VW_NEW_MAINPLAN')
            ->where('objectTypeId', '01')
            ->where('enable', '1')
            ->when(Auth::user()->id == '114000041', function ($query) {
                return $query->orderBy('approved', 'desc')->orderBy('levelNo', 'asc')->orderByDesc('updated_at');
            }, function ($query) {
                return $query->orderBy('updated_at', 'desc');
            })
            ->get();


        foreach ($VW_NEW_MAINPLAN as $item) {
            $carbonUpdatedAt = Carbon::parse($item->updated_at); // แปลงเป็น Carbon object
            $item->updated_at = $carbonUpdatedAt->addYears(543)->format('d/m/Y H:i'); // แปลงวันที่เป็นรูปแบบพศไทย
        }

        $years = $VW_NEW_MAINPLAN->pluck('budget')->unique()->map(function ($item) {
            return trim($item);
        })->all();

        $deptName = $VW_NEW_MAINPLAN->pluck('TCHN_LOCAT_NAME')->unique()->map(function ($item) {
            return trim($item);
        })->all();
        $objectName = $VW_NEW_MAINPLAN->pluck('objectName')->unique()->map(function ($item) {
            return trim($item);
        })->all();

        $close_plan = DB::table('close_plan')->where('id', 1)->get();

        return view('livewire.maintenance.maintenance-plan', [
            'years' => $years,
            'objectName' => $objectName,
            'deptName' => $deptName,
            'VW_NEW_MAINPLAN' => $VW_NEW_MAINPLAN,
            'vwCountDetail' => $vwCountDetail,
            'close_plan' => $close_plan,
        ]);
    }
}
