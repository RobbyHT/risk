<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::post('login', 'App\Http\Controllers\app\AppController@login');

//Route::get('verify', 'App\Http\Controllers\app\AppController@verify');

//Route::post('logout', 'App\Http\Controllers\app\AppController@logout');

/* 今日所有巡檢項目 */
//Route::get('projects/today', 'App\Http\Controllers\app\AppDataController@today_projects');

/* 該日所有巡檢項目 */
//Route::get('projects/daily/{date}', 'App\Http\Controllers\app\AppDataController@daily_projects');

/* 一份 project 所有完整內容 */
//Route::get('project/download/{project_id}/date/{date_id}', 'App\Http\Controllers\app\AppDataController@project');

//Route::post('sheet/upload/', 'App\Http\Controllers\app\AppSheetController@upload');

//Route::get('sheet/download/{sheet_id}', 'App\Http\Controllers\app\AppSheetController@sheet');

//Route::get('sheets/history', 'App\Http\Controllers\app\AppSheetController@history');

//-----------------------------------------------------------------------------------------------------------------------

Route::post('login', [App\Http\Controllers\app\AppController::class, 'login']);

Route::get('verify', [App\Http\Controllers\app\AppController::class, 'verify']);

Route::post('logout', [App\Http\Controllers\app\AppController::class, 'logout']);

/* 今日所有巡檢項目 */
Route::get('projects/today', [App\Http\Controllers\app\AppDataController::class, 'today_projects']);

/* 該日所有巡檢項目 */
Route::get('projects/daily/{date}', [App\Http\Controllers\app\AppDataController::class, 'daily_projects']);

/* 一份 project 所有完整內容 */
Route::get('project/download/{project_id}/date/{date_id}', [App\Http\Controllers\app\AppDataController::class, 'project']);

Route::post('sheet/upload/', [App\Http\Controllers\app\AppSheetController::class, 'upload']);

Route::get('sheet/download/{sheet_id}', [App\Http\Controllers\app\AppSheetController::class, 'sheet']);

Route::get('sheets/history', [App\Http\Controllers\app\AppSheetController::class, 'history']);