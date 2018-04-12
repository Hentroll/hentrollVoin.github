<?php
include 'system/func.php';
$title = 'Клановый турнир';
auth();
include 'system/header.php';
if($user['save'] <= 1){
header("Location: /home.php?error");
}
$clan = mysql_query("SELECT * FROM `clans` WHERE `id` = '".($user['id_clan'])."' ORDER BY `id` LIMIT 1");
$clan = mysql_fetch_array($clan);
//награда
if($user['vip'] == 0){
$exp = rand(20,50+$user['ring']);
$silver = rand(40,100+$user['amulet']);
}else{
$exp = rand(50,90+$user['ring']);
$silver = rand(70,120+$user['amulet']);
}
$rand = rand(0,1);
//
$min = rand(1,4);
$icons = array(1=>'1',2=>'2',3=>'3',4=>'4');
$name = array(1=>'Оборотень',2=>'Медведь',3=>'Тролль',4=>'Дракон');
if($clan['tour'] >= 0 && $clan['tour'] <= 9)$gold = 0;
elseif($clan['tour'] >= 10 && $clan['tour'] <= 24)$gold = 5;
elseif($clan['tour'] >= 25 && $clan['tour'] <= 49)$gold = 10;
elseif($clan['tour'] >= 50 && $clan['tour'] <= 99)$gold = 15;
elseif($clan['tour'] >= 100 && $clan['tour'] <= 149)$gold = 25;
elseif($clan['tour'] >= 150 && $clan['tour'] <= 299)$gold = 50;
elseif($clan['tour'] >= 300 && $clan['tour'] <= 499)$gold = 100;
elseif($clan['tour'] >= 500 && $clan['tour'] <= 999)$gold = 250;
elseif($clan['tour'] >= 1000)$gold = 500;
//восстановление энергии
if(isset($_GET['reset'])){
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота<br><center><a href="/worldkassa/"><u>Купить золото</u></a></center></font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['coll_tour'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `coll_tour` = '10', `gold` = '".($user['gold'] - 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Энергия восстановлена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
echo '<div class="de center"><img src="/icons/cland.png" width="14" height="14"> '.$title.' ('.$user['coll_tour'].')</div>';
if(isset($_GET['info'])){
echo '<div class="text center">Клановый турнир, проходит ежедневно, заработанные очки лидер клана может обменять на золото, которое пойдет в казну клана.<br>Основная цель - побеждать противников и зарабатывать клановые очки.<br></div>';
echo '<a href="?'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
exit();
}
if(isset($_GET['attack'])){
if($user['id_clan'] <= 0){
header('Location: ?'.$r.'');
exit();
}
if($user['coll_tour'] <= 0){
header('Location: ?'.$r.'');
exit();
}
if($rand == 0){
mysql_query("UPDATE `clans` SET `tour` = '".($clan['tour'] + 2)."', `exp` = '".($clan['exp'] + $exp)."' WHERE `id` = '".$user['id_clan']."'");
mysql_query("UPDATE `users` SET `exp` = '".($user['exp'] + $exp)."', `clan_exp` = '".($user['clan_exp'] + $exp+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver+$titul_s+$clan_silver)."', `clan_tour` = '".($user['clan_tour'] + 2)."', `coll_tour` = '".($user['coll_tour'] - 1)."', `quest_4_coll` = '".($user['quest_4_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver+$titul_s+$clan_silver).' <img src="/icons/exp.png" width="14" height="14"> '.($exp+$titul_exp+$zl+$clan_exp).' <img src="/icons/quest_adven.png" width="16" height="16">2</div>';
header('Location: ?'.$r.'');
exit();
}
if($rand == 1){
mysql_query("UPDATE `clans` SET `exp` = '".($clan['exp'] + ($exp - 10))."' WHERE `id` = '".$user['id_clan']."'");
mysql_query("UPDATE `users` SET `exp` = '".($user['exp'] + ($exp - 10))."', `clan_exp` = '".($user['clan_exp'] + ($exp - 10)+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + ($silver - 10)+$titul_s+$clan_silver)."', `coll_tour` = '".($user['coll_tour'] - 1)."', `quest_4_coll` = '".($user['quest_4_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver - 10+$titul_s+$clan_silver).' <img src="/icons/exp.png" width="14" height="14"> '.($exp - 10+$titul_exp+$zl+$clan_exp).'</div>';
header('Location: ?'.$r.'');
exit();
}
header('Location: ?'.$r.'');
exit();
}
if($user['id_clan'] >= 1){
echo '<div class="text">';
echo '<div class="oh"><img src="/icons/tour/'.$icons[$min].'.png" width="40" height="40"></div> <font color="tomato">'.$name[$min].'</font><br><img src="/icons/str.png" width="16" height="16">'.($user['str'] + $rand+3).' <img src="/icons/def.png" width="16" height="16">'.($user['def'] + $rand+3).' <img src="/icons/health.png" width="16" height="16">'.($user['max_health'] + $rand+3).'';
echo '<hr>';
if($user['coll_tour'] >= 1)echo '<center><a href="?attack" class="but">Атаковать</a></center>';
else
echo '<center>Восстановиться через: '.tl($user['time_tour'] - time()).'<br><a href="?reset"><u>Восстановить за 5<img src="/icons/gold.png" width="16" height="16"></u></a></center>';
echo '<hr><img src="/icons/quest_adven.png" width="16" height="16"> Очки клана: '.$clan['tour'].'<br><img src="/icons/quest_adven.png" width="16" height="16"> Мои очки: '.$user['clan_tour'].'<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">'.$gold.'<br><center><a href="?info#'.$r.'"><img src="/icons/cland.png" width="14" height="14"> <u>Подробнее о сражении</u></a></center>';
echo '</div>';
}else{
echo '<div class="text center">Для участия в клановом турнире, нужно состоять в клане!</div>';
}
include 'system/footer.php';
?>