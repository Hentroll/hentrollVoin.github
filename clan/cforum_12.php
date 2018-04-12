<?php
$fix_mesto = 'clan';
require_once ('system/func.php');
auth(); // Закроем от не авторизованных


# Настройки #
$id = abs(intval($_GET['id']));
if($id)$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$id."'"));
else $clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user[id_clan]."'"));
## Топик ##
$cforum_topic = abs(intval($_GET['cforum_topic']));
if($cforum_topic){
$cforum_topic = mysql_fetch_assoc(mysql_query("SELECT * FROM `cforum_topic` WHERE `id` = '".$cforum_topic."'"));
$cforum_sub = mysql_fetch_assoc(mysql_query("SELECT * FROM `cforum_sub` WHERE `id` = '".$cforum_topic['id_forum']."'"));
$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$cforum_sub['id_clan']."'"));
# Ошибки #
if(!$cforum_topic){
$_SESSION['msg'] == 'Такой топик не существует';
header('Location: /clan/forum/');
exit();
}
if(isset($_GET['delete_post']) and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id']){
mysql_query("DELETE FROM `cforum_comments` WHERE `id` = '".$_GET['delete_post']."'");




mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] удалил пост с $cforum_topic[name]'");



$_SESSION['msg'] = 'Пост удален';
header('Location: ?');
exit();
}
if(isset($_GET['delete']) and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id']){
$title = 'Удалить топ?';
require_once ('system/header.php');
echo "<div class='block2'>";
echo "<li><a href='?delete_ok'>Да, удалить</a></li>";
echo "<li><a href='?'>Нет, отмена</a></li>";
echo "</div>";
require_once ('system/footer.php');
break;
}
if(isset($_GET['delete_ok']) and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id']){
mysql_query("DELETE FROM `cforum_topic` WHERE `id` = '".$cforum_topic[id]."'");

                                                                                                                                                


mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] удалил топик $cforum_topic[name]'");


$_SESSION['msg'] = 'Топик удален';
header("Location: /clan/forum/$cforum_topic[id_forum]");
exit();
}
if(isset($_GET['close']) and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id']){
mysql_query("UPDATE `cforum_topic` SET `close` = '1' WHERE `id` = '$cforum_topic[id]'");




mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] закрыл топик $cforum_topic[name]'");


$_SESSION['msg'] = "Топик успешно закрыт";
header("Location: ?");
exit();
}

if(isset($_GET['no_close']) and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id']){
mysql_query("UPDATE `cforum_topic` SET `close` = '0' WHERE `id` = '$cforum_topic[id]'");



mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] открыл топик $cforum_topic[name]'");

$_SESSION['msg'] = "Топик успешно открыт";
header("Location: ?");
exit();
}
if(isset($_GET['top']) and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id']){
mysql_query("UPDATE `cforum_topic` SET `top` = '1' WHERE `id` = '$cforum_topic[id]'");




mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] закрепил топик $cforum_topic[name]'");


$_SESSION['msg'] = "Топик успешно закреплен";
header("Location: ?");
exit();
}
if(isset($_GET['no_top']) and $user['clan_rang'] > 3){
mysql_query("UPDATE `cforum_topic` SET `top` = '0' WHERE `id` = '$cforum_topic[id]'");





mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] открепил топик $cforum_topic[name]'");


