<?php

namespace App\Strategies;

use App\Services\Contracts\IpHandlerContract;
use App\Services\JapaneseReadingMinutesCalculator;
use App\Services\OccidentalReadingMinutesCalculator;
use Closure;

class ReadingMinutesCalculatorHandler
{
    protected array $readingMinutesServices = [
        'North America' => OccidentalReadingMinutesCalculator::class,
        'Asia' => JapaneseReadingMinutesCalculator::class,
    ];

    protected IpHandlerContract $ipHandler;

    public function __construct(IpHandlerContract $ipHandler)
    {
        $this->ipHandler = $ipHandler;
    }

    public function __invoke(): Closure
    {
        return function() {
            $ipHandler = $this->ipHandler->getIpContinent();
            $class = $this->readingMinutesServices[$ipHandler] ?? $this->readingMinutesServices['North America'];
            return app()->make($class);
        };
    }
}
