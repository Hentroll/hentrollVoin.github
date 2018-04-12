<?php
include 'system/func.php';
auth(); // Закроем от не авторизованных
# Настройки #
$id = num($_GET['id']);
$prof = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
# Ошибки #
if($prof['id'] == $user['id']){
header('Location: /mail/');
}
//
if(!$prof){
$prof['id'] = 0;
$prof['login'] = 'Система';
$prof['access'] = 2;
$prof['sex'] = 'w';
}
if(isset($_GET['text']) and $prof['id'] != 0){
if(isset($_POST['text'])){
$text = text($_POST['text']);
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1'); 
$ban = mysql_fetch_array($ban); 
if(strlen($text) < 1 or strlen($text) > 1000)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинное или короткое сообщение</font></div>';
if($ban)$err = "<div class='text center'><font color='tomato'>Ошибка. На вас наложен, бан осталось ".tl($ban[last]-time())."</font></div>";
$ban_ip = mysql_query('SELECT * FROM `ban` WHERE `ip` = "'.$user['ip'].'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban_ip = mysql_fetch_array($ban_ip);
if($ban_ip)$err = "<div class='text center'><font color='tomato'>Ошибка. Ваш IP совпадает с нарушителем!<br>Осталось: ".tl($ban_ip['last']-time())."</font></div>";
if($user['mail_spam'] > time())$err = '<div class="text center"><font color="tomato">Ошибка. Сообщение можно отправлять один раз, в 5 секунд</font></div>';
if($user['level'] <=4)$err = '<div class="text center"><font color="tomato">Ошибка. Почта доступна с 5 уровня</font></div>';
if($prof['mail_close'] == 1)$err = '<div class="text center"><font color="tomato">Ошибка. Игрок закрыл свою почту</font></div>';
if(!$err){
mysql_query("INSERT INTO `mail` SET `in` = '$myID', `out` = '".$prof['id']."', `text` = '$text' , `time` = '".time()."'");
mysql_query("UPDATE `users` SET `mail_spam` = '".(time() + 5)."' WHERE `id` = '".$user['id']."'");
$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$myID."' && `id_kont` = '".$prof['id']."' LIMIT 1"));
if($kont['id_kont'] != $prof['id']){
mysql_query("INSERT INTO `kont` SET `id_user` = '".$prof['id']."', `id_kont` = '".$myID."', `time` = '".time()."'");
mysql_query("INSERT INTO `kont` SET `id_user` = '$myID', `id_kont` = '".$prof['id']."', `time` = '".time()."'");
}else{
mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$myID."' && `id_kont` = '".$prof['id']."'");
mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$prof['id']."' && `id_kont` = '".$myID."'");
}
header("Location: /mail/$prof[id]");
exit();
}else{
$_SESSION['msg'] = $err;
header("Location: /mail/$prof[id]");
exit();
}
}else{
header("Location: /mail/$prof[id]");
exit();
}
}
$title = 'Почта';
include 'system/header.php';
echo '<div class="de center"><a href="/mail.php?'.$r.'"><img src="/icons/mail.png"> <u>Личная почта</u></a> / <a href="/mail.php?sett#'.$r.'"><img src="/icons/right.png"> <u>[Настройка]</u></a></div>';
if($prof['id'] != 0){
echo "<div class='text center'>";
echo '<form method="post" action="?text">';
echo '<input type="text" name="text"><br>';
?><input type="submit" class="btn" name="submit" value="Отправить"> <?
echo "<a href='/mail/$prof[id]#".$r."' class='btn'>Обновить</a>";
echo "</form>";
echo "</div>";
?>
<?
}
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE (`in` = '$prof[id]' && `out` = '$user[id]') or (`in` = '$user[id]' && `out` = '$_GET[id]')"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
echo "<div class='text'>";
$q = mysql_query("SELECT * FROM `mail` WHERE (`in` = '$prof[id]' && `out` = '$user[id]') or (`in` = '$user[id]' && `out` = '$prof[id]') ORDER BY `id` DESC LIMIT $start, $set[p_str]");
mysql_query("update `mail` set `online` = '0' WHERE `in` = '".$prof['id']."' && `out` = '".$myID."'");
mysql_query("UPDATE `kont` SET `new_msg` = '0' WHERE `id_kont` = '$ank[id]' AND `id_user` = '$myID' LIMIT 1");
while($post = mysql_fetch_assoc($q)) {
echo "<div class='text'>";
if($post['online'] == 1)$color = 'green';
else $color = '#A8A8A8';
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $post[in] LIMIT 1"));
if($ank['id'] == 0){
$ank['id'] = 0;
$ank['login'] = '<span class="grey">Система</span>';
$ank['access'] = 2;
}
if($ank['id'] != 0)echo "<a href='/hero/$ank[id]'>$ank[login]</a>, <font color='$color'>".vremja($post['time'])."</font><br>".text_msg($post['text'])."";
else echo "$ank[login], <font color='$color'>".vremja($post['time'])."</font><br>".text_msg($post['text'])."";
echo '</div>';
}
echo '</div>';
if($k_post > 10){
echo "<div class='de center'>";
str('?',$k_page,$page); // Вывод страниц
echo "</div>";
}
echo "<a href='/mail/#".$r."' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад ";
if($new_msg >= 1)echo "<font color='green'>(+)</font>"; 
echo "</a>";
require_once ('system/footer.php');
?>