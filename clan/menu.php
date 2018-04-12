<?php
include '../system/func.php';
$title = 'Без клана';
auth();
include '../system/header.php';
//space
if($user['id_clan'] >= 1){
header('Location: /clan/index.php?id='.$user['id_clan'].'');
exit();
}
echo '<div class="de center">'.$title.'</div>';
echo '<div class="text center">Вы хотите создать свой клан?<br>Или хотите вступить в уже существующий клан?<br><br><a href="/clan/rating.php" class="but">Рейтинг кланов</a><hr>Хотите быть лидером клана, создайте свой!<br><br><a href="/clan/create.php" class="but">Создать клан</a></div>';
include '../system/footer.php';
?>