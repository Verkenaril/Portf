<?php 
    $connect = mysqli_connect("localhost", "root", "", "my_db");

    mysqli_query($connect, "ALTER TABLE lesson_1_4 AUTO_INCREMENT=0");

    $firstname = htmlspecialchars($_POST["firstname"]);
    $familyname = htmlspecialchars($_POST["familyname"]);

    
    $query = mysqli_query($connect, "INSERT INTO lesson_1_4 (name, familyname) VALUES ('$firstname', '$familyname')");
    
    

    echo "<b>Запись добавлена</b>";
    echo "<br>Привет " . $familyname . "&nbsp" . $firstname ;
?>
 
