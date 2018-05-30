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
    return view('welcome');
})->name('home');

Auth::routes();

Route::get('/feed', 'HomeController@feed')->name('feed');

Route::get('auth/login/{provider}', 'SocialAuthController@handleLogin')
    ->name('social-auth-login');
// Route::get('auth/join/{provider}', 'SocialAuthController@handleJoin')
//     ->name('social-auth-join');
Route::get('auth/{provider}/callback', 'SocialAuthController@handleProviderCallback')
    ->name('social-auth-callback');

Route::get('search', 'MediaController@search')->name('search');

Route::group([
    'prefix' => 'media',
    'as' => 'media.'
], function () {

    Route::get('/', 'MediaController@index')->name('index');

    Route::get('/feed/{media}', 'MediaController@feed')->name('feed');

    Route::post('/read', 'MediaController@read')->name('read');

    Route::get('/suggestions', 'MediaController@suggestions')->name('suggestions');

    Route::get('/subscribe/{media?}', 'MediaController@subscribe')->name('subscribe');

    Route::get('/unsubscribe/{media?}', 'MediaController@unsubscribe')->name('unsubscribe');

    Route::view('/add', 'media.add')->name('add');

    Route::post('/add', 'MediaController@add')->name('create');

});

Route::view('account', 'account')->name('account');

Route::post('update-account', 'UserController@update')->name('update-account');
