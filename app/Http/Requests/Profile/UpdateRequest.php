<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'password' => [ 'confirmed','nullable', 'min:8'],
            'phone' => 'required|regex:/^\+380\d{3}\d{2}\d{2}\d{2}$/',


        ];
    }

    public function messages()
    {
        return [
            'min' => 'Минимум :min символа',
            'required' => 'Поле обязательно для заполнения',
            'max' => 'Максимум :max символа',
            'email' => 'Не корректный Email адрес',
            'string'  => 'Поле должно быть строкой',
            'email.unique' =>'Пользователь с таким Email уже существует',
            'password.confirmed' => 'Пароли не совпадают',
            'phone.regex' => 'Не верный формат',
        ];
    }
}
