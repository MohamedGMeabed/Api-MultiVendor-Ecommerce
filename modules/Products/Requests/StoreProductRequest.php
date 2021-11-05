<?php

namespace modules\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;
use modules\Vendors\Models\Vendor;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('store', Vendor::class);
    }

    public function rules()
    {
        return [
            'name'  => 'required|string',
            'description'  => 'required|string',
            'price'  => 'required|numeric',
            'in_stock'  => 'required|integer',
            'price_after'  => 'required|numeric',
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
