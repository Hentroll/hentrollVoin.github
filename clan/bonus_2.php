<?php
include '../system/func.php';
auth();
$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."'"));
$clan_bonus = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_bonus` WHERE `id_clan` = '".$clan['id']."'"));
    function cost($i) {
        
        switch($i) {
          case 0:
           $cost = 100000;
           break;
        
          case 1:
           $cost = 200000;
           break;
        
          case 2:
           $cost = 300000;
           break;
          
          case 3:
           $cost = 400000;
           break;

          case 4:
           $cost = 500000;
           break;   
           
          case 5:
           $cost = 600000;
           break;        

          case 6:
           $cost = 700000;
           break;   

          case 7:
           $cost = 800000;
           break;

          case 8:
           $cost = 900000;
           break;   
           
          case 9:
           $cost = 1000000;
           break;   

          case 10:
           $cost = 2000000;
           break;   

          case 11:
           $cost = 3000000;
           break;   

          case 12:
           $cost = 4000000;
           break;   

          case 13:
           $cost = 5000000;
           break;   

          case 14:
           $cost = 6000000;
           break;   

          case 15:
           $cost = 7000000;
break;



}

global $user;
return $cost;
}

    function value($i) {
        
        switch($i) {
          case 0:
           $value = 'crystal';
           break;
        
          case 1:
           $value = 'crystal';
           break;
        
          case 2:
           $value = 'crystal';
           break;
          
          case 3:
           $value = 'crystal';
           break;

          case 4:
           $value = 'crystal';
           break;        

          case 5:
           $value = 'crystal';
           break;        

          case 6:
           $value = 'crystal';
           break;        

          case 7:
           $value = 'crystal';
           break;        

          case 8:
           $value = 'crystal';
           break;        

          case 9:
           $value = 'crystal';
           break;        

          case 10:
           $value = 'crystal';
           break;        

          case 11:
           $value = 'crystal';
           break;        

          case 12:
           $value = 'crystal';
           break;        

          case 13:
           $value = 'crystal';
           break;        

          case 14:
           $value = 'crystal';
           break;        

          case 15:
           $value = 'crystal';
           break;        
        }
    return $value;
    }
if(isset($_GET['up']) and $user['clan_rang'] >= 4 && $clan['stat_level'] < $clan['user_clan']){
if(value($clan['stat_level']) == 'crystal') {
if($clan['crystals'] < cost($clan['stat_level'])) {
$_SESSION['msg'] = "<div class='text center'><font color='tomato'>Не хватает ".(cost($clan['stat_level'])-$clan['crystals'])." серебра</font></div>";
header("Location: ?".$r."");
exit();
}else{
mysql_query("UPDATE `clans` SET `stat` = '".($clan['stat']+15)."', `stat_level` = '".($clan['stat_level']+1)."', `crystals` = '".($clan['crystals']-cost($clan['stat_level']))."' WHERE `id` = '".$clan['id']."'");
mysql_query("UPDATE `users` SET `str` = `str` + '15', `def` = `def` + '15', `max_health` = `max_health` + '15' WHERE `id_clan` = '".$clan['id']."'");
mysql_query("INSERT INTO `clan_journal` SET `id_clan` = '$clan[id]', `time` = '".time()."', `text` = 'Лидер поднял бонус клана'");
$_SESSION['msg'] = "<div class='text center'><font color='lime'>Бонус клана увеличен</font></div>";
header("Location: ?".$r."");
exit();
}
}
}
$title = 'Клановые Строения';
include '../system/header.php';
echo '<div class="de center"><img src="/icons/cland.png" width="16" height="16"> '.$title.' </div>';
echo "<div class='text'>";
echo "<div class='oh'><img src='/icons/clan/zdan2.png' width='50' height='50'></div>";
echo "<font color='silver'>Кузница<br>Уровень: $clan[stat_level] из 15<br>+$clan[stat] к параметрам</font>";
echo "<hr>";
if($clan['stat_level'] < $clan['user_clan'] && $user['clan_rang'] >= 4)echo "<center><a href='?up' class='but'><font color='whitesmoke'>Улучшить за <img src='/icons/silver.png' width='16' height='16'>".cost($clan['stat_level'])."</font></a></center>";
echo '<hr><center><font color="silver">Улучшать бонус, могут лидер или генералы клана!</font></center>';
echo "</div>";
echo "<a href='/clan/bonus.php' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
$clan = 0;
include '../system/footer.php';
?>