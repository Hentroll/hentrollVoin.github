<?php
include 'system/func.php';
$title = 'Чат';
include 'system/header.php';
auth();

if($user['save'] <= 1){
header("Location: /home.php?error");
}
if(isset($_GET['smiles'])){
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='?' class='des'><font color='silver'>Чат</font></a></td> <td style='width: 50%;' class='center'><a href='?md' class='des'><font color='silver'>Модераторы</font></a></td></tr></table></div>";
echo '<div class="text">';
$sql = mysql_query("SELECT * FROM `smile` ");
while($smile = mysql_fetch_array($sql)){
echo "<img src='".$smile['img']."'> ".$smile['name']."<hr>";
}
echo "</div>";
echo '<a href="?" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
exit;
}

if(isset($_GET['md'])){
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='/chat.php' class='des'><font color='silver'>Чат</font></a></td> <td style='width: 50%;' class='center'><a href='/chat.php?smiles' class='des'><font color='silver'>Смайлы</font></a></td></tr></table></div>";

echo "<div class='de center'>Модераторы</div><div class='text'>";
$q = mysql_query("SELECT * FROM `users` WHERE `access` > '0' ORDER BY `online` DESC");
while($post = mysql_fetch_assoc($q)) {
echo "<a href='/hero/$post[id]' class='link'><img src='/icons/".$post['sex'].".png'> $post[login] ";
if($post['access'] == 2)echo '<font color="lime">[Адм]</font>';
else
if($post['access'] == 1)echo '<font color="green">[Мд]</font>';
echo "</a>";
}
echo '</div><a href="?" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include 'system/footer.php';
exit;
}
if($user['chat_read'] >= 1){
mysql_query("UPDATE `users` SET `chat_read` = '0' WHERE `id` = '".$myID."'");
}
if(isset($_GET['text'])){
if(isset($_POST['text'])){
$text = $_POST['text'];
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban = mysql_fetch_array($ban);
if($ban)$err = "<div class='text center'><font color='tomato'>На вас наложен бан осталось ".tl($ban['last']-time())."</font></div>";
if(strlen($text) < 1 or strlen($text) > 5000)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком короткое или длинное сообщение</font></div>';
if($user['id'] ==0)$err = '<div class="text center"><font color="tomato">Ошибка. У вас нет прав доступа</font></div>';
if($user['spamanti'] > time())$err = '<div class="text center"><font color="tomato">Ошибка. Сообщение можно отправлять один раз, в 5 секунд</font></div>';

if($user['level'] <=4)$err = '<div class="text center"><font color="tomato">Ошибка. Чат доступен с 5 уровня</font></div>';

if(!$err){
mysql_query("INSERT INTO `chat` SET `id_user` = '$user[id]', `time` = '".time()."', `text` = '".text($text)."'");
mysql_query("UPDATE `users` SET `spamanti` = '".(time() + 5)."' WHERE `id` = '".$user['id']."'");
mysql_query("UPDATE `users` SET `chat_read` = '1'");

$_SESSION['msg'] = '<div class="text center"><font color="lime">Сообщение отправлено</font></div>';
header('Location: /chat.php');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: /chat.php');
exit();
}
}else{
$_SESSION['msg'] = '';
header('Location: /chat.php');
exit();
}

}
if(isset($_GET['delete_post']) and $user['access'] > 0){
mysql_query("DELETE FROM `chat` WHERE `id` = '".$_GET['delete_post']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Сообщение удалено</font></div>';
header('Location: ?');
exit();
}
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='/chat.php?smiles' class='des'><font color='silver'>Смайлы</font></a></td> <td style='width: 50%;' class='center'><a href='/chat.php?md' class='des'><font color='silver'>Модераторы</font></a></td></tr></table></div>";
echo "<div class='text center'>";
if($user['level'] <= 4){
echo "<font color='tomato'>Чат доступен с 5 уровня</font></div>";
}else{
if(isset($_GET['msg'])){

$opponent = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $_GET[msg] LIMIT 1"));
echo "<form method='post' action='?text=$_GET[msg]'>";
echo '<input type="text" class="text" id="msg" name="text" maxlength="5000" value="'.$opponent['login'].'," /><input type="submit" class="cb_ttl" name="submit" value="Отправить"/><hr><a href="?">Обновить страницу</a></form>';
}else{
echo '<form action="?text" method="post">
<input type="text" class="text" id="msg" name="text" maxlength="5000" value=""/><input type="submit" class="cb_ttl" name="submit" value="Отправить"/><hr><a href="?">Обновить страницу</a>
    </form>';
    
}
}

echo "</div>";

$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `chat`"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `chat` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
if($k_post == 0) echo "<div class='text center'><font color='tomato'>Сообщений в чате не обнаруженно</font></div>";
echo '<div class="de">';
while($post = mysql_fetch_assoc($q)) {
echo '<div class="de">';
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $post[id_user] LIMIT 1"));

echo " <font color='#fff'><img src='/icons/".$ank['sex'].".png'><a href='/hero/$ank[id]'> <font color='silver'> $ank[login]</font></a> ";
//echo "".tl(time()-$post['time'])."";

$msg = str_replace(array($user['login'].','), "<span style='float:left;'><b><font color='lime'> $user[login]</font>,</b> ", $post['text']);
echo "<br><font size='2' color='#fff'>".text_msg($msg)."</font>";
if($myID != $ank['id'])echo "<br><a href='?msg=$ank[id]'><font color='silver'>[ответить]</font></a></span> ";
if($user['access'] > 0)echo " <a href='?delete_post=$post[id]'><font color='red'>[×]</font></a>";
echo"</font></font>";
echo '</div>';
}


echo '</div>';
if ($k_post > 10)
{
echo '<div class="text center">';
str('?',$k_page,$page); 
echo "</div>";
}

include 'system/footer.php';
?>