<?php 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

?>



<div class="news-list">
<b>Ваши покупки:</b>
<?php 
    foreach( $arResult['BASKET_ITEMS'] as $basketItem)
    {
?>
    <p><?php echo $basketItem->getField("NAME") . "<br> по цене: " . $basketItem->getField("PRICE") . "<br> количество: " .  $basketItem->getField("QUANTITY");?></p>
<?php
    }

    if($arResult["PROMO"] >= 3 ):
?>
    <h4>У вас подарок! (обновить страницу)</h4>
<?php
    else:
?>
    <h4>Ещё один товар по цене свыше 500 рублей и будет подарок.</h4>
<?php
    endif;
?> 
    <form method="post" action="">
        <input type="number" name="quantityPresent">
        <button type="submit" name="getMorePresent" id="more" class="mybtn">Хочу ещё</button>
        
    </form>

</div>
<?php

$quantityP = $_POST["quantityPresent"];

Bitrix\Catalog\Product\Basket::addProduct(array( "PRODUCT_ID" => 328,  "QUANTITY" => $quantityP, ));
    

?>