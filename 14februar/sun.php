<?php
include '../system/func.php';
$title = 'Сундуки';
auth();

include '../system/header.php';
//награда в сундуках
$plus = rand(1,5);
$gold = array(1=>'100',2=>'300',3=>'500',4=>'700',5=>'700');
$silver = array(1=>'1000',2=>'5000',3=>'15000',4=>'30000',5=>'50000');
$exp = array(1=>'50',2=>'100',3=>'500',4=>'700',5=>'1300');
// 
$heard=25; $gold_price=500;
//открываем сундуки
if(isset($_GET['ok'])){
	$ok=abs(intval($_GET['ok'])); 
	$plus_gold = $gold[$plus];
	$plus_silver =  $silver[$plus];
	$plus_exp =  $exp[$plus];	
	if($ok==1){
		if($user['fb_heard'] >= $heard){
			mysql_query("UPDATE `users` SET `fb_heard` = `fb_heard` - '$heard', `gold` = '".($user['gold'] + $plus_gold)."', `crystals` = '".($user['crystals'] + $plus_silver)."', `exp` = '".($user['exp'] + $plus_exp)."' WHERE `id` = '".$user['id']."'");			
			$_SESSION['msg'] = '<div class="text center"><font color="lime">Сундук открыт!<br>Награда: <img src="/icons/gold.png" width="16" height="16">'.$plus_gold.', <img src="/icons/silver.png" width="16" height="16">'.($plus_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($plus_exp).'</font></div>';
			header('Location: /14february/sun.php?'.$r.'');exit();
		}else{
			err_game('У Вас не хватает <img src="/icons/14february/heard.png" width="16" height="16"><font colot="yellow"> '.($heard-$user['fb_heard']).' </font>');
		}
	}elseif($ok==2){
		if($user['gold'] >= $gold_price){
			mysql_query("UPDATE `users` SET `gold` = `gold` - '$gold_price',  `gold` = `gold` + '$plus_gold', `crystals` = '".($user['crystals'] + $plus_silver)."', `exp` = '".($user['exp'] + $plus_exp)."' WHERE `id` = '".$user['id']."'");
			$_SESSION['msg'] = '<div class="text center"><font color="lime">Сундук открыт!<br>Награда: <img src="/icons/gold.png" width="16" height="16">'.$plus_gold.', <img src="/icons/silver.png" width="16" height="16">'.($plus_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($plus_exp).'</font></div>';
			header('Location: /14february/sun.php?'.$r.'');exit();
		}else{
			err_game('У Вас не хватает <img src="/icons/gold.png" width="16" height="16"><font colot="yellow"> '.($gold_price-$user['gold']).' </font>');
		}
	}else{
		if($user['sun_time'] >= time()){
			err_game('Вы уже получали бесплатный сундук');
		}else{
			mysql_query("UPDATE `users` SET `gold` = '".($user['gold'] + $plus_gold)."', `crystals` = '".($user['crystals'] + $plus_silver)."', `exp` = '".($user['exp'] + $plus_exp)."', `sun_time` = '".(time()+3600*24)."' WHERE `id` = '".$user['id']."'");
			$_SESSION['msg'] = '<div class="text center"><font color="lime">Сундук открыт!<br>Награда: <img src="/icons/gold.png" width="16" height="16">'.$plus_gold.', <img src="/icons/silver.png" width="16" height="16">'.($plus_silver).', <img src="/icons/exp.png" width="14" height="14"> '.($plus_exp).'</font></div>';
			header('Location: /14february/sun.php?'.$r.'');exit();
		}
	}
}
//
echo '<div class="de center"><img src="/icons/14february/heard.png"> '.$title.'</div>';
echo '<div class="text center"><font color="lime">Редкий сундук</font><br><img src="/icons/14february/sun.png" width="90" height="90"><hr>';
echo '<a href="?ok=1" class="but">Открыть за <img src="/icons/14february/heard.png" width="16" height="16">'.$heard.'</a>
			<br><br>
	  <a href="?ok=2" class="but">Открыть за <img src="/icons/gold.png" width="16" height="16">'.$gold_price.'</a>
</div>';
echo '<div class="text center"><font color="hotpink">Сундук Влюбленных</font><br><img src="/icons/14february/sun_1.png" width="90" height="90"><hr>';
if($user['sun_time'] < time()){
echo '<a href="?ok=3" class="but">Открыть бесплатно</a>';
}else{
echo 'Через: '.tl($user['sun_time'] - time()).'';
}
echo '</div>';
echo '<a href="/14february/index.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
include '../system/footer.php';
?>