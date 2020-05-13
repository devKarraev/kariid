<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Frontend\IndexController@execute');
Route::post('/', 'Frontend\IndexController@createMessage');

Auth::routes();

//Route::get('/admin', 'Admin\HomeController@index')->name('home');
//Route::post('/admin/edit{id}', 'HomeController@index')->where(['id' => '[0-9]+'])->name('welcome');


Route::resource('admin', 'Admin\HomeController')->names('admin')
    ->only(['index', 'edit', 'update']);
Route::get('admin/cancel-message/{id}', 'Admin\HomeController@cancelMessage')->name('admin.cancel');
Route::get('admin/accept-message/{id}', 'Admin\HomeController@acceptMessage')->name('admin.accept');
Route::post('admin/search', 'Admin\HomeController@searchMessage')->name('admin.search');
