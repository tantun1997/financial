<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Equipment extends Component
{
    public function render()
    {

        $querys = DB::table('VW_EQUIPMENT')
            ->select(
                'EQUP_LINK_NO',
                'EQUP_ID',
                'EQUP_NAME',
                'EQUP_PRICE',
                'TCHN_LOCAT_NAME',
                'EQUP_REGS_DATE',
                'EQUP_CAT_NAME',
                'EQUP_TYPE_NAME',
                'EQUP_STS_DESC',
                'EQUP_STS_ID',
            )->orderByDesc('EQUP_REGS_DATE')
            ->get();

        $index = 1; // กำหนดค่าเริ่มต้นของอันดับ

        foreach ($querys as $item) {
            $item->index = $index++; // เพิ่มคอลัมน์ index และเพิ่มค่าอันดับ
            $carbonUpdatedAt = Carbon::parse($item->EQUP_REGS_DATE); // แปลงเป็น Carbon object
            $item->EQUP_REGS_DATE = $carbonUpdatedAt->addYears(543)->format('d/m/Y'); // แปลงวันที่เป็นรูปแบบพศไทย
        }
        $name = $querys->pluck('EQUP_NAME')->unique()->map(function ($item) {
            return trim($item);
        })->all();
        $locat = $querys->pluck('TCHN_LOCAT_NAME')->unique()->map(function ($item) {
            return trim($item);
        })->all();
        $cata = $querys->pluck('EQUP_CAT_NAME')->unique()->map(function ($item) {
            return trim($item);
        })->all();
        $type = $querys->pluck('EQUP_TYPE_NAME')->unique()->map(function ($item) {
            return trim($item);
        })->all();
        $status = $querys->pluck('EQUP_STS_DESC')->unique()->map(function ($item) {
            return trim($item);
        })->all();

        return view('livewire.equipment', [
            'name' => $name,
            'locat' => $locat,
            'cata' => $cata,
            'type' => $type,
            'status' => $status,
            'querys' => $querys
        ]);
    }
    
}
