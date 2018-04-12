<?php
require_once ('../system/func.php');
$title = 'Блок';
require_once ('../system/header.php');
auth();
if($user['access'] <= 0){
header('Location: /');
}
$id = intval($_GET['id']);
if(!$id)header("Location: /");
$opponent = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $id LIMIT 1"));
if($user['access'] <= $opponent['access']){
header("Location: /hero/$id");
exit();
}elseif($id == $myID){
header("Location: /hero/");
exit();
}else{
if(isset($_GET['ok']) && isset($_POST['text'])){
$text = text($_POST[text]);
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$opponent[id].'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban = mysql_fetch_array($ban);
if(strlen($text) < 1 or strlen($text) > 500)$err = "<div class='text center'><font color='tomato'>Ошибка. Слишком длинная или короткая причина блока</font></div>";
if($ban)$err = "<div class='text center'><font color='tomato'>Ошибка. Игрок уже заблокирован</font></div>";
if(!$err){
mysql_query("INSERT INTO `ban` SET `id_user` = '$id', `id_admin` = '$myID', `text` = '$text', `block` = '1'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Блок успешно выполнен</font></div>";
header("Location: /block/$id/");
exit();
}else{
$_SESSION['msg'] = $err;
header("Location: /block/$id/");
exit();
}
}
echo "<div class='de center'>";
echo "Блок - <a href='/hero/$opponent[id]'><img src='/icons/$opponent[sex].png'> $opponent[login]</a></div>";
echo "<div class='text center'>";
echo "<form method='post' action='?ok'>";
echo "Причина:<br><input type='text' name='text' value = ''><br>";
echo "<input type='submit' class='btn' value='Выполнить блок'>";
echo "</form>";
echo "</div>";
}
require_once ('../system/footer.php');
?>