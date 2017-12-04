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
        Route::get('/admin/home', 'ContentController@adminHome')->name('admin_home');//admin home
        Route::get('/user', 'UserController@index')->name('users');//show site users
        Route::get('/pending/posts', 'PostController@adminIndex')->name('pending_posts');//show pending posts
        Route::get('/edit/post/{id}', 'PostController@edit')->name('edit_post_form');//show edit post form
        Route::post('/edit/post/{id}', 'PostController@editPost')->name('edit_post');//edit post and approve post
        Route::get('/approve/post/{id}', 'PostController@approvePost')->name('approve_post');//approve post w/o editing
    });

    Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function()
    {
        Route::get('/user/home', 'ContentController@userHome')->name('user_home');//user home
        Route::get('/my/posts', 'PostController@userIndex')->name('my_posts');//show user posts
    });

    Route::get('/add/post', 'IncidentController@index')->name('add_post_index');//show add post form
    Route::post('/add/post', 'IncidentController@addPost')->name('add_post');//add post
});

//common routes
Route::get('/contact', 'ContentController@contactIndex')->name('contact');//show contact page
Route::get('/view/map', 'MapController@index')->name('view_map');//show view map page
Route::get('/view/graph', 'GraphController@index')->name('view_graph');//show view graph page
Route::get('/post/{id}', 'PostController@viewPost')->name('view_post');//view a post


//Route::get('new/post', 'IncidentController@addPost');

//Route::get('/home', 'HomeController@index')->name('home');//<- fix THIS
