<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {

        $genres = Genre::all();
        return view('genres/index', compact('genres'));
    }
    public function show($genre_id)
    {
        $genre = Genre::findOrFail($genre_id);
        $books = Book::where('genre_id', $genre_id)->get();
        return view('genres/show', compact('genre', 'books'));
    }
    
    public function create()
    {
        return view('genres/create');
    }
    
    public function store(Request $request)
    {
        $genre = new Genre; 
        $genre->name = $request->input('name');
        $genre->save();
        return redirect('genres/' . $genre->id);
    }
    }
