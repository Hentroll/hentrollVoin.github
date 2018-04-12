<?php
if(isset($_GET['quest_3'])){
if($user['quest_3_coll'] <= 29){
header('Location: ?'.$r.'');
exit();
}
if($user['quest_3'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + 7)."', `crystals` = '".($user['crystals'] + 300)."', `exp` = '".($user['exp'] + 100)."', `quest_3_coll` = '0', `quest_3_time` = '".(time() + 86400)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center">Награда:<br>+ <img src="/icons/gold.png" width="16" height="16">7 <img src="/icons/silver.png" width="16" height="16">300 <img src="/icons/exp.png" width="14" height="14"> 100</div>';
header('Location: ?'.$r.'');
exit();
}
echo '<div class="text">';
echo '<img src="/icons/zak.png" width="16" height="16"> Ударьте замок 30 раз.<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">7 <img src="/icons/silver.png" width="16" height="16">300 <img src="/icons/exp.png" width="14" height="14"> 100<br>';
if($user['quest_3_time'] < time()){
if($user['quest_3_coll'] <= 29){
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="tomato">Выполняется</font><br><center><a href="/zamok.php"><img src="/icons/right.png" width="" height=""><u>Выполнить задание</u></a></center>';
}else{
echo '<img src="/icons/red.png" width="16" height="16"> Статус: <font color="lime">Выполнено</font><br><center><a href="?quest_3" class="but">Получить награду</a></center>';
}
}else{
echo '<center>Через: '.tl($user['quest_3_time'] - time()).'</center>';
}
echo '</div>';
?>