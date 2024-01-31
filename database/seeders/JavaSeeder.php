<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JavaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert the Java course
        $courseId = DB::table('courses')->insertGetId([
            'slug' => 'java',
            'course_name' => 'Java',
            'description' => 'Java Course Description',
            'difficulty' => 'Beginner',
            'category' => 'Programming',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Define topics for Java course
        $topics = [
            ['course_id' => $courseId, 'name' => 'Basic'],
            // Add more topics for Java course here
        ];

        // Insert topics for Java course
        foreach ($topics as $topic) {
            $topicId = DB::table('topics')->insertGetId([
                'course_id' => $topic['course_id'],
                'name' => $topic['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Define questions for each topic
            $questions = [
                [
                    'topic_id' => $topicId,
                    'question' => 'Sample Question 1 for Java',
                    'answer' => 'Sample Answer 1 for Java',
                    'difficulty' => 'Easy',
                    'type' => 'text',
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Sample Question 2 for Java',
                    'answer' => 'Sample Answer 2 for Java',
                    'difficulty' => 'Medium',
                    'type' => 'textarea',
                    'course_id' => $courseId,
                ],
                // Add more questions for the Java course here
            ];

            // Insert questions for the Java course
            foreach ($questions as $question) {
                DB::table('questions')->insert([
                    'topic_id' => $question['topic_id'],
                    'question' => $question['question'],
                    'answer' => $question['answer'],
                    'difficulty' => $question['difficulty'],
                    'type' => $question['type'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $question['course_id'],
                ]);
            }
        }
    }
}
