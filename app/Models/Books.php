<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books'; //books table
    protected $fillable = ['title', 'author', 'price', 'stock', 'created_at','updated_at', 'book_category_id','status'];

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }
}