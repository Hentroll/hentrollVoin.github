<?php
//получаем награду
if(isset($_GET['quest_5']) && $user['adven'] >= 5 && $user['level'] >= 15 && $user['liga'] >= 5 && $user['clan_tour'] >= 1000 && $user['snar_1'] >= 5 && $user['snar_2'] >= 5 && $user['snar_3'] >= 5 && $user['snar_4'] >= 5 && $user['snar_5'] >= 5 && $user['snar_6'] >= 5){
if($user['company_id'] >= 5){
header('Location: ?'.$r.'');
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $company_gold)."', `crystals` = '".($user['crystals'] + $company_silver)."', `exp` = '".($user['exp'] + $company_exp)."', `company_id` = '5' WHERE `id` = '".$myID."'");
$SESSION['msg'] = '<div class="text center"><font color="lime">Награда успешно получена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
echo '<div class="text">';
echo '<img src="/icons/adven.png" width="16" height="16"> Победите Ядовитого паука<br>';
if($user['adven'] == 4)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/adventure.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['adven'] >= 5)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/level.png" width="" height=""> Достигните 15 уровня<br>';
if($user['level'] <= 14)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/home.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['level'] >= 15)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/liga.png" width="16" height="16"> Достигните Лиги богов<br>';
if($user['liga'] == 4)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/liga.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['liga'] >= 5)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/cland.png" width="14" height="14"> Наберите 1000 клановых очков<br>';
if($user['clan_tour'] <= 999)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/clan_tour.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['clan_tour'] >= 1000)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/equip.png" width="16" height="16"> Приобретите комплект бога<br>';
if($user['snar_1'] == 4 && $user['snar_2'] == 4 && $user['snar_3'] == 4 && $user['snar_4'] == 4 && $user['snar_5'] == 4 && $user['snar_6'] == 4)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/shop.php?snar&complect_5"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['snar_1'] >= 5 && $user['snar_2'] >= 5 && $user['snar_3'] >= 5 && $user['snar_4'] >= 5 && $user['snar_5'] >= 5 && $user['snar_6'] >= 5)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
if($user['adven'] >= 5 && $user['level'] >= 15 && $user['liga'] >= 5 && $user['clan_tour'] >= 1000 && $user['snar_1'] >= 5 && $user['snar_2'] >= 5 && $user['snar_3'] >= 5 && $user['snar_4'] >= 5 && $user['snar_5'] >= 5 && $user['snar_6'] >= 5)echo '<div class="de center"><font color="lime">Все задания выполнены!</font><hr><a href="?quest_5" class="but">Получить награду</a></div>';
?>