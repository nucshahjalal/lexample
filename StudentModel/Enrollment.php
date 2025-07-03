<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model {

    use HasFactory;

    protected $fillable = [
        
        'id',
        'student_id',
        'class_id',
        'section_id',
        'academic_year_id',
        'roll_no',
        'enroll_type',
        'status',
        'created_by',
        'updated_by'
    ];
    
}
