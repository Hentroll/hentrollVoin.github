<?php
include 'system/func.php';
auth();
$title = 'Поход';
include 'system/header.php';
//время похода
if($user['level'] >= 1 && $user['level'] <= 3){
$time = 1;
}elseif($user['level'] >= 4 && $user['level'] <= 6){
$time = 2;
}elseif($user['level'] >= 7 && $user['level'] <= 9){
$time = 4;
}elseif($user['level'] >= 10 && $user['level'] <= 15){
$time = 8;
}elseif($user['level'] >= 16 && $user['level'] <= 25){
$time = 16;
}
//
//награда
if($user['level'] >= 1 && $user['level'] <= 3){
$gold = rand(4,9);
$silver = rand(10,90+$user['ring']+$user['level']);
$exp = rand(10,30+$user['amulet']+$user['level']);
}elseif($user['level'] >= 4 && $user['level'] <= 7){
$gold = rand(6,12);
$silver = rand(50,300+$user['ring']+$user['level']);
$exp = rand(20,50+$user['amulet']+$user['level']);
}elseif($user['level'] >= 8 && $user['level'] <= 11){
$gold = rand(8,14);
$silver = rand(30,460+$user['ring']+$user['level']);
$exp = rand(50,100+$user['amulet']+$user['level']);
}elseif($user['level'] >= 12 && $user['level'] <= 15){
$gold = rand(10,16);
$silver = rand(50,700+$user['ring']+$user['level']);
$exp = rand(20,70+$user['amulet']+$user['level']);
}elseif($user['level'] >= 16 && $user['level'] <= 25){
$gold = rand(12,18);
$silver = rand(50,800+$user['ring']+$user['level']);
$exp = rand(20,80+$user['amulet']+$user['level']);
}
//
//получаем награду
if(isset($_GET['quest'])){
if($user['pohod_ok'] >= 0 && $user['pohod_ok'] <= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $gold)."', `crystals` = '".($user['crystals'] + $silver+$titul_s)."', `exp` = '".($user['exp'] + $exp+$titul_exp+$zl)."', `pohod_ok` = '0' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center">Награда:<br>+ <img src="/icons/gold.png" width="16" height="16">'.$gold.' <img src="/icons/silver.png" width="16" height="16">'.($silver+$titul_s).' <img src="/icons/exp.png" width="14" height="14"> '.($exp+$titul_exp+$zl).'</div>';
header('Location: ?'.$r.'');
exit();
}
//
//идем в поход
if(isset($_GET['go'])){
if($user['pohod_ok'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже в походе</font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['level'] >= 1 && $user['level'] <= 3){
mysql_query("UPDATE `users` SET `pohod` = '".(time() + 3600)."', `pohod_ok` = '1' WHERE `id` = '".$myID."'");
}elseif($user['level'] >= 4 && $user['level'] <= 6){
mysql_query("UPDATE `users` SET `pohod` = '".(time() + 7200)."', `pohod_ok` = '1' WHERE `id` = '".$myID."'");
}elseif($user['level'] >= 7 && $user['level'] <= 9){
mysql_query("UPDATE `users` SET `pohod` = '".(time() + 14400)."', `pohod_ok` = '1' WHERE `id` = '".$myID."'");
}elseif($user['level'] >= 10 && $user['level'] <= 15){
mysql_query("UPDATE `users` SET `pohod` = '".(time() + 28800)."', `pohod_ok` = '1' WHERE `id` = '".$myID."'");
}elseif($user['level'] >= 16 && $user['level'] <= 25){
mysql_query("UPDATE `users` SET `pohod` = '".(time() + 57600)."', `pohod_ok` = '1' WHERE `id` = '".$myID."'");
}
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вы отправились в поход</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
//оповещение награды
if($user['pohod_ok'] == 2)echo '<div class="text center">Поход завершен!<br><a href="?quest"><u>Получить награду</u></a></a></div>';
//
echo '<div class="de center"><img src="/icons/pohod.png" width="16" height="16"> '.$title.' </div>';
echo '<img src="/icons/pohod_logo.png" width="100%">';
echo '<div class="text center">';
echo 'В походе вы можете добыть: золото, серебро и опыт.<br>Чем дольше поход, тем больше награда.<hr>';
if($user['pohod'] < time()){
echo 'Время похода: '.$time.' час(ов)<hr><a href="?go" class="but">Отправиться</a>';
}else{
echo 'Осталось: '.tl($user['pohod'] - time()).'';
}
echo '</div>';
include 'system/footer.php';
?>