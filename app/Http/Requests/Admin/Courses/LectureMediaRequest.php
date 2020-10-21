<?php

namespace App\Http\Requests\Admin\Courses;

use Illuminate\Foundation\Http\FormRequest;

class LectureMediaRequest extends FormRequest
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
            'title'      => 'required',
            'link'       => 'required|url',
            'type'       => 'required|in:youtube,audio,pdf',
            'lecture'    => 'nullable|boolean',
            'course_id'  => 'nullable',
        ];

        return $rules;
    }


    public function messages() {
        return [
            'title.required'          => 'حقل العنوان مطلوب',
            'link.required'           => 'حقل الملف مطلوب',
            'link.url'                => 'حقل الملف يجب ان يكون رابط',
            'type.required'           => 'حقل النوع مطلوب',
            'type.in'                 => 'حقل النوع غير صالح',
        ];
    }
}
