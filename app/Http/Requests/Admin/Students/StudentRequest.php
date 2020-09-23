<?php

namespace App\Http\Requests\Admin\Students;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name'             => 'required|min:3',
            'email'            => 'required|email|unique:users,email',
            'mobile'           => 'required|unique:users,mobile',
            'birthday'         => 'required|date',
            'country'          => 'required|string',
            'state'            => 'required|string',
            'job'              => 'required|string',
            'church'           => 'required|string',
            'qualification'    => 'required|string',
            'image'            => 'required|mimes:jpeg,jpg,png|max:512',
            'password'         => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];

        if($this->student){
            $rules['email']            =  'required|email|unique:users,email,'.$this->student->id;
            $rules['mobile']           =  'required|unique:users,mobile,'.$this->student->id;
            $rules['password']         =  'nullable|min:6';
            $rules['confirm_password'] =  'required_with:password|same:password';
        }

        if($this->student && $this->student->image != '')
           $rules['image'] = "nullable|mimes:jpeg,jpg,png|max:512";


        return $rules;
    }


    public function messages() {
        return [
            'name.required'          => 'حقل الاسم مطلوب',
            'name.min'               => 'اقل عدد احرف للاسم هو :min ',
            'email.required'         => 'حقل البريد الالكتروني مطلوب',
            'email.email'            => 'بريد الكتروني غير صالح',
            'email.unique'           => 'البريد مسجل من قبل',
            'mobile.required'        => 'رقم الهاتف مطلوب',
            'mobile.unique'          => 'رقم الهاتف مسجل من قبل',
            'birthday.required'      => 'تاريخ الميلاد مطلوب',
            'birthday.date'          => 'تاريخ الميلاد غير صالح',
            'country.required'       => 'الدوله مطلوبه',
            'state.required'         => 'المحافظه مطلوبه',
            'job.required'           => 'الوظيفه مطلوبه',
            'church.required'        => 'الكنيسه مطلوبه',
            'qualification.required' => 'المؤهل مطلوب',
            'image.required'         => 'الصوره مطلوبه',
            'image.mimes'            => 'صوره غير صالحه',
            'image.max'              => 'حجم الصوره يجب ان لا يتجاوز :max كيلو',
            'password.required'      => 'كلمه السر مطلوبه',
            'password.min'           => 'اقل عدد احرف لكلمه السر :min',
            'confirm_password.required' => 'تأكيد كلمه السر مطلوب',
            'confirm_password.same'     => 'تاكيد كلمه السر يجب ان يكون مطابق لكلمه السر',
        ];
    }
}
