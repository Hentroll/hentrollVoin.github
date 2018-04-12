<?
include '../system/func.php';
$title = 'Купить золото';
include '../system/header.php';
include 'sett.php';
?>
<?
echo '<div class="de center">'.$title.'</div>';
if(isset($_GET['gold']))
{
$gold = intval($_GET['gold']);
if (isset($wk_cena_gold[$gold]))
{?>
<form method="POST" action="https://wapkassa.ru/merchant/oplata.php">
<input type="hidden" name="WK_PAYMENT_SITE" value="<?=wk_id?>">
<input type="hidden" name="WK_PAYMENT_AMOUNT" value="<?=wk_summ($wk_cena_gold[$gold])?>">
<input type="hidden" name="WK_PAYMENT_COMM" value="Покупка золота ID <?=$user['id']?>">
<input type="hidden" name="WK_PAYMENT_HASH" value="<?=strtoupper(hash("sha256",wk_id.wk_summ($wk_cena_gold[$gold]).wk_code))?>">
<input type="hidden" name="WK_PAYMENT_USER" value="<?=$user['id']?>">
<input type="hidden" name="WK_PAYMENT_TOVAR" value="gold">
<input type="hidden" name="WK_PAYMENT_COUNT" value="<?=$gold?>">
<?
echo "<div class='text'> <img src='/icons/gold.png' width='16' height='16'> Купить $gold золота<br><img src='/icons/gold.png' width='16' height='16'> Бонус: ".($gold*25/100)." золота<br><img src='/icons/rub.png' width='15' height='15'> Цена: ".($gold*10/100)."р<hr>";
?>
<center><input type="submit" value="Перейти к оплате"></center>
</form></div>
<?
echo "<a href='?' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
include '../system/footer.php';
exit;
}
}
echo "<div class='text'><div class='oh'><img src='/icons/gold/gold-sx.png' width='50' height='50'></div> <img src='/icons/gold.png' width='16' height='16'> Купить 100 золота<br><img src='/icons/gold.png' width='16' height='16'> Бонус: ".(100*25/100)." золота<br><img src='/icons/rub.png' width='15' height='15'> Цена: ".(100*10/100)."р<hr><center><a href='/paywk/?gold=100' class='but'>Приобрести</a></center></div>";
echo "<div class='text'><div class='oh'><img src='/icons/gold/gold-s.png' width='50' height='50'></div> <img src='/icons/gold.png' width='16' height='16'> Купить 500 золота<br><img src='/icons/gold.png' width='16' height='16'> Бонус: ".(500*25/100)." золота<br><img src='/icons/rub.png' width='15' height='15'> Цена: ".(500*10/100)."р<hr><center><a href='/paywk/?gold=500' class='but'>Приобрести</a></center></div>";
echo "<div class='text'><div class='oh'><img src='/icons/gold/gold-m.png' width='50' height='50'></div> <img src='/icons/gold.png' width='16' height='16'> Купить 1000 золота<br><img src='/icons/gold.png' width='16' height='16'> Бонус: ".(1000*25/100)." золота<br><img src='/icons/rub.png' width='15' height='15'> Цена: ".(1000*10/100)."р<hr><center><a href='/paywk/?gold=1000' class='but'>Приобрести</a></center></div>";
echo "<div class='text'><div class='oh'><img src='/icons/gold/gold-l.png' width='50' height='50'></div><img src='/icons/gold.png' width='16' height='16'> Купить 5000 золота<br><img src='/icons/gold.png' width='16' height='16'> Бонус: ".(5000*25/100)." золота<br><img src='/icons/rub.png' width='15' height='15'> Цена: ".(5000*10/100)."р<hr><center><a href='/paywk/?gold=5000' class='but'>Приобрести</a></center></div>";
echo "<div class='text'><div class='oh'><img src='/icons/gold/gold-xl.png' width='50' height='50'></div> <img src='/icons/gold.png' width='16' height='16'> Купить 10000 золота<br><img src='/icons/gold.png' width='16' height='16'> Бонус: ".(10000*25/100)." золота<br><img src='/icons/rub.png' width='15' height='15'> Цена: ".(10000*10/100)."р<hr><center><a href='/paywk/?gold=10000' class='but'>Приобрести</a></center></div>";

include '../system/footer.php';
?>