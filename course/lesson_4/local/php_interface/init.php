<?php

AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("MyClass", "createFile"));

class MyClass
{
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    function createFile($arFields)
    {
        mkdir("../../local/log", 0777, true);
        fwrite(fopen("../../local/log/logifle.txt","a"), "Название: ".print_r($arFields["NAME"], true));
    }
}
function go()
{


    $text = trim($_POST["tovap"]);
    $text = explode(";", $text);
    $limit = ($_POST["limit"]);


    $path_to_save = trim("../../local/" . $_POST["do-file-path"]);
    $filename = $path_to_save . "/" . $_POST["do-file-name"];


    function makeDir($path)
    {
        mkdir($path, 0777, true);
    }


    if($_POST["do-file-txt"])
    {
        makeDir($path_to_save);
        for( $i=0; $i < $limit; $i++)
        {
            file_put_contents($filename . '.txt', print_r($text[$i], true) . PHP_EOL, FILE_APPEND);
        }

    }
    if($_POST["do-file-doc"])
    {
        makeDir($path_to_save);
        for( $i=0; $i < $limit; $i++)
        {
            file_put_contents($filename . '.doc', print_r($text[$i], true) . PHP_EOL, FILE_APPEND);
        }

    }
    if($_POST["do-file-rtf"])
    {
        makeDir($path_to_save);
        for( $i=0; $i < $limit; $i++)
        {
            file_put_contents($filename . '.rtf', print_r($text[$i], true) . PHP_EOL, FILE_APPEND);
        }

    }
}
go();
?>