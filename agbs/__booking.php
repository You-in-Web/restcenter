<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим

session_start();
include("inc/header.php");

$max_phone_fi = '2'; // Максимальное количество знаков в первом поле номера телефона (вместе с "+")

//ПОДТВЕРЖДЕНИЕ===================================================================================

if (!empty($_GET['order'])) {

$curr_d = date('d');
$curr_m = date('m');
$curr_y = date('Y');


$idconf = $_GET['order'];

$confirm = 'yes_mail';

$file_name = "data/booking.dat";

$file = fopen($file_name,"r+") ; 
    flock($file,LOCK_EX) ; 
    @$dlines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;

for ( $adl = count($dlines) - 1; $adl >=0 ; $adl--)  {

if (!empty($dlines[$adl])) {

$data = $dlines[$adl];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin, $idord, $confirmcn, $spotscm) = explode("**", $data);

	

//echo "$lostdd=$srdatem[0] || $curr_m=$srdatem[1] || $curr_y=$srdatem[2]";

//   preg_match("/".$lostdd."-".$curr_m."-".$curr_y."/i", $b_date) || 
//   $curr_d > $srdatem[0] && $curr_m >= $srdatem[1] && $curr_y >= $srdatem[2]

//echo "$idord || $idconf<br/>";


//if (!preg_match("/".$idconf."/i", $idord) && $idconf != $idord) {echo"<div class=\"messwa\">Бронь не найдена. Возможно она просрочена или снята администратором.</div><a href=\"http://".$_SERVER['SERVER_NAME']."\">&#171; На главную</a>
//</div></body></html>"; exit;}

if (preg_match("/".$idconf."/i", $idord)) {




//if ($b_date != $curr_d."-".$curr_m."-".$curr_y) 
//{$timemin = str_replace('|,|', '', $timemin);
//echo"<div class=\"messwa\">Уважаемый(ая) <span style=\"font-weight:bold;\">".$b_name."</span>, бронь необходимо подтвердить непосредственно в забронированный день ($b_date). Сегодня ".$curr_d."-".$curr_m."-".$curr_y."</div>
//<a href=\"http://".$_SERVER['SERVER_NAME']."\">&#171; На главную</a>
//</div></body></html>"; exit; }



	
if ($confirmcn == 'yes' || $confirmcn == 'yes_mail' ) {

$timemin = str_replace('|,|', '<br />', $timemin);
$b_time = str_replace('y:', '<br />', $b_time);
$b_time = str_replace('||', '', $b_time);

echo"<div class=\"mess\"><span style=\"font-weight:bold;\">".$b_name."</span>, Ваш заказ уже был подтверждён.</div>

<div id=\"sent\" style=\"margin:0 auto; width:800px;\">
<table width=\"100%\">

<tr>
<td valign=\"top\" style=\"padding:10px;\">Услуга</td>
<td style=\"padding:10px;\"><b>$b_service</b></td>
</tr>";

if (empty($b_date)) {
echo" <tr>
<td style=\"padding:10px;\" valign=\"top\">Даты</td>
<td style=\"padding:10px;\"><b>$b_time</b></td>
</tr>";}
else {
echo" <tr>
<td style=\"padding:10px;\" valign=\"top\">Дата</td>
<td style=\"padding:10px;\"><b>$b_date</b></td>
</tr>";
echo "<tr>
<td style=\"padding:10px;\" valign=\"top\">Время</td>
<td style=\"padding:10px;\"><b>$timemin</b></td>
</tr>";

echo "<tr>
<td style=\"padding:10px;\" valign=\"top\">Сумма</td>
<td style=\"padding:10px;\"><b>$b_price</b><br />";
if($spotscm > 1) {echo "<small>(кол-во мест: $spotscm)</small>";}
echo"
</td>
</tr>";
}




echo"
</table>
</div>

<a href=\"http://".$_SERVER['SERVER_NAME']."\">&#171; На главную</a>
</div></body></html>"; exit;

} else {
$timemin = str_replace('|,|', '<br />', $timemin);
$b_time = str_replace('y:', '<br />', $b_time);
$b_time = str_replace('||', '', $b_time);
echo "<div class=\"mess\"><span style=\"font-weight:bold;\">".$b_name."</span>, Ваш заказ успешно подтверждён!</div>
<div id=\"sent\" style=\"margin:0 auto; width:800px;\">
<table width=\"100%\">

<tr>
<td style=\"padding:10px;\">Услуга</td>
<td style=\"padding:10px;\"><b>$b_service</b></td>
</tr>";

if (empty($b_date)) {
echo" <tr>
<td style=\"padding:10px;\" valign=\"top\">Даты</td>
<td style=\"padding:10px;\"><b>$b_time</b></td>
</tr>";}
else {
echo" <tr>
<td style=\"padding:10px;\" valign=\"top\">Дата</td>
<td style=\"padding:10px;\"><b>$b_date</b></td>
</tr>";
echo "<tr>
<td style=\"padding:10px;\" valign=\"top\">Время</td>
<td style=\"padding:10px;\"><b>$timemin</b></td>
</tr>";
}

echo "<tr>
<td style=\"padding:10px;\" valign=\"top\">Сумма</td>
<td style=\"padding:10px;\"><b>$b_price</b><br />";
if($spotscm > 1) {echo "<small>(кол-во мест: $spotscm)</small>";}
echo"
</td>
</tr>";

echo"
<tr>
<td colspan=\"2\" style=\"padding:10px;\">Спасибо.</td>
</tr>

</table>
</div>
 <br />

 <script type=\"text/javascript\">
function timer(){
 var obj=document.getElementById('timer_inp');
 obj.innerHTML--;
 if(obj.innerHTML==0){
 location = \"http://".$_SERVER['SERVER_NAME']."\"
 setTimeout(function(){},1500);}
 else{setTimeout(timer,1500);}
}
setTimeout(timer,1500);
</script>


   
   
   <small>Автоматический переход на главную сайта через <span id=\"timer_inp\">15</span> сек.</small><br />
   <a href=\"http://".$_SERVER['SERVER_NAME']."\">&#171; На главную</a>

<noscript><meta http-equiv=\"refresh\" content=\"15; url=".$_SERVER['REQUEST_URI']."\"></noscript>
";





//==============================================================Для перезаписи	
	
//if (isSet($_GET["confirm"]) == true) {	
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 

$nl = $adl;


$data = $lines[$nl];
list($b_serviced, $b_dated, $b_timed, $b_priced, $b_named, $b_phoned, $b_maild, $b_commentd, $add_dated, $weekdayd, $idservd, $payd, $timemind, $idordd, $confirmd, $spotscm) = explode("**", $data);


$line_data_r = "$b_serviced**$b_dated**$b_timed**$b_priced**$b_named**$b_phoned**$b_maild**$b_commentd**$add_dated**$weekdayd**$idservd**$payd**$timemind**$idordd**$confirm**$spotscm**";





//=====================================================перезапись строки

	
//if (array_key_exists('confirm_button'.$_GET['line_confirm'].'',$_GET)){

if (isSet($_GET["order"]) == true) {	

$filename = "data/booking.dat";
$contents = file_get_contents($filename);
 
if ($contents) {
    $contents = explode("\n", $contents);
   
    if (isset($contents[$nl])) {
        $contents[$nl] = $line_data_r;
       
        if (is_writable($filename)) {
            if (!$handle = fopen($filename, 'wb')) {
                echo "Не могу открыть файл ($filename)";
                exit;
            }
                   
            if (fwrite($handle, implode("\n", $contents)) === FALSE) {
                echo "Не могу произвести запись в файл ($filename)";
                exit;
            }
           
            fclose($handle);
			





//=============В ИСТОРИЮ
if (!empty($_GET['order']) && empty($confirmd)){
//-------------------------history_orders------------------------


class CSV {

    private $_csv_file = null;

    /**
     * @param string $csv_file  - путь до csv-файла
     */
    public function __construct($csv_file) {
        if (file_exists($csv_file)) { //Если файл существует
            $this->_csv_file = $csv_file; //Записываем путь к файлу в переменную
        }
        else throw new Exception("Файл \"$csv_file\" не найден"); //Если файл не найден то вызываем исключение
    }

    public function setCSV(Array $csv) {
        $handle = fopen($this->_csv_file, "a"); //Открываем csv для до-записи, если указать w, то  ифномация которая была в csv будет затерта

        foreach ($csv as $value) { //Проходим массив
            fputcsv($handle, explode(";", $value), ";"); //Записываем, 3-ий параметр - разделитель поля
        }
        fclose($handle); //Закрываем
    }

    /**
     * Метод для чтения из csv-файла. Возвращает массив с данными из csv
     * @return array;
     */
    public function getCSV() {
        $handle = fopen($this->_csv_file, "r"); //Открываем csv для чтения

        $array_line_full = array(); //Массив будет хранить данные из csv
        while (($line = fgetcsv($handle, 0, ";")) !== FALSE) { //Проходим весь csv-файл, и читаем построчно. 3-ий параметр разделитель поля
            $array_line_full[] = $line; //Записываем строчки в массив
        }
        fclose($handle); //Закрываем файл
        return $array_line_full; //Возвращаем прочтенные данные
    }

} 

try {

$csv = new CSV("data/hystory_orders.csv"); //Открываем наш csv

$timemind = str_replace('|,|', '/ ', $timemind);

if (empty($b_dated) || $b_dated == '0'){
$b_timed = str_replace('y:', '', $b_timed);
$b_timed = str_replace('||', '/ ', $b_timed);
$arr = array("$b_serviced;$b_dated;$b_timed;$b_priced;$b_named;$b_phoned;$b_maild;$b_commentd;$add_dated;$idordd;$confirm;$spotscm;");
$csv->setCSV($arr);} 
else {
$timemind = str_replace('|,|', '/ ', $timemind);
$arr = array("$b_serviced;$b_dated;$timemind;$b_priced;$b_named;$b_phoned;$b_maild;$b_commentd;$add_dated;$idordd;$confirm;$spotscm;");
$csv->setCSV($arr);}



}

catch (Exception $e) { //Если csv файл не существует, выводим сообщение
    echo "Ошибка записи в историю: " . $e->getMessage();}

} //-------------------------end_history_orders--------------------




			
			
			
	
   // echo "<div class=\"done\">Бронь подтверждена!</div>";
	
	
	
	echo""; exit;
           	   
		   
        } else {
            echo "Файл недоступен для записи";
            exit;
        }
    } else {
        echo "Строка не найдена";
        exit;
    }
 
} else {
    echo "Файл пуст";
    exit;
}





//} 
}//==============================================/перезапись
	
   


}	
	
	
} 



 
 } 

}	




}  else { // Конец подтверждения===================================================================================














$_POST["select_service"] = $_GET["serv"];

require_once("data/config.php");

if ($formul == "1") {
$form_1 = 'Забронировать';
$form_2 = 'бронирование';
$form_3 = 'бронирования';
$form_4 = 'забронировано';
$form_5 = 'Забронированое';
$form_6 = 'брони';
$form_7 = 'забронировать';
$form_8 = 'Забронированые';
$form_9 = 'забронирована';
} else {
$form_1 = 'Заказать';
$form_2 = 'заказ';
$form_3 = 'заказов';
$form_4 = 'заказано';
$form_5 = 'Занятое';
$form_6 = 'заказа';
$form_7 = 'занять';
$form_8 = 'Занятые';
$form_9 = 'заказана';
}
$t_horus = date("H");
include("calendar.php"); 


 
// echo $_POST["select_service"];
 
unset($ERROR); //на всякий пожарный, чтоб лишнего не выплыло


$client_name=trim(htmlspecialchars($_POST["client_name"]));
if(!$_POST['client_name']){
$ERROR["client_name"]["text"] = "Введите имя.";
} else { if((strlen($client_name)<3) || (preg_match("/[^a-zA-Z0-9а-яА-Яё ]/u", $_POST['client_name']))){
$ERROR["client_name"]["text"] = "Имя введено не корректно. Не допустимые символы.";
} }

$client_email=trim(htmlspecialchars($_POST["client_email"]));
if(!$_POST['client_email']){
$ERROR["client_email"]["text"] = "Введите E-mail.";
} else {


if(!preg_match('/.+@.+\..+/i', $_POST['client_email']))
{
$ERROR["client_email"]["text"] = "E-mail введён не корректно.";
} }





$client_phone0=trim(htmlspecialchars($_POST["client_phone0"]));
if(!$_POST['client_phone0'] || $_POST['client_phone0'] == '+'){
$ERROR["client_phone0"]["text"] = "Укажите контактный телефон (Не заполнено первое поле).";
} else { if((strlen($client_phone0)<2) || (preg_match("/[^0-9+]/u", $_POST['client_phone0']))){
$ERROR["client_phone0"]["text"] = "Номер телефона введён не корректно (Ошибка в перврм поле).";
} }

$client_phone1=trim(htmlspecialchars($_POST["client_phone1"]));
if(!$_POST['client_phone1']){
$ERROR["client_phone1"]["text"] = "Укажите контактный телефон (Не заполнено второе поле).";
} else { if((strlen($client_phone1)<3) || (!preg_match("/^[0-9 ()-]{1,3}$/u", $_POST['client_phone1']))){
$ERROR["client_phone1"]["text"] = "Номер телефона введён не корректно (Ошибка во втором поле).";
} }

$client_phone2=trim(htmlspecialchars($_POST["client_phone2"]));
if(!$_POST['client_phone2']){
$ERROR["client_phone2"]["text"] = "Укажите контактный телефон (Не заполнено третье поле).";
} else { if((strlen($client_phone2)<3) || (!preg_match("/^[0-9 ()-]{1,3}$/u", $_POST['client_phone2']))){
$ERROR["client_phone2"]["text"] = "Номер телефона введён не корректно (Ошибка в третьем поле).";
} }

$client_phone3=trim(htmlspecialchars($_POST["client_phone3"]));
if(!$_POST['client_phone3']){
$ERROR["client_phone3"]["text"] = "Укажите контактный телефон (Не заполнено четвёртое поле).";
} else { if((strlen($client_phone3)<2) || (!preg_match("/^[0-9 ()-]{1,2}$/u", $_POST['client_phone3']))){
$ERROR["client_phone3"]["text"] = "Номер телефона введён не корректно (Ошибка в четвёртом поле).";
} }

$client_phone4=trim(htmlspecialchars($_POST["client_phone4"]));
if(!$_POST['client_phone4']){
$ERROR["client_phone4"]["text"] = "Укажите контактный телефон (Не заполнено последнее поле).";
} else { if((strlen($client_phone4)<2) || (!preg_match("/^[0-9 ()-]{1,2}$/u", $_POST['client_phone4']))){
$ERROR["client_phone4"]["text"] = "Номер телефона введён не корректно (Ошибка в последнем поле).";
} }



$_POST["client_comment"] = str_replace(array('|', '*', '**', ';'), '', trim($_POST["client_comment"]));
$_POST["client_comment"] = str_replace(array('y'), 'у', trim($_POST["client_comment"]));
$_POST["client_comment"] = str_replace(array('\"', '"'), '', $_POST["client_comment"]); 
$_POST["client_comment"] = preg_replace("|[\r\n]+|", " ", $_POST["client_comment"]); 
$_POST["client_comment"] = preg_replace("|[\n]+|", " ", $_POST["client_comment"]); 
$client_comment=trim(htmlspecialchars($_POST["client_comment"]));



$select_service=trim(htmlspecialchars($_POST["select_service"]));
if(!$_POST['select_service']){
$ERROR["select_service"]["text"] = "Выберите услугу.<br />";}



$select_time = $_POST['select_time'];
if(!$_POST['select_time']){

if($_GET['date'] == 1) {$ERROR["select_time"]["text"] = "Выберите даты.";}
else {$ERROR["select_time"]["text"] = "Выберите время.";}

}
if (empty($_POST['spots']) || $_POST['spots'] <= 0) {
$spots = 1;
} else {
$spots = $_POST['spots'];
}

if($_GET['date'] != 1) {
$sel_d = $_GET["day"];
$sel_m = $_GET["month"];
$sel_y = $_GET["year"];

$cur_d = date("j");
$cur_m = date("n");
$cur_y = date("Y");


if ($sel_d < $cur_d && $sel_m <= $cur_m && $sel_y <= $cur_y) {$ERROR["select_time"]["text"] = "Дата истекла.";} 
else if ($sel_m < $cur_m || $sel_y < $cur_y) {$ERROR["select_time"]["text"] = "Дата истекла.";} 
else if ($sel_y > $cur_y) {$ERROR["select_time"]["text"] = "$sel_y год ещё не наступил.";} 
}


  
  
//---------Если время уже забронированно а пользователь ещё этого не видит (на раздельные услуги)
if ($sep_servise = "1") {
if($_POST['select_time']){ 
$file_name_w = "data/booking.dat"; 
define('FILE_NAME_W', $file_name_w);
$file_w = fopen($file_name_w,"r") ; 
flock($file_w,LOCK_SH) ; 
@$lines_w = preg_split("~\r*?\n+\r*?~",fread($file_w,filesize($file_name_w))) ;
flock($file_w,LOCK_UN) ; 
fclose($file_w) ; 
$count_w = sizeof($lines_w) ; for ($lw = 0 ; $lw < $count_w ; ++$lw) { 
if (!empty($lines_w[$lw])) {
$data_w = $lines_w[$lw];
list($b_servicew, $b_datew, $b_timew, $b_pricew, $b_namew, $b_phonew, $b_mailw, $b_commentw, $add_datew, $b_idservw) = explode("**", $data_w);

 //---ex

if($_GET['date'] == 1)
{
$current_service = $_GET["serv"];
if (preg_match(".$current_service.", $data_w)) {
$time_bw = explode("||", $b_timew);

}
} else { 
$current_service = $_GET["serv"];
$current_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";
if (preg_match(".$current_date.", $data_w) && (preg_match(".$current_service.", $data_w))) {
$time_bw = explode("||", $b_timew);

}
}


}
}

if (!empty($time_bw)) {
$select_time = $_POST['select_time'];
$wait_t = array_intersect($time_bw,$select_time); 
foreach ($wait_t as $nom=>$wt) {





if($_GET['date'] == 1) {$ERROR["select_time"]["text"] = "Эти даты уже заняты. Пожалуйста выберите другие.";}
else {$ERROR["select_time"]["text"] = "Это время уже $form_4. Пожалуйста выберите другое.";}

} }
}
}
//----------   
  
  
  
  
else {  
  
  
  


//---------Если время уже забронированно а пользователь ещё этого не видит (опаздун)
if($_POST['select_time']){ 
$file_name_w = "data/booking.dat"; 
define('FILE_NAME_W', $file_name_w);
$file_w = fopen($file_name_w,"r") ; 
flock($file_w,LOCK_SH) ; 
@$lines_w = preg_split("~\r*?\n+\r*?~",fread($file_w,filesize($file_name_w))) ;
flock($file_w,LOCK_UN) ; 
fclose($file_w) ; 
$count_w = sizeof($lines_w) ; for ($lw = 0 ; $lw < $count_w ; ++$lw) { 
if (!empty($lines_w[$lw])) {
$data_w = $lines_w[$lw];
list($b_servicew, $b_datew, $b_timew, $b_pricew, $b_namew, $b_phonew, $b_mailw, $b_commentw, $add_datew, $b_idservw) = explode("**", $data_w);


if($_GET['date'] == 1)
{
$current_service = $_GET["serv"];
if (preg_match(".$current_service.", $data_w)) {
$time_bw = explode("||", $b_timew);}
} else { 
$current_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";
if (preg_match(".$current_date.", $data_w)) {
$time_bw = explode("||", $b_timew);

}
}


}
}

if (!empty($time_bw)) {
$select_time = $_POST['select_time'];
$wait_t = array_intersect($time_bw,$select_time); 
foreach ($wait_t as $nom=>$wt) {


if($_GET['date'] == 1) {$ERROR["select_time"]["text"] = "Эти даты уже заняты. Пожалуйста выберите другие.";}
else {$ERROR["select_time"]["text"] = "Это время уже $form_4. Пожалуйста выберите другое.";}

} }
}
}
//---------- 



  
  
  
if(isset($_POST['select_time'])){
$N = count($select_time); 
foreach ($_POST['select_time'] as $key=>$value);
$select_time = implode("||", $_POST['select_time']);
}

$price = $_POST["price"];
$file_name = "data/services.dat"; 
//define('FILENAME_ONE', $file_name);
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 
if (!empty($lines[$a])) {
$data = $lines[$a];
$servise = explode("::", $data);

if($_POST["select_service"] == $servise[32] && $servise[30] == 1){
$price = $servise[25]*$spots;
$cur = $servise[26];
$b_min = $servise[27];
$b_max = $servise[28];
$s_serv = $servise[0];
$mpay = $servise[37];
$freech = $servise[25];
}

else if($_POST["select_service"] == $servise[32]){
$price = $N*$servise[25]*$spots;
$cur = $servise[26];
$b_min = $servise[27];
$b_max = $servise[28];
$s_serv = $servise[0];
$mpay = $servise[37];
$freech = $servise[25];
}

}
}



if($_GET['date'] == 1)
{ $ed = 'сут.'; } else { $ed = 'час.'; }

if ($N > 0) {
if ($N > $b_min && $b_min !=0) {$ERROR["select_time"]["text"] = "Можно занять не более $b_min $ed";} 
if ($N < $b_max && $b_max !=0) {$ERROR["select_time"]["text"] = "Выберите не менее $b_max $ed";} 
 }
 





if ($acaptcha == '1') {
if(count($_POST)>0 && isset($_SESSION['captcha_keystring']) && strtolower($_SESSION['captcha_keystring']) != strtolower($_POST['keystring'])) {$ERROR["keystring"]["text"] = "Не верный код с картинки";} 
}



?> 

<?php if ($steps == '1') { include("steps.php"); } ?>

<div id="booking_form">

<?php if (!empty($_GET["day"])&&!empty($_GET["month"])&&!empty($_GET["year"]) || $_GET["date"] == '1')  { ?>

<?php if(is_array($ERROR)){ ?>

<?php  
$wk = $_GET["weekday"];
?>

<?php if($_POST["select_service"]){ 
echo "<p class=\"date_p\">";
if ($_GET["date"] == '1') 
{ echo "<span>".$s_serv."</span>
<a href=\"index.php\">список услуг</a><span class=\"ugol\"></span>";
} else {
echo "<span>".$s_serv."</span> на <span>".$_GET["day"]." ".$Month_r[$month]." ".$_GET["year"]." (".$weekday_n[$wk].")</span>
<a href=\"sel_date.php?select_service=".$_POST["select_service"]."\">другая дата</a><span class=\"ugol\"></span>
</p>";}
}
?>



<?php } ?>


<?
$file_name = "data/services.dat"; 
define('FILENAME_TWO', $file_name);
if (!file_get_contents(FILENAME_TWO))
{echo "База услуг пуста";} else {
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
"RUB" => "рублей",
"EUR" => "евро",
"USD" => "долларов");
if(@$_POST["select_service"] == $servise[32]){

$idserv = $servise[32];
 
if (array_key_exists('submit',$_POST)){
?>

<?php 

if ($_POST['pay'] == '1' && !is_array($ERROR)) {
if($paya == '1') { $url_pay = 'https://www.sandbox.paypal.com/cgi-bin/webscr';} 
else { $url_pay = 'https://www.paypal.com/cgi-bin/webscr'; }
 
$finish_url = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/booking_paypal.php";
$cansel_url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$name_product = "Оплата услуги: $s_serv ($title_com)";
if($_GET["date"] == '1'){$booking_date = "0";} else {$booking_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";}
$wkb = $_GET["weekday"];

$dt = date("d.m.Y, H:i:s");

$val_cust = "$idserv**$booking_date**$select_time**".htmlentities(rawurlencode($client_name))."**$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4**$dt**$wkb**$_GET[date]**$spots**".htmlentities(rawurlencode($client_comment))."";
 

if ($_GET['date'] == 1) 

{
$time_in = explode("||", $select_time);
  for ($i = 0; $i < count($time_in); ++$i) {

if (strpos($time_in[$i], 'y:') !== false) {
$time_bin = $time_in[$i];
$time_bin = str_replace('y:', '', $time_bin);
 }}
$booking_in = $time_bin;
} else { $booking_in = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"].""; }




?>

<script type="text/javascript">
var mess=new Array(
 "..."," ");

var size=18;
var textcolor="";
var lastcolor="";
var pause=500;
var speed=500;
var i=i_str=0;
var msg=msgpre=msgafter="";

function get_text() {
 msgpre=mess[i].substring(0,i_str-1);
 msgafter=mess[i].substring(i_str-1,i_str);
 msg="<span style='position:relative;color:"+textcolor+";font-size:"+size+"px;'>";
 msg+=msgpre+"<font color='"+lastcolor+"'>"+msgafter+"</font></span>";
}

function go() {
if (i_str<=mess[i].length-1) {
 i_str++;
 get_text();
 if (document.all) {typewriter.innerHTML=msg;}
 else if (document.layers) {
  document.typewriter.document.write(msg);
  document.typewriter.document.close();
 }
 else {document.getElementById("typewriter").innerHTML=msg;}
 var timer=setTimeout("go()", speed);
}
else {
 clearTimeout(timer);
 var timer=setTimeout("changemess()", pause);
}
}

function changemess() {
 i++;
 i_str=0;
 if (i>mess.length-1) {i=0;}
 go();
}
</script>




<p class="date_p" id="loadpp">Перенаправление на PayPal для оплаты услуги<span id="typewriter"></span></p>


<script type="text/javascript">
go();
</script>






<form action="<?php echo $url_pay; ?>" method="post" id="paypal">

<input name="cmd" type="hidden" value="_xclick" />
 <input name="business" type="hidden" value="<?php echo $paym; ?>" />
 <input name="item_name" type="hidden" value="<?php echo $name_product; ?>" />
 <input name="item_number" type="hidden" value="<?php echo $booking_in; ?>" />
 <input name="amount" type="hidden" value="<?php echo $price; ?>" />
 <input name="no_shipping" type="hidden" value="1" />
 <input name="rm" type="hidden" value="2" />
 <input name="return" type="hidden" value="<?php echo $finish_url; ?>" />
 <input name="cancel_return" type="hidden" value="<?php echo $cansel_url; ?>" />
 <input name="currency_code" type="hidden" value="<?php echo $cur; ?>" />
 <input name="notify_url" type="hidden" value="" />
 <input type="hidden" name="custom" value="<?php echo $val_cust; ?>" />
 <input type="submit" id="submita" value="Оплатить через PayPal" style="display:none;" />
 
<script type = 'text/javascript'>
var delay = 100;
setTimeout(function submit_forms () {document.getElementById('submita').click();}, delay);
</script>
<noscript><div style="padding:20px; margin:0 auto; display:block; text-align:center;"><input type="submit" value="Оплатить через PayPal" /></div></noscript> 
</form>
<?php 

} else { ?>


<?php

if (is_array($ERROR)) {

echo "<ul class=\"error\">";
foreach($ERROR as $key => $value){
echo "<li>" . $ERROR[$key]["text"] . "</li>";
}
echo "</ul>";

} else {
$wk = $_GET["weekday"];


$ido = "ord".date('dmYHms')."-".$idserv."ser";





$confirm_url="http://".$_SERVER['SERVER_NAME']."".$_SERVER['PHP_SELF']."?order=".$ido;

 //Если даные успешно проверены
 //Письмо 
 if($_GET["date"] == '1'){$booking_date = "0";}
 else {$booking_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";}
 
  $wd = $weekday_n[$wk];
 
  $dt=date("d.m.Y, H:i:s"); // дата и время
  $mail="$client_email"; // e-mail куда уйдет письмо
  $title="Уведомление о заказе: ".$servise[0].""; // заголовок(тема) письма
  $client_comment=str_replace("\r\n","<br />",$client_comment); // обрабатываем

  
  $mess = "<html><body><div style=\"margin:0 auto;\">";
  $mess.="<h3 style=\"COLOR: #EB3F16;\">$title_com - уведомление о заказе.</h3>";
  $mess.="<table style=\"border:0; border-collapse:collapse; margin: 10px 0 10px 0;\">";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">На имя:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$client_name</strong></td></tr>";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Услуга:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>".$servise[0]."</strong></td></tr>";
  
  
  if($_GET["date"] == '1') {
  $mess.="<tr><td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">$form_8 даты:</td><td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">"; 
  $mess.="<ul style=\"margin:0; padding:0 0 0 20px;\">"; 
  $time_b = explode("||", $select_time);
  for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y:') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y:', '', $time_m);


  $mess.="<li>".$time_m."</li>"; }}
  $mess.="</ul></td></tr>";
  
  } else {
  
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Выбранная дата:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>"; 
$date_b = explode("-", $booking_date);
for ($i = 0; $i < count($date_b); ++$i) {
$date_b[1] = " $Month_r[$month] ";
  $mess.="$date_b[$i]"; }
  $mess.="</strong> ($wd)</td></tr>";
  
  $mess.="<tr><td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">$form_5 время:</td><td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">
  <ul style=\"margin:0; padding:0 0 0 20px;\">"; 
$time_b = explode("||", $select_time);
for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y', '', $time_m);
$time_m_next = $time_m+1;

$ind_otp = 39+$time_m;
$ind_dop = 63+$time_m;

if (empty($servise[$ind_otp])) { $motp = "00";}
else {$motp = $servise[$ind_otp];}


if (empty($servise[$ind_dop])) { $mdop = "00";}
else {$mdop = $servise[$ind_dop];}


$mess.="<li>".$time_m."$motp - $time_m_next:$mdop</li>"; }}
  $mess.="</ul></td></tr>"; }
  
  
  
  
 
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Сумма заказа:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">";
  if ($servise[25] == '-') {$mess.="цена варьируется";}
  
  else if ($servise[25] == '0') {$mess.= 'бесплатно';} 
  
  else if ($servise[30] == 1) {$mess.="<strong style=\"COLOR: #EB3F16;\">$price</strong> $currensy[$cur]";}
  
  else {$mess.="<strong style=\"COLOR: #EB3F16;\">$price</strong> $currensy[$cur]";}
  
  if($spots > 1) {$mess.="<br /><small>(кол-во мест: $spots)</small>";}
  
  $mess.="</td></tr>";
  
  $mess.="<tr><td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Примечания:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><i>$client_comment</i></td></tr>";
  // ссылка на e-mail
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">E-Mail:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong><a href='mailto:$client_email'>$client_email</a></strong></td></tr>"; 
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Телефон:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4</strong></td></tr>";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Отправлено:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$dt</strong></td></tr>";
  
  $mess.= "<tr><td colspan=\"2\" valign=\"top\" style=\"border: #fff 1px solid; background:#ffe0cc; padding:10px;\">
  <span style=\"COLOR: #000;\">Перейдите по этой ссылке, что бы подтвердить ваш заказ.</span><br />
  <a href=\"".$confirm_url."\" style=\"COLOR: #EB3F16;\">".$confirm_url."</a>
  </td></tr>";
  
  $mess.= "<tr><td colspan=\"2\" valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">
  $caption_mail<br /><center><a href=\"http://".$_SERVER['HTTP_HOST']."\">$title_com</a></center>
  </td></tr>";
  
  $mess.="</table></div><body></html>";
  
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "Content-type:text/html;charset=utf-8 \r\n"; //кодировка
  $headers .= "From: \"".$title_com."\" <$com_email>\r\n"; // откуда письмо
  $headers .= "Bcc: $com_email\r\n"; 
  $headers .= "Cc: $admin_email\r\n";
  $headers .= "Reply-To: $com_email\r\n"; 
  $headers.= "X-Mailer: PHPMailer 5.2.4\r\n";
  mail($mail, $title, $mess, $headers); // отправляем

  
//-------------CMC
if ($allow_sms == '1') {
require_once 'inc/sms/smsru.php';

function rus2translit($string) {

    $converter = array(

        'а' => 'a',   'б' => 'b',   'в' => 'v',

        'г' => 'g',   'д' => 'd',   'е' => 'e',

        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

        'и' => 'i',   'й' => 'y',   'к' => 'k',

        'л' => 'l',   'м' => 'm',   'н' => 'n',

        'о' => 'o',   'п' => 'p',   'р' => 'r',

        'с' => 's',   'т' => 't',   'у' => 'u',

        'ф' => 'f',   'х' => 'h',   'ц' => 'c',

        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        

        'А' => 'A',   'Б' => 'B',   'В' => 'V',

        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

        'И' => 'I',   'Й' => 'Y',   'К' => 'K',

        'Л' => 'L',   'М' => 'M',   'Н' => 'N',

        'О' => 'O',   'П' => 'P',   'Р' => 'R',

        'С' => 'S',   'Т' => 'T',   'У' => 'U',

        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

    );

    return strtr($string, $converter);

}


//echo rus2translit('У попа была собака, он ее любил.');

if($_GET["date"] == '1') {
$sms_txt .= "ЗАКАЗ - $client_name ";
$sms_txt .= "$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4 $servise[0]";
$time_b = explode("||", $select_time);
for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y:', '', $time_m);
$sms_txt .= ", ".$time_m."";
}}



} else {


$sms_txt .= "ЗАКАЗ - $client_name ";
$sms_txt .= "$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4 $servise[0] $booking_date";

$time_b = explode("||", $select_time);
for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y:', '', $time_m);
$sms_txt .= ", ".$time_m."";
}}

}

if ($transl_sms == '1') { 

$text = rus2translit($sms_txt); 

function truncate_words($text, $limit = 157)
{
	$text_substr=mb_substr($text,0,$limit,'UTF-8');
	/*если не пустая обрезаем до последнего  пробела*/
	if(mb_substr($text,mb_strlen($text)-1,1) && mb_strlen($text)==$limit)
	{
		$textret=mb_substr($text,0,mb_strlen($text)-mb_strlen(strrchr($text,'')));
		if(!empty($textret))
		{
			return $textret;
		}
	}
	return $text_substr;
}

$txt_send = truncate_words($text)."...";

} else {

$text1 = $sms_txt; 

function truncate_words1($text1, $limit1 = 67)
{
	$text_substr1=mb_substr($text1,0,$limit1,'UTF-8');
	/*если не пустая обрезаем до последнего  пробела*/
	if(mb_substr($text1,mb_strlen($text1)-1,1) && mb_strlen($text1)==$limit1)
	{
		$textret1=mb_substr($text1,0,mb_strlen($text1)-mb_strlen(strrchr($text1,'')));
		if(!empty($textret1))
		{
			return $textret1;
		}
	}
	return $text_substr1;
}

$txt_send = truncate_words1($text1)."...";
}




$sms = new \Zelenin\smsru( $api_id_sms );
if ($sms_do == '00') {$result = $sms->sms_send( $admin_phone1, $txt_send );}
else if (!empty($admin_phone1) && $t_horus >= $sms_ot && $t_horus < $sms_do) {
$result = $sms->sms_send( $admin_phone1, $txt_send );
}


 } //--on/off
 
 
 
//----------------/CMC

  
  
  
  // выводим уведомление об успехе операции и перезагружаем страничку
echo "
  
  <div id=\"sent\">";
if($_GET["date"] == '1') {echo "<h4>$client_name, оформление $form_6 успешно завершено.</h4>";}
else { echo "<h4>$client_name, оформление $form_6 успешно завершено.</h4>"; }
  
  
 echo "
 <span class=\"caption_order\">$caption_order</span><hr />
 На указанный E-mail адрес: <span class=\"caption_order\">$client_email</span>, отправлено уведомление."; 
 echo "<br />Пожалуйста подтвердите $form_2, перейдя по ссылке в этом письме."; 

 echo "<br />
 <p>&#160;</p>
  <table width=\"100%\">
  <tr><th>Услуга:</th><th>".$servise[0]."</th></tr>";
  
  
  
   if($_GET["date"] == '1') {
  echo "<tr><th valign=\"top\">$form_8 даты:</td><th valign=\"top\">"; 
  echo "<ul style=\"margin:0; padding:0 0 0 20px;\">"; 
  $time_b = explode("||", $select_time);
  for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y:') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y:', '', $time_m);


  echo "<li>".$time_m."</li>"; }}
  echo "</ul></th></tr>";
  
  } else {
  
  echo "<tr><th valign=\"top\">Выбранная дата:</th> <th><strong>"; 
$date_b = explode("-", $booking_date);
for ($i = 0; $i < count($date_b); ++$i) {
$date_b[1] = " $Month_r[$month] ";
 echo "$date_b[$i]"; }
  echo "</strong> ($wd)</th></tr>";
  
  echo "<tr><th valign=\"top\">$form_5 время:</th><th valign=\"top\"><ul style=\"margin:0; padding:0 0 0 20px;\">"; 
$time_b = explode("||", $select_time);
for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y', '', $time_m);
$time_m_next = $time_m+1;

$ind_otp = 39+$time_m;
$ind_dop = 63+$time_m;

if (empty($servise[$ind_otp])) { $motp = "00";}
else {$motp = $servise[$ind_otp];}


if (empty($servise[$ind_dop])) { $mdop = "00";}
else {$mdop = $servise[$ind_dop];}


$timemin .= $time_m."$motp - $time_m_next:$mdop|,|";


echo "<li>".$time_m."$motp - $time_m_next:$mdop</li>"; }}
echo "</ul></th></tr>"; }





