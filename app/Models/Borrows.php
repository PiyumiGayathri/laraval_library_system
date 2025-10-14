<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    protected $table = 'borrows'; //borrows table
    protected $fillable = ['borrowed_at','returned_at', 'users_id','books_id','status'];

    public $timestamps = false;
}