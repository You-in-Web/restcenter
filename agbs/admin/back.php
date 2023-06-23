<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
include("header.php");
$today_d = date("j-n-Y");
$dc = date("j");
$tomorrow_d = $dc+1 .date("-n-Y");
$file_name = "../data/booking.dat"; 

$check_td = '0';
$check_tm = '0';
$check_taa = '0';

$crlf = "\n"; 

$script_name = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'].""; 

//определяем константу для имени файла
define('FILENAME_BB', $file_name);

// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_BB)) {
         echo "<span class=\"mess\">Заказов нет.</span>
    <script language=\"javascript\">
    var delay = 15000;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."\"></noscript>
		 ";
		 
} else {
    // заказы существуют, обрабатываем их





	
//===================================== Очистка старых



$file = fopen($file_name,"r+") ; 
    flock($file,LOCK_EX) ; 
    $dlines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;

for ( $adl = count($dlines) - 1; $adl >=0 ; $adl--)  {

if (!empty($dlines[$adl])) {

$data = $dlines[$adl];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin, $idord, $confirm, $spots) = explode("**", $data);
	
	
$curr_d = date('d');
$curr_m = date('m');
$curr_y = date('Y');
$lostdd = $curr_d-1;

if (!empty($b_date) || $b_date != 0) {
$dddmmm = 'yes'; 
$srdatem = explode("-", $b_date);
$dlin = $adl;
} else { 
$dddmmm = 'no'; 
$dtimem = explode("y:", $b_time );
array_pop($dtimem);
$sutd = array_pop($dtimem);
$sutd = str_replace('||', '', $sutd);
//echo $sutd;
$srdatemsut = explode("-", $sutd);
$dlin = $adl;
}


//----удаление не подтверждённых в течении 1 часа
//if ($_GET['noconfirm'] == 'clear') {

//$timeadd = explode(",", $add_date );
//$timeadd = str_replace(' ', '', $timeadd);

//$dateaddm = explode(".", $timeadd[0]);

//$horadd = explode(":", $timeadd[1]);
//$dlint = $adl;
//echo "$horadd[0] < ".date('H')." : $horadd[1] < ".date('i')."<br />";

//if ($curr_d == $dateaddm[0] && $horadd[0] < date('H') && $horadd[1] < date('i') && empty($confirm) || $confirm =='no' || $curr_d > $dateaddm[0] && empty($confirm) || $confirm =='no' || $curr_d == $dateaddm[0] && $horadd[0]+1 < date('H')){

//$timemind = str_replace('|,|', '', $timemind);



//Убиваем
	
    //if (isSet($dlines[(integer) $dlint]) == true) 
    //{   unset($dlines[(integer) $dlint]) ; 
    //    @fseek($file,0) ; 
    //    $data_size = 0 ; 
    //    @ftruncate($file,fwrite($file,implode($crlf,$dlines))) ; 
    //    @fflush($file) ; 
    //} 

    //@flock($file,LOCK_UN) ; 
    //@fclose($file) ; 

//echo "<span class=\"messdelb\">Удалён не подтверждённый заказ:"; if($b_date == '0'){echo $sutd;} else {echo $b_date;} echo"/ $b_service </span><br />
//<script language=\"javascript\">
   // var delay = 1800;
   // setTimeout(\"document.location.href='".$_SERVER['REQUEST_URI']."'\", delay);
   // </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$_SERVER['REQUEST_URI']."\"></noscript>";
//}else {echo"
//<span class=\"messdelbno\">Не подтверждённые заказы удалены.</span><br />
//<script language=\"javascript\">
//    var delay = 1200;
//   setTimeout(\"document.location.href='".$script_name."'\", delay);
//    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."\"></noscript>
//"; break;}
//}


//============================================Не актуальные

if ($_GET['noactual'] == 'clear') {
//preg_match("/".$lostdd."-".$curr_m."-".$curr_y."/i", $b_date) || 


if ($dddmmm == 'yes' && $curr_d > $srdatem[0] && $curr_m == $srdatem[1] || $dddmmm == 'yes' && $curr_m > $srdatem[1] && $curr_y == $srdatem[2] || $dddmmm == 'yes' && $curr_y > $srdatem[2] || $dddmmm == 'no' && $curr_d > $srdatemsut[0] && $curr_m == $srdatemsut[1] || $dddmmm == 'no' && $curr_m > $srdatemsut[1] && $curr_y == $srdatemsut[2] || $dddmmm == 'no' && $curr_y > $srdatemsut[2]) {


//$timemind = str_replace('|,|', '', $timemind);

echo "<span class=\"messdelb\">Удалён не актуальный заказ: "; if($b_date == '0'){echo $sutd;} else {echo $b_date;} echo"/ $b_service </span><br />
<script language=\"javascript\">
    var delay = 700;
    setTimeout(\"document.location.href='".$_SERVER['REQUEST_URI']."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$_SERVER['REQUEST_URI']."\"></noscript>
";



//Убиваем
	
    if (isSet($dlines[(integer) $dlin]) == true) 
    {   unset($dlines[(integer) $dlin]) ; 
        @fseek($file,0) ; 
        $data_size = 0 ; 
        @ftruncate($file,fwrite($file,implode($crlf,$dlines))) ; 
        @fflush($file) ; 
    } 

    @flock($file,LOCK_UN) ; 
    @fclose($file) ; 


} 


else if ($dlin < 1) 
{
echo"
<span class=\"messdelbno\">Не актуальных заказов нет.</span><br />
<script language=\"javascript\">
    var delay = 1200;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."\"></noscript>
"; break;}		

	
} //get noactual 


}	
	
	
} 

//===============================================================	
	
	

	
	
	
	
	


if (isSet($_GET["line"]) == true)  
{    $file = fopen($file_name,"r+") ; 
    flock($file,LOCK_EX) ; 
    $lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;

    if (isSet($lines[(integer) $_GET["line"]]) == true) 
    {    unset($lines[(integer) $_GET["line"]]) ; 
        fseek($file,0) ; 
        $data_size = 0 ; 
        ftruncate($file,fwrite($file,implode($crlf,$lines))) ; 
        fflush($file) ; 
    } 

    flock($file,LOCK_UN) ; 
    fclose($file) ; 
    //header("Location: $script_name");
    //exit();  
	echo "
	<script language=\"javascript\">
    var delay = 800;
    setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."\"></noscript>
	<div class=\"done\">Заказ снят!</div><br /><br /><center><a href=\"".$script_name."\">Назад</a></center></body></html>"; exit;
    } 

	
	
//==============================================================Для перезаписи	
	
//if (isSet($_GET["confirm"]) == true) {	
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 

$nl = $_GET['line_confirm'];


$data = $lines[$nl];
list($b_serviced, $b_dated, $b_timed, $b_priced, $b_named, $b_phoned, $b_maild, $b_commentd, $add_dated, $weekdayd, $idservd, $payd, $timemind, $idordd, $confirmd, $spotsd ) = explode("**", $data);


$line_data_r = "$b_serviced**$b_dated**$b_timed**$b_priced**$b_named**$b_phoned**$b_maild**$b_commentd**$add_dated**$weekdayd**$idservd**$payd**$timemind**$idordd**$_GET[confirm]**$spotsd";





//=====================================================перезапись строки

	
//if (array_key_exists('confirm_button'.$_GET['line_confirm'].'',$_GET)){

if (isSet($_GET["confirm"]) == true) {	

$filename = $file_name;
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
if ($_GET['confirm'] == 'yes' && empty($confirmd)){
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

$csv = new CSV("../data/hystory_orders.csv"); //Открываем наш csv



if (empty($b_dated) || $b_dated == '0'){
$b_timed = str_replace('y:', '', $b_timed);
$b_timed = str_replace('||', '/ ', $b_timed);
$arr = array("$b_serviced;$b_dated;$b_timed;$b_priced;$b_named;$b_phoned;$b_maild;$b_commentd;$add_dated;$idordd;$confirm;$spotsd;");
$csv->setCSV($arr);} 
else {
$timemind = str_replace('|,|', '/ ', $timemind);
$arr = array("$b_serviced;$b_dated;$timemind;$b_priced;$b_named;$b_phoned;$b_maild;$b_commentd;$add_dated;$idordd;$confirm;$spotsd;");
$csv->setCSV($arr);}

}






catch (Exception $e) { //Если csv файл не существует, выводим сообщение
    echo "Ошибка записи в историю: " . $e->getMessage();}

} //-------------------------end_history_orders--------------------




			
			
			
	if ($_GET['confirm'] == 'yes'){		
    echo "<div class=\"done\">Заказ подтверждён!</div>";}
	
	if ($_GET['confirm'] == 'no'){		
    echo "<div class=\"mess\">Подтверждение снято!</div>";}
	
	echo"
	<script language=\"javascript\">
    var delay = 800;
    setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=back.php\"></noscript>
	<br /><br /><center><a href=\"back.php\">Назад</a></center>
	</div></body></html>"; exit;
           	   
		   
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























echo "<div id=\"b_table\">";


if ($_GET['orders'] == 'actual') {
echo "
<div class=\"filtr\">

<b>Актуальные</b>

<a href=\"back.php\" title=\"Показать весь список заказов\">Все заказы</a>
<a href=\"?orders=today\" title=\"Показать заказы только на сегодня\">На сегодня</a>
<a href=\"?orders=tomorrow\" title=\"Показать заказы только на завтра\">На завтра</a>

<form name=\"custom_filter\" method=\"get\">
<input type=\"text\" name=\"custom_date\" value=\"Выбрать дату\" onfocus=\"this.select();lcs(this)\"
    onclick=\"event.cancelBubble=true;this.select();lcs(this)\" title=\"Показать заказы на выбранную дату\" />
<input type=\"submit\" value=\"Показать\" />
</form>

<a href=\"rasp.php\">Расписание <span>&#9658;</span></a>
</div>";
}


else if ($_GET['orders'] == 'today') {
echo "
<div class=\"filtr\">

<a href=\"?orders=actual\" title=\"Показать только актуальные заказы\">Актуальные</a>

<a href=\"back.php\" title=\"Показать весь список заказов\">Все заказы</a><b>На сегодня</b><a href=\"?orders=tomorrow\" title=\"Показать заказы только на завтра\">На завтра</a>

<form name=\"custom_filter\" method=\"get\">
<input type=\"text\" name=\"custom_date\" value=\"Выбрать дату\" onfocus=\"this.select();lcs(this)\"
    onclick=\"event.cancelBubble=true;this.select();lcs(this)\" title=\"Показать заказы на выбранную дату\" />
<input type=\"submit\" value=\"Показать\" />
</form>

<a href=\"rasp.php\">Расписание <span>&#9658;</span></a>
</div>";
}

else if ($_GET['orders'] == 'tomorrow') {
echo "
<div class=\"filtr\">

<a href=\"?orders=actual\" title=\"Показать только актуальные заказы\">Актуальные</a>

<a href=\"back.php\" title=\"Показать весь список заказов\">Все заказы</a><a href=\"?orders=today\" title=\"Показать заказы только на сегодня\">На сегодня</a><b>На завтра</b>

<form name=\"custom_filter\" method=\"get\">
<input type=\"text\" name=\"custom_date\" value=\"Выбрать дату\" onfocus=\"this.select();lcs(this)\"
    onclick=\"event.cancelBubble=true;this.select();lcs(this)\" title=\"Показать заказы на выбранную дату\" />
<input type=\"submit\" value=\"Показать\" />
</form>

<a href=\"rasp.php\">Расписание <span>&#9658;</span></a>
</div>";
}

else if ($_GET['custom_date']) {
echo "
<div class=\"filtr\">

<a href=\"?orders=actual\" title=\"Показать только актуальные заказы\">Актуальные</a>

<a href=\"back.php\" title=\"Показать весь список заказов\">Все заказы</a><a href=\"?orders=today\" title=\"Показать заказы только на сегодня\">На сегодня</a>
<a href=\"?orders=tomorrow\" title=\"Показать заказы только на завтра\">На завтра</a>

<form name=\"custom_filter\" method=\"get\">
<input type=\"text\" name=\"custom_date\" value=\"".$_GET['custom_date']."\" onfocus=\"this.select();lcs(this)\"
    onclick=\"event.cancelBubble=true;this.select();lcs(this)\" title=\"Показать заказы на выбранную дату\" />
<input type=\"submit\" class=\"view_d\" value=\"Показать\" />
</form>

<a href=\"rasp.php\">Расписание <span>&#9658;</span></a>
</div>";
}

else if (empty($_GET['custom_date'])){
echo "
<div class=\"filtr\">

<a href=\"?orders=actual\" title=\"Показать только актуальные заказы\">Актуальные</a>

<b>Все заказы</b><a href=\"?orders=today\" title=\"Показать заказы только на сегодня\">На сегодня</a>
<a href=\"?orders=tomorrow\" title=\"Показать заказы только на завтра\">На завтра</a>

<form name=\"custom_filter\" method=\"get\">
<input type=\"text\" name=\"custom_date\" value=\"Выбрать дату\" onfocus=\"this.select();lcs(this)\"
    onclick=\"event.cancelBubble=true;this.select();lcs(this)\" title=\"Показать заказы на выбранную дату\" />
<input type=\"submit\" value=\"Показать\" />
</form>

<a href=\"rasp.php\">Расписание <span>&#9658;</span></a>

<a href=\"?noactual=clear\" class=\"clearord\" title=\"Все заказы с истёкшей датой будут удалены. Подтверждённые заказы хранятся в истории.\">Убрать не актуальные</a>

</div>";}


else {
echo "
<div class=\"filtr\">

<a href=\"?orders=actual\" title=\"Показать только актуальные заказы\">Актуальные</a>

<b>Все заказы</b><a href=\"?orders=today\" title=\"Показать заказы только на сегодня\">На сегодня</a>
<a href=\"?orders=tomorrow\" title=\"Показать заказы только на завтра\">На завтра</a>

<form name=\"custom_filter\" method=\"get\">
<input type=\"text\" name=\"custom_date\" value=\"Выбрать дату\" onfocus=\"this.select();lcs(this)\"
    onclick=\"event.cancelBubble=true;this.select();lcs(this)\" title=\"Показать заказы на выбранную дату\" />
<input type=\"submit\" value=\"Показать\" />
</form>

<a href=\"rasp.php\">Расписание <span>&#9658;</span></a>

<a href=\"?noactual=clear\" class=\"clearord\" title=\"Все заказы с истёкшей датой будут удалены. Подтверждённые заказы хранятся в истории.\">Убрать не актуальные</a>

</div>";}


echo"
<table><tr>
<th>Услуга</th>
<th>Дата</th>
<th width=\"150\">Время</th>

<th>Сумма</th>
<th>Имя заказчика</th>
<th>Контактный телефон</th>
<th>E-mail</th>
<th>Примечания заказчика</th>
<th nowrap>Добавлено ";

if ($_GET['orders'] || $_GET['custom_date']) {echo"";} else {

if ($_GET["count"] == top) {
echo "<span class=\"arrow\"><a href=\"back.php\" title=\"Последние сверху (по умолчанию)\"><!--<img src=\"img/arrow_up.png\" />-->&#9650;</a></span>"; }
else { echo "<span class=\"arrow\"><a href=\"?count=top\" title=\"Последние внизу\" \"arrow\"><!--<img src=\"img/arrow_down.png\" />-->&#9660;</a></span>"; }
}

echo "</th>
<th>удалить</th>
</tr>";





//---------------------------------------Все

if (empty($_GET) || !empty($_GET['noactual'])) {


//=====================================
for ( $a = count($lines) - 1; $a >=0 ; $a--)  {

if (!empty($lines[$a])) {

$data = $lines[$a];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin, $idord, $confirm, $spots) = explode("**", $data);


$curr_d = date('d');
$curr_m = date('m');
$curr_y = date('Y');
$lostdd = $curr_d-1;

if (!empty($b_date) || $b_date != 0) {
$dddmmm = 'yes'; 
$srdatem = explode("-", $b_date);
$dlin = $adl;
} else { 
$dddmmm = 'no'; 
$dtimem = explode("y:", $b_time );
array_pop($dtimem);
$sutd = array_pop($dtimem);
$sutd = str_replace('||', '', $sutd);
//echo $sutd;
$srdatemsut = explode("-", $sutd);
$dlin = $adl;
}

//if ($dddmmm == 'yes' && $curr_d > $srdatem[0] && $curr_m == $srdatem[1] && $curr_y == $srdatem[2] || $dddmmm == 'yes' && $curr_m > $srdatem[1] && $curr_y >= $srdatem[2] || $dddmmm == 'no' && $curr_d > $srdatemsut[0] && $curr_m == $srdatemsut[1] && $curr_y == $srdatemsut[2] || $dddmmm == 'no' && $curr_m > $srdatemsut[1] && $curr_y >= $srdatemsut[2] || $curr_y > $srdatemsut[2])




if ($dddmmm == 'yes' && $curr_d > $srdatem[0] && $curr_m == $srdatem[1] || $dddmmm == 'yes' && $curr_m > $srdatem[1] && $curr_y == $srdatem[2] || $dddmmm == 'yes' && $curr_y > $srdatem[2] || $dddmmm == 'no' && $curr_d > $srdatemsut[0] && $curr_m == $srdatemsut[1] || $dddmmm == 'no' && $curr_m > $srdatemsut[1] && $curr_y == $srdatemsut[2] || $dddmmm == 'no' && $curr_y > $srdatemsut[2]) {
$trid = 'noactual';} else {$trid = 'actual';}

//---вывод строк таблицы
echo "<tr id=\"".$trid."\" class=\"str_back\">";
echo"
<td valign=\"top\">

$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";



echo"
<td valign=\"top\" nowrap class=\"adate\">";

if (empty($b_date)) {
echo"<ul>";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}


} else {
 $date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i]<br />$Month_r[$month]";}
echo "<br /><small>($weekday)</small>"; }
echo "</td>";

echo "
<td valign=\"top\" nowrap>
<ul>";
if (empty($b_date)) {
echo "<li>Посуточно</li>";
} else {
$time = explode("||", $b_time);
 for ($i = 0; $i < count($time); ++$i) {
 
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y', '', $time_m);
$time_m_next = $time_m+1;
 
if (empty($timemin)){ echo "<li>".$time_m."00 - $time_m_next:00</li>";} 

}}

if (!empty($timemin)){
$atimes = explode("|,|", $timemin);
for ($at = 0; $at < count($atimes); ++$at) {
echo "<li><b>".$atimes[$at]."</b></li>";}
}

}
echo "</ul></td>";

echo "

<td valign=\"top\">$b_price

"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";}

if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>

<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\"><a href='" . $script_name . "?line=" . $a . "' onclick =\"return confirm('Удалить заказ: $b_service ";
if (!empty($b_date)) { echo"на ";
$date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i] $Month_r[$month]";} }
echo"?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a></td>
</tr>";
//---конец строк таблицы
}}}






