<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateNetpingRequest extends FormRequest
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
            'netping_name' => ['required', 'string'],
            'netping_ip' => ['required', 'ip'],
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
            'netping_name.required' => 'Необходимо ввести имя точки.',
            'netping_ip.required' => 'Необходимо ввести IP точки.',
            'netping_ip.ip' => 'Проверьте формат ввода IP-адреса',
        ];
    }
}
