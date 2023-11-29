<?php

namespace App\Http\Livewire\ContractServices;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class EditContractServices extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $procurementType, $priorityNo, $description, $price, $package, $quant,
        $objectTypeId, $reason, $deptId, $budget, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;

    public $editDetail = false;

    public $EQUP_ID, $EQUP_NAME, $TCHN_LOCAT_ID, $EQUP_STS_ID, $PROC_ID, $EQUP_PRICE, $EQUP_LINK_NO, $EQUP_STS_DESC;
    public function mount()
    {
        $id = request('id');

        $this->edit_id = $id;
    }


    public function addRow($edit_id)
    {
        $selected = DB::table('procurements')
            ->select([
                'description',
                'price',
                'package'
            ])
            ->where('id', $edit_id)
            ->first();

        DB::table('procurements_detail')->insert([
            'EQUP_NAME' => $selected->description,
            'PROC_ID' => $edit_id,
            'currentPrice' => $selected->price,
            'unit' => $selected->package,
            'used' => '0'
        ]);
        session()->flash('success', "ลบข้อมูลสำเร็จ!!");
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    // แก้ไขชื่อรายการครุภัณฑ์
    public $editQty;
    public $qty;

    public function addQty($id)
    {
        $data = DB::table('procurements_detail')->where('id', $id)->first();
        $this->qty = $data->qty;
        $this->editQty = $id;
    }
    public function acceptQty($id)
    {
        DB::table('procurements_detail')
            ->where('id', $id)
            ->update([
                'qty' => $this->qty

            ]);
        $this->editQty = null;
    }

    public function cancelQty($id)
    {
        $this->editQty = null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////
    // แก้ไขชื่อรายการครุภัณฑ์
    public $editName;

    public function editNameEquip($id)
    {
        $data = DB::table('procurements_detail')->where('id', $id)->first();
        $this->EQUP_NAME = $data->EQUP_NAME;
        $this->editName = $id;
    }
    public function acceptNameEquip($id)
    {
        DB::table('procurements_detail')
            ->where('id', $id)
            ->update([
                'EQUP_NAME' => $this->EQUP_NAME
            ]);
        $this->editName = null;
    }

    public function cancelNameEquip($id)
    {
        $this->editName = null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////
    // แก้ไขราคาครุภัณฑ์

    public $currentPrice;
    public $editingId;
    public function addCurrPrice($id)
    {
        $data = DB::table('procurements_detail')->where('id', $id)->first();
        $this->currentPrice = $data->currentPrice;
        $this->editingId = $id;
    }

    public function acceptCurrPrice($id)
    {
        DB::table('procurements_detail')
            ->where('id', $id)
            ->update([
                'currentPrice' => $this->currentPrice
            ]);
        $this->editingId = null;
    }

    public function cancelCurrPrice($id)
    {
        $this->editingId = null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    public function CheckedEquip($id)
    {
        $clickedItem = DB::table('procurements_detail')->where('id', $id)->first();

        if ($clickedItem->used == '0') {
            // Update the clicked item to 1
            DB::table('procurements_detail')
                ->where('id', $id)
                ->update(['used' => '1']);

            // Update other items to 0
            DB::table('procurements_detail')
                ->where('id', '!=', $id)
                ->update(['used' => '0']);
        }
    }


    public function deleteRow($id)
    {
        DB::table('procurements_detail')
            ->where('id', $id)
            ->delete();

        session()->flash('success', "ลบข้อมูลสำเร็จ!!");
    }

    /////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    public function editMainEquip($id)
    {
        $this->editDetail = true;

        $data = DB::table('procurements')->where('id', $id)->first();
        $this->procurementType = $data->procurementType;
        $this->priorityNo = $data->priorityNo;
        $this->description = $data->description;
        $this->price = $data->price;
        $this->package = $data->package;
        $this->quant = $data->quant;
        $this->objectTypeId = $data->objectTypeId;
        $this->reason = $data->reason;
        $this->deptId = $data->deptId;
        $this->budget = $data->budget;
        $this->remark = $data->remark;
        $this->userId = $data->userId;
        $this->enable = $data->enable;
        $this->levelNo = $data->levelNo;
        $this->created_at = $data->created_at;
        $this->updated_at = now();
        $this->edit_id = $id;
    }

    public function update()
    {
        $this->validate([
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
            'updated_at' => 'required'
        ]);

        $data = DB::table('procurements')->where('id', $this->edit_id);
        $data->update([
            'budget' => $this->budget,
            'priorityNo' => $this->priorityNo,
            'description' => $this->description,
            'price' => $this->price,
            'package' => $this->package,
            'quant' => $this->quant,
            'objectTypeId' => $this->objectTypeId,
            'reason' => $this->reason,
            'deptId' => $this->deptId,
            'remark' => $this->remark,
            'userId' => $this->userId,
            'procurementType' => $this->procurementType,
            'enable' => $this->enable,
            'levelNo' => $this->levelNo,
            'updated_at' => now()

        ]);

        session()->flash('success', 'เปลี่ยนข้อมูลสำเร็จ!!');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'เปลี่ยนข้อมูลสำเร็จ!',
            'text' => 'ข้อมูลถูกเปลี่ยนเรียบร้อยแล้ว',
            'urls' => '/contract_services/detail?id=' . $this->edit_id
        ]);
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////

    public function render()
    {


        $id = request('id');

        $VW_NEW_MAINPLAN = DB::table('VW_NEW_MAINPLAN')
            ->where('id', $id)
            ->get();
        foreach ($VW_NEW_MAINPLAN as $item) {
            $carbonUpdatedAt = Carbon::parse($item->updated_at); // แปลงเป็น Carbon object
            $item->updated_at = $carbonUpdatedAt->addYears(543)->format('d/m/Y H:i'); // แปลงวันที่เป็นรูปแบบพศไทย
        }
        $procurement_object_edit = DB::table('procurement_object')->where('procurementTypeId', 2)->where('procurementCode', '!=', '26')->get();

        $procurements_detail = DB::table('procurements_detail')->get();

        return view('livewire.contractService.edit', [
            'procurements_detail' => $procurements_detail,
            'VW_NEW_MAINPLAN' => $VW_NEW_MAINPLAN,
            'procurement_object_edit' => $procurement_object_edit
        ]);
    }
}
