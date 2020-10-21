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
            'exam_id'     => 'nullable|exists:exams,id',
            'image'       => 'required|mimes:jpeg,jpg,png|max:512',
        ];


        if($this->course){
            $rules['title']            =  'nullable|unique:courses,title,'.$this->course->id;

            if($this->course->image != '') {
                $rules['image'] = "nullable|mimes:jpeg,jpg,png|max:512";
            }
        }

        return $rules;
    }



        public function messages() {
        return [
            'title.required' => 'حقل العنوان مطلوب',
            'title.unique'   => 'حقل العنوان موجود مسبقاً',
            'exam_id.exists'   => 'حقل الامتحان غير صالح',
            'image.required'         => 'الصوره مطلوبه',
            'image.mimes'            => 'صوره غير صالحه',
            'image.max'              => 'حجم الصوره يجب ان لا يتجاوز :max كيلو',

        ];
    }
}
