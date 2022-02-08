<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()) {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = Auth::id();
        return [
            'email' => [
                'required',
                Rule::unique('users')->ignore($userId),
                'email'
            ],
            'name' => [
                'required',
            ],
            'surname' => [
                'required',
            ],
            'pesel' => [
                'numeric','digits:9','required',
                 Rule::unique('users')->ignore($userId),

            ],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Podany adres email jest zajęty',
            'pesel.unique' => 'Podany numer PESEL jest zajęty',
            'pesel.digits' => 'Podano błędny numer PESEL',
            'pesel.required' => 'Pole jest wymagane',
            'name.required' => 'Pole jest wymagane',
            'surname.required' => 'Pole jest wymagane',
            'email.required' => 'Pole jest wymagane'
        ];
    }
}
