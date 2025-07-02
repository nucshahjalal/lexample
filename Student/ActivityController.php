<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Student\StudentActivityRequest;
use App\Models\Student\{StudentActivity,Student,Enrollment};
use App\Models\Academic\{Classes,Section};

class ActivityController extends Controller
{
    public $data = array();

    public function __construct() {    
        
        $this->data['classes'] = Classes::where(['status'=>1])->get();
    }
    
    public function index(Request $request) {
       
        $filter = $request->filter;
        $this->data['activities'] = StudentActivity::getActivityList($filter);
        
        $this->data['filter'] = $filter;
        $this->data['list'] = true;
        $this->data['page_title'] = 'Activity List';
        return view('student.activity.index', $this->data);
    }

    public function add() {
        
        $this->data['add'] = true;
        $this->data['page_title'] = 'Activity Add';       
        return view('student.activity.index', $this->data);
    }

    public function save(StudentActivityRequest $request) {  
   
        $request->merge(['created_by'=> auth()->user()->id]); 
        $request->merge(['activity_date'=> date('Y-m-d', strtotime($request->activity_date))]);
        $request->merge(['user_id'=> auth()->user()->id]);
        $request->merge(['academic_year_id'=> 1]);
        $save  = StudentActivity::create($request->all()); 
        
        if($save){
             return to_route('activity.list')->with('success', 'Activity created successfully.');
        }else{
            return to_route('activity.add')                          
                            ->with('error', 'Activity created failed, Please try again..')
                            ->withInput();
        }       
    }

    public function edit($id) {
        
        $this->data['activity'] = StudentActivity::find($id);
        $this->data['sections'] = Section::where('class_id',$this->data['activity']->class_id)->get();
        $this->data['students'] = Student::from('students as S')
                                ->join('enrollments AS E', 'S.id','=', 'E.student_id')
                                ->where('E.section_id', $this->data['activity']->section_id)
                                ->get(['S.id','S.first_name','S.middle_name','S.last_name']);
        $this->data['edit'] = true; 
        $this->data['page_title'] = 'Activity Edit';
        return view('student.activity.index', $this->data);
    }

    public function update(StudentActivityRequest $request) {
          
        $activity = StudentActivity::find($request->input('id'));
        $request->merge(['activity_date'=> date('Y-m-d', strtotime($request->activity_date))]);
        $activity->fill($request->all());
        $activity->updated_by = auth()->user()->id;

        if($activity->update()){
            return to_route('activity.list')->with('success', 'Activity updated successfully.');
        }else{
            return to_route('activity.edit', $request->input('id'))                          
                            ->with('error', 'Activity update failed, Please try again..')
                            ->withInput();
        }        
    }
    
    public function view($id) {
        
        $this->data['activity'] = StudentActivity::getSingleActivity($id);
        return view('student.activity.view', $this->data);        
    }
    
    public function delete($id) {
        
        if(StudentActivity::destroy($id)){
            return to_route('activity.list')->with('success', 'Activity deleted successfully.');
        }else{
            return to_route('activity.list')->with('error', 'Activity deleted failed, Please try again..');
        }
    }
}
