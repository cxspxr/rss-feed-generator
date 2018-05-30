<?php
Route::group([
    'prefix' => 'media',
    'as' => 'media.'
], function () {
    Route::get('/feed/{media}', 'MediaController@feed')->name('feed');

    Route::get('/suggestions', 'MediaController@suggestions')->name('suggestions');

    Route::get('/subscribe/{media?}', 'MediaController@subscribe')->name('subscribe');

    Route::get('/unsubscribe/{media?}', 'MediaController@unsubscribe')->name('unsubscribe');

    Route::view('/add', 'media.add')->name('add');

    Route::post('/add', 'MediaController@add')->name('create');
});


Route::view('account', 'account')->name('account');

Route::post('update-account', 'UserController@update')->name('update-account');
