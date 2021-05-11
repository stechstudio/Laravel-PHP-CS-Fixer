<?php

namespace STS\Fixer\Services\Fixer\Concerns;

use PhpCsFixer\Console\Report\FixReport\ReportSummary;
use Symfony\Component\Console\Output\OutputInterface;

trait HasFixEvent
{

    use HasConfigurationResolver;
    use HasStopWatch;
    use HasRunner;
    use HasErrorsManager;

    public function report(int $verbosity, OutputInterface $output)
    {
        $reportSummary = new ReportSummary(
            $this->filesModified,
            $this->getStopWatch()->getEvent('fixFiles')->getDuration(),
            $this->getStopWatch()->getEvent('fixFiles')->getMemory(),
            OutputInterface::VERBOSITY_VERBOSE <= $verbosity,
            $this->configResolver->isDryRun(),
            $output->isDecorated()
        );


        $output->isDecorated()
            ? $output->write($this->configResolver->getReporter()->generate($reportSummary))
            : $output->write($this->configResolver->getReporter()->generate($reportSummary), false, OutputInterface::OUTPUT_RAW);;

        if (\count($this->getErrorsManager()->getInvalidErrors()) > 0) {
            $this->getErrorOutput($output)->listErrors('linting before fixing', $this->getErrorsManager()->getInvalidErrors());
        }

        if (\count($this->getErrorsManager()->getExceptionErrors()) > 0) {
            $this->getErrorOutput($output)->listErrors('fixing', $this->getErrorsManager()->getExceptionErrors());
        }

        if (\count($this->getErrorsManager()->getLintErrors()) > 0) {
            $this->getErrorOutput($output)->listErrors('linting after fixing', $this->getErrorsManager()->getLintErrors());
        }
    }
}
