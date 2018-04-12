<?php
include '../system/func.php';
auth();
$title = 'Клановые Строения';
include '../system/header.php';
$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."'"));
$clan_bonus = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_bonus` WHERE `id_clan` = '".$clan['id']."'"));
echo '<div class="de center"><img src="/icons/cland.png" width="16" height="16"> '.$title.' </div>';
echo '<div class="text center">Бонусы: + <img src="/icons/str.png" width="16" height="16"><img src="/icons/def.png" width="16" height="16"><img src="/icons/health.png" width="16" height="16"> '.($clan['stat']+$clan['stat_1']).', <img src="/icons/exp.png" width="14" height="14"> '.($clan['stat_3']*2).'%, <img src="/icons/silver.png" width="16" height="16"> '.($clan['stat_2']*2).'%</div>';
echo '<div class="text">';
echo '<a href="/clan/bonus_1.php" class="link"><div class="oh"><img src="/icons/clan/zdan1.png" width="50" height="50"></div> <font color="silver">Ратуша<br>Уровень: '.$clan['stat_level_1'].' из 10<br>+'.$clan['stat_1'].' к параметрам</font></a>';
echo '<hr><a href="/clan/bonus_2.php" class="link"><div class="oh"><img src="/icons/clan/zdan2.png" width="50" height="50"></div> <font color="silver">Кузница<br>Уровень: '.$clan['stat_level'].' из 15<br>+'.$clan['stat'].' к параметрам</font></a>';
echo '<hr><a href="/clan/bonus_3.php" class="link"><div class="oh"><img src="/icons/clan/zdan3.png" width="50" height="50"></div> <font color="silver">Мастерская<br>Уровень: '.$clan['stat_level_3'].' из 15<br>+ '.($clan['stat_3']*2).'% к опыту</font></a>';
echo '<hr><a href="/clan/bonus_4.php" class="link"><div class="oh"><img src="/icons/clan/zdan4.png" width="50" height="50"></div> <font color="silver">Алтарь<br>Уровень: '.$clan['stat_level_2'].' из 15<br>+ '.($clan['stat_2']*2).'% к серебру</font></a>';
echo '</div>';
echo "<a href='/clan/index.php?id=".$user['id_clan']."' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include '../system/footer.php';
?>