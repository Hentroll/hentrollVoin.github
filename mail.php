<?php
include 'system/func.php';
auth(); // Закроем от не авторизованных
$title = 'Почта';
include 'system/header.php';
if(isset($_GET['sett'])){
if(isset($_GET['mail_open'])){
if($user['mail_close'] == '0'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Почта уже открыта</font></div>';
header('Location: ?sett');
exit();
}
mysql_query("UPDATE `users` SET `mail_close` = '0' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Почта успешно открыта</font></div>';
header('Location: ?sett');
exit();
}
if(isset($_GET['mail_close'])){
if($user['mail_close'] == '1'){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Почта уже закрыта</font></div>';
header('Location: ?sett');
exit();
}
mysql_query("UPDATE `users` SET `mail_close` = '1' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Почта успешно закрыта</font></div>';
header('Location: ?sett');
exit();
}
echo '<div class="de center"><a href="?'.$r.'"><img src="/icons/mail.png"> <u>Личная почта</u></a> / <a href="?sett#'.$r.'"><img src="/icons/right.png"> <u>[Настройка]</u></a></div>';
echo '<div class="de center">';
if($user['mail_close'] == 0)echo 'Ваша почта открыта для других игроков, желаете закрыть её?<br><br><a href="?sett&mail_close" class="but">Закрыть почту</a>';
else
echo 'Ваша почта закрыта для других игроков, желаете открыть её?<br><br><a href="?sett&mail_open" class="but">Открыть почту</a>';
echo '</div>';
include 'system/footer.php';
exit();
}

//удаляем свою почту
if(isset($_GET['delete_my_mail'])){
mysql_query("DELETE FROM `kont` WHERE `id_user` = '".$myID."'");
mysql_query("DELETE FROM `mail` WHERE `in` = '".$myID."'");
mysql_query("DELETE FROM `mail` WHERE `out` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Почта очищена</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
echo '<div class="de center"><a href="?delete_mail"><img src="/icons/reset.png"> Очистить почту</a>';
if(isset($_GET['delete_mail'])){
echo '<hr><a href="?delete_my_mail">Да, очистить.</a> | <a href="?">Нет, отмена.</a>';
}
echo '</div>';
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `kont` WHERE `id_user` = '".$myID."'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$myID."' ORDER BY `time` DESC LIMIT $start, $set[p_str]");
echo "<div class='text'>";
if($k_post == 0)echo "<center><font color='tomato'>Переписка с другими игроками, не обнаружена</font></center>";
while ($post = mysql_fetch_assoc($q)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$post['id_kont']."' LIMIT 1"));
if($ank['id'] == 0){
$ank['id'] = 0;
$ank['login'] = 'Система';

$ank['access'] = 2;
$ank['sex'] = 'w';
}
$mess = mysql_query("SELECT * FROM `mail` WHERE `in` = '$user[id]' && `out` = '$ank[id]' OR `in` = '$ank[id]' AND `out` = '$user[id]' ORDER BY `id` DESC LIMIT 1");
$msg = mysql_fetch_assoc($mess);
$new_msg = mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `out` = '".$user['id']."' && `in` = '".$ank['id']."' AND `online` = '1'"),0);
$online = mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `out` = '".$ank['id']."' && `in` = '".$user['id']."' AND `online` = '1'"),0);
echo "<a href='/mail/$ank[id]' class='link'>";
echo "<img src='/icons/".$ank['sex'].".png'> $ank[login], ".vremja($msg['time'])." ";
if($new_msg > 0)echo "<font color='red'>($new_msg)</font>";
if($online > 0)echo "<font color='lime'>($online)</font>";
echo "<br>".rez_text($msg['text'], 10, 15)."</a>";
}
echo "</div>";
if($k_post > 10){
echo "<div class='text center'>";
str('?',$k_page,$page); // Вывод страниц
echo "</div>";
}
include 'system/footer.php';
?>