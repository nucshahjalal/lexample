<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Student\AdmissionRequest;
use App\Models\Student\{Student,StudentType,StudentGroup,StudentHouse,Admission,Enrollment};
use App\Models\Guardian\Guardian;
use App\Models\Studentaccounting\FeeDiscount;
use App\Models\Academic\{Classes,Section};
use App\Models\{Role};
use DB;

class AdmissionController extends Controller
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
        $this->data['admissions'] = Admission::getAdmissionList($filter);
        
        $this->data['filter'] = $filter;
        $this->data['list'] = true;
        $this->data['page_title'] = 'Admission List';
        return view('student.admission.index', $this->data);
    }
    
    public function add() {
        
        $this->data['add'] = true;
        $this->data['page_title'] = 'Admission Add';       
        return view('student.admission.index', $this->data);
    }
    
    public function save(AdmissionRequest $request){
        
        $save = Admission::saveAdmission($request);
        
        if ($save) {
            return to_route('admission.list','class_id='.$request->input('class_id'))->with('success', 'Student admission created successfully.');
        } else {
            return to_route('admission.add')
                ->with('error', 'Student admission created failed, Please try again..')
                ->withInput();
        }
        
    }
    
    public function approve($id) {
      
        $this->data['admission'] = Admission::getSingleAdmission($id);
        $this->data['approve'] = true;  
        $this->data['page_title'] = 'Admission Approve';  
        return view('student.admission.index', $this->data);
    }

    public function update(Request $request){
       
        $admission = Admission::find($request->input('id'));
        if (!$admission) {
            return redirect()->route('admission.edit', $request->input('id'))
                ->with('error', 'Admission not found.');
        }
        $this->saveStudent($request);
        $this->insertEnrollment($request);
        // Update the admission (including photo if provided)
        if ($admission->updateAdmission($admission, $request)) {
            return redirect()->route('admission.list','class_id='.$request->input('class_id'))->with('success', 'Admission updated successfully.');
        } else {
            return redirect()->route('admission.edit', $request->input('id'))
                ->with('error', 'Admission update failed. Please try again.')
                ->withInput();
        }
    }
    
    public function view($id) {
        
        $this->data['admission'] = Admission::getSingleAdmission($id);
        return view('student.admission.view', $this->data);        
    }
    
    public function delete($id){    
        
        if( Admission::deleteStudent($id)) {
            return redirect()->route('admission.list')->with('success', 'Admission deleted successfully.');
        } else {
            return redirect()->route('admission.list')->with('error', 'Failed to delete admission. Please try again.');
        }
    }
    
    // student table data insert
    
    public function saveStudent(Request $request)
        {
            $student = new Student();
            $student->group_id = $request->group_id;
            $student->type_id = $request->type_id;
            $student->house_id = $request->house_id;
            $student->admission_no = $request->admission_no;
            $student->admission_date =  date('Y-m-d', strtotime($request->admission_date));
            $student->first_name = $request->first_name;
            $student->middle_name = $request->middle_name;
            $student->last_name = $request->last_name;
            $student->phone = $request->phone;
            $student->present_address = $request->present_address;
            $student->permanent_address = $request->permanent_address;
            $student->gender = $request->gender;
            $student->blood_group = $request->blood_group;
            $student->religion = $request->religion;
            $student->caste = $request->caste;
            $student->library_member_id = 0;
            $student->hostel_member_id = 0;
            $student->transport_member_id = 0;
            $student->discount_id = $request->discount_id;
            $student->national_id = $request->national_id;
            $student->health_condition = $request->health_condition;
            $student->previous_school = $request->previous_school;
            $student->previous_class = $request->previous_class;
            $student->second_language = $request->second_language;
            $student->other_info = $request->other_info;
            $student->guardian_is = $request->guardian_is;
            $student->guardian_id = $request->guardian_id;
            $student->relation_with = $request->relation_with;
            $student->father_name = $request->father_name;
            $student->father_phone = $request->father_phone;
            $student->father_education = $request->father_education;
            $student->father_profession = $request->father_profession;
            $student->mother_name = $request->mother_name;
            $student->mother_phone = $request->mother_phone;
            $student->mother_education = $request->mother_education;
            $student->mother_profession = $request->mother_profession;
            $student->dob = date('Y-m-d', strtotime($request->dob));
            $student->age = floor((time() - strtotime($student->dob)) / 31556926);
            
            if ($request->hasFile('photo')) {
                $student->father_photo = Admission::uploadFatherPhoto($request);
            }
            if ($request->hasFile('transfer_certificate')) {
                $student->mother_photo = Admission::uploadMotherPhoto($request);
            }
            if ($request->hasFile('photo')) {
                $student->transfer_certificate = Admission::uploadCertificate($request);
            }
            if ($request->hasFile('transfer_certificate')) {
                $student->photo = Admission::uploadPhoto($request);
            }
            
            $student->status_type = 'regular';
            $student->status = 1;
            $userId = Admission::createUser($request);
            $student->user_id = $userId;
            $student->save();   
        }
    
    private static function createUser($request){
        
        $data = array();
        $data['role_id']    = $request->role_id;
        $data['username']   = $request->username;
        $data['email']   = $request->email;
        $data['password']   = Hash::make($request->password);
        $data['temp_password'] = base64_encode($request->password);
        $data['status'] = 1;
        $data['created_by'] = auth()->user()->id;
        $data['created_at'] = date('Y-m-d H:i:s');
        
        return DB::table('users')->insertGetId($data);  
                
       /* 
        $this->_send_sms($data);        
        return $user_id;        
        */  
        
    }
    
    public function insertEnrollment(Request $request)
        {    
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
    
    public function getGuardianById(Request $request){
        
        $guardian = Guardian::find($request->guardian_id);
        return json_encode($guardian);
    }
    
    public function declineStatus(Request $request)
        {
            $admission = new Admission();
            $admission = Admission::find($request->decline_id);
            $admission->status = 3;
            $admission->updated_by = auth()->user()->id;
            $admission->save();   
        }
    
    public function waitingStatus(Request $request)
        {
            $admission = new Admission();
            $admission = Admission::find($request->waiting_id);
            $admission->status = 2;
            $admission->updated_by = auth()->user()->id;
            $admission->save();   
        }
}
