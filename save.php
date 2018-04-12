<?php
require_once ('system/func.php');
$title = 'Сохранить персонаж';
require_once ('system/header.php');
auth();

if($user['save'] >= 2){
header("Location: /home.php?save");
}
echo '<div class="text center">';
if(isset($_REQUEST['success'])){
	$name = text(esc($_POST['name']));
$pass = text($_POST['pass']);
$email = text($_POST['email']);
	$sex = text($_POST['sex']);
$sql = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `login` = '$name' AND `bot` = '0'");  // Доступность логина
$m = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `email` = '$email' AND `bot` = '0'");  // Доступность почты
if(empty($name)) $err = '<div class="text center"><font color="tomato">Ошибка. Логин не введен</font></div>';
if(empty($email)) $err = '<div class="text center"><font color="tomato">Ошибка. E-mail не введен</font></div>';
elseif(empty($pass)) $err = '<div class="text center"><font color="tomato">Ошибка. Пароль не введен</font></div>';
elseif (!preg_match('|^[a-z0-9\-]+$|i', $pass)) $err = '<div class="text center"><font color="tomato">Ошибка. Пароль введен неверно</font></div>';
elseif(mysql_result($sql, 0) >= 1) $err = '<div class="text center"><font color="tomato">Ошибка. Логин занят</font></div>';
elseif(mysql_result($m, 0) >= 1) $err = '<div class="text center"><font color="tomato">Ошибка. E-mail занят</font></div>';
elseif(mb_strlen($name) > 40 or mb_strlen($name) < 1) $err = '<div class="text center"><font color="tomato">Ошибка. Логин должен быть, не длиннее 40 символов</font></div>';
elseif(mb_strlen($pass) > 40 or mb_strlen($pass) < 1) $err = '<div class="text center"><font color="tomato">Ошибка. Пароль должен быть, не длиннее 40 символов</font></div>';
	if(!$err){
if(mysql_query("UPDATE `users` SET `login` = '".$name."', `password` = '".md5(md5($pass))."', `save` = '2', `email` = '".$email."', `sex` = '".$sex."', `online` = '".time()."', `registr` = '".time()."', `gold` = '".($user['gold'] + 10)."' WHERE `id` = '".$myID."'")){
if($_SESSION['ref']){
$id = num($_SESSION['ref']);
$partner = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
if($partner and $partner['ip'] != $_SERVER['REMOTE_ADDR'] and $partner['browser'] != $_SERVER['HTTP_USER_AGENT']){
$id_user = mysql_insert_id();
mysql_query("update `users` set `id_partner` = '".$partner['id']."' where (`id` = '".$id_user."')");
}
}
}
		setcookie('login', $name, time()+86400*365, '/');
		setcookie('password', md5(md5($pass)), time()+86400*365, '/');
		header('location: /');
		exit();
		}else{
		$_SESSION['msg'] = $err;
		header('location: ?');
		exit();
		}
}
echo 'Сохраните персонажа, и получите <img src="/icons/gold.png" width="16" height="16">10 золота!<hr>';
echo '<form action="" method="post">
		Логин:<br/>
		<input type="text" name="name" maxlength="50" value="" placeholder="" /><br/>
Пароль:<br/><input type="password" name="pass" maxlength="50" value="" placeholder="" /><br/>
E-mail:<br/><input type="text" name="email" maxlength="50" value="" placeholder="" /><br/>
Пол:<br />
<input type="radio" name="sex" value="m" checked="checked"> Мужской <input type="radio" name="sex" value="w" checked="checked"> Женский<br>
<br><input type="submit" value="Сохранить персонаж" name="success" class="btn"/>
	</form>';
echo '</div>';
require_once ('system/footer.php');
?> 
