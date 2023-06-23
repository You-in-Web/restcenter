<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим


$_POST["select_service"] = $_GET["serv"];

$file_name = "data/services.dat"; 
//define('FILENAME', $file_name);
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 
if (!empty($lines[$a])) {
$data = $lines[$a];
$servise = explode("::", $data);



if($_POST["select_service"] == $servise[32]) {

$sep_servise = $servise[35];
$tda = $servise[36];



$nowwdn = explode("|*", $servise[38]);
$ponn = $nowwdn[0];
$vton = $nowwdn[1];
$sren = $nowwdn[2];
$chen = $nowwdn[3];
$patn = $nowwdn[4];
$subn = $nowwdn[5];
$vosn = $nowwdn[6];
}

}}


if(isset($_GET['month']))
    $month = $_GET['month']+1; 
elseif(isset($_GET['viewmonth']))
    $month = $_GET['viewmonth']; 
	
else $month = date('m')+1; 
 
// Теперь мы проверим, если переменная года устанавливается в URL, 
//либо использовать PHP функцию date(), 
//чтобы установить текущий год, если текущий год не установлен в URL-адресе.
if(isset($_GET['year']))
    $year = $_GET['year']; 
elseif(isset($_GET['viewyear'])) 
    $year = $_GET['viewyear']; 
else $year = date('Y'); 
 
?>

<?php

if($month == '12')
    $next_year = $year + 1; 
else $next_year = $year; 
 
?>

<?php



 
$Month_r = array(
"1" => "января",
"2" => "февраля",
"3" => "марта",
"4" => "апреля",
"5" => "мая",
"6" => "июня",
"7" => "июля",
"8" => "августа",
"9" => "сентября",
"10" => "октября",
"11" => "ноября",
"12" => "декабря"); 
 
 
$Month_n = array(
"1" => "январь",
"2" => "февраль",
"3" => "март",
"4" => "апрель",
"5" => "май",
"6" => "июнь",
"7" => "июль",
"8" => "август",
"9" => "сентябрь",
"10" => "октябрь",
"11" => "ноябрь",
"12" => "декабрь"); 
 
$current_month = date('m');
 
$first_of_month = mktime(0, 0, 0, $month, 1, $year); 
 
// Массив имен всех дней в неделю
$day_headings = array('Sunday', 'Monday', 'Tuesday', 
'Wednesday', 'Thursday', 'Friday', 'Saturday'); 
 
$maxdays = date('t', $first_of_month); 
$date_info = getdate($first_of_month); 
$month = $date_info['mon']; 
$year = $date_info['year']; 
 
// Если текущий месяц это январь, 
//и мы пролистываем календарь задом наперед число, 
//обозначающее год, должно уменьшаться на один. 
 
if($month == '1'): 
    $last_year = $year-1; 
else: $last_year = $year; 
endif; 
 
// Вычитаем один день с первого дня месяца, 
//чтобы получить в конец прошлого месяца
$timestamp_last_month = $first_of_month - (24*60*60); 
$last_month = date("m", $timestamp_last_month);
 
// Проверяем, что если месяц декабрь, 
//на следующий месяц равен 1, а не 13
if($month == '12')
    $next_month = '1'; 
else $next_month = $month+1; 
 
?>

<?php

$sel_serv = $_GET["serv"];






$calendar_next = " 
<table>
   
    <tr>
        <th class=\"datehead\">Пн</td>
        <th class=\"datehead\">Вт</td>
        <th class=\"datehead\">Ср</td>
        <th class=\"datehead\">Чт</td>
        <th class=\"datehead\">Пт</td>
        <th class=\"datehead\">Сб</td>
        <th class=\"datehead\">Вс</td>
    </tr>
    <tr>"; 
?>

<?php

// очищаем имя класса css
$class = "";
 
$weekdayn = $date_info['wday'];
 
// Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
$weekdayn = $weekdayn-1; 
if($weekdayn == -1) $weekdayn=6;
 
// станавливаем текущий день как единица 1
$day = 1;
 
$weekdayn_n = array(
"0" => "Понедельник",
"1" => "Вторник",
"2" => "Среда",
"3" => "Четверг",
"4" => "Пятница",
"5" => "Суббота",
"6" => "Воскресение");  
 

 
 
// выводим ширину календаря
if($weekdayn > 0) 
    $calendar_next .= "<td colspan=\"$weekdayn\"> </td>";
 
