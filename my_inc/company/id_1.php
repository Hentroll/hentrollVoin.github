<?php
//получаем награду
if(isset($_GET['quest_1']) && $user['adven'] >= 1 && $user['level'] >= 3 && $user['liga'] >= 1 && $user['id_clan'] >= 1 && $user['snar_1'] >= 1 && $user['snar_2'] >= 1 && $user['snar_3'] >= 1 && $user['snar_4'] >= 1 && $user['snar_5'] >= 1 && $user['snar_6'] >= 1){
if($user['company_id'] >= 1){
header('Location: ?'.$r.'');
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $company_gold)."', `crystals` = '".($user['crystals'] + $company_silver)."', `exp` = '".($user['exp'] + $company_exp)."', `company_id` = '1' WHERE `id` = '".$myID."'");
$SESSION['msg'] = '<div class="text center"><font color="lime">Награда успешно получена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
echo '<div class="text">';
echo '<img src="/icons/adven.png" width="16" height="16"> Победите Лягушку<br>';
if($user['adven'] == 0)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/adventure.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['adven'] >= 1)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/level.png" width="" height=""> Достигните 3 уровня<br>';
if($user['level'] <= 2)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/home.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['level'] >= 3)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/liga.png" width="16" height="16"> Достигните Лиги бойцов<br>';
if($user['liga'] == 0)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/liga.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['liga'] >= 1)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/cland.png" width="14" height="14"> Вступите в клан<br>';
if($user['id_clan'] == 0)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/clan/index.php"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['id_clan'] >= 1)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
echo '<div class="text">';
echo '<img src="/icons/equip.png" width="16" height="16"> Приобретите комплект разбойника<br>';
if($user['snar_1'] == 0 && $user['snar_2'] == 0 && $user['snar_3'] == 0 && $user['snar_4'] == 0 && $user['snar_5'] == 0 && $user['snar_6'] == 0)echo '<img src="/icons/red.png" width="" height=""> Статус: <font color="tomato">Выполняется</font><hr><center><a href="/shop.php?snar&complect_1"><img src="/icons/right.png" width="" height=""> <u>Выполнить задание</u></a></center>';
else
if($user['snar_1'] >= 1 && $user['snar_2'] >= 1 && $user['snar_3'] >= 1 && $user['snar_4'] >= 1 && $user['snar_5'] >= 1 && $user['snar_6'] >= 1)echo '<img src="/icons/ok.png" width="" height=""> Статус: <font color="lime">Выполнено</font>';
echo '</div>';
if($user['adven'] >= 1 && $user['level'] >= 3 && $user['liga'] >= 1 && $user['id_clan'] >= 1 && $user['snar_1'] >= 1 && $user['snar_2'] >= 1 && $user['snar_3'] >= 1 && $user['snar_4'] >= 1 && $user['snar_5'] >= 1 && $user['snar_6'] >= 1)echo '<div class="de center"><font color="lime">Все задания выполнены!</font><hr><a href="?quest_1" class="but">Получить награду</a></div>';
?>