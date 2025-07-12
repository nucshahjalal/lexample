<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $this->data['users'] = User::all();
        return view('UserRole.user.index',$this->data);
    }
    
    public function create()
    {
        $this->data['roles'] = Role::all();
        return view('UserRole.user.create',$this->data);
    }
    
    public function store(Request $request){
        
     //   dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ]);

        $user = User::create($request->all());
        $user->assignRole($request->input('roles'));
        if($user){
           return redirect('user')->with('susscess','User created successfull');
        }else{
             return redirect('user/create/')->with('error','User created failed');
      }
    }
    
    public function edit(string $id)
    {
       $this->data['roles'] = Role::all();
       $this->data['user'] = User::find($id);
       return view('UserRole.user.edit',$this->data);
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

       // return $request->all();
      $user  = User::find($request->id);
      $user->fill($request->all());
      if($user->update()){
        $user->assignRole($request->input('roles'));
        return redirect('user')->with('susscess','User update successfull');

      }else{
         return redirect('user/edit/',$request->id)->with('error','User update failed');
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $user = User::find($id);
        if($user->delete()){
        return redirect('user')->with('susscess','User delete successfull');
        }else{
        return redirect('user')->with('error','User delete failed');
        }
    } 
}
