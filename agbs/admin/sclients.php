<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
include("header.php");

//include("header_no_pass.php");

$script_name = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'].""; 
$sear = '0';
if (!isset($_GET['page'])) {$page=1;} else {$page=$_GET['page']; if (!$page) {$page=1;} if ($page<1) $page=1;}
    
	
echo "<div id=\"history\">";

	
	//========================================Статистика
	

	
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
$csv = new CSV("../data/hystory_orders.csv"); //Открываем наш csv
    /**
     * Чтение из CSV  (и вывод на экран)
     */		
	 $get_csv = $csv->getCSV();
		foreach ($get_csv as $value){
		
	
	
	
	$cl1 .= $value[6]."**";
	$cl2 .= $value[6]."**";
    }



$ms1 = explode("**", $cl1);
array_pop($ms1);
$ms2 = explode("**", $cl1);
array_pop($ms2);

$diffz = array_intersect($ms1, $ms2); 
$diffz  = array_count_values($diffz);

arsort($diffz);
foreach ($diffz  as $k=>$v) {
$allc .= $k."**".$v."**";
}
$clients = explode("**", $allc);
array_pop($clients);






echo "<div class=\"filtr\">";

echo "<div>
<form name=\"filter\" method=\"get\">
<input type=\"text\" name=\"client\" value=\"$_GET[client]\" style=\"width:200px; line-height:100%;\" title=\"Введите имя или E-mail   (достаточно первых тёх букв). \" />
<input type=\"submit\" value=\"Искать\" /> 
</form></div>";


echo "<div><span>Поиск по имени или электронной почте</span></div>
<!-- <div><span class=\"capt\" title=\"Основным идентификатором клиентов является e-mail.\">?</span></div> -->";











echo "
<div>
<form name=\"filter1\" method=\"get\">
<select name=\"client\" onChange=\"this.form.submit()\" style=\"width:200px;\">";

$count = sizeof($clients); for ($ac = 0 ; $ac < $count  ; ++$ac) { 
$nomer_ln = $ac+1;
$vm = $count/2;
$at = $ac*2;
if ($at < $count) {

echo "<option value=\"".$clients[$at]."\""; if($_GET['client'] == $clients[$at]) {echo" selected";} echo">";
echo $clients[$at]."</option>"; 

}}

echo "</select></form></div>";




$count = sizeof($clients); for ($ac = 0 ; $ac < $count  ; ++$ac) { 
$nomer_ln = $ac+1;
$vm = $count/2;
$at = $ac*2;
if ($at < $count) {


$file_name = "../data/hystory_orders.csv";
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 

if (!empty($lines[$a])) {
$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

$n_mc = $a+1;

list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $weekday, $idserv, $pay, $timemin) = explode(";", $data);

//$sstr = mb_substr($b_name, 0, 3, utf8);
//$sstr = mb_strtolower($sstr, utf8);
$namt = mb_strtolower($_GET['client'], utf8);
$b_name = mb_strtolower($b_name, utf8);
//echo $sstr."<br />";

if ($namt == $b_name || preg_match("/".$namt."/i", $b_name)) 

//preg_match('/^'.$sstr.'/i', $b_name)


{$sclm .= $b_mail."::";}

//if ($clients[$at] == $b_mail) {echo $n_mc.". ".$b_name ." | ". $b_mail ; }

}}

}}








if (!empty($_GET['client'])) {
echo "<div><a href=\"".$script_name."\">&#171; Назад</a></div>"; } else {echo "";}



echo"</div>
<div style=\"clear:both;\"></div>";

echo "<table>
<tr>
<th width=\"16\" style=\"text-align:left; width:16px!important;\">№</th>
<th style=\"text-align:left;\">Имя:</th>
<th style=\"text-align:left;\">E-mail:</th>
<th style=\"text-align:left;\">Телефон:</th>
<th width=\"160\" style=\"text-align:left;\">Количество заказов:</th>
</tr>
";




$ln = count($clients)/2;

if ($ln == 1) {$limit=1;} 

else if ($ln == 2) {$limit=2;} 

else if ($ln == 3) {$limit=3;} 

else if ($ln == 4) {$limit=4;} 

else if ($ln == 5) {$limit=5;} 

