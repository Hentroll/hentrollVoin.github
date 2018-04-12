<?php
if(isset($_GET['quest_2'])){
if($user['quest_2_coll'] <= 24){
header('Location: ?'.$r.'');
exit();
}
if($user['quest_2'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + 4)."', `crystals` = '".($user['crystals'] + 100)."', `exp` = '".($user['exp'] + 70)."', `quest_2_coll` = '0', `quest_2_time` = '".(time() + 86400)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center">Награда:<br>+ <img src="/icons/gold.png" width="16" height="16">4 <img src="/icons/silver.png" width="16" height="16">100 <img src="/icons/exp.png" width="14" height="14"> 70</div>';
header('Location: ?'.$r.'');
exit();
}
echo '<div class="text">';
echo '<img src="/icons/liga.png" width="16" height="16"> Проведите 25 боев в лиге.<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">4 <img src="/icons/silver.png" width="16" height="16">100 <img src="/icons/exp.png" width="14" height="14"> 70<br>';
if($user['quest_2_time'] < time()){
if($user['quest_2_coll'] <= 24){
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="tomato">Выполняется</font><br><center><a href="/liga.php"><img src="/icons/right.png" width="" height=""><u>Выполнить задание</u></a></center>';
}else{
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="lime">Выполнено</font><br><center><a href="?quest_2" class="but">Получить награду</a></center>';
}
}else{
echo '<center>Через: '.tl($user['quest_2_time'] - time()).'</center>';
}
echo '</div>';
?>