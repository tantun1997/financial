<?php

namespace App\Http\Livewire\Calibrations;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Calibration extends Component
{
    protected $listeners = ['deleteConfirmed'];
    public function approved($id)
    {
        DB::table('EQUIPMENT_PLAN')
            ->where('Plan_ID', $id)
            ->update([
                'Plan_ENABLE' => '2',
            ]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'อนุมัติแล้ว!!',
            'urls' => 'calibration'
        ]);
    }
    public function disapproved($id)
    {
        DB::table('EQUIPMENT_PLAN')
            ->where('Plan_ID', $id)
            ->update([
                'Plan_ENABLE' => '3',
            ]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'ไม่อนุมัติ!!',
            'urls' => 'calibration'
        ]);
    }
    public function requset_approved($id)
    {
        DB::table('EQUIPMENT_PLAN')
            ->where('Plan_ID', $id)
            ->update([
                'Plan_REQUEST_APPROVAL' => '1',
            ]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'ส่งขออนุมัติแล้ว!!',
            'urls' => 'calibration'
        ]);
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
        DB::table('EQUIPMENT_PLAN')
            ->where('Plan_ID', $id)
            ->update([
                'Plan_ENABLE' => '0',
            ]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'ลบข้อมูลสำเร็จ!',
            'text' => 'ข้อมูลหายไปจากตารางเรียบร้อยแล้ว',
            'urls' => 'calibration'
        ]);
    }


    public function render()
    {
        if (Auth::user()->isAdmin == 'Y') {
            $EQUIPMENT_PLAN = DB::table('แผนสอบเทียบเครื่องมือ')
                ->whereIn('Plan_ENABLE', [1, 2, 3])
                ->orderBy('Plan_ID', 'desc')
                ->get();
        } else {
            $EQUIPMENT_PLAN = DB::table('แผนสอบเทียบเครื่องมือ')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->whereIn('Plan_ENABLE', [1, 2, 3])
                ->orderBy('Plan_ID', 'desc')
                ->get();
        }
        $Plan_ID = $EQUIPMENT_PLAN->pluck('Plan_ID')
            ->filter(function ($value) {
                return !empty($value);
            })
            ->unique()
            ->map(function ($item) {
                return trim($item);
            })
            ->all();
        $Plan_NAME = $EQUIPMENT_PLAN->pluck('Plan_NAME')
            ->filter(function ($value) {
                return !empty($value);
            })
            ->unique()
            ->map(function ($item) {
                return trim($item);
            })
            ->all();
        $TCHN_LOCAT_NAME = $EQUIPMENT_PLAN->pluck('TCHN_LOCAT_NAME')
            ->filter(function ($value) {
                return !empty($value);
            })
            ->unique()
            ->map(function ($item) {
                return trim($item);
            })
            ->all();

        $close_plan = DB::table('close_plan')->where('id', 1)->get();
        return view('livewire.calibration.calibration', [
            'EQUIPMENT_PLAN' => $EQUIPMENT_PLAN,
            'Plan_ID' => $Plan_ID,
            'Plan_NAME' => $Plan_NAME,
            'TCHN_LOCAT_NAME' => $TCHN_LOCAT_NAME,
            'close_plan' => $close_plan,
        ]);
    }
}
