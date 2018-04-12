<?php
auth();
//покупка талисманов
if(isset($_GET['ring'])){
if($user['ring'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже приобрели кольцо власти</font></div>';
header('Location: /shop.php?talis#'.$r.'');
exit();
}
if($user['gold'] <= 249){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: /shop.php?talis#'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `ring` = '1', `gold` = '".($user['gold'] - 250)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вы успешно приобрели кольцо власти</font></div>';
header('Location: /shop.php?talis#'.$r.'');
exit();
}
if(isset($_GET['amulet'])){
if($user['amulet'] == 1){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Вы уже приобрели амулет силы</font></div>';
header('Location: /shop.php?talis#'.$r.'');
exit();
}
if($user['gold'] <= 249){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота<br><a href="/worldkassa/"><u>Купить золото</u></a></font></div>';
header('Location: /shop.php?talis#'.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `amulet` = '1', `gold` = '".($user['gold'] - 250)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Вы успешно приобрели амулет силы</font></div>';
header('Location: /shop.php?talis#'.$r.'');
exit();
}
//
//страница
echo '<div class="de center">Талисманы</div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/ring.png" width="50" height="50"></div> Кольцо власти<br>Бонус: Больше опыта<br>';
if($user['ring'] == 0)echo 'Стоимость: 250<img src="/icons/gold.png" width="16" height="16"><br><br><center><a href="/shop.php?talis&ring" class="but">Приобрести</a></center>';
else
echo '<font color="lime">Приобретено</font><br><br><center><a href="/ring.php" class="but">Улучшить</a></center>';
echo '</div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/amulet.png" width="50" height="50"></div> Амулет силы<br>Бонус: Больше серебра<br>';
if($user['amulet'] == 0)echo 'Стоимость: 250<img src="/icons/gold.png" width="16" height="16"><br><br><center><a href="/shop.php?talis&amulet" class="but">Приобрести</a></center>';
else
echo '<font color="lime">Приобретено</font><br><br><center><a href="/amulet.php" class="but">Улучшить</a></center>';
echo '</div>';
echo '<a href="/shop.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
//
?>