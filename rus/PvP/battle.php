<?
$rival=mysql_fetch_assoc(mysql_query("SELECT * FROM `arena_lobby` WHERE `battle` = '$me[battle]' AND `id_user` != '$user[id]' LIMIT 1"));
$rival_us=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$rival[id_user]' LIMIT 1"));
$time=time();
$prog=$rival['hp']/$rival['max_hp']*100;  $prog3=$me['hp']/$me['max_hp']*100; 
$prog2=100-$prog; $prog4=100-$prog3;
//вывод урона
if($rival['hp'] == $rival['max_hp']){
$uron = '';
}else{
$uron = '<font color="tomato">-'.($user['str']*30/100).'</font>';
}
//
echo '<div class="de center">'.$icons_text.' Арена: бой </div>';
echo'<div class="text">
<img width="48" height="48" src="/icons/max-m.png" class="icon_l">
<div><img width="16" height="16" src="/icons/basement_boss.png"> <font color="yellow"> '.$rival_us['login'].' </font> '.$uron.'<br> <img width="16" height="16" src="/icons/health.png"> '.$rival['hp'].'/'.$rival['max_hp'].'<br> <img width="16" height="16" src="/icons/str.png"> '.$rival['force'].'</div>
	<div class="clr">
		<div class="progress mb5">
			<div class="empty" style="width:'.$prog.'%"></div>
			<div class="full" style="width:'.$prog2.'%"></div>
			<div class="clr"></div>
		</div>
	</div>
