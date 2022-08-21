<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|string|min:3|max:60',
            'main_classification' =>'required|in:مباني,صالة,مولد,مياه',
            'service_description' =>'required|string|min:5',
            'cost_amount' =>'required|numeric',
            'cost_type' =>'required|in:يومي,شهري,سنوي',
            'active'=>'required|boolean',
            'notes' =>'required|string|min:5',
          
        ];
    }
}
