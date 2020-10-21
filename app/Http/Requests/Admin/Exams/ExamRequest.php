<?php

namespace App\Http\Requests\Admin\Exams;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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

        $rules =  [
            'title'             => 'required|min:3',
            'doctor'            => 'required|min:3',
            'started_at'        => 'required|date',
            'ended_at'          => 'required|date|after_or_equal:started_at',
            'on'                => 'nullable|boolean'
        ];
        return $rules;
    }



    public function messages() {
        return [
            'title.required'          => 'حقل العنوان مطلوب',
            'title.min'               => 'اقل عدد احرف للعنوان هو :min ',
            'doctor.required'          => 'حقل الدكتور مطلوب',
            'doctor.min'               => 'اقل عدد احرف للدكتور هو :min ',
            'started_at.required'      => 'تاريخ بدء الامتحان مطلوب',
            'started_at.date'          => 'تاريخ بدء الامتحان غير صالح',
            'ended_at.required'        => 'تاريخ نهايه الامتحان مطلوب',
            'ended_at.date'            => 'تاريخ نهايه الامتحان غير صالح',
            'ended_at.after_or_equal'  => 'تاريخ نهايه الامتحان يجب ان يكون بعد بدايه الامتحان',
        ];
    }
}
