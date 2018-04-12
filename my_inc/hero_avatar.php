<?php
auth();
?>
<style>
.dummy {
width: auto;
text-align: center;
margin-left: auto;
margin-right: auto;
}
</style>
<table class="dummy">
<tr><td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$profile['snar_1'].'/1.png" width="40" height="40">'; ?></div></td><td colspan="2" rowspan="4"><?
echo "<img src='/icons/max-".$profile['sex'].".png' width='127' height='160'>";
?></td><td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$profile['snar_4'].'/4.png" width="40" height="40">'; ?></div></td></tr><tr><td class="1"><div class="slot">
<? echo '<img src="/icons/item/'.$profile['snar_2'].'/2.png" width="40" height="40">'; ?></div></td><td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$profile['snar_5'].'/5.png" width="40" height="40">'; ?></td></td></tr><tr><td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$profile['snar_3'].'/3.png" width="40" height="40">'; ?></div></td>
<td class="1"><div class="slot"><? echo '<img src="/icons/item/'.$profile['snar_6'].'/6.png" width="40" height="40">'; ?></div></td></tr><tr><td class="1"><div class="slot"><? if($profile['amulet'] == 0)echo '<img src="/icons/item/0/7.png" width="40" height="40">'; else echo '<img src="/icons/item/amulet.png" width="40" height="40">'; ?></div></td>
<td class="1"><div class="slot"><? if($profile['ring'] == 0)echo '<img src="/icons/item/0/8.png" width="40" height="40">';
else
echo '<img src="/icons/item/ring.png" width="40" height="40">';
?></div></td></tr></table>
<? ?>