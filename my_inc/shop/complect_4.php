<?php
auth();
//доступ
if($user['level'] <= '9'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Достигните 10 уровня, чтобы открыть комплект легенды!</font></div>';
header('Location: ?snar#'.$r.'');
exit();
}
//покупка вещей
if(isset($_GET['item_1'])){
if($user['level'] <= '9'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_1'] >= '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['snar_1'] == '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['gold'] <= 1999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_4');
exit();
}
mysql_query("UPDATE `users` SET `snar_1` = '4', `item_1_text` = 'Шлем легенды', `item_1_str` = '250', `item_1_def` = '250', `item_1_health` = '250', `gold` = '".($user['gold'] - 2000)."', `str` = '".($user['str'] + 250)."', `def` = '".($user['def'] + 250)."', `max_health` = '".($user['max_health'] + 250)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Шлем легенды успешно приобретен</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if(isset($_GET['item_2'])){
if($user['level'] <= '9'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_2'] >= '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['snar_2'] == '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['gold'] <= 1999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_4');
exit();
}
mysql_query("UPDATE `users` SET `snar_2` = '4', `item_2_text` = 'Наплечник легенды', `item_2_str` = '250', `item_2_def` = '250', `item_2_health` = '250', `gold` = '".($user['gold'] - 2000)."', `str` = '".($user['str'] + 250)."', `def` = '".($user['def'] + 250)."', `max_health` = '".($user['max_health'] + 250)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Наплечник легенды успешно приобретен</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if(isset($_GET['item_3'])){
if($user['level'] <= '9'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_3'] == '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['snar_3'] >= '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['gold'] <= 1999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_4');
exit();
}
mysql_query("UPDATE `users` SET `snar_3` = '4', `item_3_text` = 'Броня легенды', `item_3_str` = '250', `item_3_def` = '250', `item_3_health` = '250', `gold` = '".($user['gold'] - 2000)."', `str` = '".($user['str'] + 250)."', `def` = '".($user['def'] + 250)."', `max_health` = '".($user['max_health'] + 250)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Броня легенды успешно приобретена</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if(isset($_GET['item_4'])){
if($user['level'] <= '9'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_4'] >= '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['snar_4'] == '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['gold'] <= 1999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_4');
exit();
}
mysql_query("UPDATE `users` SET `snar_4` = '4', `item_4_text` = 'Оружие легенды', `item_4_str` = '250', `item_4_def` = '250', `item_4_health` = '250', `gold` = '".($user['gold'] - 2000)."', `str` = '".($user['str'] + 250)."', `def` = '".($user['def'] + 250)."', `max_health` = '".($user['max_health'] + 250)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Оружие легенды успешно приобретено</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if(isset($_GET['item_5'])){
if($user['level'] <= '9'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_5'] >= '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['snar_5'] == '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['gold'] <= 1999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_4');
exit();
}
mysql_query("UPDATE `users` SET `snar_5` = '4', `item_5_text` = 'Штаны легенды', `item_5_str` = '250', `item_5_def` = '250', `item_5_health` = '250', `gold` = '".($user['gold'] - 2000)."', `str` = '".($user['str'] + 250)."', `def` = '".($user['def'] + 250)."', `max_health` = '".($user['max_health'] + 250)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Штаны легенды успешно приобретены</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if(isset($_GET['item_6'])){
if($user['level'] <= '9'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_6'] >= '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['snar_6'] == '4'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_4');
exit();
}
if($user['gold'] <= 1999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_4');
exit();
}
mysql_query("UPDATE `users` SET `snar_6` = '4', `item_6_text` = 'Обувь легенды', `item_6_str` = '250', `item_6_def` = '250', `item_6_health` = '250', `gold` = '".($user['gold'] - 2000)."', `str` = '".($user['str'] + 250)."', `def` = '".($user['def'] + 250)."', `max_health` = '".($user['max_health'] + 250)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Обувь легенды успешно приобретена</font></div>';
header('Location: ?snar&complect_4');
exit();
}
echo '<div class="de center">Комплект легенды</div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/4/1.png" width="40" height="40"></div> Шлем легенды<br><img src="/icons/str.png" width="16" height="16">250 <img src="/icons/def.png" width="16" height="16">250 <img src="/icons/health.png" width="16" height="16">250<br><br><center>';
if($user['snar_1'] <= 3)echo '<a href="?snar&complect_4&item_1" class="but">Купить за 2000 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/4/2.png" width="40" height="40"></div> Наплечник легенды<br><img src="/icons/str.png" width="16" height="16">250 <img src="/icons/def.png" width="16" height="16">250 <img src="/icons/health.png" width="16" height="16">250<br><br><center>';
if($user['snar_2'] <= 3)echo '<a href="?snar&complect_4&item_2" class="but">Купить за 2000 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/4/3.png" width="40" height="40"></div> Броня легенды<br><img src="/icons/str.png" width="16" height="16">250 <img src="/icons/def.png" width="16" height="16">250 <img src="/icons/health.png" width="16" height="16">250<br><br><center>';
if($user['snar_3'] <= 3)echo '<a href="?snar&complect_4&item_3" class="but">Купить за 2000 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo'</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/4/4.png" width="40" height="40"></div> Оружие легенды<br><img src="/icons/str.png" width="16" height="16">250 <img src="/icons/def.png" width="16" height="16">250 <img src="/icons/health.png" width="16" height="16">250<br><br><center>';
if($user['snar_4'] <= 3)echo '<a href="?snar&complect_4&item_4" class="but">Купить за 2000 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/4/5.png" width="40" height="40"></div> Штаны легенды<br><img src="/icons/str.png" width="16" height="16">250 <img src="/icons/def.png" width="16" height="16">250 <img src="/icons/health.png" width="16" height="16">250<br><br><center>';
if($user['snar_5'] <= 3)echo '<a href="?snar&complect_4&item_5" class="but">Купить за 2000 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/4/6.png" width="40" height="40"></div> Обувь легенды<br><img src="/icons/str.png" width="16" height="16">250 <img src="/icons/def.png" width="16" height="16">250 <img src="/icons/health.png" width="16" height="16">250<br><br><center>';
if($user['snar_6'] <= 3)echo '<a href="?snar&complect_4&item_6" class="but">Купить за 2000 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<a href="?snar#'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>