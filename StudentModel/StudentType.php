<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentType extends Model {

    use HasFactory;

    protected $fillable = [
        
        'id',
        'type',
        'note',
        'status',
        'created_by',
        'updated_by'
    ];

}
