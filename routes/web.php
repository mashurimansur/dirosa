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

use App\Http\Middleware\MurobbiMiddleware;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Front
Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'HomeController@index')->name('front.home');
    Route::get('/filter', 'HomeController@filter')->name('front.filter');
    Route::get('/halaqah', 'HomeController@halaqah')->name('front.halaqah');
    Route::get('/halaqah/{id?}', 'HomeController@detailHalaqah')->name('front.halaqah.detail');
    Route::post('halaqah/join', 'HomeController@joinHalaqah')->name('front.halaqah.join');
    Route::post('halaqah/out', 'HomeController@outHalaqah')->name('front.halaqah.out');
    Route::get('/register/murobbi', 'HomeController@registerMurobbi')->name('register.murobbi');

    //About
    Route::get('/tentang', 'HomeController@about')->name('front.about.index');

    // Profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'HomeController@editProfile')->name('front.profile.edit');
        Route::put('/update', 'HomeController@updateProfile')->name('front.profile.update');
    });
});

// Murobbi
Route::group(['namespace' => 'Murobbi', 'middleware' => MurobbiMiddleware::class], function () {
    Route::group(['prefix' => 'mudarris'], function () {
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

        Route::group(['prefix' => 'kader'], function () {
            Route::get('/user', 'KaderController@kader')->name('kader.kader');
            Route::get('/murobbi', 'KaderController@murobbi')->name('kader.murobbi');
        });
    });
});
