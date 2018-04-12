<?php
require_once ('system/func.php');
auth(); // Закроем от не авторизованных
$r = rand(100000,999999);
if($user['save'] <= 1){
header("Location: /home.php?error");
}
$topic = abs(intval($_GET['topic']));
if($topic){
$topic = mysql_fetch_assoc(mysql_query("SELECT * FROM `topic` WHERE `id` = '".$topic."'"));
# Ошибки #
if(!$topic){
$_SESSION['msg'] == '<div class="text center"><font color="tomato">Ошибка. Топик не найден</font></div>';
header('Location: /forum/');
exit();
}
if(isset($_GET['delete_post']) and $user['access'] > 0){
mysql_query("DELETE FROM `topic_msg` WHERE `id` = '".$_GET['delete_post']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Пост успешно удален</font></div>';
header('Location: ?');
exit();
}
if(isset($_GET['topic_delete']) and $user['access'] > 0){
$title = 'Удалить топ?';
require_once ('system/header.php');
echo "<div class='text'>";
echo "<a href='?topic_delete_ok' class='link'>Да, удалить</a>";
echo "<a href='?' class='link'>Нет, отмена</a>";
echo "</div>";
require_once ('system/footer.php');
exit;
}
if(isset($_GET['topic_delete_ok']) and $user['access'] > 0){
mysql_query("DELETE FROM `topic` WHERE `id` = '".$topic[id]."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Топик успешно удален</font></div>';
header("Location: /forum/$topic[id_forum]");
exit();
}
if(isset($_GET['topic_close']) and $user['access'] > 0){
mysql_query("UPDATE `topic` SET `close` = '1' WHERE `id` = '$topic[id]'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Топик успешно закрыт</font></div>";
header("Location: ?");
exit();
}
if(isset($_GET['topic_no_close']) and $user['access'] > 0){
mysql_query("UPDATE `topic` SET `close` = '0' WHERE `id` = '$topic[id]'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Топик успешно открыт</font></div>";
header("Location: ?");
exit();
}
if(isset($_GET['topic_top']) and $user['access'] > 0){
mysql_query("UPDATE `topic` SET `top` = '1' WHERE `id` = '$topic[id]'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Топик успешно закреплен</font></div>";
header("Location: ?");
exit();
}
if(isset($_GET['topic_no_top']) and $user['access'] > 0){
mysql_query("UPDATE `topic` SET `top` = '0' WHERE `id` = '$topic[id]'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Топик успешно откреплен</font></div>";
header("Location: ?");
exit();
}
if(isset($_GET['text'])){
if(isset($_POST['text'])){
$id = num($_GET['text']);
$text = text($_POST['text']);
$text2 = "Вам ответили на [url=/forum/sub/$topic[id]?page=end]форуме[/url]";
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');  
$ban = mysql_fetch_array($ban);
if(strlen($text) < 1 or strlen($text) > 5000)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинное или короткое сообщение</font></div>';
if($user['time_tema'] > time())$err = '<div class="text center"><font color="tomato">Ошибка. Отправлять сообщения на форуме, можно раз в 5 секунд</font></div>';
if($ban)$err = "<div class='text center'><font color='tomato'>На вас наложен бан осталось ".tl($ban['last']-time())."</font></div>";
$ban_ip = mysql_query('SELECT * FROM `ban` WHERE `ip` = "'.$user['ip'].'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban_ip = mysql_fetch_array($ban_ip);
if($ban_ip)$err = "<div class='text center'><font color='tomato'>Ваш IP совпадает с нарушителем!<br>Осталось: ".tl($ban_ip['last']-time())."</font></div>";
if(!isset($err)){
mysql_query("UPDATE `users` SET `time_tema` = '".(time() + 5)."' WHERE `id` = '".$user['id']."'");
mysql_query("INSERT INTO `topic_msg` SET `id_topic` = '$topic[id]', `id_user` = '".$myID."', `text` = '$text' , `time` = '".time()."'");
mysql_query("UPDATE `topic` SET `onlick` = '".time()."' WHERE `id` = '$topic[id]'");
mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$id."', `text` = '$text2' , `time` = '".time()."'");
$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$id."' && `id_kont` = '0' LIMIT 1"));
if(!$kont){
mysql_query("INSERT INTO `kont` SET `id_user` = '".$id."', `id_kont` = '0', `time` = '".time()."'");
}else{
mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$id."' AND `id_kont` = '0'");
}
$_SESSION['msg'] = '';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?page=end');
exit();
}
}else{
$_SESSION['msg'] = '';
header('Location: ?page=end');
exit();
}
}
if(isset($_GET['sett_topic_post'])){
if(isset($_POST['text']) && isset($_POST['name'])){
$text = text($_POST['text']);
$name = text($_POST['name']);
if(strlen($text) < 3 or strlen($text) > 5000)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинное или короткое сообщение</font></div>';
if(strlen($name) < 1 or strlen($name) > 50)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинное или короткое название</font></div>';
if(!isset($err)){
mysql_query("UPDATE `topic` SET `text` = '$text', `sett_user` = '".$myID."', `sett_time` = '".time()."', `name` = '$name' WHERE `id` = '$topic[id]'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Топик успешно изменен</font></div>';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?');
exit();
}
}else{
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Поля обязательны для заполнения</font></div>';
header('Location: ?');
exit();
}
}
$title = 'Форум - '.$topic['name'];
require_once ('system/header.php');
if($user['access'] > 0 or $myID == $topic['id_user']){
if(isset($_GET['topic_sett_topic'])){
echo "<div class='text center'>";
echo '<form name="text" method="post" action="?sett_topic_post">';
echo "Название:<br><input type='text' name='name' placeholder='' value='$topic[name]'><br>Сообщение:<br><input type='text' name='text' placeholder='' value='$topic[text]'><br>";
echo '<input class="btn" type="submit" value="Изменить">';
echo "</form>";
echo "</div>";
echo "<a href='?' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
require_once ('system/footer.php');
exit;
}
}
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `topic_msg` WHERE `id_topic` = '$topic[id]'"),0);
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $topic[id_user] LIMIT 1"));
$sett = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $topic[sett_user] LIMIT 1"));
$forum = mysql_fetch_assoc(mysql_query("SELECT * FROM `forum` WHERE `id` = '".$topic['id_forum']."'"));
echo "<div class='de center'><a href='/forum/$forum[id]#".$r."'><img src='/icons/right.png' width='16' height='16'> <u>$forum[name]</u></a> / <a href='#".$r."'><img src='/icons/reset.png' width='16' height='16'> <u>$topic[name]</u></a></div>";
echo "<div class='text'>";
echo "<img src='/icons/".$ank['sex'].".png'> <a href='/hero/$ank[id]'>$ank[login]</a>, ".vremja($topic['time'])."<hr><center>".text_msg($topic['text'])."</center><hr><img src='/icons/right.png'><font color='silver'>"; 
if($sett['id'] >= 1){
echo "Посл. Ред: <a href='/hero/".$sett['id']."'><img src='/icons/".$sett['sex'].".png'> ".$sett['login']."</a>.<br>".vremja($topic['sett_time'])."<hr>";
echo "<img src='/icons/right.png'>";
}
echo "Комментариев: $k_post</font></div>";
if($user['access'] > 0 or $myID == $topic['id_user']){
if($user['access'] > 0)echo "<a href='?topic_sett_topic' class='link'><img src='/icons/back.png' width='16' height='16'> Редактировать</a>";
if($topic['close'] == 0 and $user['access'] > 0)echo "<a href='?topic_close' class='link'><img src='/icons/back.png' width='16' height='16'> Закрыть</a>";
if($topic['close'] == 1 and $user['access'] > 0)echo "<a href='?topic_no_close' class='link'><img src='/icons/back.png' width='16' height='16'> Открыть</a>";
if($topic['top'] == 0 and $user['access'] > 0)echo "<a href='?topic_top' class='link'><img src='/icons/back.png' width='16' height='16'> Прикрепить</a>";
if($topic['top'] == 1 and $user['access'] > 0)echo "<a href='?topic_no_top' class='link'><img src='/icons/back.png' width='16' height='16'> Открепить</a>";
if($user['access'] > 0)echo "<a href='?topic_delete' class='link'><img src='/icons/back.png' width='16' height='16'> Удалить топик</a>";
}
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `topic_msg` WHERE `id_topic` = '$topic[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `topic_msg` WHERE `id_topic` = '$topic[id]' ORDER BY `id` ASC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q)){
echo "<div class='de'>";
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $post[id_user] LIMIT 1"));
echo "<a href='/hero/$ank[id]' ><img src='/icons/".$ank['sex'].".png'> $ank[login]</a>, ".vremja($post['time'])." ";
if($ank['id'] != $myID and $topic['close'] == 0)echo "<a href='?to=$ank[id]&page=end'>[Отв]</a>";
echo "<br>".text_msg($post['text']);                                                                    
if($user['access'] > 0)echo " <a href='?delete_post=$post[id]'><font color='red'>[×]</font></a>";
echo "</div>";
}
if($k_post > 10){
echo "<div class='text center'>";
str('?',$k_page,$page); // Вывод страниц
echo "</div>";
}
echo "<div class='text center'>";
if($user['level'] >= 5){
if($topic['close'] == 0){
if(isset($_GET['to'])){
$opponent = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $_GET[to] LIMIT 1"));
echo '<form name="text" method="post" action="?text='.$_GET['to'].'">';
echo '<input type="text" name="text" value="'.$opponent['login'].',"><br>';
if($user['level'] >= 5)echo '<input class="btn" type="submit" value="Отправить"> <a href="#'.$r.'">Обновить</a>';
echo "</form>";
}else{
echo '<form name="text" method="post" action="?text">';
echo "<input type='text' name='text' placeholder=''><br>";

echo '<input class="btn" type="submit" value="Отправить"> <a href="#'.$r.'">Обновить</a>';
echo "</form>";
}
}else{
echo "<font color='tomato'>Вы не можете комментировать топик, т.к он закрыт</font>";
}
}else{
echo "<font color='tomato'>Писать на форуме можно только с 5 уровня!</font>";
}
echo "</div>";
echo "<a href='/forum/$forum[id]' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
}else{
## Раздел ##
$id = abs(intval($_GET['id']));
if($id){
$forum = mysql_fetch_assoc(mysql_query("SELECT * FROM `forum` WHERE `id` = '".$id."'"));
# Ошибки #
if(!$forum){
$_SESSION['msg'] == '<div class="text center"><font color="tomato">Ошибка. Раздел не найден</font></div>';
header('Location: /forum/');
exit();
}
if(isset($_GET['create_topic_post'])){
if(isset($_POST['name']) && isset($_POST['text'])){
$name = text($_POST['name']);
$text = text($_POST['text']);
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');  
$ban = mysql_fetch_array($ban);
if(strlen($name) < 1 or strlen($name) > 50)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинное или короткое название</font></div>';
if($user['level'] <= 4)$err = '<div class="text center"><font color="tomato">Ошибка. Создавать топики можно с 5 уровня</font></div>';
if(strlen($text) < 1 or strlen($text) > 5000)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинное или короткое сообщение</font></div>';
if($user['time_forum'] > time())$err = '<div class="text center"><font color="tomato">Ошибка. Создавать темы на форуме, можно раз в 10 минут</font></div>';
if($ban)$err = "<div class='text center'><font color='tomato'>На вас наложен бан, осталось ".tl($ban['last']-time())."</font></div>";
$ban_ip = mysql_query('SELECT * FROM `ban` WHERE `ip` = "'.$user['ip'].'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban_ip = mysql_fetch_array($ban_ip);
if($ban_ip)$err = "<div class='text center'><font color='tomato'>Ваш IP совпадает с нарушителем!<br>Осталось: ".tl($ban_ip['last']-time())."</font></div>";
if(!isset($err)){





















if($forum['id'] == 1)mysql_query("UPDATE users SET news_read = '1'");
mysql_query("INSERT INTO `topic` SET `id_forum` = '$forum[id]', `id_user` = '".$myID."', `name` = '$name', `text` = '$text', `time` = '".time()."', `onlick` = '".time()."'");



mysql_query("UPDATE `users` SET `time_forum` = '".(time() + 600)."' WHERE `id` = '".$user['id']."'");






$_SESSION['msg'] = '<div class="text center"><font color="lime">Топик успешно создан</font></div>';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?create_topic');
exit();
}
}else{
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Поля обязательны для заполнения</font></div>';
header('Location: ?create_topic');
exit();
}
}
$title = 'Форум - '.$forum['name'];
require_once ('system/header.php');
if(isset($_GET['create_topic']) && $user['access'] >= $forum['access']){
echo "<div class='text'>";
if($user['level'] >= 5){
echo '<center><form name="text" method="post" action="?create_topic_post">';
echo "Название:<br><input type='text' name='name' placeholder=''><br>";
echo "Сообщение:<br><input type='text' name='text' placeholder=''><br>";
echo '<input class="btn" type="submit" value="Создать"> <a href="#'.$r.'">Обновить</a>';
echo "</form></center>";
if($user['time_forum'] > time())echo '<hr><center><font color="tomato">Вы временно не можете создавать топики.<br>Будет доступно: через '.tl($user['time_forum'] - time()).'</font></center>';
echo "</div><a href='?' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
}else{
echo "<center><font color='tomato'>Ошибка. Создавать топики можно с 5 уровня!</font></center></div><a href='?' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
}
echo "</div>";
require_once ('system/footer.php');
exit;
}
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `topic` WHERE `id_forum` = '$forum[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `topic` WHERE `id_forum` = '$forum[id]' ORDER BY `top` DESC, `onlick` DESC LIMIT $start, $set[p_str]");
echo '<div class="de center"><a href="/forum/#'.$r.'"><img src="/icons/right.png" width="16" height="16"> <u>Форум</u></a> / <u><a href="#'.$r.'"><img src="/icons/reset.png" width="16" height="16"> '.$forum['name'].'</u></a></div>';
echo "<div class='text'>";







if($k_post == 0)echo "<div class='text center'><font color='tomato'>В данном разделе, еще нет топиков</font></div>";





while ($post = mysql_fetch_assoc($q)){
echo "<a href='/forum/sub/$post[id]?page=end#".$r."' class='link'>";
if($post['close'] == 1 and $post['top'] == 1)echo "<img src='/icons/topic_closed.png' width='16' height='16'> $post[name] - <font color='green'>[Топ]</font>";
elseif($post['close'] == 1)echo "<img src='/icons/topic_closed.png' width='16' height='16'> $post[name] - <font color='tomato'>[Офф]</font>";
elseif($post['top'] == 1)echo "<img src='/icons/topic_opens.png' width='16' height='16'> $post[name] - <font color='green'>[Топ]</font>";
else echo "<img src='/icons/topic_opens.png' width='16' height='16'> ".$post['name']."";
echo "</a>";
}



if($k_post > 10){
echo "<div class='text center'>";
str('?',$k_page,$page); // Вывод страниц
echo "</div>";
}
echo '<hr>';
if($user['access'] >= $forum['access'] and $user['level'] >= 5){
echo "<a href='?create_topic#".$r."' class='link'><font color='green'><img src='/icons/topic.png' width='16' height='16'> Создать новый топик</font></a>";
}else{
echo '<div class="de center">Создавать топики можно с 5 уровня</div>';
}
echo '</div>';
}else{
## Форум ##
$title = 'Форум';
require_once ('system/header.php');
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum`"),0);
$q = mysql_query("SELECT * FROM `forum` ORDER BY `id` ASC");
if($k_post == 0)echo "<div class='text center'><font color='tomato'>Ошибка. На форуме отсутствуют разделы</font></div>";
echo "<div class='text'>";
while ($post = mysql_fetch_assoc($q)){
echo "<a href='/forum/$post[id]#".$r."' class='link'><img src='/icons/topic.png' width='16' height='16'> $post[name]</a>";
}







echo "</div>";
}
}
require_once ('system/footer.php');
?>