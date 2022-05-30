<?php

namespace STS\Fixer\Services\Fixer\Concerns;

use PhpCsFixer\Config;
use PhpCsFixer\ToolInfo;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\ToolInfoInterface;
use PhpCsFixer\Console\ConfigurationResolver;

trait HasConfigurationResolver
{
    /**
     *
     * @var ConfigurationResolver
     */
    protected $configResolver;

    public function setResolver(array $options, ?ConfigInterface $config = null, ?string $cwd = null, ?ToolInfoInterface $toolInfo = null)
    {
        $config = $config ?: new Config(config('fixer.config_name', 'Laravel'));
        $config->setRules($options['rules'] ?: config('fixer.rules'));
        $cwd = $cwd ?: getcwd();
        $toolInfo = $toolInfo ?: new ToolInfo();
        $this->configResolver = new ConfigurationResolver($config, $options, $cwd, $toolInfo);
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

    public function isUsingCache()
    {
        return $this->configResolver->getUsingCache();
    }

    public function cacheFileExists()
    {
        return is_file($this->configResolver->getCacheFile());
    }

    public function getCacheFileMessage()
    {
        return sprintf('Using cache file "%s".', $this->configResolver->getCacheFile());
    }
}
