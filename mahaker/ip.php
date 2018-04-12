<?php
require_once ('../system/func.php');
$title = 'IP';
require_once ('../system/header.php');
auth();
if($user['access'] <= 0){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
if($id){
$prof = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
if(!$prof){
$_SESSION['msg'] = "<div class='text center'><font color='tomato'>Ошибка. Игрок не найден</font></div>";
header("Location: /hero/");
exit();
}
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `ip` = '$prof[ip]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `users` WHERE `ip` = '$prof[ip]' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
echo "<div class='de center'>IP: $prof[ip]";
echo" - <font color=red>[$k_post]</font></div>"; 
while($post = mysql_fetch_assoc($q)) {
echo "<a href='/hero/$post[id]' class='link'><img src='/icons/$post[sex].png'> $post[login], $post[level] ур.</a>";
}
echo '</div>';
if($k_post > 10){
echo "<div class='de center'>";
str('?',$k_page,$page); 
echo "</div>";
}
}
include '../system/footer.php';
?>