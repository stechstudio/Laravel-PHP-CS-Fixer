<?php

namespace STS\Fixer\Services\Fixer\Concerns;

use PhpCsFixer\Finder;

trait HasFinder
{

    /**
     * 
     * @var Finder
     */
    private $finder;

    public function setFinder()
    {
        $this->finder = Finder::create()
            ->in(config('fixer.find_directories'))
            ->name(config('fixer.file_name_pattern_whitelist'))
            ->notName(config('fixer.file_name_pattern_blacklist'))
            ->ignoreDotFiles(config('fixer.ignore_dot_files'))
            ->ignoreVCS(config('fixer.ignore_vcs'));
    }

    public function getFinder()
    {
        if ($this->finder === null) {
            $this->setFinder();
        }

        return $this->finder;
    }
}
