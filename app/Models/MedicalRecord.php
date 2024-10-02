<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $fillable = ['doctorID', 'hospitalID', 'name', 'result', 'cccdPatient'];
}
