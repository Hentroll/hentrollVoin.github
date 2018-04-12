<?php
require_once ('system/func.php');
$title = 'Лучшие';
require_once ('system/header.php');
auth();
if($user['save'] <= 1){
header("Location: /home.php?error");
}
$i = null;
$a = null;
$set['p_str'] = 10;
$k_post = 1000;
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `users` WHERE `id` > '0' ORDER BY `str`+`def`+`max_health` DESC, `online` DESC LIMIT $start, $set[p_str]");
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='?#".$r."' class='des'><font color='silver'>Рейтинг игроков</font></a></td> <td style='width: 50%;' class='center'><a href='/clan/rating.php' class='des'><font color='silver'>Рейтинг кланов</font></a></td></tr></table></div>";
echo "<div class='de'>";
while($post = mysql_fetch_assoc($q)) {
$i++;
if($i < 11){
echo "<a href='/hero/$post[id]#".$r."' class='link'><font color='silver'>".($i+$start).".</font> <img src='/icons/".$post['sex'].".png'> $post[login], $post[level] ур.<br>";
echo "<font color='silver'>Параметры:  ".($post['str']+$post['def']+$post['max_health'])."</font></a>";
}
}
echo '</div>';
if($k_post > 10){
echo '<div class="de center">';
str('?',$k_page,$page); // Вывод страниц
echo "</div>";
}
$q = mysql_query("SELECT * FROM `users` WHERE `id` > '0' ORDER BY `str`+`def`+`max_health` DESC, `online` DESC");
while($post = mysql_fetch_assoc($q)){
$a++;
if($post['id'] == $myID){
if($a <= 1000)echo "<div class='text center'><font color='lime'>Вы находитесь на <b>$a</b> месте в рейтинге!</font></div>";
else echo "<div class='text center'><font color='tomato'>Вы не участвуете в рейтинге</font></div>";
}
}
require_once ('system/footer.php');
?>