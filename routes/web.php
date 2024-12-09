<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/reports');
Route::group(['middleware' => [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')]], function() {
    // Routes that require the "admin" role
    Route::group(['middleware' => 'role:admin'], function () {
        // User
        Route::resource('users', UserController::class)->only([
            'index', 'update', 'edit', 'destroy'
        ]);;
        Route::post('/users/search', [UserController::class, 'search'])->name('users.search');
    });
    Route::get('/about', function () {
        return view('about');
    })->name('about');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::resource('reports', ReportController::class);

});
