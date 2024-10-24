<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public function render()
    {
        if (Auth::user()->isAdmin == 'Y') {
            $PLAN_1 = DB::table('แผนบำรุงรักษา')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_2 = DB::table('แผนซ่อม')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_3 = DB::table('แผนจ้างเหมาบริการ')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_4 = DB::table('แผนสอบเทียบเครื่องมือ')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_5 = DB::table('แผนทดแทน')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_6 = DB::table('แผนเพิ่มศักยภาพ')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_7 = DB::table('แผนไม่มีเลขครุภัณฑ์')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_8 = DB::table('แผนวัสดุนอกคลัง')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_9 = DB::table('แผนวัสดุในคลัง')
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
        } else {
            $PLAN_1 = DB::table('แผนบำรุงรักษา')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_2 = DB::table('แผนซ่อม')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_3 = DB::table('แผนจ้างเหมาบริการ')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_4 = DB::table('แผนสอบเทียบเครื่องมือ')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_5 = DB::table('แผนทดแทน')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_6 = DB::table('แผนเพิ่มศักยภาพ')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_7 = DB::table('แผนไม่มีเลขครุภัณฑ์')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_8 = DB::table('แผนวัสดุนอกคลัง')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
            $PLAN_9 = DB::table('แผนวัสดุในคลัง')
                ->where('Plan_DEPTID', Auth::user()->deptId)
                ->where('Plan_ENABLE', '!=', 0)
                ->count();
        }
        return view('livewire.home', [
            'PLAN_1' => $PLAN_1,
            'PLAN_2' => $PLAN_2,
            'PLAN_3' => $PLAN_3,
            'PLAN_4' => $PLAN_4,
            'PLAN_5' => $PLAN_5,
            'PLAN_6' => $PLAN_6,
            'PLAN_7' => $PLAN_7,
            'PLAN_8' => $PLAN_8,
            'PLAN_9' => $PLAN_9,

        ]);
    }
}
