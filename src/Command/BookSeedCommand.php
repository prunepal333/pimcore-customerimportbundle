<?php

namespace App\Command;

use App\Service\BookSeeder;
use App\Service\CSVParser;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BookSeedCommand extends CSVSeederAbstractCommand
{
    public function __construct(CSVParser $parser, BookSeeder $seeder)
    {
        parent::__construct($parser, $seeder);
    }
    protected function configure()
    {
        $this
            ->setName('csv:import:book')
            ->setDescription('Import book object using CSV');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filepath = $_ENV['ASSET_DIR'] . '/example.csv';
        
        $books = $this->parser->parseFile($filepath, true, array (
            'isbn', 'title', 'author', 'pages'
        ));

        $this->seeder->seed($books);
        return 0;
    }
}