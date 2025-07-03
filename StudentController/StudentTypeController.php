<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Student\StuentTypeRequest;
use App\Models\Student\StudentType;

class StudentTypeController extends Controller
{
    public $data = array();

    public function index(Request $request) {
       
        $filter = $request->filter;
        if (empty(!$filter)){         
            $this->data['types'] = StudentType::latest()
                    ->where('student_types.type', 'like', '%'.$filter.'%')
                    ->orWhere('student_types.note', 'like', '%'.$filter.'%')
                    ->paginate(10);
        } else {
          $this->data['types'] = StudentType::latest()->paginate(10);
        }
        
        $this->data['filter'] = $filter;
        $this->data['list'] = true;
        $this->data['page_title'] = 'Type List';
        return view('student.type.index', $this->data);
    }

    public function add() {
        
        $this->data['add'] = true;
        $this->data['page_title'] = 'Type Add';       
        return view('student.type.index', $this->data);
    }

    public function save(StuentTypeRequest $request) {  
   
        $request->merge(['created_by'=>auth()->user()->id]);        
        $save  = StudentType::create($request->all()); 
        
        if($save){
             return to_route('type.list')->with('success', 'Type created successfully.');
        }else{
            return to_route('type.add')                          
                            ->with('error', 'Type created failed, Please try again..')
                            ->withInput();
        }       
    }

    public function edit($id) {
        
        $this->data['type'] = StudentType::find($id);
        $this->data['edit'] = true;      
        $this->data['page_title'] = 'Type Edit';  
        return view('student.type.index', $this->data);
    }

    public function update(StuentTypeRequest $request) {
          
        $type = StudentType::find($request->input('id'));
        $type->fill($request->all());
        $type->updated_by = auth()->user()->id;

        if($type->update()){
            return to_route('type.list')->with('success', 'Type updated successfully.');
        }else{
            return to_route('type.edit', $request->input('id'))                          
                            ->with('error', 'Type update failed, Please try again..')
                            ->withInput();
        }        
    }
    
    public function delete($id) {
        
        if(StudentType::destroy($id)){
            return to_route('type.list')->with('success', 'Type deleted successfully.');
        }else{
            return to_route('type.list')->with('error', 'Type deleted failed, Please try again..');
        }
    }
}