else if ($ln == 6) {$limit=6;} 

else if ($ln == 7) {$limit=7;} 

else if ($ln == 7) {$limit=7;} 

else if ($ln == 8) {$limit=8;} 

else if ($ln == 9) {$limit=9;} 

else if ($ln == 10) {$limit=10;} 

else if ($ln == 11) {$limit=11;} 

else if ($ln == 12) {$limit=12;} 

else if ($ln == 13) {$limit=13;} 

else if ($ln == 14) {$limit=14;} 

else if (count($clients) == 0){$limit=0;} 

else {$limit=15;}


@$maxpage=ceil($ln/$limit); if ($page>$maxpage) {$page=$maxpage;}
// БЛОК для вывода на экран СПИСКА СТРАНИЦ
$numpageblock=null; $numpageblock.='<div id="pagesl"><span>Страницы:&nbsp; </span>';

//if ($page>=4 and $maxpage>5) {$numpageblock.='<a href="'.$script_name.'?page=1">1</a><span> ... </span>';
//$f1=$page+2; $f2=$page-2; }

//if ($page==1) { $f1=$page+4; $f2=$page; }

//if ($page==2) { $f1=$page+3; $f2=$page-1; }

//if ($page==$maxpage) { $f1=$page; $f2=$page-4; }

//if ($page==$maxpage-1) { $f1=$page+1; $f2=$page-3; }

//if ($maxpage<4) {$f1=$maxpage; $f2=1;}

$f1=$maxpage; $f2=1;

for($i=$f2; $i<=$f1; $i++) {if ($page==$i) {$numpageblock.="<B>$i</B> &nbsp;";} else {$numpageblock.="<a href=$script_name?page=$i>$i</a> &nbsp;";}}
//if ($page<=$maxpage-3 and $maxpage>5) $numpageblock.="<span>... </span><a href=$script_name?page=$maxpage>$maxpage</a>";
$numpageblock.="</div>";



if ($msginout==TRUE) 
{ $fm=$limit*($page-1); if ($fm<1) {$fm=1;}
  $lm=$fm+$limit; if ($lm>$ln) {$lm=$ln+1;} }
else 
{ $fm=$ln-$limit*($page-1); if ($fm<"0") {$fm=$limit;}
  $lm=$fm-$limit; if ($lm<"1") {$lm="0";} }

$ind = $ln-$lm-$limit; 
$end = $ln-$lm;







//===========================SEARCH
$scl = explode("::", $sclm);
array_pop($scl);
$scl = array_unique($scl);

foreach ($scl as $kcl=>$vcl) {





if (!empty($_GET['client'])) {

$count = sizeof($clients); for ($ac = 0 ; $ac < $count  ; ++$ac) { 
$nomer_l = $ac+1;
$vm = $count/2;
$at = $ac*2;
if ($at < $count) {



if ($vcl == $clients[$at]) { // по имени

$sear = '1';

echo "
<tr>";
echo "<td width=\"20\" style=\"width:20px!important;\">".$nomer_l."</td>";
//-------------------------------names
echo "<td>";

$file_name = "../data/hystory_orders.csv";
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 

if (!empty($lines[$a])) {

$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

$servise = explode(";", $data);

//echo $servise[6];

if ($clients[$at] == $servise[6]) {
echo $servise[4].""; break;
}


}}
echo "</td>";
//---------------------------------------------



echo "<td width=\"100%\"><a href=\"mailto:".$clients[$at]."\">".$clients[$at]."</a></td>";




//-------------------------------phone
echo "<td>";

$file_name = "../data/hystory_orders.csv";
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 

if (!empty($lines[$a])) {

$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

$servise = explode(";", $data);

//echo $servise[6];

if ($clients[$at] == $servise[6]) {
echo $servise[5].""; break;
}


}}
echo "</td>";
//---------------------------------------------


echo "<td width=\"100%\"> ".$clients[$at+1]."</td>";


echo "</tr>"; } // по имени



//==================================================

 
} } 

} //sear


}//==================getsearsh name




