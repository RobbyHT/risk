<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

/*Route::get('/', function () {
    return view('app');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/modal', function(Request $request) {
    return view('modal_test');
});

Route::inertia('/', 'pages/home');
//--------------------風險評估--------------------
Route::inertia('/risk', 'pages/risk/risk');
Route::inertia('/risk/description', 'pages/risk/risk_description');
//FMEA
Route::inertia('/risk/FMEA', 'pages/risk/risk_FMEA');
Route::get('/risk/FMEA/detail/{id}', function(Request $request) {
    return inertia('pages/risk/risk_FMEA_detail', ['id' => $request->id]);
});
Route::get('/risk/FMEA/edit/{id}', function(Request $request) {
    return inertia('pages/risk/risk_FMEA_edit', ['id' => $request->id]);
});
//HAZOP
Route::inertia('/risk/HAZOP', 'pages/risk/risk_HAZOP');
Route::get('/risk/HAZOP/detail/{id}', function(Request $request) {
    return inertia('pages/risk/risk_HAZOP_detail', ['id' => $request->id]);
});
Route::get('/risk/HAZOP/edit/{id}', function(Request $request) {
    return inertia('pages/risk/risk_HAZOP_edit', ['id' => $request->id]);
});
//What-If
Route::inertia('/risk/WhatIf', 'pages/risk/risk_WhatIf');
Route::get('/risk/WhatIf/detail/{id}', function(Request $request) {
    return inertia('pages/risk/risk_WhatIf_detail', ['id' => $request->id]);
});
Route::get('/risk/WhatIf/edit/{id}', function(Request $request) {
    return inertia('pages/risk/risk_WhatIf_edit', ['id' => $request->id]);
});
//JSA
Route::inertia('/risk/JSA', 'pages/risk/risk_JSA');
Route::get('/risk/JSA/detail/{id}', function(Request $request) {
    return inertia('pages/risk/risk_JSA_detail', ['id' => $request->id]);
});
Route::get('/risk/JSA/edit/{id}', function(Request $request) {
    return inertia('pages/risk/risk_JSA_edit', ['id' => $request->id]);
});

//--------------------智慧巡檢--------------------
//區域管理
Route::inertia('/device/region', 'pages/exam/device_region');
Route::inertia('/device/manage', 'pages/exam/device_manage');
Route::inertia('/device/manage/add', 'pages/exam/device_edit');
Route::get('/device/manage/edit/{id}', function(Request $request) {
    return inertia('pages/exam/device_edit', ['id' => $request->id]);
});
