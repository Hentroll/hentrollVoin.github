<?php
require_once ('system/func.php');
$title = 'Онлайн';
require_once ('system/header.php');
auth();
if($user['save'] <= 1){
header("Location: /home.php?error");
}
$set['p_str'] = 10;
if(isset($_GET['clan'])){
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `online` > '".(time()-15200)."' AND `id_clan` = '0' AND `level` >= '1'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `users` WHERE `online` > '".(time()-15200)."' AND `id_clan` = '0' AND `level` >= '1' AND `clan_off` = '0' ORDER BY `level` ASC, `exp` ASC LIMIT $start, $set[p_str]");
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='?' class='des'>Все</a></td> <td style='width: 50%;' class='center'><a href='?clan' class='des'><font color='silver'>Без клана</font></a></td></tr></table></div>";
if($k_post == 0)echo "<div class='text center'><font color='tomato'>Игроков которые не состоят в клане, сейчас нет!</font></div>";
echo "<div class='text'>";
while($post = mysql_fetch_assoc($q)) {
echo "<a href='/hero/$post[id]' class='link'><img src='/icons/".$post['sex'].".png' width='' height=''> $post[login], <img src='/icons/str.png' width='16' height='16'>".($post['str']+$post['def']+$post['max_health'])." </a>";
}
echo '</div>';
if($k_post > 10){
echo "<div class='text center'>";
str('?clan&',$k_page,$page);
echo "</div>";
}
require_once ('system/footer.php');
exit;
}
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `online` > '".(time()-15200)."'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `users` WHERE `online` > '".(time()-15200)."' ORDER BY `level` DESC, `exp` DESC LIMIT $start, $set[p_str]");
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='?' class='des'><font color='silver'>Все</font></a></td> <td style='width: 50%;' class='center'><a href='?clan' class='des'>Без клана</a></td></tr></table></div>";
echo "<div class='text'>";
while($post = mysql_fetch_assoc($q)) {
echo "<a href='/hero/$post[id]' class='link'><img src='/icons/".$post['sex'].".png'> $post[login], <img src='/icons/str.png' width='16' height='16'>".($post['str']+$post['def']+$post['max_health'])." </a>";
}
echo '</div>';
if($k_post > 10){
echo "<div class='text center'>";
str('?',$k_page,$page); 
echo "</div>";
}

if(isset($_REQUEST['search_nick'])){
$login = text($_POST[login]);
if(empty($login)){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Ошибка. Логин не введен</font></div>';
header("Location: ?");
exit();
}else{
$sql = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `login` = '".$login."' AND `bot` = '0' LIMIT 1"));
header("Location: /hero/$sql[id]");
exit();
}
}
echo "<div class='text center'>";
echo '<form action="?" method="post">';

echo 'Ник:<br><input class="center" type="text" name="login" maxlength="50" value="" /><br/>';
echo '<input type="submit" name="search_nick" class="btn" value="Поиск">';
echo '</form>';
echo "</div>";
require_once ('system/footer.php');
?>