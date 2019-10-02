<?php

namespace App\Command;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\Table;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\ReportGenerator;

class ReportGenerateCommand extends Command
{
    protected static $defaultName = 'app:report-generate';

    private $reportGenerator;

    public function __construct(ReportGenerator $reportGenerator)
    {
        $this->reportGenerator = $reportGenerator;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Display report.')
        ;
    }

    /**
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
            ->setRows($report['values'])
        ;
        $table->render();

    }
}
