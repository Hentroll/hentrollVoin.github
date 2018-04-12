<?
include 'system/func.php';
auth();
if($user['save'] <= 1){
header("Location: /home.php?error");
}
if(!isset($_SESSION['id']) && isset($_GET['id'])){
$id = num($_GET['id']);
$ticket = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket` WHERE `id` = '$id' LIMIT 1"));
if($user['access'] != 2){
if($ticket['id_user'] != $myID){
header('Location: /support.php');
exit();
}
}
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$ticket[id_user]' LIMIT 1"));
$title = "Техническая поддержка";
include 'system/header.php';
if(isset($_GET['close'])){
mysql_query('UPDATE `ticket` SET `status` = "close" WHERE `id` = "'.$ticket['id'].'"');
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Запрос успешно закрыт</font></div>";
header('Location: ?id='.$ticket['id'].'#'.$r.'');
exit();
}
if(isset($_GET['open'])){
mysql_query('UPDATE `ticket` SET `status` = "otckrit" WHERE `id` = "'.$ticket['id'].'"');
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Запрос успешно открыт</font></div>";
header('Location: ?id='.$ticket['id'].'#'.$r.'');
exit();
}
if(isset($_GET['delete']) && $user['access'] == 2){
mysql_query('DELETE FROM `ticket_msg` WHERE `id_ticket` = "'.$ticket['id'].'"');
mysql_query('DELETE FROM `ticket` WHERE `id` = "'.$ticket['id'].'"');
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Запрос успешно удален</font></div>";
header('Location: ?#'.$r.'');
exit();
}
echo '<div class="de center"><a href="/support.php#'.$r.'"><img src="/icons/right.png" width="16" height="16"> <u>Поддержка</u></a> / <a href="?id='.$ticket['id'].'#'.$r.'"><img src="/icons/reset.png" width="16" height="16"> <u>'.$ticket['tip'].'</u></a></div>';
echo "<div class='text'><a href='/hero/$ank[id]#".$r."'><img src='/icons/".$ank['sex'].".png'> $ank[login]</a> ".vremja($ticket['time'])."<br>".text_msg($ticket['text'])."</div>";
echo "<div class='text'>";
if($ticket['status'] != 'close')echo "<a href='?id=".$ticket['id']."&close' class='link'><img src='/icons/right.png' width='16' height='16'> Закрыть тикет</a>";
else
if($ticket['status'] == 'close')echo "<a href='?id=".$ticket['id']."&open' class='link'><img src='/icons/right.png' width='16' height='16'> Открыть тикет</a>";
if($user['access'] == 2)echo "<a href='?id=".$ticket['id']."&delete' class='link'><img src='/icons/right.png' width='16' height='16'> Удалить тикет</a>";
echo "</div>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `ticket_msg` WHERE `id_ticket` = '$ticket[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `ticket_msg` WHERE `id_ticket` = '$ticket[id]' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
if($k_post == 0) echo "<div class='text center'><font color='tomato'>Наш запрос еще не кто не ответил...</font></div>";
while($post = mysql_fetch_assoc($q)) {
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$post[id_user]' LIMIT 1"));
if($user['access'] == 2)$tip = 'user';
else $tip = 'admin';
if($post['onlick'] == 1 and $post['tip'] == $tip){
mysql_query('UPDATE `ticket_msg` SET `onlick` = "0" WHERE `id` = "'.$post['id'].'"');
}
echo "<div class='de'>";
echo "<a href='/hero/$ank[id]#".$r."'><img src='/icons/".$ank['sex'].".png'> $ank[login]</a> - ".($post['onlick'] == 1 ? "<font color='green'>".vremja($post['time'])."</font><br>" : vremja($post['time'])."<br>")."".text_msg($post['text'])."";
echo "</div>";
}
echo "</div>";
if($k_post > 10){
echo "<div class='text center'>";
str('?id='.$ticket['id'].'&',$k_page,$page); // Вывод страниц
echo "</div>";
}
if(isset($_REQUEST['submit'])){
$text = text($_POST['text']);
if($user['access'] == 2)$tip = 'admin';
else $tip = 'user';
if(strlen($text) < 1 or strlen($text) > 5000)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинное или короткое сообщение</font></div>';
if(!isset($err)){
mysql_query('INSERT INTO `ticket_msg` SET `id_user` = "'.$myID.'", `id_ticket` = "'.$ticket['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `tip` = "'.$tip.'"');
$_SESSION['msg'] = "";
header('Location: ?id='.$ticket['id'].'#'.$r.'');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?id='.$ticket['id'].'#'.$r.'');
exit();
}
}
if($ticket['status'] == 'otckrit'){
echo "<div class='text center'>";
echo "<form method='post' action=''>";
echo "<input type='text' name='text'><br>";
echo "<input type='submit' class='btn' value='Отправить' name='submit'> <a href='?id=".$ticket['id']."#".$r."'>Обновить</a>";
echo "</form>";
echo "</div>";
}
echo "<a href='/support.php#".$r."' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include 'system/footer.php';
}else{
$title = 'Техническая поддержка';
include 'system/header.php';
if(isset($_REQUEST['submit'])){
$tip = text($_POST['tip']);
$text = text($_POST['text']);
if(strlen($text) < 1 or strlen($text) > 5000)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком длинное или короткое сообщение</font></div>';
if($user['id'] == 0)$err = '<div class="text center"><font color="tomato">Ошибка. У вас нет прав доступа</font></div>';
if(!isset($err)){
mysql_query('INSERT INTO `ticket` SET `id_user` = "'.$myID.'", `tip` = "'.$tip.'", `text` = "'.$text.'", `time` = "'.time().'"');
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Запрос принять, ждите ответа администрации</font></div>";
header('Location: ?#'.$r.'');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?#'.$r.'');
exit();
}
}
echo "<div class='text center'>";
echo "<form method='post' action=''>";
echo 'Тип обращения:<br />
<select name="tip">
<option value="Другое">Другое</option>
<option value="Восстановление аккаунта">Восстановление аккаунта</option>
<option value="Ошибка/ баг">Ошибка/ баг</option>
<option value="Вопросы по игре">Вопросы по игре</option>
<option value="Вопросы по оплате"> Вопросы по оплате</option>
</select><br/>';
echo "Сообщение:<br><input type='text' name='text'><br>";
echo "<input type='submit' class='btn' value='Создать тикет' name='submit'>";
echo "</form>";
echo "</div>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `ticket` WHERE `id_user` = '$myID'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `ticket` WHERE `id_user` = '$myID' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
echo '<div class="text">';
if($k_post == 0)echo '<center><font color="tomato">Вы еще не обращались в техническую поддержку</font></center>';
while($post = mysql_fetch_assoc($q)) {
$onlick = mysql_result(mysql_query("SELECT COUNT(*) FROM `ticket_msg` WHERE `id_ticket` = '$post[id]' AND `onlick` = '1' AND `tip` = 'admin'"),0);
echo "<a href='/support.php?id=$post[id]#".$r."' class='link'><img src='/icons/right.png'> ".rez_text($post['tip'])." ".($onlick >= 1 ? "<font color='green'>(+)</font>" : "")."</a>";
}
echo "</div>";
if($k_post > 10){
echo "<div class='text center'>";
str('?',$k_page,$page); 
echo "</div>";
}
include 'system/footer.php';
}
?>