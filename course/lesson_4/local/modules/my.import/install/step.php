<?if(!check_bitrix_sessid()) return;
include("step1.php");
include("step2.php");
include("step3.php");
?>
<?
echo CAdminMessage::ShowNote(GetMessage("MOD_INST_OK"));
?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>">
	<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">
    
</form>