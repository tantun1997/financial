<?php

namespace App\Http\Livewire\POutsidewarehouse;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatePOutsidewarehouse extends Component
{
    public $Plan_DATE,
        $Plan_YEAR,
        $Plan_TYPE_ID,
        $Plan_NAME,
        $Plan_PRICE_OVERALL,
        $Plan_AMOUNT,
        $Plan_REASON,
        $Plan_REMARK,
        $Plan_DEPTID,
        $Plan_USERID,
        $Plan_LEVEL,
        $Plan_ENABLE,
        $Plan_ID,
        $Plan_BUDGET;


    public function mount()
    {
        $this->Plan_DATE = now()->format('Y-m-d H:i:s');
        $this->Plan_DEPTID = Auth::user()->deptId;
        $this->Plan_USERID = Auth::user()->id;
    }
    protected $rules = [
        'Plan_YEAR' => 'required',
        'Plan_TYPE_ID' => 'required',
        'Plan_NAME' => 'required',
        'Plan_PRICE_OVERALL' => 'required',
        'Plan_AMOUNT' => 'required',
        'Plan_REASON' => 'required',
        'Plan_LEVEL' => 'required',
    ];
    public function clearInputs()
    {
        $this->Plan_DATE = null;
        $this->Plan_YEAR = null;
        $this->Plan_TYPE_ID = null;
        $this->Plan_NAME = null;
        $this->Plan_PRICE_OVERALL = null;
        $this->Plan_AMOUNT = null;
        $this->Plan_REASON = null;
        $this->Plan_REMARK = null;
        $this->Plan_DEPTID = null;
        $this->Plan_USERID = null;
        $this->Plan_LEVEL = null;
        $this->Plan_ENABLE = null;
        $this->Plan_BUDGET = null;
    }

    public function save()
    {
        // ตรวจสอบว่าข้อมูลถูกต้องหรือไม่
        if (
            empty($this->Plan_YEAR) || empty($this->Plan_TYPE_ID) || empty($this->Plan_NAME) || empty($this->Plan_PRICE_OVERALL)
            || empty($this->Plan_AMOUNT) || empty($this->Plan_REASON) || empty($this->Plan_LEVEL)
        ) {
            // ถ้าข้อมูลไม่ครบ ส่งอีเวนต์ alert ประเภท error
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error', 'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน!']
            );
            $this->validate();

            return;
        }

        $this->Plan_ID = DB::table('EQUIPMENT_PLAN')->insertGetId([
            'Plan_DATE' => $this->Plan_DATE,
            'Plan_YEAR' => $this->Plan_YEAR,
            'Plan_TYPE_ID' => $this->Plan_TYPE_ID,
            'Plan_NAME' => $this->Plan_NAME,
            'Plan_PRICE_OVERALL' => $this->Plan_PRICE_OVERALL,
            'Plan_AMOUNT' => $this->Plan_AMOUNT,
            'Plan_REASON' => $this->Plan_REASON,
            'Plan_REMARK' => $this->Plan_REMARK,
            'Plan_DEPTID' => $this->Plan_DEPTID,
            'Plan_USERID' => $this->Plan_USERID,
            'Plan_LEVEL' => $this->Plan_LEVEL,
            'Plan_ENABLE' => 1,
            'Plan_BUDGET' => $this->Plan_BUDGET,

        ]);
        $this->clearInputs(); // เรียกใช้ฟังก์ชันเพื่อเคลียร์ข้อมูลใน input

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'บันทึกสำเร็จ!! รหัสแผนงาน: ' . $this->Plan_ID,
            'id' => $this->Plan_ID, // เพิ่ม Plan_ID ไปยังอีเวนต์
            'refresh' => true // จะเรียกใช้งานโหลดหน้าใหม่หลังจากการปิด alert
        ]);
    }
    public function render()
    {
        $EQUIPMENT_TYPE = DB::table('EQUIPMENT_TYPE')->where('TYPE_ID', 30)->get();
        $DimBudget = DB::table('DimBudget')->get();

        return view(
            'livewire.POutsidewarehouse.create',
            [
                'EQUIPMENT_TYPE' => $EQUIPMENT_TYPE,
                'DimBudget' => $DimBudget

            ]
        );
    }
}
