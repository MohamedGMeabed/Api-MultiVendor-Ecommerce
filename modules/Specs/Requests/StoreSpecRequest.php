<?php

namespace modules\Specs\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //       $this->authorizeForUser($user,'can', [spec::class,'update-spec']);

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
            'name' => 'required|unique:specs|string',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'the spec already exist.',
        ];
    }
}
