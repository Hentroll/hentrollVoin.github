<?
require_once ('../system/func.php');
$title = 'Список забаненых';
require_once ('../system/header.php');
auth();
if($user['access'] <= 1){
header('Location: /');
}
echo "<div class='text'>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `last` > '".time()."' OR `block` = '1'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `ban` WHERE `last` > '".time()."' OR `block` = '1' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
if($k_post == 0)echo "<center><font color='tomato'>Забаненных игроков не обнаруженно</font></center>";
while($post = mysql_fetch_assoc($q)) {
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$post[id_user]' ORDER BY `id` DESC LIMIT 1"));
echo "<a href='/ban/$ank[id]' class='link'><img src='/icons/".$ank['sex'].".png'> $ank[login]</a>";
}
echo '</div>';
if($k_post > 10){
echo '<div class="text center"';
str('?',$k_page,$page); 
echo "</div>";
}
if($user['access'] == 2)echo "<a href='/mahaker/mahaker_panel.php' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
require_once ('../system/footer.php');
?>