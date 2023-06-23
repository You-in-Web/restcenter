<div id="s_serv">
<?php

$file_name = "data/services.dat"; 

//определяем константу для имени файла
define('FILENAME_SSH', $file_name);

// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_SSH)) {
         echo "Услуг в базе нет!";
} else {
    // если есть, выводим


$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 





if($_POST["select_service"]){ 

echo "";



} else {




$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 

if (!empty($lines[$a])) {

$data = $lines[$a];

$servise = explode("::", $data);

$cur = $servise[26];
$currensy = array(
"RUB" => "руб.",
"EUR" => "евро",
"USD" => "долларов");










echo "
<div class=\"list_serv\">";

echo "
<table><tbody>
<tr>
<td width=\"100%\" valign=\"top\" style=\"padding-right:20px;\">
<label title=\"Выбрать услугу\">
<input type=\"radio\" name=\"select_service\" value=\"".$servise[32]."\""; 
if(@$_POST["select_service"]==$servise[32]){echo " checked";} 
echo " onClick=\"submit()\" /><h3>$servise[0]</h3>

<br /><small>$servise[29]</small></label>
</td>


<td width=\"30%\" align=\"center\" valign=\"top\">
<div class=\"desc_service\">"; 

     if ($servise[25] == '-') {echo"<span>цена варьируется</span>";}
else if ($servise[25] == '0') {echo '<span>бесплатно</span>';} 
else if ($servise[30] == 1) {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">не почасовая оплата</span>";}
else {echo"<span>$servise[25]</span> $currensy[$cur]<span class=\"small_d\">в час</span>";}

echo"</div></td>";

if (!$servise[31]) {echo"";}
else {
$rnd_num = date('dHms');
echo" <td width=\"140\" valign=\"top\">
<a href=\"data/pict/".$servise[31]."?salt=$rnd_num\" class=\"pirobox_gall\" id=\"$servise[0]\"><img src=\"data/pict/small_".$servise[31]."?salt=$rnd_num\" alt=\"".$servise[0]."\" style=\"margin-left:10px;\" /></a>
</td>";}



echo "</tr></table></div>";
}

} 

}



}


?>
</div>