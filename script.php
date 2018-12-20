<?php
require('excel_reader2.php');
require('SpreadsheetReader.php');

$debugging=false;

if (checkArgs($argv,$argc)){
  $fileName = $argv[1];
  $optionsFile = argumentVal("-o",$argv,$argc);
  $sheet = argumentVal("-s",$argv,$argc);
  $cols= colParser(strtoupper($argv[2]));
	$Reader = new SpreadsheetReader($fileName);
  $Sheets = $Reader -> Sheets();
  if(isset($sheet)){
    $Reader -> ChangeSheet($sheet);
  }
  if(isset($optionsFile)){
    $finalString = file_get_contents($optionsFile);
    $finalString.=PHP_EOL;
  }else{
  $finalString=NULL;
  }

	foreach ($Reader as $Row)
		{
      for ($i=0; $i < count($cols) ; $i++) {
        //print_r($Row);
        $index= ord($cols[$i])-ord('A');
        $finalString.=$Row[$index].' ';
        //echo $finalString."--------".$index.PHP_EOL;
      }
      $finalString.=PHP_EOL;
		}
    echo $finalString;
}

//debugging
if($debugging){
 echo "args:";
  for ($i=0; $i < $argc; $i++) {
    echo ' '.$argv[$i];
  }
echo PHP_EOL;
  for ($i=0; $i < count($cols); $i++) {
    echo $cols[$i].' ';
  }
}

function checkArgs($argv,$argc){
  if($argc<3){
    usage($argv);
    return false;
  }
  for ($i=0; $i < $argc; $i++) {
    if($argv[$i]=='--help'||$argv[$i]=='-h'){
      usage($argv);
      return false;
    }
  }
  return true;
}
function argumentVal ($arg,$argv,$argc){
  for ($i=0; $i < $argc; $i++) {
    if($argv[$i]==$arg&&$argc>$i+1){
      return $argv[$i+1];
    }
}
}
function colParser ($str){
  $str[strlen($str)]=';';
  $cols=array();
  $j=0;
  $start=0;
  $end;
  for ($i=0; $i < strlen($str) ; $i++) {
    if(!($str[$i]>='A'&&$str[$i]<='Z')){
      $end=$i;
      $cols[$j]=substr($str,$start,($end-$start));
      $start=$end+1;
      $j++;
    }
  }
  return $cols;
}

function usage($argv){
echo "usage: ".PHP_EOL.$argv[0]." [input_file_path] 'columns' -o [options_file_path] -s [sheet_number]".
PHP_EOL.PHP_EOL."'columns':\t defines which columns to select, uses a non alphabetical char as a divider. You must use apexes to it to work."
.PHP_EOL."\t\t Examples: 'A,b,T,d' or 'a B e' and so on.".
PHP_EOL.PHP_EOL."-o:\t allows to use a file to customize the graph. To know more see gnuplot manual".
PHP_EOL.PHP_EOL."-s:\t selects the sheet the table is in. Sheets indexing starts from 0. If not specified will use sheet 0".PHP_EOL;
}

?>
