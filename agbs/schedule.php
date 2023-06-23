<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
include("inc/header_rasp.php");?>



<?php //if ($steps == '1') {include("steps_shed.php");} 

$chrc = date("G");

if (strpos($horus, '+') !== false) {
$horus = str_replace('+', '', $horus);
$this_horus = $chrc+$horus;
}

else if (strpos($horus, '-') !== false) {
$horus = str_replace('-', '', $horus);
$this_horus = $chrc-$horus;
}
else if ($horus == 0) {$this_horus = $chrc;}


$c_hr = $this_horus+1;
 ?>

<div id="calendar_rasp">
<?php

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

if (empty($_GET)) {$month = date('n'); } else { $month = $_GET["month"];}

if (empty($_GET)) {$year = date('Y');} else {$year = $_GET["year"];}

$first_of_month = mktime(0, 0, 0, $month, 1, $year); 
$timestamp_last_month = $first_of_month - (24*60*60); 
$last_month = date("n", $timestamp_last_month);

if($month == '12') { $next_month = '1'; } else {$next_month = $month+1;} 

if($month == '1') {$last_year = $year-1; } else {$last_year = $year; }

if($month == '12') {$next_year = $year + 1;} else {$next_year = $year;}

$date_info = getdate($first_of_month); 
$month = $date_info['mon']; 
$year = $date_info['year']; 



  // Вычисляем число дней в текущем месяце
  $dayofmonth = date('t', $first_of_month);
  // Счётчик для дней месяца
  $day_count = 1;

  // 1. Первая неделя
  $num = 0;
  for($i = 0; $i < 7; $i++)
  {
    // Вычисляем номер дня недели для числа
    $dayofweek = date('w',
                      mktime(0, 0, 0, $month, $day_count, date('Y')));
    // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
    $dayofweek = $dayofweek - 1;
    if($dayofweek == -1) $dayofweek = 6;

    if($dayofweek == $i)
    {
      // Если дни недели совпадают,
      // заполняем массив $week
      // числами месяца
      $week[$num][$i] = $day_count;
      $day_count++;
    }
    else
    {
      $week[$num][$i] = "";
    }
  }

  // 2. Последующие недели месяца
  while(true)
  {
    $num++;
    for($i = 0; $i < 7; $i++)
    {
      $week[$num][$i] = $day_count;
      $day_count++;
      // Если достигли конца месяца - выходим
      // из цикла
      if($day_count > $dayofmonth) break;
    }
    // Если достигли конца месяца - выходим
    // из цикла
    if($day_count > $dayofmonth) break;
  }

  
$weekday_n = array(
"0" => "Понедельник",
"1" => "Вторник",
"2" => "Среда",
"3" => "Четверг",
"4" => "Пятница",
"5" => "Суббота",
"6" => "Воскресение");  
 

  // 3. Выводим содержимое массива $week
  // в виде календаря
  // Выводим таблицу 
  
  
echo "
<div id=\"calendar_head\">
<div class=\"month_back\"><a href=\"$self?month=".$last_month."&year=".$last_year."\" title=\"предыдущий месяц\">&#9668;</a></div>";


	
echo "<div class=\"month_title\">".$Month_n[$month]." ".$year."</div>";
	
	
echo "
<div class=\"month_next\"><a href=\"$self?month=".$next_month."&year=".$next_year."\" title=\"следующий месяц\">&#9658;</a></div>
</div><div style=\"margin:0; padding:0; height:0; clear:both;\">&#160;</div>";



  for($i = 0; $i < count($week); $i++)
  {
    echo "";
    for($j = 0; $j < 7; $j++)
    {
      if(!empty($week[$i][$j]))
      {
        // Если имеем дело с субботой и воскресенья
        // подсвечиваем их
		
$c_year = date('Y');	
$c_month = date('n');	
$c_day = date('d');	
	
//echo "$c_month - $c_year == $month - $year <br>";	
	
	
$date_rasp = "".$week[$i][$j]."-".$month."-".$year."";		
				
//echo "".date('d')." -- ".$week[$i][$j]." || ";		
//--------------------вывод	календаря

if($j == 5 || $j == 6) {$class_d = '_red';} else {$class_d = '';}




 if($week[$i][$j] < $c_day && $month == $c_month) {
$rasp .= "
<tr>
<td>
<div class=\"day_l".$class_d."\" style=\"position:relative;\">
".$week[$i][$j]."";

//--------------подцветка завронированных дат (прошедшие дни)
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 

$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
//for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)

{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);



$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) {


if (empty($b_date) && $date_rasp == $tr) {
$rasp .= "
<div id=\"bdt\">
<div class=\"r_time_b\" id=\"r_time_bl\">

".$week[$i][$j]."

<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;} 

}}}}
//--------------вывод информации о заказах на даты (прошедщие дни)
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 
$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
//for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)
{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);