//----------------------------------------------------------порядок сортировки

else if ($_GET["count"] == 'top') {

$count = sizeof($lines); for ($a = 0 ; $a < $count ; ++$a) { 



if (!empty($lines[$a])) {

$data = $lines[$a];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin, $idord, $confirm, $spots) = explode("**", $data);


$curr_d = date('d');
$curr_m = date('m');
$curr_y = date('Y');
$lostdd = $curr_d-1;

if (!empty($b_date) || $b_date != 0) {
$dddmmm = 'yes'; 
$srdatem = explode("-", $b_date);
$dlin = $adl;
} else { 
$dddmmm = 'no'; 
$dtimem = explode("y:", $b_time );
array_pop($dtimem);
$sutd = array_pop($dtimem);
$sutd = str_replace('||', '', $sutd);
//echo $sutd;
$srdatemsut = explode("-", $sutd);
$dlin = $adl;
}


if ($dddmmm == 'yes' && $curr_d > $srdatem[0] && $curr_m == $srdatem[1] || $dddmmm == 'yes' && $curr_m > $srdatem[1] && $curr_y == $srdatem[2] || $dddmmm == 'yes' && $curr_y > $srdatem[2] || $dddmmm == 'no' && $curr_d > $srdatemsut[0] && $curr_m == $srdatemsut[1] || $dddmmm == 'no' && $curr_m > $srdatemsut[1] && $curr_y == $srdatemsut[2] || $dddmmm == 'no' && $curr_y > $srdatemsut[2]) {
$trid = 'noactual';} else {$trid = 'actual';}

//---вывод строк таблицы
echo "<tr id=\"".$trid."\" class=\"str_back\">";
echo"
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";



echo"
<td valign=\"top\" nowrap class=\"adate\">";

if (empty($b_date)) {
echo"<ul>";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}


} else {
 $date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i]<br />$Month_r[$month]";}
echo "<br /><small>($weekday)</small>"; }
echo "</td>";

