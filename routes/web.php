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

    Route::prefix('purchasing_plan')->group(function () {
        Route::get('/', [MainPageController::class, 'purchasingPlan'])->name('purchasing_plan');
        Route::get('create', [MainPageController::class, 'createPurchasingPlan'])->name('creat_purchasing_plan');
        Route::get('detail', [MainPageController::class, 'detailpurchasingPlan'])->name('detail_purchasing_plan');
    });

    Route::get('equipment', [MainPageController::class, 'equipment'])->name('equipment');
    Route::get('approval_plans', [MainPageController::class, 'approvalPlans'])->name('approval_plans');

    Route::get('/home', [MainPageController::class, 'home'])->name('home');

    // Generate-PDF Zone
    Route::get('/generatePdf/{id}', [PDFController::class, 'generateProcurement'])->name('generateProcurement');
    Route::get('/contactPdf/{id}', [PDFController::class, 'generateContactService']);
    Route::get('/replaceEquipPdf/{id}', [PDFController::class, 'generateReplaceEquip']);
    Route::get('/replaceEquipPdf2/{id}', [PDFController::class, 'generateReplaceEquip2']);
    Route::get('/actionPlanPdf/{id}', [PDFController::class, 'generateActionPlan'])->name('actionPlanPdf');

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
