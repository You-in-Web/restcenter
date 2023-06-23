<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим



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

$allspots = $servise[89];

$spotstop = $servise[90];

$sep_servise = $servise[35];

}

}}

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
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin, $idord, $confirm, $spotsb) = explode("**", $data_lt);
$current_service = $_POST["select_service"];
$current_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";
if (preg_match(".$current_date.", $data_lt) && (preg_match(".$current_service.", $data_lt))) {
$b_sp .= $spotsb;
$time_b = explode("||", $b_time);
foreach ($time_b as $key=>$value) { 
$data_tb .= $value;
}
$heave_date .= $b_date;
}
}
} 
//--------------------------- Если услуги в очередь
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
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin, $idord, $confirm, $spotsb) = explode("**", $data_lt);

$current_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";
if (preg_match(".$current_date.", $data_lt)) {
$b_sp .= $spotsb;
$time_b = explode("||", $b_time);
foreach ($time_b as $key=>$value) { 
$data_tb .= $value;
}
$heave_date .= $b_date;
}
}
} }
//---------------------------







$time_c = explode(":", $data_tb);
//$time_c //--массив с уже забронированным временем




$file_name = "data/services.dat"; 
define('FILENAME_SER_TM', $file_name);
if (!file_get_contents(FILENAME_SER_TM))
{echo "Пусто";} else {
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 
if (!empty($lines[$a])) {
$data = $lines[$a];
$servise = explode("::", $data);




if(@$_POST["select_service"]==$servise[32]){

if (!empty($servise[33])){
$lost_hr = $servise[33];}
else{
$lost_hr = '0';
}
//echo $lost_hr; 



$count = sizeof($servise) ; for ($t = 0 ; $t < $count ; ++$t) { 
if (strpos($servise[$t], 'y') !== false) {
$time = $servise[$t];
$time = str_replace('y', '', $time);
$time_next = $time+1;




$time_a = array(
$servise[1],
$servise[2],
$servise[3],
$servise[4],
$servise[5],
$servise[6],
$servise[7],
$servise[8],
$servise[9],
$servise[10],
$servise[11],
$servise[12],
$servise[13],
$servise[14],
$servise[15],
$servise[16],
$servise[17],
$servise[18],
$servise[19],
$servise[20],
$servise[21],
$servise[22],
$servise[23],
$servise[24],
);

// $time_a; //--массив со всем временем








if(@$_POST["select_service"]==$servise[32]){


  } 
 }
}


if ($b_min > 0 || $b_max > 1) {echo "<div id=\"notice\"><ul>";}
if ($b_min > 0) {
echo "<li>Вы можете $form_7 не более $b_min час.</li>";}
if ($b_max > 1) {
echo "<li>Услуга предоставляется не менее чем на $b_max час.</li>";}
if ($b_min > 0 || $b_max > 1) {echo "</ul></div>";}

//--
if (!empty ($heave_date)) {


if (empty ($time_a)) {echo "<ul class=\"time\"><li class=\"booking_time\">Нет доступного времени</li></ul>";} else {












echo "<div id=\"col_time\">";



echo "<ul class=\"time\">"; 
   
$select_date = "".$_GET["day"]."".$_GET["month"]."".$_GET["year"]."";




foreach ($time_c as $key=>$value)
if (strpos($value, 'y') !== false) {
$time_tb .= $value;
}
$tb = explode("y", $time_tb); //--массив с забронированым временем
array_pop($tb);









foreach ($time_a as $key=>$value) 
if (strpos($value, 'y') !== false) {
$time_ta .= $value;
}
$ta = explode("y", $time_ta);
array_pop($ta);
foreach ($ta as $key=>$value) {
$time_ay = $value;




$chrc = date("G");

if (strpos($horus, '+') !== false && !empty($horus)) {
$horusc = str_replace('+', '', $horus);
$this_horus = $chrc+$horusc;

}

else if (strpos($horus, '-') !== false && !empty($horus)) {
$horusc = str_replace('-', '', $horus);
$this_horus = $chrc-$horusc;

}

else if (empty($horus) || $horus = 0) 
{$this_horus = $chrc;

}



$today_date = date("dnY");


$nexttx = $time_ay+1;
$nextt = mb_strlen($nexttx, 'utf8'); 
if ($nextt == '1')
{$nexttay = "0".$nexttx;} else {$nexttay = $nexttx;}


$ind_ot = 39+$time_ay;
$ind_do = 63+$time_ay;

if (empty($servise[$ind_ot])) { $mot = "00";}
else {$mot = $servise[$ind_ot];}


if (empty($servise[$ind_do])) { $mdo = "00";}
else {$mdo = $servise[$ind_do];}

// и тут Начинается КАПЕЦ


if ($time_ay == $tb[0]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";} 

else if ($time_ay == $tb[1]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";} 

else if ($time_ay == $tb[2]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[3]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[4]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[5]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[6]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[7]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[8]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[9]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[10]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[11]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[12]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[13]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[14]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[15]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[16]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[17]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[18]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[19]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[20]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[21]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[22]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}

else if ($time_ay == $tb[23]) {
echo "<li class=\"booking_time\"><input type=\"checkbox\" disabled /><span title=\"занято\">$time_ay:$mot - $nexttay:$mdo</span> <!---занято---></li>";}


//-----------капец закончился









else if ($today_date == $select_date && $time_ay < $this_horus) {
echo "<li class=\"lost_time\"><input type=\"checkbox\" disabled /><span title=\"истекло\">$time_ay:$mot - $nexttay:$mdo</span></li>";} 

else if ($today_date == $select_date && $time_ay < $this_horus+$lost_hr) {
echo "<li class=\"lost_time\"><input type=\"checkbox\" disabled /><span title=\"перерыв\">$time_ay:$mot - $nexttay:$mdo</span></li>";} 


else {
echo "
<li id=\"time_tr$time_ay\"><label title=\"Выбрать время\"><input type=\"checkbox\" name=\"select_time[$time_ay]\" value=\"".$time_ay."y:\" onclick=\"check_$time_ay()\"";
if ($_POST['select_time']) {
 foreach ($_POST['select_time'] as $key=>$value)
 if ($key == $time_ay) {echo " checked=\"checked\"";} } echo " class=\"chk\" />$time_ay:$mot - $nexttay:$mdo</label></li>";
 

 echo "
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_$time_ay()
function check_$time_ay(){

  var rarr=document.getElementsByName(\"select_time[$time_ay]\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	
	document.getElementById('time_tr$time_ay').classList.add('add_time');
  }
   else{
    // выбран второй radio
	document.getElementById('time_tr$time_ay').classList.remove('add_time');
	document.getElementById('time_tr$time_ay').classList.add('');
  }   
  
 }
 </script>";
 
 
} 


} } 



echo "</ul></div>"; 

} else {

echo "<div id=\"col_time\"><ul class=\"time\">"; 
$select_date = "".$_GET["day"]."".$_GET["month"]."".$_GET["year"]."";

if (empty ($time_a)) {echo "<li class=\"booking_time\">Нет доступного времени.</li>";} else {
foreach ($time_a as $key=>$value) { 
if (strpos($value, 'y') !== false) {
$time_fy = $value;
$time_fy = str_replace('y', '', $time_fy);

$nexttxf = $time_fy+1;
$nexttf = mb_strlen($nexttxf, 'utf8'); 
if ($nexttf == '1')
{$nexttfy = "0".$nexttxf;} else {$nexttfy = $nexttxf;}



$chrc = date("G");

if (strpos($horus, '+') !== false && !empty($horus)) {
$horusc = str_replace('+', '', $horus);
$this_horus = $chrc+$horusc;

}

else if (strpos($horus, '-') !== false && !empty($horus)) {
$horusc = str_replace('-', '', $horus);
$this_horus = $chrc-$horusc;

}

else if (empty($horus) || $horus = 0) 
{$this_horus = $chrc;

}



$today_date = date("dnY");

$ind_otf = 39+$time_fy;
$ind_dof = 63+$time_fy;

if (empty($servise[$ind_otf])) { $motf = "00";}
else {$motf = $servise[$ind_otf];}


if (empty($servise[$ind_dof])) { $mdof = "00";}
else {$mdof = $servise[$ind_dof];}


if ($today_date == $select_date && $time_fy < $this_horus) {
echo "<li class=\"lost_time\"><input type=\"checkbox\" disabled /><span title=\"истекло\">$time_fy:$motf - $nexttfy:$mdof</span></li>";} 

else if ($today_date == $select_date && $time_fy < $this_horus+$lost_hr) {
echo "<li class=\"lost_time\"><input type=\"checkbox\" disabled /><span title=\"перерыв\">$time_fy:$motf - $nexttfy:$mdof</span></li>";} 

else {
echo "
<li id=\"time_tr$time_fy\"><label title=\"Выбрать время\"><input type=\"checkbox\" name=\"select_time[$time_fy]\" value=\"".$time_fy."y:\" onclick=\"check_$time_fy()\"";
if ($_POST['select_time']) {
 foreach ($_POST['select_time'] as $key=>$value)
 if ($key == $time_fy) {echo " checked=\"checked\"";} } echo " class=\"chk\" />$time_fy:$motf - $nexttfy:$mdof</label></li>";
 
 
 echo "
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_$time_fy() 

function check_$time_fy()

{

  var rarr=document.getElementsByName(\"select_time[$time_fy]\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	
	document.getElementById('time_tr$time_fy').classList.add('add_time');
  }
   else{
    // выбран второй radio
	document.getElementById('time_tr$time_fy').classList.remove('add_time');
	document.getElementById('time_tr$time_fy').classList.add('');
  }   
  
 }

 </script>";
 
 
} }
}
}
echo "</ul></div>";  }





$cur = $servise[26];
$currensy = array(
"RUB" => "рублей",
"EUR" => "евро",
"USD" => "долларов");
 ?>



<?php if ($servise[30] == 1) { ?>
 
<script language="Javascript" type="text/javascript">
function count_checkboxes() 
{ 
 var spots=document.getElementById("spt").value;
 var els=document.getElementsByTagName('input'),cnt=0; 
 for (var i=0;i<els.length;i++) 
  if (els[i].getAttribute('type')=='checkbox'&&els[i].checked) cnt++; 
  document.getElementById("total_price").innerHTML=<?php echo $servise[25]; ?>*spots;
} 
</script>

<?php } else { ?>

<script language="Javascript" type="text/javascript">
function count_checkboxes() 
{ 
 var spots=document.getElementById("spt").value;
 var els=document.getElementsByTagName('input'),cnt=0; 
 for (var i=0;i<els.length;i++) 
  if (els[i].getAttribute('type')=='checkbox'&&els[i].checked) cnt++; 
  document.getElementById("total_price").innerHTML=<?php echo $servise[25]; ?>*spots*cnt+'';
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
<p><strong>Стоимость:</strong>  <!---<?php echo $currensy[$cur]; ?>--->
<?php 
if ($servise[25] == '-') {echo"цена варьируется";}
else if ($servise[25] == '0') {echo 'бесплатно';} 
else if ($servise[30] == 1) {echo"<span id=\"total_price\">0</span> $currensy[$cur] (не почасовая оплата)";}

else {echo"<span id=\"total_price\">0</span> $currensy[$cur]";} ?>
</p></div>
</div>



<input type="hidden" name="price" value="<?php echo $price; ?>" />

<?php
} } 
}
}
 
?>
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