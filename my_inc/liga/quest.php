<?php
auth();
if($user['liga'] == 0){
$progress = '250';
}elseif($user['liga'] == 1){
$progress = '500';
}elseif($user['liga'] == 2){
$progress = '750';
}elseif($user['liga'] == 3){
$progress = '1500';
}elseif($user['liga'] == 4){
$progress = '3000';
}elseif($user['liga'] == 5){
$progress = '5000';
}
echo '<hr><a href="?quest"><img src="/icons/liga.png" width="16" height="16"> <u>Лига '.$liga.'</u> ';
if($user['liga_rating'] >= 250 && $user['liga'] == 0){
echo '<font color="lime">(+)</font>';
}elseif($user['liga_rating'] >= 500 && $user['liga'] == 1){
echo '<font color="lime">(+)</font>';
}elseif($user['liga_rating'] >= 750 && $user['liga'] == 2){
echo '<font color="lime">(+)</font>';
}elseif($user['liga_rating'] >= 1500 && $user['liga'] == 3){
echo '<font color="lime">(+)</font>';
}elseif($user['liga_rating'] >= 3000 && $user['liga'] == 4){
echo '<font color="lime">(+)</font>';
}elseif($user['liga_rating'] >= 5000 && $user['liga'] == 5){
echo '<font color="lime">(+)</font>';
}
echo '</a>';
echo '<br>Процесс: '.$user['liga_rating'].' из '.$progress.'';
?>