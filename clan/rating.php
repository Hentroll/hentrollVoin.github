<?php
include '../system/func.php';  
$title = 'Рейтинг кланов';
include '../system/header.php'; 
auth();
$i = null;
$myclan = null;
$set['p_str'] = 10;
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `clans`"),0); 
$k_page = k_page($k_post,$set['p_str']); 
$page = page($k_page); 
$start = $set['p_str']*$page-$set['p_str']; 
$q = mysql_query("SELECT * FROM `clans` ORDER BY `level` DESC, `exp` DESC LIMIT $start, $set[p_str]"); 
echo "<table style='width:100%;'><tr><td style='width: 50%;' class='center'><a href='/rating.php?#".$r."' class='des'><font color='silver'>Рейтинг игроков</font></a></td> <td style='width: 50%;' class='center'><a href='/clan/rating.php?".$r."' class='des'><font color='silver'>Рейтинг кланов</font></a></td></tr></table></div>";
echo '<div class="de">';
while($post = mysql_fetch_assoc($q)) { 
$i++; 
echo"<div class='text'>";
echo "<font color='silver'>".($i+$start)."</font>. <a href='/clan/index.php?id=$post[id]'>$post[name]</a><br><img src='/icons/level.png' width='14' height='14'> Уровень: $post[level]<br> <img src='/icons/exp.png' width='14' height='14'> Опыт: ".n_f($post['exp']);
echo"</div>";
}
echo '</div>';
if($k_post > 10){ 
echo "<div class='de center'>"; 
str('?',$k_page,$page); 
echo "</div>";
}
include '../system/footer.php'; 
?>