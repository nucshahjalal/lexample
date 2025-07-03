<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model {

    use HasFactory;

    protected $fillable = [
        
        'id',
        'title',
        'note',
        'status',
        'created_by',
        'updated_by'
    ];
    
}
