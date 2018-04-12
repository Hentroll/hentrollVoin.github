<?php
//получаем награду
if(isset($_GET['quest_4']) && $user['adven'] >= 4 && $user['level'] >= 12 && $user['liga'] >= 4 && $user['clan_tour'] >= 500 && $user['snar_1'] >= 4 && $user['snar_2'] >= 4 && $user['snar_3'] >= 4 && $user['snar_4'] >= 4 && $user['snar_5'] >= 4 && $user['snar_6'] >= 4){
if($user['company_id'] >= 4){
header('Location: ?'.$r.'');
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $company_gold)."', `crystals` = '".($user['crystals'] + $company_silver)."', `exp` = '".($user['exp'] + $company_exp)."', `company_id` = '4' WHERE `id` = '".$myID."'");
$SESSION['msg'] = '<div class="text center"><font color="lime">Награда успешно получена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
echo '<div class="text">';
echo '<img src="/icons/adven.png" width="16" height="16"> Победите Крысу<br>';
if($user['adven'] == 3)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/adventure.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['adven'] >= 4)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/level.png" width="" height=""> Достигните 12 уровня<br>';
if($user['level'] <= 11)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/home.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['level'] >= 12)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/liga.png" width="16" height="16"> Достигните Лиги легенд<br>';
if($user['liga'] == 3)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/liga.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['liga'] >= 4)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/cland.png" width="14" height="14"> Наберите 500 клановых очков<br>';
if($user['clan_tour'] <= 499)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/clan_tour.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['clan_tour'] >= 500)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/equip.png" width="16" height="16"> Приобретите комплект легенды<br>';
if($user['snar_1'] == 3 && $user['snar_2'] == 3 && $user['snar_3'] == 3 && $user['snar_4'] == 3 && $user['snar_5'] == 3 && $user['snar_6'] == 3)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/shop.php?snar&complect_4"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['snar_1'] >= 4 && $user['snar_2'] >= 4 && $user['snar_3'] >= 4 && $user['snar_4'] >= 4 && $user['snar_5'] >= 4 && $user['snar_6'] >= 4)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
if($user['adven'] >= 4 && $user['level'] >= 12 && $user['liga'] >= 4 && $user['clan_tour'] >= 500 && $user['snar_1'] >= 4 && $user['snar_2'] >= 4 && $user['snar_3'] >= 4 && $user['snar_4'] >= 4 && $user['snar_5'] >= 4 && $user['snar_6'] >= 4)echo '<div class="de center"><font color="lime">Все задания выполнены!</font><hr><a href="?quest_4" class="but">Получить награду</a></div>';
?>