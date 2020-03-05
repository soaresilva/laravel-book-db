<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookshop extends Model
{
    protected $table = 'bookshops';

    protected $fillable = [
        'name',
        'city',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_bookshop');
    }}
