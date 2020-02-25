<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    // protected $table = 'publishers'; -> it didn't need to be connected because the names are all matching; if the class is Publisher it is looking for a table called 'publishers'
    
    public function books()
    {
        return $this->hasMany(Book::class); // this is the other side of the relationship; one publisher has many books. Note the plural in the name of the function, books instead of book, because a publisher can have many books.
    }
}
