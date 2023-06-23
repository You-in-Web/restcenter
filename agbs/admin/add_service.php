<?php
include("header.php");

$script_name = "aservices.php";




//проверка формы для добавления
unset($ERROR);//на всякий пожарный, чтоб лишнего не выплыло
if($_GET['add_name_service']){


$_GET['add_name_service'] = str_replace(array(':', '|', '\"', '"', '*'), '', trim($_GET['add_name_service']));

$_GET['add_name_service'] = str_replace(array('^'), '', trim($_GET['add_name_service']));
$_GET['add_name_service'] = str_replace(array('y'), 'у', trim($_GET['add_name_service']));

$deck_service=trim(htmlspecialchars($_GET['add_name_service']));
}
if(!$_GET['add_name_service']){
$ERROR["add_name_service"]["text"] = "Введите название услуги.";
} else { if((strlen($_GET['add_name_service'])<3)){
$ERROR["add_name_service"]["text"] = "Название введено не корректно.<br />Поле должно содержать только буквы и цифры и быть не менее 3х символов.";
} }

if (strlen($_GET['add_name_service'])>70) {$ERROR["add_name_service"]["text"] = "Название слишком длинное.";}

if(!$_GET['add_price_service']){
} else { 
$_GET['add_price_service'] = str_replace(array(','), '.', trim($_GET['add_price_service']));
if (preg_match("/[^0-9,.-]/", $_GET['add_price_service'])){
$ERROR["add_price_service"]["text"] = "Поле \"Цена\" должно содержать только цифры.";
} }
if(empty($_GET['add_price_service'])){ $_GET['add_price_service'] = '0'; }


if(!$_GET['losthr']){
} else { 
if (preg_match("/[^0-9]/", $_GET['losthr'])){
$ERROR["losthr"]["text"] = "Поле \"Перерыв\" должно содержать только цифры.";
}
if ($_GET['losthr'] > 24) {
$ERROR["losthr"]["text"] = "Перерыв не может быть более 23 часов.";
}
}

if ($_GET['add_min_service'] != 0) { if ($_GET['add_min_service'] < $_GET['add_max_service']) {
$ERROR["add_price_service"]["text"] = "Время предоставления услуги меньше, чем разрешенно бронировать\заказывать.";
}}

if($_GET['deck_service']){
$deck_service=trim(htmlspecialchars($_GET['deck_service']));

$_GET['deck_service'] = str_replace(array('::', '|', '*'), '', trim($_GET['deck_service']));
$_GET['deck_service'] = str_replace(array('\"', '"'), '&quot;', $_GET['deck_service']); 

$_GET['deck_service'] = str_replace(array('n'), '&#110;', trim($_GET['deck_service']));
$_GET['deck_service'] = str_replace(array('y'), 'у', trim($_GET['deck_service']));

$_GET['deck_service'] = preg_replace("|[\r\n]+|", " ", $_GET['deck_service']); 
$_GET['deck_service'] = preg_replace("|[\n]+|", " ", $_GET['deck_service']); 
}

if (strlen($_GET['deck_service'])>900) {$ERROR["deck_service"]["text"] = "Описание слишком длинное.";}


$anowwd = "$_GET[apon]|*$_GET[avto]|*$_GET[asre]|*$_GET[ache]|*$_GET[apat]|*$_GET[asub]|*$_GET[avos]|*";

$line_data_add = "$_GET[add_name_service]::$_GET[time_servise_add00]::$_GET[time_servise_add01]::$_GET[time_servise_add02]::$_GET[time_servise_add03]::$_GET[time_servise_add04]::$_GET[time_servise_add05]::$_GET[time_servise_add06]::$_GET[time_servise_add07]::$_GET[time_servise_add08]::$_GET[time_servise_add09]::$_GET[time_servise_add10]::$_GET[time_servise_add11]::$_GET[time_servise_add12]::$_GET[time_servise_add13]::$_GET[time_servise_add14]::$_GET[time_servise_add15]::$_GET[time_servise_add16]::$_GET[time_servise_add17]::$_GET[time_servise_add18]::$_GET[time_servise_add19]::$_GET[time_servise_add20]::$_GET[time_servise_add21]::$_GET[time_servise_add22]::$_GET[time_servise_add23]::$_GET[add_price_service]::$_GET[add_currensy_service]::$_GET[add_min_service]::$_GET[add_max_service]::$_GET[deck_service]::$_GET[no_time]::::$_GET[idser]::$_GET[losthr]::$_GET[date_srv]::$_GET[sep_srv]::$_GET[tdh]::$_GET[mpay]::$anowwd::$mo00::$mo01::$mo02::$mo03::$mo04::$mo05::$mo06::$mo07::$mo08::$mo09::$mo10::$mo11::$mo12::$mo13::$mo14::$mo15::$mo16::$mo17::$mo18::$mo19::$mo20::$mo21::$mo22::$mo23::$md00::$md01::$md02::$md03::$md04::$md05::$md06::$md07::$md08::$md09::$md10::$md11::$md12::$md13::$md14::$md15::$md16::$md17::$md18::$md19::$md20::$md21::$md22::$md23::$_GET[cat]::";

if (array_key_exists('add',$_GET)){
if (is_array($ERROR)) {

echo "
<script language=\"javascript\">
    var delay = 5000;
    setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script>
<span class=\"error\">";
foreach($ERROR as $key => $value){
echo "" . $ERROR[$key]["text"] . "<br />";
}
echo "</span></div></body></html>"; exit;

} else {



$file_name = "../data/services.dat"; 
define('FILENAME', $file_name);
if (!file_get_contents(FILENAME))
{


$fp=fopen("$file_name", "a+"); 
fputs
($fp, "$line_data_add\r"); 
fclose($fp);


} else {
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
//$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 


$fp=fopen("$file_name", "a+"); 
fputs
($fp, "\n$line_data_add\r"); 
fclose($fp);}

echo "<div class=\"done\">Услуга добавлена.</div><br /><br />
<script language=\"javascript\">
    var delay = 3000;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script>";

}
}
//-----
include("footer.php");
?>