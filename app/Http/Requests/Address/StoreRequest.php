<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'city'=> ['required','string','min:3','max:15'],
            'street' => ['required','string','min:3','max:20'],
            'house'=> ['required','string','min:1','max:15'],
            'apartment'=> ['string','min:1','nullable','max:5'],
        ];
    }
    public function messages()
    {
        return [
            'min' => 'Минимум :min символа',
            'required' => 'Поле обязательно для заполнения',
            'max' => 'Максимум :max символа',
            'string'  => 'Поле должно быть строкой',

        ];
    }
}
