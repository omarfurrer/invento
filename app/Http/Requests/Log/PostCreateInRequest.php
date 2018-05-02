<?php

namespace App\Http\Requests\Log;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Item;

class PostCreateInRequest extends FormRequest {

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
        $rules = [
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|numeric',
            'expiry_date' => 'nullable|date',
            'unit_price' => 'nullable|numeric'
        ];
        $item = Item::find($this->get('item_id'));
        if ($item) {
            if ($item->expires) {
                $rules['expiry_date'] = $rules['expiry_date'] . '|required';
            }
        }
        return $rules;
    }

}
