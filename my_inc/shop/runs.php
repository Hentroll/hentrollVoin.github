<?php
auth();
include_once'my_inc/shop/buy_rune.php'; // покупка рун
include 'my_inc/shop/info_runs.php';
echo '<div class="de center"><img src="/icons/item/complect_5.png" width="" height=""> Магазин рун</div>';
if($user['snar_1'] >= 1){
echo '<div class="text"><div class="oh"><img src="/icons/item/'.$user['snar_1'].'/1.png" width="50" height="50"></div> '.$run_1.' '.$user['item_1_text'].' <font color="lime">+ '.$user['zat_1'].'</font><br><img src="/icons/str.png" width="16" height="16">'.($user['item_1_str']+$user['zat_1_param']+$user['run_1_param']).' <img src="/icons/def.png" width="16" height="16">'.($user['item_1_def']+$user['zat_1_param']+$user['run_1_param']).' <img src="/icons/health.png" width="16" height="16">'.($user['item_1_health']+$user['zat_1_param']+$user['run_1_param']).'<br>'.$icon_name_1.'<br><br>';
echo '<center><a href="?runs&item=1" class="but">Купить руну</a></center>';
echo '</div>';
}else{
echo '<div class="text"><div class="oh"><img src="/icons/item/0/1.png" width="35" height="35"></div> Шлем<br><a href="/shop.php?snar1"><u>Купить вещь</u></a></div>';
}
if($user['snar_2'] >= 1){
echo '<div class="text"><div class="oh"><img src="/icons/item/'.$user['snar_2'].'/2.png" width="50" height="50"></div> '.$user['item_2_text'].' <font color="lime">+ '.$user['zat_2'].'</font><br><img src="/icons/str.png" width="16" height="16">'.($user['item_2_str']+$user['zat_2_param']+$user['run_2_param']).' <img src="/icons/def.png" width="16" height="16">'.($user['item_2_def']+$user['zat_2_param']+$user['run_2_param']).' <img src="/icons/health.png" width="16" height="16">'.($user['item_2_health']+$user['zat_2_param']+$user['run_2_param']).'<br>'.$icon_name_2.'<br><br>';
echo '<center><a href="?runs&item=2" class="but">Купить руну</a>';
echo '</div>';
}else{
echo '<div class="text"><div class="oh"><img src="/icons/item/0/1.png" width="35" height="35"></div> Наплечник<br><a href="/shop.php?snar2"><u>Купить вещь</u></a></div>';
}
if($user['snar_3'] >= 1){
echo '<div class="text"><div class="oh"><img src="/icons/item/'.$user['snar_3'].'/3.png" width="50" height="50"></div> '.$user['item_3_text'].' <font color="lime">+ '.$user['zat_3'].'</font><br><img src="/icons/str.png" width="16" height="16">'.($user['item_3_str']+$user['zat_3_param']+$user['run_3_param']).' <img src="/icons/def.png" width="16" height="16">'.($user['item_3_def']+$user['zat_3_param']+$user['run_3_param']).' <img src="/icons/health.png" width="16" height="16">'.($user['item_3_health']+$user['zat_3_param']+$user['run_3_param']).'<br>'.$icon_name_3.'<br><br>';
echo '<center><a href="?runs&item=3" class="but">Купить руну</a></center>';
echo '</div>';
}else{
echo '<div class="text"><div class="oh"><img src="/icons/item/0/1.png" width="35" height="35"></div> Броня<br><a href="/shop.php?snar3"><u>Купить вещь</u></a></div>';
}
if($user['snar_4'] >= 1){
echo '<div class="text"><div class="oh"><img src="/icons/item/'.$user['snar_4'].'/4.png" width="50" height="50"></div> '.$user['item_4_text'].' <font color="lime">+ '.$user['zat_4'].'</font><br><img src="/icons/str.png" width="16" height="16">'.($user['item_4_str']+$user['zat_4_param']+$user['run_4_param']).' <img src="/icons/def.png" width="16" height="16">'.($user['item_4_def']+$user['zat_4_param']+$user['run_4_param']).' <img src="/icons/health.png" width="16" height="16">'.($user['item_4_health']+$user['zat_4_param']+$user['run_4_param']).'<br>'.$icon_name_4.'<br><br>';
echo '<center><a href="?runs&item=4" class="but">Купить руну</a></center>';
echo '</div>';
}else{
echo '<div class="text"><div class="oh"><img src="/icons/item/0/1.png" width="35" height="35"></div> Оружие<br><a href="/shop.php?snar4"><u>Купить вещь</u></a></div>';
}
if($user['snar_5'] >= 1){
echo '<div class="text"><div class="oh"><img src="/icons/item/'.$user['snar_5'].'/5.png" width="50" height="50"></div> '.$user['item_5_text'].' <font color="lime">+ '.$user['zat_5'].'</font><br><img src="/icons/str.png" width="16" height="16">'.($user['item_5_str']+$user['zat_5_param']+$user['run_5_param']).' <img src="/icons/def.png" width="16" height="16">'.($user['item_5_def']+$user['zat_5_param']+$user['run_5_param']).' <img src="/icons/health.png" width="16" height="16">'.($user['item_5_health']+$user['zat_5_param']+$user['run_5_param']).'<br>'.$icon_name_5.'<br><br>';
echo '<center><a href="?runs&item=5" class="but">Купить руну</a></center>';
echo '</div>';
}else{
echo '<div class="text"><div class="oh"><img src="/icons/item/0/1.png" width="35" height="35"></div> Штаны<br><a href="/shop.php?snar5"><u>Купить вещь</u></a></div>';
}
if($user['snar_6'] >= 1){
echo '<div class="text"><div class="oh"><img src="/icons/item/'.$user['snar_6'].'/6.png" width="50" height="50"></div> '.$user['item_6_text'].' <font color="lime">+ '.$user['zat_6'].'</font><br><img src="/icons/str.png" width="16" height="16">'.($user['item_6_str']+$user['zat_6_param']+$user['run_6_param']).' <img src="/icons/def.png" width="16" height="16">'.($user['item_6_def']+$user['zat_6_param']+$user['run_6_param']).' <img src="/icons/health.png" width="16" height="16">'.($user['item_6_health']+$user['zat_6_param']+$user['run_6_param']).'<br>'.$icon_name_6.'<br><br>';
echo '<center><a href="?runs&item=6" class="but">Купить руну</a></center>';
echo '</div>';
}else{
echo '<div class="text"><div class="oh"><img src="/icons/item/0/1.png" width="35" height="35"></div> Обувь<br><a href="/shop.php?snar6"><u>Купить вещь</u></a></div>';
}
echo '<a href="/shop.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
?>