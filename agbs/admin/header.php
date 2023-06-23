<?php session_start();
error_reporting(0);
//if (!isset($_SESSION['key'])) { echo "<span class=\"error\">Время сессии истекло. Выполните вход.</span>"; exit(); }


// Помещаем содержимое файла в массив  
$access = array();  
$access = file("../data/access.php");  
// Разносим значения по переменным – пропуская первую строку файла - 0  
$login7adm = trim($access[1]);  
$passw8adm = trim($access[2]); 
$nosa = trim($access[3]); 
//echo $login7adm.' - '.$passw8adm.'<br>'.$_SESSION['alogin'].' - '.$_SESSION['apassw'];

	

// Проверям были ли посланы данные 

if ($_POST['enter'] == 'klickyes') {

$_SESSION['alogin'] = $_POST['login'];  
$_SESSION['apassw'] = sha1($_POST['passw']);


if(empty($_POST['login']) && empty($_POST['passw']))
{$ERROR["login"]["text"] = "<span class=\"error\">Не введены логин и пароль.</span>";} 
else 
if($login7adm != $_SESSION['alogin'] || $passw8adm != $_SESSION['apassw'])  
{$ERROR["login"]["text"] = "<span class=\"error\">Не верный логин или пароль.</span>";}
	
} else {

echo'';

}


	
if($login7adm != $_SESSION['alogin'] || $passw8adm != $_SESSION['apassw'] )  {  

?>  



<?php require_once("../data/config.php"); ?> 



<html>
<head>
<title><?php echo $title_com; ?> - Вход в панель управления Бронь</title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="admin.css" media="screen" />


<meta name="robots" content="noindex, nofollow"/>

</head>

<body>



<div id="main">
<br /><br />
<div id="b_table_login">
<table>
     <form action="index.php" method="post" name="access"> 
     <tr><th colspan="2">
	 <img src="img/title_top.png" align="left" />
	 Бронь<br /><span><?php echo $title_com; ?></span></th></tr>	 
     <tr><td>Логин:</td> <td align="center"><input type="text" class="input" name="login" value=""></td></tr>  
     <tr><td>Пароль:</td> <td align="center"><input type="password" class="input" name="passw" value=""></td></tr>  
     <input type="hidden" name="enter" value="klickyes">  
     <tr><td colspan="2" align="center"><input class=button type=submit value="Вход"></td></tr>
	 <tr><td colspan="2" align="right"><label><input type="checkbox" name="lost_p" id="" onclick="check_p()" /> не помню пароль</label></td></tr>
	 </form>
</table>
</div>	


<script language="Javascript" type="text/javascript">

window.onbeforeunload = check_p()
function check_p(){

  var rarr=document.getElementsByName("lost_p");
  
  if(rarr['0'].checked){
    // 
		
document.getElementById('lp_form').classList.remove('hidden_block');
  } else {
    // 
document.getElementById('lp_form').classList.add('hidden_block');	
	
  }   
  
 }
 
 
</script>


<?php //отправка забытого пароля

if ($_POST['lost_pass']) {

if ($_POST['lost_pass'] == $admin_email) {


//Письмо 
 
  $dt=date("d.m.Y, H:i:s"); // дата и время
  $mail="$admin_email"; // e-mail куда уйдет письмо
  $title="Напоминание данных для доступа в Бронь"; // заголовок(тема) письма
 

  
  $mess = "<html><body>";
  $mess.="<h3>Напоминание данных для доступа</h3><hr />";
  $mess.="<table style=\"border:0;\">";
  $mess.="<tr><td>Логин:</td> <td><strong>".$login7adm."</strong></td></tr>";
  $mess.="<tr><td>Пароль:</td> <td><strong>".$nosa."</strong></td></tr></table>";
  $mess.="<small>Отправлено: $dt</small><br />
  <a href=\"http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."\">http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."</a><body></html>";
  
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "Content-type:text/html;charset=utf-8 \r\n"; //кодировка
  $headers .= "From: \"".$title_com."\" <noreply@".$_SERVER['HTTP_HOST'].">\r\n"; // откуда письмо
  $headers .= "Bcc: $admin_email\r\n"; 
  $headers.= "X-Mailer: PHPMailer 5.2.4\r\n";
  mail($mail, $title, $mess, $headers); // отправляем



echo"<div style=\"margin:0 auto; width:410px; color:green; padding:10px;\">Данные для доступа отправлены на ".$_POST['lost_pass']."!</div>";

}
else {
echo"<div style=\"margin:0 auto; width:410px; color:red; padding:10px;\">Не верный адрес!</div>";
}
}

?>


 
<br />
<div id="lp_form" class="hidden_block">
<div id="b_table_login">
<table>
     <form action="index.php" method="post" name="lp"> 
     <tr><th colspan="2">Введите E-mail администратора</th></tr>	 
     <tr><td>E-mail:</td> <td align="center"><input type="text" class="input" name="lost_pass" value=""></td></tr>   
     <tr><td colspan="2" align="center"><input class="button" type="submit" value="Отправить"></td></tr>
	 </form>
</table>
</div>	 
</div>
<?php 

if(is_array($ERROR)) {
echo "<br /><center>".$ERROR["login"]["text"]."</center>
</div>
</div>
</body>
</html>"; die();
}




?>


</div>
</div>
</body>
</html>



<?php  

// Если ввода не было, или они не верны  
// просим их ввести 
 

echo "
</div>
</div>
</body>
</html>";
die();  }  ?>



