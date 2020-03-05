<?php

namespace App;

use App\Publisher; // we don't need to do this in this case because Publisher and Book are siblings (they are in the same level in the same namespace (inside App))
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    public function publisher()
    {
        return $this->belongsTo(Publisher::class); // we establish a connection between Book and Publisher. One book can only have one publisher and one publisher can have many books, so 'Book' belongs to 'Publisher'. We also need to define the other side of the relationship.
        // It NEEDS to be called 'publisher' because Laravel will check the columns on the 'books' table, searching for something that has xxx_id; because there is a "publisher_id" column, that's where the connection is going to be made.
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
        return $this->belongsToMany(Bookshop::class, 'book_bookshop');
    }
}
