<?php
$title = 'Покупка серебра';
	if(isset($_GET['silver'])){
		$silver=abs(intval($_GET['silver']));
if($silver==1){$gold=1; $sil=100;}
if($silver==2){$gold=10; $sil=1000;}
if($silver==3){$gold=50; $sil=5000;}
if($silver==4){$gold=250; $sil=25000;}
if($silver==5){$gold=500; $sil=50000;}
if($user['gold'] < $gold){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота</font></div>';
header('Location: /shop.php?pay_silver#'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `crystals` = '".($user['crystals'] + $sil)."', `gold` = '".($user['gold'] - $gold)."' WHERE `id` = '".$user['id']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вы успешно приобрели серебро</font></div>';
header('Location: /shop.php?pay_silver#'.$r.'');
exit();
}

echo '<div class="de center">'.$title.'</div>';
echo '<div class="text center">';
echo 'Купить 100 серебра за 1 золото?<br>';
echo '<a href="?pay_silver&silver=1" class="but">Приобрести</a>';
echo '</div>';
echo '<div class="text center">';
echo 'Купить 1000 серебра за 10 золота?<br>';
echo '<a href="?pay_silver&silver=2" class="but">Приобрести</a>';
echo '</div>';
echo '<div class="text center">';
echo 'Купить 5000 серебра за 50 золота?<br>';
echo '<a href="?pay_silver&silver=3" class="but">Приобрести</a>';
echo '</div>';
echo '<div class="text center">';
echo 'Купить 25000 серебра за 250 золота?<br>';
echo '<a href="?pay_silver&silver=4" class="but">Приобрести</a>';
echo '</div>';
echo '<div class="text center">';
echo 'Купить 50000 серебра за 500 золота?<br>';
echo '<a href="?pay_silver&silver=5" class="but">Приобрести</a>';
echo '</div>';
echo '<a href="/shop.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>