<?php

namespace App\Http\Livewire\Maintenances;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CreateMaintenancePlan extends Component
{
    public $procurementType, $priorityNo, $description, $price, $package, $quant,
        $objectTypeId, $reason, $deptId, $budget, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;

    public function updateFieldsFromDescription()
    {
        $selectedPlan = DB::table('VW_NEW_MAINPLAN')->where('Description', trim($this->description))->first();

        if ($selectedPlan) {
            $this->price = $selectedPlan->price;
            $this->quant = $selectedPlan->quant;
            $this->package = $selectedPlan->package;
            $this->reason = $selectedPlan->reason;
            $this->remark = $selectedPlan->remark;
            $this->objectTypeId = $selectedPlan->objectTypeId;
            $this->priorityNo = $selectedPlan->priorityNo;
        }
    }



    public function mount()
    {
        $this->userId = Auth::user()->id;
        $this->deptId = Auth::user()->deptId;
        $this->budget = Carbon::now()->addYear()->addYears(543)->format('Y');
        $this->priorityNo = '001';
        $this->quant = '1';
        $this->procurementType = '1';
        $this->enable = '1';
        $this->objectTypeId = '1';
        $this->created_at = now();
        $this->updated_at = now();
    }


    public function addMaintenence()
    {
        $validatedData = $this->validate([
            'budget' => 'required',
            'priorityNo' => 'required|numeric',
            'description' => 'required',
            'price' => 'required|numeric',
            'package' => 'required|regex:/^[^0-9]*$/',
            'quant' => 'required|numeric|min:1',
            'objectTypeId' => 'required',
            'reason' => 'required',
            'deptId' => 'required',
            'remark' => 'nullable|max:250',
            'levelNo' => 'required',
            'procurementType' => 'required',
            'userId' => 'required',
            'enable' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required'
        ]);

        DB::table('procurements')->insert($validatedData);

        session()->flash('success', 'เพิ่มข้อมูลสำเร็จ!!');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'เพิ่มข้อมูลสำเร็จ!!',
            'text' => 'ข้อมูลถูกเพิ่มในตารางเรียบร้อยแล้ว',
            'urls' => '/maintenance_equip'
        ]);
    }


    public function render()
    {

        $VW_NEW_MAINPLAN = DB::table('VW_NEW_MAINPLAN')
            ->where('objectTypeId', '01')
            ->where('enable', '1')
            ->get();

        $procurement_object_create = DB::table('procurement_object')->where('procurementTypeId', 1)->where('procurementCode', '01')
            ->get();
        return view('livewire.maintenance.create', [
            'VW_NEW_MAINPLAN' => $VW_NEW_MAINPLAN,
            'procurement_object' => $procurement_object_create
        ]);
    }
}
