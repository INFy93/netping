<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\NetpingApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTableController;
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

/* add new user */
Route::get('/user/add', [UserTableController::class, 'addUser'])->name('add_user');



/*temporary */
Route::get('sl', function () {

    Artisan::call('storage:link');

   return Artisan::output();

});

});

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {
    Route::get('/power/{id}', [NetpingApiController::class, 'get_power_data']);
    Route::get('/secure/{id}', [NetpingApiController::class, 'get_netping_data']);
    Route::get('/door/{id}', [NetpingApiController::class, 'get_door_data']);
    Route::get('/alarm/{id}', [NetpingApiController::class, 'get_alarm_data']);
    Route::get('/alarm/set/{id}', [NetpingApiController::class, 'set_alarm']);

    });
Auth::routes();
