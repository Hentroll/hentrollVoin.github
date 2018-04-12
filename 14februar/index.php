<?php
include '../system/func.php';
$title = 'День влюбленных';
auth();
include '../system/header.php';
echo '<div class="de"><center><img src="/icons/14february/heard.png"> '.$title.'</center><hr><img src="/icons/14february/heard.png"> Сердечек: '.$user['fb_heard'].'<br><img src="/icons/right.png"> Стрел: '.$user['fb_strel'].'</div>';
echo '<div class="text">';
echo '<a href="/14february/bash.php" class="link"><img src="/icons/14february/bash.png" width="16" height="16"> Башня</a>';
//echo '<a href="/14february/pr.php" class="link"><img src="/icons/14february/search.png" width="16" height="16"> Найти </a>';
//
echo '<a href="/14february/train.php" class="link"><img src="/icons/14february/train.png" width="16" height="16"> Тренировка</a>';
echo '<a href="/14february/sun.php" class="link"><img src="/icons/14february/sun.png" width="16" height="16"> Сундуки</a>';
echo '<a href="/14february/shop.php" class="link"><img src="/icons/14february/shop.png" width="16" height="16"> Магазин</a>';
echo '<a href="/14february/rating.php" class="link"><img src="/icons/rating.png"> Рейтинг</a>';
echo '</div>';
echo '<div class="text center"><img src="/icons/14february/yw.png"> Информация<hr><font color="silver">Собирайте сердечки и поднимайтесь выше и выше по рейтингу, для того чтобы получить главный приз: <img src="/icons/gold.png" width="16" height="16">5000 золота!</font></div>';
include '../system/footer.php';
?>