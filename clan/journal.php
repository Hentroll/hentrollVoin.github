<?php
include '../system/func.php';
auth();
$a = null;
$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."'"));
$title = 'Журнал клана';
include '../system/header.php';
echo "<div class='de center'>".$title."</div>";
echo "<div class='text'>";
$q = mysql_query("SELECT * FROM `clans` ORDER BY `level` DESC, `exp` DESC");
while($post = mysql_fetch_assoc($q)){
$a++;
}
$set['p_str'] = 15;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `clan_journal` WHERE `id_clan` = '$clan[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `clan_journal` WHERE `id_clan` = '$clan[id]' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
if($k_post == 0) echo "<font color='tomato'><center>Журнал клана пуст.</center></font>";
while($post = mysql_fetch_assoc($q)){
echo "<img src='/icons/red.png'>".vremja($post['time']).".<br> ".$post['text']."<hr>";
}
echo "</div>";
if($k_post > 10){
echo "<div class='text center'>";
str('?',$k_page,$page);
echo "</div>";
}
echo "<a href='/clan/index.php?id=".$user['id_clan']."' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
$clan = null;
include '../system/footer.php';
?>