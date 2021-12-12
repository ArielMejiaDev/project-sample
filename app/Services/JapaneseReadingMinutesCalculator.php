<?php

namespace App\Services;

use App\Services\Contracts\ReadingMinutesCalculatorContract;

class JapaneseReadingMinutesCalculator implements ReadingMinutesCalculatorContract
{
    public function getReadingMinutes($subject, $wordsPerMinute = 360): int
    {
        return intval(ceil(str_word_count(strip_tags($subject)) / $wordsPerMinute));
    }
}
