<?php
include 'system/func.php';
$title = 'Приключение';
auth();
include 'system/header.php';
include 'my_inc/adven/info.php';
//награда
if($user['adven'] == 0){
$gold = '10';
$silver = '350';
}
elseif($user['adven'] == 1){
$gold = '15';
$silver = '500';
}
elseif($user['adven'] == 2){
$gold = '30';
$silver = '1500';
}
elseif($user['adven'] == 3){
$gold = '70';
$silver = '5000';
}
elseif($user['adven'] == 4){
$gold = '140';
$silver = '10000';
}
elseif($user['adven'] == 5){
$gold = '280';
$silver = '20000';
}
elseif($user['adven'] == 6){
$gold = '400';
$silver = '35000';
}
elseif($user['adven'] == 7){
$gold = '600';
$silver = '70000';
}
elseif($user['adven'] == 8){
$gold = '800';
$silver = '150000';
}
elseif($user['adven'] == 9){
$gold = '1000';
$silver = '300000';
}
elseif($user['adven'] == 10){
$gold = '1100';
$silver = '400000';
}
elseif($user['adven'] == 11){
$gold = '1200';
$silver = '500000';
}
elseif($user['adven'] == 12){
$gold = '1300';
$silver = '600000';
}
elseif($user['adven'] == 13){
$gold = '1400';
$silver = '700000';
}
elseif($user['adven'] == 14){
$gold = '1500';
$silver = '800000';
}
//
//получаем награду

if(isset($_GET['quest'])){
if($user['adven_1'] <= 9 && $user['adven_2'] <= 9 && $user['adven_3'] <= 9 && $user['adven'] == 0){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 14 && $user['adven_2'] <= 14 && $user['adven_3'] <= 14 && $user['adven'] == 1){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 19 && $user['adven_2'] <= 19 && $user['adven_3'] <= 19 && $user['adven'] == 2){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 24 && $user['adven_2'] <= 24 && $user['adven_3'] <= 24 && $user['adven'] == 3){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 29 && $user['adven_2'] <= 29 && $user['adven_3'] <= 29 && $user['adven'] == 4){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 34 && $user['adven_2'] <= 34 && $user['adven_3'] <= 34 && $user['adven'] == 5){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 39 && $user['adven_2'] <= 39 && $user['adven_3'] <= 39 && $user['adven'] == 6){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 44 && $user['adven_2'] <= 44 && $user['adven_3'] <= 44 && $user['adven'] == 7){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 49 && $user['adven_2'] <= 49 && $user['adven_3'] <= 49 && $user['adven'] == 8){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 54 && $user['adven_2'] <= 54 && $user['adven_3'] <= 54 && $user['adven'] == 9){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 59 && $user['adven_2'] <= 59 && $user['adven_3'] <= 59 && $user['adven'] == 10){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 64 && $user['adven_2'] <= 64 && $user['adven_3'] <= 64 && $user['adven'] == 11){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 69 && $user['adven_2'] <= 69 && $user['adven_3'] <= 69 && $user['adven'] == 12){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 74 && $user['adven_2'] <= 74 && $user['adven_3'] <= 74 && $user['adven'] == 13){
header('Location: ?task#'.$r.'');
exit();
}
if($user['adven_1'] <= 79 && $user['adven_2'] <= 79 && $user['adven_3'] <= 79 && $user['adven'] == 14){
header('Location: ?task#'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $gold)."', `crystals` = '".($user['crystals'] + $silver)."', `adven` = '".($user['adven'] + 1)."', `adven_1` = 0, `adven_2` = 0, `adven_3` = 0 WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вы успешно забрали награду</font></div>';
header('Location: ?task#'.$r.'');
exit();
}
//
if(isset($_GET['task'])){
if($user['adven'] == 15){
header('Location: /adventure.php');
exit();
}
echo '<div class="de center"><img src="/icons/adven.png" width="16" height="16"> Сюжетные задания ('.($user['adven']+1).'/10)</div>';
echo '<div class="text"><img src="/icons/quest_adven.png"> <font color="tomato">'.$names.'</font> - ('.$gold.'<img src="/icons/gold.png" width="16" height="16">, '.$silver.'<img src="/icons/silver.png" width="16" height="16">)<br>'.$task_1.' '.$task_2.''.$task_3.'<hr><center>';
if($user['adven_1'] >= 10 && $user['adven_2'] >= 10 && $user['adven_3'] >= 10 && $user['adven'] == 0)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 15 && $user['adven_2'] >= 15 && $user['adven_3'] >= 15 && $user['adven'] == 1)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 20 && $user['adven_2'] >= 20 && $user['adven_3'] >= 20 && $user['adven'] == 2)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 25 && $user['adven_2'] >= 25 && $user['adven_3'] >= 25 && $user['adven'] == 3)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 30 && $user['adven_2'] >= 30 && $user['adven_3'] >= 30 && $user['adven'] == 4)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 35 && $user['adven_2'] >= 35 && $user['adven_3'] >= 35 && $user['adven'] == 5)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 40 && $user['adven_2'] >= 40 && $user['adven_3'] >= 40 && $user['adven'] == 6)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 45 && $user['adven_2'] >= 45 && $user['adven_3'] >= 45 && $user['adven'] == 7)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 50 && $user['adven_2'] >= 50 && $user['adven_3'] >= 50 && $user['adven'] == 8)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 55 && $user['adven_2'] >= 55 && $user['adven_3'] >= 55 && $user['adven'] == 9)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 60 && $user['adven_2'] >= 60 && $user['adven_3'] >= 60 && $user['adven'] == 10)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 65 && $user['adven_2'] >= 65 && $user['adven_3'] >= 65 && $user['adven'] == 11)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 70 && $user['adven_2'] >= 70 && $user['adven_3'] >= 70 && $user['adven'] == 12)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 75 && $user['adven_2'] >= 75 && $user['adven_3'] >= 75 && $user['adven'] == 13)echo '<a href="?task&quest" class="but">Получить награду</a>';
if($user['adven_1'] >= 80 && $user['adven_2'] >= 80 && $user['adven_3'] >= 80 && $user['adven'] == 14)echo '<a href="?task&quest" class="but">Получить награду</a>';
echo '</center><hr><center>Для того чтобы получить награду за задания, вам нужно <u>собирать - кожу и лапки животных</u>, которых вы встретите в приключении!</center></div>';
echo '<a href="?'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
exit();
}
include 'my_inc/adven/fight.php';
include 'system/footer.php';
?>