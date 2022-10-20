<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PersonnelController;
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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/import', 'ImportController@index');
    Route::post('/manager-import', 'ImportController@managerImport');
    Route::post('/personnel-import', 'ImportController@personnelImport');

    Route::get('/qrCodesUsers', 'QrController@users');
    Route::get('/scan', 'QrController@scan');
    Route::get('/scanCheck/{id}', 'QrController@scanCheck');

    Route::get('/', [AttendanceController::class, 'index']);
    Route::get('/attendance', [AttendanceController::class, 'store']);
    Route::post('/attendance/inquiry', [AttendanceController::class, 'inquiry']);
    Route::post('/attendance/{presence}/edit', [AttendanceController::class, 'editPresence']);
    Route::get('/attendance/delete/{id}', [AttendanceController::class, 'delete']);

    Route::get('/personnel/create', [PersonnelController::class, 'create']);
    Route::post('/personnel/store', [PersonnelController::class, 'store']);
    Route::get('/personnel/{personnel}/edit', [PersonnelController::class, 'edit']);
    Route::post('/personnel/{personnel}/update', [PersonnelController::class, 'update']);
    Route::get('/personnel', [PersonnelController::class, 'list']);
    Route::get('/personnel/cart/{id}', [PersonnelController::class, 'cart']);
    Route::get('/personnel/destroy/{id}', [PersonnelController::class, 'destroy']);

    Route::get('/reportDetail', 'ReportController@detail');
    Route::get('/reportDetail/export', 'ReportController@detailExport');
    Route::get('/reportAll', 'ReportController@all');
    Route::get('/reportAll/export', 'ReportController@allExport');


    Route::get('/reportUsers', 'ReportController@reportUsers');
    Route::get('/profile', 'HomeController@profile');
    Route::get('/profile/password/{id}', 'HomeController@password');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
