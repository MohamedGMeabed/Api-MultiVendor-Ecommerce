<?php

namespace modules\Reviews\Requests;

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
            'review_id' => 'required|exists:reviews,id'

        ];
    }



    public function messages()
    {
        return [
            //
            'review_id.required' => 'review id is required',
            'review_id.exists' => 'review id is not exist',
        ];
    }
}
