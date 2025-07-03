<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Guardian\Guardian;
use App\Models\Student\{Enrollment, StudentActivity};
use App\Models\User;
use DB;

class Student extends Model {

    use HasFactory;

    protected $fillable = [
        
        'id',
        'user_id',
        'group_id',  
        'type_id',
        'house_id',
        'admission_no',
        'registration_no',
        'admission_date',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'present_address',
        'permanent_address',
        'gender',
        'blood_group',
        'religion',
        'caste',
        'dob',
        'age',
        'photo',
        'library_member_id',
        'hostel_member_id',
        'transport_member_id',
        'discount_id',
        'national_id',
        'health_condition',
        'previous_school',
        'previous_class',  
        'transfer_certificate',
        'second_language',
        'other_info',
        'guardian_is',
        'guardian_id',
        'relation_with',
        'father_name',
        'father_phone',
        'father_education',
        'father_profession',
        'father_photo',
        'mother_name',
        'mother_phone',
        'mother_education',
        'mother_profession',
        'mother_photo',
        'status_type',
        'status',
        'created_by',
        'updated_by'
    ];
    
    public function setFirstNameAttribute($value)
        {
            $this->attributes['first_name'] = ucfirst($value);
        }
     
    public function setMiddleNameAttribute($value)
        {
            $this->attributes['middle_name'] = ucfirst($value);
        }
        
    public function setLastNameAttribute($value)
        {
            $this->attributes['last_name'] = ucfirst($value);
        }
        
    public static function getStudentList($filter, $class_id = null, $academic_year_id = null ) {
        
        if(!empty($filter)){
            
            $students = Student::from('students as S')
                        ->join('enrollments AS E', 'S.id','=', 'E.student_id')
                        ->join('classes AS C', 'C.id','=', 'E.class_id')
                        ->join('sections AS SC', 'SC.id','=', 'E.section_id')
                        ->join('student_types AS T', 'T.id','=', 'S.type_id')
                        ->join('student_groups AS G', 'G.id','=', 'S.group_id')
                        ->join('guardians AS GUA', 'GUA.id','=', 'S.guardian_id')
                        ->join('student_houses AS H', 'H.id','=', 'S.house_id')
                        ->join('fee_discounts AS D', 'D.id','=', 'S.discount_id')
                        ->join('academic_years AS AY', 'AY.id','=', 'E.academic_year_id')
                        ->where('E.class_id', $class_id)
                        ->where('AY.is_running', 1)
                        ->where('E.academic_year_id', 1)
                        ->orWhere('S.first_name', 'like', '%'.$filter.'%')
                        ->orWhere('S.phone', 'like', '%'.$filter.'%')
                        ->latest()
                        ->paginate(10, array('S.*','C.name as class_name','SC.name as section_name','T.type AS type','G.title as group','GUA.name AS guardian','H.name as house','D.title as discount'));
        }else{
            
            $students = Student::from('students as S')
                        ->join('enrollments AS E', 'S.id','=', 'E.student_id')
                        ->join('classes AS C', 'C.id','=', 'E.class_id')
                        ->join('sections AS SC', 'SC.id','=', 'E.section_id')
                        ->join('student_types AS T', 'T.id','=', 'S.type_id')
                        ->join('student_groups AS G', 'G.id','=', 'S.group_id')
                        ->join('guardians AS GUA', 'GUA.id','=', 'S.guardian_id')
                        ->join('student_houses AS H', 'H.id','=', 'S.house_id')
                        ->join('fee_discounts AS D', 'D.id','=', 'S.discount_id')
                        ->join('academic_years AS AY', 'AY.id','=', 'E.academic_year_id')
                        ->where('E.class_id', $class_id)
                        ->where('E.academic_year_id', 1)
                        ->where('AY.is_running', 1)
                        ->latest()
                        ->paginate(10, array('S.*','C.name as class_name','SC.name as section_name','T.type AS type','G.title as group','GUA.name AS guardian','H.name as house','D.title as discount'));
        }
        return $students;
    }
    
