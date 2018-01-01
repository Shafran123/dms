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

//Auth::routes();

//Authentication routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/', 'ContentController@publicHome')->name('home');
Route::get('/home', 'ContentController@publicHome');

// Registration Routes...
Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::middleware('auth')->group(function(){

    Route::group(['middleware' => 'App\Http\Middleware\SuperUserMiddleware'], function()
    {
        Route::get('/users', 'UsersController@index')->name('users');//show site users
        Route::get('/add/user', 'UsersController@create')->name('add_user');//add a new user
        Route::post('/add/user', 'UsersController@store')->name('save_user');//save user
        Route::get('/view/user/{id}', 'UsersController@view')->name('view_user');//view user
        Route::post('/update/user/{id}/{field}', 'UsersController@update')->name('update_user');//view user
    });

    Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
    {
        Route::get('/admin/home', 'ContentController@adminHome')->name('admin_home');//admin home
        Route::get('/pending/posts', 'PostController@adminIndex')->name('pending_posts');//show pending posts
        Route::post('/approve/post/{id}', 'IncidentController@approvePost')->name('approve_post');//approve post w/o editing
    });

    Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function()
    {
        Route::get('/user/home', 'ContentController@userHome')->name('user_home');//user home
    });



    Route::get('/add/post', 'IncidentController@index')->name('add_post_index');//show add post form
    Route::post('/add/post', 'IncidentController@addPost')->name('add_post');//add post

    Route::get('/edit/post/{id}', 'IncidentController@edit')->name('edit_post_form');//show edit post form
    Route::post('/edit/post/{id}', 'IncidentController@editPost')->name('edit_post');//edit post and approve post
    Route::get('/edit/post/{id}/pictures', 'PostController@editPictureIndex')->name('edit_picture_form');

    Route::get('delete/picture/{id}', 'PictureController@deletePicture')->name('delete_picture');

    Route::get('/posts/me', 'IncidentController@viewMyPosts')->name('my_posts');//show user/admin posts

    Route::get('delete/post/{id}', 'IncidentController@deletePost')->name('delete_post');//delete user/admin post
});

//common routes
Route::get('/contact', 'ContentController@contactIndex')->name('contact');//show contact page
Route::get('/view/map', 'MapController@index')->name('view_map');//show view map page
Route::get('/post/{id}', 'IncidentController@viewPost')->name('view_post');//view a post

Route::get('/view/graph', 'GraphController@index')->name('view_graph');//show view graph page
Route::post('/view/graph', 'GraphController@filterPosts')->name('filter_posts');
Route::get('filter/{district}', 'GraphController@sortByDistrict')->name('sort_district');
Route::get('filter/{district}/{start_date}/{end_date}', 'GraphController@sortByDistrictAndDates')->name('sort_district');


Route::get('/error/{code}', 'ContentController@errorPage')->name('error_page');//show error page
//Route::get('new/post', 'IncidentController@addPost');

//Route::get('/home', 'HomeController@index')->name('home');//<- fix THIS
