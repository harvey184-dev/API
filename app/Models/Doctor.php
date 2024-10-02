<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $fillable = ['name', 'cccd', 'phone', 'email', 'username', 'address', 'sex', 'birthday', 'brandID'];
}
