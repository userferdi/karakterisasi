<?php

Route::get('/', function () {
    return view('template');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
