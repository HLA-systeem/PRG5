<?php

Route::get('/', 'EntranceController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/project_images/{fileName}','StorageController@getProjectImage')->name('project image');

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@show')->name('admin login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin login submit');
    Route::get('/', 'AdminController@index');
});


Route::get('/projects/upload','ProjectController@upload');
Route::get('/user/update','UserController@update');
Route::resource('/projects','ProjectController', ['except' => ['create']]);
Route::resource('/user','UserController', ['except' => ['create','show','store']]);

Route::prefix('updateAs')->group(function(){
    Route::post('/public','AsynchronousController@public');
    Route::post('/search','AsynchronousController@search');
});

