<?php

$mc = mysql_connect('localhost', 'mys928_mog', 'Resultokerror1994') or die('');
mysql_query('SET NAMES `utf8`', $mc);
mysql_select_db('mys928_mog', $mc) or die('');
session_start();
ob_start();
function esc($text,$br=NULL){ // Вырезает все нечитаемые символы  
if ($br!=NULL)  
for ($i=0;$i<=31;$i++)$text=str_replace(chr($i), NULL, $text); 
else{  
for ($i=0;$i<10;$i++)$text=str_replace(chr($i), NULL, $text); 
for ($i=11;$i<20;$i++)$text=str_replace(chr($i), NULL, $text); 
for ($i=21;$i<=31;$i++)$text=str_replace(chr($i), NULL, $text);} 
return $text; 
}
function hsc($text){
	return htmlspecialchars($text);
}
function err_game($msg){
	echo'<div class="text center"><font color="tomato">'.($msg).'</font></div>';
}
function nick($id){
	$id=intval($id);
	if(mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id` = '$id'"),0)>0){
		$us=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1"));
		return'<a href="/hero/'.$us['id'].'#'.$r.'"><img src="/icons/'.$us['sex'].'.png"> '.hsc($us['login']).', '.$us['level'].' ур.</a>';
	} else {
		return' [Аккаунт удален] ';
	}
}
function text($m){
$m = mysql_real_escape_string(htmlspecialchars(stripslashes(trim($m))));
	return $m;
} /* Фильтрует текст */
function num($m){
	$m = intval($m);
	$m = abs($m);
	return $m;
} /* Фильтрует цифры */
$user = null;
if (isset($_COOKIE['login']) and isset($_COOKIE['password'])) {
	$login = text($_COOKIE['login']);
	$password = text($_COOKIE['password']);
	
	$dbs = mysql_query("SELECT * FROM `users` WHERE `login` = '".$login."' and `password` = '".$password."' LIMIT 1");
	$user = mysql_fetch_assoc($dbs);
	
	if (isset($user['id'])) {
		if ($user['login'] != $login or $user['password'] != $password) {
			setcookie('login', '', time() - 86400*31);
			setcookie('password', '', time() - 86400*31);
		}
	}
	
	$users = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `login` = '".$login."' and `password`='".$password."' LIMIT 1"));           

	if(isset($user['id']) && $users['login']!=$login or $users['password']!=$password) {
		setcookie('login', '', time() - 86400*31);
		setcookie('password', '', time() - 86400*31); 
	}
}
$myID = $user['id'];
mysql_query("update `users` set `online` = '".time()."', `ip` = '".$_SERVER['REMOTE_ADDR']."' where (`id` = '".$myID."')");
$ban = mysql_query('SELECT * FROM `ban` WHERE `id_user` = "'.$myID.'" AND `last` > "'.time().'" ORDER BY `id` DESC LIMIT 1');
$ban = mysql_fetch_array($ban);
if($ban['ip'] != $user['ip']){
mysql_query("update `ban` set `ip` = '".$user['ip']."' where (`id` = '".$ban['id']."')");
}



function rez_text( $text, $maxwords = 40, $maxchar = 45 ){
$sep=' ';
$words = explode($sep,$text);
$char = iconv_strlen($text,'utf-8');
if (count($words) > $maxwords){		
$text = join($sep, array_slice($words, 0, $maxwords));
}
$sep2 = null;
if ( $char > $maxchar ){
$sep2='...';
$text = iconv_substr( $text, 0, $maxchar, 'utf-8' );
}
return $text.$sep2;
}
function text_msg($msg){
$bbcode=array();
$bbcode['/\n/isU']='<br>';
$bbcode['/\[br\]/isU']='<br>';
global $ank;
if($ank['access'] >= 0){
$bbcode['/\[center\](.+)\[\/center\]/isU'] = '<center>$1</center>';
}
if($ank['access'] >= 0){
$bbcode['/\[b\](.+)\[\/b\]/isU'] = '<b>$1</b>';
}

if($ank['access'] >= 0){
$bbcode['/\[img\](.*)\[\/img\]/isU'] = "<img src='$1'/>$2</img>";
}

if($ank['access'] >= 0){
$bbcode['/\[url=(.+)\](.+)\[\/url\]/isU'] = "<a href='$1'>$2</a>";
}
if($ank['access'] >= 0){
$bbcode['/\[a\](.+)\[\/a\]/isU'] = "<a>$1</a>";
}
if($ank['access'] >= 0){
$bbcode['/\[color=(.+)\](.+)\[\/color\]/isU'] = "<font color='$1'>$2</font>";
}
if (count($bbcode))$msg = preg_replace(array_keys($bbcode), array_values($bbcode), $msg);
if($ank['access'] == 2)$msg = "<font color='#00d0ff'>$msg</font>";
if($ank['access'] == 1)$msg = "<font color='#90ee90'>$msg</font>";
$msg = str_replace(array(':)'), '<img src="http://mdrag.ru/style/smile/1.png" alt="*"/>', $msg);
$msg = str_replace(array(':D'), '<img src="http://mdrag.ru/style/smile/2.png" alt="*"/>', $msg);
$msg = str_replace(array(';)'), '<img src="http://mdrag.ru/style/smile/3.png" alt="*"/>', $msg);
$msg = str_replace(array(':X'), '<img src="http://mdrag.ru/style/smile/4.png" alt="*"/>', $msg);
$msg = str_replace(array(':p'), '<img src="http://mdrag.ru/style/smile/5.png" alt="*"/>', $msg);
$msg = str_replace(array('8)'), '<img src="http://mdrag.ru/style/smile/6.png" alt="*"/>', $msg);
$msg = str_replace(array('B)'), '<img src="http://mdrag.ru/style/smile/7.png" alt="*"/>', $msg);
$msg = str_replace(array(':('), '<img src="http://mdrag.ru/style/smile/9.png" alt="*"/>', $msg);
$msg = str_replace(array(';('), '<img src="http://mdrag.ru/style/smile/11.png" alt="*"/>', $msg);
$msg = str_replace(array(':like'), '<img src="http://mdrag.ru/style/smile/28.png" alt="*"/>', $msg);
$msg = str_replace(array(':dislike'), '<img src="http://mdrag.ru/style/smile/29.png" alt="*"/>', $msg);
$msg = str_replace(array(':['), '<img src="http://mdrag.ru/style/smile/19.png" alt="*"/>', $msg);
$msg = str_replace(array(':h'), '<img src="http://mdrag.ru/style/smile/14.png" alt="*"/>', $msg);
$msg = str_replace(array(':v'), '<img src="http://mdrag.ru/style/smile/31.png" alt="*"/>', $msg);
$msg = str_replace(array(':3'), '<img src="http://mdrag.ru/style/smile/27.png" alt="*"/>', $msg);
$msg = str_replace(array(':]'), '<img src="http://mdrag.ru/style/smile/10.png" alt="*"/>', $msg);
return $msg;
}
function msg($sms,$tip='msg'){
echo ''.$sms.'';
}
function tl($tl){
	$d=3600*24;
	$day=floor($tl/$d);
	$tl=$tl-($d*$day);

	$hour=floor($tl/3600);
	$tl=$tl-(3600*$hour);

	$minute=floor($tl/60);
	$tl=$tl-(60*$minute);

	$second=floor($tl);

	$dayt="".($day>0?"$day д. ":null)."";
	$hourt="".($hour>0?"$hour ч. ":null)."";
	$minutet="".($minute>0?"$minute м. ":null)."";
	$secondt="".($second>0?"$second с. ":null)."";
	
	if($day>0){
		$minutet=NULL;
		$secondt=NULL;
	}
	if($hour>0 && $day==0){
		$secondt=NULL;
		$dayt=NULL;
	}
	
	return "$dayt$hourt$minutet$secondt";
} /* Вывод оставшегося времени */

function vremja($time=NULL){
	if ($time == NULL)$time = time();
	$timep="".date("j M yг. в H:i", $time)."";
	$time_p[0]=date("j n Y", $time);
	$time_p[1]=date("H:i", $time);
	
	if ($time_p[0] == date("j n Y"))$timep = date("H:i:s", $time);
	if ($time_p[0] == date("j n Y", time()-60*60*24))$timep = "Вчера в $time_p[1]";
	
	$timep=str_replace("Jan","Янв",$timep);
	$timep=str_replace("Feb","Фев",$timep);
	$timep=str_replace("Mar","Мар",$timep);
	$timep=str_replace("May","Мая",$timep);
	$timep=str_replace("Apr","Апр",$timep);
	$timep=str_replace("Jun","Июня",$timep);
	$timep=str_replace("Jul","Июля",$timep);
	$timep=str_replace("Aug","Авг",$timep);
	$timep=str_replace("Sep","Сент",$timep);
	$timep=str_replace("Oct","Окт",$timep);
	$timep=str_replace("Nov","Нояб",$timep);
	$timep=str_replace("Dec","Дек",$timep);
	return $timep;
} /* Вывод времени */

function noauth(){
	global $user;
if(isset($user['id'])) header('Location: /home.php');
}

function auth(){
	global $user;
	if(!isset($user['id'])) header('Location: /');
}

function access($access = 0){
	global $user;
if($user['access'] < $access) header('Location: /home.php');
}

function page($k_page=1){ // Выдает текущую страницу
$page=1;
if (isset($_GET['page'])){
if ($_GET['page']=='end')$page=intval($k_page);elseif(is_numeric($_GET['page'])) $page=intval($_GET['page']);}
if ($page<1)$page=1;
if ($page>$k_page)$page=$k_page;
return $page;}

function k_page($k_post=0,$k_p_str=10){ // Высчитывает количество страниц
if ($k_post!=0){$v_pages=ceil($k_post/$k_p_str);return $v_pages;}
else return 1;}

function str($link='?',$k_page=1,$page=1){ // Вывод номеров страниц (только на первый взгляд кажется сложно ;))
if ($page<1)$page=1;
if ($page!=1)echo "<a href=\"".$link."page=1\" title=''><<</a> ";
if ($page!=1)echo "<a href=\"".$link."page=1\" title=''>1</a>";else echo "1";
for ($ot=-2; $ot<=2; $ot++){
if ($page+$ot>1 && $page+$ot<$k_page){
if ($ot==-3 && $page+$ot>2)echo "  ..";
if ($ot!=0)echo " <a href=\"".$link."page=".($page+$ot)."\" title='Страница №".($page+$ot)."'>".($page+$ot)."</a>";else echo "  ".($page+$ot)."";
if ($ot==3 && $page+$ot<$k_page-1)echo " ..";}}
if ($page!=$k_page)echo " <a href=\"".$link."page=end\" title=''>$k_page</a>";elseif ($k_page>1)echo " $k_page";
if ($page!=$k_page)echo " <a href=\"".$link."page=end\" title='Последняя страница'> >></a>";

}
function n_f($i, $tip = 0) {

if($tip == 1){

$i = number_format($i, 0, '', '\'');
}else{

    if($i >= 10000 && $i < 1000000) {
    
      $i = number_format($i, 0, '', '.');
    
      $i = round($i,1).'K';
    
    }
elseif($i >= 1000000) {

      $i = number_format($i, 0, '', '.');
    
      $i = round($i,1).'M';

    }
    else
    {
      
      $i = number_format($i, 0, '', '\'');
     
    }
    }
    return $i;
}
//вип кончился
if($user['time_vip'] < time() && $user['vip'] == 1){
mysql_query("UPDATE `users` SET `vip` = '0', `str` = '".($user['str'] - 150)."', `def` = '".($user['def'] - 150)."', `max_health` = '".($user['max_health'] - 150)."' WHERE `id` = '".$myID."'");
}
//space
if($user['zl_1_time'] < time() && $user['zl_1'] == 1){
mysql_query("UPDATE `users` SET `zl_1` = '0', `str` = '".($user['str'] - 100)."' WHERE `id` = '".$myID."'");
}
//
//space
if($user['zl_2_time'] < time() && $user['zl_2'] == 1){
mysql_query("UPDATE `users` SET `zl_2` = '0', `def` = '".($user['def'] - 100)."' WHERE `id` = '".$myID."'");
}
//
//space
if($user['zl_3_time'] < time() && $user['zl_3'] == 1){
mysql_query("UPDATE `users` SET `zl_3` = '0', `max_health` = '".($user['max_health'] - 100)."' WHERE `id` = '".$myID."'");
}
//
if($user['zl_4_time'] < time() && $user['zl_4'] == 1){
mysql_query("UPDATE `users` SET `zl_4` = '0' WHERE `id` = '".$myID."'");
}
//space
if($user['pohod'] < time() && $user['pohod_ok'] == 1){
mysql_query("UPDATE `users` SET `pohod_ok` = '2' WHERE `id` = '".$myID."'");
}
//space
if($user['quest_1_time'] < time() && $user['quest_1'] >= 1){
mysql_query("UPDATE `users` SET `quest_1_coll` = '0',  `quest_1` = '0' WHERE `id` = '".$myID."'");
}
//space
if($user['quest_2_time'] < time() && $user['quest_2'] >= 1){
mysql_query("UPDATE `users` SET `quest_2_coll` = '0',  `quest_2` = '0' WHERE `id` = '".$myID."'");
}
//
//
if($user['quest_5_time'] < time() && $user['quest_5'] >= 1){
mysql_query("UPDATE `users` SET `quest_5_coll` = '0',  `quest_5` = '0' WHERE `id` = '".$myID."'");
}
//
//
if($user['quest_6_time'] < time() && $user['quest_6'] >= 1){
mysql_query("UPDATE `users` SET `quest_6_coll` = '0',  `quest_6` = '0' WHERE `id` = '".$myID."'");
}
//
//
if($user['quest_3_time'] < time() && $user['quest_3'] >= 1){
mysql_query("UPDATE `users` SET `quest_3_coll` = '0',  `quest_3` = '0' WHERE `id` = '".$myID."'");
}
//space
//
if($user['quest_4_time'] < time() && $user['quest_4'] >= 1){
mysql_query("UPDATE `users` SET `quest_4_coll` = '0',  `quest_4` = '0' WHERE `id` = '".$myID."'");
}
//space
mysql_query("update `users` set `time_adven` = '".(time() + 1800)."', `coll_adven` = `coll_adven` + 15 where `time_adven` < '".time()."' and `coll_adven` < `coll_adven_max`");
mysql_query("UPDATE `users` SET `coll_adven` = `coll_adven_max` WHERE  `coll_adven` > `coll_adven_max`");
mysql_query("UPDATE `users` set `time_adven` = '".(time()+1800)."' where `coll_adven` = `coll_adven_max`");
//space
mysql_query("update `users` set `arena_time` = '".(time() + 1800)."', `arena_coll` = `arena_coll` + 5 where `arena_time` < '".time()."' and `arena_coll` < `arena_max`");
mysql_query("UPDATE `users` SET `arena_coll` = `arena_max` WHERE  `arena_coll` > `arena_max`");
mysql_query("UPDATE `users` set `arena_time` = '".(time()+1800)."' where `arena_coll` = `arena_max`");
//space
//
mysql_query("update `users` set `time_liga` = '".(time() + 1800)."', `coll_liga` = `coll_liga` + 5 where `time_liga` < '".time()."' && `coll_liga` < `coll_liga_max`");
mysql_query("UPDATE `users` SET `coll_liga` = `coll_liga_max` WHERE  `coll_liga` > `coll_liga_max`");
mysql_query("UPDATE `users` set `time_liga` = '".(time()+1800)."' where `coll_liga` = `coll_liga_max`");
//
$batle = mysql_query("SELECT * FROM `fight` WHERE `id` = '1' ORDER BY `id` LIMIT 1");
$batle = mysql_fetch_array($batle);
if($batle['health'] <= 0){
mysql_query("UPDATE `fight` SET `users` = '0', `health` = '".($batle['max_health'])."' WHERE `id` = '".$batle['id']."'");
mysql_query("UPDATE `users` SET `fight_ok` = '0', `fight_end` = '1' WHERE `id` = '".$user['id']."'");
header('Location: ?');
exit();
}
//space
mysql_query("update `users` set `time_fight` = '".(time() + 1800)."', `coll_fight` = `coll_fight` + 10 where `time_fight` < '".time()."' && `coll_fight` < `coll_fight_max`");
mysql_query("UPDATE `users` SET `coll_fight` = `coll_fight_max` WHERE  `coll_fight` > `coll_fight_max`");
mysql_query("UPDATE `users` set `time_fight` = '".(time()+1800)."' where `coll_fight` = `coll_fight_max`");
//
//space
mysql_query("update `users` set `time_tour` = '".(time() + 3600)."', `coll_tour` = `coll_tour` + 10 where `time_tour` < '".time()."' && `coll_tour` < `coll_tour_max`");
mysql_query("UPDATE `users` SET `coll_tour` = `coll_tour_max` WHERE  `coll_tour` > `coll_tour_max`");
mysql_query("UPDATE `users` set `time_tour` = '".(time()+3600)."' where `coll_tour` = `coll_tour_max`");
//
//
if($user['texr'] == '1' && $user['access'] <= '1'){
header('Location: /stop/support.php');
exit();
}
//
?>