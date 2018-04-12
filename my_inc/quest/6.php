<?php
if(isset($_GET['quest_6'])){
if($user['quest_6_coll'] <= 4999){
header('Location: ?'.$r.'');
exit();
}
if($user['quest_6'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + 1000)."', `crystals` = '".($user['crystals'] + 15000)."', `exp` = '".($user['exp'] + 500)."', `quest_6_coll` = '0', `quest_6_time` = '".(time() + 86400)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center">Награда:<br>+ <img src="/icons/gold.png" width="16" height="16">1000 <img src="/icons/silver.png" width="16" height="16">15000 <img src="/icons/exp.png" width="14" height="14"> 500</div>';
header('Location: ?'.$r.'');
exit();
}
echo '<div class="text">';
echo '<img src="/icons/gold.png" width="16" height="16"> Приобретите 5000 золота.<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">1000 <img src="/icons/silver.png" width="16" height="16">15000 <img src="/icons/exp.png" width="14" height="14"> 500<br>';
if($user['quest_6_time'] < time()){
if($user['quest_6_coll'] <= 4999){
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="tomato">Выполняется</font><br><center><a href="/worldkassa"><img src="/icons/right.png" width="" height=""><u>Выполнить задание</u></a></center>';
}else{
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="lime">Выполнено</font><br><center><a href="?quest_6" class="but">Получить награду</a></center>';
}
}else{
echo '<center>Через: '.tl($user['quest_6_time'] - time()).'</center>';
}
echo '</div>';
?>