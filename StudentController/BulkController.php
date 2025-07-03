<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic\Classes;
use App\Models\Academic\AcademicYear;

class BulkController extends Controller
{
    public $data = array();

    public function __construct() {    
        
        $this->data['academic_years'] = AcademicYear::where(['status'=>1])->get();
        $this->data['classes'] = Classes::where(['status'=>1])->get();
    }
    
    public function index(Request $request) {
       
        $this->data['add'] = true;
        $this->data['page_title'] = 'Bulk List';
        return view('student.bulk.index', $this->data);
    }
}
