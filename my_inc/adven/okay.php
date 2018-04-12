<?php
auth();
echo '<hr>';
echo ''.$task_1.''.$task_2.''.$task_3.'';
echo '<center><a href="?task"><img src="/icons/adven.png" width="16" height="16"> <u>Сюжетные задания ('.($user['adven']+1).'/15)</u> ';
if($user['adven_1'] >= 10 && $user['adven_2'] >= 10 && $user['adven_3'] >= 10 && $user['adven'] == 0)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 15 && $user['adven_2'] >= 15 && $user['adven_3'] >= 15 && $user['adven'] == 1)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 20 && $user['adven_2'] >= 20 && $user['adven_3'] >= 20 && $user['adven'] == 2)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 25 && $user['adven_2'] >= 25 && $user['adven_3'] >= 25 && $user['adven'] == 3)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 30 && $user['adven_2'] >= 30 && $user['adven_3'] >= 30 && $user['adven'] == 4)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 35 && $user['adven_2'] >= 35 && $user['adven_3'] >= 35 && $user['adven'] == 5)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 40 && $user['adven_2'] >= 40 && $user['adven_3'] >= 40 && $user['adven'] == 6)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 45 && $user['adven_2'] >= 45 && $user['adven_3'] >= 45 && $user['adven'] == 7)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 50 && $user['adven_2'] >= 50 && $user['adven_3'] >= 50 && $user['adven'] == 8)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 55 && $user['adven_2'] >= 55 && $user['adven_3'] >= 55 && $user['adven'] == 9)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 60 && $user['adven_2'] >= 60 && $user['adven_3'] >= 60 && $user['adven'] == 10)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 65 && $user['adven_2'] >= 65 && $user['adven_3'] >= 65 && $user['adven'] == 11)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 70 && $user['adven_2'] >= 70 && $user['adven_3'] >= 70 && $user['adven'] == 12)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 75 && $user['adven_2'] >= 75 && $user['adven_3'] >= 75 && $user['adven'] == 13)echo '<font color="lime">(+)</font>';
elseif($user['adven_1'] >= 80 && $user['adven_2'] >= 80 && $user['adven_3'] >= 80 && $user['adven'] == 14)echo '<font color="lime">(+)</font>';
echo '</a></center>';
echo '</div>';
?>