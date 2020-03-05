<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // if we want to allow mass filling (whitelist):
    protected $fillable = ['user_id', 'email', 'review'];

    // if we want to not allow mass filling (blacklist):
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // to allow mass-filling of everything: protected $guarded = []

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