echo " 
   <tr><th>Сумма оплаты:</th><th>";
       if ($servise[25] == '-') {echo"цена варьируется";}
  else if ($servise[25] == '0') {echo "бесплатно";} 
  else if ($servise[30] == 1 && $servise[34] != 1) {echo "<b>$price</b> $currensy[$cur] (не почасовая оплата)";}
  else if ($servise[30] == 1 && $servise[34] == 1) {echo "<b>$price</b> $currensy[$cur] (фиксированная цена)";}
 
  else {echo "<b>$price</b> $currensy[$cur]";}
  
  if($spots > 1) {echo"<br /><small>(кол-во мест: $spots)</small>";}
  
 echo "  
   </th></tr>
   <tr><th>Контактный телефон:</th><th>$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4</th></tr>
   <tr><th>E-mail:</th><th>$client_email</th></tr>
   <tr><th valign=\"top\">Примечания:</th><th>$client_comment</th></tr>
   </table><br />
   
   <script type=\"text/javascript\">
function timer(){
 var obj=document.getElementById('timer_inp');
 obj.innerHTML--;
 if(obj.innerHTML==0){
 location = \"index.php\"
 setTimeout(function(){},2000);}
 else{setTimeout(timer,2000);}
}
setTimeout(timer,2000);
</script>

