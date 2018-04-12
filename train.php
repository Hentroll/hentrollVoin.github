<?php
include 'system/func.php';
$title = 'Тренировка';
include 'system/header.php';
auth();
    function cost($i) {
        
        switch($i) {
          case 0:
$cost = 500;
           break;
        
          case 1:
$cost = 1000;
           break;
        
          case 2:
$cost = 2000;
           break;
          
          case 3:
$cost = 4000;
           break;

          case 4:
$cost = 8000;
           break;   
           
          case 5:
$cost = 16000;
           break;        

          case 6:
$cost = 32000;
           break;   

          case 7:
$cost = 64000;
           break;

          case 8:
$cost = 128000;
           break;   
           
          case 9:
$cost = 256000;
           break;   

          case 10:
$cost = 32000;
           break;
           
          case 11:
$cost = 64000;
           break;
        
          case 12:
$cost = 128000;
           break;
        
          case 13:
$cost = 256000;
           break;
          
          case 14:
$cost = 412000;
           break;

          case 15:
$cost = 844000;
           break;   
           
          case 16:
$cost = 1688000;
           break;        

          case 17:
$cost = 3376000;
           break;   

          case 18:
$cost = 6752000;
           break;

          case 19:
$cost = 13504000;
           break;   
           
          case 20:
$cost = 27008000;
           break;
           
        }
        
global $user;
    return $cost;
    
    }

    function value($i) {
        
        switch($i) {
          case 0:
$value = 'crystals';
           break;
        
          case 1:
$value = 'crystals';
           break;
        
          case 2:
$value = 'crystals';
           break;
          
          case 3:
$value = 'crystals';
           break;

          case 4:
$value = 'crystals';
           break;        

          case 5:
$value = 'crystals';
           break;        

          case 6:
$value = 'crystals';
           break;        

          case 7:
$value = 'crystals';
           break;       

          case 8:
$value = 'crystals';
           break;        

          case 9:
$value = 'crystals';
           break;        

          case 10:
$value = 'crystals';
           break;

          case 11:
$value = 'crystals';
           break;
        
          case 12:
$value = 'crystals';
           break;
        
          case 13:
$value = 'crystals';
           break;
          
          case 14:
$value = 'crystals';
           break;

          case 15:
$value = 'crystals';
           break;        

          case 16:
$value = 'crystals';
           break;        

          case 17:
$value = 'crystals';
           break;        

          case 18:
$value = 'crystals';
           break;       

          case 19:
$value = 'crystals';
           break;        

          case 20:
$value = 'crystals';
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
$param = '24';
           break;

          case 11:
$param = '27';
           break;
        
          case 12:
$param = '30';
           break;
        
          case 13:
$param = '33';
           break;
          
          case 14:
$param = '36';
           break;

          case 15:
$param = '39';
           break;        

          case 16:
$param = '42';
           break;        

          case 17:
$param = '45';
           break;        

          case 18:
$param = '48';
           break;        


          case 19:
$param = '51';
           break;        

          case 20:
$param = '54';
           break;
}
return $param;
    
    }

if(isset($_GET['sila'])) {
if($user['str_train'] != 20) {
if(value($user['str_train']) == 'crystals') {
if($user['crystals'] < cost($user['str_train'])) {
$_SESSION['msg'] = "<div class='text center'>Не хватает ".(cost($user['str_train'])-$user['crystals'])." серебра!</div>";
header('Location: ?');
exit();
}else{
mysql_query('UPDATE `users` SET `str` = `str` + '.param($user['str_train']).', `str_train_param` =   `str_train_param` + '.param($user['str_train']).', `str_train` =  `str_train` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `crystals` = `crystals` - '.cost($user['str_train']).' WHERE `id` = "'.$user['id'].'"');
$_SESSION['msg'] = '<div class="text center"><font color="lime">Тренировка силы прошла успешно!</font></div>';
header('Location: ?');
exit();
}    
}
}    
}
if(isset($_GET['def'])) {
if($user['def_train'] != 20) {
if(value($user['def_train']) == 'crystals') {
if($user['crystals'] < cost($user['def_train'])) {
$_SESSION['msg'] = "<div class='text center'>Не хватает ".(cost($user['def_train'])-$user['crystals'])." серебра!</div>";
header('Location: ?');
exit();
}else{
mysql_query('UPDATE `users` SET `def` = `def` + '.param($user['def_train']).', `def_train_param` =   `def_train_param` + '.param($user['def_train']).', `def_train` =  `def_train` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `crystals` = `crystals` - '.cost($user['def_train']).' WHERE `id` = "'.$user['id'].'"');
$_SESSION['msg'] = '<div class="text center"><font color="lime">Тренировка защиты прошла успешно!</font></div>';
header('Location: ?');
exit();
}    
}
}    
}
if(isset($_GET['hp'])) {
if($user['hp_train'] != 20) {
if(value($user['hp_train']) == 'crystals') {
if($user['crystals'] < cost($user['hp_train'])) {
$_SESSION['msg'] = "<div class='text center'>Не хватает ".(cost($user['hp_train'])-$user['crystals'])." серебра!</div>";
header('Location: ?');
exit();
}else{
mysql_query('UPDATE `users` SET `max_health` = `max_health` + '.param($user['hp_train']).', `hp_train_param` =   `hp_train_param` + '.param($user['hp_train']).', `hp_train` =  `hp_train` + 1 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `crystals` = `crystals` - '.cost($user['hp_train']).' WHERE `id` = "'.$user['id'].'"');
$_SESSION['msg'] = '<div class="text center"><font color="lime">Тренировка здоровья прошла успешно!</font></div>';
header('Location: ?');
exit();
}    
}
}    
}
echo "<div class='de center'><img src='/icons/train.png' width='' height=''> ".$title."</div>";
echo "<div class='text'><div class='oh'><img src='/icons/14february/str.png' width='50' height='50'></div> Уровень: ".$user['str_train']." из 20<br>+ ".($user['str_train_param'])." к силе<br>Цена:  <img src='/icons/silver.png' width='16' height='16'>".cost($user['str_train'])."<br>";
if($user['str_train'] != 20){
echo "<hr><div class='center'><a href='?sila' class='but'>Тренировать</a></div>";
}
echo "</div>";
echo "<div class='text'><div class='oh'><img src='/icons/14february/def.png' width='50' height='50'></div> Уровень: ".$user['def_train']." из 20<br>+ ".($user['def_train_param'])." к защите<br>Цена:  <img src='/icons/silver.png' width='16' height='16'>".cost($user['def_train'])."<br>";
if($user['def_train'] != 20){
echo "<hr><div class='center'><a href='?def' class='but'>Тренировать</a></div>";
}
echo "</div>";
echo "<div class='text'><div class='oh'><img src='/icons/14february/health.png' width='50' height='50'></div> Уровень: ".$user['hp_train']." из 20<br>+ ".($user['hp_train_param'])." к здоровью<br>Цена: <img src='/icons/silver.png' width='16' height='16'>".cost($user['hp_train'])."<br>";
if($user['hp_train'] != 20){
echo "<hr><div class='center'><a href='?hp' class='but'>Тренировать</a></div>";
}
echo "</div>";
echo "<a href='/hero/".$myID."#".$r."' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include 'system/footer.php';
?>