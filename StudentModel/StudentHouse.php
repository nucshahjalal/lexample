<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHouse extends Model {

    use HasFactory;

    protected $fillable = [
        
        'id',
        'name',
        'note',
        'status',
        'created_by',
        'updated_by'
    ];

}
