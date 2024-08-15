<?php
session_start();
header("Content-Type: application/json");

require("../connection.php");
require("../mp3file.php");


function create($connection)
{
    $nameTrack = $_GET["q"];
    $user_uid = $_SESSION["user_uid"];
    
    $file = "../../files/$nameTrack.mp3";

    $mp3file = new MP3File($file);
    $duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
    $justvar1 = MP3File::formatTime($duration2);
    $justavar3 = explode(":", $justvar1);
    $duration = "$justavar3[1]:$justavar3[2]";

    $sql = "INSERT favorite(name, user, file, duration) VALUES('$nameTrack', '$user_uid', '$file', '$duration')";
    $query = $connection->prepare($sql);
    $query->execute();

    echo json_encode("ok");
}
create($connection);

