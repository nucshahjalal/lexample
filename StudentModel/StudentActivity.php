<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentActivity extends Model {

    use HasFactory;

    protected $fillable = [
        
        'id',
        'user_id',
        'student_id',
        'class_id',
        'section_id',
        'academic_year_id',
        'activity',
        'activity_date',
        'status',
        'created_by',
        'updated_by'
    ];
    
    public static function getActivityList($filter) {
        
        if(!empty($filter)){
            
            $activities = StudentActivity::from('student_activities as A')
                          ->join('classes as C', 'C.id','=', 'A.class_id')
                          ->join('sections as S', 'S.id','=', 'A.section_id')
                          ->join('students as ST', 'ST.id','=', 'A.student_id')
                          ->join('enrollments as E', 'ST.id','=', 'E.student_id')
                          ->join('academic_years as AY', 'AY.id','=', 'A.academic_year_id')
                          ->where('A.activity_date', 'like', '%'.$filter.'%')
                          ->orWhere('A.activity_date', 'like', '%'.$filter.'%')
                          ->orderBy('A.class_id','asc')
                          ->latest()
                          ->paginate(10, array('A.*','ST.first_name','ST.middle_name','ST.last_name','C.name as class_name','S.name as section_name','AY.session_year'));
        }else{
            
            $activities = StudentActivity::from('student_activities as A')
                          ->join('classes as C', 'C.id','=', 'A.class_id')
                          ->join('sections as S', 'S.id','=', 'A.section_id')
                          ->join('students as ST', 'ST.id','=', 'A.student_id')
                          ->join('enrollments as E', 'ST.id','=', 'E.student_id')
                          ->join('academic_years as AY', 'AY.id','=', 'A.academic_year_id')
                          ->orderBy('A.class_id','asc')
                          ->latest()
                          ->paginate(10, array('A.*','ST.first_name','ST.middle_name','ST.last_name','C.name as class_name','S.name as section_name','AY.session_year'));    
         }
        return $activities;
    }
    
    public static function getSingleActivity($id) {
        
        $activity = StudentActivity::from('student_activities as A')
                    ->join('classes as C', 'C.id','=', 'A.class_id')
                    ->join('sections as S', 'S.id','=', 'A.section_id')
                    ->join('students as ST', 'ST.id','=', 'A.student_id')
                    ->join('enrollments as E', 'ST.id','=', 'E.student_id')
                    ->join('academic_years as AY', 'AY.id','=', 'A.academic_year_id')
                    ->where('A.id', $id)
                    ->first(['A.*','ST.first_name','ST.middle_name','ST.last_name','C.name as class_name','S.name as section_name','AY.session_year']);
        return $activity;
    }
    
}
