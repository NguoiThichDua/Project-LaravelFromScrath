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
/*
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/user/{id}/{name}', function ($id, $name) {
        return 'This is user: ' . $name . ' with id ' . $id;
    });

    Route::group(['prefix'=>'MyGroup'], function(){
    Route::get('User1', function(){
        echo "User1";
    });
    Route::get('User2', function(){
        echo "User2";
    });
    Route::get('User3', function(){
        echo "User3";
    });
});

*/

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

Route::resource('posts', 'PostController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
