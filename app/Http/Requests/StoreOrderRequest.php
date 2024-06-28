<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            
            'delivery_method_id' => 'required',
            'payment_type_id' => 'required',
            'products' => 'required',
            'products.*.product_id' => 'required',
            'products.*.quantity' => 'required',
            'products.*.stock_id' => 'nullable',
            'comment' => 'nullable|max:500'
        ];
    }
}
