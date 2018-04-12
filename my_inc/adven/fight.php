<?php
auth();
//результат атаки
$rand = rand(0,3);
//
//награда
$adven_1 = rand(1,1);
$adven_2 = rand(0,1);
$adven_3 = rand(0,1);
$silver_no = rand(15,25);
$silver_yes = rand(40,50);
$exp_no = rand(10,20);
$exp_yes = rand(20,40);
//
//клан награда
if($rand == 0){
$clan_1 = rand(20,30);
}elseif($rand == 1){
$clan_1 = rand(20,30);
}elseif($rand == 2){
$clan_1 = rand(10,20);
}elseif($rand == 3){
$clan_1 = rand(10,20);
}
//
//восстановление энергии
if(isset($_GET['reset'])){
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота<br><center><a href="/worldkassa/"><u>Купить золото</u></a></center></font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['coll_adven'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `coll_adven` = '15', `gold` = '".($user['gold'] - 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Энергия восстановлена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
//атака боссов
if(isset($_GET['attack'])){
if($user['id_clan'] > 0){
mysql_query("UPDATE `users` SET `clan_exp` = '".($user['clan_exp'] + $clan_1)."' WHERE `id` = '".$myID."' LIMIT 1");
mysql_query("UPDATE `clans` SET `exp` = `exp` + '$clan_1' WHERE `id` = '".$user['id_clan']."' LIMIT 1");
}
if($user['coll_adven'] == 0){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">У вас недостаточно энергии<br><center><a href="?reset#'.$r.'"><u>Восстановить за 5<img src="/icons/gold.png" width="16" height="16"></u></a></center></font></div>';
header('Location: ?');
exit();
}
if($rand == '0'){
if($user['vip'] == 0){
mysql_query("UPDATE `users` SET `coll_adven` = '".($user['coll_adven'] - 1)."', `exp` = '".($user['exp'] + $exp_yes+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver_yes+$titul_s+$clan_silver)."', `adven_1` = '".($user['adven_1'] + $adven_1)."', `adven_2` = '".($user['adven_2'] + $adven_2)."', `quest_1_coll` = '".($user['quest_1_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_yes+$titul_s+$clan_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_yes+$titul_exp+$zl+$clan_exp).'</div>';
}else{
mysql_query("UPDATE `users` SET `coll_adven` = '".($user['coll_adven'] - 1)."', `exp` = '".($user['exp'] + $exp_yes * 2 + $user['ring']+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver_yes * 2 + $user['amulet']+$titul_s+$clan_silver)."', `adven_1` = '".($user['adven_1'] + $adven_1)."', `adven_2` = '".($user['adven_2'] + $adven_2)."', `quest_1_coll` = '".($user['quest_1_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_yes * 2 + $user['amulet']+$titul_s+$clan_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_yes * 2 + $user['ring']+$titul_exp+$zl+$clan_exp).'</div>';
}
header('Location: ?'.$r.'');
exit();
}
if($rand == '1'){
if($user['vip'] == 0){
mysql_query("UPDATE `users` SET `coll_adven` = '".($user['coll_adven'] - 1)."', `exp` = '".($user['exp'] + $exp_yes+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver_yes+$titul_s+$clan_silver)."', `adven_1` = '".($user['adven_1'] + $adven_1)."', `adven_3` = '".($user['adven_3'] + $adven_3)."', `quest_1_coll` = '".($user['quest_1_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_yes+$titul_s+$clan_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_yes+$titul_exp+$zl+$clan_exp).'</div>';
}else{
mysql_query("UPDATE `users` SET `coll_adven` = '".($user['coll_adven'] - 1)."', `exp` = '".($user['exp'] + $exp_yes * 2 + $user['ring']+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver_yes * 2 + $user['amulet']+$titul_s+$clan_silver)."', `adven_1` = '".($user['adven_1'] + $adven_1)."', `adven_3` = '".($user['adven_3'] + $adven_3)."', `quest_1_coll` = '".($user['quest_1_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_yes * 2 + $user['amulet']+$titul_s+$clan_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_yes * 2 + $user['ring']+$titul_exp+$zl+$clan_exp).'</div>';
}
header('Location: ?'.$r.'');
exit();
}
if($rand == '2'){
if($user['vip'] == 0){
mysql_query("UPDATE `users` SET `coll_adven` = '".($user['coll_adven'] - 1)."', `exp` = '".($user['exp'] + $exp_no+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver_no+$titul_s+$clan_silver)."', `quest_1_coll` = '".($user['quest_1_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_no+$titul_s+$clan_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_no+$titul_exp+$zl+$clan_exp).'</div>';
}else{
mysql_query("UPDATE `users` SET `coll_adven` = '".($user['coll_adven'] - 1)."', `exp` = '".($user['exp'] + $exp_no * 2 + $user['ring']+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver_no * 2 + $user['amulet']+$titul_s+$clan_silver)."', `quest_1_coll` = '".($user['quest_1_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_no * 2 + $user['amulet']+$titul_s+$clan_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_no * 2 + $user['ring']+$titul_exp+$zl+$clan_exp).'</div>';
}
header('Location: ?'.$r.'');
exit();
}
if($rand == '3'){
if($user['vip'] == 0){
mysql_query("UPDATE `users` SET `coll_adven` = '".($user['coll_adven'] - 1)."', `exp` = '".($user['exp'] + $exp_no+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver_no+$titul_s+$clan_silver)."', `quest_1_coll` = '".($user['quest_1_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_no+$titul_s+$clan_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_no+$titul_exp+$zl+$clan_exp).'</div>';
}else{
mysql_query("UPDATE `users` SET `coll_adven` = '".($user['coll_adven'] - 1)."', `exp` = '".($user['exp'] + $exp_no * 2 + $user['ring']+$titul_exp+$zl+$clan_exp)."', `crystals` = '".($user['crystals'] + $silver_no * 2 + $user['amulet']+$titul_s+$clan_silver)."', `quest_1_coll` = '".($user['quest_1_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_no * 2 + $user['amulet']+$titul_s+$clan_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_no * 2 + $user['ring']+$titul_exp+$zl+$clan_exp).'</div>';
}
header('Location: ?'.$r.'');
exit();
}
header('Location: ?');
exit();
}
//
//страница
echo '<div class="de center"><img src="/icons/adven.png" width="16" height="16"> '.$title.' ('.$user['coll_adven'].')</div>';
echo '<div class="text"><div class="oh">'.$images.'</div> <font color="tomato">'.$names.'</font><br><img src="/icons/str.png" width="16" height="16">'.$param.' <img src="/icons/def.png" width="16" height="16">'.$param.' <img src="/icons/health.png" width="16" height="16">'.$param.'<br><hr>';
if($user['coll_adven'] >= 1)echo '<center><a href="?attack#'.$r.'" class="but">Атаковать</a></center>';
else
echo '<center>Энергия восстановиться через: '.tl($user['time_adven'] - time()).'<br><a href="?reset#'.$r.'"><u>Восстановить за 5<img src="/icons/gold.png" width="16" height="16"></u></a></center>';
if($user['adven'] <= 14){
include 'my_inc/adven/okay.php';
}
echo '</div>';
//
?>