    public static function getAdvancedStudentList($filter, $class_id = null, $end_year = null ) {
        
        if(!empty($filter)){
            
            $students = Student::from('students as S')
                        ->join('enrollments AS E', 'S.id','=', 'E.student_id')
                        ->join('classes AS C', 'C.id','=', 'E.class_id')
                        ->join('sections AS SC', 'SC.id','=', 'E.section_id')
                        ->join('student_types AS T', 'T.id','=', 'S.type_id')
                        ->join('student_groups AS G', 'G.id','=', 'S.group_id')
                        ->join('guardians AS GUA', 'GUA.id','=', 'S.guardian_id')
                        ->join('student_houses AS H', 'H.id','=', 'S.house_id')
                        ->join('fee_discounts AS D', 'D.id','=', 'S.discount_id')
                        ->join('academic_years AS AY', 'AY.id','=', 'E.academic_year_id')
                        ->where('E.class_id', $class_id)
                        ->where('AY.start_year' ,'>', $end_year)
                        ->orWhere('S.first_name', 'like', '%'.$filter.'%')
                        ->orWhere('S.phone', 'like', '%'.$filter.'%')
                        ->paginate(10, array('S.*','C.name as class_name','SC.name as section_name','T.type AS type','G.title as group','GUA.name AS guardian','H.name as house','D.title as discount','AY.session_year'));
        }else{
            
            $students = Student::from('students as S')
                        ->join('enrollments AS E', 'S.id','=', 'E.student_id')
                        ->join('classes AS C', 'C.id','=', 'E.class_id')
                        ->join('sections AS SC', 'SC.id','=', 'E.section_id')
                        ->join('student_types AS T', 'T.id','=', 'S.type_id')
                        ->join('student_groups AS G', 'G.id','=', 'S.group_id')
                        ->join('guardians AS GUA', 'GUA.id','=', 'S.guardian_id')
                        ->join('student_houses AS H', 'H.id','=', 'S.house_id')
                        ->join('fee_discounts AS D', 'D.id','=', 'S.discount_id')
                        ->join('academic_years AS AY', 'AY.id','=', 'E.academic_year_id')
                        ->where('E.class_id', $class_id)
                        ->where('AY.start_year','>',$end_year)
                        ->paginate(10, array('S.*','C.name as class_name','SC.name as section_name','T.type AS type','G.title as group','GUA.name AS guardian','H.name as house','D.title as discount','AY.session_year'));
        }
        return $students;
    }
    
    public static function getSingleStudent($id) {
               
        $student = Enrollment::from('enrollments as E')
                   ->join('students AS S', 'S.id','=', 'E.student_id')
                   ->join('classes AS C', 'C.id','=', 'E.class_id')
                   ->join('sections AS SC', 'SC.id','=', 'E.section_id')
                   ->join('student_types AS T', 'T.id','=', 'S.type_id')
                   ->join('student_groups AS G', 'G.id','=', 'S.group_id')
                   ->join('guardians AS GUA', 'GUA.id','=', 'S.guardian_id')
                   ->join('student_houses AS H', 'H.id','=', 'S.house_id')
                   ->join('fee_discounts AS D', 'D.id','=', 'S.discount_id')
                   ->where('S.id', $id)
                   ->first(['S.*','E.roll_no','E.class_id','E.section_id','E.academic_year_id','C.name as class_name','SC.name as section_name','T.type AS type','G.title as group','GUA.name AS guardian','H.name as house','D.title as discount']);
        return $student;
    }
   
    public static function getActivityList($id) {
        
        $activity = StudentActivity::from('student_activities as A')
                    ->join('classes as C', 'C.id','=', 'A.class_id')
                    ->join('sections as S', 'S.id','=', 'A.section_id')
                    ->join('students as ST', 'ST.id','=', 'A.student_id')
                    ->join('enrollments as E', 'ST.id','=', 'E.student_id')
                    ->join('academic_years as AY', 'AY.id','=', 'A.academic_year_id')
                    ->where('A.student_id', $id)
                    ->get(['A.*','ST.first_name','ST.middle_name','ST.last_name','C.name as class_name','S.name as section_name','AY.session_year']);
        return $activity;
    }
    
    public static function saveStudent($request)
    {
        
        $data = $request->all();
        
        $fatherPhoto  = self::uploadFatherPhoto($request);
        $motherPhoto = self::uploadMotherPhoto($request);
        $photo = self::uploadPhoto($request);
        $transferCertificate = self::uploadCertificate($request);
        $userId = self::createUser($request);        

        $data['created_by'] = auth()->user()->id;
        $data['user_id'] = $userId;
        $data['father_photo'] = $fatherPhoto;
        $data['mother_photo'] = $motherPhoto;
        $data['photo'] = $photo;
        $data['transfer_certificate'] = $transferCertificate;
        
        $data['dob'] = date('Y-m-d', strtotime($request->dob));
        $data['age'] = floor((time() - strtotime($data['dob'])) / 31556926);
        $data['admission_date'] = date('Y-m-d', strtotime($request->admission_date));
        $data['status_type'] = 'regular';
        
        //guardian table update
        $guardian =  Guardian::latest()->first();
        if($request->is_guardian == 'exist_guardian' ){
            $data['guardian_id'] = $request->guardian_id;
        }else{
            $data['guardian_id'] = $guardian->id;
        }
        $save = self::create($data);
        return $save;
    }
    
