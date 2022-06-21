<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin.php';

/** @var CMain $APPLICATION */

$APPLICATION->IncludeComponent(
    'mein:my.import',
    '',
    []
);