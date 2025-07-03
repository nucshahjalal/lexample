<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Student\StudentRequest;
use App\Models\Student\{StudentType,StudentGroup,StudentHouse,Student,Enrollment};
use App\Models\Guardian\Guardian;
use App\Models\Studentaccounting\FeeDiscount;
use App\Models\Academic\{Classes,Section};
use App\Models\{Role};
use DB;

class StudentController extends Controller
{
    public $data = array();

    public function __construct() {    
        
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
        $this->data['students'] = Student::getStudentList($filter,$class_id);
        
        $this->data['filter'] = $filter;
        $this->data['list'] = true;
        $this->data['page_title'] = 'Student List';
        return view('student.student.index', $this->data);
    }
    
    public function add() {
        
        $this->data['add'] = true;
        $this->data['page_title'] = 'Student Add';       
        return view('student.student.index', $this->data);
    }
    
    public function save(StudentRequest $request){
        
        if($request->is_guardian != 'exist_guardian'){
            $this->saveGuardian($request);
        } 
        $save = Student::saveStudent($request);
         // enrollment table data insert
        $this->insertEnrollment($request);
        if ($save) {
            return to_route('manage-student.list','class_id='.$request->input('class_id'))->with('success', 'Student created successfully.');
        } else {
            return to_route('manage-student.add')
                ->with('error', 'Student created failed, Please try again..')
                ->withInput();
        }
    }
    
    public function edit($id) {
      
        $this->data['student'] = Student::getSingleStudent($id);
        $this->data['sections'] = Section::where('class_id',$this->data['student']->class_id)->get();
        $this->data['edit'] = true;  
        $this->data['page_title'] = 'Student Edit';  
        return view('student.student.index', $this->data);
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
            return redirect()->route('manage-student.list','class_id='.$request->input('class_id'))->with('success', 'Student updated successfully.');
        } else {
            return redirect()->route('manage-student.edit', $request->input('id'))
                ->with('error', 'Student update failed. Please try again.')
                ->withInput();
        }
    }
    
    public function view($id) {
        
        $this->data['student'] = Student::getSingleStudent($id);
        $this->data['activity'] = Student::getActivityList($id);
        return view('student.student.view', $this->data);        
    }
    
    public function delete($id){    
        
        if( Student::deleteStudent($id)) {
            return redirect()->route('manage-student.list')->with('success', 'Student deleted successfully.');
        } else {
            return redirect()->route('manage-student.list')->with('error', 'Failed to delete student. Please try again.');
        }
    }
    
    public function getGuardianById(Request $request){
        
        $guardian = Guardian::find($request->guardian_id);
        return json_encode($guardian);
    }    
    
    public function updateStatus(Request $request){
        
        $student = Student::find($request->student_id);
        $student->id = $request->student_id;
        $student->status_type = $request->status_type;
        $student->created_at = date('Y-m-d H:i:s');
        $student->updated_by = auth()->user()->id;
        $student->save();
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
        $enrollment->academic_year_id = 1;
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
    
    //multiple image and student data update list
    public function updateStudent(Request $request){
        
        $filter = $request->filter;
        $class_id = $request->class_id;
        if (empty(!$filter) || empty($filter)) {        
            $this->data['students'] = Student::getStudentList($filter, $class_id);
        } else {
          $this->data['students'] = Student::latest()->paginate(10);
        }
        $this->data['list'] = true;
        return view('student.student.updateStudent',$this->data); 
    }
    
    //multiple image and student data update
    public function updateDisplayStudent(Request $request){        
              
        $first_name = rtrim($request->first_name, ',');
        $last_name = rtrim($request->last_name, ',');
        $middle_name = rtrim($request->middle_name, ',');
        $phone = rtrim($request->phone, ',');
        $father_name = rtrim($request->father_name, ',');
        $mother_name = rtrim($request->mother_name, ',');
        if ($request->hasFile('photo')) {
            $photo  = $this->updatePhoto($request);
        }
        
        $ids = rtrim($request->student_id, ','); 
        
        if(!$ids){  echo FALSE;  die(); }
        
        $ids_arr = explode(',', $ids);
        $first_name_arr = explode(',', $first_name);        
        $middle_name_arr = explode(',', $middle_name); 
        $last_name_arr = explode(',', $last_name);        
        $phone_arr = explode(',', $phone);        
        $father_name_arr = explode(',', $father_name);        
        $mother_name_arr = explode(',', $mother_name);        
       // $photo_arr = explode(',', $photo);        
      
        if(is_array($ids_arr)){
            foreach ($ids_arr as $key => $id) {
            DB::table('students')
                ->where('id', $id)
                    ->update([
                       'first_name' => $first_name_arr[$key],
                       'middle_name' => $middle_name_arr[$key],
                       'last_name' => $last_name_arr[$key],
                       'phone' => $phone_arr[$key],
                       'father_name' => $father_name_arr[$key],
                       'mother_name' => $mother_name_arr[$key],
                      // 'photo' => $photo_arr[$key],
                       'updated_by' => auth()->user()->id
                   ]);
           }
           
           echo TRUE;
        }
        
        echo FALSE;
    }
    
    private static function updatePhoto($request){
        
        $photo = '';
        if ($request->hasFile('photo')) {
            
            $photo_prev = $request->input('photo_prev') ? $request->input('photo_prev') : '';
            $image_path = config('constants.UPLOAD_PATH').'student/'.$photo_prev;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
             
            $photo = date('Y-m-d').'-'. time().'-student-photo.' . $request->photo->extension();
            $request->file('photo')->move(config('constants.UPLOAD_PATH').'student', $photo);            
                        
        }  
        
        return $photo;
        
    }
}