<noscript><meta http-equiv=\"refresh\" content=\"20; url=index.php\"></noscript>
   
   
   <small>Автоматический переход на главную через <span id=\"timer_inp\">20</span> сек.</small><br />
   <a href=\"index.php\">&#171; Главная страница</a>
   </div>"; 
  
 
  // Записываем данные о бронировании
  
  
  
  
if (empty($price)) {$price = '0';}
  
$fp=fopen("data/booking.dat", "a+"); 
fputs
($fp, "$s_serv**$booking_date**$select_time**$price $currensy[$cur]**$client_name**$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4**$client_email**$client_comment**$dt**$wd**$idserv**0**$timemin**$ido****$spots**\r\n"); 
fclose($fp);






} } }

}
}
}
}


?>

<?php if(!$_POST["select_service"]) {
echo "<span class=\"attention\">".$ERROR["select_service"]["text"]."</span>";
} else {
?>

<?php if(is_array($ERROR)){ ?>






<form name="service" method="post" action="<?php echo $self; ?><?php if($_GET["date"] == '1' && !empty($_GET["month"])) {echo"?month={$_GET["month"]}&year={$_GET["year"]}&serv={$_GET["serv"]}&date=1";} else if ($_GET["date"] == '1' && empty($_GET["month"])) {echo"?serv={$_GET["serv"]}&date=1";}else
{echo "?day={$_GET["day"]}&month={$_GET["month"]}&year={$_GET["year"]}&weekday={$_GET["weekday"]}&serv={$_GET["serv"]}";}?>" onclick="count_checkboxes()">

<?php  //------------No paypal form ?>


<?php 
if ($_GET["date"] == '1') {
echo "<div id=\"calendar\" style=\"float:left; width:388px!important;\">";
include("date.php");
echo "</div>";
} else {
echo "<div id=\"time\" style=\"float:left; width:388px;\">";
include("time.php"); 
echo "</div>";
}
?>



<div style="float:left; width:20px!important; margin:0; padding:0;">&#160;</div>


<div id="client_info" style="float:left; width:392px!important;">
<p><strong>Оформление <?php echo $form_6; ?>:</strong></p>

<div>
<table width="100%" style="float:none!important; padding:10px 0 10px 0; margin:0;">

<tr><td style="padding: 0 0 0 10px; width:100px;">Имя:</td><td><input type="text" name="client_name" value="<?php echo $client_name;?>" style="width:255px" />

</td></tr>

<tr><td style="padding: 0 0 0 10px;">E-mail:</td><td><input type="text" name="client_email" value="<?php echo $client_email;?>" style="width:255px" />

</td></tr>

<tr><td style="padding: 0 0 0 10px;">Телефон:</td><td nowrap>
<input type="text" name="client_phone0" value="<?php if (empty($client_phone0)) {echo"+";} else {echo $client_phone0;}?>" style="width:23px; margin:3px 5px 3px 0;" maxlength="<?php echo $max_phone_fi; ?>" class="group1" /><input type="text" name="client_phone1" value="<?php echo $client_phone1;?>" style="width:54px; margin:3px 5px 3px 0;" maxlength="3" class="group1" /><input type="text" name="client_phone2" value="<?php echo $client_phone2;?>" style="width:54px; margin:3px 5px 3px 0;" maxlength="3" class="group1" /><input type="text" name="client_phone3" value="<?php echo $client_phone3;?>" style="width:28px; margin:3px 5px 3px 0;" maxlength="2" class="group1" /><input type="text" name="client_phone4" value="<?php echo $client_phone4;?>" style="width:28px; margin:3px 5px 3px 0;" maxlength="2" class="group1" />

<script>
     $('.group1').groupinputs();
</script>

</td></tr>
<tr><td valign="top" style="padding: 0 0 0 10px;">Примечания:<br /><small>(необязательно)</small></td><td>
<textarea name="client_comment" style="width:255px; height:90px;"><?php echo $client_comment;?></textarea></td></tr>

</td></tr>

<?php if($acaptcha == '1') {  ?>
<tr><td valign="top" style="padding: 0 0 0 10px;">Код с картинки:</td>
<td valign="top">
<img title="Кликните по картинке, если хотите её сменить" onclick="this.src=this.src+'&amp;'+Math.round(Math.random())" src="captcha/captcha/imaga.php?<?php echo session_name()?>=<?php echo session_id()?>" style="width:148px; height:28px; float:left; margin:0;" />

<input type="text" name="keystring" style="width:98px; margin:0; margin-left:10px;" />
</td></tr>
<?php }  ?>

<?php 
$select_service = $servise[0]; 


include 'inc/mobile_detect/Mobile_Detect.php';
$detect = new Mobile_Detect;
if ($detect->isMobile()) {$stoppay = '1';} else {$stoppay = '0';}


?>
<tr>
<td colspan="2" align="right">
<input type="hidden" name="select_service" value="<?php echo $select_service;?>" />

<?php if ($mpay == 1 && !empty($paym) && $freech != 0 && $stoppay != '1') { ?>
<input type="hidden" name="pay" value="1" />
<?php } else if ($mpay == 2 && !empty($paym) && $freech != 0 && $stoppay != '1') { ?>
<div style="margin: 5px 0 5px 0;">
<!-- <input type="checkbox" name="pay" value="1" /> -->
Оплатить заказ сейчас, через PayPal?
<select name="pay" style="margin: 0 5px 0 10px; width:61px; padding:3px;">
<option value="">Нет, оплатить по факту</option>
<option <?php if($_POST['pay'] == 1) {echo 'selected';} ?> value="1">Да</option>
</select>

</div>
<?php } else { 

if ($stoppay == '1' && $mpay == 1 && !empty($paym) && $freech != 0) {echo "<div style=\"max-width:200px!important; text-align:left;\"><span style=\"color:red;\">Не поддерживается возможность оплаты через PayPal с мобильных устройств.</span><br />Данный заказ будет оплачиваться наличными по факту.</div>";}

?>
<input type="hidden" name="pay" value="0" />
<?php } ?>
<br />

<input type="submit" name="submit" value=" <?php echo $form_1; ?> " style="width:140px; margin: 0 3px 0 0;" />

</td></tr>
</table>
</div>





<?php 

//echo "$t_horus > $sms_ot && $t_horus < $sms_do";

$file_name = "data/services.dat"; 

//определяем константу для имени файла
define('FILENAME_THREE', $file_name);

// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_THREE)) {
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

$rnd_num = date('dHms');
 if ($_POST["select_service"] == $servise[32]){
 
 if (!$servise[31]) {
 if (empty($servise[29])) {echo"";}
else {echo"
<div class=\"descsrv\" style=\"float:none!important; margin:0!important; padding:10px; display:block; width:372px!important; min-height:70px;\">
<div class=\"desk_block_noimg\">
<h3>$servise[0]</h3>
$servise[29]
</div>
</div>";}
 }
else {
echo"<div class=\"descsrv\" style=\"float:none!important; margin:0!important; padding:10px; display:block; width:372px!important;\">";

if (empty($servise[29])) {echo"";}
else {echo"<div class=\"desk_block\">
<h3>$servise[0]</h3>
$servise[29]</div>";}

echo"
<a href=\"data/pict/".$servise[31]."?salt=$rnd_num\" class=\"pirobox_gall\" id=\"$servise[0]\"><img src=\"data/pict/small_".$servise[31]."?salt=$rnd_num\" alt=\"".$servise[0]."\" /></a><div style=\"clear:both;\"></div>";

echo" </div>";}
}
}
}}
?>

</div>
<div style="clear:both;"></div>
</form>











<?php } ?>
<?php } ?>
<?php } else { echo "
<script language='Javascript' type='text/javascript'>
  <!--
  function reload()
  {location = \"index.php\"}; 
  setTimeout('reload()', 3000);
  -->
  </script>
Ошибка выбора даты.<br /><a href=\"index.php\">Назад</a>"; } ?>

</div>


<?php } ?>



<?php include("inc/footer.php"); ?>