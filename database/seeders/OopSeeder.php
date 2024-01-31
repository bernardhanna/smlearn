<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert the OOP course
        $courseId = DB::table('courses')->insertGetId([
            'slug' => 'oop',
            'course_name' => 'OOP',
            'description' => 'OOP Course Description',
            'difficulty' => 'Beginner',
            'category' => 'Programming',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Define topics for OOP course
        $topics = [
            ['course_id' => $courseId, 'name' => 'Basic'],
            // Add more topics for OOP course here
        ];

        // Insert topics for OOP course
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
                    'question' => 'Sample Question 1 for OOP',
                    'answer' => 'Sample Answer 1 for OOP',
                    'difficulty' => 'Easy',
                    'type' => 'text',
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Sample Question 2 for OOP',
                    'answer' => 'Sample Answer 2 for OOP',
                    'difficulty' => 'Medium',
                    'type' => 'textarea',
                    'course_id' => $courseId,
                ],
                // Add more questions for the OOP course here
            ];

            // Insert questions for the OOP course
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
