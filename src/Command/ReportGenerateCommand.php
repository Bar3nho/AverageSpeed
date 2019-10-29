<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use App\Service\ReportGenerator;

class ReportGenerateCommand extends Command
{
    protected static $defaultName = 'app:report-generate';

    /**
     * @var ReportGenerator
     */
    private $reportGenerator;

    /**
     * ReportGenerateCommand constructor.
     * @param ReportGenerator $reportGenerator
     */
    public function __construct(ReportGenerator $reportGenerator)
    {
        $this->reportGenerator = $reportGenerator;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Display report.');
    }

    /**
     * Displays the table console component with trips report
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $report = $this->reportGenerator->generateReport();
        $table
            ->setHeaders($report['headers'])
            ->setRows($report['values']);
        $table->render();

    }
}
