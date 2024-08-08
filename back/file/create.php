<?php
header("Content-Type: json/application");

require("../connection.php");
require("../mp3file.php");

function create($connection)
{
    $mp3file;
    $duration;
    foreach($_FILES as $key => $value)
    {
        move_uploaded_file($_FILES[$key]["tmp_name"], "D:\\Proga\\OpenServer\\domains\\playerj\\files\\" . $_FILES[$key]["name"]);
        $mp3file = new MP3File("../../files/" . $_FILES[$key]["name"]);
        $duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
        $justvar1 = MP3File::formatTime($duration2);
        $justavar3 = explode(":", $justvar1);
        $duration = "$justavar3[1]:$justavar3[2]";

        $justvar2 = explode(".mp3", $_FILES[$key]["name"]);
        $nameTrack = $justvar2[0];
        
        $routeTrack = "files/" . $_FILES[$key]["name"];


        $sql = "INSERT files(name, file, duration) VALUES('$nameTrack', '$routeTrack', '$duration')";
        $query = $connection->prepare($sql);
        $query->execute();
    }
    echo json_encode("ok");
}
create($connection);