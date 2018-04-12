<?php
include '../system/func.php';
$title = 'Герб Клана';
auth();
include '../system/header.php';
//space
if($user['id_clan'] == 0){
header('Location: /clan/menu.php');
exit();
}
$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."'"));
if(isset($_GET['pay_1'])){
if($clan['gold'] <= 4999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">В казне клана, недостаточно золота</font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['clan_rang'] <= 4){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `clans` SET `gerb` = '1', `gold` = `gold` - 5000 WHERE `id` = '".$user['id_clan']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Герб клана успешно приобретен!</font></div>';
header('Location: ?'.$r.'');
exit();
}
if(isset($_GET['pay_2'])){
if($clan['gold'] <= 9999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">В казне клана, недостаточно золота</font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['clan_rang'] <= 4){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `clans` SET `gerb` = '2', `gold` = `gold` - 10000 WHERE `id` = '".$user['id_clan']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Герб клана успешно приобретен!</font></div>';
header('Location: ?'.$r.'');
exit();
}
if(isset($_GET['pay_3'])){
if($clan['gold'] <= 14999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">В казне клана, недостаточно золота</font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['clan_rang'] <= 4){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `clans` SET `gerb` = '3', `gold` = `gold` - 15000 WHERE `id` = '".$user['id_clan']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Герб клана успешно приобретен!</font></div>';
header('Location: ?'.$r.'');
exit();
}
if(isset($_GET['pay_4'])){
if($clan['gold'] <= 19999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">В казне клана, недостаточно золота</font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['clan_rang'] <= 4){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `clans` SET `gerb` = '4', `gold` = `gold` - 20000 WHERE `id` = '".$user['id_clan']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Герб клана успешно приобретен!</font></div>';
header('Location: ?'.$r.'');
exit();
}
if(isset($_GET['pay_5'])){
if($clan['gold'] <= 24999){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">В казне клана, недостаточно золота</font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['clan_rang'] <= 4){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `clans` SET `gerb` = '5', `gold` = `gold` - 25000 WHERE `id` = '".$user['id_clan']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Герб клана успешно приобретен!</font></div>';
header('Location: ?'.$r.'');
exit();
}

echo '<div class="de center">'.$title.'</div>';
if($user['clan_rang'] == 5){
echo '<div class="text center">Если вы хотите сменить герб клана, выберите подходящий!</div>';
//
echo '<div class="de center"><img src="/icons/clan/1.png" width="45" height="45"><br>Стоимость: <img src="/icons/gold.png" width="16" height="16">5000<hr>';
if($clan['gerb'] == 1)echo '<font color="tomato">Герб уже приобретен!</font>';
else
echo '<a href="?pay_1" class="but">Приобрести</a>';
echo '</div>';
//
echo '<div class="de center"><img src="/icons/clan/2.png" width="45" height="45"><br>Стоимость: <img src="/icons/gold.png" width="16" height="16">10000<hr>';
if($clan['gerb'] == 2)echo '<font color="tomato">Герб уже приобретен!</font>';
else
echo '<a href="?pay_2" class="but">Приобрести</a>';
echo '</div>';
//
echo '<div class="de center"><img src="/icons/clan/3.png" width="45" height="45"><br>Стоимость: <img src="/icons/gold.png" width="16" height="16">15000<hr>';
if($clan['gerb'] == 3)echo '<font color="tomato">Герб уже приобретен!</font>';
else
echo '<a href="?pay_3" class="but">Приобрести</a>';
echo '</div>';
//
echo '<div class="de center"><img src="/icons/clan/4.png" width="45" height="45"><br>Стоимость: <img src="/icons/gold.png" width="16" height="16">20000<hr>';
if($clan['gerb'] == 4)echo '<font color="tomato">Герб уже приобретен!</font>';
else
echo '<a href="?pay_4" class="but">Приобрести</a>';
echo '</div>';
//
echo '<div class="de center"><img src="/icons/clan/5.png" width="45" height="45"><br>Стоимость: <img src="/icons/gold.png" width="16" height="16">25000<hr>';
if($clan['gerb'] == 5)echo '<font color="tomato">Герб уже приобретен!</font>';
else
echo '<a href="?pay_5" class="but">Приобрести</a>';
echo '</div>';
}else{
echo '<div class="text center"><font color="tomato">Герб клана может менять только лидер!</font></div>';
}

echo "<a href='/clan/sett.php' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include '../system/footer.php';
?>