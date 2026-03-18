<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TenantController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/tenants', [TenantController::class,'index'])->name('index');
// Route::post('/tenant/create', [TenantController::class,'store'])->name('store');

// Route::post('/tenant/create', function () {
//     return 'POST HIT';
// });

// Tenant — resolved by domain automatically
// Route::middleware('needs-tenant')->group(function () {
//     Route::get('/whoami', [TenantController::class, 'whoami']);
// });