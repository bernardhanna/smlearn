<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MachineLearningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert the MachineLearning course
        $courseId = DB::table('courses')->insertGetId([
            'slug' => 'machinelearning',
            'course_name' => 'MachineLearning',
            'description' => 'MachineLearning Course Description',
            'difficulty' => 'Beginner',
            'category' => 'Programming',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Define topics for MachineLearning course
        $topics = [
            ['course_id' => $courseId, 'name' => 'Basic'],
            // Add more topics for MachineLearning course here
        ];

        // Insert topics for MachineLearning course
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
                    'question' => 'Sample Question 1 for MachineLearning',
                    'answer' => 'Sample Answer 1 for MachineLearning',
                    'difficulty' => 'Easy',
                    'type' => 'text',
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Sample Question 2 for MachineLearning',
                    'answer' => 'Sample Answer 2 for MachineLearning',
                    'difficulty' => 'Medium',
                    'type' => 'textarea',
                    'course_id' => $courseId,
                ],
                // Add more questions for the MachineLearning course here
            ];

            // Insert questions for the MachineLearning course
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
