<?php
include 'system/func.php';
$title = 'Кампания';
auth();
include 'system/header.php';
include 'my_inc/company/info.php';
if($user['company_id'] >= 5){
echo '<div class="de center"><img src="/icons/company.png" width="16" height="16"> Кампания</div><div class="text center"><font color="lime">Поздравляем, вы прошли все главы кампании!</font></div>';
}else{
echo '<div class="de center"><img src="/icons/company.png" width="16" height="16"> Кампания: глава '.($user['company_id'] + 1).'.<br><img src="/icons/ok.png" width="16" height="16"> Награда: <img src="/icons/gold.png" width="16" height="16">'.$company_gold.', <img src="/icons/silver.png" width="16" height="16">'.$company_silver.', <img src="/icons/exp.png" width="14" height="14"> '.$company_exp.'<br></div>';
include 'my_inc/company/info_company.php';
}
include 'system/footer.php';
?>