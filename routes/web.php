<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherGradeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {

    Route::resource('me', 'meController');

    Route::group([
        'prefix' => 'adminPanel',
        'as' => 'adminPanel.'
    ], function () {
        Route::resource('subjects', 'SubjectController');
        Route::resource('class_names', 'Class_nameController');
        Route::resource('activities', 'Class_name_subjectController');

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

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);


    Route::get('changeStudentList/{id}', 'TeacherGradeController@changeStudentList');

});
