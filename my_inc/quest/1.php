<?php
if(isset($_GET['quest_1'])){
if($user['quest_1_coll'] <= 49){
header('Location: ?'.$r.'');
exit();
}
if($user['quest_1'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + 5)."', `crystals` = '".($user['crystals'] + 150)."', `exp` = '".($user['exp'] + 50)."', `quest_1_coll` = '0', `quest_1_time` = '".(time() + 86400)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center">Награда:<br>+ <img src="/icons/gold.png" width="16" height="16">5 <img src="/icons/silver.png" width="16" height="16">150 <img src="/icons/exp.png" width="14" height="14"> 50</div>';
header('Location: ?'.$r.'');
exit();
}
echo '<div class="text">';
echo '<img src="/icons/adven.png" width="16" height="16"> Проведите 50 боев в приключении.<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">5 <img src="/icons/silver.png" width="16" height="16">150 <img src="/icons/exp.png" width="14" height="14"> 50<br>';
if($user['quest_1_time'] < time()){
if($user['quest_1_coll'] <= 49){
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="tomato">Выполняется</font><br><center><a href="/adventure.php"><img src="/icons/right.png" width="" height=""><u>Выполнить задание</u></a></center>';
}else{
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="lime">Выполнено</font><br><center><a href="?quest_1" class="but">Получить награду</a></center>';
}
}else{
echo '<center>Через: '.tl($user['quest_1_time'] - time()).'</center>';
}
echo '</div>';
?>