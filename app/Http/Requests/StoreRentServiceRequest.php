<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentServiceRequest extends FormRequest
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

            'name' => 'required|string|min:3|max:60',
            'id_num'=>'required|integer',
            'mobile_num'=>'required|integer',
            'start_date'=>'required|before:expiry_date',
            'expiry_date'=>'required|after:start_date',
            // 'category' => 'required_if:category ,مياه, مولد, مباني ,صالة',
            // 'num_attendees'=>'required|numeric',
            // 'additional_services'=>'required|min:5',
            // 'add_generator'=>'required',
            // 'subscription'=>'required',
            // 'amps'=>'required',
            // 'add_water'=>'required',
            // 'id_num'=>'required'




            //
        ];
    }
}