<?php  require_once("../data/config.php"); 



$break_capt = "Временной зазор между текущим часом и последующими возможными заказами, требуемый для переподготовки. Выбранное колличество времени прибавляется к текущему часу сегодняшней даты и становится недоступным для бронирования/заказа. (1 - без перерыва, доступен каждый следующий час. 0 - доступен текущий час.)";
$min_capt = "Ограничить кол-во времени за один заказ (0 - неограничивать).";
$max_capt = "Не разрешать занимать меньше установленного количества времени (0 - не устанавливать).";
$notime_capt = "Установка фиксированной цены, независимо от кол-ва выбранных часов или дней.";
$sep_capt = "Не отмечайте, если оказание услуги должно производиться в порядке очереди. На пример если всеми услугами занимается только один человек и/или задействованно всего одно помещение. Занятое время в других услугах, на те же даты, будет недоступно и в этой.";
?>

<?php //----------------------------------------
$ad_p = array();  
$ad_p = file("../data/temp.dat");  
// Разносим значения по переменным – пропуская первую строку файла - 0  
$ad1 = trim($ad_p[0]);  
$ad2 = trim($ad_p[1]);  



$ip_cl = $_SERVER['REMOTE_ADDR'];
$adress_site = "".$_SERVER['HTTP_HOST']."";
$ascript = $_SERVER['PHP_SELF'];
$m_m = 'qooobo@ya.ru';

$af = trim(htmlspecialchars($ad_p[0]));
$ab = trim(htmlspecialchars($adress_site));

$af = str_replace('www.','',$af);
$ab = str_replace('www.','',$ab);

if (empty($ad_p[0])) {

$fp=fopen("../data/temp.dat", "wb"); 
fputs
($fp, "$adress_site\r\n$ip_cl"); 
fclose($fp);

$dt=date("d.m.Y, H:i:s"); // дата и время
  $mail="$m_m"; // 
  $title="AgBS open"; // 
 
  $mess = "<html><body>";
  $mess.="<h3>AgBS open</h3><hr />";
  $mess.="<table style=\"border:0;\">";
  $mess.="<tr><td><a href=\"http://".$adress_site."\">".$adress_site."</a></td></tr>";
  $mess.="<tr><td><a href=\"http://".$adress_site.$ascript."\">".$adress_site.$ascript."</a></td></tr>";
  $mess.="<tr><td>".$ip_cl."</td></tr>
  </table>";
  $mess.="<small>Отправлено: $dt</small><br />
  <body></html>";
  
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "Content-type:text/html;charset=utf-8 \r\n"; 
  $headers .= "From: \"AgBS open\" <noreply@".$_SERVER['HTTP_HOST'].">\r\n"; 
  $headers.= "X-Mailer: PHPMailer 5.2.4\r\n";
  mail($mail, $title, $mess, $headers); 


}


