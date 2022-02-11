<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
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
            'user' => [
                'required',
            ],
            'activity' => [
                'required',
            ],
            'grade' => [
                'required',
            ],
            'weight' => [
                'required',
            ],
            'semestr' => [
                'required',
            ],
            'comment' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'user.required' => 'Błąd podczas wprowadzania oceny: Należy wybrać studenta',
            'activity.required' => 'Błąd podczas wprowadzania oceny: Należy wybrać aktywność',
            'grade.required' => 'Błąd podczas wprowadzania oceny: Należy wybrać ocenę',
            'weight.required' => 'Błąd podczas wprowadzania oceny: Należy wybrać wagę',
            'semestr.required' => 'Błąd podczas wprowadzania oceny: Należy wybrać semestr',
            'comment.required' => 'Błąd podczas wprowadzania oceny: Należy wprowadzić komentarz',
        ];
    }
}
