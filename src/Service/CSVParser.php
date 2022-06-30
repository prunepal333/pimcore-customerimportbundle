<?php
namespace App\Service;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class CSVParser
{
  /*
  Convention:
  if $headers is empty, it infers the csv data has header automatically passed,
  */
  public function parseFile(string $file, bool $hasHeader = true, array $headers = [])
  {
    if (!is_file($file)){
      throw new \Exception("CSV File " . $file . " Not Found");
    }
    $csvData = array_map('str_getcsv', file($file));
    $headerArray = [];
    if (!empty($headers)){
      if(count($headers)  != count($csvData[0])){
        throw new HeaderLengthMustMatchArgumentLengthException("Argument Mismatch In Header: Expected " . count($headers) . ", but only " . count($csvData[0]) . " supplied!");
      }
      $headerArray = $headers;
    }else{
      if (!$hasHeader){
        throw new HeaderNotFoundException("Header must be passed to csv data");
      }
      foreach($csvData[0] as $value)
      {
        $headerArray[] = preg_replace("/\s+/", "", $value);
      }
    }
    //remove the first element i.e. header if header is present in the csv data
    if ($hasHeader) array_shift($csvData);

    array_walk($csvData, function(&$row) use ($headerArray){
      $row = array_combine($headerArray, $row);
    });
    return $csvData;
  }
}
