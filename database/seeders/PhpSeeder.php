<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhpSeeder extends Seeder
{
    public function run()
    {
        // Insert the PHP course
        $courseId = DB::table('courses')->insertGetId([
            'slug' => 'php',
            'course_name' => 'PHP', // Change to 'PHP' to match the course_name
            'description' => 'PHP Course Description',
            'difficulty' => 'Beginner',
            'category' => 'Programming',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Define topics for PHP course
        $topics = [
            ['course_id' => $courseId, 'name' => 'Basic'],
            // Add more topics for PHP course here
        ];

        // Insert topics for PHP course
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
                    'question' => 'Sample Question 1 for PHP',
                    'answer' => 'Sample Answer 1 for PHP',
                    'difficulty' => 'Easy',
                    'type' => 'text',
                    'course_id' => $courseId, // Add course_id to questions
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Sample Question 2 for PHP',
                    'answer' => 'Sample Answer 2 for PHP',
                    'difficulty' => 'Medium',
                    'type' => 'textarea',
                    'course_id' => $courseId, // Add course_id to questions
                ],
                // Add more questions for the PHP course here
            ];

            // Insert questions for the PHP course
            foreach ($questions as $question) {
                DB::table('questions')->insert([
                    'topic_id' => $question['topic_id'],
                    'question' => $question['question'],
                    'answer' => $question['answer'],
                    'difficulty' => $question['difficulty'],
                    'type' => $question['type'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $question['course_id'], // Insert course_id into questions
                ]);
            }
        }
    }
}

