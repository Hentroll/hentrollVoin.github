<?php
auth();
//покупка вещей
if(isset($_GET['item_1'])){
if($user['snar_1'] >= '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['snar_1'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_1');
exit();
}
mysql_query("UPDATE `users` SET `snar_1` = '1', `item_1_text` = 'Шлем разбойника', `item_1_str` = '5', `item_1_def` = '5', `item_1_health` = '5', `gold` = '".($user['gold'] - 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Шлем разбойника успешно приобретен</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if(isset($_GET['item_2'])){
if($user['snar_2'] >= '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['snar_2'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_1');
exit();
}
mysql_query("UPDATE `users` SET `snar_2` = '1', `item_2_text` = 'Наплечник разбойника', `item_2_str` = '5', `item_2_def` = '5', `item_2_health` = '5', `gold` = '".($user['gold'] - 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Наплечник разбойника успешно приобретен</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if(isset($_GET['item_3'])){
if($user['snar_3'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['snar_3'] >= '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_1');
exit();
}
mysql_query("UPDATE `users` SET `snar_3` = '1', `item_3_text` = 'Броня разбойника', `item_3_str` = '5', `item_3_def` = '5', `item_3_health` = '5', `gold` = '".($user['gold'] - 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Броня разбойника успешно приобретена</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if(isset($_GET['item_4'])){
if($user['snar_4'] >= '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['snar_4'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_1');
exit();
}
mysql_query("UPDATE `users` SET `snar_4` = '1', `item_4_text` = 'Оружие разбойника', `item_4_str` = '5', `item_4_def` = '5', `item_4_health` = '5', `gold` = '".($user['gold'] - 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Оружие разбойника успешно приобретено</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if(isset($_GET['item_5'])){
if($user['snar_5'] >= '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['snar_5'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_1');
exit();
}
mysql_query("UPDATE `users` SET `snar_5` = '1', `item_5_text` = 'Штаны разбойника', `item_5_str` = '5', `item_5_def` = '5', `item_5_health` = '5', `gold` = '".($user['gold'] - 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Штаны разбойника успешно приобретены</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if(isset($_GET['item_6'])){
if($user['snar_6'] >= '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['snar_6'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_1');
exit();
}
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_1');
exit();
}
mysql_query("UPDATE `users` SET `snar_6` = '1', `item_6_text` = 'Обувь разбойника', `item_6_str` = '5', `item_6_def` = '5', `item_6_health` = '5', `gold` = '".($user['gold'] - 5)."', `str` = '".($user['str'] + 5)."', `def` = '".($user['def'] + 5)."', `max_health` = '".($user['max_health'] + 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Обувь разбойника успешно приобретена</font></div>';
header('Location: ?snar&complect_1');
exit();
}
echo '<div class="de center">Комплект разбойника</div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/1/1.png" width="40" height="40"></div> Шлем разбойника<br><img src="/icons/str.png" width="16" height="16">5 <img src="/icons/def.png" width="16" height="16">5 <img src="/icons/health.png" width="16" height="16">5<br><br><center>';
if($user['snar_1'] == 0)echo '<a href="?snar&complect_1&item_1" class="but">Купить за 5 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/1/2.png" width="40" height="40"></div> Наплечник разбойника<br><img src="/icons/str.png" width="16" height="16">5 <img src="/icons/def.png" width="16" height="16">5 <img src="/icons/health.png" width="16" height="16">5<br><br><center>';
if($user['snar_2'] == 0)echo '<a href="?snar&complect_1&item_2" class="but">Купить за 5 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/1/3.png" width="40" height="40"></div> Броня разбойника<br><img src="/icons/str.png" width="16" height="16">5 <img src="/icons/def.png" width="16" height="16">5 <img src="/icons/health.png" width="16" height="16">5<br><br><center>';
if($user['snar_3'] == 0)echo '<a href="?snar&complect_1&item_3" class="but">Купить за 5 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo'</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/1/4.png" width="40" height="40"></div> Оружие разбойника<br><img src="/icons/str.png" width="16" height="16">5 <img src="/icons/def.png" width="16" height="16">5 <img src="/icons/health.png" width="16" height="16">5<br><br><center>';
if($user['snar_4'] == 0)echo '<a href="?snar&complect_1&item_4" class="but">Купить за 5 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/1/5.png" width="40" height="40"></div> Штаны разбойника<br><img src="/icons/str.png" width="16" height="16">5 <img src="/icons/def.png" width="16" height="16">5 <img src="/icons/health.png" width="16" height="16">5<br><br><center>';
if($user['snar_5'] == 0)echo '<a href="?snar&complect_1&item_5" class="but">Купить за 5 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/1/6.png" width="40" height="40"></div> Обувь разбойника<br><img src="/icons/str.png" width="16" height="16">5 <img src="/icons/def.png" width="16" height="16">5 <img src="/icons/health.png" width="16" height="16">5<br><br><center>';
if($user['snar_6'] == 0)echo '<a href="?snar&complect_1&item_6" class="but">Купить за 5 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<a href="?snar#'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>