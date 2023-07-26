<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\EmployeeController;

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


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'as' => 'api.'], function(){
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('companies', CompanyController::class);
    Route::get('companies/{company_id}/employees', [CompanyController::class, 'getEmployees']);
});

