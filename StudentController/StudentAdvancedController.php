<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Student\StudentRequest;
use App\Models\Student\{StudentType,StudentGroup,StudentHouse,Student,Enrollment};
use App\Models\Guardian\Guardian;
use App\Models\Studentaccounting\FeeDiscount;
use App\Models\Academic\{Classes, Section, AcademicYear};
use App\Models\{Role};
use DB;

class StudentAdvancedController extends Controller
{
    public $data = array();

    public function __construct() {    
        
        $this->data['session_years'] = AcademicYear::where(['status'=>1])->get();
        $this->data['roles'] = Role::where(['status'=>1])->get();
        $this->data['guardians'] = Guardian::where(['status'=>1])->get();
        $this->data['houses'] = StudentHouse::where(['status'=>1])->get();
        $this->data['discounts'] = FeeDiscount::where(['status'=>1])->get();
        $this->data['types'] = StudentType::where(['status'=>1])->get();
        $this->data['groups'] = StudentGroup::where(['status'=>1])->get();
        $this->data['classes'] = Classes::where(['status'=>1])->get();
    }
    
    public function index(Request $request) {
        
        $filter = $request->filter;
        $class_id = $request->class_id;
        $session_years = AcademicYear::where(['status'=>1])->first();
        $this->data['students'] = Student::getAdvancedStudentList($filter,$class_id,$session_years);
        
        $this->data['filter'] = $filter;
        $this->data['list'] = true;
        $this->data['page_title'] = 'Student List';
        return view('student.advancedStudent.index', $this->data);
    }
    
    public function add() {
        
        $this->data['add'] = true;
        $this->data['page_title'] = 'Student Add';       
        return view('student.advancedStudent.index', $this->data);
    }
    
    public function save(StudentRequest $request){
        
        if($request->is_guardian != 'exist_guardian'){
            $this->saveGuardian($request);
        } 
        $save = Student::saveStudent($request);
         // enrollment table data insert
        $this->insertEnrollment($request);
        if ($save) {
            return to_route('advanced-student.list','class_id='.$request->input('class_id'))->with('success', 'Student created successfully.');
        } else {
            return to_route('advanced-student.add')
                ->with('error', 'Student created failed, Please try again..')
                ->withInput();
        }
    }
    
    public function edit($id) {
      
        $this->data['student'] = Student::getSingleStudent($id);
        $this->data['sections'] = Section::where('class_id',$this->data['student']->class_id)->get();
        $this->data['edit'] = true;  
        $this->data['page_title'] = 'Student Edit';  
        return view('student.advancedStudent.index', $this->data);
    }

    public function update(StudentRequest $request){
     
        $student = Student::find($request->input('id'));
        if (!$student) {
            return redirect()->route('manage-student.edit', $request->input('id'))
                ->with('error', 'Student not found.');
        }
         // enrollment table data update
        $this->updateEnrollment($request);
        // Update the student (including photo if provided)
        if($student->updateStudent($student, $request)) {
            return redirect()->route('advanced-student.list','class_id='.$request->input('class_id'))->with('success', 'Student updated successfully.');
        } else {
            return redirect()->route('advanced-student.edit', $request->input('id'))
                ->with('error', 'Student update failed. Please try again.')
                ->withInput();
        }
    }
    
    public function view($id) {
        
        $this->data['student'] = Student::getSingleStudent($id);
        $this->data['activity'] = Student::getActivityList($id);
        return view('student.advancedStudent.view', $this->data);        
    }
    
    public function delete($id){    
        
        if( Student::deleteStudent($id)) {
            return redirect()->route('advanced-student.list')->with('success', 'Student deleted successfully.');
        } else {
            return redirect()->route('advanced-student.list')->with('error', 'Failed to delete student. Please try again.');
        }
    }
    
    public function getGuardianById(Request $request){
        
        $guardian = Guardian::find($request->guardian_id);
        return json_encode($guardian);
    }    
    
    public function saveGuardian(Request $request){
        
        $guardian = new Guardian();
        $guardian->user_id = auth()->user()->id;
        $guardian->name = $request->gud_name;
        $guardian->national_id = $request->gud_national_id;
        $guardian->phone = $request->gud_phone;
        $guardian->profession = $request->gud_profession;
        $guardian->religion = $request->gud_religion;
        $guardian->other_info = $request->other_info;
        $guardian->present_address = $request->gud_present_address;
        $guardian->permanent_address = $request->gud_permanent_address;
        $guardian->other_info = $request->gud_other_info;
        $guardian->status = 1;
        $guardian->created_at = date('Y-m-d H:i:s');
        $guardian->created_by = auth()->user()->id;
        $guardian->save();
    }
    
    // enrollment table data insert
    public function insertEnrollment(Request $request){
        
        $enrollment = new Enrollment();
        $student =  Student::latest()->first();
        $enrollment->student_id = $student->id;
        $enrollment->class_id = $request->class_id;
        $enrollment->section_id = $request->section_id;
        $enrollment->roll_no = $request->roll_no;
        $enrollment->enroll_type = 'requested';
        $enrollment->academic_year_id = $request->academic_year_id;
        $enrollment->status = 1;
        $enrollment->created_at = date('Y-m-d H:i:s');
        $enrollment->created_by = auth()->user()->id;
        $enrollment->save();   
    } 
        
     // enrollment table data update
    public function updateEnrollment(Request $request){
        
        $enrollment = Enrollment::find($request->id);

        $enrollment->student_id = $request->id;
        $enrollment->class_id = $request->class_id;
        $enrollment->section_id = $request->section_id;
        $enrollment->roll_no = $request->roll_no;
        $enrollment->enroll_type = 'requested';
        $enrollment->status = 1;
        $enrollment->created_at = date('Y-m-d H:i:s');
        $enrollment->updated_by = auth()->user()->id;
        $enrollment->save(); 
    } 
}
