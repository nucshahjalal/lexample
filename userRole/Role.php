<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   use HasFactory;
    protected  $fillable = ['id','name','guard_name '];

    static function getRole(){
        return Role::get();
    }
    
    static function getSingleRole($id){
        return Role::find($id);
    }
}
