<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\NetpingApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTableController;
use App\Http\Controllers\Api\CameraController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ArtisanController;
use Illuminate\Support\Facades\Artisan;
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

/* logout from app */
Route::get('/logout', [LoginController::class, 'logout']);

/* main page (redirects after login) */
Route::get('/netping', [MainController::class, 'index'])->name('home');

/* user profile route */
Route::get('profile', [UserController::class, 'index'])->name('profile');

/* update user info via ajax */
Route::post('profile/update_user_info', [UserController::class, 'updateUserInfo']);
});

/* BDCOM temeratures graphs */

Route::view('/graphs', 'graphs.graphs')->name('bdcom.graphs');

Route::group(['middleware' => 'is_admin', 'prefix' => 'dashboard'], function () {
/*
 * Netping block
 *
*/

/* add new netping point */
Route::get('/netping/add', [MainController::class, 'netpingAddPage'])->name('netping_add_page');

/*edit netping point */
Route::get('/netping/edit/{id}', [MainController::class, 'netpingEditPage'])->name('netping_edit_page');

/*edit netping point - POST*/
Route::post('/netping/edit/{id}/update', [MainController::class, 'netpingEditPoint'])->name('netping_edit_point');

/* add new netping to database */
Route::post('/netping/add/insert', [MainController::class, 'netpingAddPoint'])->name('netping_add_point');

/*
 * User block
 *
*/

/* users table page */
Route::get('/users', [UserTableController::class, 'index'])->name('users');

/* add new user page*/
Route::get('/user/add', [UserTableController::class, 'addUser'])->name('add_user');

/*add new user to DB - POST */
Route::post('/user/add/insert', [UserTableController::class, 'addUserToDB'])->name('store_user');

/*change ability to offer email after netping point changin' status via ajax*/
Route::get('/user/changeNotify/{id}', [UserTableController::class, 'changeNotify']);

/* user edit page */
Route::get('/user/{id}', [UserTableController::class, 'changeUser'])->name('edit_user_page');

/* update user info - POST */
Route::post('/user/{id}/update', [UserTableController::class, 'updateUser'])->name('update_user_info');

/*
 * Actions block
 *
 *
*/

/* actions page */
Route::get('/actions', [ActionController::class, 'index'])->name('actions');

/* add action page */
Route::get('/action/add', [ActionController::class, 'addActionPage'])->name('add_action');

/* add action POST */
Route::post('/action/insert', [ActionController::class, 'addAction'])->name('store_action');

/* edit action page */
Route::get('/action/{id}', [ActionController::class, 'editActionPage'])->name('edit_action');

/* edit action POST */
Route::post('/action/{id}/edit', [ActionController::class, 'editAction'])->name('update_action');

/*
 * Logs block
 *
 *
*/
Route::get('logs', [LogController::class, 'index'])->name('logs');

/*
 * Artisan block
 *
 *
*/

/* artisan main page */
Route::get('/artisan', [ArtisanController::class, 'index'])->name('artisan');

/* clear caches via ajax */
Route::get('/artisan/clear', [ArtisanController::class, 'clearCaches']);

/* create simlink via ajax */
Route::get('/artisan/simlink', [ArtisanController::class, 'createSimlink']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {
    Route::get('/power/{id}', [NetpingApiController::class, 'get_power_data']);
    Route::get('/secure/{id}', [NetpingApiController::class, 'get_netping_data']);
    Route::get('/door/{id}', [NetpingApiController::class, 'get_door_data']);
    Route::get('/alarm/{id}', [NetpingApiController::class, 'get_alarm_data']);
    Route::get('/alarm/set/{id}', [NetpingApiController::class, 'set_alarm']);
    Route::get('/netping_camera/{id}', [CameraController::class, 'getCamera']);

    Route::get('/temp/{id}', [\App\Http\Controllers\Api\BdcomController::class, 'getTemperature']);

    });
Auth::routes();
