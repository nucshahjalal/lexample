<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Student\StudentGroupRequest;
use App\Models\Student\StudentGroup;

class StudentGroupController extends Controller
{
    public $data = array();

    public function index(Request $request) {
       
        $filter = $request->filter;
        if (empty(!$filter)) {         
            $this->data['groups'] = StudentGroup::latest()
                    ->where('student_groups.title', 'like', '%'.$filter.'%')
                    ->orWhere('student_groups.note', 'like', '%'.$filter.'%')
                    ->paginate(10);
        } else {
          $this->data['groups'] = StudentGroup::latest()->paginate(10);
        }
        
        $this->data['filter'] = $filter;
        $this->data['list'] = true;
        $this->data['page_title'] = 'Group List';
        return view('student.group.index', $this->data);
    }

    public function add() {
        
        $this->data['add'] = true;
        $this->data['page_title'] = 'Group Add';       
        return view('student.group.index', $this->data);
    }

    public function save(StudentGroupRequest $request) {  
   
        $request->merge(['created_by'=>auth()->user()->id]);        
        $save  = StudentGroup::create($request->all()); 
        
        if($save){
             return to_route('group.list')->with('success', 'Group created successfully.');
        }else{
            return to_route('group.add')                          
                            ->with('error', 'Group created failed, Please try again..')
                            ->withInput();
        }       
    }

    public function edit($id) {
        
        $this->data['group'] = StudentGroup::find($id);
        $this->data['edit'] = true;      
        $this->data['page_title'] = 'Group Edit'; 
        return view('student.group.index', $this->data);
    }

    public function update(StudentGroupRequest $request) {
          
        $group = StudentGroup::find($request->input('id'));
        $group->fill($request->all());
        $group->updated_by = auth()->user()->id;

        if($group->update()){
            return to_route('group.list')->with('success', 'Group updated successfully.');
        }else{
            return to_route('group.edit', $request->input('id'))                          
                            ->with('error', 'Group update failed, Please try again..')
                            ->withInput();
        }        
    }
    
    public function delete($id) {
        
        if(StudentGroup::destroy($id)){
            return to_route('group.list')->with('success', 'Group deleted successfully.');
        }else{
            return to_route('group.list')->with('error', 'Group deleted failed, Please try again..');
        }
    }
}
