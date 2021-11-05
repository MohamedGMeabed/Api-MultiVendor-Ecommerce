<?php

namespace modules\Rates\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreateRateRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'rate' =>  'required|in:1, 2, 3, 4, 5',

        ];
    }



    public function messages()
    {
        return [
            //

            'product_id.required' => 'product id is required',
            'product_id.exists' => 'product id is not exist',
            'rate.required' => 'rate is required',
            'rate.in' => 'rate must be between 1 to 5',
        ];
    }
}
