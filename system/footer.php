<?
$profile = null;
$second = rand(3,8);
if(!isset($user)){
echo '<center><font color="silver">0.00'.$second.' сек. '.vremja().'<br>Легенда 2018, 16+</font><br></center>';
} else {
echo "<div class='de center'>";
echo "<center><img src='/icons/gold.png' width='16' height='16'>".($user['gold'])." <img src='/icons/silver.png' width='16' height='16'>".n_f($user['crystals'])."";
if($_SERVER['PHP_SELF'] == '/home.php'){
echo "<hr>";
echo "<font color='lime'>Акция: За каждые купленные 100 золота, 10000 серебра в подарок!</font><br>";
echo "<a>Бонус +50% при покупке золота!</a>";
}
echo "</center></div>";
echo '<table class="text center" width="100%"><tr><td width="33%"><a class="teac" href="/home.php?'.$r.'" style="border-right: 1px solid #000000;"><img src="/icons/main.png" width="50" height="50"><br> Главная </a></td><td width="34%"><a class="teac" href="/hero.php?id='.$user['id'].'#'.$r.'" style="border-right: 1px solid #171717;"><img src="/icons/user.png" width="50" height="50"><br>
Профиль</a>
</td><td width="33%"><a class="teac" href="/clan/index.php?id='.$user['id_clan'].'#'.$r.'"><img src="/icons/clan.png" width="50" height="50"><br> Клан ';
if($user['clan_chat_read'] >= 1)echo "<font color='lime'>(+)</font>";
echo '</a></td></table>';
}
echo "<div class='center'><font color='whitesmoke'>";
if($user){
echo "<br>";
echo "<a href='/forum/#".$r."'>Форум</a> | <a href='/chat.php#".$r."'>Чат ";
if($user['chat_read'] >= 1){
echo "<font color='lime'>+</font>";
}
echo "</a>";
echo " | <a href='/forum/1#".$r."'>Новости</a>";
echo "<br><br>";
echo "<a href='/about#".$r."'>Об игре</a> | <a href='/online.php#".$r."'>Онлайн: ".mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `online` > '".(time()-15200)."'"))."</a> | <a href='/sett.php?exit'>Выход</a>";
echo "<br><br><a href='/support.php#".$r."'>Техническая поддержка</a>";
echo "<br><br>";
echo '<font color="silver">0.00'.$second.' сек. '.vremja().'.<br>Легенда 2018, 16+</font><hr><a href="https://m.vk.com/club160363993"><img src="/icons/club/vk.jpg"></a>';
if($user['access'] == 2){
echo '<hr><center><a href="/mahaker/mahaker_panel.php">Панель управления</a></center>';
}elseif($user['access'] == 1){
echo '<hr><center><a href="/md_panel/index.php">Панель управления</a></center></font>';
}
}
echo '</body>
</html>';
?>