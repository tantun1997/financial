<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FinancialReport extends Component
{

    public function render()
    {
        $Administration_total = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->sum('Total_Price');
        $Administration_true = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->where('Plan_LEVEL', 1)
            ->sum('Total_Price');
        $Administration_true_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->where('Plan_LEVEL', 1)
            ->sum('Currently_Price');
        $Administration_true_remaining = $Administration_true - $Administration_true_used;
        $Administration_spare = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->where('Plan_LEVEL', 2)
            ->sum('Total_Price');
        $Administration_spare_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านอำนวยการ')
            ->where('Plan_LEVEL', 2)
            ->sum('Currently_Price');
        $Administration_spare_remaining = $Administration_spare - $Administration_spare_used;

        $Nursing_total = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->sum('Total_Price');
        $Nursing_true = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->where('Plan_LEVEL', 1)
            ->sum('Total_Price');
        $Nursing_true_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->where('Plan_LEVEL', 1)
            ->sum('Currently_Price');
        $Nursing_true_remaining = $Nursing_true - $Nursing_true_used;
        $Nursing_spare = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->where('Plan_LEVEL', 2)
            ->sum('Total_Price');
        $Nursing_spare_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านการพยาบาล')
            ->where('Plan_LEVEL', 2)
            ->sum('Currently_Price');
        $Nursing_spare_remaining = $Nursing_spare - $Nursing_spare_used;

        $Secondary_total = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->sum('Total_Price');
        $Secondary_true = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('Plan_LEVEL', 1)
            ->sum('Total_Price');
        $Secondary_true_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('Plan_LEVEL', 1)
            ->sum('Currently_Price');
        $Secondary_true_remaining = $Secondary_true - $Secondary_true_used;
        $Secondary_spare = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('Plan_LEVEL', 2)
            ->sum('Total_Price');
        $Secondary_spare_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('Plan_LEVEL', 2)
            ->sum('Currently_Price');
        $Secondary_spare_remaining = $Secondary_spare - $Secondary_spare_used;

        $Primary_total = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->sum('Total_Price');
        $Primary_true = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('Plan_LEVEL', 1)
            ->sum('Total_Price');
        $Primary_true_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('Plan_LEVEL', 1)
            ->sum('Currently_Price');
        $Primary_true_remaining = $Primary_true - $Primary_true_used;
        $Primary_spare = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('Plan_LEVEL', 2)
            ->sum('Total_Price');
        $Primary_spare_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('Plan_LEVEL', 2)
            ->sum('Currently_Price');
        $Primary_spare_remaining = $Primary_spare - $Primary_spare_used;

        $Supporting_total = DB::table('วงเงินแต่ละกลุ่มภารกิจ')
            ->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->sum('Total_Price');
        $Supporting_true = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('Plan_LEVEL', 1)
            ->sum('Total_Price');
        $Supporting_true_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('Plan_LEVEL', 1)
            ->sum('Currently_Price');
        $Supporting_true_remaining = $Supporting_true - $Supporting_true_used;
        $Supporting_spare = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('Plan_LEVEL', 2)
            ->sum('Total_Price');
        $Supporting_spare_used = DB::table('วงเงินแต่ละกลุ่มภารกิจ')->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('Plan_LEVEL', 2)
            ->sum('Currently_Price');
        $Supporting_spare_remaining = $Supporting_spare - $Supporting_spare_used;

        return view('livewire.financial-report', [
            'Administration_total' => $Administration_total,
            'Administration_true' => $Administration_true,
            'Administration_true_used' => $Administration_true_used,
            'Administration_true_remaining' => $Administration_true_remaining,
            'Administration_spare' => $Administration_spare,
            'Administration_spare_used' => $Administration_spare_used,
            'Administration_spare_remaining' => $Administration_spare_remaining,

            'Nursing_total' => $Nursing_total,
            'Nursing_true' => $Nursing_true,
            'Nursing_true_used' => $Nursing_true_used,
            'Nursing_true_remaining' => $Nursing_true_remaining,
            'Nursing_spare' => $Nursing_spare,
            'Nursing_spare_used' => $Nursing_spare_used,
            'Nursing_spare_remaining' => $Nursing_spare_remaining,

            'Secondary_total' => $Secondary_total,
            'Secondary_true' => $Secondary_true,
            'Secondary_true_used' => $Secondary_true_used,
            'Secondary_true_remaining' => $Secondary_true_remaining,
            'Secondary_spare' => $Secondary_spare,
            'Secondary_spare_used' => $Secondary_spare_used,
            'Secondary_spare_remaining' => $Secondary_spare_remaining,

            'Primary_total' => $Primary_total,
            'Primary_true' => $Primary_true,
            'Primary_true_used' => $Primary_true_used,
            'Primary_true_remaining' => $Primary_true_remaining,
            'Primary_spare' => $Primary_spare,
            'Primary_spare_used' => $Primary_spare_used,
            'Primary_spare_remaining' => $Primary_spare_remaining,

            'Supporting_total' => $Supporting_total,
            'Supporting_true' => $Supporting_true,
            'Supporting_true_used' => $Supporting_true_used,
            'Supporting_true_remaining' => $Supporting_true_remaining,
            'Supporting_spare' => $Supporting_spare,
            'Supporting_spare_used' => $Supporting_spare_used,
            'Supporting_spare_remaining' => $Supporting_spare_remaining,

        ]);
    }
}
