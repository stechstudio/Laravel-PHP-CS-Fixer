<?php

namespace STS\Fixer\Services;

use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Console\ConfigurationResolver;
use PhpCsFixer\ToolInfo;
use PhpCsFixer\ToolInfoInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpCsFixer\Console\Output\ErrorOutput;
use PhpCsFixer\Console\Output\NullOutput;
use PhpCsFixer\Console\Output\ProcessOutput;
use PhpCsFixer\Finder;
use Symfony\Component\Console\Terminal;

class Fixer
{
    /**
     * 
     * @var array
     */
    protected $cliInput;

    /**
     * 
     * @var mixed
     */
    protected $configResolver;

    /**
     * 
     * @var InputInterface
     */
    protected $input;

    /**
     * 
     * @var OutputInterface
     */
    protected $output;

    /**
     * 
     * @var Finder
     */
    protected $finder;

    /**
     * 
     * @var ProcessOutput|NullOutput
     */
    protected $progressOutput;


    public function __construct(InputInterface $input, OutputInterface $output, ?array $cliInput = null, ?ConfigInterface $config = null, ?string $cwd = null, ?ToolInfoInterface $toolInfo = null)
    {
        $this->input = $input;
        $this->output = $output;
        $this->cliInput = $cliInput;
        $this->setResolver($cliInput, $config, $cwd, $toolInfo);
        $this->setFinder();
        $this->setProgressOutput();
    }

    public function setResolver(array $options, ?ConfigInterface $config = null, ?string $cwd = null, ?ToolInfoInterface $toolInfo = null)
    {
        $config = $config ?: new Config();
        $cwd = $cwd ?: getcwd();
        $toolInfo = $toolInfo ?: new ToolInfo();
        $this->configResolver = new ConfigurationResolver($config, $options, $cwd, $toolInfo);
    }

    public function setFinder()
    {
        $this->finder = Finder::create()
            ->in(config('fixer.find_directories'))
            ->name(config('file_name_pattern_whitelist'))
            ->notName(config('file_name_pattern_blacklist'))
            ->ignoreDotFiles(config('ignore_dot_files'))
            ->ignoreVCS(config('ignore_vcs'));
    }

    /**
     * @param $resolver
     * @param $stdErr
     *
     */
    protected function setProgressOutput()
    {
        $this->progressOutput = new NullOutput();

        if ('none' !== $this->configResolver->getProgress()) {
            $nbFiles = new \ArrayIterator(iterator_to_array($this->finder));
            $this->progressOutput = new ProcessOutput(
                $this->output,
                $this->eventDispatcher,
                'estimating-max' === $this->configResolver->getProgress() ? (new Terminal())->getWidth() : null,
                count($nbFiles)
            );
        }
    }
}