$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) { 



if (empty($b_date) &&  $tr == $date_rasp) {
$rasp .= "<li class=\"serv_info\">$b_service</li><li class=\"tmin\" >";

$dd_time = explode("||", $b_time);
$count_dd = sizeof($dd_time); for ($dd = 0 ; $dd < $count_dd ; ++$dd) {
$dd_time[$dd] = str_replace('y:', '', $dd_time[$dd]);
$mdd = explode("-", $dd_time[$dd]);

$mdd_dn = mb_strlen($mdd[0], 'utf8'); 
if ($mdd_dn == '1')
{$mdd[0] = "0".$mdd[0];}

$mdd_mn = array(
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

$rasp .= "<small>".$mdd[0]." ".$mdd_mn[$mdd[1]]." ".$mdd[2]."</small>";
}

$rasp .= "</li><li class=\"sep_bi\">&#160;</li>"; 
}



}}
}}


$rasp .= "</ul></div></div>";

$rasp .= "</div>
</td>

<td>
<div class=\"weekn_l".$class_d."\">".$weekday_n[$j]."</div>
</td>"; }


else if($month < $c_month && $year !== $c_year) {

$rasp .= "
<tr>
<td>
<div class=\"day_l".$class_d."\" style=\"position:relative;\">
".$week[$i][$j]."";

//--------------подцветка завронированных дат (прошедшие месяцы)
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 

$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
//for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)

{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);



$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) {


if (empty($b_date) && $date_rasp == $tr) {
$rasp .= "
<div id=\"bdt\">
<div class=\"r_time_b\" id=\"r_time_bl\">

".$week[$i][$j]."

<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;} 

}}}}
//--------------вывод информации о заказах на даты (прошедщие месяцы)
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 
$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
//for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)
{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);


$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) { 



if (empty($b_date) &&  $tr == $date_rasp) {
$rasp .= "

<li class=\"serv_info\">$b_service</li>
<li class=\"sep_bi\">&#160;</li>";
}



}}
}}


$rasp .= "</ul></div></div>";


$rasp .= "</div>
</td>

<td>
<div class=\"weekn_l".$class_d."\">".$weekday_n[$j]."</div>
</td>"; } 


else if($year != $c_year) {

$rasp .= "
<tr>
<td>
<div class=\"day_l".$class_d."\">".$week[$i][$j]."</div>
</td>

<td>
<div class=\"weekn_l".$class_d."\">".$weekday_n[$j]."</div>
</td>"; } 

//только будни
else if ($calendar_type == 2 && $j > 4) {
$rasp .= "
<tr>
<td>
<div class=\"day_l".$class_d."\">".$week[$i][$j]."</div>
</td>

<td>
<div class=\"weekn_l".$class_d."\">".$weekday_n[$j]."</div>
</td>"; } 

//только выходные
else if ($calendar_type == 1 && $j < 5) {
$rasp .= "
<tr>
<td>
<div class=\"day_l".$class_d."\">".$week[$i][$j]."</div>
</td>

<td>
<div class=\"weekn_l".$class_d."\">".$weekday_n[$j]."</div>
</td>"; } 



//отключено
else if ($calendar_type == 3) {
$rasp .= "
<tr>
<td>
<div class=\"day_l".$class_d."\">".$week[$i][$j]."</div>
</td>

<td>
<div class=\"weekn_l".$class_d."\">".$weekday_n[$j]."</div>
</td>"; 


} else {



$rasp .= "
<tr>
<td>
<div class=\"day".$class_d."\" style=\"position:relative;\">";


$rasp .= "".$week[$i][$j]."";


//--------------подцветка завронированных дат
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 

$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
//for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)

{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);



$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) {


if (empty($b_date) && $date_rasp == $tr && $va < $c_hr && $ddll == $c_day || empty($b_date) && $date_rasp == $tr && $ddll < $c_day || empty($b_date) && $date_rasp == $tr && $month < $c_month || empty($b_date) && $date_rasp == $tr && $year < $c_year) {
$rasp .= "
<div id=\"bdt\">
<div class=\"r_time_b\" id=\"r_time_b_l\">

".$week[$i][$j]."

<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;} 

if (empty($b_date) && $date_rasp == $tr) {
$rasp .= "
<div id=\"bdt\">
<div class=\"r_time_b\">

".$week[$i][$j]."

<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;} 

}}}}
//--------------вывод информации о заказах на даты
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 
$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
//for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)
{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);


