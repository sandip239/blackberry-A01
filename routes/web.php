<?php

use App\Http\Controllers\registercontroller;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('register',[registercontroller::class,'registerView'])->name('registerView');
Route::post('register',[registercontroller::class,'register'])->name('register');

Route::get('login',[registercontroller::class,'loginView'])->name('loginview');
Route::post('login',[registercontroller::class,'login'])->name('login');

Route::get('forget',[registercontroller::class,'forgetView'])->name('forgetView');
Route::post('forget',[registercontroller::class,'forget'])->name('forget');

Route::get('newpassword/{newpassword}',[registercontroller::class,'newpassword'])->name('newpassword');
// Route::post('newpassword',[registercontroller::class,'updatepassword'])->name('updatepassword');
