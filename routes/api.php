<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//LISTE CATEGORIES
Route::get('categories','CategorieController@index');

Route::get('ajaxRequest', 'StockController@ajaxRequestPost');
Route::post('ajaxRequest', 'StockController@ajaxRequestPost');
//Liste single Categorie
Route::get('categorie/{id}','CategorieController@show');

//create CATEGORIES
Route::post('categorie','CategorieController@store');

//Update CATEGORIES
Route::put('categorie','CategorieController@store');

//Delete CATEGORIES
Route::delete('categorie/{id}','CategorieController@destroy');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
