<?php
require_once ('../system/func.php');
$title = 'Рейтинг';
require_once ('../system/header.php');
auth();
if($user['save'] <= 1){
header("Location: /home.php?error");
}
$i = null;
$a = null;
$set['p_str'] = 10;
$k_post = 10;
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `users` WHERE `id` > '0' ORDER BY `fb_heard` DESC, `online` DESC LIMIT $start, $set[p_str]");
echo "<div class='de center'><img src='/icons/14february/heard.png'> Рейтинг</div>";
echo "<div class='de'>";
while($post = mysql_fetch_assoc($q)) {
$i++;
if($i < 11){
echo "<a href='/hero/$post[id]#".$r."' class='link'><font color='silver'>".($i+$start).".</font> <img src='/icons/".$post['sex'].".png'> $post[login], $post[level] ур.<br>";
echo "<img src='/icons/14february/heard.png'> <font color='silver'>Сердец:  ".($post['fb_heard'])."</font></a>";
}
}
echo '</div>';
echo '<a href="/14february/index.php" class="link"><img src="/icons/back.png" width="16" height="16"> Вернуться назад</a>';
require_once ('../system/footer.php');
?>