<?php
require_once ('../system/func.php');
if($user['access'] <= 1){
header('Location: /');
}
auth();
$title = 'Рефералы';
require_once ('../system/header.php');
if(isset($_REQUEST['search_nick'])){
$login = text($_POST[login]);
if(empty($login)){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Логин не введен</font></div>';
header("Location: ?");
exit();
}else{
$sql = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `login` = '".$login."' LIMIT 1"));
if(!$sql){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Игрок не найден</font></div>';
header('Location: ?');
exit();
}
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id_partner` = '$sql[id]' AND `ip` != '$sql[ip]'"),0);
$_SESSION['msg'] = "<div class='text'>Игрок: $sql[login]<br>Реффералов: [$k_post]</div>";
header('Location: ?');
exit();
}
}
echo "<div class='text center'>";
echo '<form action="?search" method="post">';
echo 'Логин:<br><input class="center" type="text" name="login" maxlength="50" value="" /><br/>';
echo '<input type="submit" name="search_nick" class="btn" value="Проверить">';
echo '</form>';
echo "</div>";
echo "<a href='/mahaker/mahaker_panel.php' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
require_once ('../system/footer.php');
?>