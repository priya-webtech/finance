<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\columnManage;

class columnAdd extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        columnManage::insert([
            ['table_name'=>'batch', 'field_status'=>'{"batch_col_1":1,"batch_col_2":1,"batch_col_3":1,"batch_col_4":1,"batch_col_5":1,"batch_col_6":1,"batch_col_7":1,"batch_col_8":1}', 'role_id'=>'0'],
            ['table_name'=>'batch', 'field_status'=>'{"batch_col_1":1,"batch_col_2":1,"batch_col_3":1,"batch_col_4":1,"batch_col_5":1,"batch_col_6":1,"batch_col_7":1,"batch_col_8":1}', 'role_id'=>'1'],
            ['table_name'=>'batch', 'field_status'=>'{"batch_col_1":1,"batch_col_2":1,"batch_col_3":1,"batch_col_4":1,"batch_col_5":1,"batch_col_6":1,"batch_col_7":1,"batch_col_8":1}', 'role_id'=>'2'],
            ['table_name'=>'batch', 'field_status'=>'{"batch_col_1":1,"batch_col_2":1,"batch_col_3":1,"batch_col_4":1,"batch_col_5":1,"batch_col_6":1,"batch_col_7":1,"batch_col_8":1}', 'role_id'=>'3'],
            ['table_name'=>'batch', 'field_status'=>'{"batch_col_1":1,"batch_col_2":1,"batch_col_3":1,"batch_col_4":1,"batch_col_5":1,"batch_col_6":1,"batch_col_7":1,"batch_col_8":1}', 'role_id'=>'4'],
            ['table_name'=>'batch', 'field_status'=>'{"batch_col_1":1,"batch_col_2":1,"batch_col_3":1,"batch_col_4":1,"batch_col_5":1,"batch_col_6":1,"batch_col_7":1,"batch_col_8":1}', 'role_id'=>'5'],
            ['table_name'=>'batch', 'field_status'=>'{"batch_col_1":1,"batch_col_2":1,"batch_col_3":1,"batch_col_4":1,"batch_col_5":1,"batch_col_6":1,"batch_col_7":1,"batch_col_8":1}', 'role_id'=>'6'],

            ['table_name'=>'income', 'field_status'=>'{"income_col_1":1,"income_col_2":1,"income_col_3":1,"income_col_4":null,"income_col_5":null,"income_col_6":null,"income_col_7":null,"income_col_8":null}', 'role_id'=>'0'],
            ['table_name'=>'income', 'field_status'=>'{"income_col_1":1,"income_col_2":1,"income_col_3":1,"income_col_4":null,"income_col_5":null,"income_col_6":null,"income_col_7":null,"income_col_8":null}', 'role_id'=>'1'],
            ['table_name'=>'income', 'field_status'=>'{"income_col_1":1,"income_col_2":1,"income_col_3":1,"income_col_4":null,"income_col_5":null,"income_col_6":null,"income_col_7":null,"income_col_8":null}', 'role_id'=>'2'],
            ['table_name'=>'income', 'field_status'=>'{"income_col_1":1,"income_col_2":1,"income_col_3":1,"income_col_4":null,"income_col_5":null,"income_col_6":null,"income_col_7":null,"income_col_8":null}', 'role_id'=>'3'],
            ['table_name'=>'income', 'field_status'=>'{"income_col_1":1,"income_col_2":1,"income_col_3":1,"income_col_4":null,"income_col_5":null,"income_col_6":null,"income_col_7":null,"income_col_8":null}', 'role_id'=>'4'],
            ['table_name'=>'income', 'field_status'=>'{"income_col_1":1,"income_col_2":1,"income_col_3":1,"income_col_4":null,"income_col_5":null,"income_col_6":null,"income_col_7":null,"income_col_8":null}', 'role_id'=>'5'],
            ['table_name'=>'income', 'field_status'=>'{"income_col_1":1,"income_col_2":1,"income_col_3":1,"income_col_4":null,"income_col_5":null,"income_col_6":null,"income_col_7":null,"income_col_8":null}', 'role_id'=>'6'],

            ['table_name'=>'expencemaster', 'field_status'=>'{"expencemaster_col_1":1,"expencemaster_col_2":1,"expencemaster_col_3":1,"expencemaster_col_4":1,"expencemaster_col_5":1,"expencemaster_col_6":1,"expencemaster_col_7":1,"expencemaster_col_8":1}', 'role_id'=>'0'],
            ['table_name'=>'expencemaster', 'field_status'=>'{"expencemaster_col_1":1,"expencemaster_col_2":1,"expencemaster_col_3":1,"expencemaster_col_4":1,"expencemaster_col_5":1,"expencemaster_col_6":1,"expencemaster_col_7":1,"expencemaster_col_8":1}', 'role_id'=>'1'],
            ['table_name'=>'expencemaster', 'field_status'=>'{"expencemaster_col_1":1,"expencemaster_col_2":1,"expencemaster_col_3":1,"expencemaster_col_4":1,"expencemaster_col_5":1,"expencemaster_col_6":1,"expencemaster_col_7":1,"expencemaster_col_8":1}', 'role_id'=>'2'],
            ['table_name'=>'expencemaster', 'field_status'=>'{"expencemaster_col_1":1,"expencemaster_col_2":1,"expencemaster_col_3":1,"expencemaster_col_4":1,"expencemaster_col_5":1,"expencemaster_col_6":1,"expencemaster_col_7":1,"expencemaster_col_8":1}', 'role_id'=>'3'],
            ['table_name'=>'expencemaster', 'field_status'=>'{"expencemaster_col_1":1,"expencemaster_col_2":1,"expencemaster_col_3":1,"expencemaster_col_4":1,"expencemaster_col_5":1,"expencemaster_col_6":1,"expencemaster_col_7":1,"expencemaster_col_8":1}', 'role_id'=>'4'],
            ['table_name'=>'expencemaster', 'field_status'=>'{"expencemaster_col_1":1,"expencemaster_col_2":1,"expencemaster_col_3":1,"expencemaster_col_4":1,"expencemaster_col_5":1,"expencemaster_col_6":1,"expencemaster_col_7":1,"expencemaster_col_8":1}', 'role_id'=>'5'],
            ['table_name'=>'expencemaster', 'field_status'=>'{"expencemaster_col_1":1,"expencemaster_col_2":1,"expencemaster_col_3":1,"expencemaster_col_4":1,"expencemaster_col_5":1,"expencemaster_col_6":1,"expencemaster_col_7":1,"expencemaster_col_8":1}', 'role_id'=>'6'],

            ['table_name'=>'course', 'field_status'=>'{"course_col_1":1,"course_col_2":1,"course_col_3":null,"course_col_4":null,"course_col_5":null,"course_col_6":null,"course_col_7":null,"course_col_8":null}', 'role_id'=>'0'],
            ['table_name'=>'course', 'field_status'=>'{"course_col_1":1,"course_col_2":1,"course_col_3":null,"course_col_4":null,"course_col_5":null,"course_col_6":null,"course_col_7":null,"course_col_8":null}', 'role_id'=>'1'],
            ['table_name'=>'course', 'field_status'=>'{"course_col_1":1,"course_col_2":1,"course_col_3":null,"course_col_4":null,"course_col_5":null,"course_col_6":null,"course_col_7":null,"course_col_8":null}', 'role_id'=>'2'],
            ['table_name'=>'course', 'field_status'=>'{"course_col_1":1,"course_col_2":1,"course_col_3":null,"course_col_4":null,"course_col_5":null,"course_col_6":null,"course_col_7":null,"course_col_8":null}', 'role_id'=>'3'],
            ['table_name'=>'course', 'field_status'=>'{"course_col_1":1,"course_col_2":1,"course_col_3":null,"course_col_4":null,"course_col_5":null,"course_col_6":null,"course_col_7":null,"course_col_8":null}', 'role_id'=>'4'],
            ['table_name'=>'course', 'field_status'=>'{"course_col_1":1,"course_col_2":1,"course_col_3":null,"course_col_4":null,"course_col_5":null,"course_col_6":null,"course_col_7":null,"course_col_8":null}', 'role_id'=>'5'],
            ['table_name'=>'course', 'field_status'=>'{"course_col_1":1,"course_col_2":1,"course_col_3":null,"course_col_4":null,"course_col_5":null,"course_col_6":null,"course_col_7":null,"course_col_8":null}', 'role_id'=>'6'],

            ['table_name'=>'student', 'field_status'=>'{"student_col_1":1,"student_col_2":1,"student_col_3":1,"student_col_4":1,"student_col_5":null,"student_col_6":1,"student_col_7":1,"student_col_8":null}', 'role_id'=>'0'],
            ['table_name'=>'student', 'field_status'=>'{"student_col_1":1,"student_col_2":1,"student_col_3":1,"student_col_4":1,"student_col_5":null,"student_col_6":1,"student_col_7":1,"student_col_8":null}', 'role_id'=>'1'],
            ['table_name'=>'student', 'field_status'=>'{"student_col_1":1,"student_col_2":1,"student_col_3":1,"student_col_4":1,"student_col_5":null,"student_col_6":1,"student_col_7":1,"student_col_8":null}', 'role_id'=>'2'],
            ['table_name'=>'student', 'field_status'=>'{"student_col_1":1,"student_col_2":1,"student_col_3":1,"student_col_4":1,"student_col_5":null,"student_col_6":1,"student_col_7":1,"student_col_8":null}', 'role_id'=>'3'],
            ['table_name'=>'student', 'field_status'=>'{"student_col_1":1,"student_col_2":1,"student_col_3":1,"student_col_4":1,"student_col_5":null,"student_col_6":1,"student_col_7":1,"student_col_8":null}', 'role_id'=>'4'],
            ['table_name'=>'student', 'field_status'=>'{"student_col_1":1,"student_col_2":1,"student_col_3":1,"student_col_4":1,"student_col_5":null,"student_col_6":1,"student_col_7":1,"student_col_8":null}', 'role_id'=>'5'],
            ['table_name'=>'student', 'field_status'=>'{"student_col_1":1,"student_col_2":1,"student_col_3":1,"student_col_4":1,"student_col_5":null,"student_col_6":1,"student_col_7":1,"student_col_8":null}', 'role_id'=>'6'],

            ['table_name'=>'corporat', 'field_status'=>'{"corporat_col_1":1,"corporat_col_2":1,"corporat_col_3":1,"corporat_col_4":1,"corporat_col_5":1,"corporat_col_6":1,"corporat_col_7":1,"corporat_col_8":1}', 'role_id'=>'0'],
            ['table_name'=>'corporat', 'field_status'=>'{"corporat_col_1":1,"corporat_col_2":1,"corporat_col_3":1,"corporat_col_4":1,"corporat_col_5":1,"corporat_col_6":1,"corporat_col_7":1,"corporat_col_8":1}', 'role_id'=>'1'],
            ['table_name'=>'corporat', 'field_status'=>'{"corporat_col_1":1,"corporat_col_2":1,"corporat_col_3":1,"corporat_col_4":1,"corporat_col_5":1,"corporat_col_6":1,"corporat_col_7":1,"corporat_col_8":1}', 'role_id'=>'2'],
            ['table_name'=>'corporat', 'field_status'=>'{"corporat_col_1":1,"corporat_col_2":1,"corporat_col_3":1,"corporat_col_4":1,"corporat_col_5":1,"corporat_col_6":1,"corporat_col_7":1,"corporat_col_8":1}', 'role_id'=>'3'],
            ['table_name'=>'corporat', 'field_status'=>'{"corporat_col_1":1,"corporat_col_2":1,"corporat_col_3":1,"corporat_col_4":1,"corporat_col_5":1,"corporat_col_6":1,"corporat_col_7":1,"corporat_col_8":1}', 'role_id'=>'4'],
            ['table_name'=>'corporat', 'field_status'=>'{"corporat_col_1":1,"corporat_col_2":1,"corporat_col_3":1,"corporat_col_4":1,"corporat_col_5":1,"corporat_col_6":1,"corporat_col_7":1,"corporat_col_8":1}', 'role_id'=>'5'],
            ['table_name'=>'corporat', 'field_status'=>'{"corporat_col_1":1,"corporat_col_2":1,"corporat_col_3":1,"corporat_col_4":1,"corporat_col_5":1,"corporat_col_6":1,"corporat_col_7":1,"corporat_col_8":1}', 'role_id'=>'6'],

            ['table_name'=>'trainer', 'field_status'=>'{"trainer_col_1":1,"trainer_col_2":1,"trainer_col_3":1,"trainer_col_4":1,"trainer_col_5":1,"trainer_col_6":null,"trainer_col_7":null,"trainer_col_8":null}', 'role_id'=>'0'],
            ['table_name'=>'trainer', 'field_status'=>'{"trainer_col_1":1,"trainer_col_2":1,"trainer_col_3":1,"trainer_col_4":1,"trainer_col_5":1,"trainer_col_6":null,"trainer_col_7":null,"trainer_col_8":null}', 'role_id'=>'1'],
            ['table_name'=>'trainer', 'field_status'=>'{"trainer_col_1":1,"trainer_col_2":1,"trainer_col_3":1,"trainer_col_4":1,"trainer_col_5":1,"trainer_col_6":null,"trainer_col_7":null,"trainer_col_8":null}', 'role_id'=>'2'],
            ['table_name'=>'trainer', 'field_status'=>'{"trainer_col_1":1,"trainer_col_2":1,"trainer_col_3":1,"trainer_col_4":1,"trainer_col_5":1,"trainer_col_6":null,"trainer_col_7":null,"trainer_col_8":null}', 'role_id'=>'3'],
            ['table_name'=>'trainer', 'field_status'=>'{"trainer_col_1":1,"trainer_col_2":1,"trainer_col_3":1,"trainer_col_4":1,"trainer_col_5":1,"trainer_col_6":null,"trainer_col_7":null,"trainer_col_8":null}', 'role_id'=>'4'],
            ['table_name'=>'trainer', 'field_status'=>'{"trainer_col_1":1,"trainer_col_2":1,"trainer_col_3":1,"trainer_col_4":1,"trainer_col_5":1,"trainer_col_6":null,"trainer_col_7":null,"trainer_col_8":null}', 'role_id'=>'5'],
            ['table_name'=>'trainer', 'field_status'=>'{"trainer_col_1":1,"trainer_col_2":1,"trainer_col_3":1,"trainer_col_4":1,"trainer_col_5":1,"trainer_col_6":null,"trainer_col_7":null,"trainer_col_8":null}', 'role_id'=>'6'],

            ['table_name'=>'user', 'field_status'=>'{"user_col_1":1,"user_col_2":1,"user_col_3":1,"user_col_4":1,"user_col_5":1,"user_col_6":null,"user_col_7":null,"user_col_8":null}', 'role_id'=>'0'],
            ['table_name'=>'user', 'field_status'=>'{"user_col_1":1,"user_col_2":1,"user_col_3":1,"user_col_4":1,"user_col_5":1,"user_col_6":null,"user_col_7":null,"user_col_8":null}', 'role_id'=>'1'],
            ['table_name'=>'user', 'field_status'=>'{"user_col_1":1,"user_col_2":1,"user_col_3":1,"user_col_4":1,"user_col_5":1,"user_col_6":null,"user_col_7":null,"user_col_8":null}', 'role_id'=>'2'],
            ['table_name'=>'user', 'field_status'=>'{"user_col_1":1,"user_col_2":1,"user_col_3":1,"user_col_4":1,"user_col_5":1,"user_col_6":null,"user_col_7":null,"user_col_8":null}', 'role_id'=>'3'],
            ['table_name'=>'user', 'field_status'=>'{"user_col_1":1,"user_col_2":1,"user_col_3":1,"user_col_4":1,"user_col_5":1,"user_col_6":null,"user_col_7":null,"user_col_8":null}', 'role_id'=>'4'],
            ['table_name'=>'user', 'field_status'=>'{"user_col_1":1,"user_col_2":1,"user_col_3":1,"user_col_4":1,"user_col_5":1,"user_col_6":null,"user_col_7":null,"user_col_8":null}', 'role_id'=>'5'],
            ['table_name'=>'user', 'field_status'=>'{"user_col_1":1,"user_col_2":1,"user_col_3":1,"user_col_4":1,"user_col_5":1,"user_col_6":null,"user_col_7":null,"user_col_8":null}', 'role_id'=>'6'],

        ]);
    }
}
