<?php  //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
 // paypal 

include("data/config.php");

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

$weekday_nn = array(
"0" => "Понедельник",
"1" => "Вторник",
"2" => "Среда",
"3" => "Четверг",
"4" => "Пятница",
"5" => "Суббота",
"6" => "Воскресение"); 

$currensy = array (
"RUB" => "рублей",
"EUR" => "евро",
"USD" => "долларов",
);

$cur = $_POST['mc_currency'];

include("inc/header.php");





if (!empty($_POST['payer_email']) && !$_SERVER['HTTP_REFERER'] && $_POST["payment_status"]=="Completed" || $_POST["payment_status"]=="Pending") {
$booking_data = $_POST['custom'];

$cust = explode("**", $booking_data);



$idserv = $cust[0];
$booking_date = $cust[1];
$select_time = $cust[2];
$client_name = htmlspecialchars(rawurldecode($cust[3]));
$client_phone = $cust[4];
$dt = $cust[5];
$wkb = $cust[6];
$date_on = $cust[7];
$spots_pp = $cust[8];
$client_comment = htmlspecialchars(rawurldecode($cust[9]));


$wdb = $weekday_nn[$wkb];

$price = $_POST["mc_gross"];

$client_email = $_POST['payer_email'];

if ($_POST["payment_status"]=="Completed")
{$pay = '1';}
else if ($_POST["payment_status"]=="Pending")
{$pay = '2';} else {$pay = '0';}




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



$file_name = "data/services.dat"; 
define('FILENAME_BPP', $file_name);
if (!file_get_contents(FILENAME_BPP))
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

if($idserv == $servise[32]){

$s_serv .= $servise[0];




//-------------CMC
if ($allow_sms == '1') {
require_once 'inc/sms/smsru.php';

$t_horus = date("H");

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

if($date_on == '1') {
$sms_txt .= "ЗАКАЗ(PayPal) - $client_name ";
$sms_txt .= "$client_phone $s_serv";
$time_b = explode("||", $select_time);
for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y:', '', $time_m);
$sms_txt .= ", ".$time_m."";
}}



} else {


$sms_txt .= "ЗАКАЗ(PayPal) - $client_name ";
$sms_txt .= "$client_phone $s_serv $booking_date";

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






 //Письмо  
  $mail="$client_email"; // e-mail куда уйдет письмо
  $title="Уведомление о заказе: ".$s_serv.""; // заголовок(тема) письма
  $client_comment=str_replace("\r\n","<br />",$client_comment); // обрабатываем

  
  $mess = "<html><body><div style=\"margin:0 auto;\">";
  $mess.="<h3 style=\"COLOR: #EB3F16;\">$title_com - уведомление о заказе.</h3>";
  $mess.="<table style=\"border:0; border-collapse:collapse; margin: 10px 0 10px 0;\">";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">На имя:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$client_name</strong></td></tr>";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Услуга:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>".$s_serv."</strong></td></tr>";
  
  
  if($date_on == '1') {
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
$dm = $date_b[1];
$date_bm = " $Month_r[$dm] ";
  $mess.="$date_b[0] $date_bm $date_b[2]"; 
  $mess.="</strong> ($wdb)</td></tr>";
  
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


$timemin .= $time_m."$motp - $time_m_next:$mdop|,|";


$mess.="<li>".$time_m."$motp - $time_m_next:$mdop</li>"; }}
  $mess.="</ul></td></tr>"; }
  
  
  
  
 
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\" valign=\"top\">Сумма заказа:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\" valign=\"top\"><strong style=\"COLOR: #EB3F16;\">$price</strong> $currensy[$cur]<br /><span style=\"color:green;\">Оплачено через PayPal</span>";
  
  if ($pay == '2') {$mess.="<br /><span style=\"color:orange;\">отложенный платёж</span>";}
  
  if($spots_pp > 1) {
  $mess.="<br /><small>(кол-во мест: $spots_pp)</small>";
  }
  
  $mess.="</td></tr>";
  $mess.="<tr><td valign=\"top\" style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Примечания:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><i>$client_comment</i></td></tr>";
  // ссылка на e-mail
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">E-Mail:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong><a href='mailto:$client_email'>$client_email</a></strong></td></tr>"; 
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Телефон:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$client_phone</strong></td></tr>";
  $mess.="<tr><td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\">Отправлено:</td> <td style=\"border: #fff 1px solid; background:#f3f3f3; padding:10px;\"><strong>$dt</strong></td></tr>";
  
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

  


  
  
  
  // выводим уведомление об успехе операции и перезагружаем страничку
