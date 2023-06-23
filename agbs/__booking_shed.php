<?php session_start(); //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
include("calendar.php"); 

$max_phone_fi = '2'; // Максимальное количество знаков в первом поле номера телефона (вместе с "+")

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

$sep_servise = $servise[35];
$s_serv = $servise[0];
$b_idservw = $servise[32];
}

}}
 
unset($ERROR); //на всякий пожарный, чтоб лишнего не выплыло


$client_name=trim(htmlspecialchars($_POST["client_name"]));
if(!$_POST['client_name']){
$ERROR["client_name"]["text"] = "Введите имя.";
} else { if((strlen($client_name)<3) || (preg_match("/[^a-zA-Z0-9а-яА-Яё]/u", $_POST['client_name']))){
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
//if(preg_match("/[^a-zA-Z0-9а-яА-Я.,:!?<> ]/u", $_POST['client_comment'])){
//$ERROR["client_comment"]["text"] = "Примечание содержит недопустимые символы.";
//}


$select_service = $_POST["select_service"];
//if(!$_POST['select_service']){
//$ERROR["select_service"]["text"] = "Выберите услугу.<br />";}



$select_time = $_POST['select_time'];
if(!$_POST['select_time']){
$ERROR["select_time"]["text"] = "Выберите время.";}
  

if (empty($_POST['spots']) || $_POST['spots'] <= 0) {
$spots = 1;
} else {
$spots = $_POST['spots'];
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

$current_service = $_POST["select_service"]; //---ex
$current_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";
if (preg_match(".$current_date.", $data_w) && (preg_match(".$current_service.", $data_w))) {
$time_bw = explode("||", $b_timew);

}
}
}

if (!empty($time_bw)) {
$select_time = $_POST['select_time'];
$wait_t = array_intersect($time_bw,$select_time); 
foreach ($wait_t as $nom=>$wt) {

$ERROR["select_time"]["text"] = "Это время уже занято. Пожалуйста выберите другое.";
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

$current_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";
if (preg_match(".$current_date.", $data_w)) {
$time_bw = explode("||", $b_timew);

}
}
}

if (!empty($time_bw)) {
$select_time = $_POST['select_time'];
$wait_t = array_intersect($time_bw,$select_time); 
foreach ($wait_t as $nom=>$wt) {

$ERROR["select_time"]["text"] = "Это время уже $form_4.";
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

if($_POST["select_service"] == $servise[32] && $servise[30] == 1){
$price = $servise[25]*$spots;
$cur = $servise[26];
$b_min = $servise[27];
$b_max = $servise[28];
$idserv = $servise[32];
}

else if($_POST["select_service"] == $servise[32]){
$price = $N*$servise[25]*$spots;
$cur = $servise[26];
$b_min = $servise[27];
$b_max = $servise[28];
$idserv = $servise[32];
}

}
}






if ($N > 0) {
if ($N > $b_min && $b_min !=0) {$ERROR["select_time"]["text"] = "Можно занять не более $b_min час.";} 
if ($N < $b_max && $b_max !=0) {$ERROR["select_time"]["text"] = "Выберите не менее $b_max час.";} 
 }

include("inc/header.php");



if ($acaptcha == '1') {
if(count($_POST)>0 && isset($_SESSION['captcha_keystring']) && strtolower($_SESSION['captcha_keystring']) != strtolower($_POST['keystring'])) {$ERROR["keystring"]["text"] = "Не верный код с картинки";} 
}



?> 



<div id="booking_form">

<?php if (!empty($_GET["day"])&&!empty($_GET["month"])&&!empty($_GET["year"])) { ?>

<?php if(is_array($ERROR)){ ?>

<?php  
$wk = $_GET["weekday"];
?>




<?php if ($steps == '1') { include("steps_shed.php"); } ?>


<form name="service" method="POST" action="<?php echo $self; ?><?php echo "?day={$_GET["day"]}&month={$_GET["month"]}&year={$_GET["year"]}&weekday={$_GET["weekday"]}";?>">



<div id="select_service">

<?php if($_POST["select_service"]){ 
echo "<p class=\"date_p\">
<span>".$s_serv."</span> на <span>".$_GET["day"]." ".$Month_r[$month]." ".$_GET["year"]." (".$weekday_n[$wk].")</span>
<a href=\"booking_shed.php?day={$_GET["day"]}&month={$_GET["month"]}&year={$_GET["year"]}&weekday={$_GET["weekday"]}\">&#171; список услуг</a>
</p>";
} else {




echo "<p class=\"date_p\">
<span>".$_GET["day"]." ".$Month_r[$month]." ".$_GET["year"]." (".$weekday_n[$wk].")</span>";

echo "<a href=\"admin/rasp.php\" style=\"float:right;\">&#171; Другая дата</a>";

echo "</p>";


} 
?>

<?php include("services_shed.php"); ?>
</div>





</form>
<?php } ?>









<?
$file_name = "data/services.dat"; 
define('FILENAME_RB', $file_name);
if (!file_get_contents(FILENAME_RB))
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


//echo $idserv;

if ($servise[34] == '1') {
$script_nameb = "booking.php";
echo "<script language=\"javascript\">
    var delay = 0;
    setTimeout(\"document.location.href='".$script_nameb."?serv=".$_POST["select_service"]."&date=1'\", delay);
    </script>
	<noscript>
	<meta http-equiv=\"refresh\" content=\"0; url=".$script_nameb."?serv=".$_POST["select_service"]."&date=1\">
	</noscript>"; exit;}

 
if (array_key_exists('submit',$_POST)){
if (is_array($ERROR)) {

echo "<ul class=\"error\">";
foreach($ERROR as $key => $value){
echo "<li>" . $ERROR[$key]["text"] . "</li>";
}
echo "</ul>";

} else {
$wk = $_GET["weekday"];

include("steps_shed.php"); 




 //Если даные успешно проверены
 //Письмо 
  $booking_date = "".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]."";
 
  $wd = $weekday_n[$wk];
 
  $dt=date("d.m.Y, H:i:s"); // дата и время
  $mail="$client_email"; // e-mail куда уйдет письмо
  $title="Уведомление о заказе: $s_serv"; // заголовок(тема) письма
  $client_comment=str_replace("\r\n","<br />",$client_comment); // обрабатываем

  
  $mess = "<html><body><div style=\"margin:0 auto;\">";
  $mess.="<h3 style=\"COLOR: #EB3F16;\">$title_com - уведомление о заказе.</h3>";
  $mess.="<table style=\"border:0; border-collapse:collapse; margin: 10px 0 10px 0;\">";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">На имя:</td>
  <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$client_name</strong></td></tr>";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Услуга:</td>
  <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$s_serv</strong></td></tr>";
  
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Выбранная дата:</td>
  <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>"; 
$date_b = explode("-", $booking_date);
for ($i = 0; $i < count($date_b); ++$i) {
$date_b[1] = " $Month_r[$month] ";
  $mess.="$date_b[$i]"; }
  $mess.="</strong> ($wd)</td></tr>";
  
  $mess.="<tr><td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">$form_5 время:</td>
  <td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><ul style=\"margin:0; padding:0 0 0 20px;\">"; 
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
  $mess.="</ul></td></tr>";
  
 
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Сумма заказа:</td>
  <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">";
  if ($servise[25] == '-') {$mess.="цена варьируется";}
  else if ($servise[25] == '0') {$mess.= 'бесплатно';} 
  else if ($servise[30] == 1) {$mess.="<strong style=\"COLOR: #EB3F16;\">$price</strong> $currensy[$cur]";}
 
  else {$mess.="<strong style=\"COLOR: #EB3F16;\">$price</strong> $currensy[$cur]";}
  
  if($spots > 1) {$mess.="<br /><small>(кол-во мест: $spots)</small>";}
  
  $mess.="</td></tr>";
  $mess.="<tr><td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Примечания:</td>
  <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><i>$client_comment</i></td></tr>";
  // ссылка на e-mail
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">E-Mail:</td>
  <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong><a href='mailto:$client_email'>$client_email</a></strong></td></tr>"; 
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Телефон:</td>
  <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4</strong></td></tr>";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Отправлено:</td>
  <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$dt</strong></td></tr>";
  
  $mess.= "<tr><td colspan=\"2\" valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">
  $caption_mail<br /><center><a href=\"http://".$_SERVER['HTTP_HOST']."\">$title_com</a></center>
  </td></tr>";
  
  $mess.="</table>";
  $mess.="
  </div>
  <body></html>";
  
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "Content-type:text/html;charset=utf-8 \r\n"; //кодировка
  $headers .= "From: \"".$title_com."\" <$com_email>\r\n"; // откуда письмо
  $headers .= "Bcc: $com_email\r\n"; 
  $headers .= "Cc: $admin_email\r\n";
  $headers .= "Reply-To: $com_email\r\n"; 
  $headers.= "X-Mailer: PHPMailer 5.2.4\r\n";
  mail($mail, $title, $mess, $headers); // отправляем

  
  
  
  // выводим уведомление об успехе операции и перезагружаем страничку
echo "
  
  <div id=\"sent\">
 <h4>$client_name, выбранное вами время успешно $form_4.</h4>
 <span class=\"caption_order\">$caption_order</span><hr />
 Вам было выслано уведомление на указанный E-mail адрес: <span class=\"caption_order\">$client_email</span>.<br />Благодарим за заказ.
 <p>&#160;</p>
  <table width=\"100%\">
  <tr><th>Услуга:</th><td>$s_serv</td></tr>
  <tr><th>Дата:</th><td>";
  
  $date_b = explode("-", $booking_date);
for ($i = 0; $i < count($date_b); ++$i) {
$date_b[1] = " $Month_r[$month] ";
 echo "<strong>$date_b[$i]</strong>";}
  
 echo" ($wd)</td></tr>
  <tr><th valign=\"top\">Время:</th><td valign=\"top\">  
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


$timemin .= $time_m."$motp - $time_m_next:$mdop|,|";


echo "<li>".$time_m."$motp - $time_m_next:$mdop</li>"; }}
echo "</ul></td></tr>";
echo " 
   <tr><th>Сумма оплаты:</th><td>";
       if ($servise[25] == '-') {echo"цена варьируется";}
  else if ($servise[25] == 0) {echo "бесплатно";} 
  else if ($servise[30] == 1) {echo "<b>$price</b> $currensy[$cur] (не почасовая оплата)";}
 
  else {echo "<b>$price</b> $currensy[$cur]";}
  
  if($spots > 1) {echo"<br /><small>(кол-во мест: $spots)</small>";}
  
 echo "  
   </td></tr>
   <tr><th>Контактный телефон:</th><td>$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4</td></tr>
   <tr><th>E-mail:</th><td>$client_email</td></tr>
   <tr><th valign=\"top\">Примечания:</th><td>$client_comment</td></tr>
   </table><br />
   
   <script type=\"text/javascript\">
function timer(){
 var obj=document.getElementById('timer_inp');
 obj.innerHTML--;
 if(obj.innerHTML==0){
 location = \"index.php\"
 setTimeout(function(){},1500);}
 else{setTimeout(timer,1500);}
}
setTimeout(timer,1500);
</script>


   
   
   <small>Автоматический переход в меню услуг через <span id=\"timer_inp\">15</span> сек.</small><br />
   <a href=\"index.php\">&#171; В список услуг</a>
   </div>"; 
 $ido = "ord".date('dmYHms')."-".$idserv."ser"; 
 
  // Записываем данные о бронировании
  
if (empty($price)) {$price = '0';}
  
$fp=fopen("data/booking.dat", "a+"); 
fputs
($fp, "$s_serv**$booking_date**$select_time**$price $currensy[$cur]**$client_name**$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4**$client_email**$client_comment**$dt**$wd**$idserv**0**$timemin**$ido**yes**$spots**\r\n"); 
fclose($fp);


//-------------------------history_orders------------------------
/**
 * Класс для работы с csv-файлами 
 * @author дизайн студия ox2.ru  
 */
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


$h_time .= $time_m."$motp - $time_m_next:$mdop/ ";

}}
  
  
    /**
     * Запись новой информации в CSV
     */

   $arr = array("$s_serv;$booking_date;$h_time;$price $currensy[$cur];$client_name;$client_phone0($client_phone1)$client_phone2-$client_phone3-$client_phone4;$client_email;$client_comment;$dt;$ido;yes;$spots;");
    $csv->setCSV($arr);


}

