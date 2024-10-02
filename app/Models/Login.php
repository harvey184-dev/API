<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $fillable = ['username', 'password', 'role']; // role: 0: hospital, 1: doctor
}
