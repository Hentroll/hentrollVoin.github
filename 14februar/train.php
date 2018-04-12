<?php
include '../system/func.php';
$title = 'Тренировка';
auth();
include '../system/header.php';
echo '<div class="de center"><img src="/icons/14february/train.png" width="16" height="16"> '.$title.'</div>';
if(isset($_GET['q'])){
if($user['fb_lvl_1'] <= 9 && $user['fb_lvl_2'] <= 9 && $user['fb_lvl_3'] <= 9){
header('Location: ?');
exit();
}
if($user['fb_train_end'] >= 1){
header('Location: ?');
exit();
}
mysql_query("UPDATE `users` SET `fb_heard` = '".($user['fb_heard'] + 50)."', `fb_train_end` = '1' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда:</font><br>+ 50 сердечек!</div>';
header('Location: ?');
exit();
}
$rand = rand(1,5);
if(isset($_GET['fire'])){
if($user['fb_lvl_1'] >= 10 && $user['fb_lvl_2'] >= 10 && $user['fb_lvl_3'] >= 10){
$_SESSION['msg'] = '<div class="text center"><font color="lime">Тренировка закончена!</font></div>';
header('Location: ?');
exit();
}
if($user['fb_strel'] <= 0){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">У вас недостаточно стрел для стрельбы из лука!</font></div>';
header('Location: ?');
exit();
}
if($rand==1){
if($user['fb_lvl_1'] <= 9){
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] - 1)."', `fb_lvl_1` = '".($user['fb_lvl_1'] + 1)."', `fb_lvl_str` = '".($user['fb_lvl_str'] + 25)."', `str` = '".($user['str'] + 25)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Попадание!</font><br>+ 25 параметров к силе!</div>';
}else{
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] - 1)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы промахнулись</font></div>';
}
}

if($rand==2){
if($user['fb_lvl_2'] <= 9){
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] - 1)."', `fb_lvl_2` = '".($user['fb_lvl_2'] + 1)."', `fb_lvl_def` = '".($user['fb_lvl_def'] + 25)."', `def` = '".($user['def'] + 25)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Попадание!</font><br>+ 25 параметров к защите!</div>';
}else{
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] - 1)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы промахнулись</font></div>';
}
}
if($rand==3){
if($user['fb_lvl_3'] <= 9){
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] - 1)."', `fb_lvl_3` = '".($user['fb_lvl_3'] + 1)."', `fb_lvl_hp` = '".($user['fb_lvl_hp'] + 25)."', `max_health` = '".($user['max_health'] + 25)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Попадание!</font><br>+ 25 параметров к здоровью!</div>';
}else{
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] - 1)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы промахнулись</font></div>';
}
}

if($rand==4){
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] - 1)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы промахнулись</font></div>';
}

if($rand==5){
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] - 1)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы промахнулись</font></div>';
}
header('Location: ?');
exit();
}
echo '<div class="text center"><table class="text center" width="100%"><tr><td width="33%"><a class="teac" style="border-right: 1px solid #000000;">Сила<br><img src="/icons/14february/str.png" width="45" height="45"><br> '.$user['fb_lvl_1'].' ур. </a></td><td width="34%"><a class="teac" style="border-right: 1px solid #171717;">Защита<br><img src="/icons/14february/def.png" width="45" height="45"><br>
'.$user['fb_lvl_2'].' ур.</a>
</td><td width="33%"><a class="teac">Здоровье<br><img src="/icons/14february/health.png" width="45" height="45"><br> '.$user['fb_lvl_3'].' ур.</a></td></table></div>';
if($user['fb_lvl_1'] >= 10 && $user['fb_lvl_2'] >= 10 && $user['fb_lvl_3'] >= 10)
{
echo '<div class="text"><center><font color="lime">Тренировка закончена!</font>';
if($user['fb_train_end'] == 0)echo '<hr><a href="?q"><u>Получить награду</u></a></center>';
}
else
{
echo '<div class="text"><center><a href="?fire" class="but">Выстрелить</a></center>';
}
echo '</div><div class="text"><img src="/icons/str.png" width="16" height="16"> Сила, '.$user['fb_lvl_1'].' ур.<br><img src="/icons/ok.png" width="16" height="16"> <font color="lime">Параметры: + '.$user['fb_lvl_str'].'.</font><hr><img src="/icons/def.png" width="16" height="16"> Защита, '.$user['fb_lvl_2'].' ур.<br><img src="/icons/ok.png" width="16" height="16"> <font color="lime">Параметры: + '.$user['fb_lvl_def'].'.</font><hr><img src="/icons/health.png" width="16" height="16"> Здоровье, '.$user['fb_lvl_3'].' ур.<br><img src="/icons/ok.png" width="16" height="16"> <font color="lime">Параметры: + '.$user['fb_lvl_hp'].'.</font>';
echo '</div>';
echo '<div class="text center"><img src="/icons/14february/yw.png"> Информация<hr><font color="silver">Стреляйте из лука, тренеруя свои параметры!<br>Один выстрел, минус 1 стрела!</font></div>';
echo '<a href="/14february/index.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include '../system/footer.php';
?>