$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) { 



if (empty($b_date) &&  $tr == $date_rasp) {
$rasp .= "<li class=\"serv_info\">$b_service</li><li class=\"tmin\" >";

$dd_time = explode("||", $b_time);
$count_dd = sizeof($dd_time); for ($dd = 0 ; $dd < $count_dd ; ++$dd) {
$dd_time[$dd] = str_replace('y:', '', $dd_time[$dd]);
$mdd = explode("-", $dd_time[$dd]);

$mdd_dn = mb_strlen($mdd[0], 'utf8'); 
if ($mdd_dn == '1')
{$mdd[0] = "0".$mdd[0];}

$mdd_mn = array(
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

$rasp .= "<small>".$mdd[0]." ".$mdd_mn[$mdd[1]]." ".$mdd[2]."</small>";
}

$rasp .= "</li><li class=\"sep_bi\">&#160;</li>"; 
}



}}
}}


$rasp .= "</ul></div></div>";



$rasp .= "</div>
</td>
<td>
<div class=\"weekn".$class_d."\">".$weekday_n[$j]."</div>
</td>";




}//---------------------------------------------------------------------------------------

 




$rasp .= "
<td class=\"time_t\">";


$time_a = array(
"0" => "00",
"1" => "01",
"2" => "02",
"3" => "03",
"4" => "04",
"5" => "05",
"6" => "06",
"7" => "07",
"8" => "08",
"9" => "09",
"10" => "10",
"11" => "11",
"12" => "12",
"13" => "13",
"14" => "14",
"15" => "15",
"16" => "16",
"17" => "17",
"18" => "18",
"19" => "19",
"20" => "20",
"21" => "21",
"22" => "22",
"23" => "23"
);  


$c_day_r = date('j');	
$ddll = $week[$i][$j];
foreach ($time_a as $ta=>$va) { 







if ($date_dis_n[$week[$i][$j]] == "0" && $month == $c_month+1 && $year == $c_year) {
$rasp .= "<div class=\"r_time_d\" title=\"не рабочий день\">".$va."</div>"; }

else if ($date_dis[$week[$i][$j]] == "0" && $month == $c_month && $year == $c_year) {
 $rasp .= "<div class=\"r_time_d\" title=\"не рабочий день\">".$va."</div>"; } 
 
else if ($month < $c_month && $year !== $c_year) {
$rasp .= "<div class=\"r_time_l\">".$va."</div>"; 
} 
 
else if ($week[$i][$j] < $c_day_r && $month == $c_month) {
$rasp .= "<div class=\"r_time_l\">".$va."</div>"; 
}  
 
else if ($va < $c_hr && $week[$i][$j] == $c_day_r && $month == $c_month) {
$rasp .= "<div class=\"r_time_l\">".$va."</div>";
}  

else if ($year != $c_year) {
$rasp .= "<div class=\"r_time_l\">".$va."</div>";
}  
 
else{

$rasp .= "<div class=\"r_time\">".$va."</div>";

}





//--------------подцветка забронированных дат в часовой зоне
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 

$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
//for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)

{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);



$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) {


if (empty($b_date) && $date_rasp == $tr && $va < $c_hr + $lost_hr && $ddll == $c_day && $month <= $c_month || empty($b_date) && $date_rasp == $tr && $ddll < $c_day && $month <= $c_month || empty($b_date) && $date_rasp == $tr && $month < $c_month || empty($b_date) && $date_rasp == $tr && $year < $c_year) {
$rasp .= "
<div class=\"r_time_db\" id=\"r_time_db_l\">".$va."</div>"; break 3;} 

if (empty($b_date) && $date_rasp == $tr || empty($b_date) && $date_rasp == $tr && $month >= $c_month && $year >= $c_year) {
$rasp .= "
<div class=\"r_time_db\">".$va."</div>"; break 3;} 

}}}}









