<?php

namespace Tests\Mocks;

use App\Services\Contracts\ReadingMinutesCalculatorContract;

class MockReadingMinutesCalculator implements ReadingMinutesCalculatorContract
{
    public function getReadingMinutes($subject, $wordsPerMinute = 1): int
    {
        return $wordsPerMinute;
    }
}
