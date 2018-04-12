<?php
auth();
//доступ
if($user['level'] <= '6'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Достигните 7 уровня, чтобы открыть комплект полководца!</font></div>';
header('Location: ?snar#'.$r.'');
exit();
}
//
//покупка вещей
if(isset($_GET['item_1'])){
if($user['snar_1'] >= '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['level'] <= '6'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_1'] == '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['gold'] <= 249){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_3');
exit();
}
mysql_query("UPDATE `users` SET `snar_1` = '3', `item_1_text` = 'Шлем полководца', `item_1_str` = '75', `item_1_def` = '75', `item_1_health` = '75', `gold` = '".($user['gold'] - 250)."', `str` = '".($user['str'] + 75)."', `def` = '".($user['def'] + 75)."', `max_health` = '".($user['max_health'] + 75)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Шлем полководца успешно приобретен</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if(isset($_GET['item_2'])){
if($user['level'] <= '6'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_2'] >= '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['snar_2'] == '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['gold'] <= 249){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_3');
exit();
}
mysql_query("UPDATE `users` SET `snar_2` = '3', `item_2_text` = 'Наплечник полководца', `item_2_str` = '75', `item_2_def` = '75', `item_2_health` = '75', `gold` = '".($user['gold'] - 250)."', `str` = '".($user['str'] + 75)."', `def` = '".($user['def'] + 75)."', `max_health` = '".($user['max_health'] + 75)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Наплечник полководца успешно приобретен</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if(isset($_GET['item_3'])){
if($user['level'] <= '6'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_3'] == '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['snar_3'] >= '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['gold'] <= 249){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_3');
exit();
}
mysql_query("UPDATE `users` SET `snar_3` = '3', `item_3_text` = 'Броня полководца', `item_3_str` = '75', `item_3_def` = '75', `item_3_health` = '75', `gold` = '".($user['gold'] - 250)."', `str` = '".($user['str'] + 75)."', `def` = '".($user['def'] + 75)."', `max_health` = '".($user['max_health'] + 75)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Броня полководца успешно приобретена</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if(isset($_GET['item_4'])){
if($user['level'] <= '6'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_4'] >= '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['snar_4'] == '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['gold'] <= 249){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_3');
exit();
}
mysql_query("UPDATE `users` SET `snar_4` = '3', `item_4_text` = 'Оружие полководца', `item_4_str` = '75', `item_4_def` = '75', `item_4_health` = '75', `gold` = '".($user['gold'] - 250)."', `str` = '".($user['str'] + 75)."', `def` = '".($user['def'] + 75)."', `max_health` = '".($user['max_health'] + 75)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Оружие полководца успешно приобретено</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if(isset($_GET['item_5'])){
if($user['level'] <= '6'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_5'] >= '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['snar_5'] == '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['gold'] <= 249){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_3');
exit();
}
mysql_query("UPDATE `users` SET `snar_5` = '3', `item_5_text` = 'Штаны полководца', `item_5_str` = '75', `item_5_def` = '75', `item_5_health` = '75', `gold` = '".($user['gold'] - 250)."', `str` = '".($user['str'] + 75)."', `def` = '".($user['def'] + 75)."', `max_health` = '".($user['max_health'] + 75)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Штаны полководца успешно приобретены</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if(isset($_GET['item_6'])){
if($user['level'] <= '6'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_6'] >= '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['snar_6'] == '3'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_3');
exit();
}
if($user['gold'] <= 249){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_3');
exit();
}
mysql_query("UPDATE `users` SET `snar_6` = '3', `item_6_text` = 'Обувь полководца', `item_6_str` = '75', `item_6_def` = '75', `item_6_health` = '75', `gold` = '".($user['gold'] - 250)."', `str` = '".($user['str'] + 75)."', `def` = '".($user['def'] + 75)."', `max_health` = '".($user['max_health'] + 75)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Обувь полководца успешно приобретена</font></div>';
header('Location: ?snar&complect_3');
exit();
}
echo '<div class="de center">Комплект полководца</div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/3/1.png" width="40" height="40"></div> Шлем полководца<br><img src="/icons/str.png" width="16" height="16">75 <img src="/icons/def.png" width="16" height="16">75 <img src="/icons/health.png" width="16" height="16">75<br><br><center>';
if($user['snar_1'] <= 2)echo '<a href="?snar&complect_3&item_1" class="but">Купить за 250 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/3/2.png" width="40" height="40"></div> Наплечник полководца<br><img src="/icons/str.png" width="16" height="16">75 <img src="/icons/def.png" width="16" height="16">75 <img src="/icons/health.png" width="16" height="16">75<br><br><center>';
if($user['snar_2'] <= 2)echo '<a href="?snar&complect_3&item_2" class="but">Купить за 250 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/3/3.png" width="40" height="40"></div> Броня полководца<br><img src="/icons/str.png" width="16" height="16">75 <img src="/icons/def.png" width="16" height="16">75 <img src="/icons/health.png" width="16" height="16">75<br><br><center>';
if($user['snar_3'] <= 2)echo '<a href="?snar&complect_3&item_3" class="but">Купить за 250 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo'</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/3/4.png" width="40" height="40"></div> Оружие полководца<br><img src="/icons/str.png" width="16" height="16">75 <img src="/icons/def.png" width="16" height="16">75 <img src="/icons/health.png" width="16" height="16">75<br><br><center>';
if($user['snar_4'] <= 2)echo '<a href="?snar&complect_3&item_4" class="but">Купить за 250 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/3/5.png" width="40" height="40"></div> Штаны полководца<br><img src="/icons/str.png" width="16" height="16">75 <img src="/icons/def.png" width="16" height="16">75 <img src="/icons/health.png" width="16" height="16">75<br><br><center>';
if($user['snar_5'] <= 2)echo '<a href="?snar&complect_3&item_5" class="but">Купить за 250 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/3/6.png" width="40" height="40"></div> Обувь полководца<br><img src="/icons/str.png" width="16" height="16">75 <img src="/icons/def.png" width="16" height="16">75 <img src="/icons/health.png" width="16" height="16">75<br><br><center>';
if($user['snar_6'] <= 2)echo '<a href="?snar&complect_3&item_6" class="but">Купить за 250 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<a href="?snar#'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>