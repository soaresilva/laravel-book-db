<?php

namespace App\Http\Controllers;

use App\Book;
use App\Bookshop;
use Illuminate\Http\Request;

class BookshopController extends Controller
{
    public function index()
    {
        $bookshops = Bookshop::all();
        return view('bookshops.index', compact('bookshops'));
    }
    public function show($id)
    {
        $bookshop = Bookshop::findOrFail($id);
        $books = Book::all();
        return view('bookshops/show', compact('bookshop', 'books'));
    }
    public function create()
    {
        return view('bookshops.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'city' => 'required|max:255',
        ], [
            'city.max' => 'Error: The maximum length is 255 characters.',
        ]);

        $bookshop = new Bookshop;
        $bookshop->name = $request->input('name');
        $bookshop->city = $request->input('city');
        $bookshop->save();
        session()->flash('success_message', 'New bookshop saved!');
        return redirect('bookshops/');
    }

    public function delete($id)
    {
        $bookshop = Bookshop::findOrFail($id);
        $bookshop->delete();
        return redirect('bookshops/');
    }

    public function addBook(Request $request, $id)
    {
        $bookshop = Bookshop::findOrFail($id);
        $book = $request->input('book_id');
        $bookshop->books()->attach($book);

        // quick reminder: these two lines below are the same; we need the first to add queries (e.g. $bookshop->books()->limit(10)->where('id', '<', 5)->get()).
        // return $bookshop->books()->get();
        // return $bookshop->books;

        // using ->toSql() at the end is a GREAT debugging tool!

        // return $bookshop->books()->limit(10)->where('id', '<', 5)->toSql();
        return redirect('bookshops/' . $bookshop->id);
    }
}
