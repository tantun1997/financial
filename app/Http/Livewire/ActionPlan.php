<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ActionPlan extends Component
{
    public $year;
    public function deleteRow($id)
    {
        DB::table('ACP_ProjectName_Main')
            ->where('project_ID', $id)
            ->update([
                'active' => '0',
                'deleted_at' => now(),
                'deleted_userId' => Auth::user()->id
            ]);
        session()->flash('success', "ลบข้อมูลสำเร็จ!!");
    }

    public function mount()
    {
        $currentYear = date('Y') + 543; // แปลงปีให้เป็น พ.ศ.
        $this->year = $currentYear + 1;
    }
    public function render()
    {
        $ACP_ProjectName_Main = DB::table('VW_ACP_ProjectName_Main')->where('active', 1)->orderByDesc('updated_at')->get();

        return view('livewire.action-plan', ['ACP_ProjectName_Main' => $ACP_ProjectName_Main]);
    }
}
