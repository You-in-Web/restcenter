<?php

// местоположение скрипта
$self = $_SERVER['PHP_SELF']; 
 
// проверяем, если в переменная month была установлена в URL-адресе, 
//либо используем PHP функцию date(), чтобы установить текущий месяц.
if(isset($_GET['month']))
    $month = $_GET['month']; 
elseif(isset($_GET['viewmonth']))
    $month = $_GET['viewmonth']; 
else $month = date('m'); 
 
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
"1" => "январе",
"2" => "феврале",
"3" => "марте",
"4" => "апреле",
"5" => "мае",
"6" => "июне",
"7" => "июле",
"8" => "августе",
"9" => "сентябре",
"10" => "октябре",
"11" => "ноябре",
"12" => "декабре"); 
 

 
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



$calendar = " 
<table cellspacing=\"1\">
   
    <tr>
        <th class=\"datehead\">Пн</td>
        <th class=\"datehead\">Вт</td>
        <th class=\"datehead\">Ср</td>
        <th class=\"datehead\">Чт</td>
        <th class=\"datehead_p\">Пт</td>
        <th class=\"datehead_w\">Сб</td>
        <th class=\"datehead_w\">Вс</td>
    </tr>
    <tr>"; 
?>

<?php

// очищаем имя класса css
$class = "";
 
$weekday = $date_info['wday'];
 
// Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
$weekday = $weekday-1; 
if($weekday == -1) $weekday=6;
 
// станавливаем текущий день как единица 1
$day = 1;
 
$weekday_n = array(
"0" => "Понедельник",
"1" => "Вторник",
"2" => "Среда",
"3" => "Четверг",
"4" => "Пятница",
"5" => "Суббота",
"6" => "Воскресение");  
 

 
 
// выводим ширину календаря
if($weekday > 0) 
    $calendar .= "<td colspan=\"$weekday\"> </td>";
 
while($day <= $maxdays)
{
    // если суббота, выволдим новую колонку.
    if($weekday == 7) {
        $calendar .= "</tr><tr>";
    $weekday = 0;
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
  if($weekday == 5 || $weekday == 6) $red=' class="weekday"';
  else $red='';

  

$current_month = date('m');
if ($date_dis[$day] == "0" && $month == $current_month) {
$calendar .= "
<td class=\"checked_day\" id=\"ddc$day\"><label>
<div>
<span title=\"Не рабочий день\"><input type=\"checkbox\" value=\"0\" name=\"dd$day\" onclick=\"check_s_$day()\" checked /><br />{$day}</span>
</div></label></td>


<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_s_$day() 

function check_s_$day()

{

  var rarr=document.getElementsByName(\"dd$day\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('ddc$day').classList.remove('select_date');
	document.getElementById('ddc$day').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('ddc$day').classList.remove('checked_day');
	document.getElementById('ddc$day').classList.add('select_date');
  }   
  
 }

</script>
";
}  else  {

 
 if(($month < date('m')) or ($year < date('Y'))){ 
  
$calendar .= "
<td class=\"last_day\">
<div><span><input type=\"checkbox\" value=\"0\" name=\"dd$day\" disabled /><br />{$day}</span>
</div></td>
";
  
    }  else  {
  
if(($day < date('d')) and ($month == date('m')) and $year == date('Y')) {
	
$calendar .= "<td class=\"last_day\">
<div><span><input type=\"checkbox\" value=\"0\" name=\"dd$day\" disabled /><br />{$day}</span>
</div></td>";
	}  else  {
	

	
$nwd = $weekday_n[$weekday];   
$calendar .= "
<td id=\"dds$day\" class=\"select_date\"><label>
<div>
<span><input type=\"checkbox\" value=\"0\" name=\"dd$day\" onclick=\"check_$day()\" /><br />{$day}</span>
</div></label></td>





<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_$day() 

function check_$day()

{

  var rarr=document.getElementsByName(\"dd$day\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dds$day').classList.remove('select_date');
	document.getElementById('dds$day').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dds$day').classList.remove('checked_day');
	document.getElementById('dds$day').classList.add('select_date');
  }   
  
 }

</script>
";

}}}






    $day++;
    $weekday++;  
 
 
 
 

} 
 
if($weekday != 7) 
  $calendar .= "<td colspan=\"" . (7 - $weekday) . "\"></td>"; 
 
?>
