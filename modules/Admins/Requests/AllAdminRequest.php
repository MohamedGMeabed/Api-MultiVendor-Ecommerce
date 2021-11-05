<?php


namespace Modules\Admins\Requests;

use Illuminate\Foundation\Http\FormRequest;
use modules\Admins\Models\Admin;

class AllAdminRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('viewAny', Admin::class);
    }

    public function rules()
    {

    }

    public function messages()
    {

    }

}
