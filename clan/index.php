<?php
include '../system/func.php';
auth();
# Настройки #
$id = abs(intval($_GET['id']));
if($id)$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$id."'"));
else $clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."'"));
# Ошибки #
if(!$clan){
header('Location: /clan/menu.php');
exit();
}
if($clan['tour'] >= 0 && $clan['tour'] <= 9)$gold = 0;
elseif($clan['tour'] >= 10 && $clan['tour'] <= 24)$gold = 5;
elseif($clan['tour'] >= 25 && $clan['tour'] <= 49)$gold = 10;
elseif($clan['tour'] >= 50 && $clan['tour'] <= 99)$gold = 15;
elseif($clan['tour'] >= 100 && $clan['tour'] <= 149)$gold = 25;
elseif($clan['tour'] >= 150 && $clan['tour'] <= 299)$gold = 50;
elseif($clan['tour'] >= 300 && $clan['tour'] <= 499)$gold = 100;
elseif($clan['tour'] >= 500 && $clan['tour'] <= 999)$gold = 250;
elseif($clan['tour'] >= 1000)$gold = 500;
if(isset($_GET['tour']) && $user['id_clan'] >= 1){
if($user['id_clan'] != $clan['id']){
header('Location: /clan/index.php?id='.$user['id_clan'].'&tour#'.$r.'');
exit();
}
if(isset($_GET['tour_ok']) && $user['id_clan'] >= 1 && $user['clan_rang'] >= 4 && $clan['tour'] >= 10 && $clan['id'] == $user['id_clan']){
mysql_query("UPDATE `clans` SET `tour` = '0', `gold` = '".($clan['gold'] + $gold)."' WHERE `id` = '".$user['id_clan']."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Золото перечисленно в казну</font></div>';
header('Location: /clan/index.php?id='.$user['id_clan'].'&tour#'.$r.'');
exit();
}
$title = 'Клановый турнир';
include '../system/header.php';
echo '<div class="de center"><img src="/icons/cland.png" width="14" height="14"> '.$title.'</div>';
echo '<div class="text">';
echo '<center>Чем больше очков рейтинга, тем больше золота можно получить.</center><hr>';
if($user['id_clan'] >= 1 && $user['clan_rang'] >= 4 && $clan['tour'] >= 10)echo '<center><a href="/clan/index.php?id='.$user['id_clan'].'&tour&tour_ok" class="but">Получить золото</a></center>';
echo '<hr><img src="/icons/quest_adven.png" width="16" height="16"> Очки клана: '.$clan['tour'].'<br><img src="/icons/quest_adven.png" width="16" height="16"> Мои очки: '.$user['clan_tour'].'<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">'.$gold.'<br><center><a href="/clan_tour.php?info#'.$r.'"><img src="/icons/cland.png" width="14" height="14"> <u>Подробнее о сражении</u></a></center>';
echo '</div>';
echo "<a href='/clan/index.php?id=".$user['id_clan']."#".$r."' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include '../system/footer.php';
exit();
}
if(isset($_GET['tr']) and $user['id_clan'] == $clan['id']){
if(isset($_GET['gold'])){
$title = 'Рейтинг золота';
include '../system/header.php';
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='/clan/index.php?id=".$user['id_clan']."&tr&gold#".$r."' class='des'><font color='silver'>Рейтинг золота</font></a></td> <td style='width: 50%;' class='center'><a href='/clan/index.php?id=".$user['id_clan']."&tr&silver#".$r."' class='des'><font color='silver'>Рейтинг серебра</font></a></td></tr></table>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id_clan` = '$clan[id]' AND `clan_gold` > '0'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `users` WHERE `id_clan` = '$clan[id]' AND `clan_gold` > '0' ORDER BY `clan_gold` DESC LIMIT $start, $set[p_str]");
echo "<div class='text'>";
if($k_post == 0)echo "<center><font color='tomato'>Ещё не кто не сдал золото в казну</font></center>";
while($post = mysql_fetch_assoc($q)) {
echo "<a href='/hero/$post[id]'><img src='/icons/".$post['sex'].".png'> $post[login]</a><br><img src='/icons/gold.png' width='16' height='16'>Внес: ".n_f($post['clan_gold'],1)." золота<br>";
}
echo '</div>';
if($k_post > 10){
echo '<div class="text center">';
str('/clan/index.php?id=$user[id_clan]&tr&gold&',$k_page,$page);
echo "</div>";
}
echo "<a href='/clan/index.php?id=".$user['id_clan']."&tr' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
$clan = '';
include '../system/footer.php';
exit;
}
if(isset($_GET['silver'])){
$title = 'Рейтинг серебра';
include '../system/header.php';
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='/clan/index.php?id=".$user['id_clan']."&tr&gold#".$r."' class='des'><font color='silver'>Рейтинг золота</font></a></td> <td style='width: 50%;' class='center'><a href='/clan/index.php?id=".$user['id_clan']."&tr&silver#".$r."' class='des'><font color='silver'>Рейтинг серебра</font></a></td></tr></table>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id_clan` = '$clan[id]' and `clan_crystals` > '0'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `users` WHERE `id_clan` = '$clan[id]' AND `clan_crystals` > '0' ORDER BY `clan_crystals` DESC LIMIT $start, $set[p_str]");
echo "<div class='text'>";
if($k_post == 0)echo "<center><font color='tomato'>Ещё не кто не сдал серебро в казну</font></center>";
while($post = mysql_fetch_assoc($q)) {
echo "<a href='/hero/$post[id]'><img src='/icons/".$post['sex'].".png'> $post[login]</a><br><img src='/icons/silver.png' width='16' height='16'>Внес: ".n_f($post['clan_crystals'],1)." серебра<br>";
}
if($k_post > 10){
echo '<div class="de center">';
str('/clan/index.php?id=$user[id_clan]&tr&silver&',$k_page,$page);
echo "</div>";
}
echo "</div><a href='/clan/index.php?id=".$user['id_clan']."&tr' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
$clan = '';
include '../system/footer.php';
exit;
}
if(isset($_GET['resours'])){
if(isset($_POST['gold']) && isset($_POST['crystals'])){
$gold = num($_POST['gold']);
$crystals = num($_POST['crystals']);
if($gold > $user[gold] or $crystals > $user[crystals])$err = '<div class="text center"><font color="tomato">Ошибка. Недостаточно ресурсов</font></div>';
if($gold < 0 or $crystals < 0)$err = '<div class="text center"><font color="tomato">Неизвестная ошибка</font></div>';
if(!$err){
mysql_query("update `users` set `gold` = '".($user['gold']-$gold)."', `crystals` = '".($user['crystals']-$crystals)."', `clan_gold` = '".($user['clan_gold']+$gold)."', `clan_crystals` = '".($user['clan_crystals']+$crystals)."' where (`id` = '".$myID."')");
mysql_query("update `clans` set `gold` = '".($clan['gold']+$gold)."', `crystals` = '".($clan['crystals']+$crystals)."' where (`id` = '".$clan[id]."')");
mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] пополнил казну на $gold золота и $crystals серебра'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Казна клана пополнена</font></div>';
header('Location: /clan/index.php?id='.$user['id_clan'].'&tr');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: /clan/index.php?id='.$user['id_clan'].'&tr');
exit();
}
}else{
$_SESSION['msg'] = '';
header('Location: /clan/index.php?id='.$user['id_clan'].'&tr');
exit();
}
}
$title = 'Казна клана';
include '../system/header.php';
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='/clan/index.php?id=".$user['id_clan']."&tr&gold#".$r."' class='des'><font color='silver'>Рейтинг золота</font></a></td> <td style='width: 50%;' class='center'><a href='/clan/index.php?id=".$user['id_clan']."&tr&silver#".$r."' class='des'><font color='silver'>Рейтинг серебра</font></a></td></tr></table>";
echo "<div class='text center'>";
echo "<div class='left'><img src='/icons/gold.png' width='16' height='16'>Золото: ".n_f($clan['gold'],1)."<br><img src='/icons/silver.png' width='16' height='16'>Серебро: ".n_f($clan['crystals'],1)."</div><hr>";
echo "<form method='post' action='/clan/index.php?id=".$user['id_clan']."&tr&resours'>";
echo "Золото:<br><input type='text' name='gold' value='0' style='width:80%;'></br>Серебро:<br>";
echo "<input type='text' name='crystals' value='0' style='width:80%;'>";
echo "<br><input type='submit' class='btn' value='Отправить'>
</form>";
echo "</div>";
$clan = '';
include '../system/footer.php';
exit;
}
if(isset($_GET['exit_ok']) && $user['id_clan'] == $clan['id']){
if($user['clan_rang'] == 5){
header('Location: /clan/index.php?id='.$r.'');
exit();
}
mysql_query("UPDATE `users` SET `id_clan` = '0', `clan_gold` = '0', `clan_crystals` = '0', `clan_tour` = '0', `str` = '".($user[str]-$clan[stat])."', `def` = '".($user[def]-$clan[stat])."', `max_health` = '".($user[max_health]-$clan[stat])."', `str` = '".($user[str]-$clan[stat_1])."', `def` = '".($user[def]-$clan[stat_1])."', `max_health` = '".($user[max_health]-$clan[stat_1])."', `clan_exp` = '0' WHERE `id` = '".$myID."'");
mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] покинул клан'");
header('Location: /');
exit();
}
if(isset($_GET['exit']) && $user['id_clan'] == $clan['id']){
$title = 'Покинуть клан';
include '../system/header.php';
if($user['clan_rang'] == 5){
header('Location: /clan/index.php?id='.$r.'');
exit();
}
echo "<div class='text center'>Вы уверены что хотите покинуть клан?<br>";
echo "<a href='/clan/index.php?id=".$user['id_clan']."' class='but'>Нет, отмена </a> ";
echo "<a href='/clan/index.php?id=".$user['id_clan']."&exit_ok' class='but'>Да, покинуть</a></div>";
include '../system/footer.php';
exit();
}





