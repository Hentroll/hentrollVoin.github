<?php
auth();
//имена боссов
if($user['adven'] == 0){
$names = 'Лягушка';
}
elseif($user['adven'] == 1){
$names = 'Старый пес';
}
elseif($user['adven'] == 2){
$names = 'Крыса';
}
elseif($user['adven'] == 3){
$names = 'Ядовитый паук';
}
elseif($user['adven'] == 4){
$names = 'Черный кот';
}
elseif($user['adven'] == 5){
$names = 'Волк';
}
elseif($user['adven'] == 6){
$names = 'Лошадь';
}
elseif($user['adven'] == 7){
$names = 'Овца';
}
elseif($user['adven'] == 8){
$names = 'Медведь';
}
elseif($user['adven'] == 9){
$names = 'Гиена';
}
elseif($user['adven'] == 10){
$names = 'Белый медведь';
}
elseif($user['adven'] == 11){
$names = 'Черепаха';
}
elseif($user['adven'] == 12){
$names = 'Летучая мышь';
}
elseif($user['adven'] == 13){
$names = 'Птица';
}
elseif($user['adven'] >= 14){
$names = 'Призрак';
}
//
//параметры боссов
if($user['adven'] == 0){
$param = ''.($user['str'] - 2).'';
}
elseif($user['adven'] == 1){
$param = ''.($user['str'] - 2).'';
}
elseif($user['adven'] == 2){
$param = ''.($user['str'] - 1).'';
}
elseif($user['adven'] == 3){
$param = ''.($user['str'] - 1).'';
}
elseif($user['adven'] == 4){
$param = ''.($user['str'] + 1).'';
}
elseif($user['adven'] == 5){
$param = ''.($user['str'] + 2).'';
}
elseif($user['adven'] == 6){
$param = ''.($user['str'] + 4).'';
}
elseif($user['adven'] == 7){
$param = ''.($user['str'] + 4).'';
}
elseif($user['adven'] == 8){
$param = ''.($user['str'] + 5).'';
}
elseif($user['adven'] == 9){
$param = ''.($user['str'] + 6).'';
}
elseif($user['adven'] >= 10){
$param = ''.($user['str'] + 6).'';
}
//
//картинки боссов
if($user['adven'] == 0){
$images = '<img src="/icons/mobs/1.jpg" width="40" height="40">';
}
elseif($user['adven'] == 1){
$images = '<img src="/icons/mobs/2.jpg" width="40" height="40">';
}
elseif($user['adven'] == 2){
$images = '<img src="/icons/mobs/3.jpg" width="40" height="40">';
}
elseif($user['adven'] == 3){
$images = '<img src="/icons/mobs/4.jpg" width="40" height="40">';
}
elseif($user['adven'] == 4){
$images = '<img src="/icons/mobs/5.jpg" width="40" height="40">';
}
elseif($user['adven'] == 5){
$images = '<img src="/icons/mobs/6.jpg" width="40" height="40">';
}
elseif($user['adven'] == 6){
$images = '<img src="/icons/mobs/7.jpg" width="40" height="40">';
}
elseif($user['adven'] == 7){
$images = '<img src="/icons/mobs/8.jpg" width="40" height="40">';
}
elseif($user['adven'] == 8){
$images = '<img src="/icons/mobs/9.jpg" width="40" height="40">';
}
elseif($user['adven'] == 9){
$images = '<img src="/icons/mobs/10.jpg" width="40" height="40">';
}
elseif($user['adven'] == 10){
$images = '<img src="/icons/mobs/11.jpg" width="40" height="40">';
}
elseif($user['adven'] == 11){
$images = '<img src="/icons/mobs/12.jpg" width="40" height="40">';
}
elseif($user['adven'] == 12){
$images = '<img src="/icons/mobs/13.jpg" width="40" height="40">';
}elseif($user['adven'] == 13){
$images = '<img src="/icons/mobs/14.jpg" width="40" height="40">';
}elseif($user['adven'] >= 14){
$images = '<img src="/icons/mobs/15.jpg" width="40" height="40">';
}
//
//задания
if($user['adven'] == 0){
if($user['adven_1'] > 9){
$task_1 = '<img src="/icons/ok.png"> Побед: 10  из 10<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 10<br>';
}
if($user['adven_2'] > 9){
$task_2 = '<img src="/icons/ok.png"> Кожа: 10  из 10<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 10<br>';
}
if($user['adven_3'] > 9){
$task_3 = '<img src="/icons/ok.png"> Лапки: 10  из 10<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 10<br>';
}
}
elseif($user['adven'] == 1){
if($user['adven_1'] > 14){
$task_1 = '<img src="/icons/ok.png"> Побед: 15  из 15<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 15<br>';
}
if($user['adven_2'] > 14){
$task_2 = '<img src="/icons/ok.png"> Кожа: 15  из 15<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 15<br>';
}
if($user['adven_3'] > 14){
$task_3 = '<img src="/icons/ok.png"> Лапки: 15  из 15<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 15<br>';
}
}
elseif($user['adven'] == 2){
if($user['adven_1'] > 19){
$task_1 = '<img src="/icons/ok.png"> Побед: 20  из 20<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 20<br>';
}
if($user['adven_2'] > 19){
$task_2 = '<img src="/icons/ok.png"> Кожа: 20  из 20<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 20<br>';
}
if($user['adven_3'] > 19){
$task_3 = '<img src="/icons/ok.png"> Лапки: 20  из 20<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 20<br>';
}
}
elseif($user['adven'] == 3){
if($user['adven_1'] > 24){
$task_1 = '<img src="/icons/ok.png"> Побед: 25  из 25<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 25<br>';
}
if($user['adven_2'] > 24){
$task_2 = '<img src="/icons/ok.png"> Кожа: 25  из 25<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 25<br>';
}
if($user['adven_3'] > 24){
$task_3 = '<img src="/icons/ok.png"> Лапки: 25  из 25<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 25<br>';
}
}
elseif($user['adven'] == 4){
if($user['adven_1'] > 29){
$task_1 = '<img src="/icons/ok.png"> Побед: 30  из 30<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 30<br>';
}
if($user['adven_2'] > 29){
$task_2 = '<img src="/icons/ok.png"> Кожа: 30  из 30<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 30<br>';
}
if($user['adven_3'] > 29){
$task_3 = '<img src="/icons/ok.png"> Лапки: 30  из 30<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 30<br>';
}
}
elseif($user['adven'] == 5){
if($user['adven_1'] > 34){
$task_1 = '<img src="/icons/ok.png"> Побед: 35  из 35<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 35<br>';
}
if($user['adven_2'] > 34){
$task_2 = '<img src="/icons/ok.png"> Кожа: 35  из 35<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 35<br>';
}
if($user['adven_3'] > 34){
$task_3 = '<img src="/icons/ok.png"> Лапки: 35  из 35<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 35<br>';
}
}
elseif($user['adven'] == 6){
if($user['adven_1'] > 39){
$task_1 = '<img src="/icons/ok.png"> Побед: 40  из 40<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 40<br>';
}
if($user['adven_2'] > 39){
$task_2 = '<img src="/icons/ok.png"> Кожа: 40  из 40<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 40<br>';
}
if($user['adven_3'] > 39){
$task_3 = '<img src="/icons/ok.png"> Лапки: 40  из 40<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 40<br>';
}
}
elseif($user['adven'] == 7){
if($user['adven_1'] > 44){
$task_1 = '<img src="/icons/ok.png"> Побед: 45  из 45<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 45<br>';
}
if($user['adven_2'] > 44){
$task_2 = '<img src="/icons/ok.png"> Кожа: 45  из 45<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 45<br>';
}
if($user['adven_3'] > 44){
$task_3 = '<img src="/icons/ok.png"> Лапки: 45  из 45<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 45<br>';
}
}
elseif($user['adven'] == 8){
if($user['adven_1'] > 49){
$task_1 = '<img src="/icons/ok.png"> Побед: 50  из 50<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 50<br>';
}
if($user['adven_2'] > 49){
$task_2 = '<img src="/icons/ok.png"> Кожа: 50  из 50<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 50<br>';
}
if($user['adven_3'] > 49){
$task_3 = '<img src="/icons/ok.png"> Лапки: 50  из 50<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 50<br>';
}
}
elseif($user['adven'] == 9){
if($user['adven_1'] > 54){
$task_1 = '<img src="/icons/ok.png"> Побед: 55  из 55<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 55<br>';
}
if($user['adven_2'] > 54){
$task_2 = '<img src="/icons/ok.png"> Кожа: 55  из 55<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 55<br>';
}
if($user['adven_3'] > 54){
$task_3 = '<img src="/icons/ok.png"> Лапки: 55  из 55<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 55<br>';
}
}
elseif($user['adven'] == 10){
if($user['adven_1'] > 59){
$task_1 = '<img src="/icons/ok.png"> Побед: 60  из 60<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 60<br>';
}
if($user['adven_2'] > 59){
$task_2 = '<img src="/icons/ok.png"> Кожа: 60  из 60<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 60<br>';
}
if($user['adven_3'] > 59){
$task_3 = '<img src="/icons/ok.png"> Лапки: 60  из 60<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 60<br>';
}
}
elseif($user['adven'] == 11){
if($user['adven_1'] > 64){
$task_1 = '<img src="/icons/ok.png"> Побед: 65  из 65<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 65<br>';
}
if($user['adven_2'] > 64){
$task_2 = '<img src="/icons/ok.png"> Кожа: 65  из 65<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 65<br>';
}
if($user['adven_3'] > 64){
$task_3 = '<img src="/icons/ok.png"> Лапки: 65  из 65<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 65<br>';
}
}
elseif($user['adven'] == 12){
if($user['adven_1'] > 69){
$task_1 = '<img src="/icons/ok.png"> Побед: 70  из 70<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 70<br>';
}
if($user['adven_2'] > 69){
$task_2 = '<img src="/icons/ok.png"> Кожа: 70  из 70<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 70<br>';
}
if($user['adven_3'] > 69){
$task_3 = '<img src="/icons/ok.png"> Лапки: 70  из 70<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 70<br>';
}
}
elseif($user['adven'] == 13){
if($user['adven_1'] > 74){
$task_1 = '<img src="/icons/ok.png"> Побед: 75  из 75<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 75<br>';
}
if($user['adven_2'] > 74){
$task_2 = '<img src="/icons/ok.png"> Кожа: 75  из 75<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 75<br>';
}
if($user['adven_3'] > 74){
$task_3 = '<img src="/icons/ok.png"> Лапки: 75  из 75<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 75<br>';
}
}
elseif($user['adven'] == 14){
if($user['adven_1'] > 79){
$task_1 = '<img src="/icons/ok.png"> Побед: 80  из 80<br>';
}else{
$task_1 = '<img src="/icons/red.png"> Побед: '.$user['adven_1'].'  из 80<br>';
}
if($user['adven_2'] > 79){
$task_2 = '<img src="/icons/ok.png"> Кожа: 80  из 80<br>';
}else{
$task_2 = '<img src="/icons/red.png"> Кожа: '.$user['adven_2'].'  из 80<br>';
}
if($user['adven_3'] > 79){
$task_3 = '<img src="/icons/ok.png"> Лапки: 80  из 80<br>';
}else{
$task_3 = '<img src="/icons/red.png"> Лапки: '.$user['adven_3'].'  из 80<br>';
}
}
//
?>