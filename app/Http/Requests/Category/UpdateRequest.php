<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name'=> ['required','string','min:3','max:255',Rule::unique('categories')->ignore($this->category)],
            'image' => ['image']
        ];
    }
    public function messages()
    {
        return [
            'min' => 'Минимум :min символа',
            'required' => 'Поле обязательно для заполнения',
            'max' => 'Максимум :max символа',
            'string'  => 'Поле должно быть строкой',
            'image.image'=>"Файл должен быть картинкой",
            'name.unique'=>'Такая категория уже существует'
        ];
    }
}
