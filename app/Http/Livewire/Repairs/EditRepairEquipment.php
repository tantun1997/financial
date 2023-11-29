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

    public $procurementType, $priorityNo, $description, $price, $package, $quant,
        $objectTypeId, $reason, $deptId, $budget, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;

    public $editDetail = false;
    public $add_procurements_detail = false;

    public $EQUP_ID, $EQUP_NAME, $TCHN_LOCAT_ID, $EQUP_STS_ID, $PROC_ID, $EQUP_PRICE, $EQUP_LINK_NO, $EQUP_STS_DESC;
    public function mount()
    {
        $id = request('id');

        $this->edit_id = $id;
    }

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
        $query = DB::table('procurements_detail')->where('id', $id)->first();

        if ($query->used == '0' || $query->used == null) {
            $newUsed = '1';
        } else {
            $newUsed = '0';
        }

        DB::table('procurements_detail')
            ->where('id', $id)
            ->update([
                'used' => $newUsed
            ]);
    }

    public function deleteRow($id)
    {
        DB::table('procurements_detail')
            ->where('id', $id)
            ->delete();

        session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        $this->searchEquipment();
    }
    public function addRow()
    {
        $this->add_procurements_detail = true;
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    public function selectRow($equipmentId)
    {

        $selected = DB::table('VW_EQUIPMENT')
            ->select([
                'EQUP_LINK_NO',
                'EQUP_ID',
                'EQUP_NAME',
                'EQUP_CAT_ID',
                'EQUP_TYPE_ID',
                'EQUP_SEQ',
                'TCHN_LOCAT_ID',
                'EQUP_STS_ID',
                'PRODCT_CAT_ID',
                'EQUP_PRICE',
                'EQUP_STS_DESC',
                'EQUP_REGS_DATE'
            ])
            ->where('EQUP_LINK_NO', $equipmentId)
            ->first();

        $existingData = DB::table('procurements_detail')
            ->where('EQUP_LINK_NO', $equipmentId)
            ->where('PROC_ID', $this->edit_id)
            ->first();

        if (!$existingData) {
            // ถ้าไม่มีข้อมูลในฐานข้อมูล ให้ทำการ insert
            DB::table('procurements_detail')->insert([
                'EQUP_ID' => $selected->EQUP_ID,
                'EQUP_NAME' => $selected->EQUP_NAME,
                'EQUP_CAT_ID' => $selected->EQUP_CAT_ID,
                'EQUP_TYPE_ID' => $selected->EQUP_TYPE_ID,
                'EQUP_SEQ' => $selected->EQUP_SEQ,
                'TCHN_LOCAT_ID' => $selected->TCHN_LOCAT_ID,
                'EQUP_STS_ID' => $selected->EQUP_STS_ID,
                'PRODCT_CAT_ID' => $selected->PRODCT_CAT_ID,
                'PROC_ID' => $this->edit_id,
                'EQUP_PRICE' => $selected->EQUP_PRICE,
                'EQUP_LINK_NO' => $equipmentId,
                'EQUP_STS_DESC' => $selected->EQUP_STS_DESC,
                'EQUP_REGS_DATE' => $selected->EQUP_REGS_DATE,
                'used' => '0'

            ]);

            session()->flash('success', 'เพิ่มข้อมูลสำเร็จ!!');
        } else {
            // ถ้ามีข้อมูลอยู่แล้ว ให้แสดง Flash Message
            session()->flash('warning', 'มีข้อมูลนี้อยู่แล้ว');
        }

        $this->searchEquipment();
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    public function editRepairEquip($id)
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
            'urls' => '/repair_equip/detail?id=' . $this->edit_id
        ]);
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    public $searchEQUIPMENT;
    protected $VW_EQUIPMENT;

    public function searchEquipment()
    {
        $searchEQUIPMENT = '%' . $this->searchEQUIPMENT . '%';

        $query = DB::table('VW_EQUIPMENT')
            ->select(['EQUP_LINK_NO', 'EQUP_ID', 'EQUP_NAME', 'EQUP_PRICE', 'TCHN_LOCAT_NAME', 'EQUP_STS_DESC', 'age'])
            ->where(function ($query) use ($searchEQUIPMENT) {
                $query->where('EQUP_ID', 'like', $searchEQUIPMENT)
                    ->orWhere('EQUP_NAME', 'like', $searchEQUIPMENT);
            });

        if (!(Auth::user()->isAdmin == 'Y' || Auth::user()->deptId == 168 || Auth::user()->deptId == 150 || Auth::user()->deptId == 330)) {
            $query->where('TCHN_LOCAT_ID', Auth::user()->deptId);
        }

        $this->VW_EQUIPMENT = $query->orderBy('EQUP_ID', 'asc')->paginate(10);
        $this->resetPage();
    }
    public function render()
    {
        if (!$this->VW_EQUIPMENT) {
            if ($this->searchEQUIPMENT == null) {
                session()->flash('SearchData', 'กรุณาพิมพ์คำค้นหาและกดค้นหา');
            }
            $this->searchEquipment();
        }
        if ($this->VW_EQUIPMENT->isEmpty()) {
            session()->flash('noData', 'ไม่พบข้อมูลที่ค้นหา');
        }

        $id = request('id');

        $VW_NEW_MAINPLAN = DB::table('VW_NEW_MAINPLAN')
            ->where('id', $id)
            ->get();

        foreach ($VW_NEW_MAINPLAN as $item) {
            $carbonUpdatedAt = Carbon::parse($item->updated_at); // แปลงเป็น Carbon object
            $item->updated_at = $carbonUpdatedAt->addYears(543)->format('d/m/Y H:i'); // แปลงวันที่เป็นรูปแบบพศไทย
        }
        $procurement_object_edit = DB::table('procurement_object')->where('procurementTypeId', 1)->get();

        $procurements_detail = DB::table('vwShowEquipDetail')->get();
        return view('livewire.repair.edit', [
            'procurements_detail' => $procurements_detail,
            'VW_EQUIPMENT' => $this->VW_EQUIPMENT,
            'VW_NEW_MAINPLAN' => $VW_NEW_MAINPLAN,
            'procurement_object_edit' => $procurement_object_edit
        ]);
    }
}
