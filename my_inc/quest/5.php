<?php
if(isset($_GET['quest_5'])){
if($user['quest_5_coll'] <= 999){
header('Location: ?'.$r.'');
exit();
}
if($user['quest_5'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + 250)."', `crystals` = '".($user['crystals'] + 5000)."', `exp` = '".($user['exp'] + 300)."', `quest_5_coll` = '0', `quest_5_time` = '".(time() + 86400)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center">Награда:<br>+ <img src="/icons/gold.png" width="16" height="16">250 <img src="/icons/silver.png" width="16" height="16">5000 <img src="/icons/exp.png" width="14" height="14"> 300</div>';
header('Location: ?'.$r.'');
exit();
}
echo '<div class="text">';
echo '<img src="/icons/gold.png" width="16" height="16"> Приобретите 1000 золота.<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">250 <img src="/icons/silver.png" width="16" height="16">5000 <img src="/icons/exp.png" width="14" height="14"> 300<br>';
if($user['quest_5_time'] < time()){
if($user['quest_5_coll'] <= 999){
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="tomato">Выполняется</font><br><center><a href="/worldkassa"><img src="/icons/right.png" width="" height=""><u>Выполнить задание</u></a></center>';
}else{
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="lime">Выполнено</font><br><center><a href="?quest_5" class="but">Получить награду</a></center>';
}
}else{
echo '<center>Через: '.tl($user['quest_5_time'] - time()).'</center>';
}
echo '</div>';
?>