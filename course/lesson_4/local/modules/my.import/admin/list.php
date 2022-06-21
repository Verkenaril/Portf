<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin.php';

if(isset($_POST["do-file-rtf"]))
{
    echo $_POST["do-file-name"] . ".rtf создан. <br>";
}
if(isset($_POST["do-file-txt"]))
{
    echo $_POST["do-file-name"] . ".doc создан. <br>";
}
if(isset($_POST["do-file-doc"]))
{
    echo $_POST["do-file-name"] . ".txt создан. <br>";
}
?>