<?php
include '../system/func.php';
auth();
$clan = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id` = '".$user['id_clan']."'"));
$clan_bonus = mysql_fetch_assoc(mysql_query("SELECT * FROM `clan_bonus` WHERE `id_clan` = '".$clan['id']."'"));
    function cost($i) {
        
        switch($i) {
          case 0:
           $cost = 1000;
           break;
        
          case 1:
           $cost = 2000;
           break;
        
          case 2:
           $cost = 3000;
           break;
          
          case 3:
           $cost = 4000;
           break;

          case 4:
           $cost = 5000;
           break;   
           
          case 5:
           $cost = 6000;
           break;        

          case 6:
           $cost = 7000;
           break;   

          case 7:
           $cost = 8000;
           break;

          case 8:
           $cost = 9000;
           break;   
           
          case 9:
           $cost = 10000;
           break;   

          case 10:
           $cost = 11000;
           break;   

          case 11:
           $cost = 12000;
           break;   

          case 12:
           $cost = 13000;
           break;   

          case 13:
           $cost = 14000;
           break;   

          case 14:
           $cost = 15000;
           break;   

          case 15:
           $cost = 30000;
break;



}

global $user;
return $cost;
}

    function value($i) {
        
        switch($i) {
          case 0:
           $value = 'gold';
           break;
        
          case 1:
           $value = 'gold';
           break;
        
          case 2:
           $value = 'gold';
           break;
          
          case 3:
           $value = 'gold';
           break;

          case 4:
           $value = 'gold';
           break;        

          case 5:
           $value = 'gold';
           break;        

          case 6:
           $value = 'gold';
           break;        

          case 7:
           $value = 'gold';
           break;        

          case 8:
           $value = 'gold';
           break;        

          case 9:
           $value = 'gold';
           break;        

          case 10:
           $value = 'gold';
           break;        

          case 11:
           $value = 'gold';
           break;        

          case 12:
           $value = 'gold';
           break;        

          case 13:
           $value = 'gold';
           break;        

          case 14:
           $value = 'gold';
           break;        

          case 15:
           $value = 'gold';
           break;        
        }
    return $value;
    }
if(isset($_GET['up']) and $user['clan_rang'] >= 4 && $clan['stat_level_2'] < $clan['user_clan']){
if(value($clan['stat_level_2']) == 'gold') {
if($clan['gold'] < cost($clan['stat_level_2'])) {
$_SESSION['msg'] = "<div class='text center'><font color='tomato'>Не хватает ".(cost($clan['stat_level_2'])-$clan['gold'])." золота</font></div>";
header("Location: ?".$r."");
exit();
}else{
mysql_query("UPDATE `clans` SET `stat_2` = '".($clan['stat_2']+1)."', `stat_level_2` = '".($clan['stat_level_2']+1)."', `gold` = '".($clan['gold']-cost($clan['stat_level_2']))."' WHERE `id` = '".$clan['id']."'");
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
echo "<div class='oh'><img src='/icons/clan/zdan4.png' width='50' height='50'></div>";
echo "<font color='silver'>Алтарь<br>Уровень: $clan[stat_level_2] из 15<br>+".($clan['stat_2']*2)."% к серебру</font>";
echo "<hr>";
if($clan['stat_level_2'] < $clan['user_clan'] && $user['clan_rang'] >= 4)echo "<center><a href='?up' class='but'><font color='whitesmoke'>Улучшить за <img src='/icons/gold.png' width='16' height='16'>".cost($clan['stat_level_2'])."</font></a></center>";
echo '<hr><center><font color="silver">Улучшать бонус, могут лидер или генералы клана!</font></center>';
echo "</div>";
echo "<a href='/clan/bonus.php' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
$clan = 0;
include '../system/footer.php';
?>