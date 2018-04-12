<?php
require_once ('../system/func.php');
$title = 'Бан';
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
if(isset($_GET['delete'])){
mysql_query("DELETE FROM `ban` WHERE `id` = '".$_GET['delete']."'");
$_SESSION[msg] = "<div class='text center'><font color='lime'>Нарушение успешно удалено</font></div>";
header("Location: ?");
exit();
}
if(isset($_GET['ok']) && isset($_POST['text']) && isset($_POST['last'])){
$text = text($_POST[text]);
$last = num($_POST[last]);
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$opponent[id].'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban = mysql_fetch_array($ban);
if(strlen($text) < 1 or strlen($text) > 500)$err = '<div class="text center"><font color="tomato">Ошибка. Слишко длинная или короткая причина бана</font></div>';
if($last < 1)$err = '<div class="text center"><font color="tomato">Ошибка. Бан должен быть не менее часа</font></div>';
if($ban)$err = '<div class="text center"><font color="tomato">Ошибка. Игрок уже забанен</font></div>';
if(!$err){
mysql_query("INSERT INTO `ban` SET `id_user` = '$id', `id_admin` = '$myID', `last` = '".(time()+60*60*$last)."', `text` = '$text'");
$text = "На вас наложен бан на ".$last." часов![br]Забанил: ".$user['login']."[br]Причина: ".$text."";
mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$opponent['id']."', `text` = '$text' , `time` = '".time()."'");
$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$opponent['id']."' && `id_kont` = '0' LIMIT 1"));
if(!$kont){
mysql_query("INSERT INTO `kont` SET `id_user` = '".$opponent['id']."', `id_kont` = '0', `time` = '".time()."'");
}else{
mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$opponent['id']."' AND `id_kont` = '0'");
}
$_SESSION['msg'] = '<div class="text center"><font color="lime">Игрок успешно забанен</font></div>';
header("Location: /ban/$id/");
exit();
}else{
$_SESSION[msg] = $err;
header("Location: /ban/$id/");
exit();
}
}
echo "<div class='de center'>";
echo "Бан - <a href='/hero/$opponent[id]'><img src='/icons/$opponent[sex].png'> $opponent[login]</a>";
echo "</div><div class='text center'>";
echo "<form method='post' action='?ok'>";
echo "Причина бана:<br><input type='text' name='text' value = ''><br>";
echo "Время в часах:<br><input type='text' name='last' value = '1'><br>";
echo "<input type='submit' class='btn' value='Выполнить бан'>";
echo "</form>";

echo "</div>";
echo "<div class='de'>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$id'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `ban` WHERE `id_user` = '$id' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
while($post = mysql_fetch_assoc($q)) {
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$post[id_admin]' ORDER BY `id` DESC LIMIT 1"));
echo "<hr><a href='/hero/$ank[id]'><img src='/icons/$ank[sex].png'> $ank[login]</a> | ".($user['access'] == 2 ? "<a href='?delete=$post[id]'>[х]</a>" : "").": ".text_msg($post['text'])."<br>";
if($post['block'] == 0){
if($post['last'] > time()){
echo "Активен, осталось: ".tl($post['last']-time());
}else{
echo "Не активен, истек ".vremja($post[last]);
}
}else{
echo "Заблокирован, на всегда";
}
}
echo '</div>';
if($k_post > 10){
echo '<div class="text center">';
str('?',$k_page,$page); 
echo "</div>";
}
}
require_once ('../system/footer.php');
?>