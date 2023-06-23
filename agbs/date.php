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



$nowwd = explode("|*", $servise[38]);
$pon = $nowwd[0];
$vto = $nowwd[1];
$sre = $nowwd[2];
$che = $nowwd[3];
$pat = $nowwd[4];
$sub = $nowwd[5];
$vos = $nowwd[6];

}

}}


//echo"<h1>$sep_servise</h1>";
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


if ($b_min > 0 || $b_max > 1) {echo "<div id=\"notice\"><ul>";}
if ($b_min > 0) {
echo "<li>Вы можете $form_7 не более $b_min сут.";

 //if ($b_min == 1 || $b_min == 21 || $b_min == 31) {echo "дня";} 
 //else if ($b_min == 2 || $b_min == 3 || $b_min == 4 || $b_min == 22 || $b_min == 23 || $b_min == 24) {echo "дней";} 
 //else {echo "дней";}
 
 echo "</li>";}
if ($b_max > 1) {
echo "<li>Услуга предоставляется не менее чем на $b_max сут.</li>";}
if ($b_min > 0 || $b_max > 1) {echo "</ul></div>";}



$calendar = " 
<table>
    <tr>
        <th colspan=\"7\" class=\"navi\">
		
	<div id=\"calendar_head\">
<div class=\"month_back\"><a href=\"$self?month=".$last_month."&year=".$last_year."&serv=".$sel_serv."&date=".$_GET["date"]."\" class=\"location\" title=\"предыдущий месяц\">&#9668;</a></div>
			
            <div class=\"month_title\">
			".$Month_n[$month]." ".$year."
			</div>
			
<div class=\"month_next\"><a href=\"$self?month=".$next_month."&year=".$next_year."&serv=".$sel_serv."&date=".$_GET["date"]."\" class=\"location\" title=\"следующий месяц\">&#9658;</a></div>
	</div>
			
			
        </th>
    </tr>
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
  


if($interval == '0' && $month >= "0$current_month"+2 || $year > date('Y')) {
	$interval_n = '1';
	$calendar .= "<td class=\"last_day\">
	<div class=\"disabled_date\" title=\"недоступно для $form_3\">
	<span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span>
	</div></td>";
	}  else  {  


if ($date_dis_n[$day] == "0" && $month == "0$current_month"+1) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>";}



//только будни
else if ($calendar_type == 2 && $weekday > 4) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; } 

//только выходные
else if ($calendar_type == 1 && $weekday < 5) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; } 



