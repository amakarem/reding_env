<?php
$filename = __DIR__ .'/.env';


function FileToArray($filename)
{
    $output = array();
    if (file_exists($filename)) {
        $file = fopen($filename, 'r');
        while (!feof($file)) {
            $output[] = fgets($file);
        }
        fclose($file);
    } else {
        $output = false;
    }
    return $output;
}
$envfile = FileToArray($filename);
$env = [];
foreach ($envfile as $line) {
    if(strpos($line, '=') !== false) {
        $line = explode('=',$line);
        if(isset($line[1])) {
            $env[$line[0]] = $line[1];
        }
    }
}


