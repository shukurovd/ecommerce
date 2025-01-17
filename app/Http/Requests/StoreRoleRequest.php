<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return request()->user()->can('role:create');
    }

    
    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }
}
