<?
@session_start();
error_reporting(0);
//if (!isset($_SESSION['key'])) { echo "invalid session"; exit(); }

// Помещаем содержимое файла в массив  
$access = array();  
$access = file("../data/access.php");  
// Разносим значения по переменным – пропуская первую строку файла - 0  
$login = trim($access[1]);  
$passw = trim($access[2]);  
// Проверям были ли посланы данные  
if(!empty($_POST['enter']))  
{  
        $_SESSION['login'] = $_POST['login'];  
        $_SESSION['passw'] = $_POST['passw'];  
$ERROR["login"]["text"] = "<span class=\"error\">Не верный логин.</span>";
$ERROR["passw"]["text"] = "<span class=\"error\">Не верный пароль.</span>";
}
		

// Если ввода не было, или они не верны  
// просим их ввести  
if(empty($_SESSION['login']) or  
   $login != $_SESSION['login'] or  
   $passw != $_SESSION['passw']    )  

{  
?>  
<?php require_once("../data/config.php"); ?> 
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $title_com; ?> - Вход в панель управления AgBS</title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="stylesheet" type="text/css" href="admin.css" media="screen" />

</head>

<body>



<div id="main">
<br /><br />
<div id="b_table_login">
<table>
     <form action=index.php method=post> 
     <tr><th colspan="2"><strong><?php echo $title_com; ?></strong> <br /> AgBS</th></tr>	 
     <tr><td>Логин:</td> <td align="center"><input type="text" class=input name=login value=""></td></tr>  
     <tr><td>Пароль:</td> <td align="center"><input type="password" class=input name=passw value=""></td></tr>  
     <input type=hidden name=enter value=yes>  
     <tr><td colspan="2" align="center"><input class=button type=submit value="Вход"></td></tr>
</table>
</div>	 


<?php 

if($login != $_SESSION['login']) {
echo "<br /><center>".$ERROR["login"]["text"]."</center>";
} else {echo"";}


if($passw != $_SESSION['passw']) {
echo "<br /><center>".$ERROR["passw"]["text"]."</center>";
} else {echo"";}

?>


</div>
</body>
</html>
   <?php  
   die;  
} 
?>
<?php require_once("../data/config.php"); ?> 

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $title_com; ?> - панель управления AgBS</title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="stylesheet" type="text/css" href="admin.css" media="screen" />
<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="../js/hoverIntent.js"></script>
		<script type="text/javascript" src="../js/superfish.js"></script>
		<script type="text/javascript">
		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
		</script>
</head>

<body>
<div id="main">

<div id="top">

</div>

<div id="main_menu">
<ul class="sf-menu">

<li>
<a href="index.php">Меню</a>				
<ul>
<li><a href="aservices.php">Услуги</a></li>
<li><a href="back.php">Заказы</a></li>
<li><a href="settings.php">Настройки</a></li>
</ul>				
</li>

</ul>

<div class="title_top"><img src="img/title_top.png" width="40" height="40" border="0" alt="" align="left" /><span>AgBS</span> <span class="n_com"><?php echo $title_com; ?></span>
<?php
$days = array(
'Sunday' => 'воскресение', 
'Monday' => 'понедельник', 
'Tuesday' => 'вторник', 
'Wednesday' => 'среда', 
'Thursday' => 'четверг', 
'Friday' => 'пятница', 
'Saturday' => 'суббота'); 
$tw = date("l");
 ?>

</div>
<div id="helo">

Добро пожаловать <? echo "$login"; ?>! 
<span class="t_date" title="дата на сервере">Сегодня: <?php echo date('d.m.Y');?> (<?php echo $days[$tw];?>)</span>
<a href="logout.php" >Выход</a> </div>
</div>
<div class="top">&#160;</div>