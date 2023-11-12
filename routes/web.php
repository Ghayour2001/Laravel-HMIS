<?php

use App\Http\Controllers\auth\BedController;
use App\Http\Controllers\auth\BedgroupController;
use App\Http\Controllers\auth\BedstatusController;
use App\Http\Controllers\auth\BedtypeController;
use App\Http\Controllers\auth\DepartmentController;
use App\Http\Controllers\auth\FloorController;
use App\Http\Controllers\auth\InsuranceController;
use App\Http\Controllers\auth\IpdController;
use App\Http\Controllers\auth\PageController;
use App\Http\Controllers\auth\PatientController;
use App\Http\Controllers\auth\PositionController;
use App\Http\Controllers\auth\SymptomController;
use App\Http\Controllers\auth\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/auth', function () {
    return view('layouts.auth');
});
Route::get('/dashboard', function () {
    return view('auth.dashboard');
});

/*patient routes*/
Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
Route::get('/fetchalldoctors', [PatientController::class, 'fetchalldoctors'])->name('fetchalldoctors');
Route::get('/fetchalldepartments', [PatientController::class, 'fetchalldepartments'])->name('fetchalldepartments');
Route::post('/patient', [PatientController::class, 'store'])->name('patient.store');
Route::get('/patient/{id}/show', [PatientController::class, 'show'])->name('patient.show');
Route::get('/patient/{id}/edit', [PatientController::class, 'edit'])->name('patient.edit');
Route::post('/patient/{id}/delete', [PatientController::class, 'delete'])->name('patient.delete');
Route::post('/patient/update', [PatientController::class, 'update'])->name('patient.update');
Route::get('/fetchallinsurances', [PatientController::class, 'fetchallinsurances'])->name('fetchallinsurances');
Route::get('/fetchAllSymptoms', [PatientController::class, 'fetchAllSymptoms'])->name('fetchAllSymptoms');
Route::get('/fetchSymptomDescription', [PatientController::class, 'fetchSymptomDescription'])->name('fetchSymptomDescription');
/*employee routes*/
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/show', [UserController::class, 'show'])->name('user.show');
Route::post('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/fetchemployeedepartments', [UserController::class, 'fetchAllDepartments'])->name('fetchemployeedepartments');
Route::get('/fetchuserpositions', [UserController::class, 'fetchuserpositions'])->name('fetchuserpositions');
// Departments route start
Route::get('department', [DepartmentController::class, 'index'])->name('department.index');
Route::post('department', [DepartmentController::class, 'store'])->name('department.store');
Route::post('getDepartments', [DepartmentController::class, 'getDepartments'])->name('getDepartments');
Route::post('updateDepartment', [DepartmentController::class, 'updateDepartment'])->name('updateDepartment');
Route::post('deleteDepartment', [DepartmentController::class, 'deleteDepartment'])->name('deleteDepartment');
Route::get('getData', [DepartmentController::class, 'getData'])->name('getData');
Route::get('fetchdepartment', [DepartmentController::class, 'fetchdepartment'])->name('fetchdepartment');
Route::get('deleteDepartment', [DepartmentController::class, 'deleteDepartment'])->name('deleteDepartment');
Route::put('/department/update-status/{department}', [DepartmentController::class, 'updateDepartmentStatus'])
    ->name('department.update.status');
// Departments route  end
// Position route start
Route::get('position', [PositionController::class, 'index'])->name('position.index');
Route::post('position', [PositionController::class, 'store'])->name('position.store');
Route::get('fetchposition', [PositionController::class, 'fetchposition'])->name('fetchposition');
Route::get('/position/{id}/edit', [PositionController::class, 'edit'])->name('position.edit');
Route::post('/position/update', [PositionController::class, 'updatePosition'])->name('updatePosition');
Route::post('position/delete', [PositionController::class, 'deletePosition'])->name('position.delete');
Route::put('/position/update-active/{id}', [PositionController::class, 'updateActive'])->name('position.update.active');
// Positions route  end

//bed-group
// // Route::view('menu','auth.bedsetup.asidebar');
// Route::get('/bed', [PageController::class, 'index']);

//floor route starte//
Route::get('floor', [FloorController::class, 'index'])->name('floor.index');
Route::post('floor', [FloorController::class, 'store'])->name('floor.store');
Route::get('/floor/{id}/edit', [FloorController::class, 'edit'])->name('floor.edit');
Route::post('/floor/update', [FloorController::class, 'update'])->name('floor.update');
Route::post('/floor/{id}/delete', [FloorController::class, 'delete'])->name('floor.delete');

