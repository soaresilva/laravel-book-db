<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use App\Review;
use App\Publisher;
use Illuminate\Http\Request;

class BookExampleController extends Controller
{
    public function index()
    {

        $books = Book::all(); // this Book is a façade for that class that extends the model on the Book.php file under app
        return view('books/index', compact('books'));
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $reviews = Review::all();
        return view('books/show', compact('book', 'reviews'));
    }
    
    public function create()
    {
        $publishers = Publisher::all();
        $genres = Genre::all();
        return view('books/create', compact('publishers', 'genres'));
    }
    
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $genres = Genre::all();
        $publishers = Publisher::all();
        return view('books/edit', compact('book', 'genres', 'publishers'));
    }
    
    public function store(Request $request)
    {
        // if there is a file named image_file in the request
        if ($file = $request->file('image_file')) {
            //handle the file upload -> store it in a disk (in this case 'uploads' as defined in filesystems.php)
            //              input name           folder    disk
            $request->file('image_file')->store('covers', 'uploads');
            
            // to store the file with the name we want
            // to store it with the original name
            $original_name = $file->getClientOriginalName();
            $request->file('image_file')->storeAs('covers', $original_name, 'uploads');
        }        
        
        $b = new Book; 
        $b->title = $request->input('title');
        $b->authors = $request->input('authors');
        $b->genre_id = $request->input('genre_id');
        if (!$file) {
            $b->image = "https://i.stack.imgur.com/D2VB2.png";
        } else {
            $b->image = '/uploads/covers/'.$original_name;
        }
        $b->publisher_id = $request->input('publisher_id');
        $b->save();
        return redirect('books/' . $b->id);
    }
    
    public function update(Request $request, $id)
    {
        
        if ($file = $request->file('image_file')) {
            $request->file('image_file')->store('covers', 'uploads');
            $original_name = $file->getClientOriginalName();
            $request->file('image_file')->storeAs('covers', $original_name, 'uploads');
        }        
        
        $book = Book::findOrFail($id); // Grabbing a book from the database instead of creating a new one
        $book->title = $request->input('title');
        $book->authors = $request->input('authors');
        $book->genre_id = $request->input('genre_id');
        $book->publisher_id = $request->input('publisher_id');
        if (!$file) {
            if ($book->image !== 'https://i.stack.imgur.com/D2VB2.png') {
                $book->image = $book->image;
            }
            else {
                $book->image = "https://i.stack.imgur.com/D2VB2.png";
            }
        } else {
            $book->image = '/uploads/covers/'.$original_name;
        }
        $book->save(); 
        return redirect('books/' . $book->id);
    }
        
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        // TODO: create a prompt to ask user 'are you sure you want to delete the book?'
        $book->delete();
        return redirect('books/');
    }
}
