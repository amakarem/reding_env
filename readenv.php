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
            if(sizeof($line) > 2) {
                $max = sizeof($line) - 1;
                $x = 1;
                while ($x < $max) {
                    $x++;
                    $line[1] = $line[1] .'='. $line[$x];
                }
            }
            $env[$line[0]] = trim($line[1]);
        }
    }
}

$DBHost = $env['DB_HOST'];
$DBName = $env['DB_DATABASE'];
$DBLogin = $env['DB_USERNAME'];
$DBPassword = $env['DB_PASSWORD'];

global $DB;
$DB = new mysqli($DBHost, $DBLogin, $DBPassword, $DBName);
// Check connection
if ($DB->connect_error) {
    die("Connection failed: " . $DB->connect_error);
}
