<?php

namespace App\Http\Requests\Admin\Courses;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title'       => 'required|unique:courses,title',
            'description' => 'nullable',
            'exam_id'     => 'nullable|exists:exams,id'
        ];


        if($this->course){
            $rules['title']            =  'nullable|unique:courses,title,'.$this->course->id;
        }

        return $rules;
    }



        public function messages() {
        return [
            'title.required' => 'حقل العنوان مطلوب',
            'title.unique'   => 'حقل العنوان موجود مسبقاً',
            'exam_id.exists'   => 'حقل الامتحان غير صالح',
        ];
    }
}
