<?php

$connection;
$servername = "217.199.253.101";
$options = 
[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];
try
{
    $connection = new PDO("mysql:host=$servername;port=7771;dbname=audiojs;charset=utf8", "niggass", "mypassnigga", $options);
}
catch(PDOException $e)
{
    die($e);
}

