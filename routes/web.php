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
Route::get('/', function () {
    return redirect(
        '/blog'
    );
});
Route::get('/blog', 'BlogController@index')->name('blog.home');
Route::get('/blog/{slug}', 'BlogController@showPost')->name('blog.detail');
Route::get('/admin', function () {
    return redirect('/admin/post');
});
Route::middleware('auth')->namespace('Admin')->group(function () {
    Route::resource('/admin/post', 'PostController',['except'=>'show']);
    Route::resource('/admin/tag', 'TagController', ['except' => 'show']);
    Route::get('admin/upload', 'UploadController@index')->name('upload');
    Route::post('admin/upload/file', 'UploadController@uploadFile')->name('upload.file');
    Route::delete('admin/upload/file', 'UploadController@deleteFile')->name('upload.file.delete');
    Route::post('admin/upload/folder', 'UploadController@createFolder')->name('upload.folder');
    Route::delete('admin/upload/folder', 'UploadController@deleteFolder')->name('upload.folder.delete');
});

//注册登陆退出
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('contact','ContactController@showForm');
Route::post('contact','ContactController@sendContactInfo');
//RSS
Route::get('rss','BlogController@rss');
Route::get('sitemap.xml','BlogController@siteMap');
