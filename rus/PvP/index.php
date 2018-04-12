<?
include '../../system/func.php';
$title = 'Арена';
auth();
include '../../system/header.php';
$url="/battle/pvp/";
$icons_text = '<img src="/icons/pvp/mini_logo.png" width="15" height="15">';
//восстановление энергии
if(isset($_GET['reset'])){
if($user['gold'] <= 4){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота<br><center><a href="/worldkassa/"><u>Купить золото</u></a></center></font></div>';
header('Location: ?'.$r.'');
exit();
}
if($user['arena_coll'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `arena_coll` = '5', `gold` = '".($user['gold'] - 5)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Энергия восстановлена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
if(mysql_result(mysql_query("SELECT COUNT(*) FROM `arena_lobby` WHERE `id_user` = '$user[id]'"),0)==0){
	if(isset($_GET['go'])){
if($user['arena_coll'] <= 0){
header('Location: ?'.$r.'');
exit();
}
		$hp=$user['max_health']; $force=$user['str'];
		mysql_query("INSERT INTO `arena_lobby` SET `id_user` = '$user[id]', `max_hp` = '$hp', `hp` = '$hp', `force` = '$force' ");
mysql_query("UPDATE `users` SET `arena_coll` = '".($user['arena_coll'] - 1)."' WHERE `id` = '".$myID."'");
		header("location:".$url); exit;
	}
echo '<div class="de center"> '.$icons_text.' '.$title.' ('.($user['arena_coll']).')</div> <div class="text center"><img src="/icons/pvp/logo.png" width="100%"><hr>Вы еще не встали в очередь.<hr>';
if($user['arena_coll'] >= 1){
echo '<a href="'.$url.'?go" class="but"> Встать в очередь </a></div>';
}else{
echo "Восстановиться через:  ".tl($user['arena_time']-time())."<br><a href='?reset' class=''><u>Восстановить за 5 <img src='/icons/gold.png' width='16' height='16'></u></a>";
}
}else{
	$me=mysql_fetch_assoc(mysql_query("SELECT * FROM `arena_lobby` WHERE `id_user` = '$user[id]' LIMIT 1"));
if($me['battle']!=0){include_once'battle.php'; exit();}// бой
	if(mysql_result(mysql_query("SELECT COUNT(*) FROM `arena_lobby` WHERE `battle` = '0'"),0)>=2 && $me['battle']==0){
		mysql_query("INSERT INTO `arena_battle` SET `time` = '".(time+1800)."'");
		$id_battle=mysql_insert_id();
		mysql_query("UPDATE `arena_lobby` SET `battle` = '$id_battle' WHERE `id_user` = '$user[id]'");
		mysql_query("UPDATE `arena_lobby` SET `battle` = '$id_battle' WHERE `battle` = '0' AND `id_user` != '$user[id]'");
	}
//
//покидаем очередь
if(isset($_GET['exit'])){
mysql_query("DELETE FROM `arena_lobby` WHERE `id_user` = '$user[id]'");
header("Location: ".$url);
}
//
echo '<div class="de center"> '.$icons_text.' '.$title.' ('.($user['arena_coll']).')</div> <div class="text center"><img src="/icons/pvp/logo.png" width="100%"><hr>Ожидание соперника...<hr> <a href="?" class="but"> Обновить страницу </a> </div> <div class="de text">
	Ваши характеристики: </br>
	<img width="16" height="16" src="/icons/str.png"> Урон: <font color="yellow"> '.$me['force'].' </font></br>
<img width="16" height="16" src="/icons/health.png"> Жизни: <font color="lime"> '.$me['hp'].' </font> / <font color="yellow"> '.$me['max_hp'].' </font></div>';
echo'<div class="de center"><a href='.$url.'?exit class=link> <font color="tomato"> Покинуть очередь </font> </a> </div>';
}
echo '</div>';
include '../../system/footer.php';