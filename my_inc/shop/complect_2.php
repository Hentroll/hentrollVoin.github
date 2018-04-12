<?php
auth();
//доступ
if($user['level'] <= '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Достигните 4 уровня, чтобы открыть комплект рыцаря!</font></div>';
header('Location: ?snar#'.$r.'');
exit();
}
//
//покупка вещей
if(isset($_GET['item_1'])){
if($user['snar_1'] >= '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['level'] <= '3'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_1'] == '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['gold'] <= 49){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_2');
exit();
}
mysql_query("UPDATE `users` SET `snar_1` = '2', `item_1_text` = 'Шлем рыцаря', `item_1_str` = '25', `item_1_def` = '25', `item_1_health` = '25', `gold` = '".($user['gold'] - 50)."', `str` = '".($user['str'] + 25)."', `def` = '".($user['def'] + 25)."', `max_health` = '".($user['max_health'] + 25)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Шлем рыцаря успешно приобретен</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if(isset($_GET['item_2'])){
if($user['level'] <= '3'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_2'] >= '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['snar_2'] == '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['gold'] <= 49){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_2');
exit();
}
mysql_query("UPDATE `users` SET `snar_2` = '2', `item_2_text` = 'Наплечник рыцаря', `item_2_str` = '25', `item_2_def` = '25', `item_2_health` = '25', `gold` = '".($user['gold'] - 50)."', `str` = '".($user['str'] + 25)."', `def` = '".($user['def'] + 25)."', `max_health` = '".($user['max_health'] + 25)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Наплечник рыцаря успешно приобретен</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if(isset($_GET['item_3'])){
if($user['level'] <= '3'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_3'] == '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['snar_3'] >= '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['gold'] <= 49){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_2');
exit();
}
mysql_query("UPDATE `users` SET `snar_3` = '2', `item_3_text` = 'Броня рыцаря', `item_3_str` = '25', `item_3_def` = '25', `item_3_health` = '25', `gold` = '".($user['gold'] - 50)."', `str` = '".($user['str'] + 25)."', `def` = '".($user['def'] + 25)."', `max_health` = '".($user['max_health'] + 25)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Броня рыцаря успешно приобретена</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if(isset($_GET['item_4'])){
if($user['level'] <= '3'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_4'] >= '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['snar_4'] == '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['gold'] <= 49){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_2');
exit();
}
mysql_query("UPDATE `users` SET `snar_4` = '2', `item_4_text` = 'Оружие рыцаря', `item_4_str` = '25', `item_4_def` = '25', `item_4_health` = '25', `gold` = '".($user['gold'] - 50)."', `str` = '".($user['str'] + 25)."', `def` = '".($user['def'] + 25)."', `max_health` = '".($user['max_health'] + 25)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Оружие рыцаря успешно приобретено</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if(isset($_GET['item_5'])){
if($user['level'] <= '3'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_5'] >= '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['snar_5'] == '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['gold'] <= 49){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_2');
exit();
}
mysql_query("UPDATE `users` SET `snar_5` = '2', `item_5_text` = 'Штаны рыцаря', `item_5_str` = '25', `item_5_def` = '25', `item_5_health` = '25', `gold` = '".($user['gold'] - 50)."', `str` = '".($user['str'] + 25)."', `def` = '".($user['def'] + 25)."', `max_health` = '".($user['max_health'] + 25)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Штаны рыцаря успешно приобретены</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if(isset($_GET['item_6'])){
if($user['level'] <= '3'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_6'] >= '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['snar_6'] == '2'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_2');
exit();
}
if($user['gold'] <= 49){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_2');
exit();
}
mysql_query("UPDATE `users` SET `snar_6` = '2', `item_6_text` = 'Обувь рыцаря', `item_6_str` = '25', `item_6_def` = '25', `item_6_health` = '25', `gold` = '".($user['gold'] - 50)."', `str` = '".($user['str'] + 25)."', `def` = '".($user['def'] + 25)."', `max_health` = '".($user['max_health'] + 25)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Обувь рыцаря успешно приобретена</font></div>';
header('Location: ?snar&complect_2');
exit();
}
echo '<div class="de center">Комплект рыцаря</div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/2/1.png" width="40" height="40"></div> Шлем рыцаря<br><img src="/icons/str.png" width="16" height="16">25 <img src="/icons/def.png" width="16" height="16">25 <img src="/icons/health.png" width="16" height="16">25<br><br><center>';
if($user['snar_1'] <= 1)echo '<a href="?snar&complect_2&item_1" class="but">Купить за 50 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/2/2.png" width="40" height="40"></div> Наплечник рыцаря<br><img src="/icons/str.png" width="16" height="16">25 <img src="/icons/def.png" width="16" height="16">25 <img src="/icons/health.png" width="16" height="16">25<br><br><center>';
if($user['snar_2'] <= 1)echo '<a href="?snar&complect_2&item_2" class="but">Купить за 50 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/2/3.png" width="40" height="40"></div> Броня рыцаря<br><img src="/icons/str.png" width="16" height="16">25 <img src="/icons/def.png" width="16" height="16">25 <img src="/icons/health.png" width="16" height="16">25<br><br><center>';
if($user['snar_3'] <= 1)echo '<a href="?snar&complect_2&item_3" class="but">Купить за 50 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo'</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/2/4.png" width="40" height="40"></div> Оружие рыцаря<br><img src="/icons/str.png" width="16" height="16">25 <img src="/icons/def.png" width="16" height="16">25 <img src="/icons/health.png" width="16" height="16">25<br><br><center>';
if($user['snar_4'] <= 1)echo '<a href="?snar&complect_2&item_4" class="but">Купить за 50 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/2/5.png" width="40" height="40"></div> Штаны рыцаря<br><img src="/icons/str.png" width="16" height="16">25 <img src="/icons/def.png" width="16" height="16">25 <img src="/icons/health.png" width="16" height="16">25<br><br><center>';
if($user['snar_5'] <= 1)echo '<a href="?snar&complect_2&item_5" class="but">Купить за 50 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/2/6.png" width="40" height="40"></div> Обувь рыцаря<br><img src="/icons/str.png" width="16" height="16">25 <img src="/icons/def.png" width="16" height="16">25 <img src="/icons/health.png" width="16" height="16">25<br><br><center>';
if($user['snar_6'] <= 1)echo '<a href="?snar&complect_2&item_6" class="but">Купить за 50 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<a href="?snar#'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>