echo "
<td valign=\"top\" nowrap>
<ul>";
if (empty($b_date)) {
echo "<li>Посуточно</li>";
} else {
$time = explode("||", $b_time);
 for ($i = 0; $i < count($time); ++$i) {
 
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y', '', $time_m);
$time_m_next = $time_m+1;
 
if (empty($timemin)){ echo "<li>".$time_m."00 - $time_m_next:00</li>";} 

}}

if (!empty($timemin)){
$atimes = explode("|,|", $timemin);
for ($at = 0; $at < count($atimes); ++$at) {
echo "<li><b>".$atimes[$at]."</b></li>";}
}
}
echo "</ul></td>

<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>

<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\"><a href='" . $script_name . "?line=" . $a . "' onclick =\"return confirm('Удалить заказ: $b_service ";
if (!empty($b_date)) { echo"на ";
$date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i] $Month_r[$month]";} }
echo"?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a></td>
</tr>";
//---конец строк таблицы


 } 
}
echo "</table></div>";

} else { 


//---------------------------------------------------------В обычном порядке по дате убывания

for ( $a = count($lines) - 1; $a >=0 ; $a--)  {

if (!empty($lines[$a])) {

$data = $lines[$a];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin, $idord, $confirm, $spots) = explode("**", $data);





//-----------------------------------------На сегодня



//------------------------------------посуточно

if (empty($b_date)) {


$timed = explode("||", $b_time);
for ($i = 0; $i < count($timed); ++$i) {
if (strpos($timed[$i], 'y') !== false) {
$time_m_d = $timed[$i];
$time_m_d = str_replace('y:', '', $time_m_d);






if($time_m_d == $today_d && $_GET['orders'] == 'today') {
$check_td = '1';

echo "
<tr id=\"".$trid."\">
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";

echo"
<td valign=\"top\" nowrap class=\"adate\">";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}
echo "</td>

<td valign=\"top\">Посуточно</td>

<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>

<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\">

<a href='".$script_name."?line=".$a."' onclick =\"return confirm('Удалить заказ на услугу: $b_service?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a>

</td>
</tr>";

}}

}
}
//-----------------------------------------------/конец вывода посуточных












if ($b_date == $today_d && $_GET['orders'] == 'today') {
$check_td = '1';

//---вывод строк таблицы
echo "<tr id=\"".$trid."\" class=\"str_back\">";
echo"
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";



echo"
<td valign=\"top\" nowrap class=\"adate\">";

if (empty($b_date)) {
echo"<ul>";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}


} else {
 $date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i]<br />$Month_r[$month]";}
echo "<br /><small>($weekday)</small>"; }
echo "</td>";

