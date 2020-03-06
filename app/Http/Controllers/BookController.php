<?php

namespace App\Http\Controllers;

use App\Book;
use App\Bookshop;
use App\Genre;
use App\Publisher;
use App\Review;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->orderBy('title', 'asc')
        // makes it so much faster: it looks through all the books and creates an array with all of them inside, reducing the queries from 102 to 3, and the request duration from 1.4s to 700ms
            ->with('publisher')
            ->with('reviews')
            ->paginate(50);
        return view('books/index', compact('books'));
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $reviews = Review::all();
        $bookshops = Bookshop::all();
        $books = Book::all();
        return view('books/show', compact('book', 'reviews', 'bookshops', 'books'));
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
            $request->file('image_file')->store('covers', 'uploads');
            $original_name = $file->getClientOriginalName();
            $request->file('image_file')->storeAs('covers', $original_name, 'uploads');
        }

        $b = new Book;
        $b->title = $request->input('title');
        $b->authors = $request->input('authors');
        $b->genre_id = $request->input('genre_id');
        // if no file is uploaded, use a placeholder cover
        if (!$file) {
            $b->image = "https://i.stack.imgur.com/D2VB2.png";
        } else {
            $b->image = '/uploads/covers/' . $original_name;
        }
        $b->publisher_id = $request->input('publisher_id');
        $b->save();
        session()->flash('success_message', 'Book created.');
        return redirect('books/' . $b->id);
    }

    public function update(Request $request, $id)
    {

        if ($file = $request->file('image_file')) {
            $request->file('image_file')->store('covers', 'uploads');
            $original_name = $file->getClientOriginalName();
            $request->file('image_file')->storeAs('covers', $original_name, 'uploads');
        }

        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->authors = $request->input('authors');
        $book->genre_id = $request->input('genre_id');
        $book->publisher_id = $request->input('publisher_id');
        // if a book cover exists (no placeholder) and no file is provided, keep previous cover; if it doesn't, set placeholder picture; if file is provided, set it as book cover
        if (!$file) {
            if ($book->image !== 'https://i.stack.imgur.com/D2VB2.png') {
                $book->image = $book->image;
            } else {
                $book->image = "https://i.stack.imgur.com/D2VB2.png";
            }
        } else {
            $book->image = '/uploads/covers/' . $original_name;
        }
        $book->save();
        session()->flash('success_message', 'Book info updated.');
        return redirect('books/' . $book->id);
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        // TODO: create a prompt to ask user 'are you sure you want to delete the book?'
        $book->delete();
        session()->flash('success_message', 'Book deleted.');
        return redirect('books/');
    }

    public function addBookshop(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $bookshop = $request->input('bookshop_id');
        $book->bookshops()->syncWithoutDetaching($bookshop);
        return redirect()->back();
    }

    public function removeBookshop(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $bookshop = $request->input('bookshop');
        $book->bookshops()->detach($bookshop);
        return redirect()->back();
    }

    public function addRelated(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book2 = $request->input('book2');
        $book->books()->syncWithoutDetaching($book2);
        return redirect()->back();
    }

    public function removeRelated(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book2 = $request->input('book2');
        $book->books()->detach($book2);
        return redirect()->back();
    }
}
