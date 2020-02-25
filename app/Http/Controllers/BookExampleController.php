<?php

namespace App\Http\Controllers;

use App\Book;
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
        return view('books/show', compact('book'));
    }
    
    public function create()
    {
        $publishers = Publisher::all();
        return view('books/create', compact('publishers'));
    }
    
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $publishers = Publisher::all();
        return view('books/edit', compact('book', 'publishers'));
    }
    
    public function store(Request $request)
    {
        $b = new Book; 
        $b->title = $request->input('title');
        $b->authors = $request->input('authors');
        $b->image = $request->input('image');
        $b->publisher_id = $request->input('publisher_id');
        if ($b->image === null) {
            $b->image = "https://i.stack.imgur.com/D2VB2.png";
        };
        $b->save();
        // return $b;
        // return $request;
        return redirect('books/' . $b->id);
    }
    
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id); // Grabbing a book from the database instead of creating a new one
        $book->title = $request->input('title');
        $book->authors = $request->input('authors');
        $book->image = $request->input('image');
        $book->publisher_id = $request->input('publisher_id');
        if ($book->image === null) {
            $book->image = "https://i.stack.imgur.com/D2VB2.png";
        };
        $book->save(); 
        // return $book;
        // return $request;
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
