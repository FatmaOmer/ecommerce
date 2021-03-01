<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\LaravelLocalization;

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
Route::group(
    [
        'prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

Route::Group(['namespace'=>'Dashboard','middleware'=>'auth:admin','prefix'=>'admin'],function (){
    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::Group(['prefix'=>'settings'],function (){
        Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')->name('edit.shippings.methods');
        Route::put('shipping-methods/{id}','SettingsController@updateShippingMethods')->name('update.shippings.methods');
    });
});
Route::Group(['namespace'=>'Dashboard','middleware'=>'guest:admin','prefix'=>'admin'],function (){
    Route::get('login','LoginController@login')->name('admin.login');
    Route::post('login','LoginController@loginpost')->name('admin.post.login');
});
});
