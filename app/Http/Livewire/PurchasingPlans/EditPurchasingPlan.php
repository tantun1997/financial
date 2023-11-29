<?php

namespace App\Http\Livewire\PurchasingPlans;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class EditPurchasingPlan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteConfirmed'];

    public $editDetail = false;
    public $add_purchasing_equip_detail = false;

    public $BGS_ID, $request_type, $description, $price, $unit, $qty, $reason, $deptId, $year, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;
    public $EQUP_ID, $EQUP_NAME, $EQUP_CAT_ID, $EQUP_TYPE_ID, $EQUP_SEQ, $TCHN_LOCAT_ID, $EQUP_STS_ID, $PRODCT_CAT_ID, $PROC_ID, $EQUP_PRICE, $EQUP_LINK_NO, $EQUP_STS_DESC;
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
        $data = DB::table('replace_equip_detail')->where('id', $id)->first();
        $this->EQUP_NAME = $data->EQUP_NAME;
        $this->editName = $id;
    }
    public function acceptNameEquip($id)
    {
        DB::table('replace_equip_detail')
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
        $data = DB::table('replace_equip_detail')->where('id', $id)->first();
        $this->currentPrice = $data->currentPrice;
        $this->editingId = $id;
    }

    public function acceptCurrPrice($id)
    {
        DB::table('replace_equip_detail')
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
        $query = DB::table('replace_equip_detail')->where('id', $id)->first();

        if ($query->used == '0' || $query->used == null) {
            $newUsed = '1';
        } else {
            $newUsed = '0';
        }

        DB::table('replace_equip_detail')
            ->where('id', $id)
            ->update([
                'used' => $newUsed
            ]);
        $this->searchEquipment();
    }

    public function editMainEquip($id)
    {
        $this->editDetail = true;

        $data = DB::table('replace_increase_equip')->where('id', $id)->first();
        $this->description = $data->description;
        $this->price = $data->price;
        $this->unit = $data->unit;
        $this->qty = $data->qty;
        $this->reason = $data->reason;
        $this->deptId = $data->deptId;
        $this->year = $data->year;
        $this->remark = $data->remark;
        $this->userId = $data->userId;
        $this->enable = $data->enable;
        $this->levelNo = $data->levelNo;
        $this->created_at = $data->created_at;
        $this->updated_at = now();
        $this->edit_id = $id;
        $this->request_type = $data->request_type;
        $this->BGS_ID = $data->BGS_ID;
    }
    public function update()
    {
        $this->validate([
            'year' => 'required',
            'levelNo' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
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

        $data = DB::table('replace_increase_equip')->where('id', $this->edit_id);
        $data->update([
            'description' => $this->description,
            'price' =>  $this->price,
            'unit' => $this->unit,
            'qty' => $this->qty,
            'reason' => $this->reason,
            'deptId' =>  $this->deptId,
            'year' =>  $this->year,
            'remark' => $this->remark,
            'userId' => $this->userId,
            'enable' => $this->enable,
            'levelNo' => $this->levelNo,
            'created_at' =>  $this->created_at,
            'updated_at' =>  $this->updated_at = now(),
            'request_type' => $this->request_type,
            'BGS_ID' => $this->BGS_ID
        ]);

        session()->flash('success', 'เปลี่ยนข้อมูลสำเร็จ!!');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'เปลี่ยนข้อมูลสำเร็จ!',
            'text' => 'ข้อมูลถูกเปลี่ยนเรียบร้อยแล้ว',
            'urls' => '/purchasing_plan/detail?id=' . $this->edit_id
        ]);
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
                'urls' => '/purchasing_plan/detail?id=' . $this->edit_id
            ]);
            session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        } catch (\Exception $e) {
            session()->flash('error', "ไม่สามารถลบข้อมูลได้!!");
        }
    }

    public function selectRow($equipmentId)
    {
        $selected = DB::table('VW_EQUIPMENT')
            ->select([
                'EQUP_LINK_NO',
                'EQUP_ID',
                'EQUP_NAME',
                'TCHN_LOCAT_ID',
                'EQUP_STS_ID',
                'EQUP_PRICE',
                'EQUP_STS_DESC',
                'EQUP_REGS_DATE'
            ])
            ->where('EQUP_LINK_NO', $equipmentId)
            ->first();

        $existingData = DB::table('replace_equip_detail')
            ->where('EQUP_LINK_NO', $equipmentId)
            ->where('PROC_ID', $this->edit_id)
            ->first();

        if (!$existingData) {
            // ถ้าไม่มีข้อมูลในฐานข้อมูล ให้ทำการ insert
            DB::table('replace_equip_detail')->insert([
                'EQUP_ID' => $selected->EQUP_ID,
                'EQUP_NAME' => $selected->EQUP_NAME,
                'TCHN_LOCAT_ID' => $selected->TCHN_LOCAT_ID,
                'EQUP_STS_ID' => $selected->EQUP_STS_ID,
                'PROC_ID' => $this->edit_id,
                'EQUP_PRICE' => $selected->EQUP_PRICE,
                'EQUP_LINK_NO' => $equipmentId,
                'EQUP_STS_DESC' => $selected->EQUP_STS_DESC,
                'EQUP_REGS_DATE' => $selected->EQUP_REGS_DATE,
                'used' => '1'

            ]);

            session()->flash('success', 'เพิ่มข้อมูลสำเร็จ!!');
        } else {
            // ถ้ามีข้อมูลอยู่แล้ว ให้แสดง Flash Message
            session()->flash('warning', 'มีข้อมูลนี้อยู่แล้ว');
        }

        $this->searchEquipment();
    }
    public function addRow()
    {
        $this->add_purchasing_equip_detail = true;
    }

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

    public function deleteRow($id)
    {
        DB::table('replace_equip_detail')
            ->where('id', $id)
            ->delete();

        session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        $this->searchEquipment();
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    public function render()
    {
        $id = request('id');

        if (!$this->VW_EQUIPMENT) {
            if ($this->searchEQUIPMENT == null) {
                session()->flash('SearchData', 'กรุณาพิมพ์คำค้นหาและกดค้นหา');
            }
            $this->searchEquipment();
        }
        if ($this->VW_EQUIPMENT->isEmpty()) {
            session()->flash('noData', 'ไม่พบข้อมูลที่ค้นหา');
        }

        $purchasing_equip_detail = DB::table('vwShowReplaceEquipDetail')->get();

        $purchasing_equip = DB::table('vwReplaceEquip')
            ->where('id', $id)
            ->get();

        foreach ($purchasing_equip as $item) {
            $carbonUpdatedAt = Carbon::parse($item->updated_at); // แปลงเป็น Carbon object
            $item->updated_at = $carbonUpdatedAt->addYears(543)->format('d/m/Y H:i'); // แปลงวันที่เป็นรูปแบบพศไทย
        }
        return view('livewire.purchasingPlan.edit', [
            'purchasing_equip' => $purchasing_equip,
            'purchasing_equip_detail' => $purchasing_equip_detail,
            'VW_EQUIPMENT' => $this->VW_EQUIPMENT,
        ]);
    }
}