catch (Exception $e) { //Если csv файл не существует, выводим сообщение
    echo "Ошибка: " . $e->getMessage();
}
//-------------------------end_history_orders--------------------



} } 

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

<form name="booking" method="post" action="<?php echo $self; ?><?php echo "?day={$_GET["day"]}&month={$_GET["month"]}&year={$_GET["year"]}&weekday={$_GET["weekday"]}";?>" onclick="count_checkboxes()"> 
<!-- <p><strong>Время:</strong></p> -->
<div id="time">
<?php include("time.php"); ?>
</div>



<div id="client_info">
<p><strong>Оформление <?php echo $form_6; ?>:</strong></p>
<table>
<tr><td style="width:110px;">Имя:</td><td><input type="text" name="client_name" value="<?php echo $client_name;?>" style="width:248px" />

</td></tr>

<tr><td>E-mail:</td><td><input type="text" name="client_email" value="<?php echo $client_email;?>" style="width:248px" />

</td></tr>

<tr><td style="padding: 0 0 0 10px;">Телефон:</td><td nowrap>
<input type="text" name="client_phone0" value="<?php if (empty($client_phone0)) {echo"+";} else {echo $client_phone0;}?>" style="width:39px; margin:3px 5px 3px 0;" maxlength="<?php echo $max_phone_fi; ?>" class="group1" /><input type="text" name="client_phone1" value="<?php echo $client_phone1;?>" style="width:54px; margin:3px 5px 3px 0;" maxlength="3" class="group1" /><input type="text" name="client_phone2" value="<?php echo $client_phone2;?>" style="width:54px; margin:3px 5px 3px 0;" maxlength="3" class="group1" /><input type="text" name="client_phone3" value="<?php echo $client_phone3;?>" style="width:40px; margin:3px 5px 3px 0;" maxlength="2" class="group1" /><input type="text" name="client_phone4" value="<?php echo $client_phone4;?>" style="width:40px; margin:3px 5px 3px 0;" maxlength="2" class="group1" />

