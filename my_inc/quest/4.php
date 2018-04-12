<?php
if(isset($_GET['quest_4'])){
if($user['quest_4_coll'] <= 39){
header('Location: ?'.$r.'');
exit();
}
if($user['quest_4'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + 8)."', `crystals` = '".($user['crystals'] + 700)."', `exp` = '".($user['exp'] + 170)."', `quest_4_coll` = '0', `quest_4_time` = '".(time() + 86400)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center">Награда:<br>+ <img src="/icons/gold.png" width="16" height="16">8 <img src="/icons/silver.png" width="16" height="16">700 <img src="/icons/exp.png" width="14" height="14"> 170</div>';
header('Location: ?'.$r.'');
exit();
}
echo '<div class="text">';
echo '<img src="/icons/cland.png" width="14" height="14"> Проведите 40 боев в клановом турнире.<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">8 <img src="/icons/silver.png" width="16" height="16">700 <img src="/icons/exp.png" width="14" height="14"> 170<br>';
if($user['quest_4_time'] < time()){
if($user['quest_4_coll'] <= 39){
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="tomato">Выполняется</font><br><center><a href="/clan_tour.php"><img src="/icons/right.png" width="" height=""><u>Выполнить задание</u></a></center>';
}else{
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="lime">Выполнено</font><br><center><a href="?quest_4" class="but">Получить награду</a></center>';
}
}else{
echo '<center>Через: '.tl($user['quest_4_time'] - time()).'</center>';
}
echo '</div>';
?>