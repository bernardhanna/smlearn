<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Insert a course
        $courseId = DB::table('courses')->insertGetId([
            'slug' => 'test',
            'course_name' => 'Tester',
            'description' => 'A test course',
            'difficulty' => 'Easy',
            'category' => 'Test Category',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert a topic under the course
        $topicId = DB::table('topics')->insertGetId([
            'course_id' => $courseId,
            'name' => 'Basic',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert questions under the topic
        DB::table('questions')->insert([
            [
                'topic_id' => $topicId,
                'question' => 'What is 2 + 2?',
                'answer' => '4',
                'difficulty' => 'Easy',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'topic_id' => $topicId,
                'question' => 'Explain the concept of Object-Oriented Programming.',
                'answer' => 'Object-Oriented Programming is a programming paradigm based on the concept of objects...',
                'difficulty' => 'Medium',
                'type' => 'textarea',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'topic_id' => $topicId,
                'question' => 'Fill in the blank: The capital of France is ___.',
                'answer' => 'Paris',
                'difficulty' => 'Easy',
                'type' => 'fill-in-the-blank',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'topic_id' => $topicId,
                'question' => 'Is HTML a programming language? (true/false)',
                'answer' => 'false',
                'difficulty' => 'Easy',
                'type' => 'true-false',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
