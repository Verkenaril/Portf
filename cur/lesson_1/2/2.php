<?php 
    $firstname = htmlspecialchars($_POST["firstname"]);
    $familyname = htmlspecialchars($_POST["familyname"]);
    echo "Привет " . $familyname . "&nbsp" . $firstname ;
?>
 
