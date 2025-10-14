<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users'; //users table
    protected $fillable = ['nic','registered_at','first_name', 'last_name', 'mobile','email'];

    public $timestamps = false;
}