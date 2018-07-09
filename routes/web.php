<?php
use App\Stock;
use App\Http\Resources\Stock as ResourcesStock;


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();



Route::get('edit/{id}','StockController@edit');
Route::match(['put', 'patch'], 'update/{id}','StockController@update');

Route::delete('destroy/{id}','StockController@destroy');

Route::get('stock','StockController@index3');

Route::get('filter', 'StockController@filter');
Route::get('filterselect', 'StockController@filterSelect');

Route::get('stock/add','StockController@create');
Route::post('stock/add','StockController@store');
Route::get('stocks','StockController@index');
Route::get('stocks2','StockController@index2');

Route::get('stock/chart','StockController@chart');

Route::get('stock/search','StockController@search');
Route::post('stock/searchButton','StockController@searchButton');

Route::get('stock/indexAg','StockController@indexAg');


//Route::resource('source','StockController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/* Route::get('/json', function(){

  return ResourcesStock::collection(Stock::all());
}); */
