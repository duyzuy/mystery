<?php

use Carbon\Carbon;
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
        DB::table('questionnaires')->insert([
            [
                'user_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);

        DB::table('questionnaires_translation')->insert([
            [
                'questionnaire_id' => 1,
                'locale'        =>  'vi',
                'title'         =>   'ALFRESCOS GROUP - MYSTERY DINE AUDIT FORM',
                'description'   =>  '<p>TRƯỚC KHI BẠN ĐẾN NHÀ HÀNG THỰC HIỆN KHẢO SÁT:</p><p>1. Mọi câu trả lời \"No\" BẮT BUỘC có lời ghi chú/diễn giải ở ô bên cạnh.</p><p>2. Để việc tính điểm chính xác hơn trong phần B, khi bạn được đưa thực đơn, vui lòng không gọi món ngay, mà hãy chờ trong vài giây để đợi nhân viên gợi ý về món ăn của nhà hàng. Tương tự như thế, sau khi dùng thức ăn, vui lòng đợi trong vài giây để nhân viên có cơ hội giới thiệu/gợi ý cho bạn về thức uống/tráng miệng của nhà hàng.</p>			\r\n<p>3. Mục \"Ý kiến khác\" BẮT BUỘC phải có ý kiến đóng góp, các đề nghị, hoặc các than phiền khác trong quá trình khách hàng ghé thăm nhà hàng.</p>			\r\n<p>4. Vui lòng dành thời gian khảo sát/sử dụng phòng vệ sinh của nhà hàng để có thể trả lời các Dịch Vụ Chung trong trong phần D.</p>			\r\n<p>5. Để có thể đánh giá tất cả các bước phục vụ của nhà hàng, nếu bạn được sắp xếp khảo sát nhà hàng Pepperonis, vui lòng gọi món trong thực đơn, không dùng tiệc buffet. Nếu bạn được sắp xếp khảo sát nhà hàng khác, vui lòng chọn các món trong menu chính, không chọn set menu.</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'questionnaire_id' => 1,
                'locale'        =>  'en',
                'title'         =>   'ALFRESCOS GROUP - MYSTERY DINE AUDIT FORM',
                'description'   =>    '<p>&nbsp;BEFORE YOU GO TO THE RESTAURANT SURVEY:\r\n</p> <p> 1. All \"No\" answers MUST have a comment / description in the box next to them. </p><p> 2. For more accurate scoring in section B, when you are given the menu, please do not order immediately, but wait for a few seconds to wait for the staff to recommend the restaurant\'s dish. Likewise, after eating the food, please wait a few seconds for the staff to have a chance to recommend / recommend you the restaurant drinks / desserts. </p>\r\n<p> 3. The \"Other Comments\" section is REQUIRED with any comments, suggestions, or other complaints during a customer visit. </p>\r\n<p> 4. Please take the time to survey / use the restaurant\'s restroom so that General Services can be answered in section D. </p>\r\n<p> 5. In order to appreciate all steps of restaurant service, if you are arranged to survey Pepperonis restaurant, please order from the menu, not to the buffet. If you are arranged to survey another restaurant, please select the main menu items, not the set menu. </p>',
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
            
                'sort'        =>  2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],    
            [
              
                'sort'        =>  3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],    
            [
            
                'sort'        =>  4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],    
            [
            
                'sort'        =>  5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],    
            [
             
                'sort'        =>  6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
             
                'sort'        =>  7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],      
            [
             
                'sort'        =>  8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],      
            [
             
                'sort'        =>  9,
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
