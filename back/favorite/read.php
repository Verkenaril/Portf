<?php
session_start();
header("Content-Type: json/application");

require("../connection.php");


function read($connection)
{
    $req = $_GET["q"];
    $user_uid = $_SESSION["user_uid"];
    $sql = "SELECT * FROM favorite";

    $query = $connection->prepare($sql);
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
 
echo json_encode(read($connection));