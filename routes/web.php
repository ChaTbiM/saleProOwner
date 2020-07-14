<?php

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
Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});





Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');


	Route::get('user/genpass', 'UserController@generatePassword');
    Route::resource('user', 'UserController');
    
    Route::resource('module', 'ModuleController');


    Route::get('language_switch/{locale}', 'LanguageController@switchLanguage');
    

    // warehouse 
    Route::post('importwarehouse', 'WarehouseController@importWarehouse')->name('warehouse.import');
	Route::post('warehouse/deletebyselection', 'WarehouseController@deleteBySelection');
	Route::get('warehouse/lims_warehouse_search', 'WarehouseController@limsWarehouseSearch')->name('warehouse.search');
	Route::resource('warehouse', 'WarehouseController');

});