<script>
     $('.group1').groupinputs();
</script>

</td></tr>
<tr><td valign="top">Примечания:<br /><small>(необязательно)</small></td><td>
<textarea name="client_comment" style="width:248px; height:90px;"><?php echo $client_comment;?></textarea></td></tr>

</td></tr>

<?php if($acaptcha == '1') {  ?>
<tr><td valign="top">Код с картинки:</td>
<td valign="top">
<img title="Кликните по картинке, если хотите её сменить" onclick="this.src=this.src+'&amp;'+Math.round(Math.random())" src="captcha/captcha/imaga.php?<?php echo session_name()?>=<?php echo session_id()?>" style="width:140px; height:28px; float:left; margin:0;" />

<input type="text" name="keystring" style="width:98px; margin:0; margin-left:10px;" />
</td></tr>
<?php }  ?>


<tr>
<td colspan="2" align="right">
<input type="hidden" name="select_service" value="<?php echo $_POST["select_service"];?>" />

<br />
<input type="submit" name="submit" value=" <?php echo $form_1; ?> " style="margin-right:5px;" />
</td></tr>
</table></form>

<?php 

$file_name = "data/services.dat"; 

//определяем константу для имени файла
define('FILENAME_RRBB', $file_name);

// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_RRBB)) {
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
else {echo"<div class=\"descsrv\">
<div class=\"desk_block_noimg\"><h3>$servise[0]</h3>
$servise[29]</div></div>";}
 }
else {
echo" 
<div class=\"descsrv\">";
if (empty($servise[29])) {echo"";}
else {echo"<div class=\"desk_block\">
<h3>$servise[0]</h3>
$servise[29]</div>";}
echo"
<a href=\"data/pict/".$servise[31]."?salt=$rnd_num\" class=\"pirobox_gall\" id=\"$servise[0]\"><img src=\"data/pict/small_".$servise[31]."?salt=$rnd_num\" alt=\"".$servise[0]."\" /></a>";
echo" </div>";}
}
}
}}
?>
<div style="clear:both;"></div>
</div>

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






<?php include("inc/footer.php"); ?>