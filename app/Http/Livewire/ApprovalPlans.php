<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ApprovalPlans extends Component
{
    public function render()
    {
        $vwCountDetail = DB::table('vwCountDetail')->get();

        $VW_NEW_MAINPLAN = DB::table('VW_NEW_MAINPLAN')
            ->where('approved', '1')
            ->where('enable', '1')
            ->orderByDesc('approved_at')
            ->get();

        return view('livewire.approval-plans', [
            'VW_NEW_MAINPLAN' => $VW_NEW_MAINPLAN,
            'vwCountDetail' => $vwCountDetail

        ]);
    }
}