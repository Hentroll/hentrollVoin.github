<?php
include '../system/func.php';
$title = 'Магазин';
auth();
include '../system/header.php';
	if(isset($_GET['pay'])){
		$pay=abs(intval($_GET['pay']));
if($pay==1){$price=10; $stats=1;}
if($pay==2){$price=50; $stats=5;}
if($pay==3){$price=100; $stats=10;}
if($pay==4){$price=500; $stats=50;}
if($pay==5){$price=1000; $stats=100;}
if($user['gold'] < $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота</font></div>';
header('Location: /14february/shop.php?st#'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `fb_strel` = '".($user['fb_strel'] + $stats)."', `gold` = '".($user['gold'] - $price)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Стрелы успешно приобретены</font></div>';
header('Location: /14february/shop.php?st#'.$r.'');
exit();
}

echo '<div class="de center"><img src="/icons/14february/heard.png"> '.$title.'</div>';
echo '<div class="text center"><font color="silver">В магазине вы можете приобрести Стрелы, которые нужны для стрельбы из лука в тренировке!</font><br>У вас стрел: '.$user['fb_strel'].'</div>';
echo '<div class="text center">';
echo 'Купить 1 стрелу за 10 золота?<br>';
echo '<a href="?pay=1" class="but">Приобрести</a>';
echo '</div>';
echo '<div class="text center">';
echo 'Купить 5 стрел за 50 золота?<br>';
echo '<a href="?pay=2" class="but">Приобрести</a>';
echo '</div>';
echo '<div class="text center">';
echo 'Купить 10 стрел за 100 золота?<br>';
echo '<a href="?pay=3" class="but">Приобрести</a>';
echo '</div>';
echo '<div class="text center">';
echo 'Купить 50 стрел за 500 золота?<br>';
echo '<a href="?pay=4" class="but">Приобрести</a>';
echo '</div>';
echo '<div class="text center">';
echo 'Купить 100 стрел за 1000 золота?<br>';
echo '<a href="?pay=5" class="but">Приобрести</a>';
echo '</div>';
echo '<a href="/14february/index.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include '../system/footer.php';
?>