<?php
auth();
$item = rand(1,5);
$param = array(1=>''.($user['str'] + 1).'',2=>''.($user['str'] + 5).'',3=>''.($user['str'] + 7).'',4=>''.($user['str'] + 9).'',5=>''.($user['str'] + 12).'');
$sex = array(1=>'m',2=>'w',3=>'m',4=>'w',5=>'m');
$name = array(1=>'Адриан',2=>'Малия',3=>'Джон',4=>'Стэйси',5=>'Эдвард');
?>
<style>
.dummy {
width: auto;
text-align: center;
margin-left: auto;
margin-right: auto;
}
</style>
<? echo '<img src="/icons/'.$sex[$item].'.png"> <font color="tomato">'.$name[$item].'</font><br>';
echo '<img src="/icons/str.png" width="16" height="16">'.$param[$item].' <img src="/icons/def.png" width="16" height="16">'.$param[$item].' <img src="/icons/health.png" width="16" height="16">'.$param[$item].''; ?>
<table class="dummy">
<tr><td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$item.'/1.png" width="40" height="40">'; ?></div></td><td colspan="2" rowspan="4"><?
echo "<img src='/icons/max-".$sex[$item].".png' width='127' height='160'>";
?></td><td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$item.'/4.png" width="40" height="40">'; ?></div></td></tr><tr><td class="1"><div class="slot">
<? echo '<img src="/icons/item/'.$item.'/2.png" width="40" height="40">'; ?></div></td><td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$item.'/5.png" width="40" height="40">'; ?></td></td></tr><tr><td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$item.'/3.png" width="40" height="40">'; ?></div></td>
<td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$item.'/6.png" width="40" height="40">'; ?></div></td></tr><tr><td class="1"><div class="slot"><?  echo '<img src="/icons/item/amulet.png" width="40" height="40">'; ?></div></td>
<td class="1"><div class="slot"><? echo '<img src="/icons/item/ring.png" width="40" height="40">';
?></div></td></tr></table>
<? echo '<hr>'; ?>