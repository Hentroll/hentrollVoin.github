<?php
include 'system/func.php';
auth();
$title = 'Достижения';
include 'system/header.php';
//награды за достижения
if(isset($_GET['arch_1'])){
if($user['level'] <= 3){
header('Location: ?'.$r.'');
exit();
}
if($user['arch_1'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже получили награду</font></div>';
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `users` set `gold` = '".($user['gold'] + 10)."', `crystals` = '".($user['crystals'] + 500)."', `arch_1` = '1' where `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда получена</font></div>';
header('Location: ?'.$r.'1');
exit();
}
if(isset($_GET['arch_2'])){
if($user['level'] <= 6){
header('Location: ?'.$r.'');
exit();
}
if($user['arch_2'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже получили награду</font></div>';
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `users` set `gold` = '".($user['gold'] + 25)."', `crystals` = '".($user['crystals'] + 1000)."', `arch_2` = '1' where `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда получена</font></div>';
header('Location: ?'.$r.'1');
exit();
}
if(isset($_GET['arch_3'])){
if($user['level'] <= 9){
header('Location: ?'.$r.'');
exit();
}
if($user['arch_3'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже получили награду</font></div>';
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `users` set `gold` = '".($user['gold'] + 50)."', `crystals` = '".($user['crystals'] + 2000)."', `arch_3` = '1' where `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда получена</font></div>';
header('Location: ?'.$r.'1');
exit();
}
if(isset($_GET['arch_4'])){
if($user['level'] <= 13){
header('Location: ?'.$r.'');
exit();
}
if($user['arch_4'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже получили награду</font></div>';
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `users` set `gold` = '".($user['gold'] + 100)."', `crystals` = '".($user['crystals'] + 5000)."', `arch_4` = '1' where `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда получена</font></div>';
header('Location: ?'.$r.'1');
exit();
}
//
//достижения приключений
if(isset($_GET['arch_5'])){
if($user['adven'] <= 1){
header('Location: ?'.$r.'');
exit();
}
if($user['arch_5'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже получили награду</font></div>';
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `users` set `gold` = '".($user['gold'] + 15)."', `crystals` = '".($user['crystals'] + 500)."', `arch_5` = '1' where `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда получена</font></div>';
header('Location: ?'.$r.'1');
exit();
}
if(isset($_GET['arch_6'])){
if($user['adven'] <= 4){
header('Location: ?'.$r.'');
exit();
}
if($user['arch_6'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже получили награду</font></div>';
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `users` set `gold` = '".($user['gold'] + 25)."', `crystals` = '".($user['crystals'] + 2500)."', `arch_6` = '1' where `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда получена</font></div>';
header('Location: ?'.$r.'1');
exit();
}
if(isset($_GET['arch_7'])){
if($user['adven'] <= 6){
header('Location: ?'.$r.'');
exit();
}
if($user['arch_7'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже получили награду</font></div>';
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `users` set `gold` = '".($user['gold'] + 50)."', `crystals` = '".($user['crystals'] + 5000)."', `arch_7` = '1' where `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда получена</font></div>';
header('Location: ?'.$r.'1');
exit();
}
if(isset($_GET['arch_8'])){
if($user['company_id'] <= 4){
header('Location: ?'.$r.'');
exit();
}
if($user['arch_8'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже получили награду</font></div>';
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `users` set `gold` = '".($user['gold'] + 50)."', `crystals` = '".($user['crystals'] + 1500)."', `arch_8` = '1' where `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда получена</font></div>';
header('Location: ?'.$r.'8');
exit();
}
//
echo '<div class="de center">'.$title.'</div>';
echo '<div class="text">';
echo 'Достигните 4 уровня<br>';
echo 'Награда: <img src="/icons/gold.png" width="16" height="16">10, <img src="/icons/silver.png" width="16" height="16">500<br>';
echo 'Статус: ';
if($user['arch_1'] == 1)echo '<font color="lime">Выполнено</font>';
else
echo '<font color="tomato">Выполняется</font>';
if($user['level'] >= 4 && $user['arch_1'] == 0)echo '<center><a href="?arch_1" class="but">Получить награду</a></center>';
echo '</div>';
echo '<div class="text">';
echo 'Достигните 7 уровня<br>';
echo 'Награда: <img src="/icons/gold.png" width="16" height="16">25, <img src="/icons/silver.png" width="16" height="16">1000<br>';
echo 'Статус: ';
if($user['arch_2'] == 1)echo '<font color="lime">Выполнено</font>';
else
echo '<font color="tomato">Выполняется</font>';
if($user['level'] >= 7 && $user['arch_2'] == 0)echo '<center><a href="?arch_2" class="but">Получить награду</a></center>';
echo '</div>';
echo '<div class="text">';
echo 'Достигните 10 уровня<br>';
echo 'Награда: <img src="/icons/gold.png" width="16" height="16">50, <img src="/icons/silver.png" width="16" height="16">2000<br>';
echo 'Статус: ';
if($user['arch_3'] == 1)echo '<font color="lime">Выполнено</font>';
else
echo '<font color="tomato">Выполняется</font>';
if($user['level'] >= 10 && $user['arch_3'] == 0)echo '<center><a href="?arch_3" class="but">Получить награду</a></center>';
echo '</div>';
echo '<div class="text">';
echo 'Достигните 14 уровня<br>';
echo 'Награда: <img src="/icons/gold.png" width="16" height="16">100, <img src="/icons/silver.png" width="16" height="16">5000<br>';
echo 'Статус: ';
if($user['arch_4'] == 1)echo '<font color="lime">Выполнено</font>';
else
echo '<font color="tomato">Выполняется</font>';
if($user['level'] >= 14 && $user['arch_4'] == 0)echo '<center><a href="?arch_4" class="but">Получить награду</a></center>';
echo '</div>';
//достижения приключений
echo '<div class="text">';
echo 'Победите крысу в приключении<br>';
echo 'Награда: <img src="/icons/gold.png" width="16" height="16">15, <img src="/icons/silver.png" width="16" height="16">500<br>';
echo 'Статус: ';
if($user['arch_5'] == 1)echo '<font color="lime">Выполнено</font>';
else
echo '<font color="tomato">Выполняется</font>';
if($user['adven'] >= 2 && $user['arch_5'] == 0)echo '<center><a href="?arch_5" class="but">Получить награду</a></center>';
echo '</div>';
echo '<div class="text">';
echo 'Победите волка в приключении<br>';
echo 'Награда: <img src="/icons/gold.png" width="16" height="16">25, <img src="/icons/silver.png" width="16" height="16">2500<br>';
echo 'Статус: ';
if($user['arch_6'] == 1)echo '<font color="lime">Выполнено</font>';
else
echo '<font color="tomato">Выполняется</font>';
if($user['adven'] >= 5 && $user['arch_6'] == 0)echo '<center><a href="?arch_6" class="but">Получить награду</a></center>';
echo '</div>';
echo '<div class="text">';
echo 'Победите медведя в приключении<br>';
echo 'Награда: <img src="/icons/gold.png" width="16" height="16">50, <img src="/icons/silver.png" width="16" height="16">5000<br>';
echo 'Статус: ';
if($user['arch_7'] == 1)echo '<font color="lime">Выполнено</font>';
else
echo '<font color="tomato">Выполняется</font>';
if($user['adven'] >= 7 && $user['arch_7'] == 0)echo '<center><a href="?arch_7" class="but">Получить награду</a></center>';
echo '</div>';
echo '<div class="text">';
echo 'Пройдите 5 глав кампании<br>';
echo 'Награда: <img src="/icons/gold.png" width="16" height="16">50, <img src="/icons/silver.png" width="16" height="16">1500<br>';
echo 'Статус: ';
if($user['arch_8'] == 1)echo '<font color="lime">Выполнено</font>';
else
echo '<font color="tomato">Выполняется</font>';
if($user['company_id'] >= 5 && $user['arch_8'] == 0)echo '<center><a href="?arch_8" class="but">Получить награду</a></center>';
echo '</div>';
//
echo '<a href="/hero/" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
?>
