<?php

use App\Http\Controllers\SubjectController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'me',
    'as' => 'me.'
], function () {
    Route::get('profile', 'UserController@profile')
        ->name('profile');

    Route::get('edit', 'UserController@edit')
        ->name('edit');

    Route::post('update', 'UserController@update')
        ->name('update');


    Route::post('update', 'UserController@update')
    ->name('update');

});

Route::group([
    'prefix' => 'adminPanel',
    'as' => 'adminPanel.'
], function () {
    Route::resource('subjects', 'SubjectController');
    Route::resource('class_names', 'Class_nameController');

    Route::get('users', 'UserController@index');
});