//bedgroup route start//
Route::get('/fetchallfloors', [BedgroupController::class, 'fetchallfloors'])->name('fetchallfloors');
Route::get('bedgroup', [BedgroupController::class, 'index'])->name('bedgroup.index');
Route::post('/bedgroup', [BedgroupController::class, 'store'])->name('bedgroup.store');
Route::get('/bedgroup/{id}/edit', [BedgroupController::class, 'edit'])->name('bedgroup.edit');
Route::post('/bedgroup/update', [BedgroupController::class, 'update'])->name('bedgroup.update');
Route::post('/bedgroup/{id}/delete', [BedgroupController::class, 'delete'])->name('bedgroup.delete');
//bedttype route start//
Route::get('bedtype', [BedtypeController::class, 'index'])->name('bedtype.index');
Route::post('/bedtype', [BedtypeController::class, 'store'])->name('bedtype.store');
Route::get('/bedtype/{id}/edit', [BedtypeController::class, 'edit'])->name('bedtype.edit');
Route::post('/bedtype/update', [BedtypeController::class, 'update'])->name('bedtype.update');
Route::post('/bedtype/{id}/delete', [BedtypeController::class, 'delete'])->name('bedtype.delete');
//bed route start//
Route::get('/fetchallbedtypes', [BedController::class, 'fetchallbedtypes'])->name('fetchallbedtypes');
Route::get('/fetchallbedgroups', [BedController::class, 'fetchallbedgroups'])->name('fetchallbedgroups');
Route::post('/bed', [BedController::class, 'store'])->name('bed.store');
Route::get('bed', [BedController::class, 'index'])->name('bed.index');
Route::get('/bed/{id}/edit', [BedController::class, 'edit'])->name('bed.edit');
Route::post('/bed/update', [BedController::class, 'update'])->name('bed.update');
Route::post('/bed/{id}/delete', [BedController::class, 'delete'])->name('bed.delete');
Route::post('/bed/{id}/status', [BedController::class, 'status'])->name('bed.status');
Route::get('/getallbeds', [BedController::class, 'getallbeds'])->name('getallbeds');
//bedstatus route//
Route::get('/bedstatus', [BedstatusController::class, 'index'])->name('bedstatus.index');
// Insurance  route  start
Route::get('/insurance', [InsuranceController::class, 'index'])->name('insurance.index');
Route::post('/insurance', [InsuranceController::class, 'store'])->name('insurance.store');
Route::get('/insurance/{id}/show', [InsuranceController::class, 'show'])->name('insurance.show');
Route::post('/insurance/update', [InsuranceController::class, 'updateInsurance'])->name('insurance.update');
Route::post('/insurance/{id}/delete', [InsuranceController::class, 'deleteinsurance'])->name('insurance.delete');
// Insurance  route  End
// symptoms  route  start
Route::get('/symptom', [SymptomController::class, 'index'])->name('symptom.index');
Route::post('/symptom', [SymptomController::class, 'store'])->name('symptom.store');
Route::get('/symptom/{id}/show', [SymptomController::class, 'show'])->name('symptom.show');
Route::post('/symptom/update', [SymptomController::class, 'update'])->name('symptom.update');
Route::post('/symptom/{id}/delete', [SymptomController::class, 'delete'])->name('symptom.delete');
// symptoms  route  End
// IPD  route  Start
Route::get('/ipd', [IpdController::class, 'index'])->name('ipd.index');
Route::get('/fetchAlldoctor', [IpdController::class, 'fetchAlldoctor'])->name('fetchAlldoctor');
Route::get('/fetchAllInsurances', [IpdController::class, 'fetchAllInsurances'])->name('fetchAllInsurances');

Route::get('/fetchAllSymptoms', [IpdController::class, 'fetchAllSymptoms'])->name('fetchAllSymptoms');
Route::get('/fetchSymptomDescription', [IpdController::class, 'fetchSymptomDescription'])->name('fetchSymptomDescription');
Route::get('/fetchAlldepartment', [IpdController::class, 'fetchAlldepartment'])->name('fetchAlldepartment');
Route::post('/ipd', [IpdController::class, 'store'])->name('ipd.store');
Route::get('/fetchbedgroups', [IpdController::class, 'fetchbedgroups'])->name('fetchbedgroups');
Route::get('/fetchbednumbers', [IpdController::class, 'fetchbednumbers'])->name('fetchbednumbers');
Route::post('/ipd/{id}/delete', [IpdController::class, 'delete'])->name('ipd.delete');
Route::get('/ipd/{id}/show', [IpdController::class, 'show'])->name('ipd.show');
Route::get('/ipd/{id}/edit', [IpdController::class, 'edit'])->name('ipd.edit');
Route::post('/ipd/update', [IpdController::class, 'update'])->name('ipd.update');
