<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();



use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\Fuser;
use CBitrixComponent;
use Bitrix\Sale\Basket;
use Bitrix\Sale;
use Bitrix\Main;




$promo;

class MeineComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        Loader::includeModule("catalog");
        
        $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());
        
        $this->arResult["BASKET_ITEMS"] = $basket;
        
        foreach($this->arResult['BASKET_ITEMS'] as $basketItem)
        {
            if($basketItem->getField("PRICE") > 500)
            {
                $promo++;
            }
        }
        
        
        $this->arResult["PROMO"] = $promo;
        
        
        
        if(count($this->arResult['BASKET_ITEMS']) == 3)
        {
        $product = 
            [
                "PRODUCT_ID" => 328, 
                "QUANTITY" => 1, 
            ];
        $add = Bitrix\Catalog\Product\Basket::addProduct($product); 
 
        }
        
        
        $this->includeComponentTemplate(); 
    }
    
}

