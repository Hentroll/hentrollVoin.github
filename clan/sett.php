<?php
include '../system/func.php';
$title = 'Настройки клана';
include '../system/header.php';
auth();
if($user['id_clan'] == 0){
header('Location: /');
exit();
}
echo "<div class='de center'>".$title."</div>";
echo "<div class='text'>";
if($user['clan_rang'] >= 3)echo "<a href='/clan/index.php?id=".$user['id_clan']."&info' class='link'><img src='/icons/right.png' width='16' height='16'> Оформить объявление</a>";
if($user['clan_rang'] == 5)echo "<a href='/clan/index.php?id=".$user['id_clan']."&name' class='link'><img src='/icons/right.png'> Сменить название клана</a>";
echo "<a href='/clan/gerb.php' class='link'><img src='/icons/right.png'> Сменить герб клана</a>";
if($user['clan_rang'] <= 4)echo "<a href='/clan/index.php?id=".$user['id_clan']."&exit' class='link'><img src='/icons/right.png'> Покинуть клан</a>";
echo "</div>";
echo "<a href='/clan/index.php?id=".$user['id_clan']."' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include '../system/footer.php';
?>