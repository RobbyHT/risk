<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RiskFmeaDeviceController;
use App\Http\Controllers\api\RiskFmeaSubDeviceController;
use App\Http\Controllers\api\RiskHazopDeviceController;
use App\Http\Controllers\api\RiskHazopSubDeviceController;
use App\Http\Controllers\api\RiskWhatIfDeviceController;
use App\Http\Controllers\api\RiskWhatIfSubDeviceController;
use App\Http\Controllers\api\RiskJsaDeviceController;
use App\Http\Controllers\api\RiskJsaMainTitleController;
use App\Http\Controllers\api\DeviceRegionController;
use App\Http\Controllers\api\DeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//--------------------風險評估--------------------
//FMEA
Route::ApiResource('/FMEA/device', RiskFmeaDeviceController::class);
Route::ApiResource('/FMEA/subDevice', RiskFmeaSubDeviceController::class);
//HAZOP
Route::ApiResource('/HAZOP/device', RiskHazopDeviceController::class);
Route::ApiResource('/HAZOP/subDevice', RiskHazopSubDeviceController::class);
//What-If
Route::ApiResource('/WhatIf/device', RiskWhatIfDeviceController::class);
Route::ApiResource('/WhatIf/subDevice', RiskWhatIfSubDeviceController::class);
//JSA
Route::ApiResource('/JSA/device', RiskJsaDeviceController::class);
Route::ApiResource('/JSA/subDevice', RiskJsaMainTitleController::class);

//--------------------智慧巡檢--------------------
//區域管理
Route::ApiResource('/device/region', DeviceRegionController::class);
Route::ApiResource('/device', DeviceController::class);