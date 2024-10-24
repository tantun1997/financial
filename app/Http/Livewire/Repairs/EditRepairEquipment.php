<?php

namespace App\Http\Livewire\Repairs;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class EditRepairEquipment extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $Plan_DATE,
        $Plan_YEAR,
        $Plan_TYPE_ID,
        $Plan_TYPE_NAME,
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


    public $Equip_CURRENT_PRICE,
        $Equip_NAME,
        $Equip_AMOUNT,
        $Equip_STATUS_DATE,
        $Equip_STATUS;

    public function mount()
    {
        $this->Plan_DEPTID = Auth::user()->deptId;
        $this->Plan_USERID = Auth::user()->id;
        $this->Plan_ID = request('id');
    }

    public function CheckedEquip($id)
    {
        // ดึงค่าปัจจุบันของ 'Equip_USED'
        $currentValue = DB::table('EQUIPMENT_LIST')
            ->where('Equip_ID', $id)
            ->value('Equip_USED');

        // สลับค่าระหว่าง 1 และ 0
        $newValue = $currentValue == 1 ? 0 : 1;

        // อัปเดตค่าใหม่ของ 'Equip_USED'
        DB::table('EQUIPMENT_LIST')
            ->where('Equip_ID', $id)
            ->update([
                'Equip_USED' => $newValue
            ]);

        $this->dispatchBrowserEvent('CheckedEquip', [
            'refresh' => true // จะเรียกใช้งานโหลดหน้าใหม่หลังจากการปิด alert
        ]);
    }

    public $edit_equip = false;
    public $Equip_ID;

    public function edit_equip($id)
    {
        $this->edit_equip = true;
        $this->Equip_ID = $id;
        // dd($this->Equip_ID);
        $data_equip = DB::table('EQUIPMENT_LIST')->where('Equip_ID',  $id)->first();
        if ($data_equip) {
            $this->Equip_CURRENT_PRICE = $data_equip->Equip_CURRENT_PRICE;
            $this->Equip_NAME = $data_equip->Equip_NAME;
            $this->Equip_AMOUNT = $data_equip->Equip_AMOUNT;
            $this->Equip_STATUS = $data_equip->Equip_STATUS;
        }
    }
    public function save_equip()
    {
        $oldEquipStatus = DB::table('EQUIPMENT_LIST')
            ->where('Equip_ID', $this->Equip_ID)
            ->value('Equip_STATUS');

        $this->Equip_STATUS_DATE = DB::table('EQUIPMENT_LIST')
            ->where('Equip_ID', $this->Equip_ID)
            ->value('Equip_STATUS_DATE');

        DB::table('EQUIPMENT_LIST')->where('Equip_ID',  $this->Equip_ID)->update([
            'Equip_CURRENT_PRICE' => $this->Equip_CURRENT_PRICE,
            'Equip_NAME' => $this->Equip_NAME,
            'Equip_AMOUNT' => $this->Equip_AMOUNT,
            'Equip_STATUS' => $this->Equip_STATUS,
            'Equip_STATUS_DATE' => ($this->Equip_STATUS == $oldEquipStatus) ? $this->Equip_STATUS_DATE : now()->format('Y-m-d H:i:s'),
        ]);

        $this->edit_equip = false;

        // ส่งอีเวนต์ alert ประเภท success
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'บันทึกสำเร็จ!! รหัสแผนงาน: ' . $this->Plan_ID,
            'id' => $this->Plan_ID, // เพิ่ม Plan_ID ไปยังอีเวนต์
            // 'refresh' => true // จะเรียกใช้งานโหลดหน้าใหม่หลังจากการปิด alert
        ]);
    }

    public $edit_plan = false;
    public function edit_plan()
    {
        $this->edit_plan = true;

        $data_plan = DB::table('EQUIPMENT_PLAN')->where('Plan_ID',  $this->Plan_ID)->first();
        if ($data_plan) {
            $this->Plan_DATE = $data_plan->Plan_DATE;
            $this->Plan_YEAR = $data_plan->Plan_YEAR;
            $this->Plan_TYPE_ID = $data_plan->Plan_TYPE_ID;
            $this->Plan_NAME = $data_plan->Plan_NAME;
            $this->Plan_PRICE_OVERALL = $data_plan->Plan_PRICE_OVERALL;
            $this->Plan_AMOUNT = $data_plan->Plan_AMOUNT;
            $this->Plan_REASON = $data_plan->Plan_REASON;
            $this->Plan_REMARK = $data_plan->Plan_REMARK;
            $this->Plan_DEPTID = $data_plan->Plan_DEPTID;
            $this->Plan_USERID = $data_plan->Plan_USERID;
            $this->Plan_LEVEL = $data_plan->Plan_LEVEL;
            $this->Plan_BUDGET = $data_plan->Plan_BUDGET;
        }
    }
    public $show_equip = false;
    public function show_equip()
    {
        $this->show_equip = true;
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

    public function save_plan()
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

        DB::table('EQUIPMENT_PLAN')
            ->where('Plan_ID',  $this->Plan_ID)
            ->update([
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
                'Plan_LEVEL' => $this->Plan_LEVEL, 'Plan_BUDGET' => $this->Plan_BUDGET,

                // 'Plan_ENABLE' => $this->Plan_ENABLE,
            ]);
        $this->edit_plan = false;

        $alertType = ''; // เก็บประเภทของ alert ที่จะส่ง

        // ตรวจสอบค่าของ Plan_TYPE_ID และกำหนดประเภทของ alert
        if ($this->Plan_TYPE_ID == 1) {
            $alertType = 'alert_maintenance_equip';
        } elseif (in_array($this->Plan_TYPE_ID, [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14])) {
            $alertType = 'alert_repair_equip';
        } elseif (in_array($this->Plan_TYPE_ID, [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25])) {
            $alertType = 'alert_contract_services';
        } elseif ($this->Plan_TYPE_ID == 26) {
            $alertType = 'alert_calibration';
        } elseif ($this->Plan_TYPE_ID == 27) {
            $alertType = 'alert_potential_plan';
        } elseif ($this->Plan_TYPE_ID == 28) {
            $alertType = 'alert_replacement_plan';
        } elseif ($this->Plan_TYPE_ID == 29) {
            $alertType = 'alert_noserial_plan';
        }

        // ส่งอีเวนต์ alert ตามประเภทที่กำหนด
        $this->dispatchBrowserEvent($alertType, [
            'type' => 'success',
            'message' => 'บันทึกสำเร็จ!! รหัสแผนงาน: ' . $this->Plan_ID,
            'id' => $this->Plan_ID,
            'refresh' => true // จะเรียกใช้งานโหลดหน้าใหม่หลังจากการปิด alert

        ]);
    }

    public function selectRow($EQUP_LINK_NO)
    {

        $VW_EQUIPMENT = DB::table('VW_EQUIPMENT')
            ->select(['EQUP_LINK_NO', 'EQUP_ID', 'EQUP_NAME', 'EQUP_PRICE', 'TCHN_LOCAT_NAME', 'TCHN_LOCAT_ID', 'EQUP_STS_ID', 'EQUP_STS_DESC', 'age'])
            ->where('EQUP_LINK_NO', $EQUP_LINK_NO)
            ->first();

        DB::table('EQUIPMENT_LIST')->insert([
            'Equip_SERIAL_NUMBER' => $VW_EQUIPMENT->EQUP_ID,
            'Equip_NAME' => $VW_EQUIPMENT->EQUP_NAME,
            'Equip_TCHN_LOCAT_ID' => $VW_EQUIPMENT->TCHN_LOCAT_ID,
            'Equip_STS_ID' => $VW_EQUIPMENT->EQUP_STS_ID,
            'Equip_PRICE' => $VW_EQUIPMENT->EQUP_PRICE,
            'Equip_LINK_NO' => $VW_EQUIPMENT->EQUP_LINK_NO,
            'Equip_USED' => 0,
            'Plan_ID' => $this->Plan_ID,
            'Equip_AMOUNT' => 1,
            'Equip_STATUS' => 0,
            'Equip_STATUS_DATE' => now()->format('Y-m-d H:i:s'),
            'Equip_CREATED_DATE' => now()->format('Y-m-d H:i:s'),
            'Equip_AGE' => $VW_EQUIPMENT->age,
        ]);
        $this->dispatchBrowserEvent(
            'alert_select',
            ['type' => 'success', 'message' => 'เพิ่มเรียบร้อย!!']
        );
    }

    public function deleteRow($id)
    {
        DB::table('EQUIPMENT_LIST')
            ->where('Equip_ID', $id)
            ->delete();

        $this->dispatchBrowserEvent(
            'alert_delete',
            ['type' => 'error', 'message' => 'ลบเรียบร้อย!!']
        );
    }

    public $search_EQUIP;
    public $showTable = false;

    public function render()
    {
        $VW_EQUIPMENT = null;
        $EQUIPMENT_LIST = null;

        if ($this->search_EQUIP) {
            $this->showTable = true;
            $VW_EQUIPMENT = DB::table('VW_EQUIPMENT')
                ->select(['EQUP_LINK_NO', 'EQUP_ID', 'EQUP_NAME', 'EQUP_PRICE', 'TCHN_LOCAT_NAME', 'TCHN_LOCAT_ID', 'EQUP_STS_ID', 'EQUP_STS_DESC', 'age'])
                ->where('EQUP_NAME', 'like', '%' . $this->search_EQUIP . '%')
                ->orWhere('EQUP_ID', 'like', '%' . $this->search_EQUIP . '%')
                ->orderBy('EQUP_ID', 'asc')
                ->paginate(5, ['*'], 'VW_EQUIPMENT_page');
        } else {
            $this->showTable = false;
        }

        if ($this->Plan_ID) {
            $EQUIPMENT_LIST = DB::table('รายการครุภัณฑ์ทั้งหมด')
                ->where('Plan_ID', $this->Plan_ID)
                ->orderBy('Equip_ID', 'asc')
                ->paginate(10, ['*'], 'EQUIPMENT_LIST_page');
        }

        $EQUIPMENT_TYPE = DB::table('EQUIPMENT_TYPE')->get();

        $EQUIPMENT_PLAN = DB::table('แผนทั้งหมด')->where('Plan_ID', $this->Plan_ID)->first();

        $EQUIPMENT_STATUS = DB::table('EQUIPMENT_STATUS')->get();
        $DimBudget = DB::table('DimBudget')->get();

        return view('livewire.repair.edit', [
            'EQUIPMENT_TYPE' => $EQUIPMENT_TYPE,
            'EQUIPMENT_PLAN' => $EQUIPMENT_PLAN,
            'EQUIPMENT_LIST' => $EQUIPMENT_LIST,
            'EQUIPMENT_STATUS' => $EQUIPMENT_STATUS,
            'VW_EQUIPMENT' => $VW_EQUIPMENT,
            'DimBudget' => $DimBudget

        ]);
    }

    public function updatedSearch_EQUIP()
    {
        $this->resetPage('VW_EQUIPMENT_page');
    }

    public function updatedPlan_ID()
    {
        $this->resetPage('EQUIPMENT_LIST_page');
    }
}
