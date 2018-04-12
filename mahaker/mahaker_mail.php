<?php
require_once ('../system/func.php');
$title = 'Шпион почты';
auth();
require_once ('../system/header.php');
if($user['access'] <=1){
header('Location: /');
}
echo '<div class="de center">Шпион почты</div>';
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `mail`"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];

$mail = mysql_query("SELECT * FROM `mail` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
while($um= mysql_fetch_assoc($mail)){
echo "<div class='text'>Отправил: <a href='/hero/$um[in]'>[Id: $um[in]]</a><br>Получил: <a href='/hero/$um[out]'>[Id: $um[out]]</a><br>Текст: [<font color='tomato'>$um[text]</font>]</div>";
}
echo '</div>';
if($k_post > 10){
echo '<div class="link center">';
str('?',$k_page,$page); 
echo "</div>";
}
echo '<a href="/mahaker/mahaker_panel.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
require_once ('../system/footer.php');
exit;
?>