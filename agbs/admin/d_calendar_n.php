<?php

// местоположение скрипта
$self = $_SERVER['PHP_SELF']; 
 
// проверяем, если в переменная month была установлена в URL-адресе, 
//либо используем PHP функцию date(), чтобы установить текущий месяц.
if(isset($_GET['month']))
    $month_next = $_GET['month']; 
elseif(isset($_GET['viewmonth']))
    $month_next = $_GET['viewmonth']; 
else $month_next = date('m')+1; 
 
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

if($month_next == '12')
    $next_year = $year + 1; 
else $next_year = $year; 
 
?>

<?php



 
$month_next_r = array(
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
 
 
$month_next_n = array(
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
 

 
$first_of_month = mktime(0, 0, 0, $month_next, 1, $year); 
 
// Массив имен всех дней в неделю
$day_headings = array('Sunday', 'Monday', 'Tuesday', 
'Wednesday', 'Thursday', 'Friday', 'Saturday'); 
 
$maxdays = date('t', $first_of_month); 
$date_info = getdate($first_of_month); 
$month_next = $date_info['mon']; 
$year = $date_info['year']; 
 
// Если текущий месяц это январь, 
//и мы пролистываем календарь задом наперед число, 
//обозначающее год, должно уменьшаться на один. 
 
if($month_next == '1'): 
    $last_year = $year-1; 
else: $last_year = $year; 
endif; 
 
// Вычитаем один день с первого дня месяца, 
//чтобы получить в конец прошлого месяца
$timestamp_last_month = $first_of_month - (24*60*60); 
$last_month = date("m", $timestamp_last_month);
 
// Проверяем, что если месяц декабрь, 
//на следующий месяц равен 1, а не 13
if($month_next == '12')
    $next_month = '1'; 
else $next_month = $month_next+1; 
 
?>

<?php



$calendar_n = " 
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
    $calendar_n .= "<td colspan=\"$weekday\"> </td>";
 
while($day <= $maxdays)
{
    // если суббота, выволдим новую колонку.
    if($weekday == 7) {
        $calendar_n .= "</tr><tr>";
    $weekday = 0;
  }
 
  $linkDate = mktime(0, 0, 0, $month_next, $day, $year);
 
  // проверяем, если распечатанная дата является сегодняшней датой.
  //если так, используем другой класс css, чтобы выделить её 
    if((($day < 10 and "0$day" == date('d')) or ($day >= 10 and "$day" == date('d'))) 
    and (($month_next < 10 and "0$month_next" == date('m')) 
    or ($month_next >= 10 and "$month_next" == date('m'))) and $year == date('Y'))
       $class = "caltoday";
	   
 
  //в противном случае, печатаем только ссылку на вкладку
    else {
    $d = date('m/d/Y', $linkDate);
 
      $class = "cal";
  }
 
  //помечаем выходные дни красным
  if($weekday == 5 || $weekday == 6) $red=' class="weekday"';
  else $red='';

  

//$current_month = date('m');
if ($date_dis_n[$day] == "0") {
$calendar_n .= "
<td class=\"checked_day\" id=\"dd_nc$day\"><label>
<div>
<span title=\"Не рабочий день\"><input type=\"checkbox\" value=\"0\" name=\"dd_n$day\" onclick=\"check_s_n$day()\" checked /><br />{$day}</span>
</div></label></td>


<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_s_n$day() 

function check_s_n$day()

{

  var rarr=document.getElementsByName(\"dd_n$day\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dd_nc$day').classList.remove('select_date');
	document.getElementById('dd_nc$day').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dd_nc$day').classList.remove('checked_day');
	document.getElementById('dd_nc$day').classList.add('select_date');
  }   
  
 }

</script>
";
}  else  {

 
 
	

	
$nwd = $weekday_n[$weekday];   
$calendar_n .= "
<td id=\"dd_ns$day\" class=\"select_date\"><label>
<div>
<span><input type=\"checkbox\" value=\"0\" name=\"dd_n$day\" onclick=\"check_n$day()\" /><br />{$day}</span>
</div></label></td>





<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_n$day() 

function check_n$day()

{

  var rarr=document.getElementsByName(\"dd_n$day\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dd_ns$day').classList.remove('select_date');
	document.getElementById('dd_ns$day').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dd_ns$day').classList.remove('checked_day');
	document.getElementById('dd_ns$day').classList.add('select_date');
  }   
  
 }

</script>
";

}






    $day++;
    $weekday++;  
 
 
 
 

} 
 
if($weekday != 7) 
  $calendar_n .= "<td colspan=\"" . (7 - $weekday) . "\"></td>"; 
 
?>
