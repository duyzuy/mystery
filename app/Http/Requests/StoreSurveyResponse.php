<?php

namespace App\Http\Requests;


use App\Store;
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
            'responses.*.descriptions'      =>  'required',
            'responses.*.question_id'       =>  'required|exists:questions,id',
            'responses.*.group_id'          =>  'required|exists:question_groups,id',
            'restaurent'                    =>  'required|exists:user_store,store_id',
            'manage_name'                   =>  'required',
            'staff_name'                    =>  'required',
            'bank_name'                     =>  'required',
            'bank_account'                  =>  'required',
            'card_number'                   =>  'required',
            'bank_address'                  =>  'required',
            'restaurent_time'               =>  'required',
            'receipt'                       =>  'required',   
        ];
    }

    public function withValidator($validator)
    {
     
       
       
        $validator->after(function ($validator) {

            $restaurant = Store::where('id', $this->restaurent)->firstOrFail();

            $stringlng = strlen($restaurant->code);

            if($this->receipt != ''){

                $receipt = str_replace(' ','',$this->receipt);
                $receipt = strtoupper($receipt);
                $codeCheck = substr($receipt, 0, $stringlng);
              
                $restaurantCode = strtoupper($restaurant->code);

                if($codeCheck != $restaurantCode){

                    $validator->errors()->add('receipt', 'Billing code invalid with restaurant registratrion');
    
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
            'bank_name.required'                => trans('user.survey.error.required.bankName'),
            'manage_name.required'              => trans('user.survey.error.required.manageName'),
            'bank_account.required'         => trans('user.survey.error.required.bankAccount'),
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
            'responses.0.descriptions.required' => trans('user.survey.error.required.descriptions.1'),
            'responses.1.descriptions.required' => trans('user.survey.error.required.descriptions.2'),
            'responses.2.descriptions.required' => trans('user.survey.error.required.descriptions.3'),
            'responses.3.descriptions.required' => trans('user.survey.error.required.descriptions.4'),
            'responses.4.descriptions.required' => trans('user.survey.error.required.descriptions.5'),
            'responses.5.descriptions.required' => trans('user.survey.error.required.descriptions.6'),
            'responses.6.descriptions.required' => trans('user.survey.error.required.descriptions.7'),
            'responses.7.descriptions.required' => trans('user.survey.error.required.descriptions.8'),
            'responses.8.descriptions.required' => trans('user.survey.error.required.descriptions.9'),
            'responses.9.descriptions.required' => trans('user.survey.error.required.descriptions.10'),
            'responses.10.descriptions.required' => trans('user.survey.error.required.descriptions.11'),
            'responses.11.descriptions.required' => trans('user.survey.error.required.descriptions.12'),
            'responses.12.descriptions.required' => trans('user.survey.error.required.descriptions.13'),
            'responses.13.descriptions.required' => trans('user.survey.error.required.descriptions.14'),
            'responses.14.descriptions.required' => trans('user.survey.error.required.descriptions.15'),
            'responses.15.descriptions.required' => trans('user.survey.error.required.descriptions.16'),
            'responses.16.descriptions.required' => trans('user.survey.error.required.descriptions.17'),
            'responses.17.descriptions.required' => trans('user.survey.error.required.descriptions.18'),
            'responses.18.descriptions.required' => trans('user.survey.error.required.descriptions.19'),
            'responses.19.descriptions.required' => trans('user.survey.error.required.descriptions.20'),
            'responses.20.descriptions.required' => trans('user.survey.error.required.descriptions.21'),
            'responses.21.descriptions.required' => trans('user.survey.error.required.descriptions.22'),
            'responses.22.descriptions.required' => trans('user.survey.error.required.descriptions.23'),
            'responses.23.descriptions.required' => trans('user.survey.error.required.descriptions.24'),
            'responses.24.descriptions.required' => trans('user.survey.error.required.descriptions.25'),
            'responses.25.descriptions.required' => trans('user.survey.error.required.descriptions.26'),
            'responses.26.descriptions.required' => trans('user.survey.error.required.descriptions.27'),
            'responses.27.descriptions.required' => trans('user.survey.error.required.descriptions.28'),
            'responses.28.descriptions.required' => trans('user.survey.error.required.descriptions.29'),
            'responses.29.descriptions.required' => trans('user.survey.error.required.descriptions.30'),
            'responses.30.descriptions.required' => trans('user.survey.error.required.descriptions.31'),
            'responses.31.descriptions.required' => trans('user.survey.error.required.descriptions.32'),
            'responses.32.descriptions.required' => trans('user.survey.error.required.descriptions.33'),
            'responses.33.descriptions.required' => trans('user.survey.error.required.descriptions.34'),
            'responses.34.descriptions.required' => trans('user.survey.error.required.descriptions.35'),
            'responses.35.descriptions.required' => trans('user.survey.error.required.descriptions.36'),
            'responses.36.descriptions.required' => trans('user.survey.error.required.descriptions.37'),
        ];
    }

}
