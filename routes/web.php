<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\NetpingApiController;
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
Route::get('/', function () {
    if(Auth::check()) {
        return redirect('/netping');
    } else {
        return view('auth.login');
    }
})->name('enter');
Route::group(['middleware' => 'auth'], function () {
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/netping', [MainController::class, 'index'])->name('home');

});

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {
    Route::get('/power/{id}', [NetpingApiController::class, 'get_power_data']);
    Route::get('/secure/{id}', [NetpingApiController::class, 'get_netping_data']);
    Route::get('/door/{id}', [NetpingApiController::class, 'get_door_data']);
    Route::get('/alarm/{id}', [NetpingApiController::class, 'get_alarm_data']);
    Route::get('/alarm/set/{id}', [NetpingApiController::class, 'set_alarm']);

    });
Auth::routes();