echo "
<td valign=\"top\" nowrap>
<ul>";
if (empty($b_date)) {
echo "<li>Посуточно</li>";
} else {
$time = explode("||", $b_time);
 for ($i = 0; $i < count($time); ++$i) {
 
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y', '', $time_m);
$time_m_next = $time_m+1;
 
if (empty($timemin)){ echo "<li>".$time_m."00 - $time_m_next:00</li>";} 

}}

if (!empty($timemin)){
$atimes = explode("|,|", $timemin);
for ($at = 0; $at < count($atimes); ++$at) {
echo "<li><b>".$atimes[$at]."</b></li>";}
}
}
echo "</ul></td>

<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>

<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\"><a href='" . $script_name . "?line=" . $a . "' onclick =\"return confirm('Удалить заказ: $b_service ";
if (!empty($b_date)) { echo"на ";
$date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i] $Month_r[$month]";} }
echo"?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a>
</td>
</tr>";
//---конец строк таблицы
 
} 







//-----------------------------------На завтра


//------------------------------------посуточно

if (empty($b_date)) {


$timed = explode("||", $b_time);
for ($i = 0; $i < count($timed); ++$i) {
if (strpos($timed[$i], 'y') !== false) {
$time_m_d = $timed[$i];
$time_m_d = str_replace('y:', '', $time_m_d);






if($time_m_d == $tomorrow_d && $_GET['orders'] == 'tomorrow') {
$check_tm = '1';

echo "
<tr id=\"".$trid."\">
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";

echo"
<td valign=\"top\" nowrap class=\"adate\">";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}
echo "</td>

<td valign=\"top\">Посуточно</td>

<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>


<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\">

<a href='".$script_name."?line=".$a."' onclick =\"return confirm('Удалить заказ на услугу: $b_service?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a>

</td>
</tr>";

}}

}
}
//-----------------------------------------------/конец вывода посуточных


