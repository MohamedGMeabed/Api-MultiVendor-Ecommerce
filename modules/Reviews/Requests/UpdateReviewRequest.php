<?php

namespace modules\Reviews\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'review_id' => 'required|exists:reviews,id',
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
            'review_id.required' => 'review id is required',
            'review_id.exists' => 'review id is not exist',
            'review.required' => 'review is required',
            'review.string' => 'review must be string',
        ];
    }
}
