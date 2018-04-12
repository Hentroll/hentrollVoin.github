<?php
require_once ('../system/func.php');
$title = 'Редактор подземелья';
auth();
require_once ('../system/header.php');
if($user['access'] <=1){header('Location: /');}
echo '<div class="de center">Админка подземелья</div>';
if(isset($_GET['del'])){
	$del=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1"));
	if(isset($_GET['ok'])){
		unlink("../icons/basement/".$edit['id'].".png");
		mysql_query("DELETE FROM `basement` WHERE `id` = '$del[id]'");
		header("location:/mahaker/basement.php");
	}
	echo'<div class="de"> Вы действительно хотите удалить босса <font color="violet"> '.hsc($del['name']).' </font>? </div>';
	echo'<center> <a class="link" href=/mahaker/basement.php?del='.$del['id'].'&ok> <font color="lime"> Удалить босса </font>  </a> <a class="link" href=/mahaker/basement.php> <font color="red"> Нет, отказываюсь </font> </a> </center>';
	echo '<a href="/mahaker/basement.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
	require_once ('../system/footer.php');
	exit;
}
if(isset($_GET['edit'])){
	$edit=mysql_fetch_assoc(mysql_query("SELECT * FROM `basement` WHERE `id` = '".intval($_GET['edit'])."' LIMIT 1"));
	if(isset($_GET['ch_img'])){
		if(isset($_POST['ch_imgs'])){
			if(isset($_FILES['file'])){
				$type = $_FILES['file']['type'];
				if ($type!=='image/jpeg' && $type!=='image/jpg' && $type!=='image/gif' && $type!=='image/png'){$err=1;err_game('Это не картинка');}
			}
			if(empty($err)){
				$tmp = $_FILES['file']['tmp_name'];
				unlink("../icons/basement/".$edit['id'].".png");
				move_uploaded_file($tmp, "../icons/basement/".$edit['id'].".png");
				header("location:/mahaker/basement.php");
			}
		}
		echo'<div class="de">
		Текущая картинка: <img width="22" height="22" src="/icons/basement/'.$edit['id'].'.png"> <br>
		<form method="post" enctype="multipart/form-data"> 
		Выберите новую картинку:</br><input type="file" name="file"></br>
		<input type="submit" name="ch_imgs" value="Заменить изображение"> </form></div>';
		echo '<a href="/mahaker/basement.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
		require_once ('../system/footer.php');
		exit;
	}
	if(isset($_POST['edits'])){
		$name=mysql_real_escape_string($_POST['name']);
		$hp=abs(intval($_POST['hp']));
		$force=abs(intval($_POST['force']));
		$times=abs(intval($_POST['time']))*60;
		$count_member=abs(intval($_POST['count_member']));
		if($name==null || $name==""){
			$err=1; err_game("Не введено имя босса");
		}
		if(empty($err)){
			mysql_query("UPDATE `basement` SET `name` = '$name', `hp` = '$hp', `force` = '$force', `count_member` = '$count_member', `time` = '$times' WHERE `id` = '$edit[id]'");
			header("location:/mahaker/basement.php");
		}
	}
	echo'<div class="de"> <form method="post" enctype="multipart/form-data">
	Введите название босса: </br> <input type="text" name="name" value="'.hsc($edit['name']).'"></br>
	Введите HP босса: </br> <input type="number" name="hp" value="'.($edit['hp']).'"> </br> 
	Введите силу босса: </br> <input type="number" name="force" value="'.($edit['force']).'"> </br>
	Введите время боя(в минутах):</br><input type="number" name="time" value="'.($edit['time']/60).'"></br>
	Введите максимальное кол-во участников:</br><input type="number" name="count_member" value="'.($edit['count_member']).'"></br>
	<input type="submit" name="edits" value="Обновить босса"></form></div>';
	echo '<a href="/mahaker/basement.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
	require_once ('../system/footer.php');
	exit;
}
if(isset($_GET['add'])){
	if(isset($_POST['adds'])){
		if(isset($_FILES['file'])){
			$type = $_FILES['file']['type'];
			if ($type!=='image/jpeg' && $type!=='image/jpg' && $type!=='image/gif' && $type!=='image/png'){$err=1;err_game('Это не картинка');}
		}
		$name=mysql_real_escape_string($_POST['name']);
		$hp=abs(intval($_POST['hp']));
		$force=abs(intval($_POST['force']));
		$times=abs(intval($_POST['time']))*60;
		$count_member=abs(intval($_POST['count_member']));
		if($name==null || $name==""){
			$err=1; err_game("Не введено имя босса");
		}
		if(empty($err)){
			mysql_query("INSERT INTO `basement` SET `name` = '$name', `hp` = '$hp', `force` = '$force', `count_member` = '$count_member', `time` = '$times'");
			$tmp = $_FILES['file']['tmp_name'];
			move_uploaded_file($tmp, "../icons/basement/".mysql_insert_id().".png");
			header("location:/mahaker/basement.php");
		}
	}
	echo'<div class="de"> <form method="post" enctype="multipart/form-data">
	Введите название босса: </br> <input type="text" name="name"></br>
	Введите HP босса: </br> <input type="number" name="hp"> </br> 
	Введите силу босса: </br> <input type="number" name="force"> </br>
	Введите время боя(в минутах):</br><input type="number" name="time"></br>
	Введите максимальное кол-во участников:</br><input type="number" name="count_member"></br>
	Выберите картинку: </br><input type="file" name="file"></br>
	<input type="submit" name="adds" value="Добавить босса"></form></div>';
	echo '<a href="/mahaker/basement.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
	require_once ('../system/footer.php');
	exit;
}
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `basement`"),0);
if($k_post==0){echo'<div class="de"> Список пуст </div>';}
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `basement` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
while($post= mysql_fetch_assoc($q)){
	echo'<div class="de"> 
	<a href=/mahaker/basement.php?edit='.$post['id'].'&ch_img><img width="48" height="48" src="/icons/basement/'.$post['id'].'.png" class="icon_l"></a>
	<div> <a href=/mahaker/basement.php?edit='.$post['id'].'> <font color="violet"> '.hsc($post['name']).' </font> </a> | <a href=/mahaker/basement.php?del='.$post['id'].'> <font color="red"> Удалить </font> </a> </div>
	<div> <img width="16" height="16" src="/icons/health.png"> <font color="tomato"> '.$post['hp'].' </font> |
	<img width="16" height="16" src="/icons/str.png"> <font color="yellow"> '.$post['force'].' </font> </div>
	<div> Время боя: <img width="16" height="16" src="/icons/clock.png"> <font color="yellow"> '.tl($post['time']).' </font> | Участники: <font color="yellow"> '.$post['count_member'].' </font> </div><div style="clear:both"></div>
	</div>';
}
echo '</div>';
if($k_post > 10){
echo '<div class="link center">';str('?',$k_page,$page); echo "</div>";}
echo '<a href="/mahaker/basement.php?add" class="link"><img src="/icons/right.png" width="16" height="16"> Добавить босса</a>';
echo '<a href="/mahaker/mahaker_panel.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
require_once ('../system/footer.php');
exit;
?>