if  ($b_date == $tomorrow_d && $_GET['orders'] == 'tomorrow') {
$check_tm = '1';

//---вывод строк таблицы
echo "<tr id=\"".$trid."\" class=\"str_back\">";
echo"
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";



echo"
<td valign=\"top\" nowrap class=\"adate\">";

if (empty($b_date)) {
echo"<ul>";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}


} else {
 $date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i]<br />$Month_r[$month]";}
echo "<br /><small>($weekday)</small>"; }
echo "</td>";

echo "
<td valign=\"top\" nowrap>
<ul>";
if (empty($b_date)) {
echo "<li>Посуточно</li>";
} else {
$time = explode("||", $b_time);
 for ($i = 0; $i < count($time); ++$i) {
 
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y', '', $time_m);
$time_m_next = $time_m+1;
 
if (empty($timemin)){ echo "<li>".$time_m."00 - $time_m_next:00</li>";} 

}}

if (!empty($timemin)){
$atimes = explode("|,|", $timemin);
for ($at = 0; $at < count($atimes); ++$at) {
echo "<li><b>".$atimes[$at]."</b></li>";}
}
}
echo "</ul></td>

<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>


<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\"><a href='" . $script_name . "?line=" . $a . "' onclick =\"return confirm('Удалить заказ: $b_service ";
if (!empty($b_date)) { echo"на ";
$date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i] $Month_r[$month]";} }
echo"?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a></td>
</tr>";
//---конец строк таблицы

} 


