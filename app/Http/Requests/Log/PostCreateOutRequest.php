<?php

namespace App\Http\Requests\Log;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Item;

class PostCreateOutRequest extends FormRequest {

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
            'quantity' => 'required|numeric'
        ];
        $item = Item::find($this->get('item_id'));
        if ($item) {
            if ($item->expires) {
                $rules['item_batch_id'] = 'required|exists:item_batches,id';
            } else {
                $rules['item_batch_id'] = 'nullable';
            }
        }
        return $rules;
    }

}
