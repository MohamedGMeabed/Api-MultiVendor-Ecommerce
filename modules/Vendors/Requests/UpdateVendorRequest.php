<?php

namespace modules\Vendors\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'email' => 'required|email|unique:vendors,email',
            'password' =>  'required',
            'contact' =>  'required',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',

        ];
    }



    public function messages()
    {
        return [
            //

            'email.string' => 'vendor must be string',
            'email.unique' => 'vendor mail is exist',
            'password' => 'vendor password is required',
            'contact' => 'vendor contact is required',
            'vendors.country_id' => 'country id is not exist',
            'vendors.city_id' => 'city id is not exist',
        ];
    }
}
