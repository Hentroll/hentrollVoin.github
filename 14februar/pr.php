<?php
include '../system/func.php';
if($user['sex'] == 'm'){
$title = 'Найти принцессу';
}
if($user['sex'] == 'w'){
$title = 'Найти принца';
}
auth();
include '../system/header.php';
echo '<div class="de center"><img src="/icons/14february/search.png" width="16" height="16"> '.$title.'</div>';
echo '<a href="/14february/index.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include '../system/footer.php';
?>