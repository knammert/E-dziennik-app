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
            ],
        ];
    }

    public function messages()
    {
        return [
            'user.required' => ' user_id Pole jest wymagane',
            'activity.required' => ' class_name_subject_idPole jest wymagane',
            'grade.required' => 'gradePole jest wymagane',
            'weight.required' => 'weightPole jest wymagane',
            'semestr.required' => 'semestr pole jest wymagane',
            'comment.required' => 'comment jest wymagane',
        ];
    }
}
