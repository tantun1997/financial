<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    MainPageController,
    AdministratorController,
    ErrorController,
    PDFController,
};

use App\Http\Middleware\isAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', [MainPageController::class, 'index'])->name('index');
Route::middleware(['auth'])->group(function () {

    Route::prefix('action_plan')->group(function () {
        Route::get('/', [MainPageController::class, 'actionPlan'])->name('action_plan');
        Route::get('create', [MainPageController::class, 'createActionPlan'])->name('creat_action_plan');
        Route::get('detail', [MainPageController::class, 'detailActionPlan'])->name('detail_action_plan');
    });
    Route::prefix('maintenance_equip')->group(function () {
        Route::get('/', [MainPageController::class, 'maintenanceEquipment'])->name('maintenance_equip');
        Route::get('create', [MainPageController::class, 'createMaintenancePlan'])->name('creat_maintenance');
        Route::get('detail', [MainPageController::class, 'detailMaintenancePlan'])->name('detail_maintenance');
    });

    Route::prefix('repair_equip')->group(function () {
        Route::get('/', [MainPageController::class, 'repairEquipment'])->name('repair_equip');
        Route::get('create', [MainPageController::class, 'createRepairEquipment'])->name('creat_repair');
        Route::get('detail', [MainPageController::class, 'detailRepairEquipment'])->name('detail_repair');
    });

    Route::prefix('contract_services')->group(function () {
        Route::get('/', [MainPageController::class, 'contractServices'])->name('contract_services');
        Route::get('create', [MainPageController::class, 'createContractServices'])->name('creat_contract_services');
        Route::get('detail', [MainPageController::class, 'detailContractServices'])->name('detail_contract_services');
    });

    Route::prefix('calibration')->group(function () {
        Route::get('/', [MainPageController::class, 'calibration'])->name('calibration');
        Route::get('create', [MainPageController::class, 'createCalibration'])->name('creat_calibration');
        Route::get('detail', [MainPageController::class, 'detailCalibration'])->name('detail_calibration');
    });

    Route::prefix('replacement_plan')->group(function () {
        Route::get('/', [MainPageController::class, 'replacementPlan'])->name('replacement_plan');
        Route::get('create', [MainPageController::class, 'createReplacementPlan'])->name('creat_replacement_plan');
        Route::get('detail', [MainPageController::class, 'detailReplacementPlan'])->name('detail_replacement_plan');
    });

    Route::prefix('potential_plan')->group(function () {
        Route::get('/', [MainPageController::class, 'potentialPlan'])->name('potential_plan');
        Route::get('create', [MainPageController::class, 'createPotentialPlan'])->name('creat_potential_plan');
        Route::get('detail', [MainPageController::class, 'detailPotentialPlan'])->name('detail_potential_plan');
    });

    Route::prefix('noserial_plan')->group(function () {
        Route::get('/', [MainPageController::class, 'noserialPlan'])->name('noserial_plan');
        Route::get('create', [MainPageController::class, 'createNoserialPlan'])->name('creat_noserial_plan');
        Route::get('detail', [MainPageController::class, 'detailNoserialPlan'])->name('detail_noserial_plan');
    });

    Route::prefix('POutsidewarehouse')->group(function () {
        Route::get('/', [MainPageController::class, 'POutsidewarehouse'])->name('POutsidewarehouse');
        Route::get('create', [MainPageController::class, 'createPOutsidewarehouse'])->name('creat_outsidewarehouse_plan');
        Route::get('detail', [MainPageController::class, 'detailPOutsidewarehouse'])->name('detail_outsidewarehouse_plan');
    });

    Route::prefix('PInsidewarehouse')->group(function () {
        Route::get('/', [MainPageController::class, 'PInsidewarehouse'])->name('PInsidewarehouse');
        Route::get('create', [MainPageController::class, 'createPInsidewarehouse'])->name('creat_insidewarehouse_plan');
        Route::get('detail', [MainPageController::class, 'detailPInsidewarehouse'])->name('detail_insidewarehouse_plan');
    });




    Route::get('financial_report', [MainPageController::class, 'FinancialReport'])->name('financial_report');

    Route::get('approved_items', [MainPageController::class, 'ApprovedItems'])->name('approved_items');

    Route::prefix('administration_report')->group(function () {
        Route::get('/', [MainPageController::class, 'AdministrationReport'])->name('administration_report');
    });
    Route::prefix('nursing_report')->group(function () {
        Route::get('/', [MainPageController::class, 'NursingReport'])->name('nursing_report');
    });
    Route::prefix('secondary_report')->group(function () {
        Route::get('/', [MainPageController::class, 'SecondaryReport'])->name('secondary_report');
    });
    Route::prefix('primary_report')->group(function () {
        Route::get('/', [MainPageController::class, 'PrimaryReport'])->name('primary_report');
    });
    Route::prefix('supporting_report')->group(function () {
        Route::get('/', [MainPageController::class, 'SupportingReport'])->name('supporting_report');
    });

















    Route::get('equipment', [MainPageController::class, 'equipment'])->name('equipment');

    Route::get('/home', [MainPageController::class, 'home'])->name('home');

    // Generate-PDF Zone
    Route::get('/MaintenancePDF/{id}', [PDFController::class, 'MaintenancePDF'])->name('MaintenancePDF');
    Route::get('/RepairPDF/{id}', [PDFController::class, 'RepairPDF'])->name('RepairPDF');
    Route::get('/ReplacementPDF/{id}', [PDFController::class, 'ReplacementPDF'])->name('ReplacementPDF');
    Route::get('/ContactPDF/{id}', [PDFController::class, 'ContactPdf'])->name('ContactPdf');
    Route::get('/CalibrationPDF/{id}', [PDFController::class, 'CalibrationPdf'])->name('CalibrationPdf');
    Route::get('/PotentialPDF/{id}', [PDFController::class, 'PotentialPDF'])->name('PotentialPDF');
    Route::get('/NoserialPDF/{id}', [PDFController::class, 'NoserialPDF'])->name('NoserialPDF');
    Route::get('/POutsidewarehousePDF/{id}', [PDFController::class, 'POutsidewarehousePDF'])->name('POutsidewarehousePDF');
    Route::get('/PInsidewarehousePDF/{id}', [PDFController::class, 'PInsidewarehousePDF'])->name('PInsidewarehousePDF');

    //Administrator Zone
    Route::prefix('administrator')->middleware(['isAdmin'])->group(function () {
        Route::get('usermanagement', [AdministratorController::class, 'usermanagement'])->name('usermanagement');
        Route::get('deptmanagement', [AdministratorController::class, 'deptmanagement'])->name('deptmanagement');
    });
});


//Error Zone
Route::get('/400', [ErrorController::class, 'page400'])->name('page400');
Route::get('/401', [ErrorController::class, 'page401'])->name('page401');
Route::get('/403', [ErrorController::class, 'page403'])->name('page403');
Route::get('/404', [ErrorController::class, 'page404'])->name('page404');
Route::get('/405', [ErrorController::class, 'page405'])->name('page405');
Route::get('/500', [ErrorController::class, 'page500'])->name('page500');
