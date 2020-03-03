<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookQueryBuilderController extends Controller
{
    public function index()
    {
        // $query = DB::table('books')
        // ->limit(10)
        // ->orderBy('title', 'asc');
        // $data = $query->get();
        
        // dd($data);
        
        // Or... [also, the order of the queries is not important, unlike raw sql]
        // $books = DB::table('books')
        // ->limit(10)
        // ->orderBy('title', 'asc')
        // ->where('title', 'like', '%ideas%')
        // ->get();
        
        // If we use ->first() instead of get() it only gets the first object, etc.
        
        // ALSO: we can use the class Book::etc instead of DB::table('books'). We have to use the double colon to call the first method, though (e.g. Book::limit(10)...) or ::query()
        // $books = Book::query()
        //     ->limit(10)
        //     ->orderBy('title', 'asc')
        //     ->where('title', 'like', 'A%')
        //     ->get();
            // ->pluck('authors', 'title');

        
        // NOTE: If using pluck, do not use get().
        
        
        // Converting a collection to a normal array (although we don't want this if we want to display anything)
        // $books = $books->toArray();
        
        
        
        $books = Book::query()
        ->orderBy('title', 'asc')
        ->paginate(15);
        
        // dd($books);
        
        return view('books/page', compact('books'));


    }
}
