<?
$time=time();
$prog=$command['hp']/$command['max_hp']*100; 
$prog2=100-$prog;
echo'<div class="de center"><img width="16" height="16" src="/icons/basement_icon.png"> '.$title.'</div>
<div class="text">
<img width="48" height="48" src="/icons/basement/'.$boss['id'].'.png" class="icon_l">
<div><img width="16" height="16" src="/icons/basement_boss.png"> <font color="yellow"> '.$boss['name'].' </font><br> <img width="16" height="16" src="/icons/health.png"> '.$command['hp'].'/'.$command['max_hp'].'<br> <img width="16" height="16" src="/icons/str.png"> '.$command['force'].'</div>
	<div class="clr">
		<div class="progress mb5">
			<div class="empty" style="width:'.$prog.'%"></div>
			<div class="full" style="width:'.$prog2.'%"></div>
			<div class="clr"></div>
		</div>
	</div>
</div>';
if($command['time']<$time){
	mysql_query("UPDATE `basement_command` SET `act` = '0' WHERE `id` = '$command[id]'");
	$q=mysql_query("SELECT * FROM `basement_user` WHERE `damage` > '0' AND `command` = '$me[command]' ORDER BY `damage` DESC");
	$num=0;
	while($post=mysql_fetch_assoc($q)){ $num++;
		$text="Ваша команда проиграла в борьбе с монстром. Время боя истекло.";
		mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$post['id_user']."', `text` = '$text' , `time` = '".time()."'");
		$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$post['id_user']."' && `id_kont` = '0' LIMIT 1"));
		if(!$kont){
			mysql_query("INSERT INTO `kont` SET `id_user` = '".$post['id_user']."', `id_kont` = '0', `time` = '".time()."'");
		}else{
			mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$post['id_user']."' AND `id_kont` = '0'");
		}
	}
	mysql_query("DELETE FROM `basement_user` WHERE `command` = '$command[id]'");
	mysql_query("DELETE FROM `basement_command` WHERE `id` = '$command[id]'");
	header("location:".$url);
	exit;
}
if($me['hp']<=0 && $me['health']<$time && $me['health']!=0){
	mysql_query("UPDATE `basement_user` SET `health` = '0', `hp` = '$user[max_health]' WHERE `id_user` = '$user[id]'");
	header("location:".$url); exit;
}if($me['hp']<=0 && $me['health']<$time){
mysql_query("UPDATE `basement_user` SET `health` = '".($time+30)."' WHERE `id_user` = '$user[id]'");
	header("location:".$url); exit;
}

if(isset($_GET['kick']) && ($_SESSION['battle_hush']==$_GET['kick']) && $me['time_kick']<$time && $command['hp']>0 && $me['hp']>0){
	unset($_SESSION['battle_hush']);
	if($me['force']>$command['hp']) $me['force']=$command['hp'];
	if($command['force']>$me['hp']) $command['force']=$me['hp'];
	mysql_query("UPDATE `basement_command` SET `hp` = `hp` - '$me[force]' WHERE `id` = '$me[command]'");
	mysql_query("UPDATE `basement_user` SET `damage` = `damage` + '$me[force]', `time_kick` = '".($time+5)."', `hp` = `hp` - '$command[force]' WHERE `id_user` = '$user[id]'");
	header("location:".$url); exit;
}
if($command['hp']<=0){
	mysql_query("UPDATE `basement_command` SET `act` = '0' WHERE `id` = '$command[id]'");
	$q=mysql_query("SELECT * FROM `basement_user` WHERE `damage` > '0' AND `command` = '$me[command]' ORDER BY `damage` DESC");
	$num=0;
	while($post=mysql_fetch_assoc($q)){ $num++;
		$ser=intval($post['damage']/100*5); 
		$exp=intval($post['damage']/100*2);
		$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$post[id_user]' LIMIT 1"));
		//
		if($ank['id_clan'] > 0){
			mysql_query("UPDATE `users` SET `clan_exp` = `clan_exp` + $exp WHERE `id` = '".$ank['id']."' LIMIT 1");
			mysql_query("UPDATE `clans` SET `exp` = `exp` + '$exp' WHERE `id` = '".$ank['id_clan']."' LIMIT 1");
		}
		//
		$text="В борьбе с монстром вы заняли: $num место. Ваша награда: $ser серебра и $exp опыта.";
		mysql_query("UPDATE `users` SET `exp` = `exp` + '$exp', `crystals` = `crystals` + '$ser' WHERE `id` = '$post[id_user]'");
		mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$post['id_user']."', `text` = '$text' , `time` = '".time()."'");
		$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$post['id_user']."' && `id_kont` = '0' LIMIT 1"));
		if(!$kont){
			mysql_query("INSERT INTO `kont` SET `id_user` = '".$post['id_user']."', `id_kont` = '0', `time` = '".time()."'");
		}else{
			mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$post['id_user']."' AND `id_kont` = '0'");
		}
	}
	mysql_query("DELETE FROM `basement_user` WHERE `command` = '$command[id]'");
	mysql_query("DELETE FROM `basement_command` WHERE `id` = '$command[id]'");
	header("location:".$url);
	exit;
}
$hush=md5(rand(1,100000));
$_SESSION['battle_hush']=$hush;
echo'<div class="de">
<center> '.($me['health']>$time?'Ваша жизнь на нуле. Подождите восстановления.':($me['time_kick']<$time?'<a href="'.$url.'?kick='.$hush.'" class="but"> Ударить монстра </a>':'Подождите еще <font color="yellow"> <img width="16" height="16" src="/icons/clock.png"> '.tl($me['time_kick']-$time).' </font>')).'<hr><center><a href="?'.$r.'">Обновить страницу</a></center></center>
</div>
<div class="de center"> До конца боя <img width="16" height="16" src="/icons/clock.png"> <font color="yellow"> '.tl($command['time']-$time).' </font></div>';
echo'<div class="de center"> Лучшие бойцы </div>';
$q=mysql_query("SELECT * FROM `basement_user` WHERE `command` = '$me[command]' ORDER BY `damage` DESC LIMIT 5");
while($post=mysql_fetch_assoc($q)){
	$uss=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$post[id_user]' LIMIT 1"));
echo "<a href='/hero/$post[id_user]' class='link'><img src='/icons/".$uss['sex'].".png'> $uss[login], $uss[level] ур. <span style='float:right'> <img width='16' height='16' src='http://static.hata.mobi/i/icons/damage.png'> <font color='yellow'> $post[damage] </font> </span><br>";
	echo "<font color='silver'>
	".($post['health']<$time && $post['hp']>0?"Параметры: <img width='16' height='16' src='/icons/health.png'> <font color='yellow'> $post[hp] </font> | <img width='16' height='16' src='/icons/str.png'> <font color='yellow'> $post[force] </font> </font>":'Вступит в бой через: <img width="16" height="16" src="/icons/clock.png"> <font color="yellow"> '.tl($post['health']-$time).' </font>')."</a>";
}
?>