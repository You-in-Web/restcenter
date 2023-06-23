
<?php require_once("../data/config.php"); ?> 
<?php
$break_capt = "Временной зазор между текущим часом и последующими возможными заказами, требуемый для переподготовки. Выбранное колличество времени прибавляется к текущему часу сегодняшней даты и становится недоступным для бронирования/заказа. (1 - без перерыва, доступен каждый следующий час. 0 - доступен текущий час.)";
$min_capt = "Ограничить кол-во времени за один заказ (0 - неограничивать).";
$max_capt = "Не разрешать занимать меньше установленного количества времени (0 - не устанавливать).";
$notime_capt = "Установка фиксированной цены, независимо от кол-ва выбранных часов или дней.";
$sep_capt = "Не отмечайте, если оказание услуги должно производиться в порядке очереди. На пример если всеми услугами занимается только один человек и/или задействованно всего одно помещение. Занятое время в других услугах, на те же даты, будет недоступно и в этой.";
?>




<html>
<head>
<title><?php echo $title_com; ?> - панель управления AgBS</title>
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
<div id="main">

<div id="top">

</div>

<div id="main_menu">
<ul class="sf-menu">

<li>
<a href="index.php">Меню</a>				
<ul>
<li><a href="aservices.php">Услуги</a></li>
<li><a href="back.php?orders=actual">Заказы</a></li>
<li><a href="rasp.php">Расписание</a></li>
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

Добро пожаловать! 
<span class="t_date" title="дата на сервере">Сегодня: <?php echo date('d.m.Y');?> (<?php echo $days[$tw];?>)</span>
<a href="logout.php" >Выход</a> </div>
</div>
<div class="top">&#160;</div>