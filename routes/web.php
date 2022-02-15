<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//admin
Route::prefix('/')->middleware(['super-admin'])->group(function(){
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('add-new-user', [App\Http\Controllers\AccountsController::class, 'addUser'])->name('add-new-user');
    Route::post('add-new-user', [App\Http\Controllers\AccountsController::class, 'createNewUser'])->name('add-new-user.submit');

    Route::get('unit-manager-account', [App\Http\Controllers\AccountsController::class, 'unitManager'])->name('unit-manager-account');
    Route::post('unit-manager-account', [App\Http\Controllers\AccountsController::class, 'createUnitManager'])->name('unit-manager-account.submit');
    Route::get('dc-manager-account', [App\Http\Controllers\AccountsController::class, 'dcManager'])->name('dc-manager-account');
    Route::post('dc-manager-account', [App\Http\Controllers\AccountsController::class, 'createDcManager'])->name('dc-manager-account.submit');
    Route::get('inf-manager-account', [App\Http\Controllers\AccountsController::class, 'infManager'])->name('inf-manager-account');
    Route::post('inf-manager-account', [App\Http\Controllers\AccountsController::class, 'createInfManager'])->name('inf-manager-account.submit');
    Route::get('dc-admin-account', [App\Http\Controllers\AccountsController::class, 'dcAdmin'])->name('dc-admin-account');
    Route::post('dc-admin-account', [App\Http\Controllers\AccountsController::class, 'createDcAdmin'])->name('dc-admin-account.submit');
    Route::get('dc-reception-account', [App\Http\Controllers\AccountsController::class, 'dcReception'])->name('dc-reception-account');
    Route::post('dc-reception-account', [App\Http\Controllers\AccountsController::class, 'createDcReception'])->name('dc-reception-account.submit');
    Route::get('reset-password', [App\Http\Controllers\ManageAccountsController::class, 'resetPassword'])->name('reset-password');
    Route::post('reset-password/reset', [App\Http\Controllers\ManageAccountsController::class, 'reset'])->name('reset-password.reset');
    Route::get('remove-account', [App\Http\Controllers\ManageAccountsController::class, 'removeAccount'])->name('remove-account');
    Route::post('suspend-account', [App\Http\Controllers\ManageAccountsController::class, 'suspendAccount'])->name('admin.suspend-account');
    Route::post('restore-account', [App\Http\Controllers\ManageAccountsController::class, 'restoreAccount'])->name('admin.restore-account');
    Route::get('profile', [App\Http\Controllers\AdminController::class, 'myProfile'])->name('admin.profile');
    Route::get('manage-datacentres', [App\Http\Controllers\AdminController::class, 'manageDataCentre'])->name('manage-datacentres');
    Route::post('change-password', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('change-password');
});

//unit manager
Route::prefix('/unit-manager')->middleware(['unit-manager'])->group(function(){
    Route::get('/request-form-is', [App\Http\Controllers\UnitManagerController::class, 'requestForm'])->name('request-form-is');
    Route::get('/request-form-is{requestno}', [App\Http\Controllers\UnitManagerController::class, 'requestForm2'])->name('request-form-is2');
    Route::get('/all-requests', [App\Http\Controllers\UnitManagerController::class, 'requests'])->name('all-requests');
    Route::post('/request-form-is', [App\Http\Controllers\UnitManagerController::class, 'store'])->name('request-form-is.store');
    Route::post('/request-form-next', [App\Http\Controllers\UnitManagerController::class, 'nextStore'])->name('request-form-is.nextStore');
    Route::get('/all-requests/{requestno}', [App\Http\Controllers\UnitManagerController::class, 'requestDetails'])->name('request-details');
    Route::post('/request-revoke', [App\Http\Controllers\UnitManagerController::class, 'revokeRequest'])->name('unit-manager.revoke-request');
    Route::post('/request-remove', [App\Http\Controllers\UnitManagerController::class, 'removeRequest'])->name('unit-manager.remove-request');
    Route::get('/my-profile', [App\Http\Controllers\UnitManagerController::class, 'showProfile'])->name('unit-manager.my-profile');
    Route::post('/change-password', [App\Http\Controllers\UnitManagerController::class, 'changePassword'])->name('unit-manager.change-password');
});

//dc manager
Route::prefix('/dc-manager')->middleware(['dc-manager'])->group(function(){
    Route::get('/index', [App\Http\Controllers\DCManagerController::class, 'index'])->name('dc-manager.index');
    Route::get('/request-form-dc', [App\Http\Controllers\DCManagerController::class, 'requestForm'])->name('request-form-dc');
    Route::get('/request-form-dc{requestno}', [App\Http\Controllers\DCManagerController::class, 'requestForm2'])->name('request-form-dc2');
    Route::post('/request-form-dc', [App\Http\Controllers\DCManagerController::class, 'store'])->name('request-form-dc.store');
    Route::post('/request-form-dc-next', [App\Http\Controllers\DCManagerController::class, 'nextStore'])->name('request-form-dc.nextStore');
    Route::get('/all-requests', [App\Http\Controllers\DCManagerController::class, 'requests'])->name('all-requests-dc-man');
    Route::get('/all-requests/{requestno}', [App\Http\Controllers\DCManagerController::class, 'requestDetails'])->name('dc-request-details');
    Route::post('/all-requests/confirm', [App\Http\Controllers\DCManagerController::class, 'confirmRequest'])->name('dc-manager.confirm-requests');
    Route::post('/request-revoke', [App\Http\Controllers\DCManagerController::class, 'revokeRequest'])->name('dc-manager.revoke-request');
    Route::post('/all-requests/deny', [App\Http\Controllers\DCManagerController::class, 'denyRequest'])->name('dc-manager.deny-requests');
    Route::get('/visit-report', [App\Http\Controllers\DCManagerController::class, 'visitReport'])->name('visit-report');
    Route::get('/my-profile', [App\Http\Controllers\DCManagerController::class, 'showProfile'])->name('dc-manager.my-profile');
    Route::post('/change-password', [App\Http\Controllers\DCManagerController::class, 'changePassword'])->name('dc-manager.change-password');
});

//inf director
Route::prefix('/inf-director')->middleware(['inf-director'])->group(function(){
    Route::get('/index', [App\Http\Controllers\InfDirectorController::class, 'index'])->name('inf-director.index');
    Route::get('/request-form-inf', [App\Http\Controllers\InfDirectorController::class, 'requestForm'])->name('request-form-inf');
    Route::get('/requests-confirmed', [App\Http\Controllers\InfDirectorController::class, 'requests'])->name('requests-confirmed');
    Route::get('/permanent-visitors', [App\Http\Controllers\InfDirectorController::class, 'permanentVisitors'])->name('permanent-visitors');
    Route::get('/confirmed-requests/{requestno}', [App\Http\Controllers\InfDirectorController::class, 'requestDetails'])->name('inf-request-details');
    Route::post('/confirmed-requests/approve', [App\Http\Controllers\InfDirectorController::class, 'approveRequest'])->name('inf-director.approve-requests');
    Route::post('/confirmed-requests/reject', [App\Http\Controllers\InfDirectorController::class, 'rejectRequest'])->name('inf-manager.reject-requests');
    Route::get('/my-profile', [App\Http\Controllers\InfDirectorController::class, 'showProfile'])->name('inf-director.my-profile');
    Route::post('/change-password', [App\Http\Controllers\InfDirectorController::class, 'changePassword'])->name('inf-director.change-password');
});

//dc admin
Route::prefix('/dc-admin')->middleware(['dc-admin'])->group(function(){
    Route::get('/approved-requests', [App\Http\Controllers\DCAdminsController::class, 'requests'])->name('approved-requests');
    Route::get('/request-form-dc-admin', [App\Http\Controllers\DCAdminsController::class, 'requestForm'])->name('request-form-dc-admin');
    Route::get('/all-requests/{requestno}', [App\Http\Controllers\DCAdminsController::class, 'requestDetails'])->name('dc-admin-request-details');
    Route::get('/track-requests/{requestno}', [App\Http\Controllers\DCAdminsController::class, 'trackRequest'])->name('track-request');
    Route::post('track-request/track', [App\Http\Controllers\DCAdminsController::class, 'track'])->name('track');
    Route::get('/reception-screen', [App\Http\Controllers\DCAdminsController::class, 'screen'])->name('reception-screen');
    Route::get('/my-profile', [App\Http\Controllers\DCAdminsController::class, 'showProfile'])->name('dc-admin.my-profile');
    Route::post('/update-profile', [App\Http\Controllers\DCAdminsController::class, 'updateProfile'])->name('dc-admin.update-profile');
    Route::post('/update-check', [App\Http\Controllers\DCAdminsController::class, 'updateTrackCheck'])->name('dc-admin.update-check');
    Route::post('change-password', [App\Http\Controllers\DCAdminsController::class, 'changePassword'])->name('dc-admin.change-password');
});

//dc reception
Route::prefix('/dc-reception')->middleware(['dc-reception'])->group(function(){
    Route::get('/approved-requests', [App\Http\Controllers\DCReceptionController::class, 'requests'])->name('dc-reception.approved-requests');
    Route::get('/all-requests/{requestno}', [App\Http\Controllers\DCReceptionController::class, 'requestDetails'])->name('dc-reception-request-details');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
