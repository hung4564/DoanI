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
                Route::get('quizzes/detail/{id}', 'QuizController@showDetail')->name('quizzes.detail');
                Route::get('quizzes/{quiz_id}/removeQuestion/{question_id}', 'QuizController@removeQuestion')->name('quizzes.removeQuestion');
                Route::get('quizzes/{id}/disable', 'QuizController@disableQuiz')->name('quizzes.disable');
                Route::get('quizzes/{id}/enable', 'QuizController@enableQuiz')->name('quizzes.enable');
                Route::get('quizzes/{id}/public', 'QuizController@publicQuiz')->name('quizzes.public');
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
                /**
                 * Question resource
                 * namespace Admin/QuestionController
                 * /admin/quiz/
                 * admin::questions
                 */
                Route::resource('questions', 'QuestionController');
                /**
                 * Course resource
                 * namespace Admin/CourseController
                 * /admin/quiz/
                 * admin::courses
                 */
                Route::resource('courses', 'CourseController');
                Route::get('courses/detail/{id}', 'CourseController@showDetail')->name('courses.detail');
                Route::get('courses/{coure_id}/addquiz/{quiz_id}', 'CourseController@addQuiz')->name('course.addquiz');
                Route::get('courses/{coure_id}/removequiz/{quiz_id}', 'CourseController@removeQuiz')->name('course.removequiz');
                Route::get('courses/{coure_id}/addStudent/{quiz_id}', 'CourseController@addStudent')->name('course.addstudent');
                Route::get('courses/{coure_id}/removeStudent/{quiz_id}', 'CourseController@removeStudent')->name('course.removestudent');
                Route::get('courses/{coure_id}/addlesson/{lesson_id}', 'CourseController@addlesson')->name('course.addlesson');
                Route::get('courses/{coure_id}/removelesson/{lesson_id}', 'CourseController@removelesson')->name('course.removelesson');
                Route::get('courses/{id}/disable', 'CourseController@disableCourse')->name('courses.disable');
                Route::get('courses/{id}/enable', 'CourseController@enableCourse')->name('courses.enable');
                Route::get('courses/{id}/public', 'CourseController@publicCourse')->name('courses.public');
                Route::get('courseslist', 'CourseController@listCourse')->name('courses.listCourses');
                Route::get('coursesEnrollemnt', 'CourseController@coursesEnrollemnt')->name('courses.enrollment');
                Route::post('coursesEnrollemnt', 'CourseController@postEnrollemnt')->name('courses.postenrollment');

                Route::resource('lessons', 'LessonController');
            });
        });
    });
});

Route::prefix('dashboard')->group(function () {
    // Matches The "/dashboard/" URL
    Route::name('dashboard::')->group(function () {
        // Route assigned name "dashboard::"...
        Route::namespace ('Dashboard')->group(function () {
            // Controllers Within The "App\Http\Controllers\Dashboard" Namespace
            Route::get('/', 'IndexController@index')->name('index');

            Route::resource('courses', 'CourseController');
            Route::get('courses/detail/{id}', 'CourseController@showDetail')->name('courses.detail');
            Route::get('courses/{coure_id}/addquiz/{quiz_id}', 'CourseController@addQuiz')->name('course.addquiz');
            Route::get('courses/{coure_id}/removequiz/{quiz_id}', 'CourseController@removeQuiz')->name('course.removequiz');
            Route::get('courses/{coure_id}/addStudent/{quiz_id}', 'CourseController@addStudent')->name('course.addstudent');
            Route::get('courses/{coure_id}/removeStudent/{quiz_id}', 'CourseController@removeStudent')->name('course.removestudent');
            Route::get('courses/{id}/disable', 'CourseController@disableCourse')->name('courses.disable');
            Route::get('courses/{id}/enable', 'CourseController@enableCourse')->name('courses.enable');
            Route::get('courses/{id}/public', 'CourseController@publicCourse')->name('courses.public');
            Route::get('courseslist', 'CourseController@listCourse')->name('courses.listCourses');
            Route::get('coursesEnrollemnt', 'CourseController@coursesEnrollemnt')->name('courses.enrollment');
            Route::post('coursesEnrollemnt', 'CourseController@postEnrollemnt')->name('courses.postenrollment');

            Route::get('courses/{coure_id}/addlesson/{lesson_id}', 'CourseController@addlesson')->name('course.addlesson');
            Route::get('courses/{coure_id}/removelesson/{lesson_id}', 'CourseController@removelesson')->name('course.removelesson');

            Route::resource('quizzes', 'QuizController');
            Route::get('quizzes/detail/{id}', 'QuizController@showDetail')->name('quizzes.detail');
            Route::get('quizzes/{quiz_id}/removeQuestion/{question_id}', 'QuizController@removeQuestion')->name('quizzes.removeQuestion');
            Route::get('quizzes/{id}/disable', 'QuizController@disableQuiz')->name('quizzes.disable');
            Route::get('quizzes/{id}/enable', 'QuizController@enableQuiz')->name('quizzes.enable');
            Route::get('quizzes/{id}/public', 'QuizController@publicQuiz')->name('quizzes.public');

            Route::prefix('quiz')->group(function () {
                Route::get('{quizid}', 'QuestionController@getListbyQuiz')->name('QuizQuestion.index');
                Route::get('{quizid}/{questionID}/edit', 'QuestionController@editByQuiz')->name('QuizQuestion.edit');
                Route::get('{quizid}/create', 'QuestionController@createByQuiz')->name('QuizQuestion.create');
                Route::delete('{quizid}/{questionID}', 'QuestionController@destroyByQuiz')->name('QuizQuestion.destroy');
                Route::post('{quizid}', 'QuestionController@storeByQuiz')->name('QuizQuestion.store');
                Route::put('{quizid}/{questionID}', 'QuestionController@updateByQuiz')->name('QuizQuestion.update');
            });

            Route::resource('questions', 'QuestionController');
            Route::resource('lessons', 'LessonController');
        });
    });
});
/**
 * Profile
 */
Route::get('profile', 'ProfileController@showProfile')->name('profile');
Route::post('profile', 'ProfileController@updateProfile')->name('profile.update');

//ajax
Route::get('ajax/quiz/{id}', 'AjaxController@getInfoQuiz')->name('ajax.quiz');
Route::get('ajax/student/{id}', 'AjaxController@getInfoStudent')->name('ajax.student');
Route::get('ajax/lesson/{id}', 'AjaxController@getInfoLesson')->name('ajax.lesson');
Route::get('ajax/test', 'AjaxController@test')->name('ajax.test');

Route::get('course/{id}/detail.html', 'PagesController@showCourse')->name('course.detail');
Route::get('enrollment/{id}', 'CourseController@Enrollment')->name('enrollment');
Route::get('quiz/{idCourse}/{idQuiz}/do.html', 'PagesController@showQuiz')->name('quiz.do');
Route::post('sendQuiz/{id}', 'QuizController@postQuiz')->name('sendQuiz');
route::get('lesson/{id}/read.html','PagesController@showLesson')->name('lesson.read');
