<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegister extends FormRequest
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
            'name'                              =>  'required',
            'email'                             =>  'required|unique:users,email',
            'phone_number'                      =>  'required',
            'date_of_birth'                     =>  'required',
            'responses'                         =>  'required|array',
            'gender'                            =>  'required',
            'address'                           =>  'required',
            'responses.*.answer'                =>  'required',
            'responses.*.signup_question_id'    =>  'required|exists:signup_questions,id',
            'store'                             =>  'required|array',
            'store.*'                           =>  'exists:stores,id',
        ];
    }
    public function messages()
    {
        return [
            'responses.0.answer.required' => trans('user.pageRegister.error.answer.1'),
            'responses.1.answer.required' => trans('user.pageRegister.error.answer.2'),
            'responses.2.answer.required' => trans('user.pageRegister.error.answer.3'),
            'responses.3.answer.required' => trans('user.pageRegister.error.answer.4'),
            'responses.4.answer.required' => trans('user.pageRegister.error.answer.5'),
            'name.required'                              =>  trans('user.pageRegister.error.name'),
            'email.required'                             =>  trans('user.pageRegister.error.email'),
            'phone_number.required'                      =>  trans('user.pageRegister.error.phoneNumber'),
            'date_of_birth.required'                     =>  trans('user.pageRegister.error.dateBirth'),
            'gender.required'                            =>  trans('user.pageRegister.error.gender'),
            'address.required'                           =>  trans('user.pageRegister.error.address'),
            'store.required'                           =>  trans('user.pageRegister.error.store'),
        ];
    }
}
