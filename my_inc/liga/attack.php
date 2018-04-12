<?php
auth();
//рейтинг
if($user['liga_rating'] <= 0){
mysql_query("UPDATE `users` SET `liga_rating` = '0' WHERE `id` = '".$myID."'");
}
//
//результат атаки
$rand = rand(0,3);
//
//награда
$exp_yes = rand(30,80+$clan_exp);
$silver_yes = rand(30,80+$clan_silver);
$exp_no = rand(20,30+$clan_exp);
$silver_no = rand(20,40+$clan_silver);
$win = rand(5,10);
//
//клан награда
if($rand == '0'){
$clan_1 = rand(20,30);
}elseif($rand == '1'){
$clan_1 = rand(20,30);
}elseif($rand == '2'){
$clan_1 = rand(10,20);
}elseif($rand == '3'){
$clan_1 = rand(10,20);
}
//
if(isset($_GET['attack'])){
if($user['coll_liga'] == 0){
header('Location: ?'.$r.'');
exit();
}
if($user['id_clan'] > 0){
mysql_query("UPDATE `users` SET `clan_exp` = '".($user['clan_exp'] + $clan_1)."' WHERE `id` = '".$myID."' LIMIT 1");
mysql_query("UPDATE `clans` SET `exp` = `exp` + '$clan_1' WHERE `id` = '".$user['id_clan']."' LIMIT 1");
}
if($rand == '0'){
if($user['vip'] == 0){
mysql_query("UPDATE `users` SET `coll_liga` = '".($user['coll_liga'] - 1)."', `exp` = '".($user['exp'] + $exp_yes+$titul_exp+$zl)."', `crystals` = '".($user['crystals'] + $silver_yes+$titul_s)."', `liga_rating` = '".($user['liga_rating'] + $win)."', `quest_2_coll` = '".($user['quest_2_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_yes+$titul_s).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_yes+$titul_exp+$zl).'</div>';
}else{
mysql_query("UPDATE `users` SET `coll_liga` = '".($user['coll_liga'] - 1)."', `exp` = '".($user['exp'] + $exp_yes * 2 + $user['ring']+$titul_exp+$zl)."', `crystals` = '".($user['crystals'] + $silver_yes * 2 + $user['amulet']+$titul_s)."', `liga_rating` = '".($user['liga_rating'] + $win)."', `quest_2_coll` = '".($user['quest_2_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_yes * 2 + $user['amulet']+$titul_s).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_yes * 2 + $user['ring']+$titul_exp+$zl).'</div>';
}
header('Location: ?'.$r.'');
exit();
}
if($rand == '1'){
if($user['vip'] == 0){
mysql_query("UPDATE `users` SET `coll_liga` = '".($user['coll_liga'] - 1)."', `exp` = '".($user['exp'] + $exp_yes+$titul_exp+$zl)."', `crystals` = '".($user['crystals'] + $silver_yes+$titul_s)."', `liga_rating` = '".($user['liga_rating'] + $win)."', `quest_2_coll` = '".($user['quest_2_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_yes+$titul_s).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_yes+$titul_exp+$zl).'</div>';
}else{
mysql_query("UPDATE `users` SET `coll_liga` = '".($user['coll_liga'] - 1)."', `exp` = '".($user['exp'] + $exp_yes * 2 + $user['ring']+$titul_exp+$zl)."', `crystals` = '".($user['crystals'] + $silver_yes * 2 + $user['amulet']+$titul_s)."', `liga_rating` = '".($user['liga_rating'] + $win)."', `quest_2_coll` = '".($user['quest_2_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="lime">Победа!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_yes * 2 + $user['amulet']+$titul_s).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_yes * 2 + $user['ring']+$titul_exp+$zl).'</div>';
}
header('Location: ?'.$r.'');
exit();
}
if($rand == '2'){
if($user['vip'] == 0){
mysql_query("UPDATE `users` SET `coll_liga` = '".($user['coll_liga'] - 1)."', `exp` = '".($user['exp'] + $exp_no+$titul_exp+$zl)."', `crystals` = '".($user['crystals'] + $silver_no+$titul_s)."', `quest_2_coll` = '".($user['quest_2_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_no+$titul_s).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_no+$titul_exp+$zl).'</div>';
}else{
mysql_query("UPDATE `users` SET `coll_liga` = '".($user['coll_liga'] - 1)."', `exp` = '".($user['exp'] + $exp_no * 2 + $user['ring']+$titul_exp+$zl)."', `crystals` = '".($user['crystals'] + $silver_no * 2 + $user['amulet']+$titul_s)."', `quest_2_coll` = '".($user['quest_2_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_no * 2 + $user['amulet']+$titul_s).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_no * 2 + $user['ring']+$titul_exp+$zl).'</div>';
}
header('Location: ?'.$r.'');
exit();
}
if($rand == '3'){
if($user['vip'] == 0){
mysql_query("UPDATE `users` SET `coll_liga` = '".($user['coll_liga'] - 1)."', `exp` = '".($user['exp'] + $exp_no+$titul_exp+$zl)."', `crystals` = '".($user['crystals'] + $silver_no+$titul_s)."', `quest_2_coll` = '".($user['quest_2_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_no+$titul_s).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_no+$titul_exp+$zl).'</div>';
}else{
mysql_query("UPDATE `users` SET `coll_liga` = '".($user['coll_liga'] - 1)."', `exp` = '".($user['exp'] + $exp_no * 2 + $user['ring']+$titul_exp+$zl)."', `crystals` = '".($user['crystals'] + $silver_no * 2 + $user['amulet']+$titul_s)."', `quest_2_coll` = '".($user['quest_2_coll'] + 1)."' WHERE `id` = '".$myID."'");
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Поражение!</font><br>Награда: + <img src="/icons/silver.png" width="16" height="16">'.($silver_no * 2 + $user['amulet']+$titul_s).', <img src="/icons/exp.png" width="14" height="14"> '.($exp_no * 2 + $user['ring']+$titul_exp+$zl).'</div>';
}
header('Location: ?'.$r.'');
exit();
}
header('Location: ?'.$r.'');
}
?>