//отключено
else if ($calendar_type == 3) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; }
//текущая дата
else if ($day == date('d') && $month == $current_month && $year == date('Y') && empty($tda)) {
$calendar .= "
<td class=\"caltoday\"><div class=\"closed_date\" title=\"Дата закрыта\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; }


//---- не рабочие дни недели
else if ($weekday == 0 && $pon == 1) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; }
else if ($weekday == 1 && $vto == 1) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }
else if ($weekday == 2 && $sre == 1) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
"; }
else if ($weekday == 3 && $che == 1) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }
else if ($weekday == 4 && $pat == 1) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }
else if ($weekday == 5 && $sub == 1) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  }
else if ($weekday == 6 && $vos == 1) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>
";  



}  else  {

if ($date_dis[$day] == "0" && $month == $current_month) {
$calendar .= "
<td class=\"last_day\"><div class=\"closed_date\" title=\"Не рабочий день\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>";
}  else  {
 
 if(($month < date('m')) or ($year < date('Y'))){ 
  
    $calendar .= "<td class=\"last_day\"><div class=\"disabled_date\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>";
  
    }  else  {
  
if(($day < date('d')) and ($month == date('m')) and $year == date('Y')) {
	
	$calendar .= "<td class=\"last_day\"><div class=\"disabled_date\"><span".$red."><input type=\"checkbox\" disabled=\"disabled\" />{$day}</span></div></td>";
	}  else  {
	

	


	
	
$nwd = $weekday;  
$s_date = "$day-$month-$year"; 
$calendar .= "
<td class=\"{$class}\">
<div class=\"select_date\">
<span".$red.">";
$time_ay = $day;
$calendar .= "<label id=\"time_tr$time_ay\" title=\"Выбрать дату\">
<input type=\"checkbox\" name=\"select_time[$time_ay]\" value=\"{$s_date}y:\" onclick=\"check_$time_ay()\"";
if ($_POST['select_time']) {
foreach ($_POST['select_time'] as $key=>$value)
if ($key == $s_date && empty($ERROR["select_time"]["text"])) {$calendar .=" checked=\"checked\"";} 
} 
$calendar .=" class=\"chk\" />{$day}</label>";
$calendar .="
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_$time_ay()
function check_$time_ay(){

  var rarr=document.getElementsByName(\"select_time[$time_ay]\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	
	document.getElementById('time_tr$time_ay').classList.add('add_date');
  }
   else{
    // выбран второй radio
	document.getElementById('time_tr$time_ay').classList.remove('add_date');
	document.getElementById('time_tr$time_ay').classList.add('');
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
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $b_idserv, $pay) = explode("**", $data_lt);





if (empty($b_date)) {


$current_service = $_GET["serv"];

if (preg_match(".$current_service.", $data_lt)) {



$time_b = explode("||", $b_time);

foreach ($time_b as $btk=>$bc) {
$bv = $bc;


$br_time = explode("y:", $bv);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) {



if ($s_date == $tr) {$calendar .= "<div class=\"dd\" title=\"занято\"><input type=\"checkbox\" disabled=\"disabled\" />{$day}</div>";} 


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
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $b_idserv, $pay) = explode("**", $data_lt);


if (empty($b_date)) {

$time_b = explode("||", $b_time);

foreach ($time_b as $btk=>$bc) {
$bv = $bc;


$br_time = explode("y:", $bv);
array_pop($br_time);
foreach ($br_time as $rk=>$tr) {



if ($s_date == $tr) {$calendar .= "<div class=\"dd\" title=\"занято\"><input type=\"checkbox\" disabled=\"disabled\" />{$day}</div>";} 


}
}
}//--empty date
else if ($s_date == $b_date) {$calendar .= "<div class=\"dd\" title=\"занято\"><input type=\"checkbox\" disabled=\"disabled\" />{$day}</div>";}



} }




//--
}




$calendar .= "
</span>
</div></td>";

}}}
}
}






    $day++;
    $weekday++;  
 
 
 
 

} 
 
if($weekday != 7) 
  $calendar .= "<td colspan=\"" . (7 - $weekday) . "\"></td>"; 

?>






<?php  
echo $calendar . "</tr></table>";


$Month_nd = array(
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
$nd_m = date('m')+1;
$nd_mn = $month+1;
?>


<?php

if($interval_n == '1') 
{echo "<span class=\"error\" style=\"margin:5px 0 5px 0;\">Этот месяц ещё недоступен для $form_3.</span>";}
else if ($calendar_type == 3) 
{echo  "<span class=\"error\" style=\"margin:5px 0 5px 0;\">Сервис временно отключен.</span>";}
	
 ?>

<? if($interval == '0' && $month == "0$current_month" && $month != 12 && $year == date('Y') && $b_min != 1) { ?>

<span class="occal" id="nextcl" onClick="open_close('ncal')">добавить даты из следующего месяца (<?php echo $Month_nd[$nd_mn]; ?>)</span>
<div style="clear:both;"></div>

<?php 
if ($_POST['select_time']) {
foreach ($_POST['select_time'] as $keynh=>$valuenh) {
//echo $keynh;
if (strpos($keynh, 'n') !== false)
 {$snb = "display:block;";} 
 else 
 {$snb = "display:none;";}
}
}
else 
 {$snb = "display:none;";}
?>

<div id="ncal" style="<?php echo $snb; ?>">
<?php //-------------------------дополнительный месяц
include ('date_next.php');
?>
</div>

<script type="text/javascript">
function open_close(ncal) {
var obj = "";
if (document.getElementById) obj = document.getElementById(ncal).style;
else if (document.all) obj = document.all[ncal];
else if (document.layers) obj = document.layers[ncal];
else return 1;

if (obj.display == "") obj.display = "none";
else if (obj.display != "none") obj.display = "none";
else obj.display = "block";
}

</script>


<?php } else if ($interval == '1' && $month != 12 && $month >= "0$current_month" && $year >= date('Y') && $b_min != 1)  {  ?>

<span class="occal" id="nextcl" onClick="open_close('ncal')">добавить даты из следующего месяца (<?php echo $Month_nd[$nd_mn]; ?>)</span>
<div style="clear:both;"></div>



<?php 
if ($_POST['select_time']) {
foreach ($_POST['select_time'] as $keynh=>$valuenh) {
//echo $keynh;
if (strpos($keynh, 'n') !== false)
 {$snb = "display:block;";} 
 else 
 {$snb = "display:none;";}
}
}
else 
 {$snb = "display:none;";}
?>

<div id="ncal" style="<?php echo $snb; ?>">
<?php //-------------------------дополнительный месяц
include ('date_next.php');
?>
</div>



<script type="text/javascript">
function open_close(ncal) {
var obj = "";
if (document.getElementById) obj = document.getElementById(ncal).style;
else if (document.all) obj = document.all[ncal];
else if (document.layers) obj = document.layers[ncal];
else return 1;

if (obj.display == "") obj.display = "none";
else if (obj.display != "none") obj.display = "none";
else obj.display = "block";
}

</script>

<?php } else { echo""; } ?>






<?php
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

if($_POST["select_service"]==$servise[32]) {

$allspots = $servise[89];

$spotstop = $servise[90];

$price_d = $servise[25];
$no_horus = $servise[30];
$cur = $servise[26];
$currensy = array(
"RUB" => "рублей",
"EUR" => "евро",
"USD" => "долларов");
}

}}

 ?>



