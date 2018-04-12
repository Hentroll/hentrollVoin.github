<?php
include 'my_inc/shop/zat/info_item.php';
if(isset($_GET['item_1'])){
if($user['zat_1'] >= 15){
header('Location: ?zat#'.$r.'');
exit();
}
if($user['gold'] < $gold_1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zat');
exit();
}
mysql_query("UPDATE `users` SET `zat_1` = '".($user['zat_1'] + 1)."', `zat_1_param` = '".($user['zat_1_param'] + 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."', `gold` = '".($user['gold'] - $gold_1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вещь успешно заточена!<br>+ 5 к параметрам!</font></div>';
header('Location: /shop.php?zat#'.$r.'');
exit();
}
if(isset($_GET['item_2'])){
if($user['zat_2'] >= 15){
header('Location: ?zat#'.$r.'');
exit();
}
if($user['gold'] < $gold_2){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zat');
exit();
}
mysql_query("UPDATE `users` SET `zat_2` = '".($user['zat_2'] + 1)."', `zat_2_param` = '".($user['zat_2_param'] + 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."', `gold` = '".($user['gold'] - $gold_2)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вещь успешно заточена!<br>+ 5 к параметрам!</font></div>';
header('Location: /shop.php?zat#'.$r.'');
exit();
}
if(isset($_GET['item_3'])){
if($user['zat_3'] >= 15){
header('Location: ?zat#'.$r.'');
exit();
}
if($user['gold'] < $gold_3){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zat');
exit();
}
mysql_query("UPDATE `users` SET `zat_3` = '".($user['zat_3'] + 1)."', `zat_3_param` = '".($user['zat_3_param'] + 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."', `gold` = '".($user['gold'] - $gold_3)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вещь успешно заточена!<br>+ 5 к параметрам!</font></div>';
header('Location: /shop.php?zat#'.$r.'');
exit();
}
if(isset($_GET['item_4'])){
if($user['zat_4'] >= 15){
header('Location: ?zat#'.$r.'');
exit();
}
if($user['gold'] < $gold_4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zat');
exit();
}
mysql_query("UPDATE `users` SET `zat_4` = '".($user['zat_4'] + 1)."', `zat_4_param` = '".($user['zat_4_param'] + 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."', `gold` = '".($user['gold'] - $gold_4)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вещь успешно заточена!<br>+ 5 к параметрам!</font></div>';
header('Location: /shop.php?zat#'.$r.'');
exit();
}
if(isset($_GET['item_5'])){
if($user['zat_5'] >= 15){
header('Location: ?zat#'.$r.'');
exit();
}
if($user['gold'] < $gold_5){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zat');
exit();
}
mysql_query("UPDATE `users` SET `zat_5` = '".($user['zat_5'] + 1)."', `zat_5_param` = '".($user['zat_5_param'] + 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."', `gold` = '".($user['gold'] - $gold_5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вещь успешно заточена!<br>+ 5 к параметрам!</font></div>';
header('Location: /shop.php?zat#'.$r.'');
exit();
}
if(isset($_GET['item_6'])){
if($user['zat_6'] >= 15){
header('Location: ?zat#'.$r.'');
exit();
}
if($user['gold'] < $gold_6){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zat');
exit();
}
mysql_query("UPDATE `users` SET `zat_6` = '".($user['zat_6'] + 1)."', `zat_6_param` = '".($user['zat_6_param'] + 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."', `gold` = '".($user['gold'] - $gold_6)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вещь успешно заточена!<br>+ 5 к параметрам!</font></div>';
header('Location: /shop.php?zat#'.$r.'');
exit();
}
?>