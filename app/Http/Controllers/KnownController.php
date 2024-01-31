<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class KnownController extends Controller
{
    public function markQuestionKnown(Request $request)
    {
        $userId = $request->input('userId');
        $questionId = $request->input('questionId');
        $courseId = $request->input('courseId');

        // Check if the record already exists
        $exists = DB::table('known_questions')
                    ->where('user_id', $userId)
                    ->where('question_id', $questionId)
                    ->exists();

        if (!$exists) {
            // Insert a new record
            DB::table('known_questions')->insert([
                'user_id' => $userId,
                'question_id' => $questionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Redirect back to the quiz route
        return response()->json(['success' => true]);
    }

    public function getKnownQuestions()
    {
        $userId = auth()->user()->id;
        $questions = DB::table('known_questions')
                        ->join('questions', 'known_questions.question_id', '=', 'questions.id')
                        ->join('courses', 'questions.course_id', '=', 'courses.id')
                        ->where('known_questions.user_id', $userId)
                        ->get(['questions.*', 'courses.course_name as course_name']);
        return response()->json($questions);
    }

    public function unmarkQuestionKnown($questionId)
    {
        $userId = auth()->user()->id;
        DB::table('known_questions')
        ->where('user_id', $userId)
        ->where('question_id', $questionId)
        ->delete();
        return response()->json(['success' => true]);
    }
}
