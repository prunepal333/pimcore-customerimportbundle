<?php
namespace App\Command;

use App\Service\CSVParser;
use Pimcore\Console\AbstractCommand;
use App\Service\SeederInterface;
abstract class CSVSeederAbstractCommand extends AbstractCommand
{
    /**
     * This is very messy way of writing code
     */
    public function __construct(protected ?CSVParser $parser = null, protected ?SeederInterface $seeder = null){
        parent::__construct();
    }
}