if(isset($_GET['user']) and $user['clan_rang'] >= 3 and $user['id_clan'] == $clan['id']){
$id = num($_GET['user']);
$prof = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
$title = "Управление игроком";
include '../system/header.php';
//space
if($user['id_clan'] != $prof['id_clan']){
header('Location: /clan/index.php?id='.$r.'');
exit();
}
//space
switch($prof['clan_rang']){
case 1:
$clan_rang = 'Новичок';
break;
case 2:
$clan_rang = 'Боец';
break;
case 3:
$clan_rang = 'Офицер';
break;
case 4:
$clan_rang = 'Генерал';
break;
case 5:
$clan_rang = "Лидер";
break;
}
echo "<div class='text center'>";
echo "<a href='/hero/$prof[id]'><img src='/icons/".$prof['sex'].".png'> $prof[login]</a> - $clan_rang<br>";
echo "<img src='/icons/gold.png' width='16' height='16'>".n_f($prof['clan_gold'],1)." <img src='/icons/silver.png' width='16' height='16'>".n_f($prof['clan_crystals'],1)." <img src='/icons/exp.png' width='14' height='14'> ".n_f($prof['clan_exp'],1)."<br>Дата вступления:</font> <font color=white>".vremja($prof['vstup'])."</font></br>" ;
echo '</div>';
echo "<div class='text center'>";
if($prof['clan_rang'] != 4 and $prof['id_clan'] == $user['id_clan'] and $prof['clan_rang']+1 < $user['clan_rang']){
if(isset($_GET['up'])){
mysql_query("UPDATE `users` SET `clan_rang` = '".($prof[clan_rang]+1)."' WHERE `id` = '".$prof['id']."'");
mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] повысил $prof[login]'");
$_SESSION[msg] = '<div class="text center"><font color="lime">Игрок успешно повышен</font></div>';
header('Location: /clan/index.php?id='.$user['id_clan'].'&user='.$prof['id'].'#'.$r.'');
exit();
}
echo "<a href='/clan/index.php?id=".$user['id_clan']."&user=".$prof['id']."&up'><u>Повысить</u></a><br>";
}
if($prof['clan_rang'] < $user['clan_rang'] && $prof['clan_rang'] >= 2 and $prof['id_clan'] == $user['id_clan']){
if(isset($_GET['down'])){
mysql_query("UPDATE `users` SET `clan_rang` = '".($prof[clan_rang]-1)."' WHERE `id` = '".$prof['id']."'");
mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] понизил $prof[login]'");
$_SESSION[msg] = '<div class="text center"><font color="lime">Игрок успешно понижен</font></div>';
header('Location: /clan/index.php?id='.$user['id_clan'].'&user='.$prof['id'].'#'.$r.'');
exit();
}
echo "<a href='/clan/index.php?id=".$user['id_clan']."&user=".$prof['id']."&down'><u>Понизить</u></a><br>";
}

 
if($clan_rang=5)if($prof['clan_rang'] != 5 and $prof['clan_rang'] < $user['clan_rang'] and $prof['id_clan'] == $user['id_clan']){
 
if(isset($_GET['up_lider'])){
 
mysql_query("UPDATE `users` SET `clan_rang` = '".($prof['clan_rang']+1)."' WHERE `id` = '".$prof['id']."'");
 
mysql_query("UPDATE `users` SET `clan_rang` = '".($user['clan_rang']-1)."' WHERE `id` = '".$user['id']."'");
mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] передал лидерство $prof[login]'");
} 
 
