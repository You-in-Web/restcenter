<?php // Argentum WD (AgBS) Feb 2015 
//Вывод интерфейса системы в теле сайта
$agbs_dir = 'agbs'; //============= путь к папке с AgBS 

include ($agbs_dir.'/data/config.php');
?>






<!-- SERVICES -->
<meta charset="utf-8" />
<link rel="stylesheet" href="agbs.css" />


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


a.bookgo span {
text-shadow:none;
background:<?php echo $color ?>!important;
background: linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important; 
background: -moz-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -ms-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -o-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
background: -webkit-linear-gradient(rgba(<?php echo $lightc; ?>,1), rgba(<?php echo $darkc; ?>,1))!important;
}
a.bookgo:hover span { background:<?php echo $color ?>!important; text-shadow:none;}


a.booklink h3 {color: rgba(<?php echo $darkc; ?>,1)!important; }
a.booklink:hover h3 {color: rgba(<?php echo $lightc; ?>,1)!important; }

.desc_service span {color: <?php echo $color ?>!important;}
.desc_service span.small_d {color:#000!important;}
</style>
<?php } ?>
<!-- //custom color -->




<div id="s_serv">
<div class="servcont">




<form method="get" action="<?php echo $agbs_dir; ?>/sel_date.php">
<?php
include ($agbs_dir.'/data/config.php');

if ($formul == "1") {
$form_1 = 'Забронировать';
$form_2 = 'бронирование';
$form_3 = 'бронирования';
$form_4 = 'забронировано';
$form_5 = 'Забронированое';
$form_6 = 'брони';
$form_7 = 'забронировать';
$form_8 = 'Забронированые';
$form_9 = 'забронирована';
} else {
$form_1 = 'Заказать';
$form_2 = 'заказ';
$form_3 = 'заказов';
$form_4 = 'заказано';
$form_5 = 'Занятое';
$form_6 = 'заказа';
$form_7 = 'занять';
$form_8 = 'Занятые';
$form_9 = 'заказана';
}


$file_name = "".$agbs_dir."/data/services.dat"; 

$file_cat = "".$agbs_dir."/data/cat.dat";

//определяем константу для имени файла
define('FILENAME_FFRR', $file_name);
// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_FFRR)) {
         echo "Услуг в базе нет!";
} else {
    // если есть, выводим
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 
if (!empty($lines[$a])) {
$data = $lines[$a];
$servise = explode("::", $data);
$strser .= 'a_'.$servise[87].'_z';
}} }



