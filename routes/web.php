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

Auth::routes();

Route::get('/', 'ContentController@publicHome')->name('home');
Route::middleware('auth')->group(function(){

    Route::get('/user/home', 'ContentController@userHome')->name('user_home');
    Route::get('/add/post', 'IncidentController@index')->name('add_post_index');
    Route::post('/add/post', 'IncidentController@addPost')->name('add_post');
    Route::get('/admin/home', 'ContentController@adminHome')->name('admin_home');
});

Route::get('new/post', 'IncidentController@addPost');


Route::get('/contact', 'ContentController@publicHome')->name('contact');

Route::get('/home', 'HomeController@index')->name('home');//<- fix THIS
