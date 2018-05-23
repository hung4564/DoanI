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

Route::get('/', 'PagesController@index')->name('welcome');

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
                 * admin::users
                 */
                Route::resource('users', 'UserController');
                /**
                 * Category resource
                 * namespace Admin\CategoryController
                 * /admin/categories
                 * admin::categories
                 */
                Route::resource('categories', 'CategoryController');
                /**
                 * Visual resource
                 * namespace Admin/VisualController
                 * /admin/visuals
                 * admin::visuals
                 */
                Route::resource('visuals', 'VisualController');
                /**
                 * Quiz resource
                 * namespace Admin/QuizController
                 * /admin/quizzes
                 * admin::quizzes
                 */
                Route::resource('quizzes', 'QuizController');
                /**
                 * Quiz resource
                 * namespace Admin/QuestionController
                 * /admin/quiz/
                 * admin::QuizQuestion
                 */
                Route::prefix('quiz')->group(function () {
                    Route::get('{quizid}', 'QuestionController@getListbyQuiz')->name('QuizQuestion.index');                    
                    Route::get('{quizid}/{questionID}/edit', 'QuestionController@editByQuiz')->name('QuizQuestion.edit');           
                    Route::get('{quizid}/create', 'QuestionController@createByQuiz')->name('QuizQuestion.create'); 
                    Route::delete('{quizid}/{questionID}', 'QuestionController@destroyByQuiz')->name('QuizQuestion.destroy');
                    Route::post('{quizid}', 'QuestionController@storeByQuiz')->name('QuizQuestion.store');
                    Route::put('{quizid}/{questionID}', 'QuestionController@updateByQuiz')->name('QuizQuestion.update');
                });
                Route::resource('questions', 'QuestionController');
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

Route::get('{id}/{path}.html', 'PagesController@showVisual')->name('visual');

Route::get('tranning','PagesController@showTranning')->name('tranning');

Route::get('tranning/quiz/{id}','PagesController@showQuiz')->name('quiz');
Route::post('tranning/quiz/{id}','QuizController@postQuiz')->name('sendQuiz');