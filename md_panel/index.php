<?php
include '../system/func.php';
auth();
$title = 'Панель управления';
include '../system/header.php';
if($user['access'] <= 0){
header("Location: /home.php?error");
}
echo '<div class="de center">'.$title.' </div>';
echo '<div class="text">';
echo "<a href='/md_panel/chat.php' class='link'><img src='/icons/right.png'> Админ-чат [".mysql_num_rows(mysql_query("SELECT * FROM `admin_chat` WHERE `id` > '0'"))."]</a>";
echo "<a href='/md_panel/stat.php' class='link'><img src='/icons/right.png'> Статистика игры</a>";
echo "<a href='/md_panel/mail.php' class='link'><img src='/icons/right.png'> Шпион почты</a>";
echo '</div>';
include '../system/footer.php';
?>