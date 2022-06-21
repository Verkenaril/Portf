<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
} ?>


<form method="POST" action="/bitrix/admin/my.import_list.php?lang=ru">
    <div>
        <input type="checkbox" name="do-file-rtf" for="file-rtf">
        <label id="file-txt">Формат .rtf</label>
        <br>
        <input type="checkbox" name="do-file-doc" for="file-doc">
        <label id="file-doc">Формат .doc</label>
        <br>
        <input type="checkbox" name="do-file-txt" for="file-txt">
        <label id="file-txt">Формат .txt</label>
        <br>
        <br>
        <label id="file-name">Имя файла</label>
        <input type="text" name="do-file-name" for="file-name" value="<?= $arResult['NAME_FILE'] ?> ">
        
        <label id="file-path">Путь сохранения в папку: local/</label>
        <input type="text" name="do-file-path" for="file-path" value="<?= $arResult['PATH_FILE'] ?> ">
        
        <br>
        <br>
        <label id="limit">Лимит импорта</label>
        <input type="number" value="<?= $arResult['LIMIT'] ?>" for="limit" name="limit">
        <br>   
        <textarea name="tovap" hidden>
        <?php 
        foreach($arResult["ITEMS"] as $key => $value):
        echo $value["ID"] . ", " . $value["NAME"] . ", " . $value["DATE_CREATE"] . "; ";
        endforeach;
        ?>
        </textarea>
        <input type="submit" name="start" value="Start!">
    </div>
</form>