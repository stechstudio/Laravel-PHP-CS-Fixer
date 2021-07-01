<?php

namespace STS\Fixer\Services\Fixer\Concerns;

use PhpCsFixer\Console\Output\ErrorOutput;
use PhpCsFixer\Error\ErrorsManager;
use Symfony\Component\Console\Output\OutputInterface;

trait HasErrorsManager
{

    /**
     * 
     * @var ErrorsManager
     */
    protected $errorsManager;

    /**
     * 
     * @var ErrorOutput
     */
    protected $errorOutput;

    public function setErrorsManager(?ErrorsManager $errorsManager = null)
    {
        $this->errorsManager = $errorsManager ?? new ErrorsManager();
    }

    public function getErrorsManager()
    {
        if ($this->errorsManager === null) {
            $this->setErrorsManager();
        }

        return $this->errorsManager;
    }

    public function getErrorOutput(?OutputInterface $output = null)
    {
        if ($this->errorOutput === null) {
            $this->errorOutput = new ErrorOutput($output);
        }
        return $this->errorOutput;
    }
}
