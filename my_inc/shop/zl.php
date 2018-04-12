<?php
auth();
//цена и бонус
$st = 50;
$bonus = 100;
$stt = 49;
//
//зелье опыта
if(isset($_GET['zl_4'])){
if($user['zl_4'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Зелье опыта уже приобретено</font></div>';
header('Location: ?zl');
exit();
}
if($user['gold'] <= $stt){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zl');
exit();
}
mysql_query("UPDATE `users` SET `zl_4` = '1', `zl_4_time` = '".(time() + 86400)."', `gold` = '".($user['gold'] - $st)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Зелье опыта успешно приобретено</font></div>';
header('Location: ?zl');
exit();
}
//
//зелье силы
if(isset($_GET['zl_1'])){
if($user['zl_1'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Зелье силы уже приобретено</font></div>';
header('Location: ?zl');
exit();
}
if($user['gold'] <= $stt){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zl');
exit();
}
mysql_query("UPDATE `users` SET `zl_1` = '1', `zl_1_time` = '".(time() + 86400)."', `gold` = '".($user['gold'] - $st)."', `str` = '".($user['str'] + 100)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Зелье силы успешно приобретено</font></div>';
header('Location: ?zl');
exit();
}
//
//зелье защиты
if(isset($_GET['zl_2'])){
if($user['zl_2'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Зелье защиты уже приобретено</font></div>';
header('Location: ?zl');
exit();
}
if($user['gold'] <= $stt){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zl');
exit();
}
mysql_query("UPDATE `users` SET `zl_2` = '1', `zl_2_time` = '".(time() + 86400)."', `gold` = '".($user['gold'] - $st)."', `def` = '".($user['def'] + 100)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Зелье защиты успешно приобретено</font></div>';
header('Location: ?zl');
exit();
}
//
//зелье здоровья
if(isset($_GET['zl_3'])){
if($user['zl_3'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Зелье здоровья уже приобретено</font></div>';
header('Location: ?zl');
exit();
}
if($user['gold'] <= $stt){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: ?zl');
exit();
}
mysql_query("UPDATE `users` SET `zl_3` = '1', `zl_3_time` = '".(time() + 86400)."', `gold` = '".($user['gold'] - $st)."', `max_health` = '".($user['max_health'] + 100)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Зелье защиты успешно приобретено</font></div>';
header('Location: ?zl');
exit();
}
//
echo '<div class="de center">Магазин зелья</div>';
echo '<div class="text">';
echo '<img src="/icons/str.png" width="16" height="16"> Зелье силы<br><img src="/icons/ok.png" width="16" height="16"> Бонус: + '.$bonus.' к силе<br><img src="/icons/gold.png" width="16" height="16"> Стоимость: '.$st.' золота.<hr>';
if($user['zl_1_time'] < time())echo '<center><a href="/shop.php?zl&zl_1" class="but">Приобрести</a></center>';
else
echo '<center>Осталось: '.tl($user['zl_1_time'] - time()).'</center>';
echo '</div>';

echo '<div class="text">';
echo '<img src="/icons/def.png" width="16" height="16"> Зелье защиты<br><img src="/icons/ok.png" width="16" height="16"> Бонус: + '.$bonus.' к защите<br><img src="/icons/gold.png" width="16" height="16"> Стоимость: '.$st.' золота.<hr>';
if($user['zl_2_time'] < time())echo '<center><a href="/shop.php?zl&zl_2" class="but">Приобрести</a></center>';
else
echo '<center>Осталось: '.tl($user['zl_2_time'] - time()).'</center>';
echo '</div>';

echo '<div class="text">';
echo '<img src="/icons/health.png" width="16" height="16"> Зелье здоровья<br><img src="/icons/ok.png" width="16" height="16"> Бонус: + '.$bonus.' к здоровью<br><img src="/icons/gold.png" width="16" height="16"> Стоимость: '.$st.' золота.<hr>';
if($user['zl_3_time'] < time())echo '<center><a href="/shop.php?zl&zl_3" class="but">Приобрести</a></center>';
else
echo '<center>Осталось: '.tl($user['zl_3_time'] - time()).'</center>';
echo '</div>';

echo '<div class="text">';
echo '<img src="/icons/exp.png" width="14" height="14"> Зелье опыта<br><img src="/icons/ok.png" width="16" height="16"> Бонус: + 40% к опыту<br><img src="/icons/gold.png" width="16" height="16"> Стоимость: '.$st.' золота.<hr>';
if($user['zl_4_time'] < time())echo '<center><a href="/shop.php?zl&zl_4" class="but">Приобрести</a></center>';
else
echo '<center>Осталось: '.tl($user['zl_4_time'] - time()).'</center>';
echo '</div>';
echo '<a href="?" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>