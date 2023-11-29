<?php

namespace App\Http\Livewire\Calibrations;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Calibration extends Component
{
    public $procurementType, $priorityNo, $description, $price, $package, $quant,
        $objectTypeId, $reason, $deptId, $budget, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;

    protected $listeners = ['deleteConfirmed'];

    public $EQUP_ID, $EQUP_NAME, $EQUP_CAT_ID, $EQUP_TYPE_ID, $EQUP_SEQ, $TCHN_LOCAT_ID, $EQUP_STS_ID, $PRODCT_CAT_ID, $PROC_ID, $EQUP_PRICE, $EQUP_LINK_NO, $EQUP_STS_DESC;
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
                'urls' => 'calibration'
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
                'urls' => 'calibration'
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
            $procurements = DB::table('procurements')->where('objectTypeId', '26')->where('enable', '1')->get();
            foreach ($procurements as $procurement) {
                $id = $procurement->id;

                if ($procurement->levelNo == 1 && $procurement->approved == null) {
                    $newApproved = '1';

                    DB::table('procurements')
                        ->where('id', $id)
                        ->update([
                            'approved' => $newApproved,
                            'approved_at' => now(),
                            'approved_userId' => Auth::user()->id
                        ]);
                }
                if ($procurement->levelNo == 2 && $procurement->approved == 1) {
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
                'urls' => 'calibration'
            ]);
            session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        } catch (\Exception $e) {
            session()->flash('error', "ไม่สามารถลบข้อมูลได้!!");
        }
    }

    public function render()
    {
        $procurement_object = DB::table('procurement_object')->where('procurementCode', 26)->get();
        $procurements_detail = DB::table('procurements_detail')->get();
        $vwCountDetail = DB::table('vwCountDetail')->where('used', 1)->get();

        $VW_NEW_MAINPLAN = DB::table('VW_NEW_MAINPLAN')
            ->where('objectTypeId', '26')
            ->where('enable', '1')
            ->when(Auth::user()->id == '114000041', function ($query) {
                return $query->orderBy('approved', 'asc')->orderByDesc('updated_at');
            }, function ($query) {
                return $query->orderByDesc('updated_at');
            })
            ->get();

        $index = 1; // กำหนดค่าเริ่มต้นของอันดับ

        foreach ($VW_NEW_MAINPLAN as $item) {
            $item->index = $index++; // เพิ่มคอลัมน์ index และเพิ่มค่าอันดับ
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

        return view('livewire.calibration.calibration', [
            'procurements_detail' => $procurements_detail,
            'years' => $years,
            //ค้นหาปี
            'objectName' => $objectName,
            //ค้นหาประเภท
            'deptName' => $deptName,
            //ค้นหาหน่วยงานที่เบิก
            'VW_NEW_MAINPLAN' => $VW_NEW_MAINPLAN, //ดึงตาราง VW_Maintenance
            'procurement_object' => $procurement_object,
            'vwCountDetail' => $vwCountDetail,
            'close_plan' => $close_plan,
        ]);
    }
}
