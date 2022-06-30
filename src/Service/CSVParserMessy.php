<?php
namespace App\Service;
class CSVParserMessy
{
  /*
   Details of config array
    [
    'has_header' => true | false, => if the csv file contains the header
    'use_custom_header' => true | false,
    'custom_header' => [
        'header_title1',
        'header_title2',
        ...
        'header_titleN'
      ]
    ]
  */
  public function parseFile(string $file, array $config = [])
  {
    if (!is_file($file))  return false;
    $csvData = array_map('str_getcsv', file($file));
    $header = [];
    if ($config['use_custom_header'] || !$config['has_header']){
      $customHeader = $config['custom_header'];
      if (empty($customHeader)){
        throw new HeaderNotFoundException("Header must be passed to config array");
      }
      if(count($customHeader)  != count($csvData[0])){
        throw new HeaderLengthMustMatchArgumentLengthException("Expected " . count($customHeader) . ", but only " . count($csvData[0]) . " supplied!");
      }
      $header = $customHeader;
      if ($config['has_header'])  array_shift($csvData);
    }else{
      foreach($csvData[0] as $value)
      {
        $header[] = preg_replace("/\s+/", "", $value);
      }
    }
    array_walk($csvData, function(&$row) use ($header){
      $row = array_combine($header, $row);
    });

    return $csvData;
  }
  public function test()
  {
    dd ("Testing the CSVParser Service!");
  }
}