<?php
include '../system/func.php';
$title = 'Легенда';
auth();
include '../system/head.php';
if($user['texr'] == '0'){
header('Location: /home.php');
exit();
}
echo '<div class="text center"><img src="/icons/logo.png" width="100%" height="140"><hr>Здравствуйте, <img src="/icons/'.$user['sex'].'.png" width="13" height="13"> <a>'.$user['login'].'</a>.<hr><font color="tomato">В игре идут технические работы!</font></div>';
$second = rand(3,8);
$r = rand(100000,999999);
echo '<center><font color="silver">0.00'.$second.' сек. '.vremja().'<br>Легенда 2017, 16+</font><br><a href="http://statok.net/go/17037"><img src="http://statok.net/image/17037" alt="Statok.net" /></a></center>';
?>