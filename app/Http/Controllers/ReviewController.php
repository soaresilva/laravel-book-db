<?php

namespace App\Http\Controllers;

use App\Book;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $book_id)
    {
        $this->validate($request, [
            'author' => 'required',
            'email' => 'required|email',
            'review' => 'required|max:255'
        ], [
            'review.max' => 'Error: The maximum length is 255 characters.'
        ]);
        
        $review = new Review;
        $review->book_id = $book_id;
        // $review->author = $request->input('author');
        // $review->email = $request->input('email');
        // $review->review = $request->input('review');
        
        // to achieve the same as what is commented out above, without repeating ourselves - provided we added info on what $fillable on the Review class declaration:
        $review->fill($request->only(['author', 'email', 'review']));
        
        // or, if we also declared what to blacklist ($guarded):
        // $review->fill($request->all());
        $review->save();
        session()->flash('success_message', 'Review saved!');
        return redirect('books/' . $book_id);
    }
}

// Instead of doing all the above, we can simply do this: assigning $book_id to the review's table in the book_id column, and merge it with the array created by $request->only; Review::create creates the object
        // $data = ['book_id' => $book_id];
        // $data = array_merge($data, $request->only(['author', 'email', 'review']));
        // Review::create($data);
