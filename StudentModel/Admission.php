<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Guardian\Guardian;
use DB;

class Admission extends Model {

    use HasFactory;

    protected $fillable = [
        
        'id',
        'group_id',
        'type_id',  
        'house_id',
        'class_id',
        'national_id',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'gender',
        'blood_group',
        'phone',
        'email',
        'religion',
        'caste',
        'health_condition',
        'photo',
        'present_address',
        'permanent_address',
        'previous_school',
        'previous_class',
        'second_language',
        'transfer_certificate',
        'guardian_is',
        'guardian_id',
        'gud_relation',
        'gud_name',  
        'gud_phone',
        'gud_email',
        'gud_national_id',
        'gud_present_address',
        'gud_permanent_address',
        'gud_profession',
        'gud_religion',
        'gud_other_info',
        'father_name',
        'father_phone',
        'father_education',
        'father_profession',
        'mother_name',
        'mother_phone',
        'mother_education',
        'mother_profession',
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
        
    public static function getAdmissionList($filter) {
         
        if(!empty($filter)){
            
            $admissions = Admission::from('admissions as A')
                        ->join('classes AS C', 'C.id','=', 'A.class_id')
                        ->join('student_types AS T', 'T.id','=', 'A.type_id')
                        ->join('student_groups AS G', 'G.id','=', 'A.group_id')
                        ->join('guardians AS GUA', 'GUA.id','=', 'A.guardian_id')
                        ->join('student_houses AS H', 'H.id','=', 'A.house_id')
                        ->where('A.first_name', 'like', '%'.$filter.'%')
                        ->orWhere('C.name', 'like', '%'.$filter.'%')
                        ->orWhere('G.title', 'like', '%'.$filter.'%')
                        ->orWhere('A.phone', 'like', '%'.$filter.'%')
                        ->latest()
                        ->paginate(10, array('A.*','C.name as class_name','T.type AS type','G.title as group','GUA.name AS guardian','H.name as house'));
        }else{
            
            $admissions = Admission::from('admissions as A')
                        ->join('classes AS C', 'C.id','=', 'A.class_id')
                        ->join('student_types AS T', 'T.id','=', 'A.type_id')
                        ->join('student_groups AS G', 'G.id','=', 'A.group_id')
                        ->join('guardians AS GUA', 'GUA.id','=', 'A.guardian_id')
                        ->join('student_houses AS H', 'H.id','=', 'A.house_id')
                        ->latest()
                        ->paginate(10, array('A.*','C.name as class_name','T.type AS type','G.title as group','GUA.name AS guardian','H.name as house'));   
        }
        return $admissions;
    }
    
    public static function getSingleAdmission($id) {
               
        $admission =  Admission::from('admissions as A')
                    ->join('classes AS C', 'C.id','=', 'A.class_id')
                    ->join('student_types AS T', 'T.id','=', 'A.type_id')
                    ->join('student_groups AS G', 'G.id','=', 'A.group_id')
                    ->join('guardians AS GUA', 'GUA.id','=', 'A.guardian_id')
                    ->join('student_houses AS H', 'H.id','=', 'A.house_id')
                    ->where('A.id', $id)
                    ->first(['A.*','C.name as class_name','GUA.name AS guardian','T.type AS type','G.title as group','H.name as house']);
        return $admission;
    }
    
    //admission table data save
    public static function saveAdmission($request){
    
        $data = $request->all();
        
        $photo = self::admissionUploadPhoto($request);
        $transferCertificate = self::admissionUploadCertificate($request);

        $data['created_by'] = auth()->user()->id;
        $data['photo'] = $photo;
        $data['transfer_certificate'] = $transferCertificate;
        $data['transfer_certificate'] = $transferCertificate;
        $data['dob'] = date('Y-m-d', strtotime($request->dob));
        $data['age'] = floor((time() - strtotime($data['dob'])) / 31556926);
        
        //guardian table update
        $guardian =  Guardian::latest()->first();
        if($request->is_guardian == 'exist_guardian' ){
            $request->merge(['guardian_id'=> $request->guardian_id]);
        }else{
            $request->merge(['guardian_id'=> $guardian->id]);
        }
        
        $save = self::create($data);
        return $save;
    }
    
    //admission table data update
    public function updateAdmission($student, $request){
    
        $student->fill(collect($request->all())->except('photo','transfer_certificate')->toArray());
        
        if ($request->hasFile('photo')) {
            $student->photo  = self::admissionUploadPhoto($request);
        }
        if ($request->hasFile('transfer_certificate')) {
            $student->transfer_certificate = self::admissionUploadCertificate($request);
        }
        
        $student->dob = date('Y-m-d', strtotime($request->dob)); 
        $student->age = floor((time() - strtotime($student->dob)) / 31556926);
        $student->status = 4;     
        $student->updated_by = auth()->user()->id;     
        
         DB::table('users')
                 ->where('id', $request->user_id)
                 ->update(['role_id' => $request->role_id]);

        return  $student->update();
    }
    
    //admission table data delete
    public static function deleteStudent($id){
        
        // Find the student admission entry
        $student = self::find($id);

        // Check if the student photo entry exists
        if (!$student) {
            return FALSE;
        }
        // Delete the photo file if it exists
        if ($student->photo) {
            
            $image_path = config('constants.UPLOAD_PATH').'admission/'.$student->photo;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }           
        }
        
        if ($student->transfer_certificate) {
            $image_path = config('constants.UPLOAD_PATH').'admission/'.$student->transfer_certificate;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
        }

        $student->delete($id);
        
        // NOw we need to delete user
      //  $user = User::findOrFail($student->user_id);
       // $user->delete();
        
        return TRUE;
    }
    
    //admission table student photo insert
    private static function admissionUploadPhoto($request){
        
        $photo = '';
        if ($request->hasFile('photo')) {
            
            $photo_prev = $request->input('photo_prev') ? $request->input('photo_prev') : '';
            $image_path = config('constants.UPLOAD_PATH').'admission/'.$photo_prev;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
             
            $photo = date('Y-m-d').'-'. $request->input('username').'-student-photo.' . $request->photo->extension();
            $request->file('photo')->move(config('constants.UPLOAD_PATH').'admission', $photo);            
        }  
        
        return $photo;
    }
    
    //admission table student certificate insert
    private static function admissionUploadCertificate($request){
        
        $photo = '';
        if ($request->hasFile('transfer_certificate')) {
            
            $transfer_certificate_prev = $request->input('transfer_certificate_prev') ? $request->input('transfer_certificate_prev') : '';
            $image_path = config('constants.UPLOAD_PATH').'admission/'.$transfer_certificate_prev;
            if(File::exists($image_path)){              
                @unlink($image_path);
            }
             
            $photo = date('Y-m-d').'-'. $request->input('username').'-student-certificate-photo.' . $request->transfer_certificate->extension();
            $request->file('transfer_certificate')->move(config('constants.UPLOAD_PATH').'admission', $photo);            
                        
        }  
        
        return $photo;
        
    }
    
    //student table father photo insert
    public static function uploadFatherPhoto($request){
        
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
    
    //student table mother photo insert
    public static function uploadMotherPhoto($request){
        
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
    
    //student table student photo insert
    public static function uploadPhoto($request){
        
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
    
    //student table student certificate insert
    public static function uploadCertificate($request){
        
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
   
    public static function createUser($request){
        
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
