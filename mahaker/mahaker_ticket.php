<?
require_once ('../system/func.php');
auth();
if($user['access'] <=1){ header('Location: /');
}
$title = 'Служба поддержки';
require_once ('../system/header.php');
echo "<div class='de center'>Техническая поддержка</div>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `ticket`"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `ticket` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
echo "<div class='text'>";
if($k_post == 0) echo "<center><font color='tomato'>Обращений в техническую поддержку не обнаружено</font></center>";
while($post = mysql_fetch_assoc($q)) {
$onlick = mysql_result(mysql_query("SELECT COUNT(*) FROM `ticket_msg` WHERE `id_ticket` = '$post[id]' AND `onlick` = '1' AND `tip` = 'user'"),0);
if($post['status'] == 'close')echo "<a href='/support.php?id=$post[id]' class='link'><img src='/icons/right.png'> <font color='red'>".rez_text($post['tip'])."</font> ".($onlick >= 1 ? "<font color='green'>(+)</font>" : "")."</a>";
else echo "<a href='/support.php?id=$post[id]' class='link'><img src='/icons/right.png'> ".rez_text($post['tip'])." ".($onlick >= 1 ? "<font color='green'>(+)</font>" : "")."</a>";
}
echo "</div>";
if($k_post > 10){
echo "<div class='text center'>";
str('?',$k_page,$page);
echo "</div>";
}
echo "<a href='/mahaker/mahaker_panel.php' class='link'><img src='/icons/right.png'> Вернуться назад</a>";
require_once ('../system/footer.php');
?>