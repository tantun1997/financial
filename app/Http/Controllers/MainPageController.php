<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function home()
    {
        return view('home');
    }

    public function maintenanceEquipment()
    {
        return view('vwAllPlan.maintenance.vw_maintenance-plan');
    }
    public function createMaintenancePlan()
    {
        return view('vwAllPlan.maintenance.vw_create-maintenance-plan');
    }
    public function detailMaintenancePlan()
    {
        return view('vwAllPlan.maintenance.vw_detail-maintenance-plan');
    }
    public function repairEquipment()
    {
        return view('vwAllPlan.repair.vw_repair-equipment');
    }
    public function createRepairEquipment()
    {
        return view('vwAllPlan.repair.vw_create-repair-equipment');
    }
    public function detailRepairEquipment()
    {
        return view('vwAllPlan.repair.vw_detail-repair-equipment');
    }

    public function contractServices()
    {
        return view('vwAllPlan.contractService.vw_contract-services');
    }
    public function createContractServices()
    {
        return view('vwAllPlan.contractService.vw_create-contract-services');
    }
    public function detailContractServices()
    {
        return view('vwAllPlan.contractService.vw_detail-contract-services');
    }

    public function calibration()
    {
        return view('vwAllPlan.calibration.vw_calibration');
    }
    public function createCalibration()
    {
        return view('vwAllPlan.calibration.vw_create-calibration');
    }
    public function detailCalibration()
    {
        return view('vwAllPlan.calibration.vw_detail-calibration');
    }

    public function replaceIncreaseEquip()
    {
        return view('vw_replace-increase-equip');
    }

    public function purchasingPlan()
    {
        return view('vwAllPlan.purchasingPlan.vw_purchasing_plan');
    }
    public function createPurchasingPlan()
    {
        return view('vwAllPlan.purchasingPlan.vw_create-purchasing_plan');
    }
    public function detailPurchasingPlan()
    {
        return view('vwAllPlan.purchasingPlan.vw_detail-purchasing_plan');
    }


    public function equipment()
    {
        return view('vw_equipment');
    }

    public function approvalPlans()
    {
        return view('vw_approval-plans');
    }


    public function actionPlan()
    {
        return view('vwAllPlan.actionPlan.vw_action-plan');
    }
    public function createActionPlan()
    {
        return view('vwAllPlan.actionPlan.vw_create-action-plan');
    }
    public function detailActionPlan()
    {
        return view('vwAllPlan.actionPlan.vw_detail-action-plan');
    }
}
