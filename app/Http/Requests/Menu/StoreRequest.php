<?php

namespace App\Http\Requests\Menu;

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
            'name'=> ['required','string','min:3','max:255',"unique:menu"],
            'category_id' => ['bail', 'required', 'integer', 'exists:categories,id'],
            'description'=> ['required','string','min:20','max:255'],
            'price'=>['required', 'integer', 'min:1','max:2000'],
            'status'=>['required','in:active,not active'],
            'image' => ['image','required']
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
            'image.required'=> "Картинка обязательна при добавлении нового блюда",
            'name.unique'=>'Такое блюдо уже существует',
            'category_id.exists'=>'Такая категория не существует',
            'category_id.integer'=>'Ошибка выбора категории',
            'integer'=>'Поле должно быть число',
            'price.min'=> 'Минимальная стоимость :min грн.',
            'price.max'=> 'Максимальная стоимость :max грн.',
            'status.in'=>'Неверный параметр'

        ];
    }
}
