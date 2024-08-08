<?php

$connection;
$options = 
[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];
try
{
    $connection = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "", $options);
}
catch(PDOException $e)
{
    die($e);
}

