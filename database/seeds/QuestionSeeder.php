<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('questionnaire')->insert([
            [
                'user_id' => 1,
            ],
        ]);

        DB::table('questionnaires_translation')->insert([
            [
                'questionnaire_id' => 1,
                'locale'        =>  'vi',
                'title'         =>   'ALFRESCOS GROUP - MYSTERY DINE AUDIT FORM',
                'description'   =>  null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'questionnaire_id' => 1,
                'locale'        =>  'en',
                'title'         =>   'ALFRESCOS GROUP - MYSTERY DINE AUDIT FORM',
                'description'   =>    null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],            
        ]);

        DB::table('question_groups')->insert([
            [
                
                'sort'        =>  1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
            
                'sort'        =>  1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],    
            [
              
                'sort'        =>  1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],    
            [
            
                'sort'        =>  1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],    
            [
            
                'sort'        =>  1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],    
            [
             
                'sort'        =>  1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],            
        ]);

        DB::table('question_groups_translation')->insert([
            [
                'question_group_id' => 1,
                'title'         =>  'A. Mặt trước nhà hàng',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 1,
                'title'         =>  'A. Restaurant front',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 2,
                'title'         =>  'B. Chào hỏi và nhận order',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 2,
                'title'         =>  'B. Greetings and take orders',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 3,
                'title'         =>  'C. Chất lượng Thức uống và cách phục vụ',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 3,
                'title'         =>  'C. Drink Quality and Service',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 4,
                'title'         =>  'D. Chất lượng Thức ăn và cách phục vụ',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 4,
                'title'         =>  'D. Food Quality and Service',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 5,
                'title'         =>  'E. Sự phục vụ trong bữa ăn',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 5,
                'title'         =>  'E. Meal Service',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 6,
                'title'         =>  'F. Dịch vụ chung',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 6,
                'title'         =>  'F. General Services',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 7,
                'title'         =>  'G. Quá trình thanh toán',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 7,
                'title'         =>  'G. Payment process',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 8,
                'title'         =>  'H. Các chương trình',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 8,
                'title'         =>  'H. Programs',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 9,
                'title'         =>  'Sub total',
                'locale'        =>  'vi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'question_group_id' => 9,
                'title'         =>  'Sub total',
                'locale'        =>  'en',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

                   
        ]);
    }
}
