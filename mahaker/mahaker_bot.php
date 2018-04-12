<?
require_once ('../system/func.php');
auth();
$title = 'Создание ботов';
require_once ('../system/header.php');
//логин
$rand = rand(100000,999999);
//
$login = 'Легенда_'.$rand.'';
$level = rand(1,3);
$param_ot = 30;
$param_do = 40;
$sex = 'unk';
$pass = rand(11111,99999);
if(isset($_GET['go'])){
mysql_query('INSERT INTO `users` SET `login` = "'.$login.'", `level` = "'.$level.'", `bot` = "1", `sex` = "'.$sex.'", `str` = "'.rand($param_ot,$param_do).'", `def` = "'.rand($param_ot,$param_do).'", `max_health` = "'.rand($param_ot,$param_do).'", `online` = "'.(time()+86400*365).'", `registr` = "'.time().'"');
$_SESSION['msg'] = "Создаем игроков, если что останови. ))";
header('Location: ?go#'.$r.'');
}
echo "<div class='de center'>".$title."</div>";
echo "<div class='text center'>Скрипт автоматического создания ботов для игры, все что от вас нужно, нажать кнопку.<hr>";
echo "<a href='?go' class='but'>Создавать ботов</a><hr>";
echo '<a href="?">Остановить</a>';
echo "</div>";
echo "<a href='/mahaker/mahaker_panel.php' class='link'><img src='/icons/back.png' width='16' height='16'> Вернуться назад</a>";
require_once ('../system/footer.php');
?>