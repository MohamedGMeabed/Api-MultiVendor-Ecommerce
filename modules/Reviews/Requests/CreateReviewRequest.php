<?php

namespace modules\Reviews\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
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
            'review' =>  'required|string',

        ];
    }



    public function messages()
    {
        return [
            //

            'product_id.required' => 'product id is required',
            'product_id.exists' => 'product id is not exist',
            'review.required' => 'rate is required',
            'review.string' => 'rate must be string',
        ];
    }
}
