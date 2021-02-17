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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/library', 'LibraryController@index')->name('library');
    Route::get('/library/create', 'LibraryController@getCreate')->name('library.create');
    Route::post('/library/create', 'LibraryController@store')->name('library.store');
    Route::get('/library/edit/{userId}/{bookId}', 'LibraryController@getEdit')->name('library.edit')->where(['userId' => '[0-9]+', 'bookId' => '[0-9]+']);
    Route::put('/library/edit/{userId}/{bookId}', 'LibraryController@update')->name('library.update')->where(['userId' => '[0-9]+', 'bookId' => '[0-9]+']);
    Route::delete('/library/delete/{userId}/{bookId}', 'LibraryController@delete')->name('library.delete')->where(['userId' => '[0-9]+', 'bookId' => '[0-9]+']);
});