echo "
  
  <div id=\"sent\">";
if($date_on == '1') {echo "<h4>$client_name, выбранная вами услуга успешно $form_9 и оплачена.</h4>";}
else { echo "<h4>$client_name, выбранное вами время успешно $form_4 и оплачено.</h4>"; }
  
  
 echo "
 <span class=\"caption_order\">$caption_order</span><hr />
 Вам было выслано уведомление на указанный E-mail адрес: <span class=\"caption_order\">$client_email</span>.
 <p>&#160;</p>
  <table width=\"100%\">
  <tr><th>Услуга:</th><td>".$s_serv."</td></tr>";
  
  
  
   if($date_on == '1') {
  echo "<tr><td valign=\"top\">$form_8 даты:</td><td valign=\"top\">"; 
  echo "<ul style=\"margin:0; padding:0 0 0 20px;\">"; 
  $time_b = explode("||", $select_time);
  for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y:') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y:', '', $time_m);


  echo "<li>".$time_m."</li>"; }}
  echo "</ul></td></tr>";
  
  } else {
  
  echo "<tr><td valign=\"top\">Выбранная дата:</td> <td><strong>"; 
$date_b = explode("-", $booking_date);
$dm = $date_b[1];
$date_bm = " $Month_r[$dm] ";
  echo "$date_b[0] $date_bm $date_b[2]"; 
  echo "</strong> ($wdb)</td></tr>";
  
  echo "<tr><td valign=\"top\">$form_5 время:</td><td valign=\"top\"><ul style=\"margin:0; padding:0 0 0 20px;\">"; 
$time_b = explode("||", $select_time);
for ($i = 0; $i < count($time_b); ++$i) {

if (strpos($time_b[$i], 'y') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y', '', $time_m);

$ind_otp = 39+$time_m;
$ind_dop = 63+$time_m;

if (empty($servise[$ind_otp])) { $motp = "00";}
else {$motp = $servise[$ind_otp];}


if (empty($servise[$ind_dop])) { $mdop = "00";}
else {$mdop = $servise[$ind_dop];}


echo "<li>".$time_m."$motp - $time_m_next:$mdop</li>"; }}
echo "</ul></td></tr>"; }





echo " 
   <tr><th>Сумма оплаты:</th><td><b>$price</b> $currensy[$cur]";
if($spots_pp > 1) {echo "<br /><small>(кол-во мест: $spots_pp)</small>";}

 echo "  
   </td></tr>
   <tr><th>Контактный телефон:</th><td>$client_phone</td></tr>
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
($fp, "$s_serv**$booking_date**$select_time**$price $currensy[$cur]**$client_name**$client_phone**$client_email**$client_comment**$dt**$wdb**$idserv**$pay**$timemin**$ido**yes**$spots_pp**\r\n"); 
fclose($fp);


//-------------------------history_orders------------------------
/**
 * Класс для работы с csv-файлами 
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
  
  
 if ($date_on == '1') { 
$time_b = explode("||", $select_time);
for ($i = 0; $i < count($time_b); ++$i) {
if (strpos($time_b[$i], 'y') !== false) {
$time_m = $time_b[$i];
$time_m = str_replace('y:', '', $time_m);


$h_time .= "".$time_m." / ";
}}

    } else {


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


$h_time .= $time_m."$motp - $time_m_next:$mdop / ";
}}

} 
 $ido = "ord".date('dmYHms')."-".$idserv."ser"; 
    /**
     * Запись новой информации в CSV
     */
if ($date_on == '1') {

$arr = array("$s_serv;$booking_date;$h_time;$price $currensy[$cur];$client_name;$client_phone;$client_email;$client_comment;$dt;$ido;yes;$spots_pp;");
$csv->setCSV($arr);

} else {
$arr = array("$s_serv;$booking_date ($wdb);$h_time;$price $currensy[$cur];$client_name;$client_phone;$client_email;$client_comment;$dt;$ido;yes;$spots_pp;");
$csv->setCSV($arr);
}

}

catch (Exception $e) { //Если csv файл не существует, выводим сообщение
    echo "Ошибка: " . $e->getMessage();
}

}}}}
//-------------------------end_history_orders--------------------



 

} //------------------------PAY_YES



else { //------------------------PAY_NO

echo "<ul class=\"error\">
<li>Ошибка</li>
</ul>";


}













include("inc/footer.php");
?>