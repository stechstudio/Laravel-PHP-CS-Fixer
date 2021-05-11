<?php
/*
 * This file was originally part of PHP CS Fixer (https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v2.14.6/src/Console/Command/FixCommand.php) 
 * 
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * 
 * It is replicated and modified here due to them having made it a `final` class.
 */


namespace STS\Fixer\Console;

use Illuminate\Console\Command;

use PhpCsFixer\ConfigurationException\InvalidConfigurationException;
use PhpCsFixer\Console\Command\FixCommand as CommandFixCommand;
use PhpCsFixer\ToolInfo;
use STS\Fixer\Services\Fixer;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FixCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'fixer:fix';

    /**
     * 
     * @var string
     */
    protected $longVersion;

    public function __construct()
    {
        parent::__construct();
        $fixerCommand = new CommandFixCommand(new ToolInfo());
        $this->setDefinition($fixerCommand->getDefinition());
        $this->setHelp($fixerCommand->getHelp());
        $this->setDescription($fixerCommand->getDescription());
        $this->fixerApplication = new \PhpCsFixer\Console\Application();
        $this->longVersion = $this->fixerApplication->getLongVersion();



        // 'v' => OutputInterface::VERBOSITY_VERBOSE,
        // 'vv' => OutputInterface::VERBOSITY_VERY_VERBOSE,
        // 'vvv' => OutputInterface::VERBOSITY_DEBUG,
        // 'quiet' => OutputInterface::VERBOSITY_QUIET,
        // 'normal' => OutputInterface::VERBOSITY_NORMAL,
        //$this->setVerbosity();
    }

    public function handle()
    {
        $this->setVerbosity($this->output->getVerbosity());

        if (null !== $this->option('config') && null !== $this->option('rules')) {
            throw new InvalidConfigurationException('Passing both `--config` and `--rules` options is not allowed.');
        }

        $cli_input =  [
            'allow-risky' => $this->option('allow-risky'),
            'config' => $this->option('config'),
            'dry-run' => $this->option('dry-run'),
            'rules' => $this->option('rules'),
            'path' => $this->argument('path'),
            'path-mode' => $this->option('path-mode'),
            'using-cache' => $this->option('using-cache'),
            'cache-file' => $this->option('cache-file'),
            'format' => $this->option('format'),
            'diff' => $this->option('diff'),
            'stop-on-violation' => $this->option('stop-on-violation'),
            'verbosity' => $this->verbosity,
            'show-progress' => $this->option('show-progress'),
        ];

        $fixerService = new Fixer($this->input, $this->output, $cli_input);

        if (OutputInterface::VERBOSITY_VERBOSE <= $this->verbosity) {
            $this->info($this->longVersion);
            $this->writeln($fixerService->getPhpRuntimeMessage());
        }

        $this->writeln($fixerService->getLoadedConfigMessage());



        $this->info('Completed');
    }

    public function writeln($messages, int $type = SymfonyStyle::OUTPUT_NORMAL)
    {
        $this->output->writeln($messages, $type);
    }
}
