<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReplaceIncreaseEquip extends Component
{
    protected $listeners = ['deleteConfirmed'];

    public $request_type, $description, $price, $unit, $qty, $reason, $deptId, $year, $remark, $userId, $enable, $levelNo, $edit_id, $created_at, $updated_at;

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


    public function render()
    {
        $close_plan = DB::table('close_plan')->where('id', 1)->get();

        $replace_increase_equip = DB::table('vwReplaceEquip')
            // ->where('objectTypeId', '01')
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
        ]);
    }
}
