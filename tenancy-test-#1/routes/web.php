<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TenantController;

Route::get('/home', function () {
    return view('welcome');
});

// Plans
Route::get('/plans', [PlanController::class, 'index']);
Route::post('/plans/{plan}/avail', [PlanController::class, 'avail']);

// Check all tenants
Route::get('/tenants', [TenantController::class, 'index']);