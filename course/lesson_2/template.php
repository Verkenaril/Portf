<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<div class="news-list">
<?php 
    foreach($arResult['ITEMS'] as $arItem) 
    { 
?>   
    <b><?php echo $arItem['NAME'] ?></b>
    <p class="news-item" id="">
        <?php echo $arItem['PROPERTIES']['FULLNAME']['NAME'] ?> : <?php echo $arItem['PROPERTIES']['FULLNAME']['VALUE'] . "<br>"; ?>
        <?php echo $arItem['PROPERTIES']['PHONE']['NAME'] ?> : <?php echo $arItem['PROPERTIES']['PHONE']['VALUE']; ?>
        <br>
        <?php echo $arItem['PROPERTIES']['ADRESSES']['NAME'] . " : " . "г. " . $arItem['PROPERTY_ADRESSES_PROPERTY_CITY_VALUE'].", улица " . $arItem['PROPERTY_ADRESSES_PROPERTY_STREET_VALUE']. ", дом " . $arItem['PROPERTY_ADRESSES_PROPERTY_NUMHOUSE_VALUE']. ", кв " . $arItem['PROPERTY_ADRESSES_PROPERTY_FLAT_VALUE']?>
    
    </p>
    
<?php
    }
?>
    
   
    
<?php  
//    echo "<pre>";
//    print_r($arResult);
//    echo "</pre>";
?>      

</div>

