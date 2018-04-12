<?php
include 'system/func.php';
//лига
if($user['liga'] == 0){
$liga = 'новичков';
}else
if($user['liga'] == 1){
$liga = 'бойцов';
}else
if($user['liga'] == 2){
$liga = 'сильнейших';
}else
if($user['liga'] == 3){
$liga = 'чемпионов';
}else
if($user['liga'] == 4){
$liga = 'легенд';
}else
if($user['liga'] == 5){
$liga = 'богов';
}else
if($user['liga'] == 6){
$liga = 'богов';
}
$title = 'Лига '.$liga.'';
auth();
include 'system/header.php';
if($user['save'] <= 1){
header('Location: /');
exit();
}
//задания
if(isset($_GET['quest'])){
include 'my_inc/liga/info.php';
exit();
}
//
//восстановление энергии
if(isset($_GET['reset'])){
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота<br><center><a href="/worldkassa/"><u>Купить золото</u></a></center></font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['coll_liga'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `coll_liga` = '5', `gold` = '".($user['gold'] - 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Энергия восстановлена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
echo '<div class="de center"><img src="/icons/liga.png" width="16" height="16"> '.$title.' ('.$user['coll_liga'].')</div>';
echo '<div class="text center">';
include 'my_inc/liga/maneken.php';
include 'my_inc/liga/attack.php';
if($user['coll_liga'] >= 1){
echo '<a href="?attack#'.$r.'" class="but">Атаковать</a>';
}else{
echo 'Энергия восстановится через: '.tl($user['time_liga'] - time()).'<br><a href="?reset#'.$r.'" class="center"><u>Восстановить за 5<img src="/icons/gold.png" width="16" height="16"></u></a>';
}
if($user['liga'] <= 5){
include 'my_inc/liga/quest.php';
}
echo '</div>';
include 'system/footer.php';
?>