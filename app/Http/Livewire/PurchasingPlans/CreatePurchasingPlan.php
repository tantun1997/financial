<?php

namespace App\Http\Livewire\PurchasingPlans;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithPagination;


class CreatePurchasingPlan extends Component
{
    public $BGS_ID, $request_type, $description, $price, $unit, $qty, $reason, $deptId, $year, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;
    public $EQUP_ID, $EQUP_NAME, $EQUP_CAT_ID, $EQUP_TYPE_ID, $EQUP_SEQ, $TCHN_LOCAT_ID, $EQUP_STS_ID, $PRODCT_CAT_ID, $PROC_ID, $EQUP_PRICE, $EQUP_LINK_NO, $EQUP_STS_DESC;

    public function mount()
    {
        $this->userId = Auth::user()->id;
        $this->deptId = Auth::user()->deptId;
        $this->year = Carbon::now()->addYear()->addYears(543)->format('Y');
        $this->qty = '1';
        $this->enable = '1';
        $this->created_at = now();
        $this->updated_at = now();
    }
    public function add_main()
    {
        $validatedData = $this->validate([
            'year' => 'required',
            'levelNo' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'unit' => 'required|regex:/^[^0-9]*$/',
            'qty' => 'required|numeric|min:1',
            'request_type' => 'required',
            'BGS_ID' => 'required',
            'reason' => 'required',
            'deptId' => 'required',
            'remark' => 'nullable',
            'userId' => 'required',
            'enable' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required'

        ]);

        DB::table('replace_increase_equip')->insert($validatedData);

        session()->flash('success', 'เพิ่มข้อมูลสำเร็จ!!');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'เพิ่มข้อมูลสำเร็จ!!',
            'text' => 'ข้อมูลถูกเพิ่มในตารางเรียบร้อยแล้ว',
            'urls' => '/purchasing_plan'
        ]);
    }
    public function render()
    {
        return view('livewire.purchasingPlan.create');
    }
}
