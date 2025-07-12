<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public $data = array();
    
    public function index()
    {
       $this->data['roles'] = Role::all();
      // dd($this->data['items']);
       return view('UserRole.role.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::all();
       return view('UserRole.role.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // dd($request->all());
      $role  = Role::create($request->all());
      $role->syncPermissions($request->permissions);

      if($role){
        return redirect('role')->with('susscess','Role create successfull');
      }else{
         return redirect('role/create')->with('error','Role create failed');
      }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $this->data['permission'] = Permission::all();
       $this->data['role'] = Role::find($id);
       return view('UserRole.role.edit',$this->data);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

       // return $request->all();
      $role  = Role::find($request->id);
      $role->fill($request->all());
     
      if($role->update()){
           $role->syncPermissions($request->permissions);
        return redirect('role')->with('susscess','Role update successfull');

      }else{
         return redirect('role/edit/',$request->id)->with('error','Role update failed');
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $role  = Role::find($id);
        if($role->delete()){
        return redirect('role')->with('susscess','Role delete successfull');
        }else{
        return redirect('role')->with('error','Role delete failed');
        }
    }   
}