</div>';
if(isset($_GET['kick']) && $rival['hp']>0 && $rival['hp']>0 && $me['time_kick']<$time){
	if($me['force']>$rival['hp']) $me['force']=$rival['hp'];
	if($rival['force']>$me['hp']) $rival['force']=$me['hp'];
mysql_query("UPDATE `arena_lobby` SET `hp` = `hp` - '".($user['str']*30/100)."' WHERE `id` = '$rival[id]'");
mysql_query("UPDATE `arena_lobby` SET `time_kick` = '".($time+3)."' WHERE `id` = '$me[id]'");
	header("location:".$url); exit;
}
if($me['hp']<=0 || $rival['hp']<=0){
	if($me['hp']<=0){
$win_exp=intval($rival['force']/100*30);
$win_crist=intval($rival['force']/100*40); // для победителя
		$lose_exp=15; $lose_crist=50;// для проигравшего
		//====Начисление проигравшему====//
			$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$me[id_user]' LIMIT 1"));
			if($ank['id_clan'] > 0){
				mysql_query("UPDATE `users` SET `clan_exp` = `clan_exp` + $lose_exp WHERE `id` = '".$ank['id']."' LIMIT 1");
				mysql_query("UPDATE `clans` SET `exp` = `exp` + '$lose_exp' WHERE `id` = '".$ank['id_clan']."' LIMIT 1");
			}
			$text="Сражаясь на арене, вы проиграли![br]Ваша награда: $lose_crist серебра и $lose_exp опыта.";
			mysql_query("UPDATE `users` SET `exp` = `exp` + '$lose_exp', `crystals` = `crystals` + '$lose_crist' WHERE `id` = '$ank[id]'");
			mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$ank['id']."', `text` = '$text' , `time` = '".time()."'");
			$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$ank['id']."' && `id_kont` = '0' LIMIT 1"));
			if(!$kont){
				mysql_query("INSERT INTO `kont` SET `id_user` = '".$ank['id']."', `id_kont` = '0', `time` = '".time()."'");
			}else{
				mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$ank['id']."' AND `id_kont` = '0'");
			}
		//=======================================//
		//====Начисление победителю====//
			$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$rival[id_user]' LIMIT 1"));
			if($ank['id_clan'] > 0){
				mysql_query("UPDATE `users` SET `clan_exp` = `clan_exp` + $win_exp WHERE `id` = '".$ank['id']."' LIMIT 1");
				mysql_query("UPDATE `clans` SET `exp` = `exp` + '$win_exp' WHERE `id` = '".$ank['id_clan']."' LIMIT 1");
			}
			$text="В бою на арене Вы одержали победу![br]Ваша награда: $win_crist серебра и $win_exp опыта.";
			mysql_query("UPDATE `users` SET `exp` = `exp` + '$win_exp', `crystals` = `crystals` + '$win_crist' WHERE `id` = '$ank[id]'");
			mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$ank['id']."', `text` = '$text' , `time` = '".time()."'");
			$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$ank['id']."' && `id_kont` = '0' LIMIT 1"));
			if(!$kont){
				mysql_query("INSERT INTO `kont` SET `id_user` = '".$ank['id']."', `id_kont` = '0', `time` = '".time()."'");
			}else{
				mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$ank['id']."' AND `id_kont` = '0'");
			}
		//=======================================//
		mysql_query("DELETE FROM `arena_lobby` WHERE `id_user` = '$user[id]'");
		mysql_query("DELETE FROM `arena_lobby` WHERE `id_user` = '$rival[id]'");
		mysql_query("DELETE FROM `arena_battle` WHERE `id` = '$me[battle]'");
		// Вы проиграли
		header("location:".$url); exit;
	}elseif($rival['hp']<=0){
$win_exp=intval($rival['force']/100*30);
$win_crist=intval($rival['force']/100*40); // для победителя
$lose_exp=15; $lose_crist=50;// для проигравшего
		//====Начисление проигравшему====//
			$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$rival[id_user]' LIMIT 1"));
			if($ank['id_clan'] > 0){
				mysql_query("UPDATE `users` SET `clan_exp` = `clan_exp` + $lose_exp WHERE `id` = '".$ank['id']."' LIMIT 1");
				mysql_query("UPDATE `clans` SET `exp` = `exp` + '$lose_exp' WHERE `id` = '".$ank['id_clan']."' LIMIT 1");
			}
			$text="Сражаясь на арене, вы проиграли![br]Ваша награда: $lose_crist серебра и $lose_exp опыта.";
			mysql_query("UPDATE `users` SET `exp` = `exp` + '$lose_exp', `crystals` = `crystals` + '$lose_crist' WHERE `id` = '$ank[id]'");
			mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$ank['id']."', `text` = '$text' , `time` = '".time()."'");
			$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$ank['id']."' && `id_kont` = '0' LIMIT 1"));
			if(!$kont){
				mysql_query("INSERT INTO `kont` SET `id_user` = '".$ank['id']."', `id_kont` = '0', `time` = '".time()."'");
			}else{
				mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$ank['id']."' AND `id_kont` = '0'");
			}
		//=======================================//
		//====Начисление победителю====//
			$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$me[id_user]' LIMIT 1"));
			if($ank['id_clan'] > 0){
				mysql_query("UPDATE `users` SET `clan_exp` = `clan_exp` + $win_exp WHERE `id` = '".$ank['id']."' LIMIT 1");
				mysql_query("UPDATE `clans` SET `exp` = `exp` + '$win_exp' WHERE `id` = '".$ank['id_clan']."' LIMIT 1");
			}
			$text="В бою на арене Вы одержали победу![br]Ваша награда: $win_crist серебра и $win_exp опыта.";
			mysql_query("UPDATE `users` SET `exp` = `exp` + '$win_exp', `crystals` = `crystals` + '$win_crist' WHERE `id` = '$ank[id]'");
			mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$ank['id']."', `text` = '$text' , `time` = '".time()."'");
			$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$ank['id']."' && `id_kont` = '0' LIMIT 1"));
			if(!$kont){
				mysql_query("INSERT INTO `kont` SET `id_user` = '".$ank['id']."', `id_kont` = '0', `time` = '".time()."'");
			}else{
				mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$ank['id']."' AND `id_kont` = '0'");
			}
		//=======================================//
		mysql_query("DELETE FROM `arena_lobby` WHERE `id_user` = '$user[id]'");
		mysql_query("DELETE FROM `arena_lobby` WHERE `id_user` = '$rival[id]'");
		mysql_query("DELETE FROM `arena_battle` WHERE `id` = '$me[battle]'");
		// Вы выиграли
		header("location:".$url); exit;
	}
}
echo'<div class="de center">
<center> '.($me['time_kick']<$time?'<a href="'.$url.'?kick" class="but"> Бить противника </a>':'Подождите еще <font color="yellow"> <img width="16" height="16" src="/icons/clock.png"> '.tl($me['time_kick']-$time).' </font>').'<hr><center><a href="?'.$r.'">Обновить страницу</a></center></center>
</div>';
echo'<div class="text">
<img width="48" height="48" src="/icons/max-m.png" class="icon_l">
<div><img width="16" height="16" src="/icons/basement_boss.png"> <font color="yellow"> '.$users['login'].' </font><br> <img width="16" height="16" src="/icons/health.png"> '.$me['hp'].'/'.$me['max_hp'].'<br> <img width="16" height="16" src="/icons/str.png"> '.$me['force'].'</div>
	<div class="clr">
		<div class="progress mb5">
			<div class="empty" style="width:'.$prog3.'%"></div>
			<div class="full" style="width:'.$prog4.'%"></div>
			<div class="clr"></div>
		</div>
	</div>
</div>';include '../../system/footer.php';

?>