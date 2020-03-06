<?php

namespace App;

use App\Publisher;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function cart()
    {
        return $this->hasOne(CartItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookshops()
    {
        // always use ->withPivot to reference a third column inside the pivot table
        return $this->belongsToMany(Bookshop::class, 'book_bookshop')->withPivot(['count']);
    }

    public function books()
    {
        // reminder: the keys need to be specified if laravel naming conventions are broken (here we reference the books' IDs twice)
        return $this->belongsToMany(Book::class, 'book_book', 'book_id', 'book2_id');
    }
}
