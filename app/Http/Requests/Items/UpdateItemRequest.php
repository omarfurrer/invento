<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest {

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
            'description' => 'required|string|between:2,255',
            'unit_id' => 'required|exists:measurement_units,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'minimum_quantity' => 'nullable|numeric',
            'image' => 'nullable|image',
            'expires' => 'required|boolean',
            'item_batches' => 'required|array',
            'item_batches.*.quantity' => 'required|numeric'
        ];
    }

}
