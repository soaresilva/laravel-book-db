<?php

namespace App\Http\Controllers;

use App\Book;
use App\Publisher;
use Illuminate\Http\Request;

// use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{
    public function index()
    {

        $publishers = Publisher::all();
        return view('publishers/index', compact('publishers'));
    }

    public function show($publisher_id)
    {
        $publisher = Publisher::findOrFail($publisher_id);
        // $query = "
        //     SELECT *
        //     FROM `books`
        //     WHERE `publisher_id` LIKE $publisher_id
        //     ";
        // $books = DB::select($query, []);
        $books = Book::where('publisher_id', $publisher_id)->get(); // this does the same as the request above; we don't need to link DB if we use this code
        return view('publishers/show', compact('publisher', 'books'));
    }

    public function create()
    {
        return view('publishers/create'); // or publishers.create, but I prefer with /
    }
    
    public function store(Request $request)
    {
        $p = new Publisher; // this creates a new object of the type publisher
        $p->title = $request->input('title'); // the first 'title' refers to the column in the database; the second part of the code grabs the info from the form (->input('title'))* and stores the new publisher
        // * (in this case, our input form has the name="title")
        $p->save(); // this function saves our input in the database
        return $p;
        return $request;
    }
}

// on line 25 it obviously wouldn't work with `$publisher_id` - the backticks needed to be gone
