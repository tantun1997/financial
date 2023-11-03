<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CreateActionPlan extends Component
{
    public $goToCreatePage2 = false;
    public $project_name, $budget, $dept_name, $work_group, $M_ID, $F_ID, $SI_ID, $G_ID, $T_ID, $Indi_ID, $sub_kpi, $objective_project,
        $userId, $created_at, $updated_at, $dept_id, $active;
    public $project_detail_id, $eventNActivity_name, $groupTarget, $amountTarget, $place, $Q1, $Q2, $Q3, $Q4, $budgetAmount, $BGS_Id, $person_name, $P_Id, $project_ID;

    public $rows = [];
    public $i = 1;
    public $year;
    public $planType;

    public function addRow($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->rows, $i);
    }
    public function removeRow($i)
    {

        unset($this->rows[$i]);
    }


    public function mount()
    {
        $this->planType = request('planType');
        $this->userId = Auth::user()->id;
        $this->dept_id = Auth::user()->deptId;
        $this->dept_name = Auth::user()->deptName;
        $this->active = '1';
        $this->created_at = now();
        $this->updated_at = now();


        $currentYear = date('Y') + 543; // แปลงปีให้เป็น พ.ศ.
        $this->year = $currentYear + 1;
    }

    public function nextCreatePage2()
    {
        if ($this->planType == 'strategic') {
            $validatedData = $this->validate([
                'project_name' => 'required',
                'budget' => 'nullable|numeric|min:1',
                'M_ID' => 'required',
                'F_ID' => 'required',
                'SI_ID' => 'nullable',
                'G_ID' => 'nullable',
                'T_ID' => 'nullable',
                'Indi_ID' => 'nullable',
                'sub_kpi' => 'nullable',
                'objective_project' => 'required',
                'userId' => 'required',
                'dept_id' => 'required',
                'dept_name' => 'required',
                'active' => 'required',
                'created_at' => 'required',
                'updated_at' => 'required',
                'planType' => 'required',

            ]);

            if ($this->getErrorBag()->any()) {
                $this->goToCreatePage2 = false; // Set to false if there are validation errors
                return;
            }

            $ACP_ProjectName_Main = DB::table('ACP_ProjectName_Main')->insertGetId($validatedData);

            if ($ACP_ProjectName_Main) {
                $this->project_ID = $ACP_ProjectName_Main;
            }

            $this->goToCreatePage2 = true;
            $this->resetFields();
        } elseif ($this->planType == 'regular') {
            $validatedData = $this->validate([
                'project_name' => 'required',
                'budget' => 'nullable|numeric|min:1',
                'M_ID' => 'nullable',
                'F_ID' => 'nullable',
                'SI_ID' => 'nullable',
                'G_ID' => 'nullable',
                'T_ID' => 'nullable',
                'Indi_ID' => 'nullable',
                'sub_kpi' => 'nullable',
                'objective_project' => 'nullable',
                'userId' => 'required',
                'dept_id' => 'required',
                'dept_name' => 'required',
                'active' => 'required',
                'created_at' => 'required',
                'updated_at' => 'required',
                'planType' => 'required',
            ]);

            if ($this->getErrorBag()->any()) {
                $this->goToCreatePage2 = false; // Set to false if there are validation errors
                return;
            }

            $ACP_ProjectName_Main = DB::table('ACP_ProjectName_Main')->insertGetId($validatedData);

            if ($ACP_ProjectName_Main) {
                $this->project_ID = $ACP_ProjectName_Main;
            }
            $this->goToCreatePage2 = true;
            $this->resetFields();
        }
    }

    public function confirmData()
    {

        foreach ($this->eventNActivity_name as $key => $value) {
            $q1Value = isset($this->Q1[$key]) ? implode('', $this->Q1[$key]) : null;
            $q2Value = isset($this->Q2[$key]) ? implode('', $this->Q2[$key]) : null;
            $q3Value = isset($this->Q3[$key]) ? implode('', $this->Q3[$key]) : null;
            $q4Value = isset($this->Q4[$key]) ? implode('', $this->Q4[$key]) : null;

            DB::table('ACP_Project_Detail')->insert([
                'eventNActivity_name' => $this->eventNActivity_name[$key],
                'groupTarget' => $this->groupTarget[$key],
                'amountTarget' => $this->amountTarget[$key],
                'place' => $this->place[$key],
                'budgetAmount' => $this->budgetAmount[$key],
                'BGS_Id' => $this->BGS_Id[$key],
                'person_name' => $this->person_name[$key],
                'P_Id' => $this->P_Id[$key],
                'project_ID' => $this->project_ID,
                'created_at' => now(),
                'updated_at' => now(),
                'Q1' => $q1Value,
                'Q2' => $q2Value,
                'Q3' => $q3Value,
                'Q4' => $q4Value,
            ]);
        }
        $totalBudget = DB::table('ACP_Project_Detail')
            ->where('project_ID', $this->project_ID)
            ->sum('budgetAmount');

        DB::table('ACP_ProjectName_Main')
            ->where('project_ID', $this->project_ID)
            ->update(['budget' => $totalBudget]);

        $this->rows = [];

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'เพิ่มข้อมูลสำเร็จ!!',
            'text' => 'ข้อมูลถูกเพิ่มในตารางเรียบร้อยแล้ว',
            'urls' => '/action_plan'
        ]);
    }


    public function resetFields()
    {
        $this->userId = Auth::user()->id;
        $this->dept_id = Auth::user()->deptId;
        $this->dept_name = Auth::user()->deptName;
        $this->active = '1';
        $this->created_at = now();
        $this->updated_at = now();
        $this->project_name = '';
        $this->budget = '';
        $this->M_ID = '';
        $this->F_ID = '';
        $this->SI_ID = '';
        $this->G_ID = '';
        $this->T_ID = '';
        $this->Indi_ID = '';
        $this->sub_kpi = '';
        $this->objective_project = '';

        $this->resetErrorBag();
    }


    public function render()
    {

        $ACP_Mission = DB::table('ACP_Mission')->get();
        $ACP_Focus = DB::table('ACP_Focus')->get();
        $ACP_Strategy = DB::table('ACP_Strategy')->get();
        $ACP_Goal = DB::table('ACP_Goal')->where('SI_Id', $this->SI_ID)->get();
        $ACP_Tactic = DB::table('ACP_Tactic')->where('G_Id', $this->G_ID)->get();
        $ACP_Indicators = DB::table('ACP_Indicators')->where('T_Id', $this->T_ID)->get();
        $ACP_BudgetSource = DB::table('ACP_BudgetSource')->get();
        $ACP_Plan = DB::table('ACP_Plan')->get();
        $ACP_Q1 = DB::table('ACP_Q1')->get();
        $ACP_Q2 = DB::table('ACP_Q2')->get();
        $ACP_Q3 = DB::table('ACP_Q3')->get();
        $ACP_Q4 = DB::table('ACP_Q4')->get();

        return view('layouts.actionPlan.create', [
            'ACP_Mission' => $ACP_Mission,
            'ACP_Focus' => $ACP_Focus,
            'ACP_Strategy' => $ACP_Strategy,
            'ACP_Goal' => $ACP_Goal,
            'ACP_Tactic' => $ACP_Tactic,
            'ACP_Indicators' => $ACP_Indicators,
            'ACP_BudgetSource' => $ACP_BudgetSource,
            'ACP_Plan' => $ACP_Plan,
            'ACP_Q1' => $ACP_Q1,
            'ACP_Q2' => $ACP_Q2,
            'ACP_Q3' => $ACP_Q3,
            'ACP_Q4' => $ACP_Q4,

        ]);
    }
}
