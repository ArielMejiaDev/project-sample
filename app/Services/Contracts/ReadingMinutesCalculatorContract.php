<?php

namespace App\Services\Contracts;

interface ReadingMinutesCalculatorContract
{
    public function getReadingMinutes($subject, $wordsPerMinute = 200): int;
}
