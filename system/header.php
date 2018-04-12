<? 
include 'head.php';
?> 
<? 
if(isset($user)){
if($user['online'] < time()-15200){
mysql_query("UPDATE `users` SET `online` = '".time()."' WHERE `id` = '".$myID."'");
header('Location: ?');
}
    switch($user['level']) {
    
      case 1:
$exp = 1000;
       break;

      case 2:
$exp = 2500;
       break;

      case 3:
$exp = 3500;
       break;

      case 4:
$exp = 5000;
       break;

      case 5:
$exp = 6500;
       break;

      case 6:
$exp = 7500;
       break;

      case 7:
$exp = 10000;
       break;

      case 8:
$exp = 15000;
       break;

      case 9:
$exp = 30000;
       break;

      case 10:
$exp = 70000;
       break;

      case 11:
$exp = 150000;
       break;

      case 12:
$exp = 200000;
       break;

      case 13:
$exp = 250000;
       break;

      case 14:
$exp = 300000;
       break;

      case 15:
$exp = 400000;
       break;

      case 16:
$exp = 700000;
       break;

      case 17:
$exp = 1000000;
       break;

      case 18:
$exp = 1500000;
       break;

      case 19:
$exp = 2000000;
       break;

      case 20:
$exp = 3000000;
       break;

      case 21:
$exp = 4000000;
       break;

      case 22:
$exp = 5000000;
       break;

      case 23:
$exp = 6000000;
       break;

      case 24:
$exp = 7000000;
       break;

      case 25:
$exp = 8000000;
       break;
    }
 function clan_exp($i) {
    
    switch($i) {
    
      case 1:
$clan_exp = 10000;
       break;

      case 2:
$clan_exp = 25000;
       break;

      case 3:
$clan_exp = 50000;
       break;

      case 4:
$clan_exp = 100000;
       break;

      case 5:
$clan_exp = 200000;
       break;

      case 6:
$clan_exp = 400000;
       break;

      case 7:
$clan_exp = 800000;
       break;

      case 8:
$clan_exp = 1000000;
       break;

      case 9:
$clan_exp = 1500000;
       break;

      case 10:
$clan_exp = 3000000;
       break;

    }
    
      return $clan_exp;
    
    }
$myClan = mysql_fetch_array(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."' LIMIT 1"));
if($myClan and $myClan['exp'] >= clan_exp($myClan['level']) and $myClan['level'] != 10){
mysql_query("update `clans` set 
`level` = '".($myClan[level]+1)."', 
`exp` = '".($myClan[exp]-$myClan[exp])."' 
where (`id` = '".$myClan[id]."')");
}
$new_msg = mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `out` = '".$myID."' AND `online` = '1'"),0);
if($user['quest_1_coll'] >= 50 && $user['quest_1_time'] < time())echo '<a href="/quest.php?'.$r.'" class="link center"><img src="/icons/quest.png" width="16" height="16"> <font color="lime">Задание выполнено!</font></a>';
if($user['quest_2_coll'] >= 25 && $user['quest_2_time'] < time())echo '<a href="/quest.php?'.$r.'1" class="link center"><img src="/icons/quest.png" width="16" height="16"> <font color="lime">Задание выполнено!</font></a>';
if($user['quest_3_coll'] >= 30 && $user['quest_3_time'] < time())echo '<a href="/quest.php?'.$r.'2" class="link center"><img src="/icons/quest.png" width="16" height="16"> <font color="lime">Задание выполнено!</font></a>';
if($user['quest_4_coll'] >= 40 && $user['quest_4_time'] < time())echo '<a href="/quest.php?'.$r.'3" class="link center"><img src="/icons/quest.png" width="16" height="16"> <font color="lime">Задание выполнено!</font></a>';
if($user['quest_5_coll'] >= 1000 && $user['quest_5_time'] < time())echo '<a href="/quest.php?'.$r.'4" class="link center"><img src="/icons/quest.png" width="16" height="16"> <font color="lime">Задание выполнено!</font></a>';
if($user['quest_6_coll'] >= 5000 && $user['quest_6_time'] < time())echo '<a href="/quest.php?'.$r.'5" class="link center"><img src="/icons/quest.png" width="16" height="16"> <font color="lime">Задание выполнено!</font></a>';
echo '<div class="text center">';
if($new_msg > '0')echo '<a href="/mail/" class="link"><img src="/icons/mail.png" width="16" height="16"> <font color="lime">Новая почта +'.$new_msg.'</font></a>';
echo '<a href="/home.php" class="link">';
?>
<table width="100%">
<tr>
<td width="10%"><? echo ''.$user['level'].'ур. '; ?></td>
<td>
<? echo '<center><img src="/icons/str.png" width="16" height="16" alt="str" />'.n_f($user['str']).' <img src="/icons/def.png" width="16" height="16" alt="def" />'.n_f($user['def']).' <img src="/icons/health.png" width="16" height="16" alt="hp" />'.n_f($user['max_health']).''; ?>
</td>
<td width="10%"><? echo ''.round($user['exp']/$exp*100,1).'%'; ?></td>
</tr>
</table>
<?
echo '</a></div>';

$block = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `block` = "1" ORDER BY `id` DESC LIMIT 1');
$block = mysql_fetch_array($block);
if($block){
header('Location: /stop/block.php');
exit;
}

if($user['level'] != 25){
$progress = round($user['exp']/$exp*100,1);
if($progress > 100)$progress = 100;
?>
<? echo '<div class="exp_polos"><div class="progress" style="width:'.$progress.'%"></div></div>'; ?>
<?
}
if($user['level'] != 25 && $user['exp'] >= $exp) {
$g = 10;
mysql_query("update `users` set `level` = '".($user['level']+1)."', `exp` = '".($user['exp']-$user['exp'])."', `gold` = '".($user['gold']+$g)."',`health` = '".($user['max_health'])."' where (`id` = '".$myID."')");
if($user['level']+1 == 7 and $user['id_partner'] > 0){
mysql_query("UPDATE `users` SET `gold`=`gold`+'50' WHERE `id` = '$user[id_partner]' LIMIT 1");
$text = "Ваш друг, которого вы пригласили, получил 7 уровень. Вам начисленно 50 золота!";
mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$user['id_partner']."', `text` = '$text' , `time` = '".time()."'");
$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$user['id_partner']."' && `id_kont` = '0' LIMIT 1"));
if(!$kont){
mysql_query("INSERT INTO `kont` SET `id_user` = '".$user['id_partner']."', `id_kont` = '0', `time` = '".time()."'");
}else{
mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$user['id_partner']."' AND `id_kont` = '0'");
}
}
?>
<div class='text center'>
<font color='lime'>Вы получили новый уровень!</font>
</div>
<?
}
if($user['ob_read'] == 1 and $myClan['ob'] != NULL){
if(isset($_GET['info_off'])){
mysql_query("update `users` set `ob_read` = '0' where (`id` = '".$myID."')");
header('Location: ?');
exit();
}
echo "<div class='text center'><center><font color='lime'>Объявление клана!</font><br>$myClan[ob]


<br><a href='?info_off'><u>Скрыть объявление</u></a></div>";


}
}
if(isset($_SESSION['msg'])){
echo msg($_SESSION['msg']);
unset($_SESSION['msg']);
}
if(!isset($_SESSION['ref']) && isset($_GET['ref'])){
$_SESSION['ref'] = $_GET['ref'];
}
//титул, награда
if($user['str_train'] >= 0 && $user['str_train'] <= 9){
$titul_exp = rand(5,10);
$titul_s = rand(10,30);
}elseif($user['str_train'] >= 10 && $user['str_train'] <= 19){
$titul_exp = rand(10,15);
$titul_s = rand(15,50);
}elseif($user['str_train'] >= 20 && $user['str_train'] <= 29){
$titul_exp = rand(15,20);
$titul_s = rand(20,50);
}elseif($user['str_train'] >= 30 && $user['str_train'] <= 39){
$titul_exp = rand(15,30);
$titul_s = rand(20,60);
}elseif($user['str_train'] >= 40){
$titul_exp = rand(20,40);
$titul_s = rand(25,70);
}
//
if($user['zl_4'] == 0){
$zl = 0;
}elseif($user['zl_4'] == 1){
$zl = 25;
}
//клан
$myClans = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."'"));
if($user['id_clan'] == 0){
$clan_exp = 0;
$clan_silver = 0;
}else{
$clan_exp = "".($myClans['stat_level_3']*2)."";
$clan_silver = "".($myClans['stat_level_2']*2)."";
}
?>