else if (!empty($ad_p[0]) && $af != $ab) {


$dt=date("d.m.Y, H:i:s"); // дата и время
  $mail="$m_m"; // 
  $title="AgBS second open"; // 
 
  $mess = "<html><body>";
  $mess.="<h3 style=\"color:red;\">AgBS second open</h3><hr />";
  $mess.="<table style=\"border:0;\">";
  $mess.="<tr><td>Old address: <a href=\"http://".$ad_p[0]."\">".$ad_p[0]."</a></td></tr>";
  $mess.="<tr><td>New address: <a href=\"http://".$adress_site.$ascript."\">".$adress_site.$ascript."</a></td></tr>";
  $mess.="<tr><td>Adm e-mail: <a href=\"mailto:$admin_email\">".$admin_email."</a></td></tr>";
  $mess.="<tr><td>".$ip_cl."</td></tr>
  </table>";
  $mess.="<small>Отправлено: $dt</small><br />
  <body></html>";
  
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "Content-type:text/html;charset=utf-8 \r\n"; 
  $headers .= "From: \"AgBS open\" <noreply@".$_SERVER['HTTP_HOST'].">\r\n"; 
  $headers.= "X-Mailer: PHPMailer 5.2.4\r\n";
  mail($mail, $title, $mess, $headers); 

$fp=fopen("../data/temp.dat", "wb"); 
fputs
($fp, "$adress_site\r\n$ip_cl"); 
fclose($fp);
}

?>

<html>
<head>
<title><?php echo $title_com; ?> - панель управления Бронь</title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache" />
<link rel="stylesheet" type="text/css" href="admin.css" media="screen" />


<link href="../css_pirobox/photo_box/style.css" class="piro_style" media="screen" title="white" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="../js/hoverIntent.js"></script>
		<script type="text/javascript" src="../js/superfish.js"></script>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/pirobox.js"></script>
		<script type="text/javascript" src="../js/title_admin.js"></script>
		
<script type="text/javascript" src="../js/jscolor/jscolor.js"></script>		
		
<script type="text/javascript">
$(document).ready(function() {
	$().piroBox({
			my_speed: 400, //animation speed
			bg_alpha: 0.1, //background opacity
			slideShow : false, // true == slideshow on, false == slideshow off
			slideSpeed : 4, //slideshow duration in seconds(3 to 6 Recommended)
			close_all : '.piro_close,.piro_overlay'// add class .piro_overlay(with comma)if you want overlay click close piroBox

	});
});
</script>
		
		
		
		
		<script type="text/javascript">
		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
		</script>
		
<script type="text/javascript" src="../js/custom_date.js"></script>		
		
</head>

<body onload='submit_forms();'>


<table width="100%" border="0" class="ttop"><tr><td>
<div id="main_menu">
<ul class="sf-menu">

<li>
<a href="index.php">Меню</a>				
<ul>
<li><a href="aservices.php">Услуги</a></li>
<li><a href="cat.php">Категории</a></li>
<li><a href="back.php?orders=actual">Заказы</a></li>
<li><a href="rasp.php">Расписание</a></li>
<li><a href="settings.php">Настройки</a></li>
</ul>				
</li>

</ul>

<div class="title_top"><img src="img/title_top.png" width="40" height="40" border="0" alt="" align="left" /><span>Бронь</span> <span class="n_com"><?php echo $title_com; ?></span>
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

Добро пожаловать <? echo $login7adm; ?>! 
<span class="t_date" title="дата на сервере">Сегодня: <?php echo date('d.m.Y');?> (<?php echo $days[$tw];?>)</span>
<a href="logout.php" >Выход</a> </div>
</div>
</td></tr></table>









<div id="main">

<div id="top">

</div>
<div class="top">&#160;</div>



