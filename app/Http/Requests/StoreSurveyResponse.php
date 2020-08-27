<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyResponse extends FormRequest
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
            //
            'responses.*.answer_id'         =>  'required|exists:answers,id',
            'responses.*.question_id'       =>  'required|exists:questions,id',
            'responses.*.group_id'          =>  'required|exists:question_groups,id',
            'restaurent'                    =>  'required|exists:stores,id',
            'manage_name'                   =>  'required',
            'staff_name'                    =>  'required',
            'bank_name'                     =>  'required',
            'card_number'                   =>  'required',
            'bank_address'                  =>  'required',
            'restaurent_time'               =>  'required',
            'receipt'                       =>  'required',   
        ];
    }

    public function withValidator($validator)
    {
     
       

        $validator->after(function ($validator) {

            if($this->receipt != ''){
                $receipt = str_replace(' ','',$this->receipt);
                $receipt = preg_replace('/[^A-Za-z0-9\-]/', '', $receipt);
                $receipt = strtoupper($receipt);
    
                $regionValid = ['N', 'S', 'C'];
                $brandValid = ['A', 'J', 'P'];
                $storeValid = ['HBT', 'PXL', 'VHM'];
    
                if(!in_array(substr($receipt,0,1), $regionValid) || !in_array(substr($receipt,1,1), $brandValid) || !in_array(substr($receipt,2,3), $storeValid)){
                    
                    $validator->errors()->add('receipt', 'Billing code invalid');
    
                }
            }

           
                // 
            
        });
    }

    public function messages()
    {
        return [
            'restaurent.required'             => trans('user.survey.error.required.restaurent'),
            'restaurent.exists'               => trans('user.survey.error.exists.restaurent'),
            'receipt.required'                => trans('user.survey.error.required.receipt'),
            'bank_address.required'           => trans('user.survey.error.required.bankAddress'),
            'card_number.required'            => trans('user.survey.error.required.cardNumber'),
            'bank_name.required'    => trans('user.survey.error.required.bankName'),
            'manage_name.required'  => trans('user.survey.error.required.manageName'),
            'responses.0.answer_id.required' => trans('user.survey.error.required.answer.1'),
            'responses.1.answer_id.required' => trans('user.survey.error.required.answer.2'),
            'responses.2.answer_id.required' => trans('user.survey.error.required.answer.3'),
            'responses.3.answer_id.required' => trans('user.survey.error.required.answer.4'),
            'responses.4.answer_id.required' => trans('user.survey.error.required.answer.5'),
            'responses.5.answer_id.required' => trans('user.survey.error.required.answer.6'),
            'responses.6.answer_id.required' => trans('user.survey.error.required.answer.7'),
            'responses.7.answer_id.required' => trans('user.survey.error.required.answer.8'),
            'responses.8.answer_id.required' => trans('user.survey.error.required.answer.9'),
            'responses.9.answer_id.required' => trans('user.survey.error.required.answer.10'),
            'responses.10.answer_id.required' => trans('user.survey.error.required.answer.11'),
            'responses.11.answer_id.required' => trans('user.survey.error.required.answer.12'),
            'responses.12.answer_id.required' => trans('user.survey.error.required.answer.13'),
            'responses.13.answer_id.required' => trans('user.survey.error.required.answer.14'),
            'responses.14.answer_id.required' => trans('user.survey.error.required.answer.15'),
            'responses.15.answer_id.required' => trans('user.survey.error.required.answer.16'),
            'responses.16.answer_id.required' => trans('user.survey.error.required.answer.17'),
            'responses.17.answer_id.required' => trans('user.survey.error.required.answer.18'),
            'responses.18.answer_id.required' => trans('user.survey.error.required.answer.19'),
            'responses.19.answer_id.required' => trans('user.survey.error.required.answer.20'),
            'responses.20.answer_id.required' => trans('user.survey.error.required.answer.21'),
            'responses.21.answer_id.required' => trans('user.survey.error.required.answer.22'),
            'responses.22.answer_id.required' => trans('user.survey.error.required.answer.23'),
            'responses.23.answer_id.required' => trans('user.survey.error.required.answer.24'),
            'responses.24.answer_id.required' => trans('user.survey.error.required.answer.25'),
            'responses.25.answer_id.required' => trans('user.survey.error.required.answer.26'),
            'responses.26.answer_id.required' => trans('user.survey.error.required.answer.27'),
            'responses.27.answer_id.required' => trans('user.survey.error.required.answer.28'),
            'responses.28.answer_id.required' => trans('user.survey.error.required.answer.29'),
            'responses.29.answer_id.required' => trans('user.survey.error.required.answer.30'),
            'responses.30.answer_id.required' => trans('user.survey.error.required.answer.31'),
            'responses.31.answer_id.required' => trans('user.survey.error.required.answer.32'),
            'responses.32.answer_id.required' => trans('user.survey.error.required.answer.33'),
            'responses.33.answer_id.required' => trans('user.survey.error.required.answer.34'),
            'responses.34.answer_id.required' => trans('user.survey.error.required.answer.35'),
            'responses.35.answer_id.required' => trans('user.survey.error.required.answer.36'),
            'responses.36.answer_id.required' => trans('user.survey.error.required.answer.37'),
            'staff_name.required'           =>  trans('user.survey.error.required.staffName'),
            'restaurent_time.required'      =>  trans('user.survey.error.required.restaurentTime'),
        ];
    }

}