<?php if ($no_horus == 1) { ?>
 
<script language="Javascript" type="text/javascript">
function count_checkboxes() 
{ 
 var spots=document.getElementById("spt").value;
 var els=document.getElementsByTagName('input'),cnt=0; 
 for (var i=0;i<els.length;i++) 
  if (els[i].getAttribute('type')=='checkbox'&&els[i].checked) cnt++; 
  document.getElementById("total_price").innerHTML=<?php echo $price_d; ?>*spots;
} 
</script>

<?php } else {  ?>



<script language="Javascript" type="text/javascript">
function count_checkboxes() 
{ 
 var spots=document.getElementById("spt").value;
 var els=document.getElementsByTagName('input'),cnt=0; 
 for (var i=0;i<els.length;i++) 
  if (els[i].getAttribute('type')=='checkbox'&&els[i].checked) cnt++; 
  document.getElementById("total_price").innerHTML=<?php echo $price_d; ?>*spots*cnt+'';
} 
</script>





<?php } ?>
<div style="clear:both;"></div>

<?php
if (!empty($allspots) && $allspots > 0){ 
if (empty($spots) || $spots==0) {$spots='1';} 
else if ($spotstop > 0) {$spots = $spotstop;}
else if ($spotstop == 0) {$spotstop = '1';}

//if ($spotstop == 0) {$spotstop = $allspots;}
echo"<div style=\"margin-top:5px;\">
Количество мест:
<input type=\"number\" min=\"".$spotstop."\" max=\"".$allspots."\" name=\"spots\" value=\"".$spots."\" id=\"spt\" style=\"width:40px; padding:5px;\" /></div>";} else {echo '<input type="hidden" name="spots" value="1" id="spt" />';}

if ($spotstop > 1) {echo '<small>(минимум мест: '.$spotstop.')</small><div class="clear"></div>';}
?>



<div id="price">
<p><strong>Стоимость:</strong>  <!-- <?php echo $currensy[$cur]; ?> -->
<?php 
     if ($price_d == '-') {echo 'цена варьируется';} 
else if ($price_d == '0') {echo 'бесплатно';} 
else if ($no_horus == 1) {echo"<span id=\"total_price\">0</span> $currensy[$cur] (фиксированная цена)";}

else {echo"<span id=\"total_price\">0</span> $currensy[$cur]";} ?>
</p></div>

<input type="hidden" name="price" value="<?php echo $price; ?>" />



 

<?php if($b_min != 0) { ?>
<script type="text/javascript">    
        $(function() {
            $('.chk').click(function() {
                
                var len = $('.chk:checked').length;
                
                if (len == <?php echo $b_min; ?>) 
                    $('.chk:not(:checked)').attr('disabled','disabled');
                else
                    $('.chk:not(:checked)').removeAttr('disabled');
            });
        });
        
    </script>
<?php } ?>