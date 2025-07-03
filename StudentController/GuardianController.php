<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Guardian\GuardianRequest;
use App\Models\Guardian\Guardian;
use App\Models\{Role};

class GuardianController extends Controller
{
    public $data = array();
    
    public function __construct() { 
        
        $this->data['roles'] = Role::where(['status'=>1])->get();
    }
    
    public function index(Request $request) {
      
        $filter = $request->filter;
        if (!empty($filter)) {         
            $this->data['guardians'] = Guardian::latest()
                    ->where('guardians.name', 'like', '%'.$filter.'%')
                    ->orWhere('guardians.national_id', 'like', '%'.$filter.'%')
                    ->orWhere('guardians.phone', 'like', '%'.$filter.'%')
                    ->orWhere('guardians.profession', 'like', '%'.$filter.'%')
                    ->paginate(10);
        } else {
           $this->data['guardians'] = Guardian::latest()->paginate(10);
        }
        
        $this->data['filter'] = $filter;
        $this->data['list'] = true;
        $this->data['page_title'] = 'Guardian List';
        return view('guardian.guardian.index', $this->data);
    }

    public function add() {
        
        $this->data['add'] = true;
        $this->data['page_title'] = 'Guardian Add';       
        return view('guardian.guardian.index', $this->data);
    }

    public function save(GuardianRequest $request){
        
        $save = Guardian::saveGuardian($request);

        if ($save) {
            return to_route('manage-guardian.list')->with('success', 'Guardian created successfully.');
        } else {
            return to_route('manage-guardian.add')
                ->with('error', 'Guardian created failed, Please try again..')
                ->withInput();
        }
    }

    public function edit($id) {
        
        $this->data['guardian'] = Guardian::find($id);
        $this->data['edit'] = true;      
        return view('guardian.guardian.index', $this->data);
    }

    public function update(Request $request){
    
        $guardian = Guardian::find($request->input('id'));
        
        if (!$guardian) {
            return redirect()->route('manage-guardian.edit', $request->input('id'))
                ->with('error', 'Guardian not found.');
        }

        // Update the photo (including photo if provided)
        if ($guardian->updateGuardian($guardian, $request)) {
            return redirect()->route('manage-guardian.list')->with('success', 'Guardian updated successfully.');
        } else {
            return redirect()->route('manage-guardian.edit', $request->input('id'))
                ->with('error', 'Guardian update failed. Please try again.')
                ->withInput();
        }
    }
    
    public function view($guardian_id) {
        
        $this->data['guardian'] = Guardian::getSingleGuardian($guardian_id);
        $this->data['students'] = Guardian::getStudentList($guardian_id);
        return view('guardian.guardian.view', $this->data);        
    }
    
    public function delete($id){    
        
        if( Guardian::deleteGuardian($id)) {
            return redirect()->route('manage-guardian.list')->with('success', 'Guardian deleted successfully.');
        } else {
            return redirect()->route('manage-guardian.list')->with('error', 'Failed to delete guardian. Please try again.');
        }
    }
    
}
