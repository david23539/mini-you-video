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
   /*return view('home', array(
       'as' =>'home',
       'uses'=>'HomeController@index'
   ));*/
   return redirect()->route('home');
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

Route::get('/video_file/{filename}', array(
    'as'=>'fileVideo',
    'uses'=>'videoController@getVideos'
));

Route::post('/comments', array(
    'as'=>'comment',
    'middleware'=>'auth',
    'uses'=>'CommentsController@store'
));

Route::get('/delete-comment/{comment_id}', array(
    'as'=>'commentDelete',
    'middleware'=>'auth',
    'uses'=>'CommentsController@delete'
));
Route::get('/delete-video/{video_id}', array(
    'as'=>'videoDelete',
    'middleware'=>'auth',
    'uses'=>'videoController@delete'
));

Route::get('/editar-video/{video_id}', array(
    'as'=>'videoEdit',
    'middleware'=>'auth',
    'uses'=>'videoController@edit'
));

Route::post('/update-video/{video_id}', array(
    'as'=>'updateVideo',
    'middleware' => 'auth',
    'uses'=>'videoController@update'
));

Route::get('/buscar/{search?}/{filter?}',[
    'as'=>'videoSearch',
    'uses'=>'videoController@search'
]);

Route::get('/clearCache', function(){
    $code = Artisan::call('cache:clear');
});