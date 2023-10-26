<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithPagination;

class ReplaceIncreaseEquip extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteConfirmed'];

    public $request_type, $description, $price, $unit, $qty, $reason, $deptId, $year, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;
    public $EQUP_ID, $EQUP_NAME, $EQUP_CAT_ID, $EQUP_TYPE_ID, $EQUP_SEQ, $TCHN_LOCAT_ID, $EQUP_STS_ID, $PRODCT_CAT_ID, $PROC_ID, $EQUP_PRICE, $EQUP_LINK_NO, $EQUP_STS_DESC;

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
    public function mount()
    {
        if (Auth::user()->id == '114000041') {
            $replace_increase_equip = DB::table('replace_increase_equip')->where('enable', '1')->get();
            foreach ($replace_increase_equip as $item) {
                $id = $item->id;

                if ($item->levelNo == 1 && $item->approved == null) {
                    $newApproved = '1';

                    DB::table('replace_increase_equip')
                        ->where('id', $id)
                        ->update([
                            'approved' => $newApproved,
                            'approved_at' => now(),
                            'approved_userId' => Auth::user()->id
                        ]);
                }
                if ($item->levelNo == 2 && $item->approved == 1) {
                    $newApproved = '0';

                    DB::table('replace_increase_equip')
                        ->where('id', $id)
                        ->update([
                            'approved' => $newApproved,
                            'approved_at' => now(),
                            'approved_userId' => Auth::user()->id
                        ]);
                }
            }
        };

        $this->userId = Auth::user()->id;
        $this->deptId = Auth::user()->deptId;
        $this->year = Carbon::now()->addYear()->addYears(543)->format('Y');
        $this->qty = '1';
        $this->enable = '1';
        $this->created_at = now();
        $this->updated_at = now();
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
    public function Approval($id)
    {
        $query = DB::table('replace_increase_equip')->where('id', $id)->first();

        if ($query->approved == '0') {
            $newApproved = '1';
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'อนุมัติแล้ว!!',
                'urls' => 'replaceIncrease_equip'
            ]);
            DB::table('replace_increase_equip')
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
                'urls' => 'replaceIncrease_equip'
            ]);

            DB::table('replace_increase_equip')
                ->where('id', $id)
                ->update([
                    'approved' => $newApproved,
                    'approved_at' => now(),
                    'approved_userId' => Auth::user()->id
                ]);
        }
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
            'urls' => 'replaceIncrease_equip'
        ]);

        $this->resetFields();
    }
    public function edit($id)
    {
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
    }
    public function update()
    {
        $this->validate([
            'year' => 'required',
            'levelNo' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'unit' => 'required|regex:/^[^0-9]*$/',
            'qty' => 'required|numeric|min:1',
            'request_type' => 'required',
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
            'request_type' => $this->request_type

        ]);

        session()->flash('success', 'เปลี่ยนข้อมูลสำเร็จ!!');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'เปลี่ยนข้อมูลสำเร็จ!',
            'text' => 'ข้อมูลถูกเปลี่ยนเรียบร้อยแล้ว',
            'urls' => 'replaceIncrease_equip'
        ]);
        $this->resetFields();
    }


    public function resetFields()
    {
        $this->year = Carbon::now()->addYear()->addYears(543)->format('Y');
        $this->description = '';
        $this->price = '';
        $this->unit = '';
        $this->qty = '1';
        $this->request_type = '';
        $this->reason = '';
        $this->deptId = Auth::user()->deptId;
        $this->remark = '';
        $this->userId = Auth::user()->id;
        $this->enable = '1';
        $this->levelNo = '';
        $this->created_at = now();
        $this->updated_at = now();

        $this->resetErrorBag(); // ใส่บรรทัดนี้เพื่อเคลียร์ข้อผิดพลาดที่เกี่ยวข้อง

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
                'urls' => 'replaceIncrease_equip'
            ]);
            session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        } catch (\Exception $e) {
            session()->flash('error', "ไม่สามารถลบข้อมูลได้!!");
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    public function closeModal()
    {
        $this->resetFields();
        $this->resetErrorBag(); // ใส่บรรทัดนี้เพื่อเคลียร์ข้อผิดพลาดที่เกี่ยวข้อง

        return redirect(route('replaceIncrease_equip'));
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    public function add_detail($id)
    {
        $data = DB::table('vwReplaceEquip')->where('id', $id)->first();
        $this->description = $data->description;
        $this->price = $data->price;
        $this->unit = $data->unit;
        $this->qty = $data->qty;
        $this->edit_id = $id;
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
    public $searchEQUIPMENT;
    protected $VW_EQUIPMENT;
    public function searchEquipment()
    {
        $searchEQUIPMENT = '%' . $this->searchEQUIPMENT . '%';

        $query = DB::table('VW_EQUIPMENT')->select(['EQUP_LINK_NO', 'EQUP_ID', 'EQUP_NAME', 'EQUP_PRICE', 'TCHN_LOCAT_NAME', 'EQUP_STS_DESC', 'age'])
            ->where(function ($query) use ($searchEQUIPMENT) {
                $query->where('EQUP_ID', 'like', $searchEQUIPMENT)
                    ->orWhere('EQUP_NAME', 'like', $searchEQUIPMENT);
            });

        if (Auth::user()->isAdmin == 'Y' || Auth::user()->deptId == 168 || Auth::user()->deptId == 150 || Auth::user()->deptId == 330) {
            // ถ้าเป็น Admin หรือ deptId เป็น 168 หรือ 150 ให้ค้นหาทั้งหมด
        } else {
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
        if (!$this->VW_EQUIPMENT) {
            if ($this->searchEQUIPMENT == null) {
                session()->flash('SearchData', 'กรุณาพิมพ์คำค้นหาและกดค้นหา');
            }
            $this->searchEquipment();
        }
        if ($this->VW_EQUIPMENT->isEmpty()) {
            session()->flash('noData', 'ไม่พบข้อมูลที่ค้นหา');
        }

        $close_plan = DB::table('close_plan')->where('id', 1)->get();
        $vwCountDetail = DB::table('vwCountReplaceEquipDetail')->where('used', 1)->get();
        $replace_equip_detail = DB::table('vwShowReplaceEquipDetail')->get();

        $replace_increase_equip = DB::table('vwReplaceEquip')
            ->where('enable', '1')
            ->when(Auth::user()->id == '114000041', function ($query) {
                return $query->orderBy('approved', 'asc')->orderByDesc('updated_at');
            }, function ($query) {
                return $query->orderByDesc('updated_at');
            })
            ->get();
        foreach ($replace_increase_equip as $item) {
            $carbonUpdatedAt = Carbon::parse($item->updated_at); // แปลงเป็น Carbon object
            $item->updated_at = $carbonUpdatedAt->addYears(543)->format('d/m/Y H:i'); // แปลงวันที่เป็นรูปแบบพศไทย
        }
        return view('livewire.replace-increase-equip', [
            'replace_increase_equip' => $replace_increase_equip,
            'close_plan' => $close_plan,
            'vwCountDetail' => $vwCountDetail,
            'replace_equip_detail' => $replace_equip_detail,
            'VW_EQUIPMENT' => $this->VW_EQUIPMENT,


        ]);
    }
}