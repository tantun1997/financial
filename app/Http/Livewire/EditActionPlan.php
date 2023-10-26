<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class EditActionPlan extends Component
{
    public $goToCreatePage2 = false;
    public $project_name, $budget, $dept_name, $work_group, $M_ID, $F_ID, $SI_ID, $G_ID, $T_ID, $Indi_ID, $sub_kpi, $objective_project,
        $userId, $created_at, $updated_at, $dept_id, $active;
    public $rows = [];
    public $i = 1;

    public function addRow($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->rows, $i);
    }
    public function removeRow($i)
    {

        unset($this->rows, $i);
    }

    public function mount()
    {
        $this->userId = Auth::user()->id;
        $this->dept_id = Auth::user()->deptId;
        $this->dept_name = Auth::user()->deptName;
        $this->active = '1';
        $this->created_at = now();
        $this->updated_at = now();
    }

    public function nextCreatePage2()
    {

        $validatedData = $this->validate([
            'project_name' => 'required',
            'budget' => 'required|numeric|min:1',
            'M_ID' => 'required',
            'F_ID' => 'required',
            'SI_ID' => 'required',
            'G_ID' => 'required',
            'T_ID' => 'required',
            'Indi_ID' => 'required',
            'sub_kpi' => 'nullable',
            'objective_project' => 'required',
            'userId' => 'required',
            'dept_id' => 'required',
            'dept_name' => 'required',
            'active' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
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
    }
    public $eventNActivity_name, $groupTarget, $amountTarget, $place, $Q1, $Q2, $Q3, $Q4, $budgetAmount, $BGS_Id, $person_name, $P_Id, $project_ID;

    public function confirmData()
    {
        $validatedData = $this->validate([
            'eventNActivity_name.*' => 'required',
            'groupTarget.*' => 'required',
            'amountTarget.*' => 'required',
            'place.*' => 'required',
            'Q1.*' => 'required',
            'Q2.*' => 'required',
            'Q3.*' => 'required',
            'Q4.*' => 'required',
            'budgetAmount.*' => 'required|numeric|min:1',
            'BGS_Id.*' => 'required',
            'person_name.*' => 'required',
            'P_Id.*' => 'required',
            'project_ID' => 'required',
            'created_at.*' => 'required',
            'updated_at.*' => 'required',
        ]);

        $insertData = [];

        foreach ($this->eventNActivity_name as $key => $value) {
            $insertData[] = [
                'eventNActivity_name' => $this->eventNActivity_name[$key],
                'groupTarget' => $this->groupTarget[$key],
                'amountTarget' => $this->amountTarget[$key],
                'place' => $this->place[$key],
                'Q1' => $this->Q1[$key],
                'Q2' => $this->Q2[$key],
                'Q3' => $this->Q3[$key],
                'Q4' => $this->Q4[$key],
                'budgetAmount' => $this->budgetAmount[$key],
                'BGS_Id' => $this->BGS_Id[$key],
                'person_name' => $this->person_name[$key],
                'P_Id' => $this->P_Id[$key],
                'project_ID' => $this->project_ID,
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

            ];
        }

        DB::table('ACP_Project_Detail')->insert($insertData);

        $this->rows = [];

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'เพิ่มข้อมูลสำเร็จ!!',
            'text' => 'ข้อมูลถูกเพิ่มในตารางเรียบร้อยแล้ว',
            'urls' => '/action_plan'
        ]);
    }




    public function render()
    {
        $id = request('id');

        $ACP_Mission = DB::table('ACP_Mission')->get();
        $ACP_Focus = DB::table('ACP_Focus')->get();
        $ACP_Strategy = DB::table('ACP_Strategy')->get();
        $ACP_Goal = DB::table('ACP_Goal')->get();
        $ACP_Tactic = DB::table('ACP_Tactic')->get();
        $ACP_Indicators = DB::table('ACP_Indicators')->get();
        $ACP_BudgetSource = DB::table('ACP_BudgetSource')->get();
        $ACP_Plan = DB::table('ACP_Plan')->get();
        $ACP_ProjectName_Main = DB::table('VW_ACP_ProjectName_Main')->where('project_ID', $id)->first();
        $VW_ACP_Project_Detail = DB::table('VW_ACP_Project_Detail')->where('project_ID', $id)->get();



        return view('layouts.actionPlan.edit', [
            'ACP_Mission' => $ACP_Mission,
            'ACP_Focus' => $ACP_Focus,
            'ACP_Strategy' => $ACP_Strategy,
            'ACP_Goal' => $ACP_Goal,
            'ACP_Tactic' => $ACP_Tactic,
            'ACP_Indicators' => $ACP_Indicators,
            'ACP_BudgetSource' => $ACP_BudgetSource,
            'ACP_Plan' => $ACP_Plan,
            'ACP_ProjectName_Main' => $ACP_ProjectName_Main,
            'VW_ACP_Project_Detail' => $VW_ACP_Project_Detail

        ]);
    }
}
