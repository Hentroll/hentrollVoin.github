<?php
if($user['company_id'] == 0){
if($user['adven'] >= 1 && $user['level'] >= 3 && $user['liga'] >= 1 && $user['id_clan'] >= 1 && $user['snar_1'] >= 1 && $user['snar_2'] >= 1 && $user['snar_3'] >= 1 && $user['snar_4'] >= 1 && $user['snar_5'] >= 1 && $user['snar_6'] >= 1){
echo '<font color="lime">(+)</font>';
}
}elseif($user['company_id'] == 1){
if($user['adven'] >= 2 && $user['level'] >= 6 && $user['liga'] >= 2 && $user['clan_tour'] >= 250 && $user['snar_1'] >= 2 && $user['snar_2'] >= 2 && $user['snar_3'] >= 2 && $user['snar_4'] >= 2 && $user['snar_5'] >= 2 && $user['snar_6'] >= 2){
echo '<font color="lime">(+)</font>';
}
}elseif($user['company_id'] == 2){
if($user['adven'] >= 3 && $user['level'] >= 9 && $user['liga'] >= 3 && $user['clan_tour'] >= 300 && $user['snar_1'] >= 3 && $user['snar_2'] >= 3 && $user['snar_3'] >= 3 && $user['snar_4'] >= 3 && $user['snar_5'] >= 3 && $user['snar_6'] >= 3){
echo '<font color="lime">(+)</font>';
}
}elseif($user['company_id'] == 3){
if($user['adven'] >= 4 && $user['level'] >= 12 && $user['liga'] >= 4 && $user['clan_tour'] >= 500 && $user['snar_1'] >= 4 && $user['snar_2'] >= 4 && $user['snar_3'] >= 4 && $user['snar_4'] >= 4 && $user['snar_5'] >= 4 && $user['snar_6'] >= 4){
echo '<font color="lime">(+)</font>';
}
}elseif($user['company_id'] == 4){
if($user['adven'] >= 5 && $user['level'] >= 15 && $user['liga'] >= 5 && $user['clan_tour'] >= 1000 && $user['snar_1'] >= 5 && $user['snar_2'] >= 5 && $user['snar_3'] >= 5 && $user['snar_4'] >= 5 && $user['snar_5'] >= 5 && $user['snar_6'] >= 5){
echo '<font color="lime">(+)</font>';
}
}
?>