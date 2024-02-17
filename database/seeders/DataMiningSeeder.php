<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DataMiningSeeder extends Seeder
{
    public function run()
    {
        // Insert the DataMining course
        $courseId = DB::table('courses')->insertGetId([
            'slug' => Str::slug('DataMining'),
            'course_name' => 'DataMining',
            'description' => 'DataMining Course Description',
            'difficulty' => 'Beginner',
            'category' => 'Programming',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Define topics for DataMining course
        $topics = [
            ['course_id' => $courseId, 'name' => 'Introduction'],
        ];

        foreach ($topics as $topic) {
            $topicId = DB::table('topics')->insertGetId([
                'course_id' => $topic['course_id'],
                'name' => $topic['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Define questions for the Introduction topic
            $questions = [
                [
                    'topic_id' => $topicId,
                    'question' => 'What metrics are used to construct decision trees?',
                    'answer' => 'ID3, C4.5, CART or Gini impurity',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'course_id' => $courseId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'How do we classify a new data instance?',
                    'answer' => 'We start at the root and make decisions at each node based on the instance\'s features until we reach a leaf node, which gives us the classification',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Describe the Deterministic Model:',
                    'answer' => 'An equation or set of equations that allow us to fully determine the value of the dependent variable from the values of the independent variables',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Describe the Probabilistic Model:',
                    'answer' => 'A method used to make predictions but the predictions will be approximate due to the randomness of a real-world process',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What is supervised Learning?',
                    'answer' => 'Supervised learning is a type of machine learning where the algorithm is trained on a dataset that includes the input data and the correct outputs. This training helps the algorithm make predictions on new, unseen data',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What is the goal of supervised Learning?',
                    'answer' => 'The goal of supervised Learning is to learn a mapping from inputs to outputs',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What are some examples of supervised Learning?',
                    'answer' => 'Regression and classification tasks like predicting house prices or identifying spam emails are some examples of supervised Learning',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'When would we use supervised Learning?',
                    'answer' => 'Supervised Learning is used when the relationship between input data and the output label is crucial, and labeled data is available',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'When is Supervised learning Ideal?',
                    'answer' => 'Supervised learning is ideal for prediction and classification tasks',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What is Unsupervised Learning?',
                    'answer' => 'Unsupervised learning involves learning patterns from unlabeled data',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What is the goal of Unsupervised Learning?',
                    'answer' => 'The goal of unsupervised learning is for the algorithm to discover patterns and structures in data on its own without being given any specific outputs or labels to guide it',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What are some examples of Unsupervised Learning?',
                    'answer' => 'Clustering, dimensionality reduction, and association rule learning',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What are some examples of association rule learning?',
                    'answer' => 'Feature reduction, customer segmentation, and market basket analysis are examples of association rule learning',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'When would we use unsupervised Learning?',
                    'answer' => 'Unsupervised learning is best for data exploration and pattern discovery. When the goal is to understand and explore data, uncover hidden patterns, or identify clusters',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What is the basic difference between Supervised and Unsupervised learning?',
                    'answer' => 'The primary goal of supervised learning is typically to make predictions, whereas unsupervised learning aims to explore the underlying structure of the data',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What does CRISP-DM stand for?',
                    'answer' => 'Cross Industry Standard Process for Data Mining',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Outline the 6 steps in the CRISP-DM model',
                    'answer' => 'Business Understanding, Data Understanding, Data Preparation, Modeling, Evaluation, Deployment',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Name the first 3 steps in CRISP-DM model again',
                    'answer' => 'Business Understanding, Data Understanding, Data Preparation',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Name the last 3 steps in CRISP-DM model again',
                    'answer' => 'Modeling, Evaluation, Deployment',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Detail the Business Understanding step',
                    'answer' => 'Business Understanding involves defining the problem, determining its relevance to business goals, and translating it into a data mining context',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Detail the Data Understanding step',
                    'answer' => 'Collect data, get familiar with the data, identify data quality issues, detect interesting subsets for further examination',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Detail the Data Preparation step',
                    'answer' => 'Data Preparation entails transforming raw data into a suitable dataset for analysis, involving cleaning, selecting, and feature engineering',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Detail the Modelling step',
                    'answer' => 'Modelling involves selecting and configuring machine learning algorithms, such as Decision Trees, to fit the prepared data',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Detail the Evaluation step',
                    'answer' => 'Evaluate the model before deployment. Often another iteration is required, going back to the Business Understanding Phase',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'Detail the Deployment step',
                    'answer' => 'Plan and execute the deployment of the model. Produce final reports, conduct a final review, and prepare for ongoing support and maintenance.',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What does the CRISP-DM model emphasize?',
                    'answer' => 'The cyclical nature of data mining projects, where the outcomes of each stage can impact previous steps, requiring iteration and refinement',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'What are some negatives of the CRISP-DM model?',
                    'answer' => 'Some negatives of the CRISP-DM model include its unpredictability due to its exploratory nature, the potential need for multiple prototypes, and the risk of costly mistakes if a solution is engineered and deployed prematurely',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ],
                [
                    'topic_id' => $topicId,
                    'question' => 'When is it best to use the CRISP-DM model?',
                    'answer' => 'The CRISP-DM model is flexible and can be adapted to fit a wide range of data mining projects',
                    'difficulty' => 'Easy',
                    'type' => 'speech',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $courseId,
                ]
            ];

            // Insert questions for the DataMining course
            foreach ($questions as $question) {
                DB::table('questions')->insert([
                    'topic_id' => $question['topic_id'],
                    'question' => $question['question'],
                    'answer' => $question['answer'],
                    'image_url' => $question['image_url'] ?? null,
                    'video_id' => $question['video_id'] ?? null,
                    'difficulty' => $question['difficulty'],
                    'type' => $question['type'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'course_id' => $question['course_id']
                ]);
            }
        }
    }
}
