<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignPermissioToRolenRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return request()->user()->can('permission:assign');
        //return true;
    }

    
    public function rules(): array
    {
        return [
            'permission_id' => 'required',
            'role_id' => 'required',
        ];
    }
}
