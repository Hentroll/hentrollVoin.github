<?php
require_once ('../system/func.php');
auth(); // Закроем от гостей
if($user['access'] <=1){
header('Location: /');
}
if(isset($_GET['delete_train']) && $user['access'] == '2'){
mysql_query("UPDATE `users` SET `str_train` = '0', `str_train_param` = '0', `def_train` = '0', `def_train_param` = '0', `hp_train` = '0', `hp_train_param` = '0'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Тренировка обновлена!</font></div>';
header('Location: ?');
exit();
}
if(isset($_GET['delete_online']) && $user['access'] == '2'){
mysql_query("UPDATE `users` SET `online` = '0'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Онлайн обновлён!</font></div>';
header('Location: ?');
exit();
}
if(isset($_GET['delete_bonus']) && $user['access'] == '2'){
mysql_query("UPDATE `users` SET `r` = '0'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Бонус обновлён!</font></div>';
header('Location: ?');
exit();
}

if(isset($_GET['delete_pohod']) && $user['access'] == '2'){
mysql_query("UPDATE `users` SET `pohod` = '0', `pohod_ok` = '0'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Поход очищен!</font></div>';
header('Location: ?');
exit();
}
if(isset($_GET['tex_on']) && $user['access'] == '2'){
mysql_query("UPDATE `users` SET `texr` = '1'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Тех работы начаты!</font></div>';
header('Location: ?');
exit();
}
if(isset($_GET['tex_off']) && $user['access'] == '2'){
mysql_query("UPDATE `users` SET `texr` = '0'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Тех работы закончены!</font></div>';
header('Location: ?');
exit();
}

if(isset($_GET['delete_chat']) and $user['access'] > 0){
mysql_query("DELETE FROM `chat`");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Чат очищен</font></div>';
header('Location: ?');
exit();
}
if(isset($_GET['delete_mail']) and $user['access'] > 0){
mysql_query("DELETE FROM `mail`");
mysql_query("DELETE FROM `kont`");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Почта очищенна</font></div>';
header('Location: ?');
exit();
}
if(isset($_GET['worldkassa'])){
$title = 'WorldKassa';
require_once ('../system/header.php');
echo "<div class='de center'>Счета worldkassa</div>";
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `worldkassa` WHERE `time_oplata` > '0'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `worldkassa` WHERE `time_oplata` > '0' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
echo "<div class='text'>";
if($k_post == 0) echo "<center><font color='tomato'>Платежных операций не обнаруженно</font></center>";
while($post = mysql_fetch_assoc($q)) {
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $post[id_user] LIMIT 1"));
if($post['time_oplata'] > 0)$status = "<font color='green'>Оплаченно</font>";
else $status = "<font color='red'>Не оплаченно</font>";
echo "Оплата счета #".$post['id_bill'].", ".vremja($post['time'])."<br>Пакупатель: <a href='/hero/$ank[id]'>$ank[login]</a><br>Сумма: $post[summa]Rub.<br>Статус: $status<hr>";
}
echo '</div>';
if($k_post > 10){
echo '<div class="text center">';
str('?worldkassa&',$k_page,$page);
echo "</div>";
}
echo "<a href='?' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
require_once ('../system/footer.php');
exit;
}
if(isset($_GET['resours'])){
$title = 'Перевод средств';
require_once ('../system/header.php');
if(isset($_REQUEST['post'])){
$login = text($_POST['login']);
$tip = text($_POST['tip']);
$koll = text($_POST['koll']);
$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `login` = '".$login."'");  // Доступность почты
if(mysql_result($query, 0) == 0) $err = '<div class="text center"><font color="tomato">Ошибка. Передача ресурсов не удалась</font></div>';
if(!isset($err)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `login` = '".$login."'"));
mysql_query('UPDATE `users` SET `'.$tip.'` = `'.$tip.'` + '.$koll.' WHERE `id` = "'.$ank['id'].'"');
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Ресурсы переведенны</font></div>";
header('Location: ?resours');
exit();
}else{
$_SESSION['msg'] = $err;
header('Location: ?resours');
exit();
}
}
echo "<div class='text center'>";
echo "<form method='post' action=''>";
echo "Ник игрока:<br><input type='text' name='login' value=''><br>";
echo "Колличество:<br><input type='text' name='koll' value='0'><br>";
echo 'Тип:<br />
<select name="tip"><option value="gold">Золото</option><option value="crystals">Серебро</option></select><br/>';
echo "<input type='submit' class='btn' value='Зачислить' name='post'>";
echo "</form>";
echo "</div>";
echo "<a href='?' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
require_once ('../system/footer.php');
exit;
}
if(isset($_GET['sett_user'])){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".abs(intval($_GET['sett_user']))."'"));
if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['sex']) && isset($_POST['access']) && isset($_POST['level']) && isset($_POST['str']) && isset($_POST['def']) && isset($_POST['health']) && isset($_POST['gold']) && isset($_POST['silver']) && isset($_POST['id_clan']) && isset($_POST['clan_rang'])){
$login = text($_POST['login']);
$login_sql = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `login` = '$login' and `id` != '$ank[id]'");
$email = text($_POST['email']);
$email_sql = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `login` = '$email' and `id` != '$ank[id]'");
$sex = text($_POST['sex']);



$access = text($_POST['access']);
$level = text($_POST['level']);
$str = text($_POST['str']);
$def = text($_POST['def']);
$health = text($_POST['health']);
$gold = text($_POST['gold']);
$silver = text($_POST['silver']);
$id_clan = text($_POST['id_clan']);
$clan_rang = text($_POST['clan_rang']);
if(!isset($err)){
mysql_query("update `users` set `login` = '".$login."', `email` = '".$email."', `sex` = '".$sex."', `access` = '".$access."', `level` = '".$level."', `str` = '".$str."', `def` = '".$def."', `max_health` = '".$health."', `gold` = '".$gold."', `crystals` = '".$silver."', `id_clan` = '".$id_clan."', `clan_rang` = '".$clan_rang."' where (`id` = '".$ank['id']."')");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Игрок успешно отредактирован</font></div>';
header("Location: ?sett_user=$ank[id]");
exit();
}else{
$_SESSION['msg'] = $err;
header("Location: ?sett_user=$ank[id]");
exit();
}
}
$title = 'Редактор '.$ank['login'];
require_once ('../system/header.php');
echo "<div class='text'>";
echo "<form method='post' action='?sett_user=$ank[id]'>";
echo "Логин:<br><input type='text' name='login' value='$ank[login]'><br>";
echo "E-mail:<br><input type='text' name='email' value='$ank[email]'><br>";
echo "Пол: (m/w)<br><input type='text' name='sex' value='$ank[sex]'><br>";


echo "Права: (0,1,2)<br><input type='text' name='access' value='$ank[access]'><br>";
echo "Уровень: <br><input type='text' name='level' value='$ank[level]'><br>";
echo "Сила: <br><input type='text' name='str' value='$ank[str]'><br>";
echo "Защита: <br><input type='text' name='def' value='$ank[def]'><br>";
echo "Здоровье:
<br><input type='text' name='health' value='$ank[max_health]'><br>";
echo "Золото: <br><input type='text' name='gold' value='$ank[gold]'><br>";
echo "Серебро: <br><input type='text' name='silver' value='$ank[crystals]'><br>";
echo "ID Клана: <br><input type='text' name='id_clan' value='$ank[id_clan]'><br>";
echo "Ранг в клане: <br><input type='text' name='clan_rang' value='$ank[clan_rang]'><br>";
echo "<input type='submit' class='btn' value='Изменить'>";
echo "</form>";
echo "</div>";
echo "<a href='?' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
require_once ('../system/footer.php');
exit;
}
if(isset($_GET['users'])){
if(isset($_POST['login'])){
$login = text($_POST['login']);
$sql = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `login` = '$login'");
if(mysql_result($sql, 0) == 0) $err = '<div class="text center"><font color="tomato">Ошибка, игрок не найден</font></div>';
if(!isset($err)){
$ank = mysql_fetch_assoc(mysql_query("SELECT `id` FROM `users` WHERE `login` = '$login'"));
header("Location: ?sett_user=$ank[id]");
exit();
}else{
$_SESSION['msg'] = $err;
header('location: ?users');
exit();
}
}






$title = 'Редактор игрока';
require_once ('../system/header.php');
echo "<div class='text center'>";
echo "<form method='post' action='?users'>";
echo "Логин:<br><input type='text' name='login'>";
echo "<input type='submit' class='btn' value='Редактировать'>";
echo "</form>";
echo "</div>";
echo "<a href='?' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
require_once ('../system/footer.php');
exit;
}
$title = 'Панель управления';
require_once ('../system/header.php');
$registr = mysql_num_rows(mysql_query("SELECT * FROM `users`"));
echo '<div class="de center">Панель управления</div>';
echo "<a href='?users' class='link'><img src='/icons/right.png'> Редактор игроков [$registr]</a>";
echo "<a href='/mahaker/mahaker_ban_list.php' class='link'><img src='/icons/right.png'> Список забаненых  [".mysql_num_rows(mysql_query("SELECT * FROM `ban` WHERE `id` > '0'"))."]</a>";

echo "<a href='/mahaker/mahaker_ref.php' class='link'><img src='/icons/right.png'> Рефералы</a>";

echo "<a href='?resours' class='link'><img src='/icons/right.png'> Перевод средств</a>";
echo "<a href='/mahaker/basement.php' class='link'><img src='/icons/right.png'> Редактор подземелья</a>";
$worldkassa = mysql_num_rows(mysql_query("SELECT * FROM `worldkassa` WHERE `time_oplata` > '0'"));
//echo "<a href='?worldkassa' class='link'><img src='/icons/right.png'> Счета WorldKassa [$worldkassa]</a>";
echo "<a href='/mahaker/mahaker_mail.php' class='link'><img src='/icons/right.png'> Шпион почты  [".mysql_num_rows(mysql_query("SELECT * FROM `mail` WHERE `id` > '0'"))."]</a>";

echo "<a href='/md_panel/chat.php' class='link'><img src='/icons/right.png'> Админ-чат [".mysql_num_rows(mysql_query("SELECT * FROM `admin_chat` WHERE `id` > '0'"))."]</a>";
echo "<a href='/mahaker/mahaker_stat.php' class='link'><img src='/icons/right.png'> Статистика игры</a>";
echo "<a href='/mahaker/mahaker_bot.php' class='link'><img src='/icons/right.png'> Создание ботов</a>";
echo "<a href='/mahaker/mahaker_ticket.php' class='link'><img src='/icons/right.png'> Техническая поддержка [".mysql_num_rows(mysql_query("SELECT * FROM `ticket` WHERE `id` > '0'"))."]</a>";
echo "<a href='/mahaker/mahaker_panel.php?delete_mail' class='link'><img src='/icons/right.png'> Очистить почту</a>";
echo "<a href='/mahaker/mahaker_panel.php?delete_chat' class='link'><img src='/icons/right.png'> Очистить чат [".mysql_num_rows(mysql_query("SELECT * FROM `chat` WHERE `id` > '0'"))."]</a>";
if($user['texr'] == 0)
echo "<a href='/mahaker/mahaker_panel.php?tex_on' class='link'><img src='/icons/right.png'> Начать тех.работы</a>";
else
echo "<a href='/mahaker/mahaker_panel.php?tex_off' class='link'><img src='/icons/right.png'> Закончить тех.работы</a>";
//
echo "<a href='/mahaker/mahaker_panel.php?delete_pohod' class='link'><img src='/icons/right.png'> Очистить поход</a>";
echo "<a href='/mahaker/mahaker_panel.php?delete_online' class='link'><img src='/icons/right.png'> Обновить онлайн</a>";
echo "<a href='/mahaker/mahaker_panel.php?delete_bonus' class='link'><img src='/icons/right.png'> Обновить бонус</a>";
echo "<a href='/mahaker/mahaker_panel.php?delete_train' class='link'><img src='/icons/right.png'> Обновить тренировку</a>";
require_once ('../system/footer.php');
?>