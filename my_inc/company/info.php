<?php
if($user['company_id'] == 0){
$company_gold = 15;
$company_silver = 500;
$company_exp = 50;
}elseif($user['company_id'] == 1){
$company_gold = 30;
$company_silver = 2500;
$company_exp = 250;
}elseif($user['company_id'] == 2){
$company_gold = 70;
$company_silver = 5000;
$company_exp = 350;
}elseif($user['company_id'] == 3){
$company_gold = 150;
$company_silver = 12500;
$company_exp = 500;
}elseif($user['company_id'] == 4){
$company_gold = 200;
$company_silver = 25000;
$company_exp = 1000;
}elseif($user['company_id'] == 5){
$company_gold = 300;
$company_silver = 50000;
$company_exp = 2000;
}elseif($user['company_id'] == 6){
$company_gold = 400;
$company_silver = 75000;
$company_exp = 3000;
}elseif($user['company_id'] == 7){
$company_gold = 500;
$company_silver = 100000;
$company_exp = 4000;
}elseif($user['company_id'] == 8){
$company_gold = 600;
$company_silver = 225000;
$company_exp = 5000;
}elseif($user['company_id'] == 9){
$company_gold = 800;
$company_silver = 500000;
$company_exp = 10000;
}
?>