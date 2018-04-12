<?php
require_once ('../system/func.php');
$title = 'Админ-Чат';
require_once ('../system/header.php');
auth();

if($user['access'] <= 0){
header("Location: /home.php?error");
}
if($user['save'] <= 1){
header("Location: /home.php?error");
}
if(isset($_GET['smiles'])){
include 'my_inc/smiles.php';
include 'system/footer.php';
exit;
}

if(isset($_GET['md'])){
include 'my_inc/md.php';
include 'system/footer.php';
exit;
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
mysql_query("INSERT INTO `admin_chat` SET `id_user` = '$user[id]', `time` = '".time()."', `text` = '".text($text)."'");
mysql_query("UPDATE `users` SET `spamanti` = '".(time() + 5)."' WHERE `id` = '".$user['id']."'");

$_SESSION['msg'] = '<div class="text center"><font color="lime">Сообщение отправлено</font></div>';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?');
exit();
}
}else{
$_SESSION['msg'] = '';
header('Location: ?');
exit();
}

}
if(isset($_GET['delete_post']) and $user['access'] > 0){
mysql_query("DELETE FROM `admin_chat` WHERE `id` = '".$_GET['delete_post']."'");
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
echo '<input type="text" class="text" id="msg" name="text" maxlength="5000" value="'.$opponent['login'].'," /><br /><input type="submit" class="cb_ttl" name="submit" value="Отправить"/> <a href="?">Обновить</a></form>';
}else{
echo '<form action="?text" method="post">
<input type="text" class="text" id="msg" name="text" maxlength="5000" value="" /><br />
            
<input type="submit" class="cb_ttl" name="submit" value="Отправить"/> <a href="?">Обновить</a>
    </form>';
    
}
}

echo "</div>";

$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `admin_chat`"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `admin_chat` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
if($k_post == 0) echo "<div class='text center'><font color='tomato'>Сообщений в чате не обнаруженно</font></div>";
echo '<div class="de">';
while($post = mysql_fetch_assoc($q)) {
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $post[id_user] LIMIT 1"));

echo " <font color='silver'><img src='/icons/".$ank['sex'].".png'><a href='/hero/$ank[id]'> <font color='white'> $ank[login]</font></a> ".tl(time()-$post['time'])."";

$msg = str_replace(array($user['login'].','), "<span style='float:left;'><b><font color='lime'> $user[login]</font>,</b> ", $post['text']);
echo "<br>".text_msg($msg)."";
if($myID != $ank['id'])echo " <a href='?msg=$ank[id]'> [отв]</a></span> ";
if($user['access'] > 0)echo " <a href='?delete_post=$post[id]'><font color='red'>[×]</font></a>";
echo"</font></font><hr>";
}
echo '</div>';


if ($k_post > 10)
{
echo '<div class="text center">';
str('?',$k_page,$page); 
echo "</div>";
}

require_once ('../system/footer.php');
?>