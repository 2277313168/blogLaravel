<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('param', 'TestController@test1');



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group([  'middleware' => ['web'],'namespace'=>'Admin'  ], function () {


    //admin
    Route::get('admin/logout', 'AdminController@logout');
    Route::any('admin/psw', 'AdminController@changePsw');
    Route::any('admin/login', 'AdminController@login');
    Route::get('admin/verifyCode', 'AdminController@verifyCode');
    Route::get('index/index', 'IndexController@index');
    Route::get('index/info', 'IndexController@info');

    //category
    Route::get('cat/index','CategoryController@index');
    Route::any('cat/add','CategoryController@add');
    Route::any('cat/edit/{id}','CategoryController@edit');
    Route::any('cat/delete/{id}','CategoryController@delete');
    Route::any('cat/changeOrder','CategoryController@changeOrder');

    //article
    Route::any('arti/add','ArticleController@add');
    Route::any('arti/index','ArticleController@index');
    Route::any('arti/edit/{id}','ArticleController@edit');
    Route::any('arti/delete/{id}','ArticleController@delete');
    Route::any('arti/ajaxDeleteImg','ArticleController@ajaxDeleteImg');


    //links
    Route::any('links/add','LinksController@add');
    Route::any('links/index','LinksController@index');
    Route::any('links/edit/{id}','LinksController@edit');
    Route::any('links/delete/{id}','LinksController@delete');
    Route::any('links/ajaxChangeOrder','LinksController@ajaxChangeOrder');

    //config
    Route::any('conf/add','ConfigController@add');
    Route::any('conf/index','ConfigController@index');
    Route::any('conf/edit/{id}','ConfigController@edit');
    Route::any('conf/delete/{id}','ConfigController@delete');
    Route::any('conf/ajaxChangeOrder','ConfigController@ajaxChangeOrder');
    Route::any('conf/changeContent','ConfigController@changeContent');
    Route::any('conf/putFile','ConfigController@putFile');

});

Route::group([  'middleware' => ['web'] ], function () {
    //BaseController
    Route::any('base/upload', 'BaseController@upload');
    Route::any('base/deleteQiniu/{key}', 'BaseController@deleteQiniu');
});
