<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ApprovedItems extends Component
{

    public function approved($id)
    {
        DB::table('EQUIPMENT_PLAN')
            ->where('Plan_ID', $id)
            ->update([
                'Plan_ENABLE' => '2',
                'Plan_REQUEST_APPROVAL' => '0',
            ]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'อนุมัติแล้ว!!',
            'urls' => 'approved_items'
        ]);
    }
    public function disapproved($id)
    {
        DB::table('EQUIPMENT_PLAN')
            ->where('Plan_ID', $id)
            ->update([
                'Plan_ENABLE' => '3',
            ]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'ไม่อนุมัติ!!',
            'urls' => 'approved_items'
        ]);
    }
    public function render()
    {
        $EQUIPMENT_PLAN = DB::table('แผนทั้งหมด')
            ->where('Plan_REQUEST_APPROVAL', 1)
            ->where('Plan_ENABLE', 1)
            ->orderBy('Plan_ID', 'desc')
            ->get();

        return view('livewire.approved-items', [
            'EQUIPMENT_PLAN' => $EQUIPMENT_PLAN,
        ]);
    }
}