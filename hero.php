<?php
include 'system/func.php';
auth();
$id = abs(intval($_GET['id']));
if($id)$profile = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
else $profile = $user;
//пробел
if(!$profile){
header('Location: /home.php#'.$r.'');
exit();
}

if(isset($_GET['user_clan']) && $myID != $profile['id'] && $user['clan_rang'] > 2 && $profile['id_clan'] == 0 and $profile['side'] == $user['side']){
$clan = mysql_fetch_array(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."' LIMIT 1"));
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id_clan` = '$clan[id]'"),0);
if($k_post >= $clan['user_clan']){
$_SESSION['msg'] = "<div class='text center'><font color='tomato'>Ошибка. Клан переполнен</font></div>";
header('Location: /hero/'.$profile['id'].'?'.$r.'');
exit();
}
//space
mysql_query("INSERT INTO `clan_memb` SET `id_user` = '$profile[id]', `id_clan` = '$clan[id]'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Приглашение отправленно</font></div>";
header('Location: ?');
exit();
}
$title = 'Профиль';
include 'system/header.php';
//титул
if($profile['str_train'] >= 0 && $profile['str_train'] <= 9){
$titul = 'Пришедший';
}elseif($profile['str_train'] >= 10 && $profile['str_train'] <= 19){
$titul = 'Опытный воин';
}elseif($profile['str_train'] >= 20 && $profile['str_train'] <= 29){
$titul = 'Мастер';
}elseif($profile['str_train'] >= 30 && $profile['str_train'] <= 39){
$titul = 'Полководец';
}elseif($profile['str_train'] >= 40){
$titul = 'Герой';
}
//
//лига
if($profile['liga'] == 0){
$liga = 'новичков';
}else
if($profile['liga'] == 1){
$liga = 'бойцов';
}else
if($profile['liga'] == 2){
$liga = 'сильнейших';
}else
if($profile['liga'] == 3){
$liga = 'чемпионов';
}else
if($profile['liga'] == 4){
$liga = 'легенд';
}else
if($profile['liga'] == 5){
$liga = 'богов';
}
else
if($profile['liga'] == 6){
$liga = 'богов';
}
//
if($user['save'] <= 1){
header("Location: /home.php?error");
}
if($user['access'] >= 1){
if($user['access'] == 2){
echo "<center><a href='/mahaker/mahaker_panel.php?sett_user=$profile[id]' class='link'>Редактировать игрока</a></center>";
}
echo '<div class="text center">';
if($user['access'] > $profile['access'] and $myID != $profile['id'])echo "<a href='/ip/$profile[id]' class='center'><u>Проверить IP</u></a> | ";
if($user['access'] > $profile['access'] and $myID != $profile['id'])echo " <a href='/ban/$profile[id]/' class='center'><u>Забанить</u></a>";
if($user['access'] > $profile['access'])if($user['access'] == 2 and $myID != $profile['id'])echo "<br><a href='/block/$profile[id]/' class='center'><u>Блок игрока</u></a>";
echo '</div>';
}
echo '<div class="de center"><img src="/icons/'.$profile['sex'].'.png"> '.$profile['login'].', '.$profile['level'].' уровень.';
//echo '<br><img src="/icons/titul.png"> Титул: <a>'.$titul.'</a>';
echo '</div>';
echo '<div class="text center">';
include 'my_inc/hero_avatar.php';
echo '<hr>';
if($profile['run_1'] >= 1)echo '<img src="/icons/item/complect_'.$profile['run_1'].'.png"> ';
if($profile['run_2'] >= 1)echo '<img src="/icons/item/complect_'.$profile['run_2'].'.png"> ';
if($profile['run_3'] >= 1)echo '<img src="/icons/item/complect_'.$profile['run_3'].'.png"> ';
if($profile['run_4'] >= 1)echo '<img src="/icons/item/complect_'.$profile['run_4'].'.png"> ';
if($profile['run_5'] >= 1)echo '<img src="/icons/item/complect_'.$profile['run_5'].'.png"> ';
if($profile['run_6'] >= 1)echo '<img src="/icons/item/complect_'.$profile['run_6'].'.png"> ';
echo '</div>';
echo '<div class="de">';
echo '<font color="lime"><img src="/icons/'.$profile['sex'].'.png"> '.$profile['login'].', '.$profile['level'].' уровень<br></font>';
if($profile['vip'] == 1){
echo '<img src="/icons/premium.png"> <a href="/shop.php?vip#'.$r.'"><font color="lime">Вип аккаунт</font></a><br>';
}
if($profile['statys'] >= 1){
echo '<img src="/icons/statys.png"> <a href="/statys.php">Статус: - '.$profile['statys_text'].'</a><br>';
}else{
echo '<img src="/icons/statys.png"> <a href="/statys.php">Статус: - Не установлен</a><br>';
}
echo '<img src="/icons/liga.png" width="16" height="16"> <a href="/liga.php?'.$r.'"><font color="lime">Лига '.$liga.'</font></a><br>';
$clan = mysql_fetch_array(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$profile['id_clan']."' LIMIT 1"));
switch($profile['clan_rang']){
case 1:
$clan_rang = 'Новичок';
break;
case 2:
$clan_rang = 'Боец';
break;
case 3:
$clan_rang = 'Офицер';
break;
case 4:
$clan_rang = 'Генерал';
break;
case 5:
$clan_rang = "Лидер";
break;
}
if($clan){
echo "<img src='/icons/cland.png' width='13' height='13'> Клан: <a href='/clan/index.php?id=$clan[id]'><font color='lime'>$clan[name]</font></a> - $clan_rang<br>";
}
echo '<img src="/icons/str.png" width="16" height="16"> Сила: '.$profile['str'].'<br>';
echo '<img src="/icons/def.png" width="16" height="16"> Защита: '.$profile['def'].'<br>';
echo '<img src="/icons/health.png" width="16" height="16"> Здоровье: '.$profile['max_health'].'<br>';
echo '<img src="/icons/str.png" width="16" height="16"><img src="/icons/def.png" width="16" height="16"><img src="/icons/health.png" width="16" height="16"> <font color="tomato"> '.($profile['str']+$profile['def']+$profile['max_health']).' </font><hr>';
if($profile['zl_1'] == 1){
echo '<img src="/icons/wizard.png"> <a href="/shop.php?zl#'.$r.'">Зелье силы</a> - '.tl($profile['zl_1_time'] - time()).'<br>';
}
if($profile['zl_2'] == 1){
echo '<img src="/icons/wizard.png"> <a href="/shop.php?zl#'.$r.'1">Зелье защиты</a> - '.tl($profile['zl_2_time'] - time()).'<br>';
}
if($profile['zl_3'] == 1){
echo '<img src="/icons/wizard.png"> <a href="/shop.php?zl#'.$r.'2">Зелье здоровья</a> - '.tl($profile['zl_3_time'] - time()).'<br>';
}
if($profile['zl_4'] == 1){
echo '<img src="/icons/wizard.png"> <a href="/shop.php?zl#'.$r.'3">Зелье опыта</a> - '.tl($profile['zl_4_time'] - time()).'<br>';
}

if($myID == $profile['id']){
echo '<hr><img src="/icons/gold.png" width="16" height="16"> Золото: '.$profile['gold'].'<br><img src="/icons/silver.png" width="16" height="16"> Серебро: '.$profile['crystals'].'';
echo '<br><img src="/icons/exp.png" width="14" height="14"> Опыт: '.n_f($profile['exp']).'/'.n_f($exp).'('.round($profile['exp']/$exp*100,1).'%)';
}
echo "</div>";
//мой профиль
if($myID == $profile['id']){
echo '<div class="de">';
echo '<a href="/item.php" class="link"><img src="/icons/equip.png"> Снаряжение</a>';
echo '<a href="/mail.php" class="link"><img src="/icons/mail.png"> Почта</a>';
echo '<a href="/train.php" class="link"><img src="/icons/train.png" width="16" height="16"> Тренировка</a>';
echo '<a href="/arch.php" class="link"><img src="/icons/doss.png"> Достижения ';
echo '</a>';
echo '<a href="/sett.php" class="link"><img src="/icons/settings.png"> Настройки</a>';
echo '</div>';
echo '<div class="text">';
if($profile['access'] == 1)echo '<font color="lime">Модератор</font><br>';
else
if($profile['access'] == 2)echo '<font color="lime">Администратор</font><br>';
echo 'Статус: '; if($user['online'] > time() - 15200)echo '<font color="lime">Онлайн</font>';
else
echo '<font color="tomato">Офф - '.vremja($profile['online']).'</font>';
echo '<br>Регистрация: '.vremja($profile['registr']).'';
echo '</div>';
}
//
if($profile['id'] != $myID){
//другой юзер
echo '<div class="de">';
echo '<a href="/mail/'.$profile['id'].'" class="link"><img src="/icons/mail.png"> Написать сообщение</a>';
if($profile['clan_off'] == 0)if($profile['level'] > 0)if($profile['id'] != $myID)if($myID != $id and $user['clan_rang'] > 2 and $profile['id_clan'] == 0 and $user['side'] == $profile['side'] and mysql_result(mysql_query("SELECT COUNT(*) FROM `clan_memb` WHERE `id_user` = '$id' AND `id_clan` = '$user[id_clan]'"),0) == 0)echo '<a href="?user_clan" class="link"><img src="/icons/right.png"> Пригласить в клан</a>';
echo '</div>';
echo '<div class="text">';
if($profile['access'] == 1)echo '<font color="lime">Модератор</font><br>';
else
if($profile['access'] == 2)echo '<font color="lime">Администратор</font><br>';
echo 'Статус: '; if($profile['online'] > time() - 15200)echo '<font color="lime">Онлайн</font>';
else
echo '<font color="tomato">Офф - '.vremja($profile['online']).'</font>';
echo '<br>Регистрация: '.vremja($profile['registr']).'';
echo '</div>';
}
//
$clan = null;
include 'system/footer.php';
?>