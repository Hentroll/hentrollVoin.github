<?php
include 'system/func.php';
$title = 'Подарок на 23 февраля';
auth();
include 'system/header.php';
if($user['access'] <= 1){
header('Location: /');
exit();
}
//получаем бонус
if(isset($_GET['okay'])){
if($user['r'] >= 1){
header('Location: ?'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + 1000)."', `crystals` = '".($user['crystals'] + 50000)."', `r` = '".($user['r'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Подарок получен!</font></div>';
header('Location: ?'.$r.'');
exit();
}
//
echo '<div class="text center"><img src="/icons/new_year.png" width="16" height="16"> '.$title.'</div>';
echo '<div class="text center">Администрация игры, дарит вам подарок, на 23 февраля.<br>В размере: <img src="/icons/gold.png" width="16" height="16">1000 золота и <img src="/icons/silver.png" width="16" height="16">50000 серебра!';
if($user['r'] == 0){
echo '<hr><a href="?okay" class="but">Получить подарок</a>';
}
echo '</div>';
include 'system/footer.php';
?>