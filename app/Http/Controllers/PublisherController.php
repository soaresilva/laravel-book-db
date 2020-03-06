<?php

namespace App\Http\Controllers;

use App\Book;
use App\Publisher;
use Illuminate\Http\Request;

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
        $books = Book::where('publisher_id', $publisher_id)->get();
        return view('publishers/show', compact('publisher', 'books'));
    }

    public function create()
    {
        return view('publishers/create');
    }

    public function store(Request $request)
    {
        $p = new Publisher;
        $p->title = $request->input('title');
        $p->save();
        return $p;
        return $request;
    }
}
