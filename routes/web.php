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

// Books

Route::get('/api/books/', 'APIBookController@index');
Route::get('/books', 'BookController@index');
Route::get('/books/create', 'BookController@create');
Route::get('/books/{id}', 'BookController@show');
Route::post('/books', 'BookController@store');
Route::get('/books/{id}/edit', 'BookController@edit')->name('book.edit');
Route::post('/books/{id}/edit', 'BookController@update');
Route::delete('books/{id}', 'BookController@delete')->name('book.delete');
Route::post('/books/{id}/add-bookshop', 'BookController@addBookshop')->middleware('can:admin');
Route::post('books/{id}/remove-bookshop/', 'BookController@removeBookshop')->middleware('can:admin');
Route::post('/books/{id}/add-related', 'BookController@addRelated');
Route::post('books/{id}/remove-related/', 'BookController@removeRelated');

// Publishers

Route::get('/publishers', 'PublisherController@index');
Route::get('/publishers/create', 'PublisherController@create');
Route::get('/publishers/{publisher_id}', 'PublisherController@show');
Route::post('/publishers', 'PublisherController@store');

// Genres

Route::get('/genres', 'GenreController@index');
Route::get('/genres/create', 'GenreController@create');
Route::get('/genres/{id}', 'GenreController@show');
Route::post('/genres', 'GenreController@store');

// Cart

Route::get('/cart', 'CartController@index');
Route::get('/cart/add/{book_id}', 'CartController@add');
Route::get('/cart/empty', 'CartController@emptycart');
Route::delete('cart/{id}', 'CartController@delete')->name('cart.delete');

// Reviews

Route::post('review/{book_id}', 'ReviewController@store')->middleware('auth');
Route::delete('review/{book_id}', 'ReviewController@delete')->middleware('can:admin');

// Bookshops

Route::get('/bookshops', 'BookshopController@index');
Route::get('/bookshops/create', 'BookshopController@create');
Route::post('/bookshops', 'BookshopController@store');
Route::get('/bookshops/{id}', 'BookshopController@show');
Route::post('/bookshops/{id}/add-book', 'BookshopController@addBook')->middleware('can:admin');
Route::delete('bookshops/{id}', 'BookshopController@delete');
Route::post('bookshops/{id}/remove-book/', 'BookshopController@removeBook')->middleware('can:admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
