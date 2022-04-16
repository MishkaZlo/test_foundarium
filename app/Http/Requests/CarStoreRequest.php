<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
        $rules = [
            'model' => 'required|min:2|max:255',
            'number' => 'required|min:6|max:30',
        ];

        switch ($this->getMethod()) {

            case 'DELETE':
                return [
                    'id' => 'required|integer'
                ];
            case 'POST':
            case 'PUT':
            default:
                return $rules;
        }
    }

    public function messages()
    {
        return [
            'required' => 'req',
            'max' => 'no more',
        ];
    }

}
