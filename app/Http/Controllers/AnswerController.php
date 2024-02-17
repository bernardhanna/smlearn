<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question; // Assume you have a Question model
use App\Models\UserQuestion; // This model tracks user's answers and spaced repetition data

class AnswerController extends Controller
{
    public function submitAnswer(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required|integer',
            'questionId' => 'required|integer',
            'courseId' => 'required|integer',
            'performanceRating' => 'required|string', // e.g., "correct", "incorrect"
        ]);

        // Assuming you have a method to calculate spaced repetition metrics
        $metrics = $this->calculateSpacedRepetitionMetrics($validated['questionId'], $validated['userId'], $validated['performanceRating']);

        // Save the metrics to the database
        UserQuestion::updateOrCreate(
            ['user_id' => $validated['userId'], 'question_id' => $validated['questionId']],
            ['interval' => $metrics['interval'], 'repetitions' => $metrics['repetitions'], 'easinessFactor' => $metrics['easinessFactor'], 'nextReviewDate' => $metrics['nextReviewDate']]
        );

        return response()->json($metrics);
    }

    // Example method for calculating spaced repetition metrics (this is a placeholder and needs actual logic)
    protected function calculateSpacedRepetitionMetrics($questionId, $userId, $performanceRating)
    {
        // Implement the logic for calculating new metrics based on the SuperMemo SM-2 algorithm or similar
        // This is a simplified example
        return [
            'interval' => 1, // days until next review
            'repetitions' => 1, // number of times this question has been reviewed
            'easinessFactor' => 2.5, // SM-2 easiness factor
            'nextReviewDate' => now()->addDay()->toDateString(), // next review date
        ];
    }
}