if($prof['clan_rang'] >= 4)echo "<a href='/clan/index.php?id=".$user['id_clan']."&user=".$prof['id']."&up_lider'><u>Передать лидерство</u></a><br>";
 
}
if($prof['clan_rang'] == 1 && $prof['clan_rang'] < $user['clan_rang'] and $prof['id_clan'] == $user['id_clan']){
if(isset($_GET['delete'])){
mysql_query("UPDATE `users` SET `id_clan` = '0', `clan_gold` = '0', `clan_tour` = '0', `clan_crystals` = '0', `str` = '".($prof[str]-$clan[stat])."', `def` = '".($prof[def]-$clan[stat])."', `max_health` = '".($prof[max_health]-$clan[stat])."', `str` = '".($prof[str]-$clan[stat_1])."', `def` = '".($prof[def]-$clan[stat_1])."', `max_health` = '".($prof[max_health]-$clan[stat_1])."', `clan_exp` = '0' WHERE `id` = '".$prof['id']."'");
mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] Исключил из клана $prof[login]'");
$_SESSION[msg] = '<div class="text center"><font color="lime">Игрок успешно исключен</font></div>';
header('Location: /clan/index.php?id='.$user['id_clan'].'');
exit();
}
echo "<a href='/clan/index.php?id=".$user['id_clan']."&user=".$prof['id']."&delete'><u>Исключить из клана</u></a>";
}
echo "</div>";
$clan = '';
include '../system/footer.php';
exit;
}
$title = $clan['name'];
include '../system/header.php';


