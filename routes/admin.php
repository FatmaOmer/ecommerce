<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// note that there prefix is admin for all this fileexit
Route::Group(['namespace'=>'Dashboard','middleware'=>'auth:admin'],function (){
    Route::get('/','DashboardController@index')->name('admin.dashboard');

});
Route::Group(['namespace'=>'Dashboard','middleware'=>'guest:admin'],function (){
    Route::get('login','LoginController@login')->name('admin.login');
    Route::post('login','LoginController@loginpost')->name('admin.post.login');
});
