<?php

namespace STS\Fixer\Services;

use PhpCsFixer\ConfigInterface;
use PhpCsFixer\ToolInfoInterface;

use STS\Fixer\Services\Fixer\Concerns\HasRunner;
use STS\Fixer\Services\Fixer\Concerns\HasFinder;
use STS\Fixer\Services\Fixer\Concerns\HasFixEvent;
use Symfony\Component\Console\Output\OutputInterface;
use STS\Fixer\Services\Fixer\Concerns\HasProgressOutput;

class Fixer
{

    use HasFinder,
        HasProgressOutput,
        HasRunner,
        HasFixEvent;

    /**
     * 
     * @var array
     */
    protected $cliInput;


    public function __construct(OutputInterface $output, ?array $cliInput = null, ?ConfigInterface $config = null, ?string $cwd = null, ?ToolInfoInterface $toolInfo = null)
    {
        $this->output = $output;
        $this->cliInput = $cliInput;
        $this->setResolver($cliInput, $config, $cwd, $toolInfo);
        $this->setEventDispatcher();
        $this->setFinder();
        $this->setProgressOutput();
    }
}
