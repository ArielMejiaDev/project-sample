<?php

namespace App\Services;

use App\Services\Contracts\ReadingMinutesCalculatorContract;

class OccidentalReadingMinutesCalculator implements ReadingMinutesCalculatorContract
{
    public function getReadingMinutes($subject, $wordsPerMinute = 250): int
    {
        return intval(ceil(str_word_count(strip_tags($subject)) / $wordsPerMinute));
    }
}
