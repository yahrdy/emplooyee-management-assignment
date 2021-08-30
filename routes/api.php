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

Route::post('register',[\App\Http\Controllers\Auth\AuthController::class,'register'])->name('register');
Route::post('login',[\App\Http\Controllers\Auth\AuthController::class,'login'])->name('login');
Route::get('logout',[\App\Http\Controllers\Auth\AuthController::class,'logout']);

Route::middleware('auth:api')->group(function (){
    Route::get('user',[\App\Http\Controllers\Auth\AuthController::class,'user']);
    Route::apiResource('employees',\App\Http\Controllers\Bogsoft\EmployeeController::class);
    Route::apiResource('companies',\App\Http\Controllers\Bogsoft\CompanyController::class);
    Route::apiResource('departments',\App\Http\Controllers\Bogsoft\DepartmentController::class);
});
