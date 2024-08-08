<?php
header("Content-Type: json/application");
// error_reporting(E_ALL);
// ini_set('display_errors', 'On'); 


require("../connection.php");


function read($connection)
{
    $req = $_GET["q"];
    $random_numbers = [];
    for($i = 0; $i < 10; $i++)
    {
        $random_numbers[] = rand(1, 20);
    }
    $random_numbers = array_unique($random_numbers);
    $random_numbres_string = implode(", ", $random_numbers);

    $sql = "SELECT * FROM files WHERE id IN ($random_numbres_string)";
    $query = $connection->prepare($sql);
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
 
echo json_encode(read($connection));

