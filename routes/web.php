<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ZoneLeadersController;
use App\Http\Controllers\ReportsController;

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
    return redirect('/login');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
        Route::get('/zone/{zone}', [DashboardController::class, 'viewZone'])->name('zone.view');
        Route::post('/add/zone', [DashboardController::class, 'addZone'])->name('zone.add');
        Route::put('/edit/zone/{zone}', [DashboardController::class, 'editZone'])->name('zone.edit');
        Route::post('/add/catchment/{zone}', [DashboardController::class, 'addCatchment'])->name('zone.catchment.add');
        Route::put('/edit/catchment', [DashboardController::class, 'editCatchment'])->name('zone.catchment.edit');
        Route::delete('/delete/catchment/{catchment}', [DashboardController::class, 'deleteCatchment'])->name('zone.catchment.delete');
    });
    Route::group(['prefix' => 'leaders', 'as' => 'leaders.'], function () {
        Route::get('/', [ZoneLeadersController::class, 'home'])->name('home');
        Route::post('/save/leader', [ZoneLeadersController::class, 'saveLeader'])->name('save');
        Route::put('/update/leader', [ZoneLeadersController::class, 'updateLeader'])->name('update');
    });
    Route::group(['prefix' => 'members', 'as' => 'members.'], function () {
        Route::get('/', [MembersController::class, 'home'])->name('home');
        Route::get('/add/member', [MembersController::class, 'addMember'])->name('add');
        Route::post('/save/member', [MembersController::class, 'saveMember'])->name('save');
        Route::get('/edit/member/{member}', [MembersController::class, 'editMember'])->name('edit');
        Route::post('/update/member/{member}', [MembersController::class, 'updateMember'])->name('update');
        Route::post('/import/members', [MembersController::class, 'importMembers'])->name('import');
    });
    Route::group(['prefix' => 'visitors', 'as' => 'visitors.'], function () {
        Route::get('/', [MembersController::class, 'homeVisitors'])->name('home');
        Route::get('/log/attendance/{visitor}', [MembersController::class, 'logAttendance'])->name('log.attendance');
        Route::get('/log/attendance/{visitor}/add/member', [MembersController::class, 'logAttendanceAddMember'])->name('log.attendance.add.member');
        Route::get('/add/visitor', [MembersController::class, 'addVisitor'])->name('add');
        Route::post('/save/visitor', [MembersController::class, 'saveVisitor'])->name('save');
        Route::get('/edit/visitor/{visitor}', [MembersController::class, 'editVisitor'])->name('edit');
        Route::post('/update/visitor/{visitor}', [MembersController::class, 'updateVisitor'])->name('update');
    });
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('',[ReportsController::class, 'home'])->name('home');
        Route::get('add',[ReportsController::class, 'addReport'])->name('add');
        Route::post('save',[ReportsController::class, 'saveReport'])->name('save');
        Route::get('edit/{report}',[ReportsController::class, 'editReport'])->name('edit');
        Route::post('update/{report}',[ReportsController::class, 'updateReport'])->name('update');
        Route::get('view/{report}',[ReportsController::class, 'viewReport'])->name('view');
        Route::get('reviewed/{report}',[ReportsController::class, 'reviewedReport'])->name('reviewed');
    });
});

require __DIR__.'/auth.php';
