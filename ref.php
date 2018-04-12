<?php
require_once ('system/func.php');
$title = 'Пригласить друга';
require_once ('system/header.php');
auth(); // Закроем от гостей
$sql = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$myID."' LIMIT 1"));
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id_partner` = '$sql[id]'"),0);
echo "<div class='de center'>Пригласить друга</div>";
echo "<div class='text'>";
echo '<center>Чтобы пригласить друга в игру и получить бонус, поделись с ним этой ссылкой: <br><input class="center" type="text" name="" maxlength="50" value="http://mleg.mobi/?ref='.$myID.'" /><br/><hr>Каждый раз, когда приглашенные тобой друзья будут покупать золото в игре, ты будешь получать 25% от купленного ими золота совершенно бесплатно!<hr>Пригласили друзей: '.$k_post.'</center>';
echo "</div>";

echo '<a href="/about" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
require_once ('system/footer.php');
?>