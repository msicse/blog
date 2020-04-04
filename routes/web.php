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

// Visitors Routs

Route::get('/', 'HomeController@welcome')->name('home');
Route::get('category/{slug}', 'FrontendController@category')->name('category');
Route::get('tags/{slug}', 'FrontendController@tags')->name('tags');
Route::get('posts', 'FrontendController@posts')->name('posts');
Route::get('posts/{slug}', 'FrontendController@singlePost')->name('posts.single');
Route::get('authors/{name}', 'FrontendController@author')->name('author');
Route::get('search', 'FrontendController@search')->name('search');
Route::post('register', 'FrontendController@username')->name('username');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('ehome');
Route::post('subscribe', 'HomeController@subscribe')->name('subscribe');

Route::group(['middleware'=>['auth']], function(){
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('favorite.post.add');
    Route::post('comments/{post}', 'CommentController@store')->name('comments.store');
    Route::post('reply/{comment}', 'ReplyController@store')->name('reply.store');
});

// Admin Routs

Route::group(['prefix'=>'admin','as'=>'admin.','namespace'=>'Admin','middleware'=>['auth','admin']], function(){
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::resource('tags','TagController');
	Route::resource('categories','CategoryController');
	Route::resource('posts','PostController');
    Route::get('pending/posts', 'PostController@pending')->name('pending.post');
    Route::get('post/all', 'PostController@posts')->name('all.post');
    Route::put('posts/{id}/apporved', 'PostController@apporved')->name('apporved.post');
    Route::get('subcribers', 'SubscriberController@index')->name('subcribers');
    Route::delete('subcribers/{id}', 'SubscriberController@destroy')->name('subcribers.destroy');
    Route::get('authors', 'AuthorController@index')->name('authors');
    Route::get('comments', 'CommentController@index')->name('comments');
    Route::delete('comments/{id}', 'CommentController@delete')->name('comments.destroy');
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('settings/profile', 'SettingsController@profileUpdate')->name('settings.profile');
    Route::put('settings/password', 'SettingsController@passwordUpdate')->name('settings.password');
    Route::get('favorite/posts', 'FavoriteController@index')->name('posts.favorite');
    Route::delete('favorite/posts/{id}', 'FavoriteController@delete')->name('posts.favorite.delete');
 
});

//Author Routs

Route::group(['prefix'=>'author','as'=>'author.','namespace'=>'Author','middleware'=>['auth','author']], function(){
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('posts','PostController');
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('settings/profile', 'SettingsController@profileUpdate')->name('settings.profile');
    Route::put('settings/password', 'SettingsController@passwordUpdate')->name('settings.password');
    Route::get('favorite/posts', 'FavoriteController@index')->name('posts.favorite');
    Route::delete('favorite/posts/{id}', 'FavoriteController@delete')->name('posts.favorite.delete');
    Route::get('comments', 'CommentController@index')->name('comments');
    Route::delete('comments/{id}', 'CommentController@delete')->name('comments.destroy');
});

View::composer('layouts.frontend.partial.footer', function ($view) {
    $categories = App\Category::all();
    $view->with('categories',$categories);
});


