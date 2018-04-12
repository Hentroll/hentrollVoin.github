<?php
require_once ('system/func.php');
$title = 'Амулет силы';
require_once ('system/header.php');
auth();
if($user['amulet'] == 0){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Сначала приобретите амулет силы!</font></div>';
header('Location: /shop.php?talis#'.$r.'');
exit();
}
    function cost($i) {
        
        switch($i) {
          case 0:
$cost = 50;
           break;
        
          case 1:
$cost = 100;
           break;
        
          case 2:
$cost = 150;
           break;
          
          case 3:
$cost = 200;
           break;

          case 4:
$cost = 250;
           break;   
           
          case 5:
$cost = 300;
           break;        

          case 6:
$cost = 350;
           break;   

          case 7:
$cost = 400;
           break;

          case 8:
$cost = 450;
           break;   
           
          case 9:
$cost = 500;
           break;   

          case 10:
$cost = 500;
           break;
           
           
        }
        
global $user;
global $auction;
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
        
        }
    
    return $value;
    
    }
function param($i) {
        
        switch($i) {
          case 0:
$param = '3';
           break;
        
          case 1:
$param = '5';
           break;
        
          case 2:
$param = '7';
           break;
          
          case 3:
$param = '9';
           break;

          case 4:
$param = '11';
           break;        

          case 5:
$param = '13';
           break;        

          case 6:
$param = '15';
           break;        

          case 7:
$param = '17';
           break;        


          case 8:
$param = '19';
           break;        

          case 9:
$param = '21';
           break;        

          case 10:
$param = '21';
           break;
}
return $param;
    
    }

if(isset($_GET['ok'])) {
if($user['amulet_level'] != 10) {
if(value($user['amulet_level']) == 'gold') {
if($user['gold'] < cost($user['amulet_level'])) {
$_SESSION['msg'] = "Не хватает ".(cost($user['amulet_level'])-$user['gold'])." золота!";
header('Location: /amulet.php?".$r."');
exit();
}else{
mysql_query('UPDATE `users` SET `max_health` = `max_health` + '.param($user['amulet_level']).', `def` = `def` + '.param($user['amulet_level']).', `str` =   `str` + '.param($user['amulet_level']).', `amulet_param` =   `amulet_param` + '.param($user['amulet_level']).', `amulet_level` =  `amulet_level` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `gold` = `gold` - '.cost($user['amulet_level']).' WHERE `id` = "'.$user['id'].'"');
$_SESSION['msg'] = '<div class="text center"><font color="lime">Амулет силы успешно улучшен!</font></div>';
header('Location: /amulet.php?".$r."');
exit();
}    
}
}    
}
echo "<div class='de center'>Амулет силы</div><div class='text'><div class='oh'><img src='/icons/item/amulet.png' width='50' height='50'></div> Уровень: ".$user['amulet_level']." из 10<br>+".($user['amulet_param']*3)." к параметрам<br>Цена: ".cost($user['amulet_level'])." <img src='/icons/gold.png' width='16' height='16'><br>";
if($user['amulet_level'] != 10){
echo "<hr><div class='center'><a href='?ok' class='but'>Улучшить</a></div>";
}
echo '<hr><center>Улучшая амулет силы, вы повышаете параметры персонажа и увеличиваете <u>бонус серебра</u> в сражениях</center>';
echo "</div><a href='/shop.php?talis#".$r."' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include 'system/footer.php';
?>