<?php
auth();
if(isset($_GET['complect_1'])){
include 'my_inc/shop/complect_1.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['complect_2'])){
include 'my_inc/shop/complect_2.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['complect_3'])){
include 'my_inc/shop/complect_3.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['complect_4'])){
include 'my_inc/shop/complect_4.php';
include 'system/footer.php';
exit();
}
if(isset($_GET['complect_5'])){
include 'my_inc/shop/complect_5.php';
include 'system/footer.php';
exit();
}
echo '<div class="de center">Магазин снаряжения</div>';
echo '<div class="text">';
echo '<a href="?snar&complect_5" class="link"><div class="oh"><img src="/icons/item/complect_5.png" width="13" height="13"></div> Комплект бога</a>';
echo '<a href="?snar&complect_4" class="link"><div class="oh"><img src="/icons/item/complect_4.png" width="13" height="13"></div> Комплект легенды</a>';
echo '<a href="?snar&complect_3" class="link"><div class="oh"><img src="/icons/item/complect_3.png" width="13" height="13"></div> Комплект полководца</a>';
echo '<a href="?snar&complect_2" class="link"><div class="oh"><img src="/icons/item/complect_2.png" width="13" height="13"></div> Комплект рыцаря</a>';
echo '<a href="?snar&complect_1" class="link"><div class="oh"><img src="/icons/item/complect_1.png" width="13" height="13"></div> Комплект разбойника</a>';
echo '</div>';
echo '<a href="?" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>