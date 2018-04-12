<?php
include '../../system/func.php';
$title = 'Подземелье';
auth();
include '../../system/header.php';
$url=hsc('/battle/basement/');
if(mysql_result(mysql_query("SELECT COUNT(*) FROM `basement_user` WHERE `id_user` = '$user[id]' "),0)==0){
	if(isset($_GET['all_command'])){
echo '<div class="de center"><img width="16" height="16" src="/icons/basement_icon.png"> Подземелье</div>';
		$q=mysql_query("SELECT * FROM `basement_command` WHERE `act` = '0'  ORDER BY `id` DESC");
if(mysql_num_rows($q)==0){echo'<div class="de center"> Список команд пуст. </div>';}
		else{
			$num=0;
			if(isset($_GET['go']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `basement_command` WHERE `id` = '".intval($_GET['go'])."' AND `act` = '0' "),0)>0){
				$command=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement_command` WHERE `id` = '".intval($_GET['go'])."' LIMIT 1"));
				$count_member=mysql_result(mysql_query("SELECT COUNT(*) FROM `basement_user` WHERE `command` = '$command[id]'"),0);
				if($count_member>=$command['max_member']){
					err_game("Команда полная");
				}else{
					$hp=$user['max_health']; $force=$user['str'];
					mysql_query("INSERT INTO `basement_user` SET `command` = '".$command['id']."', `id_user` = '$user[id]', `hp` = '$hp', `force` = '$force'");
					header("location:".$url);
					exit;
				}
			}
			while($post=mysql_fetch_assoc($q)){ $num++;
				$boss=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement` WHERE `id` = '$post[boss]' LIMIT 1"));
				$uss=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$post[admin]' LIMIT 1"));
				$count_member=mysql_result(mysql_query("SELECT COUNT(*) FROM `basement_user` WHERE `command` = '$post[id]'"),0);
echo'<div class="text"><a href='.$url.'?all_command&go='.$post['id'].'>Команда: '.hsc($post['name']).' </a>
				<font color="grey">(<font color="'.($count_member>=$post['max_member']?'red':'lime').'"> '.$count_member.'</font> /<font color="red">'.$post['max_member'].'</font>)</font>
				</br> 
Босс: <font color="violet">'.$boss['name'].'</font><br>Лидер: '.nick($post['admin']).' </div>';
			}
		}
		echo '<a href="'.$url.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
		require_once ('../../system/footer.php');
		exit;
	}
	if(isset($_GET['new_command'])){
		if(isset($_GET['go']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `basement` WHERE `id` = '".intval($_GET['go'])."'"),0)>0){
			$boss=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement` WHERE `id` = '".intval($_GET['go'])."' LIMIT 1"));
			if(isset($_POST['add_command'])){
				$name=mysql_real_escape_string($_POST['name']);
				$hp=$user['max_health']; $force=$user['str'];
				if(isset($name)){
					mysql_query("INSERT INTO `basement_command` SET `name` = '$name', `boss` = '$boss[id]', `admin` = '$user[id]', `act` = '0', `max_member` = '$boss[count_member]', `hp` = '$boss[hp]', `max_hp` = '$boss[hp]', `force` = '$boss[force]'");
					mysql_query("INSERT INTO `basement_user` SET `command` = '".mysql_insert_id()."', `id_user` = '$user[id]', `hp` = '$hp', `force` = '$force'");
					header("location:".$url);
					exit;
				}else{ err_game("Не введено название команды"); }
			}
echo '<div class="de center"><img width="16" height="16" src="/icons/basement_icon.png"> '.$title.'</div>';
echo'<div class="text">
<div class="oh"><img width="50" height="50" src="/icons/basement/'.$boss['id'].'.png"></div><img width="16" height="16" src="/icons/basement_boss.png"> <font color="yellow"> '.hsc($boss['name']).' </font><br><img width="16" height="16" src="/icons/health.png"> <font color="tomato"> '.hsc($boss['hp']).' </font><br><img width="16" height="16" src="/icons/str.png"> <font color="tomato"> '.hsc($boss['force']).' </font><hr>
<center><form method="post">
Название команды: <input type="text" name="name"> </br>
<input type="submit" name="add_command" value="Создать команду"></form> </center></div>';
echo '<a href="?new_command" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
			require_once ('../../system/footer.php');
			exit;
		}
echo '<div class="de center"><img width="16" height="16" src="/icons/basement_icon.png"> '.$title.'</div>';
		$set['p_str'] = 10;
		$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `basement`"),0);
		if($k_post==0){echo'<div class="de"> Список пуст </div>';}
		$k_page = k_page($k_post,$set['p_str']);
		$page = page($k_page);
		$start = $set['p_str']*$page-$set['p_str'];
		$q = mysql_query("SELECT * FROM `basement` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
		while($post= mysql_fetch_assoc($q)){
			echo'<div class="de"><img width="48" height="48" src="/icons/basement/'.$post['id'].'.png" class="icon_l">
			<div> <a href='.$url.'?new_command&go='.$post['id'].'> <font color="violet"> '.hsc($post['name']).' </font> </a> </div>
			<div> <img width="16" height="16" src="/icons/health.png"> <font color="tomato"> '.$post['hp'].' </font> |
			<img width="16" height="16" src="/icons/str.png"> <font color="yellow"> '.$post['force'].' </font> </div>
			<div> Время боя: <img width="16" height="16" src="/icons/clock.png"> <font color="yellow"> '.tl($post['time']).' </font> | Участники: <font color="yellow"> '.$post['count_member'].' </font> </div><div style="clear:both"></div>
			</div>';
		}
		echo '</div>';
		if($k_post > 10){
		echo '<div class="link center">';str('?',$k_page,$page); echo "</div>";}
		echo '<a href="'.$url.'" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
		require_once ('../../system/footer.php');
		exit;
	}
echo '<div class="de center"><img width="16" height="16" src="/icons/basement_icon.png"> Подземелье</div>';
echo '<div class="text center"><img src="/icons/basement.png" width="100%" height="90"><hr><font color="silver">Сражайся с боссами, побеждай и получай награду!</font></div>';
echo'<div class="text center"><a href="'.$url.'?new_command" class="but"> Создать команду </a> <hr>';
echo'<a href='.$url.'?all_command>Список команд</a>: '.mysql_result(mysql_query("SELECT COUNT(*) FROM `basement_command` WHERE `act` = '0'"),0).' </div>';
}else{
	$me=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement_user` WHERE `id_user` = '$user[id]' LIMIT 1"));
	$command=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement_command` WHERE `id` = '$me[command]' LIMIT 1"));
	$boss=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement` WHERE `id` = '$command[boss]' LIMIT 1"));
	if($command['act']==0){
		if(isset($_GET['exit'])){
			if($command['admin']==$user['id']){
				$rand_us=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement_user` WHERE `command` = '$command[id]'  AND `id_user` != '$user[id]' ORDER BY RAND() LIMIT 1"));
				mysql_query("UPDATE `basement_command` SET `admin` = '$rand_us[id_user]' WHERE `id` = '$command[id]'");
			}
			mysql_query("DELETE FROM `basement_user` WHERE `id_user` = '$user[id]'");
			if(mysql_result(mysql_query("SELECT COUNT(*) FROM `basement_user` WHERE `command` = '$command[id]' AND `id_user` != '$user[id]'"),0)==0){
				mysql_query("DELETE FROM `basement_command` WHERE `id` = '$command[id]'");
			}
			header("location:".$url); exit;
		}
		if(isset($_GET['start']) && ($command['admin']==$user['id'])){
			mysql_query("UPDATE `basement_command` SET `act` = '1', `time` = '".(time()+$boss['time'])."' WHERE `id` = '$command[id]'");
			header("location:".$url); exit;
		}
echo '<div class="de center"><img width="16" height="16" src="/icons/basement_icon.png"> Подземелье</div>';
echo '<div class="text">
Команда: <font color="yellow"> '.hsc($command['name']).' </font> </br>
Лидер: '.nick($command['admin']).' </br>
		Монстр: <font color="violet">'.hsc($boss['name']).' </font> <font color="grey">(<img width="16" height="16" src="/icons/str.png"><font color="yellow">'.n_f($boss['force']).'</font> | 
		<img width="16" height="16" src="/icons/health.png"><font color="yellow">'.n_f($boss['hp']).'</font> )</font></br>
Макс. участников: <font color="yellow"> '.$command['max_member'].' </font> <hr>
		'.($command['admin']==$user['id']?'<center><a class=but href='.$url.'?start> Начать бой </a></center>':null).'
<hr><center><a href="?'.$r.'">Обновить страницу</a></center></div>
		<div class="de"> <center> Список участников: </center></div>';
		$q=mysql_query("SELECT * FROM `basement_user` WHERE `command` = '$me[command]'");
echo '<div class="text">';
		while($post=mysql_fetch_assoc($q)){
			$uss=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$post[id_user]' LIMIT 1"));
echo "<a href='/hero/$post[id_user]' class='link'><img src='/icons/".$uss['sex'].".png'> $uss[login], $uss[level] ур.<br>";
			echo "<font color='silver'>Параметры:  ".n_f($uss['str']+$uss['def']+$uss['max_health'])."</font></a>";
		}
echo '</div>';
		echo'<center> <a href='.$url.'?exit class=link> <font color="red"> Покинуть команду </font> </a> </center>';
	}else{
		include_once'battle.php'; // сам бой
	}
}
include '../../system/footer.php';
?>