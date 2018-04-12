<?php
include '../system/func.php';
$title = 'Легенда';
auth();
include '../system/head.php';
$block = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `block` = "1" ORDER BY `id` DESC LIMIT 1');
$block = mysql_fetch_array($block);
if($block['id_user'] == 0 && $block['block'] == 0){
header('Location: /');
exit;
}
echo '<div class="text center"><img src="/icons/logo.png" width="100%" height="140"><br><img src="/icons/'.$user['sex'].'.png" width="13" height="13"> <a><u>'.$user['login'].'</u></a> - Goodbye.<hr><font color="tomato">Мы с тобой больше не играем!</font></div>';
?>