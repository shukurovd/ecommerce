<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignRoleToUserRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return request()->user()->can('role:assign');
    }

    
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'role_id' => 'required'
        ];
    }
}
