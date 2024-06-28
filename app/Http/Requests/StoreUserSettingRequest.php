<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserSettingRequest extends FormRequest
{
    
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'setting_id' => 'required',
            'value_id' => 'nullable',
            'switch' => 'nullable',
        ];
    }
}
