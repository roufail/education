<?php

namespace App\Http\Requests\Admin\Exams;

use Illuminate\Foundation\Http\FormRequest;

class MainQuestionRequest extends FormRequest
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
            "question" => "required|string",
            "notes"    => "nullable",
        ];
    }



    public function messages() {
        return [
            'question.required'         => 'حقل السؤال مطلوب',
        ];
    }


}
