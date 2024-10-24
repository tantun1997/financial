<?php

namespace App\Http\Livewire\ActionPlans;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class EditActionPlan extends Component
{
    public $goToCreatePage2 = false;
    public $project_name, $budget, $dept_name, $work_group, $M_ID, $F_ID, $SI_ID, $G_ID, $T_ID, $Indi_ID, $sub_kpi, $objective_project,
        $userId, $created_at, $updated_at, $dept_id, $active;
    public $eventNActivity_name, $groupTarget, $amountTarget, $place, $Q1 = [], $Q2, $Q3,
        $Q4, $budgetAmount, $BGS_Id, $person_name, $P_Id, $project_ID, $project_detail_id;
    public $planType;
    public $year;
    public $editID;
    public $Edit_ACP_Project_Detail;


    public function editActionPlan($id)
    {
        $ACP_ProjectName_Main = DB::table('VW_ACP_ProjectName_Main')->where('project_ID', $id)->first();
        $this->editID = $ACP_ProjectName_Main->project_ID;
        $this->planType = $ACP_ProjectName_Main->planType;
        $this->project_name = $ACP_ProjectName_Main->project_name;
        $this->dept_name = $ACP_ProjectName_Main->dept_name;
        $this->work_group = $ACP_ProjectName_Main->work_group;
        $this->budget = $ACP_ProjectName_Main->budget;
        $this->M_ID = $ACP_ProjectName_Main->M_Id;
        $this->F_ID = $ACP_ProjectName_Main->F_Id;
        $this->SI_ID = $ACP_ProjectName_Main->SI_Id;
        $this->G_ID = $ACP_ProjectName_Main->G_Id;
        $this->T_ID = $ACP_ProjectName_Main->T_Id;
        $this->Indi_ID = $ACP_ProjectName_Main->Indi_Id;
        $this->sub_kpi = $ACP_ProjectName_Main->sub_kpi;
        $this->objective_project = $ACP_ProjectName_Main->objective_project;

        $this->Edit_ACP_Project_Detail = DB::table('ACP_Project_Detail')->where('project_ID', $id)->get();
        foreach ($this->Edit_ACP_Project_Detail as $index => $item) {
            $this->project_detail_id[$index] = $item->project_detail_id;
            $this->eventNActivity_name[$index] = $item->eventNActivity_name;
            $this->groupTarget[$index] = $item->groupTarget;
            $this->amountTarget[$index] = $item->amountTarget;
            $this->place[$index] = $item->place;
            $this->Q1[$index] = array_fill_keys(str_split($item->Q1), true);
            $this->Q2[$index] =
                array_fill_keys(str_split($item->Q2), true);
            $this->Q3[$index] =
                array_fill_keys(str_split($item->Q3), true);
            $this->Q4[$index] =
                array_fill_keys(str_split($item->Q4), true);
            $this->budgetAmount[$index] = $item->budgetAmount;
            $this->BGS_Id[$index] = $item->BGS_Id;
            $this->person_name[$index] = $item->person_name;
            $this->P_Id[$index] = $item->P_Id;
        }
        // dd($this->Q1);
    }
    public function acceptActionPlan($id)
    {

        DB::table('ACP_ProjectName_Main')->where('project_ID', $id)
            ->update([
                'project_name' => $this->project_name,
                'M_ID' => $this->M_ID,
                'F_ID' => $this->F_ID,
                'SI_ID' => $this->SI_ID,
                'G_ID' => $this->G_ID,
                'T_ID' => $this->T_ID,
                'Indi_ID' => $this->Indi_ID,
                'sub_kpi' => $this->sub_kpi,
                'objective_project' => $this->objective_project,
                'updated_at' => now(),
            ]);


        foreach ($this->Edit_ACP_Project_Detail as $index => $item) {

            $q1Value = null;
            $q2Value = null;
            $q3Value = null;
            $q4Value = null;
            if (isset($this->Q1[$index][1]) && $this->Q1[$index][1]) {
                $q1Value .= '1';
            }

            if (isset($this->Q1[$index][2]) && $this->Q1[$index][2]) {
                $q1Value .= '2';
            }

            if (isset($this->Q1[$index][3]) && $this->Q1[$index][3]) {
                $q1Value .= '3';
            }

            if (empty($q1Value)) {
                $q1Value = null;
            }

            if (isset($this->Q2[$index][1]) && $this->Q2[$index][1]) {
                $q2Value .= '1';
            }

            if (isset($this->Q2[$index][2]) && $this->Q2[$index][2]) {
                $q2Value .= '2';
            }

            if (isset($this->Q2[$index][3]) && $this->Q2[$index][3]) {
                $q2Value .= '3';
            }

            if (empty($q2Value)) {
                $q2Value = null;
            }

            if (isset($this->Q3[$index][1]) && $this->Q3[$index][1]) {
                $q3Value .= '1';
            }

            if (isset($this->Q3[$index][2]) && $this->Q3[$index][2]) {
                $q3Value .= '2';
            }

            if (isset($this->Q3[$index][3]) && $this->Q3[$index][3]) {
                $q3Value .= '3';
            }

            if (empty($q3Value)) {
                $q3Value = null;
            }

            if (isset($this->Q4[$index][1]) && $this->Q4[$index][1]) {
                $q4Value .= '1';
            }

            if (isset($this->Q4[$index][2]) && $this->Q4[$index][2]) {
                $q4Value .= '2';
            }

            if (isset($this->Q4[$index][3]) && $this->Q4[$index][3]) {
                $q4Value .= '3';
            }

            if (empty($q4Value)) {
                $q4Value = null;
            }
            DB::table('ACP_Project_Detail')
                ->where('project_ID', $id)
                ->where('project_detail_id', $item['project_detail_id'])
                ->update([
                    'Q1' => $q1Value,
                    'Q2' => $q2Value,
                    'Q3' => $q3Value,
                    'Q4' => $q4Value,
                    'eventNActivity_name' => $this->eventNActivity_name[$index],
                    'groupTarget' => $this->groupTarget[$index],
                    'amountTarget' => $this->amountTarget[$index],
                    'place' => $this->place[$index],
                    'budgetAmount' => $this->budgetAmount[$index],
                    'BGS_Id' => $this->BGS_Id[$index],
                    'person_name' => $this->person_name[$index],
                    'P_Id' => $this->P_Id[$index],
                    'updated_at' => now(),
                ]);
        }

        $totalBudget = DB::table('ACP_Project_Detail')
            ->where('project_ID', $id)
            ->sum('budgetAmount');

        DB::table('ACP_ProjectName_Main')
            ->where('project_ID', $id)
            ->update(['budget' => $totalBudget]);

        session()->flash('success', 'แก้ไขข้อมูลเรียบร้อย!!');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'แก้ไขข้อมูลสำเร็จ!!',
            'text' => 'ข้อมูลถูกแก้ไขเรียบร้อยแล้ว',
            'urls' => '/action_plan/detail?id=' . $id
        ]);
    }

    public function addRow($editID)
    {
        $newRowId = DB::table('ACP_Project_Detail')->insertGetId([
            'project_ID' => $editID,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($newRowId) {

            $this->Edit_ACP_Project_Detail[] = [
                'project_detail_id' => (string) $newRowId,
                'eventNActivity_name' => null,
                'groupTarget' => null,
                'amountTarget' => null,
                'place' => null,
                'Q1' => null,
                'Q2' => null,
                'Q3' => null,
                'Q4' => null,
                'budgetAmount' => null,
                'BGS_Id' => null,
                'person_name' => null,
                'P_Id' => null,
                'project_ID' => (string)$editID,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    }

    public function removeRow($index, $Edit_ID_Project_Detail, $editID)
    {
        $project_detail_id = $Edit_ID_Project_Detail[$index];

        unset($this->Edit_ACP_Project_Detail[$index]);


        DB::table('ACP_Project_Detail')
            ->where('project_detail_id', $project_detail_id)
            ->delete();

        $totalBudget = DB::table('ACP_Project_Detail')
            ->where('project_ID', $editID)
            ->sum('budgetAmount');

        DB::table('ACP_ProjectName_Main')
            ->where('project_ID', $editID)
            ->update(['budget' => $totalBudget]);
        session()->flash('success2', "ลบข้อมูลสำเร็จ!!");
    }

    public function mount()
    {
        $currentYear = date('Y') + 543; // แปลงปีให้เป็น พ.ศ.
        $this->year = $currentYear + 1;
    }

    public function render()
    {
        $id = request('id');
        $ACP_Goal = DB::table('ACP_Goal')->where('SI_Id', $this->SI_ID)->get();
        $ACP_Tactic = DB::table('ACP_Tactic')->where('G_Id', $this->G_ID)->get();
        $ACP_Indicators = DB::table('ACP_Indicators')->where('T_Id', $this->T_ID)->get();
        $ACP_Mission = DB::table('ACP_Mission')->get();
        $ACP_Focus = DB::table('ACP_Focus')->get();
        $ACP_Strategy = DB::table('ACP_Strategy')->get();
        $ACP_BudgetSource = DB::table('ACP_BudgetSource')->get();
        $ACP_Plan = DB::table('ACP_Plan')->get();
        $ACP_Q1 = DB::table('ACP_Q1')->get();
        $ACP_Q2 = DB::table('ACP_Q2')->get();
        $ACP_Q3 = DB::table('ACP_Q3')->get();
        $ACP_Q4 = DB::table('ACP_Q4')->get();
        $ACP_ProjectName_Main = DB::table('VW_ACP_ProjectName_Main')->where('project_ID', $id)->first();
        $VW_ACP_Project_Detail = DB::table('VW_ACP_Project_Detail')->where('project_ID', $id)->get();
        $index = 1; // กำหนดค่าเริ่มต้นของอันดับ

        foreach ($VW_ACP_Project_Detail as $item) {
            $item->index = $index++; // เพิ่มคอลัมน์ index และเพิ่มค่าอันดับ
        }
        return view('livewire.actionPlan.edit', [
            'ACP_Mission' => $ACP_Mission,
            'ACP_Focus' => $ACP_Focus,
            'ACP_Strategy' => $ACP_Strategy,
            'ACP_Goal' => $ACP_Goal,
            'ACP_Tactic' => $ACP_Tactic,
            'ACP_Indicators' => $ACP_Indicators,
            'ACP_BudgetSource' => $ACP_BudgetSource,
            'ACP_Plan' => $ACP_Plan,
            'ACP_ProjectName_Main' => $ACP_ProjectName_Main,
            'VW_ACP_Project_Detail' => $VW_ACP_Project_Detail,
            'ACP_Q1' => $ACP_Q1,
            'ACP_Q2' => $ACP_Q2,
            'ACP_Q3' => $ACP_Q3,
            'ACP_Q4' => $ACP_Q4,
        ]);
    }
}