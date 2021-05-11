<?php

namespace STS\Fixer\Services\Fixer\Concerns;

use Symfony\Component\Stopwatch\Stopwatch;

trait HasStopWatch
{

    /**
     * 
     * @var Stopwatch
     */
    private $stopWatch;

    public function setStopWatch()
    {
        $this->stopWatch = new Stopwatch();
    }

    public function getStopWatch()
    {
        if ($this->stopWatch === null) {
            $this->setStopWatch();
        }

        return $this->stopWatch;
    }
}
