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
            ],
            [
                'topic_id' => $topicId,
                'question' => 'What is the capital of france?',
                'answer' => 'Paris',
                'difficulty' => 'Easy',
                'type' => 'speech', // Set the type to 'speech'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'course_id' => $courseId,
            ],
            [
                'topic_id' => $topicId,
                'question' => 'Identify the chart type in the image.',
                'answer' => 'Bar chart',
                'image_url' => '/images/your_image.jpg', // Adjust path as necessary
                'difficulty' => 'Medium',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'course_id' => $courseId,
            ],
            [
                'topic_id' => $topicId,
                'question' => 'Watch the following video on the basics of data visualization and answer: What is one key takeaway?',
                'video_id' => 'loYuxWSsLNc', // Use YouTube video ID
                'answer' => 'Visualizations can reveal trends and patterns in data',
                'difficulty' => 'Medium',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'course_id' => $courseId,
            ],
            // Add more questions as needed
        ]);
    }
}
