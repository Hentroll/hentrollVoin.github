<?php
//получаем награду
if(isset($_GET['quest_2']) && $user['adven'] >= 2 && $user['level'] >= 6 && $user['liga'] >= 2 && $user['clan_tour'] >= 250 && $user['snar_1'] >= 2 && $user['snar_2'] >= 2 && $user['snar_3'] >= 2 && $user['snar_4'] >= 2 && $user['snar_5'] >= 2 && $user['snar_6'] >= 2){
if($user['company_id'] >= 2){
header('Location: ?'.$r.'');
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $company_gold)."', `crystals` = '".($user['crystals'] + $company_silver)."', `exp` = '".($user['exp'] + $company_exp)."', `company_id` = '2' WHERE `id` = '".$myID."'");
$SESSION['msg'] = '<div class="text center"><font color="lime">Награда успешно получена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
echo '<div class="text">';
echo '<img src="/icons/adven.png" width="16" height="16"> Победите Старого пса<br>';
if($user['adven'] == 1)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/adventure.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['adven'] >= 2)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/level.png" width="" height=""> Достигните 6 уровня<br>';
if($user['level'] <= 5)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/home.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['level'] >= 6)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/liga.png" width="16" height="16"> Достигните Лиги сильнейших<br>';
if($user['liga'] == 1)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/liga.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['liga'] >= 2)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/cland.png" width="14" height="14"> Наберите 250 клановых очков<br>';
if($user['clan_tour'] <= 249)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/clan_tour.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['clan_tour'] >= 250)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/equip.png" width="16" height="16"> Приобретите комплект рыцаря<br>';
if($user['snar_1'] == 1 && $user['snar_2'] == 1 && $user['snar_3'] == 1 && $user['snar_4'] == 1 && $user['snar_5'] == 1 && $user['snar_6'] == 1)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/shop.php?snar&complect_2"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['snar_1'] >= 2 && $user['snar_2'] >= 2 && $user['snar_3'] >= 2 && $user['snar_4'] >= 2 && $user['snar_5'] >= 2 && $user['snar_6'] >= 2)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
if($user['adven'] >= 2 && $user['level'] >= 6 && $user['liga'] >= 2 && $user['clan_tour'] >= 250 && $user['snar_1'] >= 2 && $user['snar_2'] >= 2 && $user['snar_3'] >= 2 && $user['snar_4'] >= 2 && $user['snar_5'] >= 2 && $user['snar_6'] >= 2)echo '<div class="de center"><font color="lime">Все задания выполнены!</font><hr><a href="?quest_2" class="but">Получить награду</a></div>';
?>