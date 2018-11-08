<?php

use App\Values\GeoNameDataValue;

require __DIR__ . '/vendor/autoload.php';



$fileName = $argv[1];

if (!file_exists($fileName)) {
    printLnDie('file ' . $fileName . ' not exists');
}

$handle = fopen($fileName, "r");
$maxCount = 90000000;
if (!$handle) {
    printLnDie("can't open file to read: " . $fileName);
}

$count = 0;
while (($line = fgets($handle)) !== false) {
    $count++;

    $geoNameValue = new GeoNameDataValue(explode("\t", $line));
//    if('Zelenodolsk' === $geoNameValue->getName()
//        && 'P' === $geoNameValue->getFeatureClass()
////        && 'RU' === $geoNameValue->getCountryCode()
//    ) {
//        var_dump($geoNameValue);
//    }

    if('China' === $geoNameValue->getName()
        && 'A' === $geoNameValue->getFeatureClass()
//        && 'GB' === $geoNameValue->getCountryCode()
    ) {
        var_dump($geoNameValue);
    }


//    if ('RU' === $resultArray[8]
//        && 'Germany' === $resultArray[1]
//        && 'A' === $resultArray[6]
//    ) {
//        var_dump($resultArray);die();
//    }
}

fclose($handle);

printLn(' count: ' . $count);


function printLn($sting) {
    echo $sting . PHP_EOL;
}

function printLnDie($string) {
    echo $string . PHP_EOL;
    die();
}