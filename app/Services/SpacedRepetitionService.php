<?php

namespace App\Services;

class SpacedRepetitionService
{
    public function calculateNextReview($isCorrect, $currentInterval, $currentRepetitions, $currentEasinessFactor)
    {
        // Adjust these factors as necessary
        $easinessFactorAdjustmentOnCorrect = 0.1; // Example adjustment

        if (!$isCorrect) {
            $newInterval = 1;
            $newRepetitions = 0;
            $newEasinessFactor = $currentEasinessFactor; // adjust this downwards for incorrect answers
        } else {
            $newRepetitions = $currentRepetitions + 1;
            $newEasinessFactor = max(1.3, $currentEasinessFactor + $easinessFactorAdjustmentOnCorrect); // Adjusting based on correctness

            if ($newRepetitions == 1) {
                $newInterval = 1;
            } elseif ($newRepetitions == 2) {
                $newInterval = 6;
            } else {
                $newInterval = ceil($currentInterval * $newEasinessFactor);
            }
        }

        $nextReviewDate = now()->addDays($newInterval);

        return [
            'interval' => $newInterval,
            'repetitions' => $newRepetitions,
            'easinessFactor' => $newEasinessFactor,
            'nextReviewDate' => $nextReviewDate->toDateString(),
        ];
    }
}
