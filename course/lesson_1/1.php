<?php 

$array = 
[
 'SKLAD1' => 
    [
       'EDA' => 
        [
            'TOVAR1' =>
            [ 'NAME' => 'b', 'PRICE' => 14 ],
            'TOVAR2' =>
            [ 'NAME' => 'a', 'PRICE' => 134 ],
            'TOVAR3' =>
            [ 'NAME' => 'c', 'PRICE' => 23 ],
        ],
       'NAPITKI' => 
        [
            'TOVAR54' => 
            [ 'NAME' => 'a', 'PRICE' => 284 ],
            'TOVAR55' => 
            [ 'NAME' => 'b', 'PRICE' => 18 ],
            'TOVAR56' => 
            [ 'NAME' => 'd', 'PRICE' => 12 ],
        ],
    ],
'SKLAD2' => 
    [
        'EDA' => 
        [
            'TOVAR66' => 
            [ 'NAME' => 'b', 'PRICE' => 67 ],
            'TOVAR67' => 
            ['NAME' => 'a', 'PRICE' => 0],
            'TOVAR68' => 
            ['NAME' => 'd', 'PRICE' => 12],
            'TOVAR69' => 
            ['NAME' => 'c', 'PRICE' => 22],
        ],
        'NAPITKI' => 
        [
            'TOVAR77' => 
            [ 'NAME' => 'a', 'PRICE' => 336 ],
            'TOVAR78' => 
            [ 'NAME' => 'c', 'PRICE' => 7892 ],
            'TOVAR79' => 
            [ 'NAME' => 'b', 'PRICE' => 1 ]
        ]
    ],
'SKLAD3' => 
    [
        'EDA' => 
        [
            'TOVAR66' => 
            [ 'NAME' => 'b', 'PRICE' => 167 ],
            'TOVAR67' => 
            ['NAME' => 'a', 'PRICE' => 2],
            'TOVAR68' => 
            ['NAME' => 'd', 'PRICE' => 1222],
            'TOVAR69' => 
            ['NAME' => 'c', 'PRICE' => 22],
        ],
        'NAPITKI' => 
        [
            'TOVAR77' => 
            [ 'NAME' => 'a', 'PRICE' => 33 ],
            'TOVAR78' => 
            [ 'NAME' => 'b', 'PRICE' => 884 ],
            'TOVAR79' => 
            [ 'NAME' => 'c', 'PRICE' => 14]
        ]
    ],
'SKLAD23' => 
    [
        'EDA' => 
        [
            'TOVAR54' => 
            [ 'NAME' => 'b', 'PRICE' => 712 ],
            'TOVAR67' => 
            ['NAME' => 'a', 'PRICE' => 12],
            'TOVAR68' => 
            ['NAME' => 'd', 'PRICE' => 23]
        ]
    ],
'SKLAD100' => 
    [
        'EDA' => 
        [
            'TOVAR66' => 
            [ 'NAME' => 'b', 'PRICE' => 8711 ],
            'TOVAR67' => 
            ['NAME' => 'a', 'PRICE' => 1],
            'TOVAR68' => 
            ['NAME' => 'd', 'PRICE' => 145],
            'TOVAR69' => 
            ['NAME' => 'c', 'PRICE' => 22],
        ],
        'NAPITKI' => 
        [
            'TOVAR77' => 
            [ 'NAME' => 'a', 'PRICE' => 5558 ],
            'TOVAR78' => 
            [ 'NAME' => 'b', 'PRICE' => 666 ],
            'TOVAR79' => 
            [ 'NAME' => 'c', 'PRICE' => 85],
            'TOVAR80' => 
            [ 'NAME' => 'c', 'PRICE' => 599],
        ]
    ],  
];

function naskalde($arr)
{
    return array_map("sortFunc", $arr);
}
function sortFunc($eatDrink)
{
    $two = array_map("reverseFirst", $eatDrink);
    asort($two);
    return array_map("backReverse", $two);
}
function reverseFirst($tovap)
{
    return array_reverse($tovap);
}
function backReverse($tovap)
{
    return array_reverse($tovap);
}

?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
<meta charset="utf-8">
<title></title>
<style>
    pre
    {
        display: inline-block;
        margin-left: 150px;
    }
</style>
</head>
<body>
<?php 
    echo "<pre>"  . "<h3>До</h3><br>";
    print_r($array);
    echo "</pre>";  
    
    
    echo "<pre>" . "<h3>После</h3><br>";
    print_r(array_map("naskalde", $array));
    echo "</pre>";

?>   

    
    
</body>
</html>