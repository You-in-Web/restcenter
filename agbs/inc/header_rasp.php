<?php 
error_reporting(0);
require_once("data/config.php"); ?> 
<?php
if ($formul == "1") {
$form_1 = 'Забронировать';
$form_2 = 'бронирование';
$form_3 = 'бронирования';
$form_4 = 'забронировано';
$form_5 = 'Забронированое';
} else {
$form_1 = 'Заказать';
$form_2 = 'заказ';
$form_3 = 'заказов';
$form_4 = 'заказано';
$form_5 = 'Заказаное';
}
?>
<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=0.7, user-scalable=no" /> -->
<meta name="robots" content="noindex, nofollow"/>

<title><?php echo $title_com; ?> :: онлайн <?php echo $form_2; ?></title>




<?php  if ($style == '0') { ?>
<link rel="stylesheet" type="text/css" href="style_iframe/main.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_iframe/calendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_iframe/steps.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_iframe/title.css" />
<link rel="stylesheet" type="text/css" href="style_iframe/rasp.css" />
<link rel="stylesheet" href="style_iframe/tooltips.css" type="text/css" media="screen" charset="utf-8" />
<?php } ?>


<?php if ($style == '3') { ?>
<link rel="stylesheet" type="text/css" href="style_albus/main.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_albus/calendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_albus/steps.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_albus/title.css" />
<link rel="stylesheet" type="text/css" href="style_albus/rasp.css" />
<link rel="stylesheet" href="style_albus/tooltips.css" type="text/css" media="screen" charset="utf-8" />
<?php } ?>

<?php if ($style == '2') { ?>
<link rel="stylesheet" type="text/css" href="style_nigrum/main.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_nigrum/calendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_nigrum/steps.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_nigrum/title.css" />
<link rel="stylesheet" type="text/css" href="style_nigrum/rasp.css" />
<link rel="stylesheet" href="style_nigrum/tooltips.css" type="text/css" media="screen" charset="utf-8" />
<?php } ?>

<?php if ($style == '1') { ?>
<link rel="stylesheet" type="text/css" href="style_argentum/main.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_argentum/calendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_argentum/steps.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style_argentum/title.css" />
<link rel="stylesheet" type="text/css" href="style_argentum/rasp.css" />
<link rel="stylesheet" href="style_argentum/tooltips.css" type="text/css" media="screen" charset="utf-8" />
<?php } ?>


<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/title.js"></script>




<!--[if IE]>
	<script type="text/javascript" src="js/css3-multi-column.js"></script>
	<![endif]-->

	
<!-- custom color -->
<?php if (!empty($color)) {



function hex2rgb($hex)
{
    return array(
            hexdec(substr($hex,1,2)),
            hexdec(substr($hex,3,2)),
            hexdec(substr($hex,5,2))
        );
}
$rgbc = hex2rgb($color);




$percentageChange = 23;

//светлее 
$light = Array(
255-(255-$rgbc[0]) + $percentageChange,
255-(255-$rgbc[1]) + $percentageChange,
255-(255-$rgbc[2]) + $percentageChange
);

//темнее			
$dark = Array(
$rgbc[0] - $percentageChange,
$rgbc[1] - $percentageChange,
$rgbc[2] - $percentageChange
);
			
$lightc = $light[0].','.$light[1].','.$light[2];

$darkc = $dark[0].','.$dark[1].','.$dark[2];	 
	 
 ?>
<style type="text/css">

a, a:visited { color: rgba(<?php echo $darkc; ?>,1); }

input[type="submit"] { 
background:<?php echo $color ?>!important; 
background: -moz-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -ms-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -o-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -webkit-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
}
input[type="submit"]:hover {
background:<?php echo $color ?>!important;
box-shadow: inset 0px 5px 50px rgba(0,0,0,0.16)!important;
}

#time li:hover { background: rgba(<?php echo $lightc; ?>,1)!important; }

#time li.add_time {list-style-image: url(style_rh/img/ok_time.png); color:#fff; background:<?php echo $color ?>!important;}

a.button_h {
text-shadow:none;
background:<?php echo $color ?>!important; 
background: -moz-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -ms-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -o-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -webkit-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
}
a.button_h:hover { background:<?php echo $color ?>!important; text-shadow:none;}



.select_date:hover { background: rgba(<?php echo $lightc; ?>,1)!important; }
.select_date a:hover { background: rgba(<?php echo $lightc; ?>,1)!important; }

.month_next a, .month_back a { color: rgba(<?php echo $lightc; ?>,1)!important;}

.month_back a:hover { 
background:<?php echo $color ?>!important; 
background: -moz-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -ms-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -o-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -webkit-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
color:#fff!important;}

.month_next a:hover { 
background:<?php echo $color ?>!important; 
background: -moz-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -ms-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -o-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -webkit-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
color:#fff!important;}

.add_date {background: <?php echo $color ?> url(style_rh/img/check_d.png) no-repeat center; color:#fff!important; }

.caltoday { background: rgba(<?php echo $lightc; ?>,0.3)!important;}
.caltoday a{ background: rgba(<?php echo $lightc; ?>,0.3)!important;}

.caption_order { color: rgba(<?php echo $darkc; ?>,1)!important; }

#total_price { color: rgba(<?php echo $darkc; ?>,1)!important; }

#timer_inp { color: rgba(<?php echo $darkc; ?>,1)!important; }

a.button { color: rgba(<?php echo $darkc; ?>,1)!important; }

a.button:hover { background:<?php echo $color ?>!important; }


.desc_service span { color: rgba(<?php echo $darkc; ?>,1)!important; }

#select_service h3:hover { color: rgba(<?php echo $darkc; ?>,1)!important; }


#steps span.point_active { color: rgba(<?php echo $darkc; ?>,1)!important; }

#calendar_rasp table td div.r_time_b { background:<?php echo $color ?>; }

#calendar_rasp table td div.r_time_db {color: rgba(<?php echo $lightc; ?>,1);}

#r_time_db_l {color:#838C97!important;}

#calendar_rasp table td div#r_time_bl {background:#777;}
</style>
<?php } ?>
<!-- //custom color -->

	
</head>

<body onload="count_checkboxes()">

<div id="title_top">

<div class="title">
<span class="n_com"><a href="/"><?php echo $title_com; ?></a></span>

<span class="desct">расписание</span>

<a href="index.php" style="float:right;" class="button_h">Услуги</a>
</div>

</div>


<div id="main" align="center">
<div id="content">
<div style="height:20px;">&#160;</div>