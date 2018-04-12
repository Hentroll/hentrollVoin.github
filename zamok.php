<?php
include 'system/func.php';
$title = 'Замок сокровищ';
include 'system/header.php';
auth();
//space
if($user['save'] <= 1){
header('Location: /');
exit();
}
$batle = mysql_query("SELECT * FROM `fight` WHERE `id` = '1' ORDER BY `id` LIMIT 1");
$batle = mysql_fetch_array($batle);
if($batle['health'] > $batle['max_health'])$batle['health'] = $batle['max_health'];
if($batle['health'] < 0)$batle['health'] = 0;
//восстановление энергии
if(isset($_GET['reset'])){
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота<br><center><a href="/worldkassa/"><u>Купить золото</u></a></center></font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['coll_fight'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `coll_fight` = '10', `gold` = '".($user['gold'] - 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Энергия восстановлена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
//опыт и серебро
if($user['vip'] == 0){
$exp = rand(20,50+$user['ring']);
$silver = rand(30,100+$user['amulet']);
}else{
$exp = rand(30,80+$user['ring']);
$silver = rand(50,180+$user['amulet']);
}
//
//золото
if($user['fight_uron'] >= 0 && $user['fight_uron'] <= 99)$gold = 0;
elseif($user['fight_uron'] >= 100 && $user['fight_uron'] <= 999)$gold = 5;
elseif($user['fight_uron'] >= 1000 && $user['fight_uron'] <= 4999)$gold = 10;
elseif($user['fight_uron'] >= 5000 && $user['fight_uron'] <= 9999)$gold = 15;
elseif($user['fight_uron'] >= 10000 && $user['fight_uron'] <= 24999)$gold = 25;
elseif($user['fight_uron'] >= 25000 && $user['fight_uron'] <= 49999)$gold = 50;
elseif($user['fight_uron'] >= 50000 && $user['fight_uron'] <= 99999)$gold = 75;
elseif($user['fight_uron'] >= 100000 && $user['fight_uron'] <= 149999)$gold = 100;
elseif($user['fight_uron'] >= 150000)$gold = 125;
//
//награда на бой
if(isset($_GET['quest']) && $user['fight_uron'] >= 100){
if($user['fight_end'] == 0 && $user['fight_uron'] <= 99){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $gold)."', `fight_end` = '0', `fight_uron` = '0' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда: + <img src="/icons/gold.png" width="16" height="16">'.$gold.'</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
//атака
if(isset($_GET['attack']) && vremja() >= '08:00:00' and vremja() <= '20:59:59' && $user['fight_ok'] >= 1 && htmlspecialchars($_GET['attack']==$_SESSION['test_hash'])){
	unset($_SESSION['test_hash']);
if($user['coll_fight'] <= 0){
header('Location: ?'.$r.'');
exit();
}
mysql_query("update `fight` set `health` = '".($batle['health'] - $user['str']/2)."' where (`id` = '".$batle['id']."')");
mysql_query("update `users` set `fight_uron` = '".($user['fight_uron'] + $user['str']/2)."', `exp` = '".($user['exp'] + $exp+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver+$titul_s+$clan_silver)."', `coll_fight` = '".($user['coll_fight'] - 1)."', `quest_3_coll` = '".($user['quest_3_coll'] + 1)."' where (`id` = '".$myID."')");
if($user['id_clan'] > 0){
mysql_query("UPDATE `users` SET `clan_exp` = '".($user['clan_exp'] + $exp)."' WHERE `id` = '".$myID."' LIMIT 1");
mysql_query("UPDATE `clans` SET `exp` = `exp` + '$exp' WHERE `id` = '".$user['id_clan']."' LIMIT 1");
}
$_SESSION['msg'] = '<div class="text center"><img src="/icons/str.png" width="16" height="16"> <font color="tomato">Атака: '.($user['str']/2).' урона.</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver+$titul_s+$clan_silver).' <img src="/icons/exp.png" width="14" height="14"> '.($exp+$titul_exp+$zl+$clan_exp).'</div>';
header("Location: ?".$r."");
exit();
}
echo "<div class='de center'><img src='/icons/zak.png' width='16' height='16'> ".$title."</div>";
if(isset($_GET['info'])){
echo '<div class="text center">Для того чтобы начать сражаться, нужно собрать отряд добровольцев из 50 человек.<br>Отряду достаточно разрушить ворота замка, для того чтобы получить золото.<br>Чем больше вы на несете урона, тем больше награда!</font></div>';
echo '<a href="?'.$r.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
exit();
}
if(vremja() >= '08:00:00' and vremja() <= '20:59:59' && $user['fight_ok'] >= 1 && $user['fight_end'] == 0){
echo "<div class='text'>";
echo '<img src="/icons/zamok.png" width="100%" height="140"><hr>';
echo "<img src='/icons/health.png' width='16' height='16'> ".$batle['health']." - (".round($batle['health']/$batle['max_health']*100,1)."%)<br>";
$progress = round($batle['health']/$batle['max_health']*100,1);
if($progress > 100)$progress = 100;
echo '<div class="exp_polos"><div class="progress" style="width:'.$progress.'%"></div></div>';
echo "<hr>";
$hash=md5(rand(1,300000)); // тестовый хеш
$_SESSION['test_hash']=$hash;
if($user['coll_fight'] >= 1)echo "<center><a><u>Доступно ударов: ".$user['coll_fight']."</u></a><br><br><a href='?attack=".$hash."' class='but'>Атаковать</a></center>";
else
echo '<center>Восстановиться через: '.tl($user['time_fight'] - time()).'<br><a href="?reset"><u>Восстановить за 5<img src="/icons/gold.png" width="16" height="16"></u></a></center>';
echo "<hr><img src='/icons/ok.png' width='16' height='16'> Сражаются: ".($batle['users'])."<br><img src='/icons/str.png' width='16' height='16'> Мой урон: ".($users['fight_uron'])."<br><img src='/icons/quest_adven.png' width='16' height='16'> Награда: ".$gold."<img src='/icons/gold.png' width='16' height='16'>";
echo '<hr><center><a href="?info#'.$r.'"><img src="/icons/zak.png" width="16" height="16"> <u>Подробнее о сражений</u></a></center>';
echo "</div>";
}else{
if($user['fight_uron'] >= 100){
echo '<div class="text center">Награда: <img src="/icons/gold.png" width="16" height="16">'.$gold.'<br><a href="?quest"><u>Забрать награду</u></a></div>';
}
if(isset($_GET['fight'])){
if($user['fight_ok'] >= 1){
header('Location: ?');
exit();
}
mysql_query("UPDATE `fight` SET `users` = '".($batle['users'] + 1)."' WHERE `id` = '".$batle['id']."'");
mysql_query("UPDATE `users` SET `fight_ok` = '".($user['fight_ok'] + 1)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вы участвуете в сражении</font></div>';
header('Location: ?'.$r.'');
exit();
}
echo '<div class="text center">';
echo '<img src="/icons/zamok.png" width="100%" height="140">';
echo '<hr>Замок сокровищ можно атаковать с 08:00:00 до 21:00:00.<br>';
if($user['fight_ok'] == 0)echo '<a href="?fight" class="but">Записаться</a>';
else
echo '<font color="lime">Вы участвуете в бою</font><br><a href="?'.$r.'"><u>Обновить</u></a>';
echo '<hr><a href="?info#'.$r.'"><img src="/icons/quest.png" width="16" height="16"> <u>Подробнее о сражении</u></a>';
echo '</div>';
}
include 'system/footer.php';
?>