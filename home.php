<?php
include 'system/func.php';
$title = 'Легенда';
include 'system/header.php';
auth();
//space
if($user['save'] <= 1){
header("Location: /save.php");
}
//лига
if($user['liga'] == 0){
$liga = 'новичков';
}else
if($user['liga'] == 1){
$liga = 'бойцов';
}else
if($user['liga'] == 2){
$liga = 'сильнейших';
}else
if($user['liga'] == 3){
$liga = 'чемпионов';
}else
if($user['liga'] == 4){
$liga = 'легенд';
}
else
if($user['liga'] == 5){
$liga = 'богов';
}
else
if($user['liga'] == 6){
$liga = 'богов';
}
//
//ежедневный бонус
if($user['day'] < time()){
if($user['id'] >= 1){
mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + 10)."', `day` = '".(time() + 86400)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="whitesmoke">Ежедневный бонус!<br><img src="/icons/gold.png" width="16" height="16">10</font></div>';
header('Location: ?');
exit();
}
}
//
$news = mysql_query("SELECT * FROM `topic` WHERE `id_forum` = '1' ORDER BY `id` DESC LIMIT 1");
$news = mysql_fetch_array($news);
if($news){
if(isset($_GET['header_news'])){
mysql_query("update `users` set `news_read` = '0' where (`id` = '".$myID."')");
header("Location: /forum/sub/$news[id]?page=end");
exit();
}
if($user['news_read'] == 1 && $news['time'] > time()-86400){
echo "<div class='text'><a href='?header_news' class='link'><font color='lime'><img src='/icons/topic_opens.png' width='16' height='16'> Новости игры</font></a></div>";
}
}
$clan_memb = mysql_fetch_array(mysql_query("SELECT * FROM `clan_memb` WHERE `id_user` = '$myID' ORDER BY `id` DESC LIMIT 1"));
$clan = mysql_fetch_array(mysql_query("SELECT * FROM `clans` WHERE `id` = '$clan_memb[id_clan]' ORDER BY `id` DESC LIMIT 1"));
if($clan_memb){
if(isset($_GET['clan_user_no'])){
mysql_query("DELETE FROM `clan_memb` WHERE `id` = '".$clan_memb[id]."'");
header('Location: /');
exit();
}
if(isset($_GET['clan_user_ok'])){
mysql_query("update `users` set `id_clan` = '".$clan['id']."',`vstup` = '".time()."', `str` = '".($user['str']+$clan['stat'])."', `def` = '".($user['def']+$clan['stat'])."', `max_health` = '".($user['max_health']+$clan['stat'])."', `str` = '".($user['str']+$clan['stat_1'])."', `def` = '".($user['def']+$clan['stat_1'])."', `max_health` = '".($user['max_health']+$clan['stat_1'])."', `clan_rang` = '1' where (`id` = '".$myID."')");
mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = '$user[login] вступил в клан'");
mysql_query("DELETE FROM `clan_memb` WHERE `id_user` = '".$myID."'");
header('Location: /clan/index.php?id='.$user['id_clan'].'');
exit();
}
echo "<div class='text center'>";
echo "<a>Вас приглашают в клан -</a> <a href='/clan/index.php?id=".$clan['id']."'><font color='lime'><u>$clan[name]</u></font></a>";
echo "<br><a href='?clan_user_ok' class='but'>Вступить</a> <a href='?clan_user_no' class='but'>Отказаться</a>";
echo "</div>";
}

//получаем инфу приключений
include 'my_inc/adven/info.php';
//
if($user['coll_adven'] >= 1){
$plus = '<font color="lime">(+)</font>';
$coll = 'Доступно боев: '.$user['coll_adven'].'';
}else{
$coll = 'Через: '.tl($user['time_adven'] - time()).'';
}
//
//получаем инфу лиги

if($user['coll_liga'] >= 1){
$liga_plus = '<font color="lime">(+)</font>';
$liga_coll = 'Доступно боев: '.$user['coll_liga'].'';
}else{
$liga_coll = 'Через: '.tl($user['time_liga'] - time()).'';
}
//

echo '<div class="text">';
echo '<a href="/adventure.php" class="link"><div class="oh"><img src="/icons/mobs/'.$user['adven'].'.jpg" width="35" height="35"></div> '.$names.' '.$plus.'<br><font color="silver">'.$coll.'</font></a>';
echo '<a href="/liga.php" class="link"><div class="oh"><img src="/icons/liga.png" width="35" height="35"></div> Лига '.$liga.' '.$liga_plus.'<br><font color="silver">'.$liga_coll.'</font></a>';
//echo '<a href="/r.php" class="link"><img src="/icons/23february.png" width="16" height="16"> <font color="tomato">Подарок на 23 февраля</font> <font color="lime">(+)</font></a>';
echo '<a href="/battle/pvp" class="link"><img src="/icons/pvp/mini_logo.png" width="14" height="14"> Арена: 1 vs 1 ';
if($user['arena_coll'] >= 1)echo '<font color="lime">(+)</font>';
else
echo '['.tl($user['arena_time'] - time()).']';
echo '</a>';
echo '<a href="/zamok.php" class="link"><img src="/icons/zak.png" width="16" height="16"> Замок сокровищ '; if(vremja() >= '08:00:00' and vremja() <= '20:59:59' && $user['coll_fight'] >= 1)echo '<font color="lime">(+)</font>';
echo '</a>';
echo '<a href="/clan_tour.php" class="link"><img src="/icons/cland.png" width="14" height="14"> Клановый турнир '; if($user['id_clan'] >= 1 && $user['coll_tour'] >= 1)echo '<font color="lime">(+)</font>';
echo '</a>';
echo '<a href="/battle/basement" class="link"><img src="/icons/basement_icon.png" width="16" height="16"> Подземелье</a>';
echo '<a href="/company.php" class="link"><img src="/icons/company.png" width="16" height="16"> Кампания ';
require_once ('my_inc/company/info_home.php');
echo '</a>';
echo '<a href="/quest.php" class="link"><img src="/icons/quest.png" width="16" height="16"> Ежедневные задания</a>';
echo '<a href="/pohod.php" class="link"><img src="/icons/pohod.png" width="16" height="16"> Поход '; if($user['pohod'] < time())echo '<font color="lime">(+)</font>';
else
echo '['.tl($user['pohod'] - time()).']';
echo '</a>';
echo '<a href="/shop.php" class="link"><img src="/icons/shop.png" width="18" height="18"> Магазин</a>';
echo '<a href="/rating.php" class="link"><img src="/icons/rating.png" width="16" height="16"> Лучшие</a>';
echo '<a href="/paywk/" class="link"><img src="/icons/gold.png" width="16" height="16"> Купить золото</a>';
echo '</div>';

include 'system/footer.php';
?>