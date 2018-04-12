<?php
auth();
if(isset($_GET['pay_1'])){
if($user['vip'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вип-аккаунт уже приобретен</font></div>';
header('Location: ?vip');
exit();
}
if($user['gold'] <= 99){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?vip');
exit();
}
mysql_query("UPDATE `users` SET `vip` = '1', `time_vip` = '".(time() + 86400)."', `gold` = '".($user['gold'] - 100)."', `str` = '".($user['str'] + 150)."', `def` = '".($user['def'] + 150)."', `max_health` = '".($user['max_health'] + 150)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вип-аккаунт успешно приобретен</font></div>';
header('Location: ?vip');
exit();
}
if(isset($_GET['pay_2'])){
if($user['vip'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вип-аккаунт уже приобретен</font></div>';
header('Location: ?vip');
exit();
}
if($user['gold'] <= 499){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?vip');
exit();
}
mysql_query("UPDATE `users` SET `vip` = '1', `time_vip` = '".(time() + 86400*7)."', `gold` = '".($user['gold'] - 500)."', `str` = '".($user['str'] + 150)."', `def` = '".($user['def'] + 150)."', `max_health` = '".($user['max_health'] + 150)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вип-аккаунт успешно приобретен</font></div>';
header('Location: ?vip');
exit();
}
if(isset($_GET['pay_3'])){
if($user['vip'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Вип-аккаунт уже приобретен</font></div>';
header('Location: ?vip');
exit();
}
if($user['gold'] <= 999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?vip');
exit();
}
mysql_query("UPDATE `users` SET `vip` = '1', `time_vip` = '".(time() + 86400*31)."', `gold` = '".($user['gold'] - 1000)."', `str` = '".($user['str'] + 150)."', `def` = '".($user['def'] + 150)."', `max_health` = '".($user['max_health'] + 150)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вип-аккаунт успешно приобретен</font></div>';
header('Location: ?vip');
exit();
}
echo '<div class="de center">Вип-аккаунт</div>';
echo '<div class="text">';
echo '<center><font color="lime">Вип аккаунт - мощное усиление персонажа.<br>Доступны следующие преимущества:</font></center><hr>';
echo '<img src="/icons/silver.png" width="16" height="16"> Бонус серебра (+100%)<br>';
echo '<img src="/icons/exp.png" width="14" height="14"> Бонус опыта (+100%)<br>';
echo '<img src="/icons/str.png" width="16" height="16"> Бонус к параметрам (+150 ед.)<hr>';
//покупка
echo '<center>';
if($user['time_vip'] < time())
echo '24 часа<br><a href="?vip&pay_1" class="but">Купить за 100 <img src="/icons/gold.png" width="16" height="16"></a><hr>7 дней<br><a href="?vip&pay_2" class="but">Купить за 500 <img src="/icons/gold.png" width="16" height="16"></a><hr>31 день<br><a href="?vip&pay_3" class="but">Купить за 1000 <img src="/icons/gold.png" width="16" height="16"></a>';
else
echo 'Вип-аккаунт активирован: <br>Осталось '.tl($user['time_vip'] - time()).' ';
echo '</center>';
//
echo '</div>';
echo '<a href="?#'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>