while($day <= $maxdays)
{
    // если суббота, выволдим новую колонку.
    if($weekdayn == 7) {
        $calendar_next .= "</tr><tr>";
    $weekdayn = 0;
  }
 
  $linkDate = mktime(0, 0, 0, $month, $day, $year);
 
  // проверяем, если распечатанная дата является сегодняшней датой.
  //если так, используем другой класс css, чтобы выделить её 
    if((($day < 10 and "0$day" == date('d')) or ($day >= 10 and "$day" == date('d'))) 
    and (($month < 10 and "0$month" == date('m')) 
    or ($month >= 10 and "$month" == date('m'))) and $year == date('Y'))
       $class = "caltoday";
	   
 
  //в противном случае, печатаем только ссылку на вкладку
    else {
    $d = date('m/d/Y', $linkDate);
 
      $class = "cal";
  }
 
  //помечаем выходные дни красным
  if($weekdayn == 5 || $weekdayn == 6) $red=' class="weekday"';
  else $red='';
  


if($interval == '0' && $month >= "0$current_month"+2 || $year > date('Y')) {
	$interval_n = '1';
	$calendar_next .= "<td class=\"last_day\">
	<div class=\"disabled_date\" title=\"недоступно для $form_3\">
	<span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span>
	</div></td>";
	}  else  {  


if ($date_dis_n[$day] == "0" && $month == "0$current_month"+1) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>";}



//---- не рабочие дни недели
else if ($weekdayn == 0 && $ponn == 1) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; }
else if ($weekdayn == 1 && $vton == 1) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }
else if ($weekdayn == 2 && $sren == 1) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; }
else if ($weekdayn == 3 && $chen == 1) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }
else if ($weekdayn == 4 && $patn == 1) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }
else if ($weekdayn == 5 && $subn == 1) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }
else if ($weekdayn == 6 && $vosn == 1) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }




//только будни
else if ($calendar_type == 2 && $weekdayn > 4) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; } 

//только выходные
else if ($calendar_type == 1 && $weekdayn < 5) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; } 



//отключено
else if ($calendar_type == 3) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; 


}  else  {

if ($date_dis[$day] == "0" && $month == $current_month) {
$calendar_next .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>";
}  else  {
 
 if(($month < date('m')) or ($year < date('Y'))){ 
  
    $calendar_next .= "<td class=\"last_day\"><div class=\"disabled_date\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>";
  
    }  else  {
  
if(($day < date('d')) and ($month == date('m')) and $year == date('Y')) {
	
	$calendar_next .= "<td class=\"last_day\"><div class=\"disabled_date\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>";
	}  else  {
	

	


	
	
$nwd = $weekdayn;  
$s_daten = "$day-$month-$year"; 
$s_datenn = "$day-$month-$year"."y:"; 
$calendar_next .= "
<td class=\"{$class}\">
<div class=\"select_date\">
<span".$red.">";
$time_ay_n = $day."n";
$calendar_next .= "<label id=\"time_trn$time_ay_n\" title=\"Выбрать дату\">
<input type=\"checkbox\" name=\"select_time[$time_ay_n]\" value=\"{$s_daten}y:\" onclick=\"check_n_$time_ay_n()\"";
if ($_POST['select_time']) {
foreach ($_POST['select_time'] as $keyn=>$valuen)

if (empty($ERROR["select_time"]["text"]) && $valuen == $s_datenn) {$calendar_next .=" checked=\"checked\"";} 
} 
$calendar_next .=" class=\"chk\" />{$day}</label>";
$calendar_next .="
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_n_$time_ay_n()
function check_n_$time_ay_n(){

  var rarrn=document.getElementsByName(\"select_time[$time_ay_n]\");
  
  if(rarrn['0'].checked){
    // выбран первый radio
	
	document.getElementById('time_trn$time_ay_n').classList.add('add_date');
  }
   else{
    // выбран второй radio
	document.getElementById('time_trn$time_ay_n').classList.remove('add_date');
	document.getElementById('time_trn$time_ay_n').classList.add('');
  }   
  
 }
 </script>

";

//--------------------------------------Если услуги раздельные



if ($sep_servise == '1') {

$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 
$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) { 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $b_idserv) = explode("**", $data_lt);





if (empty($b_date)) {


$current_service = $_GET["serv"];

if (preg_match(".$current_service.", $data_lt)) {



$time_b = explode("||", $b_time);

foreach ($time_b as $btk=>$bc) {
$bv = $bc;


$br_time = explode("y:", $bv);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) {



if ($s_daten == $tr) {$calendar_next .= "<div class=\"dd\" title=\"занято\"><input type=\"checkbox\" disabled=\"disabled\" />{$day}</div>";} 


}
}
}} }
}

//--------------------------- Все услуги на одного
} else {





$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 
$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) { 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $b_idserv) = explode("**", $data_lt);


if (empty($b_date)) {

$time_b = explode("||", $b_time);

foreach ($time_b as $btk=>$bc) {
$bv = $bc;


$br_time = explode("y:", $bv);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) {



if ($s_daten == $tr) {$calendar_next .= "<div class=\"dd\" title=\"занято\"><input type=\"checkbox\" disabled=\"disabled\" />{$day}</div>";} 


}
}
}//--empty date
else if ($s_daten == $b_date) {$calendar_next .= "<div class=\"dd\" title=\"занято\"><input type=\"checkbox\" disabled=\"disabled\" />{$day}</div>";}



} }




//--
}




$calendar_next .= "
</span>
</div></td>";

}}}
}
}






    $day++;
    $weekdayn++;  
 
 
 
 

} 
 
if($weekdayn != 7) 
  $calendar_next .= "<td colspan=\"" . (7 - $weekdayn) . "\"></td>"; 

?>






<?php  
echo $calendar_next . "</tr></table>";
?>




