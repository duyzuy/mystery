<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class SignupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('signup_questions')->insert([
            [
                'id'        =>  1,
            ],
            [
                'id'        =>  2,
            ],    
            [
                'id'        =>  3,
            ],    
            [
                'id'        =>  4,
            ],    
            [
                'id'        =>  5,
            ],    
                   
        ]);

        DB::table('signup_questions_translation')->insert([
            [
                'signup_question_id' => 1,
                'questions'         =>  'Anh/chị biết đến chuỗi nhà hàng của  Al Frescos Group được bao lâu?',
                'locale'        =>  'vi',
         
            ],
            [
                'signup_question_id' => 1,
                'questions'         =>  'How long have you known about Al Frescos Group\'s restaurants?',
                'locale'        =>  'en',
               
            ], 

            [
                'signup_question_id' => 2,
                'questions'         =>  'Anh/chị thường dùng bữa tại nhà hàng của chúng tôi bao nhiêu lần trong 1 tháng?',
                'locale'        =>  'vi',
              
            ],
            [
                'signup_question_id' => 2,
                'questions'         =>  'How many times a month do you usually eat at any of our restaurants?',
                'locale'        =>  'en',
                
            ], 

            [
                'signup_question_id' => 3,
                'questions'         =>  "Chuỗi nhà hàng nào anh/chị thường dùng bữa ? Alfresco's hay Pepperonis, hay Jaspas, ... ?",
                'locale'        =>  'vi',
               
            ],
            [
                'signup_question_id' => 3,
                'questions'         =>  "Which restaurants do you usually visit? Al Fresco's, Pepperonis, Jaspas, Jackson’s or Papa Joe’s?",
                'locale'        =>  'en',
               
            ], 

            [
                'signup_question_id' => 4,
                'questions'         =>  'Anh/chị có sử dụng dịch vụ giao hàng, mua mang đi, đặt hàng trực tuyến của chúng tôi không?',
                'locale'        =>  'vi',
                
            ],
            [
                'signup_question_id' => 4,
                'questions'         =>  'Which of our services do you use? Dine-in, delivery, take-away, online ordering services',
                'locale'        =>  'en',
                
            ], 

            [
                'signup_question_id' => 5,
                'questions'         =>  'Anh/chị có dùng bữa tại các nhà hàng khác có cùng cách phục vụ và món ăn tương tự như của chúng tôi không ? Vui lòng kể tên các nhà hàng đó.',
                'locale'        =>  'vi',
             
            ],
            [
                'signup_question_id' => 5,
                'questions'         =>  'Do you dine at other restaurants that have similar food and service as ours? Yes/No',
                'locale'        =>  'en',
                
            ], 
                   
        ]);

    }
}
