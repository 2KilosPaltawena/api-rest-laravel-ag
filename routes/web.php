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

Route::post('api/register','UserController@register');
Route::post('api/login','UserController@login');
Route::post('api/user/update', 'UserController@update');


//rutas del controlador de user admin


//rutas de controlador de categorías

Route::resource('/api/category','CategoryController');

//rutas de controlador de productos

Route::resource('/api/product','ProductController');
Route::get('/api/product/category/{id}','ProductController@getProductByCategory');
//Route::post('/api/product/productadd','');

//rutas de controlador de acciones
Route::resource('/api/pruebas','ControllerPruebas');