//-----------------------------------выборочная дата

//------------------------------------посуточно

if (empty($b_date)) {


$timed = explode("||", $b_time);
for ($i = 0; $i < count($timed); ++$i) {
if (strpos($timed[$i], 'y') !== false) {
$time_m_d = $timed[$i];
$time_m_d = str_replace('y:', '', $time_m_d);






if($time_m_d == $_GET['custom_date']) {
$check_cd = '1';

echo "
<tr id=\"".$trid."\">
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";

echo"
<td valign=\"top\" nowrap class=\"adate\">";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}
echo "</td>

<td valign=\"top\">Посуточно</td>


<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>


<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\">

<a href='".$script_name."?line=".$a."' onclick =\"return confirm('Удалить заказ на услугу: $b_service?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a>

</td>
</tr>";

}}

}
}
//-----------------------------------------------/конец вывода посуточных

if ($b_date == $_GET['custom_date']) {
$check_cd = '1';

//---вывод строк таблицы
echo "<tr id=\"".$trid."\" class=\"str_back\">";
echo"
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";



echo"
<td valign=\"top\" nowrap class=\"adate\">";

if (empty($b_date)) {
echo"<ul>";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}


} else {
 $date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i]<br />$Month_r[$month]";}
echo "<br /><small>($weekday)</small>"; }
echo "</td>";