$catfile = fopen($file_cat,"r") ; 
flock($catfile,LOCK_SH) ; 
@$linescat = preg_split("~\r*?\n+\r*?~",fread($catfile,filesize($file_cat))) ;
flock($catfile,LOCK_UN) ; 
fclose($catfile) ; 
$countc = sizeof($linescat); for ($ca = 0 ; $ca < $countc ; ++$ca) {
$catsd = explode("::", $linescat[$ca]); 
$strcatid .= 'a_'.$catsd[0].'_z';



//================================по категориям


if (!empty($linescat[$ca]) && preg_match("/a_".$catsd[0]."_z/i", $strser)) {

echo '<div class="cat_list">';
echo '<div class="titlecat">'.$catsd[1].'</div>'; //название категории

echo '<div class="desccattop">'.$catsd[2].'</div>'; //описание категории

//определяем константу для имени файла
define('FILENAME_CAT_FFRR', $file_name);
// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_CAT_FFRR)) {
         echo "Услуг в базе нет!";
} else {
    // если есть, выводим
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 
if (!empty($lines[$a])) {
$data = $lines[$a];
$servise = explode("::", $data);



$cur = $servise[26];
$currensy = array(
"RUB" => "руб.",
"EUR" => "евро",
"USD" => "долларов");

if($servise[87] == $catsd[0] && $servise[88] != 'no') { //вывод услуг

echo '<div class="cat_list_ser">'; //========Услуги

echo"
<table><tbody>";

if (!$servise[31]) {echo"<tr><td class=\"noph\">";}
else {
$rnd_num = date('dHms');
echo"<tr><td class=\"ftd\">
<div class=\"pict\">
<a href=\"".$agbs_dir."/data/pict/".$servise[31]."?salt=$rnd_num\" rel=\"shadowbox\"><img src=\"".$agbs_dir."/data/pict/small_".$servise[31]."?salt=$rnd_num\" alt=\"".$servise[0]."\" /></a>
</div>";}

echo "<div class=\"desc_service\" style=\"text-align:center;\">"; 
     if ($servise[25] == '-') {echo"<span>цена варьируется</span>";}
else if ($servise[25] == '0' || empty($servise[25])) {echo '<span>бесплатно</span>';} 
else if ($servise[30] == 1 && $servise[34] !=1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">не почасовая оплата</span>";}
else if ($servise[30] == 1 && $servise[34] ==1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">фиксированная цена</span>";}
else if ($servise[34] ==1 && $servise[30] !=1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в сутки</span>";}
else {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в час</span>";}
echo"</div>";


echo "<a href=\"".$agbs_dir."/sel_date.php?select_service=".$servise[32]."\" title=\"$form_1 $servise[0]\" class=\"bookgo\" target=\"_blank\">
$icon_serv<span>$form_1</span></a><div class=\"clear\"></div>";



echo "</td>";

//===название и описание

echo"
<td style=\"width:100%;\">
<!-- <label title=\"Выбрать услугу\">
<input type=\"radio\" name=\"select_service\" value=\"$servise[32]\" onClick=\"submit()\" />
<h3>$servise[0]</h3></label> -->";

echo "
<a href=\"".$agbs_dir."/sel_date.php?select_service=".$servise[32]."\" title=\"$form_1 $servise[0]\" class=\"booklink\" target=\"_blank\"><h3>$servise[0]</h3></a>

<div class=\"clear\"></div>"; 
echo "<div class=\"desccat\">$servise[29]";

if ($servise[37] == 1 && $servise[25] != 0 && !empty($paym)) {echo"<hr /><span style=\"display:block; font-size:12px;\">
Оплата через PayPal</span>";}

if ($servise[37] == 2 && $servise[25] != 0 && !empty($paym)) {echo"<hr /><span style=\"display:block; font-size:12px;\">
Эту услугу можно оплатить онлайн через PayPal</span>";}

echo "<div class=\"descover\">&#160;</div>
</div>
</td>";


echo"</tr>";

echo "</table>";  

echo '</div>'; //===услуги

} //не пустой ID категории

} //не пустая строка

} // count serv

} //не пустой файл


echo '<div class="clear"></div>'; 

echo '</div><div class="clear"></div><div class="bord_cat">&#160;</div>';  


} //count cat

}


//================================без категории

//определяем константу для имени файла
define('FILENAME_NC_FFRR', $file_name);
// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_NC_FFRR)) {
         echo "Услуг в базе нет!";
} else {
    // если есть, выводим
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 
if (!empty($lines[$a])) {
$data = $lines[$a];
$servise = explode("::", $data);

$cur = $servise[26];
$currensy = array(
"RUB" => "руб.",
"EUR" => "евро",
"USD" => "долларов");

if(empty($servise[87]) && $servise[88] != 'no') { 

$cur = $servise[26];
$currensy = array(
"RUB" => "руб.",
"EUR" => "евро",
"USD" => "долларов");

echo '<div class="cat_list_ser">'; //========Услуги

echo"
<table><tbody>";

if (!$servise[31]) {echo"<tr><td class=\"noph\">";}
else {
$rnd_num = date('dHms');
echo"<tr><td class=\"ftd\">
<div class=\"pict\">
<a href=\"".$agbs_dir."/data/pict/".$servise[31]."?salt=$rnd_num\" rel=\"shadowbox\"><img src=\"".$agbs_dir."/data/pict/small_".$servise[31]."?salt=$rnd_num\" alt=\"".$servise[0]."\" /></a>
</div>";}

echo "<div class=\"desc_service\" style=\"text-align:center;\">"; 
     if ($servise[25] == '-') {echo"<span>цена варьируется</span>";}
else if ($servise[25] == '0' || empty($servise[25])) {echo '<span>бесплатно</span>';} 
else if ($servise[30] == 1 && $servise[34] !=1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">не почасовая оплата</span>";}
else if ($servise[30] == 1 && $servise[34] ==1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">фиксированная цена</span>";}
else if ($servise[34] ==1 && $servise[30] !=1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в сутки</span>";}
else {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в час</span>";}
echo"</div>";


echo "<a href=\"".$agbs_dir."/sel_date.php?select_service=".$servise[32]."\" title=\"$form_1 $servise[0]\" class=\"bookgo\" target=\"_blank\">
<span>$form_1</span></a><div class=\"clear\"></div>";



echo "</td>";

//===название и описание

echo"
<td style=\"width:100%;\">
<!-- <label title=\"Выбрать услугу\">
<input type=\"radio\" name=\"select_service\" value=\"$servise[32]\" onClick=\"submit()\" />
<h3>$servise[0]</h3></label> -->";

echo "
<a href=\"".$agbs_dir."/sel_date.php?select_service=".$servise[32]."\" title=\"$form_1 $servise[0]\" class=\"booklink\" target=\"_blank\"><h3>$servise[0]</h3></a>

<div class=\"clear\"></div>"; 
echo "<div class=\"desccat\">$servise[29]";

if ($servise[37] == 1 && $servise[25] != 0 && !empty($paym)) {echo"<hr /><span style=\"display:block; font-size:12px;\">
Оплата через PayPal</span>";}

if ($servise[37] == 2 && $servise[25] != 0 && !empty($paym)) {echo"<hr /><span style=\"display:block; font-size:12px;\">
Эту услугу можно оплатить онлайн через PayPal</span>";}

echo "<div class=\"descover\">&#160;</div>
</div>
</td>";


echo"</tr>";

echo "</table>";  

echo '</div>'; //===услуги


} //без категории 

}//no empty lines

}//count ser 

}//no empty services





?>

<div class="clear"></div>

<?php if($shed == '1') {  ?>
<div class="sched_l">
<a href="<?php echo $agbs_dir; ?>/schedule.php" class="bookgo" target="_blank" style="position:static!important; float:right; margin:0;" title="Расписание">
<span>Расписание</span></a>
<div class="clear"></div>
</div>
<?php } ?>

</form>

</div>
</div>


<!-- //SERVICES -->