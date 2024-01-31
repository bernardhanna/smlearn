<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Question;
use App\Models\KnownQuestion;

class QuizController extends Controller
{
    public function show(Course $course)
    {
        $userId = auth()->id();
        $knownQuestionIds = KnownQuestion::where('user_id', $userId)->pluck('question_id');

        $questions = Question::where('course_id', $course->id)
                              ->whereNotIn('id', $knownQuestionIds)
                              ->get();

        return Inertia::render('Quiz', [
            'course' => $course,
            'questions' => $questions,
            'user' => auth()->user(),
        ]);
    }
}
