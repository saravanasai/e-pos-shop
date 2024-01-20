<?php

use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\Role\RoleController;
use App\Http\Controllers\Api\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
 Authentication API endpoint
*/

Route::group(["prefix" => "auth"], function () {
    Route::post("/login", [AuthController::class, "login"]);
});

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::get("/auth-user", [AuthController::class, "user"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/logout-all-devices", [AuthController::class, "logoutFromAllDevices"]);

    //Users
    Route::apiResource('/user',UserController::class);
    Route::apiResource('/role',RoleController::class);
});
