<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Equipment extends Component
{

    public function render()
    {
        // if (Auth::user()->isAdmin == 'Y') {
        $querys = DB::table('VW_EQUIPMENT')
            ->orderByDesc('EQUP_REGS_DATE')
            ->get();
        // } else {
        //     $querys = DB::table('VW_EQUIPMENT')
        //         ->where('TCHN_LOCAT_ID', Auth::user()->deptId)
        //         ->orderByDesc('EQUP_REGS_DATE')
        //         ->get();
        // }


        foreach ($querys as $item) {
            $carbonUpdatedAt = Carbon::parse($item->EQUP_REGS_DATE); // แปลงเป็น Carbon object
            $item->EQUP_REGS_DATE = $carbonUpdatedAt->addYears(543)->format('d/m/Y'); // แปลงวันที่เป็นรูปแบบพศไทย
        }
        $EQUP_ID = $querys->pluck('EQUP_ID')->unique()->map(function ($item) {
            return trim($item);
        })->all();
        $EQUP_NAME = $querys->pluck('EQUP_NAME')->unique()->map(function ($item) {
            return trim($item);
        })->all();
        $TCHN_LOCAT_NAME = $querys->pluck('TCHN_LOCAT_NAME')->unique()->map(function ($item) {
            return trim($item);
        })->all();
        $EQUP_STS_DESC = $querys->pluck('EQUP_STS_DESC')->unique()->map(function ($item) {
            return trim($item);
        })->all();

        return view('livewire.equipment', [
            'EQUP_NAME' => $EQUP_NAME,
            'EQUP_ID' => $EQUP_ID,

            'TCHN_LOCAT_NAME' => $TCHN_LOCAT_NAME,

            'EQUP_STS_DESC' => $EQUP_STS_DESC,
            'querys' => $querys
        ]);
    }
}