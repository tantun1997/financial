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

    public function mount()
    {
        $currentYear = date('Y') + 543; // แปลงปีให้เป็น พ.ศ.
        $this->year = $currentYear + 1;
    }
    public function render()
    {
        $ACP_ProjectName_Main = DB::table('VW_ACP_ProjectName_Main')->orderByDesc('updated_at')->get();

        return view('livewire.action-plan', ['ACP_ProjectName_Main' => $ACP_ProjectName_Main]);
    }
}
