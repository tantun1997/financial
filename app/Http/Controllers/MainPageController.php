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
        return view('vw_maintenance-plan');
    }
    public function repairEquipment()
    {
        return view('vw_repair-equipment');
    }

    public function equipment()
    {
        return view('vw_equipment');
    }
    public function contractServices()
    {
        return view('vw_contract-services');
    }
    public function approvalPlans()
    {
        return view('vw_approval-plans');
    }

}