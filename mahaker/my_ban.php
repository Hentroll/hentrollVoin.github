<?php
include '../system/func.php';
auth();
$title = "Мои нарушения";
include '../system/header.php';
echo "<div class='de center'>Мои нарушения</div>";
echo "<div class='text'>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$myID'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `ban` WHERE `id_user` = '$myID' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
if($k_post == 0)echo "<center><font color='silver'>Вы хороший человек, таким и оставайтесь! :)</font></center>";
while($post = mysql_fetch_assoc($q)) {
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$post[id_admin]' ORDER BY `id` DESC LIMIT 1"));
echo "<a href='/hero/$ank[id]'><img src='/icons/$ank[sex].png'> $ank[login]</a>: ".text_msg($post['text'])."<br>";
if($post['last'] > time()){
echo "Осталось: ".tl($post['last']-time());
}else{
echo "Бан истек";
}
}
echo '</div>';
if($k_post > 10){
echo '<div class="de center">';
str('?',$k_page,$page);
echo "</div>";
}
include '../system/footer.php';
?>