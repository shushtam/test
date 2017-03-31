<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testuser extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password'
    ];
}
