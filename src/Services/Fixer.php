<?php

namespace STS\Fixer\Services;

use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Console\ConfigurationResolver;
use PhpCsFixer\ToolInfo;
use PhpCsFixer\ToolInfoInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpCsFixer\Console\Output\NullOutput;
use PhpCsFixer\Console\Output\ProcessOutput;
use PhpCsFixer\Finder;
use Symfony\Component\Console\Terminal;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Fixer
{
    /**
     * 
     * @var array
     */
    protected $cliInput;

    /**
     * 
     * @var ConfigurationResolver
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
        $this->setEventDispatcher();
        $this->setFinder();
        $this->setProgressOutput();
    }

    public function setEventDispatcher(?EventDispatcher $eventDispatcher = null)
    {
        $this->eventDispatcher = $eventDispatcher ?? new EventDispatcher();
    }

    public function setResolver(array $options, ?ConfigInterface $config = null, ?string $cwd = null, ?ToolInfoInterface $toolInfo = null)
    {
        $config = $config ?: new Config(config('fixer.config_name', 'Laravel'));
        $cwd = $cwd ?: getcwd();
        $toolInfo = $toolInfo ?: new ToolInfo();
        $this->configResolver = new ConfigurationResolver($config, $options, $cwd, $toolInfo);
    }

    public function setFinder()
    {
        $this->finder = Finder::create()
            ->in(config('fixer.find_directories'))
            ->name(config('fixer.file_name_pattern_whitelist'))
            ->notName(config('fixer.file_name_pattern_blacklist'))
            ->ignoreDotFiles(config('fixer.ignore_dot_files'))
            ->ignoreVCS(config('fixer.ignore_vcs'));
    }

    public function getLoadedConfigMessage()
    {
        return sprintf(
            'Loaded config <comment>%s</comment> from %s.',
            $this->configResolver->getConfig()->getName(),
            $this->configResolver->getConfigFile() ?? 'Laravel Fixer Configuration.'
        );
    }

    public function getPhpRuntimeMessage()
    {
        $configFile = $this->configResolver->getConfig()->getPhpExecutable();
        return sprintf('Runtime: <info>PHP %s</info>', PHP_VERSION);
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
            $this->progressOutput = new ProcessOutput(
                $this->output,
                $this->eventDispatcher,
                (new Terminal())->getWidth(),
                $this->finder->count()
            );
        }
    }
}
