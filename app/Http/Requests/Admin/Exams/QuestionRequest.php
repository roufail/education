<?php

namespace App\Http\Requests\Admin\Exams;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            "degree"   => "required|numeric",
            "answers"  => "required|array",
            "answers.*.answer" => "required|string",
            "category_id" => "required|exists:categories,id"
        ];
    }



    public function messages() {
        return [
            'question.required'         => 'حقل السؤال مطلوب',
            'question.string'           => 'حقل السؤال يجب ان يكون نص',
            'degree.required'           => 'حقل الدرجه مطلوب',
            'degree.numeric'            => 'حقل الدرجه يجب ان يكون رقم',
            'degree.required'           => 'حقل الدرجه مطلوب',
            'degree.numeric'            => 'حقل الدرجه يجب ان يكون رقم',
            'answers.*.answer.required' => 'حقل الاجابه مطلوب',
            'answers.*.answer.string'   => 'حقل الدرجه يجب ان يكون نص',
            'category_id.required'      => 'حقل التصنيف مطلوب',
            'category_id.exists'        => 'حقل التصنيف غير صحيح'
        ];
    }

}
