<?php

namespace App\Command;

use App\Service\CustomerSeeder;
use App\Service\CSVParser;
use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerSeedCommand extends CSVSeederAbstractCommand
{
    public function __construct(CSVParser $parser, CustomerSeeder $seeder)
    {
        parent::__construct($parser, $seeder);
    }
    protected function configure()
    {
        $this
            ->setName('csv:import:customer')
            ->setDescription('Import customer object using CSV');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filepath = $_ENV['ASSET_DIR'] . '/customer.csv';
        
        $customers = $this->parser->parseFile($filepath);
        // var_dump($customers);
        // exit;
        $this->seeder->seed($customers);
        return 0;
    }
}