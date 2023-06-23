<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
include("inc/header.php");?>


<div id="calendar" class="nodate1">


<?php if ($steps == '1') { include("steps.php"); } ?>


<?php 
$file_name = "data/services.dat"; 
$script_name = "booking.php";
//определяем константу для имени файла
define('FILENAME_CSB', $file_name);

// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_CSB)){ echo "Услуг в базе нет!"; } else {
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
if($_GET["select_service"] == $servise[32]){ 
if ($servise[34] == '1') {

echo "<script language=\"javascript\">
    var delay = 0;
    setTimeout(\"document.location.href='".$script_name."?serv=".$_GET["select_service"]."&date=1'\", delay);
    </script>
	<noscript>
	<meta http-equiv=\"refresh\" content=\"0; url=".$script_name."?serv=".$_GET["select_service"]."&date=1\">
	</noscript>"; exit;}


?>



<?php if($_GET["select_service"]){ 
echo "<p class=\"date_p\"><span>".$servise[0]."</span>
<a href=\"index.php\">список услуг</a><span class=\"ugol\"></span></p>";
} else {
echo "<p class=\"date_p\" style=\"color:#ff3300;\"><span>Ошибка!</span> <a href=\"javascript:history.back();\">вернитесь назад</a><span class=\"ugol\"></span></p>";
}

}

}
}
}
?>


<div style="clear:both;"></div>



<?php  
include('calendar.php');
echo $calendar . "</tr></table>";

if($interval_n == '1') 
{echo "<br /><span class=\"error\">Этот месяц ещё недоступен для $form_3.</span>";}
else if ($calendar_type == 3) 
{echo  "<br /><span class=\"error\">Сервис временно отключен.</span>";}
	


?>

</div>



<?php include("inc/footer.php"); ?>