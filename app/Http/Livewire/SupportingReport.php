<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SupportingReport extends Component
{
    public function render()
    {

        $plan_true = DB::table('วงเงินแต่ละแผนก')
            ->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('Plan_LEVEL', 1)
            ->select(
                'TCHN_LOCAT_NAME',
                DB::raw('SUM(Total_Price) as total_price'),
                DB::raw('SUM(Total_Current_Price) as total_current_price')
            )->groupBy('TCHN_LOCAT_NAME')
            ->get();

        $plan_spare = DB::table('วงเงินแต่ละแผนก')
            ->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('Plan_LEVEL', 2)
            ->select(
                'TCHN_LOCAT_NAME',
                DB::raw('SUM(Total_Price) as total_price'),
                DB::raw('SUM(Total_Current_Price) as total_current_price')
            )->groupBy('TCHN_LOCAT_NAME')
            ->get();
        return view('livewire.supporting-report', [
            'plan_true' => $plan_true,
            'plan_spare' => $plan_spare,

        ]);
    }
}
