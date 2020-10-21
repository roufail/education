<?php

namespace App\Http\Requests\Admin\Courses;

use Illuminate\Foundation\Http\FormRequest;

class CourseLectureRequest extends FormRequest
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
        $rules = [
            'title'       => 'required',
            'teacher'       => 'required',
            'serial'        => 'nullable',
            'course_id'     => 'required|exists:courses,id',
        ];

        return $rules;
    }


    public function messages() {
        return [
            'title.required'          => 'حقل المحاضره مطلوب',
            'teacher.required'       => 'حقل المحاضر مطلوب',
            'course_id.required'     => 'حقل الكورس غير صالح',
            'course_id.exists'       => 'حقل الكورس غير صالح',
        ];
    }
}