$_SESSION['msg'] = "Топик успешно откреплен";
header("Location: ?");
exit();
}
if(isset($_GET['text'])){
if(isset($_POST['text'])){
$text = text($_POST['text']);
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');  
$ban = mysql_fetch_array($ban);
if(strlen($text) < 3 or strlen($text) > 5000)$err = 'Длина сообщения должна быть в пределах 3 - 5000 символов';
if($ban)$err = "На вас наложен бан, осталось ".tl($ban['last']-time());
$ban_ip = mysql_query('SELECT * FROM `ban` WHERE `ip` = "'.$user['ip'].'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban_ip = mysql_fetch_array($ban_ip);
if($ban_ip)$err = "Ваш IP совпадает с нарушителем!<br>Осталось: ".tl($ban_ip['last']-time());
if(!isset($err)){
mysql_query("INSERT INTO `cforum_comments` SET `id_topic` = '$cforum_topic[id]', `id_user` = '".$myID."', `text` = '$text' , `time` = '".time()."'");
mysql_query("UPDATE `cforum_topic` SET `onlick` = '".time()."' WHERE `id` = '$cforum_topic[id]'");




mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] прокомментировал топик $cforum_topic[name]'");

$_SESSION['msg'] = 'Комментарий успешно добавлен';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?page=end');
exit();
}
}else{
$_SESSION['msg'] = 'Ведите текст';
header('Location: ?page=end');
exit();
}
}
if(isset($_GET['sett_topic_post'])){
if(isset($_POST['text']) && isset($_POST['name'])){
$text = text($_POST['text']);
$name = text($_POST['name']);
if(strlen($text) < 3 or strlen($text) > 5000)$err = 'Длина сообщения должна быть в пределах 3 - 5000 символов';
if(strlen($name) < 3 or strlen($name) > 40)$err = 'Длина названия должна быть в пределах 3 - 40 символов';
if(!isset($err)){
mysql_query("UPDATE `cforum_topic` SET `text` = '$text', `name` = '$name' WHERE `id` = '$cforum_topic[id]'");





mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] изменил топик $cforum_topic[name]'");


$_SESSION['msg'] = 'Топик успешно изменен';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?');
exit();
}
}else{
$_SESSION['msg'] = 'Заполните поля';
header('Location: ?');
exit();
}
}
$title = 'Форум - '.$cforum_topic['name'];
require_once ('system/header.php');
if($user['clan_rang'] > 3 and $user['id_clan'] == $clan['id'] or $myID == $cforum_topic['id_user']){
if(isset($_GET['sett_topic'])){
echo "<div class='block center'>";
echo '<form name="text" method="post" action="?sett_topic_post">';
echo "<input type='text' name='name' placeholder='Введите название...' value='$cforum_topic[name]'><br>";
echo '<textarea name="text" placeholder="Введите сообщение..." maxlength="5000">'.$cforum_topic['text'].'</textarea><br>';
echo '<input class="btn" type="submit" value="Изменить"><a href="?">Отмена</a>';
echo "</form>";
echo "</div>";
require_once ('system/footer.php');
break;
}
}
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $cforum_topic[id_user] LIMIT 1"));
echo "<div class='block'>";
echo icons_user($ank[id])." <a href='/profile/$ank[id]'>$ank[login]</a>, ".vremja($cforum_topic['time'])."<br>".text_msg($cforum_topic['text']);
echo "</div>";
if(($user['clan_rang'] > 3 and $user['id_clan'] == $clan['id']) or $myID == $cforum_topic['id_user']){









echo "<div class='block2'>";
echo "<li><a href='?sett_topic'>".ico('icons','arrow.png')."Редактировать</a></li>";
if($cforum_topic['close'] == 0 and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id'])echo "<li><a href='?close'>".ico('icons','arrow.png')."Закрыть</a></li>";
if($cforum_topic['close'] == 1 and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id'])echo "<li><a href='?no_close'>".ico('icons','arrow.png')."Открыть</a></li>";
if($cforum_topic['top'] == 0 and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id'])echo "<li><a href='?top'>".ico('icons','arrow.png')."Прикрепить</a></li>";
if($cforum_topic['top'] == 1 and $user['clan_rang'] > 3 and $user['id_clan'] == $clan['id'])echo "<li><a href='?no_top'>".ico('icons','arrow.png')."Открепить</a></li>";
if($user['clan_rang'] > 3 and $user['id_clan'] == $clan['id'])echo "<li><a href='?delete'>".ico('icons','arrow.png')."Удалить топ</a></li>";
echo "</div>";
}
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `cforum_comments` WHERE `id_topic` = '$cforum_topic[id]'"),0);
echo "<div class='block'><b>Комментарии [$k_post]</b><br>";
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `cforum_comments` WHERE `id_topic` = '$cforum_topic[id]' ORDER BY `id` ASC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $post[id_user] LIMIT 1"));
echo icons_user($ank[id])." <a href='/profile/$ank[id]' >$ank[login]</a>, ".vremja($post['time'])." ";
if($ank[id] != $myID and $cforum_topic[close] == 0)echo "<a href='?to=$ank[id]&page=end'>[Отв]</a>";
echo "<br>".text_msg($post['text']);
if($user[access] >= 2)if($user[clan_rang] == 5)echo " <a href='?delete_post=$post[id]'><font color='red'>[×]</font></a>";
echo "<hr>";
}
str('?',$k_page,$page); // Вывод страниц
echo "</div>";
echo "<div class='block center'>";
if($cforum_topic['close'] == 0){
if(isset($_GET[to])){
$opponent = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $_GET[to] LIMIT 1"));
echo '<form name="text" method="post" action="?text">';
echo '<textarea name="text" maxlength="5000">'.$opponent[login].', </textarea><br>';
if($user[level] >= 9)echo '<input class="btn" type="submit" value="Ответить">';
echo "</form>";
}else{
echo '<form name="text" method="post" action="?text">';
echo '<textarea name="text" placeholder="Введите сообщение..." maxlength="5000"></textarea><br>';
echo '<input class="btn" type="submit" value="Отправить">';
echo "</form>";
}
}else{
echo "<font class='item-5'>Топик закрыт...</font>";
}
echo "</div>";
$cforum_sub = mysql_fetch_assoc(mysql_query("SELECT * FROM `cforum_sub` WHERE `id` = '".$cforum_topic[id_forum]."'"));
echo "<div class='block'>".ico('icons','topic.png')." <a href='/clan/forum/$cforum_sub[id]'>$cforum_sub[name]</a> | $cforum_topic[name]</div>";
}else{
## Раздел ##
$id = abs(intval($_GET['forumsub']));
if($id){
$cforum_sub = mysql_fetch_assoc(mysql_query("SELECT * FROM `cforum_sub` WHERE `id` = '".$id."'"));
# Ошибки #
if(!$cforum_sub){
$_SESSION['msg'] == 'Такой раздел не существует';
header('Location: /clan/forum/');
exit();
}
$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$cforum_sub[id_clan]."'"));
if($cforum_sub['gb'] == 0 and $user['id_clan'] != $clan['id']){
require_once ('system/header.php');
echo "<div class='block'><h1>Раздел только для клана</h1></div>";
require_once ('system/footer.php');
exit();
}
if(isset($_GET['red_razdel_post'])){
if(isset($_POST['name'])){
$name = text($_POST['name']);
$gb = num($_POST['gb']);
$clan_forum = num($_POST['clan_rang']);
if(strlen($name) < 3 or strlen($name) > 40)$err = 'Длина названия должна быть в пределах 3 - 40 символов';
if(!isset($err)){
mysql_query("UPDATE `cforum_sub` SET `name` = '$name', `gb` = '$gb', `clan_rang` = '$clan_rang' WHERE `id` = '$cforum_sub[id]' LIMIT 1");




mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] изменил раздел $cforum_sub[name]'");


$_SESSION['msg'] = 'Раздел успешно изменён';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?red_razdel');
exit();
}
}else{
$_SESSION['msg'] = 'Заполните поля';
header('Location: ?red_razdel');
exit();
}
}
if(isset($_GET['red_razdel']) and $user['clan_rang'] == 5 and $user['id_clan'] == $clan['id']){
$title = 'Редактирование раздела';
require_once ('system/header.php');
echo "<div class='block center'>";
echo '<form name="text" method="post" action="?red_razdel_post">';
echo "<input type='text' name='name' value='$cforum_sub[name]'><br>";
echo 'Доступность:<br /><select name="gb"><option value="0">Только для клана</option><option value="1">Для всех</option></select><br/>';
echo 'Права:<br /><select name="clan_rang"><option value="1">Для всех</option><option value="4">Для генералов</option></select><br/>';
echo '<input class="btn" type="submit" value="Изменить"><a href="?">Отмена</a>';
echo "</form>";
echo "</div>";
require_once ('system/footer.php');
break;
}
if(isset($_GET['new_topic_post'])){
if(isset($_POST['name']) && isset($_POST['text'])){
$name = text($_POST['name']);
$text = text($_POST['text']);
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');  
$ban = mysql_fetch_array($ban);
if(strlen($name) < 3 or strlen($name) > 40)$err = 'Длина названия должна быть в пределах 3 - 40 символов';
if(strlen($text) < 3 or strlen($text) > 5000)$err = 'Длина сообщения должна быть в пределах 3 - 5000 символов';
if($ban)$err = "На вас наложен бан, осталось ".tl($ban['last']-time());
$ban_ip = mysql_query('SELECT * FROM `ban` WHERE `ip` = "'.$user['ip'].'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban_ip = mysql_fetch_array($ban_ip);
if($ban_ip)$err = "Ваш IP совпадает с нарушителем!<br>Осталось: ".tl($ban_ip['last']-time());
if(!isset($err)){
if($forum['id'] == 1)mysql_query("UPDATE users SET news_read = '1'");
mysql_query("INSERT INTO `cforum_topic` SET `id_forum` = '$cforum_sub[id]', `id_user` = '".$myID."', `name` = '$name', `text` = '$text', `time` = '".time()."', `onlick` = '".time()."'");
$_SESSION['msg'] = 'Топик успешно создан';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?new_topic');
exit();
}
}else{
$_SESSION['msg'] = 'Заполните поля';
header('Location: ?new_topic');
exit();
}
}
$title = 'Форум - '.$cforum_sub['name'];
require_once ('system/header.php');
if(isset($_GET['new_topic']) and $user['clan_rang'] >= $cforum_sub['clan_rang']){
echo "<div class='block center'>";
echo '<form name="text" method="post" action="?new_topic_post">';
echo "<input type='text' name='name' placeholder='Введите название...'><br>";
echo '<textarea name="text" placeholder="Введите сообщение..." maxlength="5000"></textarea><br>';
echo '<input class="btn" type="submit" value="Создать"><a href="?">Отмена</a>';
echo "</form>";
echo "</div>";
require_once ('system/footer.php');
break;
}
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `cforum_topic` WHERE `id_forum` = '$cforum_sub[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `cforum_topic` WHERE `id_forum` = '$cforum_sub[id]' ORDER BY `top` DESC, `onlick` DESC LIMIT $start, $set[p_str]");
echo "<div class='block2'>";
if($user['id_clan'] == $clan['id'] and $user['clan_rang'] >=  $cforum_sub['clan_rang'])echo "<li><a href='?new_topic'><font color='item'>".ico('icons','topic.png')."Создать новый топик</font></a></li>";
if($k_post == 0)echo "<h1>В данном разделе нет топиков...</h1>";
while ($post = mysql_fetch_assoc($q)){
echo "<li><a href='/clan/forum/sub/$post[id]?page=end'>".ico('icons','topic.png');
if($post['close'] == 1 and $post['top'] == 1)echo "<b>$post[name]</b>";
elseif($post['close'] == 1)echo "<font color='red'>$post[name]</font>";
elseif($post['top'] == 1)echo "<b>$post[name]</b>";
else echo $post['name'];
echo "</a></li>";
}
echo "</div>";
echo "<div class='block'>";
str('?',$k_page,$page); // Вывод страниц
echo "</div>";
if($user['clan_rang'] == 5 and $user['id_clan'] == $clan['id'])echo "<a class='link' href='?red_razdel'>".ico('icons','arrow.png')." Редактировать раздел</a>";
echo "<a class='link' href='/clan/$clan[id]/forum/'>".ico('icons','arrow.png')." Вернуться в форум</a>";
}else{
if(isset($_GET['new_razdel_post'])){
if(isset($_POST['name'])){
$name = text($_POST['name']);
$gb = num($_POST['gb']);
$clan_forum = num($_POST['clan_rang']);
if(strlen($name) < 3 or strlen($name) > 40)$err = 'Длина названия должна быть в пределах 3 - 40 символов';
if(!isset($err)){
mysql_query("INSERT INTO `cforum_sub` SET `id_clan` = '$clan[id]', `name` = '$name', `gb` = '$gb', `clan_rang` = '$clan_rang'");




mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] создал раздел $cforum_sub[name]'");


$_SESSION['msg'] = 'Раздел успешно создан';
header('Location: ?');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?new_razdel');
exit();
}
}else{
$_SESSION['msg'] = 'Заполните поля';
header('Location: ?new_razdel');
exit();
}
}
if(isset($_GET['new_razdel']) and $user['clan_rang'] == 5 and $user['id_clan'] == $clan['id']){
$title = 'Форум клана - новый раздел';
require_once ('system/header.php');
echo "<div class='block center'>";
echo '<form name="text" method="post" action="?new_razdel_post">';
echo "<input type='text' name='name' placeholder='Введите название...'><br>";
echo 'Доступность:<br /><select name="gb"><option value="0">Только для клана</option><option value="1">Для всех</option></select><br/>';
echo 'Права:<br /><select name="clan_rang"><option value="1">Для всех</option><option value="4">Для генералов</option></select><br/>';
echo '<input class="btn" type="submit" value="Создать"><a href="?">Отмена</a>';
echo "</form>";
echo "</div>";
require_once ('system/footer.php');
break;
}
## Форум ##
$title = 'Форум клана';
require_once ('system/header.php');
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `cforum_sub` WHERE `id_clan` = '$clan[id]'"),0);
$q = mysql_query("SELECT * FROM `cforum_sub` WHERE `id_clan` = '$clan[id]' ORDER BY `id` ASC");
echo "<div class='block2'>";
if($k_post == 0)echo "<h1>Нет разделов...</h1>";
while ($post = mysql_fetch_assoc($q)){
echo "<li><a href='/clan/forum/$post[id]'>".ico('icons','topic.png')."$post[name]</a></li>";
}
if($user['id_clan'] == $clan['id'] and $user['clan_rang'] == 5)echo "<li><a href='?new_razdel'>Создать новый раздел</a></li>";
echo "</div>";
echo "<a href='/clan/$clan[id]/' class='link'>".ico('icons','arrow.png')." Вернуться назад</a>";
}
}
require_once ('system/footer.php');
?>