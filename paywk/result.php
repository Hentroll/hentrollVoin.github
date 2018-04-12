<?php
if (isset($_POST['WK_PAY_AMOUNT']) && isset($_POST['WK_PAY_TIME']) && isset($_POST['WK_PAY_HASH']))
{
include '../system/func.php';
include ('sett.php');

$common_string = wk_id.$_POST['WK_PAY_AMOUNT'].$_POST['WK_PAY_TIME'].wk_code;
$hash = strtoupper(hash("sha256",$common_string));
if($hash!=$_POST['WK_PAY_HASH']) exit('NO HACK!');

$summ = wk_summ($_POST['WK_PAY_AMOUNT']);
$id = abs(intval($_POST['WK_PAY_USER']));
$count = abs(intval($_POST['WK_PAY_COUNT']));
$type = $_POST['WK_PAY_TOVAR'];

if($type == 'gold' && isset($wk_cena_gold[$count]) && $wk_cena_gold[$count]==$summ)
{
$text = "Вы успешно приобрели ".($count+($count/2))." золота![br]Бонус: ".($count*25/100)." золота![br]Акция: + ".($count*$count)." серебра!";
mysql_query("INSERT INTO `mail` SET `in` = '0', `out` = '".$id."', `text` = '$text' , `time` = '".time()."'");
$kont = mysql_fetch_assoc(mysql_query("SELECT * FROM `kont` WHERE `id_user` = '".$id."' && `id_kont` = '0' LIMIT 1"));
if(!$kont){
mysql_query("INSERT INTO `kont` SET `id_user` = '".$id."', `id_kont` = '0', `time` = '".time()."'");
}else{
mysql_query("update `kont` set `time` = '".time()."' WHERE `id_user` = '".$id."' AND `id_kont` = '0'");
}
mysql_query("UPDATE `users` SET `gold` = `gold` + '".(($count)+($count*25/100)+($count/2))."', `crystals` = `crystals` + '".($count*$count)."', `quest_5_coll` = `quest_5_coll`+".($count+($count*25/100)+($count/2)).", `quest_6_coll` = `quest_6_coll`+".($count+($count*25/100)+($count/2))." WHERE `id` = '".$id."'");
exit('YES');
}
}
?>
