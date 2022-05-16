<?php

namespace App\Http\Requests\Basket;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'quantity'=>['required', 'integer', 'min:1','max:2000'],
        ];
    }
    public function messages()
    {
        return [
            'min' => 'Минимум :min символа',
            'required' => 'Поле обязательно для заполнения',
            'max' => 'Максимум :max символа',
            'integer'=>'Поле должно быть число',
        ];
    }
}
