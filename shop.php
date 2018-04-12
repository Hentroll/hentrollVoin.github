<?php
include 'system/func.php';
$title = 'Магазин';
auth();
include 'system/header.php';
if(isset($_GET['zl'])){
include 'my_inc/shop/zl.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['pay_silver'])){
include 'my_inc/shop/pay_silver.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['runs'])){
include 'my_inc/shop/runs.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['snar'])){
include 'my_inc/shop/snar.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['zat'])){
include 'my_inc/shop/zat.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['talis'])){
include 'my_inc/shop/talis.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['vip'])){
include 'my_inc/shop/vip.php';
include 'system/footer.php';
exit();
}
echo '<div class="de center">'.$title.'</div>';
echo '<div class="text">';
echo '<a href="?snar#'.$r.'" class="link"><img src="/icons/equip.png" width="16" height="16"> Снаряжение</a>';
echo '<a href="?runs#'.$r.'" class="link"><img src="/icons/item/complect_5.png" width="" height=""> Магазин рун</a>';
echo '<a href="?zat#'.$r.'" class="link"><img src="/icons/smith.png" width="16" height="16"> Заточка Вещей</a>';
echo '<a href="?talis#'.$r.'" class="link"><img src="/icons/talis.png" width="16" height="16"> Талисманы</a>';
echo '<a href="?zl#'.$r.'" class="link"><img src="/icons/wizard.png" width="16" height="16"> Зелья</a>';
echo '<a href="?vip#'.$r.'" class="link"><img src="/icons/premium.png" width="16" height="16"> Вип-аккаунт</a>';
echo '<a href="?pay_silver#'.$r.'" class="link"><img src="/icons/silver.png" width="16" height="16"> Покупка серебра</a>';
echo '</div>';
include 'system/footer.php';
?>