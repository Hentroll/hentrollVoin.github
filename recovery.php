<?php
include 'system/func.php';
noauth();
$title = 'Восстановление пароля';
include 'system/header.php';
if(isset($_REQUEST['add'])){
$login = text($_POST['login']);
$mail = text($_POST['mail']);
$sql = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `login` = '".$login."' LIMIT 1"));
if(empty($login))$err = '<div class="text center"><font color="tomato">Ошибка. Логин не введен</font></div>';
if(empty($mail))$err = '<div class="text center"><font color="tomato">Ошибка. E-mail не введен</font></div>';
if(!$sql)$err = '<div class="text center"><font color="tomato">Ошибка. Пользователь не найден</font></div>';
if($mail != $sql['email'])$err = '<div class="text center"><font color="tomato">Ошибка. E-mail введен неверно</font></div>';
if(!$err){
$rou = rand(1000000000, 5000000000);
mysql_query("UPDATE `users` SET `password` = '".md5(md5($rou))."' WHERE `login` = '".$login."'");
$msg = 'Здравствуйте '.$login.'!

Ваш новый пароль: '.$rou.'

С ув.администрация проекта - Легенда!';
$subject = 'Восстановление пароля';
mail($sql['email'],$subject,$msg,"From: recovery@mleg.mobi");
$_SESSION['msg'] = '<div class="text center"><font color="green">Письмо с новым паролем отправлено</font></div>';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?');
exit();
}
}
echo "<div class='de center'>".$title."</div>";
echo "<div class='text center'>";
echo '<form action="?search" method="post">';
echo 'Логин:<br><input type="text" name="login" maxlength="50" value="" /><br/>';
echo 'E-mail:<br><input type="text" name="mail" maxlength="50" value="" /><br/>';
echo '<input type="submit" name="add" class="btn" value="Продолжить">';
echo '</form>';
echo "</div>";
echo '<a href="/" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
?>