$i = null;
$start = null;
if($i+$start <= 3){
}
echo "<div class='de'>";
echo "<div class='oh'>";
echo "<img src='/icons/clan/".$clan['gerb'].".png' width='50px' height='50px'>";
echo "</div>";
echo " $clan[name]<br> Уровень: $clan[level]<br> Опыт: ".n_f($clan['exp'])."/".n_f(clan_exp($clan['level']))." (".round($clan['exp']/clan_exp($clan['level'])*100,1)."%)";
echo "<div style='clear:both;'></div>";
echo "<div class='exp_polos'><div class='progress' style='width:".round($clan['exp']/clan_exp($clan['level'])*100,1)."%;'></div></div>";
echo "</div>";
if($user['id_clan'] == $clan['id'])echo "<div class='text'><a href='/clan/index.php?id=".$user['id_clan']."&tour#".$r."' class='link'><img src='/icons/clan/tour.png' width='16' height='16'> Клановый турнир</a>";
if($user['id_clan'] == $clan['id'])echo "<a href='/clan/bonus.php' class='link'><img src='/icons/zak.png' width='17' height='17'> Клановые Строения</a>";
if($user['id_clan'] == $clan['id'])echo "<a href='/clan/index.php?id=".$user['id_clan']."&tr' class='link'><img src='/icons/gold.png' width='16' height='16'> Казна клана</a>";
if($user['id_clan'] == $clan['id'])echo "<a href='/clan/chat.php' class='link'><img src='/icons/clan/chat.png' width='16' height='16'> Чат клана ".($user['clan_chat_read'] == 1 ? "<font color='lime'>(+)</font>" : "")."</a>";
if($user['id_clan'] == $clan['id'])echo "<a href='/clan/journal.php' class='link'><img src='/icons/clan/history.png' width='16' height='16'> Журнал клана</a>";
if($user['id_clan'] == $clan['id'])echo "<a href='/clan/sett.php' class='link'><img src='/icons/clan/sett.png' width='16' height='16'> Настройки клана</a>";
echo "</div>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id_clan` = '$clan[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `users` WHERE `id_clan` = '$clan[id]' ORDER BY  `clan_rang` DESC, `clan_exp` DESC LIMIT $start, $set[p_str]");




















