<?php

namespace App\Http\Controllers;

use App\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::all();
        return view('cart/index', compact('items'));
    }
    
    public function add($book_id)
    {
        $cartItem = CartItem::where('book_id', $book_id)->first(); // you always get an array with an object inside when doing this (collection is another word for array); if we use first instead of get, it gets the first value instead of having to iterate through it.
        // what this does is returning the first object in your database (cart items) that returns something, or it returns null if it doesn't exist.
        // return $item[0]->book->title;
        // return $item;
        
        if($cartItem === null) {
            $cartItem = new CartItem; 
            $cartItem->book_id = $book_id;
            $cartItem->count = 1;
            $cartItem->save();
        } else {
            $cartItem->count++;
            $cartItem->save();
        };

        // return $cartitem;
        // return $request;
        return redirect('cart/');
    }
    
    // public function postAdd(Request $request){
    //     $i = new CartItem;
    //     $i->book_id = $request->input('book_id');
    //     $i->count = 1;
    //     $i->save();
    //     return redirect('/cart');
    // }

    public function emptycart()
    {
        DB::statement('TRUNCATE TABLE `cart_items`');
        return redirect('cart/');
    }
}