echo "
<td valign=\"top\" nowrap>
<ul>";
if (empty($b_date)) {
echo "<li>Посуточно</li>";
} else {
$time = explode("||", $b_time);
 for ($i = 0; $i < count($time); ++$i) {
 
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y', '', $time_m);
$time_m_next = $time_m+1;
 
if (empty($timemin)){ echo "<li>".$time_m."00 - $time_m_next:00</li>";} 

}}

if (!empty($timemin)){
$atimes = explode("|,|", $timemin);
for ($at = 0; $at < count($atimes); ++$at) {
echo "<li><b>".$atimes[$at]."</b></li>";}
}
}
echo "</ul></td>

<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>


<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\"><a href='" . $script_name . "?line=" . $a . "' onclick =\"return confirm('Удалить заказ: $b_service ";
if (!empty($b_date)) { echo"на ";
$date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i] $Month_r[$month]";} }
echo"?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a></td>
</tr>";
//---конец строк таблицы

} 



}


}



}  





//=========================АКТУАЛЬНЫЕ



if ($_GET['orders'] == 'actual') {


$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 

for ( $a = count($lines) - 1; $a >=0 ; $a--) 
//$count = sizeof($lines); for ($a = 0 ; $a < $count ; ++$a) 
{ 

if (!empty($lines[$a])) {

$data = $lines[$a];
list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin, $idord, $confirm, $spots) = explode("**", $data);




$datea = explode("-", $b_date);
$daya = $datea[0];
$montha = $datea[1];
$yeara = $datea[2];

$t_da = date("j");
$t_ma = date("n");
$t_ya = date("Y");



if ($montha > $t_ma && $yeara >= $t_ya || $montha == $t_ma && $daya >= $t_da) {





$check_taa = '1';

//---вывод строк таблицы
echo "<tr id=\"".$trid."\" class=\"str_back\">";
echo"
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";



echo"
<td valign=\"top\" nowrap class=\"adate\">";

if (empty($b_date)) {
echo"<ul>";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}


} else {
 $date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i]<br />$Month_r[$month]";}
echo "<br /><small>($weekday)</small>"; }
echo "</td>";

echo "
<td valign=\"top\" nowrap>
<ul>";
if (empty($b_date)) {
echo "<li>Посуточно</li>";
} else {
$time = explode("||", $b_time);
 for ($i = 0; $i < count($time); ++$i) {
 
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y', '', $time_m);
$time_m_next = $time_m+1;
 
if (empty($timemin)){ echo "<li>".$time_m."00 - $time_m_next:00</li>";} 

}}

if (!empty($timemin)){
$atimes = explode("|,|", $timemin);
for ($at = 0; $at < count($atimes); ++$at) {
echo "<li><b>".$atimes[$at]."</b></li>";}
}
}
echo "</ul></td>

<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>

<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\"><a href='" . $script_name . "?line=" . $a . "' onclick =\"return confirm('Удалить заказ: $b_service ";
if (!empty($b_date)) { echo"на ";
$date = explode("-", $b_date);
 for ($i = 0; $i < count($date); ++$i) {
 $month = $date[1];
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
$date[1] = "$Month_r[$month] ";
 echo "$date[$i] $Month_r[$month]";} }
echo"?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a>
</td>
</tr>";
//---конец строк таблицы
 
}


//------------------------------------актуальные посуточно

