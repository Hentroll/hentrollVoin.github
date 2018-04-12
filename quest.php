<?php
include 'system/func.php';
$title = 'Ежедневные задания';
auth();
include 'system/header.php';
if($user['save'] <= 1){
header('Location: /');
exit();
}
echo '<div class="text center"><img src="/icons/quest.png" width="16" height="16"> '.$title.'</div>';
include 'my_inc/quest/1.php';
include 'my_inc/quest/2.php';
include 'my_inc/quest/3.php';
if($user['id_clan'] >= 1){
include 'my_inc/quest/4.php';
}
include 'my_inc/quest/5.php';
include 'my_inc/quest/6.php';
include 'system/footer.php';
?>