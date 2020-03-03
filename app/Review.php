<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // if we want to allow mass filling (whitelist):
    protected $fillable = ['author', 'email', 'review'];
    
    // if we want to not allow mass filling (blacklist):
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    // to allow mass-filling of everything: protected $guarded = []
    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
