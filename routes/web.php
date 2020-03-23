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

use App\Http\Controllers\UI\ArticleController;

/* Admin */
Route::get('/admin', function () {
    return view('baseAdmin');
});
Route::group(['prefix' => '/admin', 'middleware' => ['can:administerArticle']], function () {
    Route::get('/article/create', 'Admin\ArticleController@create')->name('admin.article.create');
    Route::post('/article/create', 'Admin\ArticleController@store');
    Route::get('/article/{id}', 'Admin\ArticleController@edit')->name('admin.article.edit');
    Route::put('/article/{id}', 'Admin\ArticleController@update');
    Route::delete('/article/{id}', 'Admin\ArticleController@delete')->name('admin.article.delete');

    Route::post('/article/{id}/add-photo', 'Admin\ArticleController@addPhoto')->name('addPhoto');
    Route::get('/{id}/delete-photo/{photo}', 'Admin\ArticleController@deletePhoto')->name('deletePhoto');
});

/* UI */
Route::get('/', 'UI\ArticleController@index')->name('home');
Route::get('/article/{slug}', 'UI\ArticleController@details')->name('single.article');
Route::post('/comment/create', 'UI\CommentController@store')->name('comment.article.create');
Route::get('/tag/{slug}', 'UI\TagController@index')->name('article.tags');
/* Security */
Auth::routes(['verify' => true]);
/* Login */
Route::get('/account/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/account/login', 'Auth\LoginController@login');
Route::post('/account/logout', 'Auth\LoginController@logout')->name('logout');
/* Register */
Route::get('/account/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/account/register', 'Auth\RegisterController@register');
/* Password reset */
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
/* Verify password */
Route::get('/email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

/* Social Media*/
Route::get('login/facebook', 'Auth\LoginController@redirect');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/sort','UI\SortController@showDatatable');
Route::post('/sort','UI\SortController@updateOrder');

Route::get('/position_update_posts','UI\PostController@showSort')->name('position_update_posts');
Route::put('/position_update_posts','UI\PostController@position_update')->name('position_update_posts');