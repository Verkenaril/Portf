<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use My\Import\Import;
use Bitrix\Main\Loader;


/**
 * Class YlabImport
 */
class MyImportComponent extends CBitrixComponent
{
    /**
     * @return mixed|void
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function executeComponent()
    {
        Loader::includeModule('my.import');
        $profile = new Import();

        $this->arResult['LIMIT'] = $profile->getLimitImport(); 
        $this->arResult['PATH_FILE'] = $profile->getPathDefault();
        $this->arResult['NAME_FILE'] = $profile->getNameDefault();
        
        $arSelect = Array("ID", "NAME", "DATE_CREATE");
        $arFilter = Array("IBLOCK_ID"=>2);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

        while($ob = $res->GetNextElement())
        { 
            $arFields[] = $ob->GetFields(); 
            $this->arResult["ITEMS"]= $arFields;
        }

        $this->includeComponentTemplate();
    }
}