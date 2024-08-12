<?php

$connection;
$options = 
[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];
try
{
    $connection = new PDO("mysql:host=http://83.222.11.85:7771;dbname=audiojs;charset=utf8", "nigga", "mypassnigga", $options);
}
catch(PDOException $e)
{
    die($e);
}

