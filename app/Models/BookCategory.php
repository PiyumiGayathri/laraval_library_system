<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $table = 'book_category'; // book_category table
    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function books()
    {
        return $this->hasMany(Books::class, 'book_category_id');
    }
}