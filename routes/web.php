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

Route::get('/api/books/', 'APIBookController@index');

Route::get('/books', 'BookExampleController@index');
Route::get('/books/create', 'BookExampleController@create');
Route::get('/books/{id}', 'BookExampleController@show');
Route::post('/books', 'BookExampleController@store');
Route::get('/books/{id}/edit', 'BookExampleController@edit');
Route::post('/books/{id}/edit', 'BookExampleController@update');

Route::get('books/{id}/delete', 'BookExampleController@delete');


Route::get('/publishers', 'PublisherController@index');
Route::get('/publishers/create', 'PublisherController@create');
Route::get('/publishers/{publisher_id}', 'PublisherController@show');
Route::post('/publishers', 'PublisherController@store'); // we can have a get and a post request to the same URL



 // passing the variable name inside curly brackets for e.g. having the detail of each book shown on a different page with their ID as part of the url

