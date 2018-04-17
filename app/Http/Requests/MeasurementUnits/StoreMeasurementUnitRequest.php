<?php

namespace App\Http\Requests\MeasurementUnits;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeasurementUnitRequest extends FormRequest {

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
            'name' => 'required|string|between:1,255',
            'short_name' => 'required|string|between:1,255|unique:measurement_units'
        ];
    }

}
