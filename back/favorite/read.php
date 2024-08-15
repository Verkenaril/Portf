<?php
session_start();
header("Content-Type: application/json");


require("../connection.php");


function read($connection)
{
    $user_uid = $_SESSION["user_uid"];
    $sql = "SELECT * FROM favorite WHERE user = '$user_uid'";

    $query = $connection->prepare($sql);
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
 
echo json_encode(read($connection));