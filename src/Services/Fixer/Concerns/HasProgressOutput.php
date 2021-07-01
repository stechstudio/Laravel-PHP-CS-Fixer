<?php

namespace STS\Fixer\Services\Fixer\Concerns;

use Symfony\Component\Console\Terminal;
use PhpCsFixer\Console\Output\NullOutput;
use PhpCsFixer\Console\Output\ProcessOutput;
use Symfony\Component\Console\Output\OutputInterface;

trait HasProgressOutput
{
    use HasEventDispatcher;

    /**
     * 
     * @var OutputInterface
     */
    private $output;

    /**
     * 
     * @var ProcessOutput|NullOutput
     */
    private $progressOutput;

    /**
     * @param $resolver
     * @param $stdErr
     *
     */
    protected function setProgressOutput()
    {
        $this->progressOutput = new NullOutput();

        if ('none' !== $this->configResolver->getProgress()) {
            $this->progressOutput = new ProcessOutput(
                $this->output,
                $this->eventDispatcher,
                (new Terminal())->getWidth(),
                $this->finder->count()
            );
        }
    }

    public function getProgressOutput()
    {
        return $this->getProgressOutput();
    }

    public function printLegend()
    {
        $this->progressOutput->printLegend();
    }
}
