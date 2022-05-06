<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherGradeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

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
    return redirect()->route('mainPage');
});

Route::group(['middleware' => ['auth']], function() {

    Route::resource('me', 'MeController');
    Route::get('changePasswordIndex', 'MeController@changePasswordIndex')->name('changePasswordIndex');
    Route::put('changePassword', 'MeController@changePassword')->name('changePassword');

    Route::get('deleteAccountIndex', 'MeController@destroyAccountIndex')->name('deleteAccountIndex');
    Route::put('deleteAccount', 'MeController@destroy')->name('deleteAccount');



    Route::group([
        'prefix' => 'adminPanel',
        'as' => 'adminPanel.'
    ], function () {
        Route::resource('subjects', 'SubjectController');
        Route::resource('class_names', 'Class_nameController');
        Route::resource('activities', 'Class_name_subjectController');
        Route::post('storeSchedule', 'Class_name_subjectController@storeSchedule')->name('storeSchedule');

        Route::get('users', 'UserController@index');
    });

    Route::group([
        'prefix' => 'teacherPanel',
        'as' => 'teacherPanel.'
    ], function () {
        Route::resource('grades', 'TeacherGradeController');
    });

    Route::group([
        'prefix' => 'studentPanel',
        'as' => 'studentPanel.'
    ], function () {
        Route::resource('grades', 'StudentGradeController');
    });

    Route::resource('dashboard', 'PostController');
    Route::get('dashboard', 'PostController@index')->name('mainPage');
    Route::get('dashboard/{id}', 'PostController@show');
    Route::post('dashboard/{id}', 'PostController@destroy');

    Route::resource('users', UserController::class);

    Route::get('changeStudentList/{id}', 'TeacherGradeController@changeStudentList');
    Route::get('calendar', 'CalendarController@index')->name('calendarIndex');

});
