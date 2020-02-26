<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}