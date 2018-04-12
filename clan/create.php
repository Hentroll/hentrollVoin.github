<?php
include '../system/func.php'; auth();
$title = 'Создание клана';
include '../system/header.php';
//space
if($user['id_clan'] >= 1){
header('Location: /clan/index.php?id='.$user['id_clan'].'');
exit();
}
//space
if(isset($_GET['new_clan_post'])){ 
if(isset($_POST['name'])){ 
$name = text(esc($_POST['name'])); 
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `clans` WHERE `name` = '$name'"),0); 
if(strlen($name) < 1 or strlen($name) > 50)$err = '<div class="text center"><font color="tomato">Ошибка. Слишком короткое или длинное название клана</font></div>'; 
if($k_post >= 1)$err = '<div class="text center"><font color="tomato">Ошибка. Такое название клана занято</font></div>'; 
if($user['gold'] < 1000)$err = '<div class="text center"><font color="tomato">Недостаточно золота</font><br><a href="/worldkassa/"><u>Купить золото</u></a></div>';
if(!$err){ 
if(mysql_query("INSERT INTO `clans` SET `name` = '$name', `date` = '".time()."', `side` = '$user[side]'")){
$id = mysql_insert_id(); 
mysql_query("UPDATE `users` SET `clan_rang` = '5',`vstup` = '".time()."', `id_clan` = '$id', `gold` = '".($user[gold]-1000)."' WHERE `id` = '".$myID."'");
header('Location: /clan/index.php?id='.$user['id_clan'].'');
exit(); 
} 
}else{ 
$_SESSION['msg'] = $err; 
header('Location: ?'.$r.'');
exit(); 
} 
}else{ 
header('Location: ?'.$r.'');
exit(); 
} 
} 
echo "<div class='de center'>".$title."</div>";
echo "<div class='text center'>";
echo "<form method='post' action='?new_clan_post'>";
echo "<input type='text' name='name'>";
echo "<br><input type='submit' class='btn' value='Создать клан'> <a href='?".$r."'>Обновить</a><br><br><a><u>Стоимость: 1000<img src='/icons/gold.png' width='16' height='16'></u></a></form>";
echo "</div>"; 
echo "<a href='/clan/menu.php' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include '../system/footer.php'; 
?>