//--------------подцветка завронированного времени
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 

//$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)

{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);



$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) { 




//--------------------------------------часы
if (!empty($b_date) && $date_rasp == $b_date && $tr == $ta && $ddll == $c_day && $month == $c_month && $year == $c_year && $va >= $c_hr){ 
$rasp .= "
<div class=\"r_time_b\">".$va."<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;}

if (!empty($b_date) && $date_rasp == $b_date && $tr == $ta && $ddll > $c_day && $month == $c_month && $year == $c_year){ 
$rasp .= "
<div class=\"r_time_b\">".$va."<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;}

if (!empty($b_date) && $date_rasp == $b_date && $tr == $ta && $month > $c_month && $year == $c_year){ 
$rasp .= "
<div class=\"r_time_b\">".$va."<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;}

if (!empty($b_date) && $date_rasp == $b_date && $tr == $ta && $month < $c_month && $year == $c_year){ 
$rasp .= "
<div class=\"r_time_b\" id=\"r_time_bl\">".$va."<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;}

if (!empty($b_date) && $date_rasp == $b_date && $tr == $ta && $year < $c_year){ 
$rasp .= "
<div class=\"r_time_b\" id=\"r_time_bl\">".$va."<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;}

if (!empty($b_date) && $date_rasp == $b_date && $tr == $ta && $year > $c_year){ 
$rasp .= "
<div class=\"r_time_b\">".$va."<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;}

if(!empty($b_date) && $ddll < $c_day && $month == $c_month && $date_rasp == $b_date && $tr == $ta && $year == $c_year){
$rasp .= "
<div class=\"r_time_b\" id=\"r_time_bl\">".$va."<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;}

if(!empty($b_date) && $year == $c_year && $month == $c_month && $date_rasp == $b_date && $va < $c_hr && $ddll == $c_day && $tr == $ta){
$rasp .= "
<div class=\"r_time_b\" id=\"r_time_bl\">".$va."<ul class=\"booking_info\">
<li class=\"arrow_bi\"><span class=\"arrow_block\"></span></li>"; break 3;}



//--------------------------------/часы даты
}

}}
}







//--------------вывод информации о заказах
$file_name_lt = "data/booking.dat"; 
//define('FILENAME', $file_name_lt);
$file_lt = fopen($file_name_lt,"r") ; 
flock($file_lt,LOCK_SH) ; 
@$lines_lt = preg_split("~\r*?\n+\r*?~",fread($file_lt,filesize($file_name_lt))) ;
flock($file_lt,LOCK_UN) ; 
fclose($file_lt) ; 
$count_lt = sizeof($lines_lt) ; for ($lt = 0 ; $lt < $count_lt ; ++$lt) 
//for ($lt = count($lines_lt) - 1; $lt >=0 ; $lt--)
{ 
if (!empty($lines_lt[$lt])) {
$data_lt = $lines_lt[$lt];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode("**", $data_lt);


$time_b = explode("||", $b_time);
foreach ($time_b as $btk=>$bv) { 

$data_tb = $bv;
 

$br_time = explode("y:", $data_tb);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) { 




if (!empty($b_date) && $date_rasp == $b_date && $tr == $ta){ 

$rasp .= "
<li class=\"serv_info\">$b_service</li>";

if (!empty($timemin)) {
$rasp .= "<li class=\"tmin\">";
$atimes = explode("|,|", $timemin);
for ($at = 0; $at < count($atimes); ++$at) {
$rasp .= "<small>".$atimes[$at]."</small>";

}
$rasp .= "</li>";}

$rasp .= "<li class=\"sep_bi\">&#160;</li>
"; 
} 




}}
}}


$rasp .= "</ul></div>";











}













$rasp .= "</td></tr>"; 



 
 
	


			
	 
 

//--------------------








      }
      
    }
   
  } 
  echo "<table id=\"rasp\">".$rasp."</table>";
 
  
  
  
?>
<div style="height:20px;">&#160;</div>
</div>
<?php include("inc/footer.php"); ?>