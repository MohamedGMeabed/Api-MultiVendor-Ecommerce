<?php


namespace modules\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;
use modules\Vendors\Models\Vendor;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', Vendor::class);
    }

    public function rules()
    {
        return [
            'name'  => 'required|string',
            'description'  => 'required|string',
            'price'  => 'required|double',
            'in_stock'  => 'required|integer',
            'price_after'  => 'required|double',
            'vendor_id'  => 'required|exists:vendors,id',
        ];
    }
    public function messages()
    {
        return [
            'vendor_id.exists' => 'this Vendor is not identified'

        ];
    }

}
