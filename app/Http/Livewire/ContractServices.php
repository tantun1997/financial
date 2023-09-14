<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ContractServices extends Component
{
    use WithPagination;

    public $procurementType, $priorityNo, $description, $price, $package, $quant,
        $objectTypeId, $reason, $deptId, $budget, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;

    protected $listeners = ['deleteConfirmed', 'descriptionChanged' => 'updateDescription'];

    public $EQUP_ID, $EQUP_NAME, $EQUP_CAT_ID, $EQUP_TYPE_ID, $EQUP_SEQ, $TCHN_LOCAT_ID, $EQUP_STS_ID, $PRODCT_CAT_ID, $PROC_ID, $EQUP_PRICE, $EQUP_LINK_NO, $EQUP_STS_DESC;
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

    public function deleteRow($id)
    {
        DB::table('procurements_detail')
            ->where('id', $id)
            ->delete();

        session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        $this->searchEquipment();
    }


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
                'EQUP_STS_DESC'
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
            ]);

            session()->flash('success', 'เพิ่มข้อมูลสำเร็จ!!');
        } else {
            // ถ้ามีข้อมูลอยู่แล้ว ให้แสดง Flash Message
            session()->flash('warning', 'มีข้อมูลนี้อยู่แล้ว');
        }

        $this->searchEquipment();
    }

    public function add_detail($id)
    {
        $data = DB::table('procurements')->where('id', $id)->first();
        $this->description = $data->description;
        $this->price = $data->price;
        $this->package = $data->package;
        $this->quant = $data->quant;
        $this->edit_id = $id;
    }

    public function mount()
    {
        $this->userId = Auth::user()->id;
        $this->deptId = Auth::user()->deptId;
        $this->budget = '2567';
        $this->priorityNo = '001';
        $this->quant = '1';
        $this->remark = '';
        $this->procurementType = '2';
        $this->enable = '1';
        $this->created_at = now();
        $this->updated_at = now();
    }

    public function resetFields()
    {
        $this->budget = '2567';
        $this->priorityNo = '001';
        $this->description = '';
        $this->price = '';
        $this->package = '';
        $this->quant = '1';
        $this->objectTypeId = '';
        $this->reason = '';
        $this->deptId = Auth::user()->deptId;
        $this->remark = '';
        $this->userId = Auth::user()->id;
        $this->procurementType = '2';
        $this->enable = '1';
        $this->levelNo = '';
        $this->created_at = now();
        $this->updated_at = now();

        $this->EQUP_LINK_NO = '';
        $this->EQUP_ID = '';
        $this->EQUP_NAME = '';
        $this->EQUP_CAT_ID = '';
        $this->EQUP_TYPE_ID = '';
        $this->EQUP_SEQ = '';
        $this->TCHN_LOCAT_ID = '';
        $this->EQUP_STS_ID = '';
        $this->PRODCT_CAT_ID = '';
        $this->PROC_ID = '';
        $this->EQUP_PRICE = '';
        $this->EQUP_STS_DESC = '';
        $this->resetErrorBag(); // ใส่บรรทัดนี้เพื่อเคลียร์ข้อผิดพลาดที่เกี่ยวข้อง

    }

    public function store()
    {
        $validatedData = $this->validate([
            'budget' => 'required',
            'priorityNo' => 'required|numeric',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
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
            'urls' => 'contract_services'
        ]);

        $this->resetFields();
    }

    public function closeModal()
    {
        $this->resetFields();
        $this->resetErrorBag(); // ใส่บรรทัดนี้เพื่อเคลียร์ข้อผิดพลาดที่เกี่ยวข้อง

        return redirect(route('contract_services'));
    }


    public function edit($id)
    {
        $data = DB::table('procurements')->where('id', $id)->first();

        if ($data) {
            // dd($this->objectTypeId);
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
    }

    public function update()
    {
        $this->validate([
            'budget' => 'required',
            'priorityNo' => 'required|numeric',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
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
            'urls' => 'contract_services'
        ]);
        $this->resetFields();
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
                    'updated_at' => now()
                ]);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'ลบข้อมูลสำเร็จ!',
                'text' => 'ข้อมูลหายไปจากตารางเรียบร้อยแล้ว',
                'urls' => 'contract_services'
            ]);
            session()->flash('success', "ลบข้อมูลสำเร็จ!!");
        } catch (\Exception $e) {
            session()->flash('error', "ไม่สามารถลบข้อมูลได้!!");
        }
    }
    public $searchEQUIPMENT, $VW_EQUIPMENT;
    public $loading = false;
    public $searchPerformed = false;

    public function searchEquipment()
    {
        $deptId = Auth::user()->deptId;

        $this->loading = true;

        $searchEQUIPMENT = '%' . $this->searchEQUIPMENT . '%';

        $searchResult = DB::table('VW_EQUIPMENT')->select(['EQUP_LINK_NO', 'EQUP_ID', 'EQUP_NAME', 'EQUP_PRICE', 'TCHN_LOCAT_NAME', 'EQUP_STS_DESC'])
            ->where(function ($query) use ($searchEQUIPMENT, $deptId) {
                $query->where('EQUP_ID', 'like', $searchEQUIPMENT)
                    ->orWhere('EQUP_NAME', 'like', $searchEQUIPMENT);

                if (!(Auth::user()->isAdmin == 'Y' || $deptId == 168 || $deptId == 150)) {
                    $query->where('TCHN_LOCAT_ID', $deptId);
                }
            })
            ->get();


        if ($searchResult->isEmpty()) {
            $this->VW_EQUIPMENT = null;
        } else {
            $this->VW_EQUIPMENT = $searchResult;
        }
        $this->loading = false;
        $this->searchPerformed = true;
    }

    public function render()
    {

        $procurements_detail = DB::table('procurements_detail')->select(['id', 'PROC_ID', 'EQUP_ID', 'EQUP_NAME', 'EQUP_PRICE', 'EQUP_STS_DESC'])->get();
        $vwCountDetail = DB::table('vwCountDetail')->get();



        $VW_NEW_MAINPLAN = DB::table('VW_NEW_MAINPLAN')
            ->where('procurementType', '2')
            ->orderBy('updated_at', 'DESC')
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


        return view('livewire.contract-services', [
            'procurements_detail' => $procurements_detail,
            'years' => $years,
            //ค้นหาปี
            'objectName' => $objectName,
            //ค้นหาประเภท
            'deptName' => $deptName,
            //ค้นหาหน่วยงานที่เบิก
            'VW_NEW_MAINPLAN' => $VW_NEW_MAINPLAN, //ดึงตาราง VW_Maintenance
            'vwCountDetail' => $vwCountDetail

        ]);
    }
}
