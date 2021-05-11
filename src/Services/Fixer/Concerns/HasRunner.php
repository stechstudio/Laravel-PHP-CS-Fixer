<?php

namespace STS\Fixer\Services\Fixer\Concerns;

use PhpCsFixer\Runner\Runner;

trait HasRunner
{
    use HasFinder;
    use HasStopWatch;
    use HasErrorsManager;
    use HasEventDispatcher;
    use HasConfigurationResolver;

    /**
     * 
     * @var Runner
     */
    protected $runner;

    /**
     * 
     * @var array
     */
    protected $filesModified;

    public function setRunner(?Runner $runner = null)
    {
        $this->runner = new Runner(
            $this->getFinder(),
            $this->configResolver->getFixers(),
            $this->configResolver->getDiffer(),
            'none' !== $this->configResolver->getProgress() ? $this->getEventDispatcher() : null,
            $this->getErrorsManager(),
            $this->configResolver->getLinter(),
            $this->configResolver->isDryRun(),
            $this->configResolver->getCacheManager(),
            $this->configResolver->getDirectory(),
            $this->configResolver->shouldStopOnViolation()
        );
    }

    public function getRunner()
    {
        if ($this->runner === null) {
            $this->setRunner();
        }
        return $this->runner;
    }

    public function fixFiles()
    {
        $this->getStopWatch()->start('fixFiles');
        $this->filesModified = $this->getRunner()->fix();
        $this->getStopWatch()->stop('fixFiles');
    }
}
