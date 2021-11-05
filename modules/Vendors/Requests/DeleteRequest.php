<?php

namespace modules\Vendors\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
            'vendor_id' => 'required|exists:countries,id'

        ];
    }



    public function messages()
    {
        return [
            //
            'vendor_id.required' => 'vendor id is required',
            'vendor_id.exists' => 'vendor id is not exist',
        ];
    }
}
