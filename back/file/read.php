<?php
session_start();
header("Content-Type: json/application");
// error_reporting(E_ALL);
// ini_set('display_errors', 'On'); 



require("../connection.php");


function read($connection)
{
    $req = $_GET["q"];
    $user_uid = $_SESSION["user_uid"];
    $sql = "SELECT * FROM files WHERE NOT name IN (SELECT name FROM favorite WHERE user = '$user_uid') AND name LIKE '%$req%';";
    $query = $connection->prepare($sql);
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
 
echo json_encode(read($connection));

