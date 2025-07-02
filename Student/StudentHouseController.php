<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Student\StuentHouseRequest;
use App\Models\Student\StudentHouse;

class StudentHouseController extends Controller
{
    public $data = array();

    public function index(Request $request) {
       
        $filter = $request->filter;
        if (empty(!$filter)) {         
            $this->data['houses'] = StudentHouse::latest()
                    ->where('student_houses.name', 'like', '%'.$filter.'%')
                    ->orWhere('student_houses.note', 'like', '%'.$filter.'%')
                    ->paginate(10);
        } else {
          $this->data['houses'] = StudentHouse::latest()->paginate(10);
        }
        
        $this->data['filter'] = $filter;
        $this->data['list'] = true;
        $this->data['page_title'] = 'House List';
        return view('student.house.index', $this->data);
    }

    public function add() {
        
        $this->data['add'] = true;
        $this->data['page_title'] = 'House Add';       
        return view('student.house.index', $this->data);
    }

    public function save(StuentHouseRequest $request) {  
   
        $request->merge(['created_by'=>auth()->user()->id]);        
        $save = StudentHouse::create($request->all()); 
        
        if($save){
             return to_route('house.list')->with('success', 'Student house created successfully.');
        }else{
            return to_route('house.add')                          
                        ->with('error', 'Student house created failed, Please try again..')
                        ->withInput();
        }       
    }

    public function edit($id) {
        
        $this->data['house'] = StudentHouse::find($id);
        $this->data['edit'] = true;     
        $this->data['page_title'] = 'House Edit'; 
        return view('student.house.index', $this->data);
    }

    public function update(StuentHouseRequest $request) {
          
        $house = StudentHouse::find($request->input('id'));
        $house->fill($request->all());
        $house->updated_by = auth()->user()->id;

        if($house->update()){
            return to_route('house.list')->with('success', 'Student house updated successfully.');
        }else{
            return to_route('house.edit', $request->input('id'))                          
                            ->with('error', 'Student house update failed, Please try again..')
                            ->withInput();
        }        
    }
    
    public function delete($id) {
        
        if(StudentHouse::destroy($id)){
            return to_route('house.list')->with('success', 'Student house deleted successfully.');
        }else{
            return to_route('house.list')->with('error', 'Student house deleted failed, Please try again..');
        }
    }
}
