<?php 
include 'system/func.php';
$title = 'Настройки'; 
include 'system/header.php';
auth();
if(isset($_GET['exit'])){ 
setcookie('login', null, time()-86400*365, '/');
setcookie('password', null, time()-86400*365, '/');
header('location: /'); 
exit; 
} 
if(isset($_GET['password'])){
if(isset($_REQUEST['add'])){ 
$mypass = md5(md5($_POST['mypass'])); 
$pass = text($_POST['pass']); 
$repass = text($_POST['repass']);
if(empty($pass)) $err = '<div class="text center"><font color="tomato">Ошибка. Пароль не введен</font></div>';
elseif(empty($repass)) $err = '<div class="text center"><font color="tomato">Ошибка. Введите пароль еще раз</font></div>';
elseif(empty($mypass)) $err = '<div class="text center"><font color="tomato">Ошибка. Введите старый пароль</font></div>';
elseif (!preg_match('|^[a-z0-9\-]+$|i', $pass)) $err = '<div class="text center"><font color="tomato">Ошибка. Пароль введен неверно</font></div>';
elseif(mb_strlen($pass) > 50 or mb_strlen($pass) < 1) $err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинный или короткий пароль</font></div>';
elseif($pass != $repass) $err = '<div class="text center"><font color="tomato">Ошибка. Пароли не совпадают</font></div>';
elseif($mypass != $user['password']) $err = '<div class="text center"><font color="tomato">Ошибка. Старый пароль введен неверно</font></div>';
if(!$err){ 
mysql_query("UPDATE `users` SET `password` = '".md5(md5($pass))."' WHERE `id` = '".$myID."'");
setcookie('password', md5(md5($pass)), time()+86400*365, '/');
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Пароль успешно изменен</font></div>";
header('Location: ?password');
exit(); 
}else{ 
$_SESSION['msg'] = $err; 
header('Location: ?password');
exit(); 
} 
}
echo '<div class="de center"><a href="?"><img src="/icons/right.png"> <u>Настройки</u></a> / <a href="?password#'.$r.'"><img src="/icons/reset.png"> <u>Смена пароля</u></a></div>';

echo "<div class='text center'>";
echo '<form action="" method="post">';
echo 'Старый пароль:<br><input type="password" name="mypass" maxlength="50" value="" /><br/>'; 
echo 'Новый пароль:<br><input type="password" name="pass" maxlength="50" value="" /><br/>'; 
echo 'Повторите пароль:<br><input type="password" name="repass" maxlength="50" value="" /><br/>';
echo '<input type="submit" name="add" class="btn" value="Сменить пароль"> <a href="?password#'.$r.'">Обновить</a>';
echo '</form>'; 
echo "</div>";
echo '<a href="?" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
exit;
}
if(isset($_GET['nickname'])){
if(isset($_REQUEST['add'])){ 
$login = text(esc($_POST['login'])); 
$sql = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `login` = '$login'");
if(empty($login))$err = '<div class="text center"><font color="tomato">Ошибка. Ник не введен</font></div>';
if(mysql_result($sql, 0) > 0) $err = '<div class="text center"><font color="tomato">Ошибка. Ник уже занят</font></div>';
if(mb_strlen($login) > 50 or mb_strlen($login) < 1) $err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинный или короткий ник</font></div>';
if(!$err){ 
if($user['nick_raz'] >= 1 && $user['gold'] <= 149){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота</font></div>';
header('Location: ?nickname');
exit();
}
if($user['nick_raz'] == 0){
mysql_query("UPDATE `users` SET `login` = '$login', `nick_raz` = '".($user['nick_raz']+1)."' WHERE `id` = '".$myID."'");
}else{
mysql_query("UPDATE `users` SET `login` = '$login', `gold` = '".($user['gold']-150)."', `nick_raz` = '".($user['nick_raz']+1)."' WHERE `id` = '".$myID."'");
}
setcookie('login', $login, time()+86400*365, '/');
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Ник успешно изменен</font></div>";
header('Location: ?nickname');
exit(); 
}else{ 
$_SESSION['msg'] = $err; 
header('Location: ?nickname');
exit(); 
} 
}
echo '<div class="de center"><a href="?"><img src="/icons/right.png"> <u>Настройки</u></a> / <a href="?nickname#'.$r.'"><img src="/icons/reset.png"> <u>Смена ника</u></a></div>';
echo "<div class='de center'>";
if($user['nick_raz'] == 0)echo 'Первая смена ника - бесплатная!';
else
echo 'Стоимость: 150 <img src="/icons/gold.png" width="16" height="16"> золота';
echo '<br>Вы меняли ник: '.$user['nick_raz'].' раз(а)<hr>';
echo '<form action="" method="post">';
echo '<input type="text" name="login" maxlength="50" value="" /><br/>';
echo '<input type="submit" name="add" class="btn" value="Сменить ник"> <a href="?nickname#'.$r.'">Обновить</a>';
echo '</form>'; 
echo "</div>";
echo '<a href="?" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
exit;
}
if(isset($_GET['sex'])){ 
//мужской пол
if(isset($_GET['sex_m'])){
if($user['sex'] == 'm'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Пол персонажа уже мужской</font></div>';
header('Location: ?sex');
exit();
}
if($user['gold'] <= 24 && $user['sex_raz'] >= 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота</font></div>';
header('Location: ?sex');
exit();
}
if($user['sex_raz'] == 0){
mysql_query("UPDATE `users` SET `sex` = 'm', `sex_raz` = '".($user['sex_raz'] + 1)."' WHERE `id` = '".$myID."'");
}else{
mysql_query("UPDATE `users` SET `sex` = 'm', `gold` = '".($user['gold'] - 25)."', `sex_raz` = '".($user['sex_raz'] + 1)."' WHERE `id` = '".$myID."'");
}
$_SESSION['msg'] = '<div class="text center"><font color="lime">Пол персонажа успешно изменен</font></div>';
header('Location: ?sex');
exit();
}
//
//женский пол
if(isset($_GET['sex_w'])){
if($user['sex'] == 'w'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Пол персонажа уже женский</font></div>';
header('Location: ?sex');
exit();
}
if($user['gold'] <= 24 && $user['sex_raz'] >= 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. У вас недостаточно золота</font></div>';
header('Location: ?sex');
exit();
}
if($user['sex_raz'] == 0){
mysql_query("UPDATE `users` SET `sex` = 'w', `sex_raz` = '".($user['sex_raz'] + 1)."' WHERE `id` = '".$myID."'");
}else{
mysql_query("UPDATE `users` SET `sex` = 'w', `gold` = '".($user['gold'] - 25)."', `sex_raz` = '".($user['sex_raz'] + 1)."' WHERE `id` = '".$myID."'");
}
$_SESSION['msg'] = '<div class="text center"><font color="lime">Пол персонажа успешно изменен</font></div>';
header('Location: ?sex');
exit();
}
//
//станица 
echo '<div class="de center"><a href="?"><img src="/icons/right.png"> <u>Настройки</u></a> / <a href="?sex#'.$r.'"><img src="/icons/reset.png"> <u>Смена пола</u></a></div>';
echo '<div class="text center"><img src="/icons/max-'.$user['sex'].'.png" width="150" height="200"><hr>';
if($user['sex_raz'] == 0)echo 'Первая смена пола - бесплатная!';
else
echo 'Стоимость: 25 <img src="/icons/gold.png" width="16" height="16"> золота';
echo '<br>Вы меняли пол: '.$user['sex_raz'].' раз(а)</div>';
echo '<div class="de center">Вы хотите сменить пол на ';
if($user['sex'] == 'w')echo 'мужской?';
else
if($user['sex'] == 'm')echo 'женский?';
//space

if($user['sex'] == 'w')echo '<br><a href="?sex&sex_m" class="but">Сменить пол</a>';
if($user['sex'] == 'm')echo '<br><a href="?sex&sex_w" class="but">Сменить пол</a>';
echo '</div>';
echo '<a href="?" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
//
include 'system/footer.php';
exit;
} 
echo "<div class='de center'>Настройки персонажа</div>";
echo "<a href='?nickname' class='link'><img src='/icons/back.png' width='16' height='16'> Изменить ник</a>";
echo "<a href='?sex' class='link'><img src='/icons/back.png' width='16' height='16'> Изменить пол</a>";
echo "<a href='?password' class='link'><img src='/icons/back.png' width='16' height='16'> Изменить пароль</a>";
echo "<a href='?exit' class='link'><img src='/icons/back.png' width='16' height='16'> Выйти из игры</a>";
include 'system/footer.php';
?>