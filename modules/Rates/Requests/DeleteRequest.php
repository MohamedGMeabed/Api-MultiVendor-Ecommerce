<?php

namespace modules\Rates\Requests;

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
            'rate_id' => 'required|exists:rates,id'

        ];
    }



    public function messages()
    {
        return [
            //
            'rate_id.required' => 'rate id is required',
            'rate_id.exists' => 'rate id is not exist',
        ];
    }
}
