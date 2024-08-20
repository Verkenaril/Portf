<?php

$connection;
$servername = "127.0.0.1";
// $servername = "83.222.11.85";
$options = 
[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];
try
{
    $connection = new PDO("mysql:host=$servername;dbname=test;charset=utf8", "root", "", $options);
    // $connection = new PDO("mysql:host=$servername;port=7771;dbname=audiojs;charset=utf8", "niggass", "mypassnigga", $options);
}
catch(PDOException $e)
{
    die($e);
}

