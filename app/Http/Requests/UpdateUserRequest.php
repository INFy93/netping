<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => ['required', 'string'],
            'user_login' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'user_pass' => ['required', 'min:8'],
        ];
    }

         /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_name.required' => 'Необходимо ввести имя пользователя.',
            'user_login.required' => 'Необходимо ввести логин.',
            'email.email' => 'Неправильный формат e-mail.',
            'email.unique' => 'Пользователь с таким e-mail уже существует.',
            'user_pass.required' => 'Необходимо ввести пароль.',
            'user_pass.min' => 'Пароль должен содержать как минимум 8 символов.',
        ];
    }
}
