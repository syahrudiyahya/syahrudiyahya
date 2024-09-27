<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin2 extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'username', 'email', 'password'
    ];
}