if (empty($b_date)) {


$timeda = explode("||", $b_time);
for ($i = 0; $i < count($timeda); ++$i) {
if (strpos($timeda[$i], 'y') !== false) {
$time_m_da = $timeda[$i];
$time_m_da = str_replace('y:', '', $time_m_da);

$dateab = explode("-", $time_m_da);
$dayab = $dateab[0];
$monthab = $dateab[1];
$yearab = $dateab[2];




if ($monthab > $t_ma && $yearab >= $t_ya || $monthab == $t_ma && $dayab >= $t_da) {
$check_taa = '1';

echo "
<tr id=\"".$trid."\">
<td valign=\"top\">$b_service";
if ($confirm == 'yes') {
echo"
<span class=\"confirm\">Подтверждено</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'yes_mail') {
echo"
<span class=\"confirm\">Подтверждено пользователем</span>

<a href=\"".$script_name."?confirm=no&line_confirm=".$a."\" class=\"unbron\">Снять подтверждение</a>
";
} 

else if ($confirm == 'no') {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить повторно</a>
";
} 


else  {
echo"
<a href=\"".$script_name."?confirm=yes&line_confirm=".$a."\" class=\"cbron\">Подтвердить</a>
";
}
echo "</td>";

echo"
<td valign=\"top\" nowrap class=\"adate\">";
$time = explode("||", $b_time);
for ($i = 0; $i < count($time); ++$i) {
if (strpos($time[$i], 'y') !== false) {
$time_m = $time[$i];
$time_m = str_replace('y:', '', $time_m);
echo "<li>".$time_m."</li>"; }}
echo "</td>

<td valign=\"top\">Посуточно</td>

<td valign=\"top\">$b_price"; if ($spots > 1) {echo "<br /><small>мест:</small> $spots";};
if ($pay==1) {echo"<br /><span style=\"color:green; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Оплачено</span>";}
else if ($pay==2) {echo"<br /><span style=\"color:orange; background:#fff; padding:5px; display:block; text-align:center; border: #dedede 1px solid; \">Не принятый платёж</span>";}
echo "</td>


<td valign=\"top\" class=\"aname\">$b_name</td>
<td valign=\"top\" nowrap>$b_phone</td>
<td valign=\"top\"><a href=\"mailto:$b_mail\">$b_mail</a></td>
<td valign=\"top\">$b_comment</td>
<td valign=\"top\">$add_date</td>
<td class=\"del_td\" align=\"center\">

<a href='".$script_name."?line=".$a."' onclick =\"return confirm('Удалить заказ на услугу: $b_service?');\" title=\"Удалить заказ\"><img src=\"img/trash.png\" width=\"32\" height=\"32\" alt=\"Удалить!\" /></a>

</td>
</tr>";

}}

}
}
//-----------------------------------------------/конец вывода посуточных (актуальные)



}}

}//===================================/актуальные





if ($_GET['orders'] == 'actual' && $check_taa == '0') {
echo "<tr id=\"".$trid."\" class=\"str_back\"><td colspan=\"11\" align=\"center\" style=\"padding:50px;\">Актуальных заказов нет.</td></tr>";
}


if ($_GET['orders'] == 'today' && $check_td == '0') 
{echo "<tr id=\"".$trid."\" class=\"str_back\"><td colspan=\"11\" align=\"center\" style=\"padding:50px;\">На сегодня заказов нет.</td></tr>"; }

if ($_GET['orders'] == 'tomorrow' && $check_tm == '0') 
{echo "<tr id=\"".$trid."\" class=\"str_back\"><td colspan=\"11\" align=\"center\" style=\"padding:50px;\">На завтра заказов нет.</td></tr>"; }

if ($_GET['custom_date'] != 'Выбрать дату' && !empty($_GET['custom_date']) && $check_cd != '1') 
{echo "<tr id=\"".$trid."\" class=\"str_back\"><td colspan=\"11\" align=\"center\" style=\"padding:50px;\">На ".$_GET['custom_date']." заказов нет.</td></tr>"; }


if ($_GET['custom_date'] == 'Выбрать дату' || isset($_GET['custom_date']) && empty($_GET['custom_date'])) 
{echo "<tr id=\"".$trid."\" class=\"str_back\"><td colspan=\"11\" align=\"center\" style=\"padding:50px;\">Не выбранна дата для просмотра заказов.</td></tr>"; }

echo "</table></div>";
echo "
	<script language=\"javascript\">
    var delay = 60000;
    setTimeout(\"document.location.href=''\", delay);
    </script>";


 } 
 echo "<div class=\"nbutt\">
 <!-- <a href=\"?noconfirm=clear\" style=\"float:left!important;\">Удалить неподтверждённые</a> -->
 <a href=\"history_orders.php\" >История всех заказов</a> 
 <a href=\"sclients.php\">Статистика по клиентам</a></div><br />";
?> 

<?php include("footer.php");?>