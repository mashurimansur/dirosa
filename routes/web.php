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

// Route::get('/', 'OutletMapController@index');
// Route::get('/our_outlets', 'OutletMapController@index')->name('outlet_map.index');
// Route::resource('outlets', 'OutletController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Front
Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'HomeController@index');
});

// Murobbi
Route::group(['namespace' => 'Murobbi'], function () {
    Route::group(['prefix' => 'murobbi'], function () {
        // Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

        //Halaqah
        Route::group(['prefix' => 'halaqah'], function() {
            Route::get('/', 'HalaqahController@index')->name('halaqah.index');
            Route::get('/detail/{id?}', 'HalaqahController@detail')->name('halaqah.detail');
            Route::get('/create', 'HalaqahController@create')->name('halaqah.create');
            Route::post('/store', 'HalaqahController@store')->name('halaqah.store');
            Route::get('/edit/{id?}', 'HalaqahController@edit')->name('halaqah.edit');
            Route::put('/update/{id?}', 'HalaqahController@update')->name('halaqah.update');
            Route::get('/delete/{id?}', 'HalaqahController@delete')->name('halaqah.delete');
        });

        // Profile
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'ProfileController@edit')->name('profile.edit');
            Route::put('/update', 'ProfileController@update')->name('profile.update');
        });
    });
});
