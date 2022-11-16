<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\OvertimeController;
use App\Http\Controllers\Api\SettingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::patch('/settings/{setting}', [SettingController::class])
    ->name('settings.update');

Route::post('/employee', [EmployeeController::class])
    ->name('employee.store');

Route::post('/overtimes', [OvertimeController::class, 'store'])
    ->name('overtimes.store');
Route::get('/overtime-pays/calculate', [OvertimeController::class, 'overtimeCalculate'])
    ->name('overtime.calculate');
