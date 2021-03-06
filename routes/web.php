<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

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

Route::get('/testorm','ControllerPruebas@testorm');

//rutas api

Route::get('/admin/pruebas','AdminController@pruebas');
Route::get('/user/pruebas','UserController@pruebas');
Route::get('/category/pruebas','CategoryController@pruebas');
Route::get('/cc/pruebas','CcController@pruebas');
Route::get('/stock/pruebas','StockController@pruebas');
Route::get('/size/pruebas','SizeController@pruebas');
Route::get('/product/pruebas','ProductController@pruebas');
Route::get('/typefeature/pruebas','TypeFeatureController@pruebas');
Route::get('/feature/pruebas','FeatureController@pruebas');

//rutas del controlador de user

//Route::post('api/register','UserController@register');
Route::post('api/register',[UserController::class,'register']);

Route::post('api/login',[UserController::class,'login']);

Route::post('api/login','UserController@login');
Route::post('api/user/update', 'UserController@update');


//rutas del controlador de user admin


//rutas de controlador de categorías

Route::resource('/api/category','CategoryController');

//rutas de controlador de productos

Route::resource('/api/product','ProductController');
Route::get('/api/product/category/{id}','ProductController@getProductByCategory');
Route::get('/api/product/ranking/guantes/{rank}','ProductController@getProductByRanking');

Route::get('/api/search/{key}','ProductController@search');

Route::get('/api/product/ranking/zapatos/{rank}','ProductController@getProductZapatosByRanking');
Route::get('/api/product/word/{word}','ProductController@getProductByWord');
Route::get('/api/product/new/{id}','ProductController@getProductByNew');
Route::get('/api/product/{category}/{id}','ProductController@getProductByX');

Route::post('/api/productadd','ProductController@productadd');

//rutas de controlador de acciones
Route::resource('/api/pruebas','ControllerPruebas');

//rutas de controlador de stock
Route::resource('/api/stock','StockController');
Route::get('/api/stock/product/{id}','StockController@getProductByStock');

Route::post('api/bystock',[UserController::class,'bystock']);
Route::get('api/bystock',[UserController::class,'bystock']);

//rutas controlador cc
Route::get('/api/cc/product/{id}','CcController@getProductByCc');
Route::get('/api/cc/product/{id}/{ide}','CcController@getProductByCcQyA');
Route::get('/api/cc/productqa2/{idq1}/{ida1}/{idq2}/{ida2}','CcController@getProductByCcQyAx2');


