<?php
require_once ('system/func.php');
$title = 'Мой статус';
require_once ('system/header.php');
auth();
if($user['save'] <= 1){
header("Location: /home.php?error");
}
if(isset($_REQUEST['add'])){
$statys = text($_POST['statys']);
$sql = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `statys_text` = '$statys'");
if(empty($statys))$err = '<div class="text center"><font color="tomato">Ошибка. Статус не введен</font></div>';
if(mb_strlen($statys) > 100 or mb_strlen($statys) < 1) $err = '<div class="text center"><font color="tomato">Ошибка. Слишком короткий или длинный статус</font></div>';
if(!$err){
mysql_query("UPDATE `users` SET `statys_text` = '$statys', `statys` = '1' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Статус успешно установлен</font></div>";
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?');
exit();
}
}
echo "<div class='text center'>Смена статуса бесплатная.<br> Статус должен быть не длинее 100 символов!<hr>";
echo '<form action="" method="post">';
echo '<input type="text" name="statys" maxlength="50" value="" /><br/>';
echo '<input type="submit" name="add" class="auth_login" value="Установить"> <a href="?">Обновить</a>';
echo '</div>';
echo '<a href="/hero/" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
require_once ('system/footer.php');
?>