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



Auth::routes();;

Route::group( ['middleware' => 'auth' ], function()
{
	Route::get('/', function () {
    $user = Auth::user();
    $departments = DB::table('departments')->orderBy('name', 'asc')->get();
    $articles = DB::table('articles')->get();
    return view('index', compact('departments','articles','user'));
});
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('admin/ajuda', 'AdminController@ajuda');
    Route::resource('articles', 'ArticleController');
    Route::resource('departments', 'DepartmentController');
        Route::get('files/{filename}', 'ArticleController@getFile' )->name('download')->middleware('auth');
    Route::resource('users', "UserController");
		Route::get('/article/{id}', 'ArticleController@showToAdmin')->name('article');

});

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::resource('admin', 'AdminController');
    Route::resource('version', 'VersionController');

});

	Route::match(['get','post', 'delete'],'/deleteFile/{id}', 'ArticleController@deleteFile')->name('deleteFile');
//	Route::('/deleteFile/{filename}', 'ArticleController@deleteFile')->name('deleteFile');
