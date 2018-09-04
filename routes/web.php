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

use App\video;

Route::get('/', function () {
   return view('welcome');
});

Auth::routes();

Route::get('/home', array(
    'as'=>'home',
    'uses'=>'HomeController@index'
));

Route::get('/crear-video', array(
        'as'=>'createVideo',
        'middleware' => 'auth',
        'uses'=>'videoController@createVideo'
));

Route::post('/guardar-video', array(
    'as'=>'saveVideo',
    'middleware' => 'auth',
    'uses'=>'videoController@saveVideo'
));

Route::get('/miniatura/{filename}', array(
    'as'=>'imageVideo',
    'uses'=>'videoController@getImage'
));

Route::get('/video/{videoId}',  array(
    'as'=>'detailVideo',
    'uses'=>'videoController@getVideoPage'
));

