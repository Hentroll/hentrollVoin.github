<?php
include '../system/func.php';
$title = 'Башня';
auth();
include '../system/header.php';
//улучшаем башню
$gold = rand(1,5);
$exp = rand(40,70);
$price = ''.$user['fb_bash_up'].'';
if(isset($_GET['up'])){
if($user['crystals'] < $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">У вас недостаточно серебра!</font></div>';
header('Location: ?');
exit();
}
mysql_query("UPDATE `users` SET `crystals` = '".($user['crystals'] - $price)."', `fb_bash` = '".($user['fb_bash'] + 2)."', `fb_heard` = '".($user['fb_heard'] + 2)."', `fb_bash_up` = '".($user['fb_bash_up'] * 2)."', `gold` = '".($user['gold'] + $gold)."', `exp` = '".($user['exp'] + $exp)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Награда:</font><br>+ <img src="/icons/gold.png" width="16" height="16">'.$gold.', <img src="/icons/exp.png" width="14" height="14"> '.$exp.', <img src="/icons/14february/heard.png" width="16" height="16"> 2</div>';
header('Location: ?');
exit();
}
//
echo '<div class="de center"><img src="/icons/14february/bash.png" width="16" height="16"> '.$title.'</div>';
echo '<div class="text center"><a class="teac center" style="border-center: 1px solid #000000;">Башня<br><img src="/icons/14february/bashna.png" width="60" height="120"><br> '.$user['fb_bash'].' м.</a></div>';
echo '<div class="de center">';
echo '<a href="?up" class="but">Улучшить башню</a><hr>Цена:  <img src="/icons/silver.png" width="16" height="16">'.($user['fb_bash_up']).' ';
echo '</div>';
echo '<div class="text center"><img src="/icons/14february/yw.png"> Информация<hr><font color="silver">Строите башню выше и выше, получая за это сердечки!<br>Башня улучшается только за серебро!</font></div>';
echo '<a href="/14february/index.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include '../system/footer.php';
?>