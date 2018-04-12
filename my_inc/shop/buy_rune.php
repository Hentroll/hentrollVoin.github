<?
if(isset($_GET['item'])){
	$item=abs(intval($_GET['item']));
	if(isset($_GET['pay'])){
		$pay=abs(intval($_GET['pay']));
if($pay==1){$price=100; $stats=75;}
elseif($pay==2){$price=500; $stats=150;}
elseif($pay==3){$price=1000; $stats=300;}
elseif($pay==4){$price=5000; $stats=700;}
else {$price=10000; $stats=1500;}
		if($user['run_'.$item] >= $pay){
			header('Location: /shop.php?runs&item='.$item);
			exit();
		}
if($user['gold'] < $price){
$_SESSION['msg'] = '<div class="text center"><font color="tomato">Недостаточно золота</font></div>';
header('Location: /shop.php?runs&item='.$item);
exit();
}
mysql_query("UPDATE `users` SET `run_".$item."_param` = '".($user['run_'.$item.'_param'] + $stats)."', `str` = '".($user['str'] + $stats)."', `max_health` = '".($user['max_health'] + $stats)."', `gold` = '".($user['gold'] - $price)."', `def` = '".($user['def'] + $stats)."', `run_".$item."` = '$pay' WHERE `id` = '".$user['id']."'");
		$_SESSION['msg'] = '<div class="text center"><font color="lime">Руна приобретена</font></div>';
		header('Location: /shop.php?runs&item='.$item);
		exit();
	}
	if($user['run_'.$item] == 1){
		$icon_name = '<img src="/icons/item/complect_1.png"> Обычная руна';
	}elseif($user['run_'.$item] == 2){
		$icon_name = '<img src="/icons/item/complect_2.png"> Редкая руна';
	}elseif($user['run_'.$item] == 3){
		$icon_name = '<img src="/icons/item/complect_3.png"> Эпическая руна';
	}elseif($user['run_'.$item] == 4){
		$icon_name = '<img src="/icons/item/complect_4.png"> Легендарная руна';
	}elseif($user['run_'.$item] == 5){
		$icon_name = '<img src="/icons/item/complect_5.png"> Божественная руна';
	}	
	echo '<div class="de center"><img src="/icons/item/complect_5.png" width="" height=""> Магазин рун</div>';
echo '<div class="text"><div class="oh"><img src="/icons/item/'.$user['snar_'.$item].'/'.$item.'.png" width="50" height="50"></div> '.$run_1.' '.$user['item_'.$item.'_text'].' <font color="lime">+ '.$user['zat_'.$item].'</font><br><img src="/icons/str.png" width="16" height="16">'.($user['item_'.$item.'_str']+$user['run_'.$item.'_param']).' <img src="/icons/def.png" width="16" height="16">'.($user['item_'.$item.'_def']+$user['run_'.$item.'_param']).' <img src="/icons/health.png" width="16" height="16">'.($user['item_'.$item.'_health']+$user['run_'.$item.'_param']).'<br>';
	if($user['run_'.$item] == 0){
		echo 'Руна отсутствует.';
	}else{echo $icon_name;}
echo '<br><br></div>';
	if($user['run_'.$item] == 0)
echo '<div class="text center"><img src="/icons/item/complect_1.png"> Обычная руна <font color="lime">(+75)</font><br><a href="/shop.php?runs&item='.$item.'&pay=1" class="but">Купить за <img src="/icons/gold.png" width="16" height="16">100</a></div>';
	if($user['run_'.$item] <= 1)
echo '<div class="text center"><img src="/icons/item/complect_2.png"> Редкая руна <font color="lime">(+150)</font><br><a href="/shop.php?runs&item='.$item.'&pay=2" class="but">Купить за <img src="/icons/gold.png" width="16" height="16">500</a></div>';
	echo '</div> <div class="text center">';
	if($user['run_'.$item] <= 2)
echo '<img src="/icons/item/complect_3.png"> Эпическая руна <font color="lime">(+300)</font><br><a href="/shop.php?runs&item='.$item.'&pay=3" class="but">Купить за <img src="/icons/gold.png" width="16" height="16">1000</a>';
	if($user['run_'.$item] <= 3)
echo '<div class="text center"><img src="/icons/item/complect_4.png"> Легендарная руна <font color="lime">(+700)</font><br><a href="/shop.php?runs&item='.$item.'&pay=4" class="but">Купить за <img src="/icons/gold.png" width="16" height="16">5000</a></div>';
	if($user['run_'.$item] <= 4)
echo '<div class="text center"><img src="/icons/item/complect_5.png"> Божественная руна <font color="lime">(+1500)</font><br><a href="/shop.php?runs&item='.$item.'&pay=5" class="but">Купить за <img src="/icons/gold.png" width="16" height="16">10000</a></div>';
if($user['run_'.$item] >= 5)
echo '<div class="text center"><font color="tomato">Все руны приобретены!</font>';
echo '</div></div><a href="/shop.php?runs" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
	include 'system/footer.php';
	exit();
}