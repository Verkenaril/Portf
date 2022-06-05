<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Моя страница");
?><?$APPLICATION->IncludeComponent(
	"bitrix:meinecomp",
	""
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>