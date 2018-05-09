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

Route::get('/', 'WelcomeController@index')->name('welcome');

//cho login,logout
Auth::routes();

// Redirect to /dashboard
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::namespace ('Admin')->group(function () {
        // Controllers Within The "App\Http\Controllers\Admin" Namespace
        Route::prefix('admin')->group(function () {
            // Matches The "/admin/" URL
            Route::name('admin::')->group(function () {
                // Route assigned name "admin::"...

                Route::get('/', 'IndexController@index')->name('index');
                /**
                 * User resource
                 * namespace Admin\UserController
                 * /admin/users
                 * adminn::users
                 */
                Route::resource('users', 'UserController');
                /**
                 * Category resource
                 * namespace Admin\CategoryController
                 * /admin/categories
                 * adminn::categories
                 */
                Route::resource('categories', 'CategoryController');
                /**
                 * Visual resource
                 * namespace Admin/VisualController
                 * /admin/visuals
                 * adminn::visuals
                 */
                Route::resource('visuals', 'VisualController');
            });
        });
    });
});

Route::namespace ('Dashboard')->group(function () {
    // Controllers Within The "App\Http\Controllers\Dashboard" Namespace
    Route::prefix('dashboard')->group(function () {
        // Matches The "/dashboard/" URL
        Route::name('dashboard::')->group(function () {
            // Route assigned name "dashboard::"...

            Route::get('/', 'IndexController@index')->name('index');

        });
    });
});
/**
 * Profile
 */
Route::get('profile', 'ProfileController@showProfile')->name('profile');
Route::post('profile', 'ProfileController@updateProfile')->name('profile.update');
