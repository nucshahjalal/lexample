<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        return [
            
            'role_id' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'username' => 'required_without:id|min:6|unique:users,username,'.$this->user_id,
            'password' => 'required_without:id|min:6',
            'group_id' => 'required',
            'type_id' => 'required',
            'house_id' => 'required',
            'first_name' => 'required',
            'guardian_id' => 'required',
        ];
                
    }
     
}
