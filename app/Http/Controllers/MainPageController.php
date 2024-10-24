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

    public function replacementPlan()
    {
        return view('vwAllPlan.replacementPlan.vw_replacement_plan');
    }
    public function createReplacementPlan()
    {
        return view('vwAllPlan.replacementPlan.vw_create-replacement_plan');
    }
    public function detailReplacementPlan()
    {
        return view('vwAllPlan.replacementPlan.vw_detail-replacement_plan');
    }

    public function potentialPlan()
    {
        return view('vwAllPlan.potentialPlan.vw_potential_plan');
    }
    public function createPotentialPlan()
    {
        return view('vwAllPlan.potentialPlan.vw_create-potential_plan');
    }
    public function detailPotentialPlan()
    {
        return view('vwAllPlan.potentialPlan.vw_detail-potential_plan');
    }

    public function noserialPlan()
    {
        return view('vwAllPlan.noserialPlan.vw_noserial_plan');
    }
    public function createNoserialPlan()
    {
        return view('vwAllPlan.noserialPlan.vw_create-noserial_plan');
    }
    public function detailNoserialPlan()
    {
        return view('vwAllPlan.noserialPlan.vw_detail-noserial_plan');
    }

    public function POutsidewarehouse()
    {
        return view('vwAllPlan.POutsidewarehouse.vw_outsidewarehouse_plan');
    }
    public function createPOutsidewarehouse()
    {
        return view('vwAllPlan.POutsidewarehouse.vw_creat_outsidewarehouse_plan');
    }
    public function detailPOutsidewarehouse()
    {
        return view('vwAllPlan.POutsidewarehouse.vw_detail_outsidewarehouse_plan');
    }

    public function PInsidewarehouse()
    {
        return view('vwAllPlan.PInsidewarehouse.vw_insidewarehouse_plan');
    }
    public function createPInsidewarehouse()
    {
        return view('vwAllPlan.PInsidewarehouse.vw_creat_insidewarehouse_plan');
    }
    public function detailPInsidewarehouse()
    {
        return view('vwAllPlan.PInsidewarehouse.vw_detail_insidewarehouse_plan');
    }




    public function equipment()
    {
        return view('vw_equipment');
    }

    public function FinancialReport()
    {
        return view('vw_financial-report');
    }
    public function AdministrationReport()
    {
        return view('vw_administration_report');
    }
    public function NursingReport()
    {
        return view('vw_nursing_report');
    }
    public function SecondaryReport()
    {
        return view('vw_secondary_report');
    }
    public function PrimaryReport()
    {
        return view('vw_primary_report');
    }
    public function SupportingReport()
    {
        return view('vw_supporting_report');
    }
    public function ApprovedItems()
    {
        return view('vw_approved_items');
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
