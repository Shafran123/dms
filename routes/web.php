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

    Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
    {
        Route::get('/admin/home', 'ContentController@adminHome')->name('admin_home');
        Route::get('/user', 'UserController@index')->name('users');
        Route::get('/pending/posts', 'PostController@adminIndex')->name('pending_posts');
    });

    Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function()
    {
        Route::get('/user/home', 'ContentController@userHome')->name('user_home');
        Route::get('/my/posts', 'PostController@userIndex')->name('my_posts');
    });

    Route::get('/add/post', 'IncidentController@index')->name('add_post_index');
    Route::post('/add/post', 'IncidentController@addPost')->name('add_post');
});

//common routes
Route::get('/contact', 'ContentController@contactIndex')->name('contact');
Route::get('/view/map', 'MapController@index')->name('view_map');
Route::get('/view/graph', 'GraphController@index')->name('view_graph');


Route::get('new/post', 'IncidentController@addPost');

//Route::get('/home', 'HomeController@index')->name('home');//<- fix THIS
