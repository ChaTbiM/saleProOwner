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
    Route::put('user/changepass/{id}', 'UserController@changePassword')->name('user.password');


    Route::post('user/deletebyselection', 'UserController@deleteBySelection');


    Route::resource('user', 'UserController');
    
    Route::resource('module', 'ModuleController');


    Route::get('language_switch/{locale}', 'LanguageController@switchLanguage');
    Route::get('testlang', 'LanguageController@getLang');
    

    // warehouse
    Route::post('importwarehouse', 'WarehouseController@importWarehouse')->name('warehouse.import');
    Route::post('warehouse/deletebyselection', 'WarehouseController@deleteBySelection');
    Route::get('warehouse/lims_warehouse_search', 'WarehouseController@limsWarehouseSearch')->name('warehouse.search');
    Route::resource('warehouse', 'WarehouseController');
    

    // Biller
    Route::post('importbiller', 'BillerController@importBiller')->name('biller.import');
    Route::post('biller/deletebyselection', 'BillerController@deleteBySelection');
    Route::get('biller/lims_biller_search', 'BillerController@limsBillerSearch')->name('biller.search');
    Route::resource('biller', 'BillerController');
    // Route::get('readme', "ReadmeController@index")->name('readme');
    Route::get('read', function () {
        return view('readme.index');
    });
    Route::get('read_me', 'ReadmeController@index')->name('readme');
});
