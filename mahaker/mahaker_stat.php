<?php
include '../system/func.php';
$title = 'Статистика игры';
auth();
include '../system/header.php';
if($user['access'] <= 1){
header('Location: /');
}
//онлайн
$one = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `online` > '".(time()-60)."'"),0);
$two = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `online` > '".(time()-600)."'"),0);
$three = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `online` > '".(time()-15200)."'"),0);
$sea = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `online` > '".(time()-86400)."'"),0);
//
echo '<div class="de center">Статистика игры</div>';
echo '<div class="text">';
echo '<img src="/icons/right.png"> Онлайн за 1м - '.$one.'<hr>';
echo '<img src="/icons/right.png"> Онлайн за 10м - '.$two.'<hr>';
echo '<img src="/icons/right.png"> Онлайн за 4ч - '.$three.'<hr>';
echo '<img src="/icons/right.png"> Онлайн за 1д - '.$sea.'';
echo '</div>';
echo '<a href="/mahaker/mahaker_panel.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include '../system/footer.php';
?>