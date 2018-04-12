<?php
auth();
//доступ
if($user['level'] <= '14'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Достигните 15 уровня, чтобы открыть комплект бога!</font></div>';
header('Location: ?snar#'.$r.'');
exit();
}
$price = 5000;
//покупка вещей
if(isset($_GET['item_1'])){
if($user['level'] <= '14'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_1'] >= '6'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['snar_1'] == '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['gold'] <= $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_5');
exit();
}
mysql_query("UPDATE `users` SET `snar_1` = '5', `item_1_text` = 'Шлем бога', `item_1_str` = '500', `item_1_def` = '500', `item_1_health` = '500', `gold` = '".($user['gold'] - $price)."', `str` = '".($user['str'] + 500)."', `def` = '".($user['def'] + 500)."', `max_health` = '".($user['max_health'] + 500)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Шлем бога успешно приобретен</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if(isset($_GET['item_2'])){
if($user['level'] <= '14'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_2'] >= '6'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['snar_2'] == '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['gold'] <= $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_5');
exit();
}
mysql_query("UPDATE `users` SET `snar_2` = '5', `item_2_text` = 'Наплечник бога', `item_2_str` = '500', `item_2_def` = '500', `item_2_health` = '500', `gold` = '".($user['gold'] - $price)."', `str` = '".($user['str'] + 500)."', `def` = '".($user['def'] + 500)."', `max_health` = '".($user['max_health'] + 500)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Наплечник бога успешно приобретен</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if(isset($_GET['item_3'])){
if($user['level'] <= '14'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_3'] == '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['snar_3'] >= '6'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['gold'] <= $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_5');
exit();
}
mysql_query("UPDATE `users` SET `snar_3` = '5', `item_3_text` = 'Броня бога', `item_3_str` = '500', `item_3_def` = '500', `item_3_health` = '500', `gold` = '".($user['gold'] - $price)."', `str` = '".($user['str'] + 500)."', `def` = '".($user['def'] + 500)."', `max_health` = '".($user['max_health'] + 500)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Броня бога успешно приобретена</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if(isset($_GET['item_4'])){
if($user['level'] <= '14'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_4'] >= '6'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['snar_4'] == '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['gold'] <= $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_5');
exit();
}
mysql_query("UPDATE `users` SET `snar_4` = '5', `item_4_text` = 'Оружие бога', `item_4_str` = '500', `item_4_def` = '500', `item_4_health` = '500', `gold` = '".($user['gold'] - $price)."', `str` = '".($user['str'] + 500)."', `def` = '".($user['def'] + 500)."', `max_health` = '".($user['max_health'] + 500)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Оружие бога успешно приобретено</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if(isset($_GET['item_5'])){
if($user['level'] <= '14'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_5'] >= '6'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['snar_5'] == '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['gold'] <= $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_5');
exit();
}
mysql_query("UPDATE `users` SET `snar_5` = '5', `item_5_text` = 'Штаны бога', `item_5_str` = '500', `item_5_def` = '500', `item_5_health` = '500', `gold` = '".($user['gold'] - $price)."', `str` = '".($user['str'] + 500)."', `def` = '".($user['def'] + 500)."', `max_health` = '".($user['max_health'] + 500)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Штаны бога успешно приобретены</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if(isset($_GET['item_6'])){
if($user['level'] <= '14'){
header('Location: ?snar#'.$r.'');
exit();
}
if($user['snar_6'] >= '6'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Приобретена вещь более мощная этой</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['snar_6'] == '5'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вы уже приобрели эту вещь</font></div>';
header('Location: ?snar&complect_5');
exit();
}
if($user['gold'] <= $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?snar&complect_5');
exit();
}
mysql_query("UPDATE `users` SET `snar_6` = '5', `item_6_text` = 'Обувь бога', `item_6_str` = '500', `item_6_def` = '500', `item_6_health` = '500', `gold` = '".($user['gold'] - $price)."', `str` = '".($user['str'] + 500)."', `def` = '".($user['def'] + 500)."', `max_health` = '".($user['max_health'] + 500)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Обувь бога успешно приобретена</font></div>';
header('Location: ?snar&complect_5');
exit();
}
echo '<div class="de center">Комплект бога</div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/5/1.png" width="40" height="40"></div> Шлем бога<br><img src="/icons/str.png" width="16" height="16">500 <img src="/icons/def.png" width="16" height="16">500 <img src="/icons/health.png" width="16" height="16">500<br><br><center>';
if($user['snar_1'] <= 4)echo '<a href="?snar&complect_5&item_1" class="but">Купить за '.$price.' <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/5/2.png" width="40" height="40"></div> Наплечник бога<br><img src="/icons/str.png" width="16" height="16">500 <img src="/icons/def.png" width="16" height="16">500 <img src="/icons/health.png" width="16" height="16">500<br><br><center>';
if($user['snar_2'] <= 4)echo '<a href="?snar&complect_5&item_2" class="but">Купить за '.$price.' <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/5/3.png" width="40" height="40"></div> Броня бога<br><img src="/icons/str.png" width="16" height="16">500 <img src="/icons/def.png" width="16" height="16">500 <img src="/icons/health.png" width="16" height="16">500<br><br><center>';
if($user['snar_3'] <= 4)echo '<a href="?snar&complect_5&item_3" class="but">Купить за '.$price.' <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo'</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/5/4.png" width="40" height="40"></div> Оружие бога<br><img src="/icons/str.png" width="16" height="16">500 <img src="/icons/def.png" width="16" height="16">500 <img src="/icons/health.png" width="16" height="16">500<br><br><center>';
if($user['snar_4'] <= 4)echo '<a href="?snar&complect_5&item_4" class="but">Купить за '.$price.' <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/5/5.png" width="40" height="40"></div> Штаны бога<br><img src="/icons/str.png" width="16" height="16">500 <img src="/icons/def.png" width="16" height="16">500 <img src="/icons/health.png" width="16" height="16">500<br><br><center>';
if($user['snar_5'] <= 4)echo '<a href="?snar&complect_5&item_5" class="but">Купить за '.$price.' <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/5/6.png" width="40" height="40"></div> Обувь бога<br><img src="/icons/str.png" width="16" height="16">500 <img src="/icons/def.png" width="16" height="16">500 <img src="/icons/health.png" width="16" height="16">500<br><br><center>';
if($user['snar_6'] <= 4)echo '<a href="?snar&complect_5&item_6" class="but">Купить за '.$price.' <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo '<font color="tomato">Вы уже приобрели эту вещь</font>';
echo '</center></div>';
echo '<a href="?snar#'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>