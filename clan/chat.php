<?
include '../system/func.php';
auth();
$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."'"));
if(!$clan){
$_SESSION['msg'] == '';
header('Location: /clan/menu.php');
exit();
}
if($user['clan_chat_read'] == 1){
mysql_query("UPDATE `users` SET `clan_chat_read` = '0' WHERE `id` = '".$myID."'");
header('Location: ?');
exit();
}
$title = 'Чат клана';
include '../system/header.php';
if(isset($_GET['text'])){
$text = text($_POST['text']);
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban = mysql_fetch_array($ban);
$last = mysql_query('SELECT * FROM `clanchat` WHERE `id_user` = "'.$myID.'" ORDER BY `id` DESC LIMIT 1');
$last = mysql_fetch_array($last);
if(strlen($text) < 3 or strlen($text) > 300)$err = "<div class='text center'><font color='tomato'>Ошибка. Слишком длинное или короткое сообщение</font></div>";
if($ban)$err = "<div class='text center'><font color='tomato'>На вас наложен, бан осталось ".tl($ban[last]-time())."</font></div>";
if($last['time'] > time()-5)$err = "<div class='text center'><font color='tomato'>Ошибка. Сообщения можно отправлять раз в 5 секунд</font></div>";
if(!$err){
if(mysql_query("INSERT INTO `clanchat` SET `id_user` = '$user[id]', `time` = '".time()."', `text` = '".$text."', `id_clan` = '$clan[id]'")){
mysql_query("UPDATE `users` SET `clan_chat_read` = '1' WHERE `id_clan` = '".$clan['id']."'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Сообщение отправлено</font></div>";
header('Location: /clan/chat.php');
exit();
}else{
$_SESSION['msg'] = '';
header('Location: /clan/chat.php');
exit();
}
}else{
$_SESSION['msg'] = $err;
header('Location: /clan/chat.php');
exit();
}
}
if(isset($_GET['delete_post']) and $user['clan_rang'] >= 4){
mysql_query("DELETE FROM `clanchat` WHERE `id` = '".$_GET['delete_post']."'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Сообщение успешно удалено</font></div>";
header('Location: ?');
exit();
}
echo "<div class='de center'>";
if(isset($_GET['to'])){
echo "<form method='post' action='?text'>";
$opponent = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $_GET[to] LIMIT 1"));
echo "<input type='text' name='text' value = '$opponent[login], '>";
echo "<input type='submit' class='btn' value='Отправить'>
<a href='/clan/chat/' class='btn'>Обновить</a>
</form>";
}else{
echo "<form method='post' action='?text'>";
echo "<input type='text' name='text'><br>";
echo "<input type='submit' class='btn' value='Отправить'>
<a href='?' class='btn'>Обновить</a>
</form>";
}
echo "</div>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `clanchat` WHERE `id_clan` = '$clan[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `clanchat` WHERE `id_clan` = '$clan[id]' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
if($k_post == 0) echo "<div class='text center'><font color='tomato'>Клановый чат пуст.</font></div>";
while($post = mysql_fetch_assoc($q)) {
echo "<div class='text'>";
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $post[id_user] LIMIT 1"));
echo "<a href='/hero/$ank[id]'><img src='/icons/".$ank['sex'].".png'> $ank[login]</a>, ".vremja($post['time'])." ";
if($myID != $ank['id'])echo "<a href='?to=$ank[id]'>[Отв]</a>";
$msg = str_replace(array($user['login'].','), "<b><b>$user[login]</b>,</b> ", $post['text']);
echo "<br>".text_msg($msg);
if($user['clan_rang'] >= 4)echo " <a href='?delete_post=$post[id]'><font color='red'>[×]</font></a>";
echo "</div>";
}
if($k_post > 10){
echo "<div class='text center'>";
str('?',$k_page,$page); 
echo "</div>";
}
$clan = ""; include '../system/footer.php';
?>