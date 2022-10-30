<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\FieldsController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('dashboard');*/

Route::get('/member', function () {
    return view('pages.member');
})->name('member');

/*Route::get('/booking', function () {
    return view('pages.booking');
})->name('booking');*///

Route::get('/fields', function () {
    return view('pages.booking');
})->name('fields');

Route::get('/users', function () {
    return view('pages.booking');
})->name('users');

Route::get('getgraph',[CustomAuthController::class, 'getGraph'] )->middleware('auth')->name('dashboard.getgraph');
Route::get('/',[CustomAuthController::class, 'dashboard'] )->middleware('auth')->name('dashboard');
Route::get('login',[CustomAuthController::class, 'to_login'] )->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('time_start', [BookingController::class, 'time_start'])->name('booking.timestart');
Route::post('time_finish', [BookingController::class, 'time_finish'])->name('booking.timefinish');
Route::post('field_status', [BookingController::class, 'field_status'])->name('booking.fieldstatus');
Route::get('testquery', [BookingController::class, 'testquery'])->name('booking.testquery');
//Route::get('new-member',[MemberController::class, 'add_member'] )->name('new-member');
//Route::post('member-store',[MemberController::class,'store'])->name('store.member');
Route::resource('member',MemberController::class)->middleware('auth');
Route::resource('fields',FieldsController::class)->middleware('auth');
Route::resource('users',CustomAuthController::class)->middleware('auth');
Route::resource('booking',BookingController::class)->middleware('auth');
Route::get('getDta',[CustomAuthController::class, 'getData'])->name('getData');

