<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserConfirmationRequest extends FormRequest
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
            'answer'                              =>  'required',
            'token'                             =>  'required',
        ];
    }
    public function messages()
    {
        return [
            'answer.required' => trans('user.confirmation.error.answer'),
            'token.required' => trans('user.confirmation.error.token'),
        ];
    }
}