if(isset($_GET['info']) and $user['clan_rang'] >= 3 and $user['id_clan'] == $clan['id']){
if(isset($_REQUEST['add'])){ 
$ob = text($_POST['ob']); 
if(empty($ob))$err = '';
if(mb_strlen($ob) > 1000 or mb_strlen($ob) < 3) $err = '<div class="text center"><font color="tomato">Ошибка. Слишком короткое или длинное объявление</font></div>';
if(!$err){ 
mysql_query("UPDATE `clans` SET `ob` = '$ob' WHERE `id` = '".$clan['id']."'");
mysql_query("UPDATE `users` SET `ob_read` = '1' WHERE `id_clan` = '".$clan['id']."'"); 
header('Location: ?id='.$user['id_clan'].'');
exit(); 
}else{ 
$_SESSION['msg'] = $err; 
header('Location: ?id='.$user['id_clan'].'&info');
exit(); 
} 
} 
echo "<div class='text center'>";
echo '<form action="" method="post">'; 
echo 'Новое объявление:<br><input type="text" name="ob" maxlength="1000" value="" /><br/>'; 
echo '<input type="submit" name="add" class="btn" value="Продолжить"> <a href="?id='.$user['id_clan'].'&info#'.$r.'">Обновить</a>';
echo '</form>'; 
echo "</div>"; 
$clan = '';
include '../system/footer.php';
exit;
}


if(isset($_GET['name']) and $user['clan_rang'] >= 5 && $user['id_clan'] == $clan['id']){
if(isset($_REQUEST['add'])){
$clan_name = text($_POST['clan_name']);
if(empty($ob))$err = '';
if(mb_strlen($clan_name) > 1000 or mb_strlen($clan_name) < 3) $err = '<div class="text center"><font color="tomato">Ошибка. Слишком короткое или длинное название клана</font></div>';
if($clan['gold'] <= 499){
$err = '<div class="text center"><font color="tomato">Ошибка. Недостаточно золота</font></div>';
}
if(!$err){
mysql_query("UPDATE `clans` SET `name` = '$clan_name', `gold` = '".($clan['gold'] - 500)."' WHERE `id` = '".$clan['id']."'");
header('Location: ?id='.$user['id_clan'].'');
exit();
header('Location: ?id='.$user['id_clan'].'&name');
$_SESSION['msg'] = $err;
header('Location: ?id='.$user['id_clan'].'&name');
exit();
}
}
echo "<div class='text center'>Стоимость смены, название клана <img src='/icons/gold.png' width='16' height='16'>500 золота!<hr>";
echo '<form action="" method="post">';
echo 'Новое название клана:<br><input type="text" name="clan_name" maxlength="1000" value="" /><br/>';
echo '<input type="submit" name="add" class="btn" value="Продолжить"> <a href="?id='.$user['id_clan'].'&name#'.$r.'">Обновить</a>';
echo '</form>';
echo "</div>";
$clan = '';
include '../system/footer.php';
exit;
}






echo "<div class='de center'>Состав клана: $k_post из ".$clan['user_clan']."</div>";
while($post = mysql_fetch_assoc($q)) {
echo "<div class='text'>";
switch($post['clan_rang']){
case 1:
$clan_rang = 'Новичок';
break;
case 2:
$clan_rang = 'Боец';
break;
case 3:
$clan_rang = 'Офицер';
break;
case 4:
$clan_rang = 'Генерал';
break;
case 5:
$clan_rang = "Лидер";
break;
}
echo "<a href='/hero/".$post['id']."'><img src='/icons/".$post['sex'].".png'> $post[login]</a> ";
echo " - $clan_rang";
echo"</br>";
echo "<img src='/icons/exp.png' width='14' height='14'> Опыт: ".n_f($post['clan_exp'])."<br><img src='/icons/cland.png' width='14' height='14'> Очки: ".n_f($post['clan_tour'])."";
if($myID != $post['id'] &&  $user['id_clan'] == $clan['id']  && $user['clan_rang'] >= 3 && $post['clan_rang'] < $user['clan_rang'])echo "<br> <a href='/clan/index.php?id=".$user['id_clan']."&user=$post[id]'>Управление игроком</a>";
echo "</div>";
}
if($k_post > 10){
echo "<div class='de center'>";
str('?id='.$clan['id'].'&',$k_page,$page); // Вывод страниц
echo "</div>";
}





include '../system/footer.php';
?>