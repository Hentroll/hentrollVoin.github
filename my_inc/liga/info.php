<?php
auth();
if($user['liga'] == 0){
$progress = '250';
}elseif($user['liga'] == 1){
$progress = '500';
}elseif($user['liga'] == 2){
$progress = '750';
}elseif($user['liga'] == 3){
$progress = '1500';
}elseif($user['liga'] == 4){
$progress = '3000';
}elseif($user['liga'] == 5){
$progress = '5000';
}
if($user['liga'] == 6){
header('Location: /liga.php');
}
if($user['liga'] == 0){
$gold = 20;
$silver = 1000;
}elseif($user['liga'] == 1){
$gold = 50;
$silver = 3000;
}elseif($user['liga'] == 2){
$gold = 100;
$silver = 7000;
}elseif($user['liga'] == 3){
$gold = 250;
$silver = 30000;
}elseif($user['liga'] == 4){
$gold = 500;
$silver = 70000;
}elseif($user['liga'] == 5){
$gold = 1000;
$silver = 150000;
}

echo '<div class="de center"><img src="/icons/liga.png" width="16" height="16"> Лига '.$liga.'</div>';
echo '<div class="text">';
echo '<img src="/icons/liga.png" width="16" height="16"> <font color="lime">Лига '.$liga.'</font><br><img src="/icons/quest_adven.png" width="16" height="16"> Рейтинг: '.$user['liga_rating'].' из '.$progress.'<br><img src="/icons/ok.png" width="" height=""> Награда: '.$gold.'<img src="/icons/gold.png" width="16" height="16"> '.$silver.'<img src="/icons/silver.png" width="16" height="16"><hr>';
if($user['liga'] <= 5){
if(isset($_GET['ok'])){
if($user['liga_rating'] < $progress){
header('Location: ?quest#'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $gold)."', `crystals` = '".($user['crystals'] + $silver)."', `liga` = '".($user['liga'] + 1)."', `liga_rating` = '0'  WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вы успешно повысили лигу и получили награду!</font></div>';
header('Location: ?quest#'.$r.'');
exit();
}
if($user['liga_rating'] >= $progress){
echo '<center><a href="?quest&ok" class="but">Получить награду</a></center>';
}
}

echo '<hr><center>Для того чтобы получить награду и повысить лигу, вам нужно <u>побеждать противников</u> и повышать свой рейтинг!</center>';
echo '</div>';
echo '<a href="?" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
?>