//===================================search MAIL
if (!empty($_GET['client'])) {

$count = sizeof($clients); for ($ac = 0 ; $ac < $count  ; ++$ac) { 
$nomer_l = $ac+1;
$vm = $count/2;
$at = $ac*2;
if ($at < $count) {


//$sstrm = mb_substr($clients[$at], 0, 3, utf8);
$sstrm = mb_strtolower($sstrm, utf8);
$clmal = mb_strtolower($_GET['client'], utf8);
if ($clmal == $clients[$at] || preg_match('/\b'.$clmal.'/i', $clients[$at])) {

//if ($_GET['client'] == $clients[$at]) { // mail

$sear = '1';

echo "
<tr>";
echo "<td width=\"20\" style=\"width:20px!important;\">".$nomer_l."</td>";
//-------------------------------names
echo "<td>";

$file_name = "../data/hystory_orders.csv";
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 

if (!empty($lines[$a])) {

$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

$servise = explode(";", $data);

//echo $servise[6];

if ($clients[$at] == $servise[6]) {
echo $servise[4].""; break;
}


}}
echo "</td>";
//---------------------------------------------



echo "<td width=\"100%\"><a href=\"mailto:".$clients[$at]."\">".$clients[$at]."</a></td>";




//-------------------------------phone
echo "<td>";

$file_name = "../data/hystory_orders.csv";
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 

if (!empty($lines[$a])) {

$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

$servise = explode(";", $data);

//echo $servise[6];

if ($clients[$at] == $servise[6]) {
echo $servise[5].""; break;
}


}}
echo "</td>";
//---------------------------------------------


echo "<td width=\"20\" style=\"width:20px!important;\"> ".$clients[$at+1]."</td>";


echo "</tr>"; } // 



//==================================================

 
} } 

} //sear


//} //==================getsearsh mail













if ($sear == '0' && !empty($_GET['client'])) { echo"<td colspan=\"5\">По запросу: &laquo;".$_GET['client']."&raquo; ни чего не найдено.</td>"; }














$count = sizeof($clients); for ($ac = $ind ; $ac < $end  ; ++$ac) { 
$nomer_l = $ac+1;
$vm = $count/2;
$at = $ac*2;
if ($at < $count) {










 if (empty($_GET['client'])) {

//================================




echo "
<tr>";
echo "<td width=\"20\" style=\"width:20px!important;\">".$nomer_l."</td>";
//-------------------------------names
echo "<td width=\"100%\">";

$file_name = "../data/hystory_orders.csv";
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 

if (!empty($lines[$a])) {

$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

$servise = explode(";", $data);

//echo $servise[6];

if ($clients[$at] == $servise[6]) {
echo $servise[4].""; break;
}


}}
echo "</td>";
//---------------------------------------------



echo "<td width=\"100%\"><a href=\"mailto:".$clients[$at]."\">".$clients[$at]."</a></td>";




//-------------------------------phone
echo "<td>";

$file_name = "../data/hystory_orders.csv";
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 
$count = sizeof($lines) ; for ($a = 0 ; $a < $count ; ++$a) { 

if (!empty($lines[$a])) {

$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

$servise = explode(";", $data);

//echo $servise[6];

if ($clients[$at] == $servise[6]) {
echo $servise[5].""; break;
}


}}
echo "</td>";
//---------------------------------------------


echo "<td width=\"20\" style=\"width:20px!important;\">".$clients[$at+1]."</td>";


echo "</tr>";

}// search



} 




	
}	//count

echo "</tr></table>";
echo "</div>";

if (empty($_GET['client'])) {
print $numpageblock; }

echo "<div style=\"height:20px;\"></div>";

}



catch (Exception $e) { //Если csv файл не существует, выводим сообщение
    echo "Ошибка: " . $e->getMessage();
}
echo "<br /><div class=\"wbutt\"><a href=\"?history=desrtroy\" onclick =\"return confirm('Удалить все записи безвозвратно?')\">Очистить историю!</a></div><br />";
//---------------сброс истории
if ($_GET["history"] == 'desrtroy') {
$myFileHistory = "../data/hystory_orders.csv";
$fh = fopen($myFileHistory, 'w');
fclose($fh);
echo "
	<script language=\"javascript\">
    var delay = 0;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script>";
}





//----------------------------
 include("footer.php"); 
 
 
 
 
 
 
 ?>