<?php
include 'system/func.php';
noauth();
include 'system/header.php';


$r=rand(100,1000000);
$name ="Легенда_$r";
$pass = rand (10000,44454545);

if(isset($_GET['start_game'])){	
if($user['id'] ==0){
if(mysql_query("INSERT INTO `users` SET `login` = '".$name."', `password` = '".md5($pass)."', `sex` = 'unk', `side` = 'good', `str` = '10', `def` = '10', `max_health` = '10', `save` = '1', `registr` = '".time()."', `online` = '".time()."', `coll_adven` = '15', `exp` = '10'"))
{
if($_SESSION['ref']){
$id = mysql_insert_id();
mysql_query("update `users` set `id_partner` = '".$_SESSION['ref']."' where (`id` = '".$id."')");
}
setcookie('login', $name, time()+86400*365, '/');
setcookie('password', md5($pass), time()+86400*365, '/');
header('location: /');
exit();
}else{
header ('Location: /');
}
}
}
echo '<img src="/icons/logo.png" width="100%">';
echo '<div class="text center"><font color="gold">Легенда</font> - Сражайся до последней капли крови, и стань легендой этого мира!</div>';
echo '<div class="de center">';
echo '<center><a class="but" href="?start_game">Начать Сражаться</a></center>';
echo '</div><div class="text center">';

if(isset($_REQUEST['success'])){
	$name = text($_POST['nickname']);
	$pass = text($_POST['password']);
	
$sql = mysql_fetch_array(mysql_query("SELECT `login`,`password` FROM `users` WHERE `login` = '".$name."' and `password`='".md5(md5($pass))."' LIMIT 1"));
	
	if(empty($name)) msg('<div class="de center"><font color="tomato">Ошибка. Неверный логин или пароль</font></div>');
	elseif(empty($pass)) msg('<div class="de center"><font color="tomato">Ошибка. Неверный логин или пароль</font></div>');
	elseif($sql == 0) msg('<div class="de center"><font color="tomato">Ошибка. Неверный логин или пароль</font></div>');
	else {
		setcookie('login', $name, time()+86400*365, '/');
		setcookie('password', md5(md5($pass)), time()+86400*365, '/');
		header('location: /');
	}
}
echo '
	<form action="" method="post">
		Логин:<br/>
<input class="center" type="text" name="nickname" maxlength="50" value="" /><br/>
		Пароль:<br/>
<input class="center" type="password" name="password" maxlength="50" value="" /><br/>
		
<input type="submit" name="success" class="btn" value="Продолжить"></form><br><a href="/recovery.php" class="center"><font color="gold"><u>Забыли пароль?</u></font></a>';
echo '</div>';
include 'system/footer.php';
?>