    public static function updateStudent($student, $request)
    {
        //$student->fill(collect($request->all()));
        $student->fill(collect($request->all())->except('father_photo','mother_photo','photo','transfer_certificate')->toArray());
        if ($request->hasFile('father_photo')) {
            $student->father_photo  = self::uploadFatherPhoto($request);
        }
        if ($request->hasFile('mother_photo')) {
            $student->mother_photo  = self::uploadMotherPhoto($request);
        }
        if ($request->hasFile('photo')) {
            $student->photo  = self::uploadPhoto($request);
        }
        if ($request->hasFile('transfer_certificate')) {
            $student->transfer_certificate = self::uploadCertificate($request);
        }
        
        $student->dob = date('Y-m-d', strtotime($request->dob)); 
        $student->age = floor((time() - strtotime($student->dob)) / 31556926);
        $student->admission_date = date('Y-m-d', strtotime($request->admission_date));     
        $student->updated_by = auth()->user()->id;     
        
         DB::table('users')
                 ->where('id', $request->user_id)
                 ->update(['role_id' => $request->role_id]);

        return  $student->update();
        
    }
    
    public static function deleteStudent($id){
        
        // Find the student entry
        $student = self::find($id);

        // Check if the student photo entry exists
        if (!$student) {
            return FALSE;
        }
        
        // Delete the photo file if it exists
        if ($student->father_photo) {
            
            $image_path = config('constants.UPLOAD_PATH').'student/'.$student->father_photo;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }           
        }
        if ($student->mother_photo) {
            
            $image_path = config('constants.UPLOAD_PATH').'student/'.$student->mother_photo;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }           
        }
        if ($student->photo) {
            
            $image_path = config('constants.UPLOAD_PATH').'student/'.$student->photo;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }           
        }
        
        if ($student->transfer_certificate) {
            $image_path = config('constants.UPLOAD_PATH').'student/'.$student->transfer_certificate;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
        }

        $student->delete($id);
        
        // NOw we need to delete user
        $user = User::findOrFail($student->user_id);
        $user->delete();
        
        return TRUE;
        
    }
    
    private static function uploadFatherPhoto($request){
        
        $photo = '';
        if ($request->hasFile('father_photo')) {
            
            $father_photo_prev = $request->input('father_photo_prev') ? $request->input('father_photo_prev') : '';
            $image_path = config('constants.UPLOAD_PATH').'student/'.$father_photo_prev;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
             
            $photo = date('Y-m-d').'-'. $request->input('username').'-student-father-photo.' . $request->father_photo->extension();
            $request->file('father_photo')->move(config('constants.UPLOAD_PATH').'student', $photo);            
                        
        }  
        
        return $photo;
        
    }
    
    private static function uploadMotherPhoto($request){
        
        $photo = '';
        if ($request->hasFile('mother_photo')) {
            
            $mother_photo_prev = $request->input('mother_photo_prev') ? $request->input('mother_photo_prev') : '';
            $image_path = config('constants.UPLOAD_PATH').'student/'.$mother_photo_prev;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
             
            $photo = date('Y-m-d').'-'. $request->input('username').'-student-mother-photo.' . $request->mother_photo->extension();
            $request->file('mother_photo')->move(config('constants.UPLOAD_PATH').'student', $photo);            
                        
        }  
        
        return $photo;
        
    }
    
    private static function uploadPhoto($request){
        
        $photo = '';
        if ($request->hasFile('photo')) {
            
            $photo_prev = $request->input('photo_prev') ? $request->input('photo_prev') : '';
            $image_path = config('constants.UPLOAD_PATH').'student/'.$photo_prev;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
             
            $photo = date('Y-m-d').'-'. $request->input('username').'-student-photo.' . $request->photo->extension();
            $request->file('photo')->move(config('constants.UPLOAD_PATH').'student', $photo);            
                        
        }  
        
        return $photo;
        
    }
    
    private static function uploadCertificate($request){
        
        $photo = '';
        if ($request->hasFile('transfer_certificate')) {
            
            $transfer_certificate_prev = $request->input('transfer_certificate_prev') ? $request->input('transfer_certificate_prev') : '';
            $image_path = config('constants.UPLOAD_PATH').'student/'.$transfer_certificate_prev;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
             
            $photo = date('Y-m-d').'-'. $request->input('username').'-student-certificate-photo.' . $request->transfer_certificate->extension();
            $request->file('transfer_certificate')->move(config('constants.UPLOAD_PATH').'student', $photo);            
                        
        }  
        
        return $photo;
        
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
}
