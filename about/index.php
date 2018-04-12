<?php
include '../system/func.php';
$title = 'Об игре';
auth();
include '../system/header.php';
if($user['save'] <= 1){
header("Location: /home.php?error");
}
if(isset($_GET['smiles'])){
echo '<div class="de center">Смайлы</div>';
echo '<div class="text">';
$sql = mysql_query("SELECT * FROM `smile` ");
while($smile = mysql_fetch_array($sql)){
echo "<img src='".$smile['img']."'> ".$smile['name']."<hr>";
}
echo "</div>";
echo '<a href="/about" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include '../system/footer.php';
exit;
}

if(isset($_GET['md'])){
echo "<div class='de center'>Модераторы</div><div class='text'>";
$q = mysql_query("SELECT * FROM `users` WHERE `access` > '0' ORDER BY `online` DESC");
while($post = mysql_fetch_assoc($q)) {
echo "<a href='/hero/$post[id]' class='link'><img src='/icons/".$post['sex'].".png'> $post[login] ";
if($post['access'] == 2)echo '<font color="lime">[Адм]</font>';
else
if($post['access'] == 1)echo '<font color="green">[Мд]</font>';
echo "</a>";
}
echo '</div><a href="/about" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include '../system/footer.php';
exit;
}
echo '<div class="de center">Об игре</div>';
echo '<div class="text">';
echo '<a href="?md" class="link"><img src="/icons/right.png" width="16" height="16"> Модераторы</a>';
echo '<a href="?smiles" class="link"><img src="/icons/right.png" width="16" height="16"> Смайлы</a>';
echo '<a href="/about/rules.php" class="link"><img src="/icons/right.png" width="16" height="16"> Правила</a>';
echo '<a href="/ref.php" class="link"><img src="/icons/right.png" width="16" height="16"> Пригласить друга</a>';
echo '</div>';
include '../system/footer.php';
?>