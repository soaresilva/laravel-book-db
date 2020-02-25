<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::select('SELECT * FROM `books`');
        $name = 'Diogo';
        $surname = 'Silva';
        // $view = view('books')
            // ->with('user', $name)
            // ->with('surname', $surname);
             // this 'user' is equals to $user in the books.php; it's basically the key. when using multiple lines, only the last one needs ;! 
             
            // OR 
        // $view = view('books')
        //     ->with([
        //         'user' => $name,
        //         'surname' => $surname
        //     ]);
            
            // OR
            
        // $view = view('books', [
        // 'user' => $name,
        // 'surname' => $surname
        // ]);
        
        // OR, if the name of the variable on the controller matches the name of the variable on the view
         
        $user = 'Diogo';
        $comment = 'I like your app!';
        $age = 12;
        $view = view('books', compact('user', 'surname', 'age', 'books'));
        
        return $view;
    }
}