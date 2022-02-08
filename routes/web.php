<?php

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

});
