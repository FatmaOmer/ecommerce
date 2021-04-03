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
    Route::get('logout','LoginController@logout')->name('admin.logout');
    Route::Group(['prefix'=>'settings'],function (){
        Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')->name('edit.shippings.methods');
        Route::put('shipping-methods/{id}','SettingsController@updateShippingMethods')->name('update.shippings.methods');
    });
    Route::Group(['prefix'=>'profile'],function (){
        Route::get('edit','ProfileController@editProfile')->name('edit.profile');
        Route::put('update','ProfileController@updateProfile')->name('update.profile');
    });
    ###################################begin category########################################
    Route::Group(['prefix'=>'categories'],function (){
        Route::get('/','CategoriesController@index')->name('admin.categories');
        Route::get('create','CategoriesController@create')->name('admin.categories.create');
        Route::post('store','CategoriesController@store')->name('admin.categories.store');
        Route::get('edit/{id}','CategoriesController@edit')->name('admin.categories.edit');
        Route::put('update/{id}','CategoriesController@update')->name('admin.categories.update');
        Route::get('delete/{id}','CategoriesController@destroy')->name('admin.categories.delete');
    });
    ################################## end category##########################################
    ###################################begin brand########################################
    Route::Group(['prefix'=>'brands'],function (){
        Route::get('/','BrandsController@index')->name('admin.brands');
        Route::get('create','BrandsController@create')->name('admin.brands.create');
        Route::post('store','BrandsController@store')->name('admin.brands.store');
        Route::get('edit/{id}','BrandsController@edit')->name('admin.brands.edit');
        Route::put('update/{id}','BrandsController@update')->name('admin.brands.update');
        Route::get('delete/{id}','BrandsController@destroy')->name('admin.brands.delete');
    });
    ################################## end brand##########################################
    ###################################begin tags########################################
    Route::Group(['prefix'=>'tags'],function (){
        Route::get('/','TagsController@index')->name('admin.tags');
        Route::get('create','TagsController@create')->name('admin.tags.create');
        Route::post('store','TagsController@store')->name('admin.tags.store');
        Route::get('edit/{id}','TagsController@edit')->name('admin.tags.edit');
        Route::put('update/{id}','TagsController@update')->name('admin.tags.update');
        Route::get('delete/{id}','TagsController@destroy')->name('admin.tags.delete');
    });
    ################################## end tags##########################################
});
Route::Group(['namespace'=>'Dashboard','middleware'=>'guest:admin','prefix'=>'admin'],function (){
    Route::get('login','LoginController@login')->name('admin.login');
    Route::post('login','LoginController@loginpost')->name('admin.post.login');
});
});
