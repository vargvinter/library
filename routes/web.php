<?php

Route::get('/', 'BooksController@index')->name('home');

Route::resource('authors', 'AuthorsController');
Route::resource('books', 'BooksController');

Auth::routes();

Route::get('/test', function() {
    return App::make('countries')->all();
});
