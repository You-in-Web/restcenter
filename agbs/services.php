<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим ?>
<div id="s_serv">

<form method="get" action="sel_date.php">
<?php

$file_name = "data/services.dat"; 

$file_cat = "data/cat.dat";

error_reporting(0);

//определяем константу для имени файла
define('FILENAME_SER', $file_name);
// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_SER)) {
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



//определяем константу для имени файла
define('FILENAME_CAT', $file_name);
// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_CAT)) {
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

echo"<tr><td width=\"140\" height=\"10\" class=\"desctd\" valign=\"top\">";

if (!$servise[31]) {echo"";}
else {
$rnd_num = date('dHms');
echo"
<div class=\"pict\">
<a href=\"data/pict/".$servise[31]."?salt=$rnd_num\" class=\"pirobox_gall\" id=\"$servise[0]\"><img src=\"data/pict/small_".$servise[31]."?salt=$rnd_num\" alt=\"".$servise[0]."\" /></a>
</div>";}

echo "<div class=\"desc_service\" style=\"text-align:center;\">"; 
     if ($servise[25] == '-') {echo"<span>цена варьируется</span>";}
else if ($servise[25] == '0' || empty($servise[25])) {echo '<span>бесплатно</span>';} 
else if ($servise[30] == 1 && $servise[34] !=1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">не почасовая оплата</span>";}
else if ($servise[30] == 1 && $servise[34] ==1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">фиксированная цена</span>";}
else if ($servise[34] ==1 && $servise[30] !=1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в сутки</span>";}
else {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в час</span>";}
echo"</div>";
echo "</td>";

//===название и описание

echo"
<td width=\"100%\" valign=\"top\">
<label title=\"Выбрать услугу\">
<input type=\"radio\" name=\"select_service\" value=\"$servise[32]\" onClick=\"submit()\" />
<h3>$servise[0]</h3></label>

<div class=\"desccat\">$servise[29]";

if ($servise[37] == 1 && $servise[25] != 0 && !empty($paym)) {echo"<hr /><span style=\"display:block; font-size:12px;\">Оплата через PayPal</span>";}

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
echo '<div class="desccat">'.$catsd[2].'</div>'; //описание категории
echo '</div>';  


//if(preg_match("/a_".$servise[87]."_z/i", $strcatid)) 



} //count cat

}


//================================без категории

echo "<div class=\"item_list\">"; //==

//определяем константу для имени файла
define('FILENAME_NC', $file_name);
// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_NC)) {
         echo "";
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

echo "<div class=\"item_list_ser\">"; //==

echo "
<table><tbody>
<tr>";



echo"<td width=\"140\" align=\"center\" class=\"desctd\" valign=\"top\">";



if (!$servise[31]) {echo"";}
else {
$rnd_num = date('dHms');

echo"<div class=\"pict\"><a href=\"data/pict/".$servise[31]."?salt=$rnd_num\" class=\"pirobox_gall\" id=\"$servise[0]\">
<img src=\"data/pict/small_".$servise[31]."?salt=$rnd_num\" alt=\"".$servise[0]."\" /></a></div>";

}




echo"<div class=\"desc_service\">"; 
     if ($servise[25] == '-') {echo"<span>цена варьируется</span>";}
else if ($servise[25] == '0') {echo '<span>бесплатно</span>';} 
else if ($servise[30] == 1 && $servise[34] !=1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">не почасовая оплата</span>";}
else if ($servise[30] == 1 && $servise[34] ==1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">фиксированная цена</span>";}
else if ($servise[34] ==1 && $servise[30] !=1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в сутки</span>";}

else {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в час</span>";}

echo"</div>";

if ($servise[37] == 1 && $servise[25] != 0 && !empty($paym)) {echo"<span style=\"display:block; text-align:center; font-size:12px;\">Оплата через PayPal</span>";}

echo"</td>";

echo "<td width=\"100%\" valign=\"top\">

<label title=\"Выбрать услугу\">
<input type=\"radio\" name=\"select_service\" value=\"$servise[32]\" onClick=\"submit()\" /><h3>$servise[0]</h3> 
<small>$servise[29]</small></label>
</td>";

echo "</tr></table>";  

echo "</div>"; 
echo '<div class="clear"></div>';

} //без категории 

}//no empty lines

}//count ser 

}//no empty services
echo '<div class="clear"></div>';
echo "</div>"; 




?>
</form>
</div>