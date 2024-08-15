<?php
session_start();
header("Content-Type: application/json");

require("../connection.php");


function delete($connection)
{
    $nameTrack = $_GET["q"];
    $user_uid = $_SESSION["user_uid"];
    $sql = "DELETE FROM favorite WHERE name = '$nameTrack' and user = '$user_uid'";

    $query = $connection->prepare($sql);
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
delete($connection);
// echo json_encode(read($connection));