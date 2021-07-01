<?php

namespace STS\Fixer\Services\Fixer\Concerns;


use Symfony\Component\EventDispatcher\EventDispatcher;


trait HasEventDispatcher
{

    /**
     *
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    public function setEventDispatcher(?EventDispatcher $eventDispatcher = null)
    {
        $this->eventDispatcher = $eventDispatcher ?? new EventDispatcher();
    }

    public function getEventDispatcher()
    {
        if ($this->eventDispatcher === null) {
            $this->setEventDispatcher();
        }
        return $this->eventDispatcher;
    }
}
