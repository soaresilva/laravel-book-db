<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::delete('books/{id}', 'BookExampleController@delete')->name('book.delete');

Route::get('/publishers', 'PublisherController@index');
Route::get('/publishers/create', 'PublisherController@create');
Route::get('/publishers/{publisher_id}', 'PublisherController@show');
Route::post('/publishers', 'PublisherController@store'); // we can have a get and a post request to the same URL

Route::get('/genres', 'GenreController@index');
Route::get('/genres/create', 'GenreController@create'); // NEEDS TO BE ABOVE THE ONE WITH {ID}!
Route::get('/genres/{id}', 'GenreController@show');
Route::post('/genres', 'GenreController@store');

Route::get('/cart', 'CartController@index');
Route::get('/cart/add/{book_id}', 'CartController@add');
Route::get('/cart/empty', 'CartController@emptycart');
Route::delete('cart/{id}', 'CartController@delete')->name('cart.delete');
// Route::post('/cart/add', 'CartController@postAdd');

Route::post('review/{book_id}', 'ReviewController@store')->middleware('auth');
Route::delete('review/{id}', 'ReviewController@delete')->middleware('can:admin')->name('review.delete');

// Bookshops

Route::get('/bookshops', 'BookshopController@index');
Route::get('/bookshops/create', 'BookshopController@create');
Route::post('/bookshops', 'BookshopController@store');
Route::get('/bookshops/{id}', 'BookshopController@show');
Route::post('/bookshops/{id}/add-book', 'BookshopController@addBook');

Route::get('/books-qb', 'BookQueryBuilderController@index');

// passing the variable name inside curly brackets for e.g. having the detail of each book shown on a different page with their ID as part of the url

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
