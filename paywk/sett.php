<?
define('wk_id', '650'); //id площадки
define('wk_code', '9HuZuttk2Y67UyzR'); //секретный код

//цена на золото количество=>цена
$wk_cena_gold=array('100'=>'10.00', '500'=>'50.00', '1000'=>'100.00', '5000'=>'500.00', '10000'=>'1000.00');

function wk_summ($summ)
{
return number_format(floatval($summ), 2, '.', '');
}
?>