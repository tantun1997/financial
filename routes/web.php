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
    Route::get('/equipment', [MainPageController::class, 'equipment'])->name('equipment');
    Route::get('maintenance_equip', [MainPageController::class, 'maintenanceEquipment'])->name('maintenance_equip');
    Route::get('repair_equip', [MainPageController::class, 'repairEquipment'])->name('repair_equip');
    Route::get('contract_services', [MainPageController::class, 'contractServices'])->name('contract_services');
    Route::get('approval_plans', [MainPageController::class, 'approvalPlans'])->name('approval_plans');

    Route::get('/home', [MainPageController::class, 'home'])->name('home');
    // Generate-PDF Zone
    Route::get('/generatePdf/{id}', [PDFController::class, 'generateProcurement'])->name('generateProcurement');
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