<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
include("header.php"); 



$sear = 0;
$script_name = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'].""; 

$file_name = "../data/hystory_orders.csv";


//====================================DELET

//echo $file_name;

$file = fopen($file_name,"r+") ; 
    flock($file,LOCK_EX) ; 
    @$dlines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;

//$ddata = $dlines;



if (!empty($_GET['del']) || $_GET['del'] == '0') {

$crlf = "\n"; 

//Убиваем
$dlint = $_GET['del'];
    if (isSet($dlines[(integer) $dlint]) == true) 
    {   unset($dlines[(integer) $dlint]) ; 
        @fseek($file,0) ; 
        $data_size = 0 ; 
        @ftruncate($file,fwrite($file,implode($crlf,$dlines))) ; 
        @fflush($file) ; 
    } 

    @flock($file,LOCK_UN) ; 
    @fclose($file) ; 
	
$ndlint	= $dlint+1;
echo "<div class=\"mess\">Запись удалена!</div>
<script language=\"javascript\">
    var delay = 1200;
    setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."\"></noscript>
</div></body></html>"; exit;

}


//==============================










if (!isset($_GET['page'])) {$page=1;} else {$page=$_GET['page']; if (!$page) {$page=1;} if ($page<1) $page=1;}
    
	
	echo "<div class=\"filtr\">";

echo "<div>
<form name=\"filter\" method=\"get\">
<input type=\"text\" name=\"client\" value=\"".$_GET['client']."\" style=\"width:200px; line-height:100%;\" title=\"Введите имя, E-mail или номер телефона (достаточно первых тёх символов, номер телефона без знака '+' и вместо скобок знак '-'). \" />
<input type=\"submit\" value=\"Искать\" /> 
</form></div>";



echo "<div>
<form name=\"date_filter\" method=\"get\">
<input type=\"text\" name=\"client\""; if (!empty($_GET['client'])) {echo "value=\"".$_GET['client']."\"";} else {echo "value=\"Выбрать дату\"";} echo " onfocus=\"this.select();lcs(this)\"
    onclick=\"event.cancelBubble=true;this.select();lcs(this)\" title=\"Показать заказы на выбранную дату\" />
<input type=\"submit\" value=\"Показать\" />
</form></div>";

if (!empty($_GET['client'])) {
echo "<div><a href=\"".$script_name."\">&#171; Назад</a></div>"; } else {echo "";}

echo "<a href=\"../data/hystory_orders.csv\" style=\"float:right;\">Скачать таблицу в Exel формате</a></div>";

	
	
    echo "
	
	<div id=\"history\">
	
<table><tbody>
<th width=\"16\">№</th>
<th>Сервис</th>
<th>Дата</th>
<th width=\"150\">Время</th>

<th>Сумма</th>
<th>Имя заказчика</th>
<th>Контактный телефон</th>
<th>E-mail</th>
<th>Примечания заказчика</th>
<th nowrap>Добавлено</th>
<th nowrap>Удалить</th>
";


$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
@$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 

$ln = count($lines);

//if ($ln <= 50) {$limit=10;}
//else if ($ln >= 50) {$limit=20;}
//else if ($ln >= 150) {$limit=30;}
//else {$limit=30;}

$limit=15;

if ($limit<1) $limit=1;
//$p = $ln/$limit;

$maxpage=ceil($ln/$limit); if ($page>$maxpage) {$page=$maxpage;}
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

for($i=$f2; $i<=$f1; $i++) {if ($page==$i) {$numpageblock.="<B>$i</B> &nbsp;";} else {$numpageblock.="<a href=history_orders.php?page=$i>$i</a> &nbsp;";}}
//if ($page<=$maxpage-3 and $maxpage>5) $numpageblock.="<span>... </span><a href=history_orders.php?page=$maxpage>$maxpage</a>";
$numpageblock.="</div>";

//print $numpageblock;

if ($msginout==TRUE) 
{ $fm=$limit*($page-1); if ($fm<1) {$fm=1;}
  $lm=$fm+$limit; if ($lm>$ln) {$lm=$ln+1;} }
else 
{ $fm=$ln-$limit*($page-1); if ($fm<"0") {$fm=$limit;}
  $lm=$fm-$limit; if ($lm<"1") {$lm="0";} }

$ind = $ln-$lm-$limit; 
$end = $ln-$lm;
//echo $ind." || ".$end ;  
  
 








 
  
 
 //=====================================search
 if (!empty($_GET['client'])) {
 
 
 $count = sizeof($lines); for ($a = 0 ; $a < $count  ; ++$a) { 
 
//for ( $a = count($lines) - $lm; $a >=0 ; $a--)  {

if (!empty($lines[$a])) {

$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $idord, $confirmh, $spots) = explode(";", $data);






$nomer_l = $a+1;

$namt = mb_strtolower($_GET['client'], utf8);
$b_names = mb_strtolower($b_name, utf8);

$b_mail = mb_strtolower($b_mail, utf8);

$b_phone = str_replace('+', '', $b_phone);
$b_phone = str_replace('(', '-', $b_phone);   
$b_phone = str_replace(')', '-', $b_phone);


if ($namt == $b_names || preg_match("/".$namt."/i", $b_names) || $namt == $b_mail || preg_match("/".$namt."/i", $b_mail) || preg_match("/".$namt."/i", $b_date) || $namt == $b_phone || preg_match("/".$namt."/i", $b_phone)) { 
$sear = 1;

$b_time = str_replace('/', '<br />', $b_time);
        echo "<tr>";
		echo "<td valign=\"top\" width=\"16\">".$nomer_l."</td>";
		echo "<td valign=\"top\">" . $b_service . "</td>";
		
		
		if (empty($b_date)) { echo "<td valign=\"top\" nowrap>" . $b_time . "</td>"; } else {
        echo "<td valign=\"top\">" . $b_date . "</td>";}
		
		if (empty($b_date)) { echo "<td valign=\"top\">Посуточно</td>"; } else {
		
        echo "<td valign=\"top\" nowrap>" . $b_time . "<br /></td>";}
		
		
		
		echo "<td valign=\"top\">" . $b_price . "";
		if ($spots > 1) { echo "<br /><small>(кол-во мест: ".$spots.")</small>"; }
		echo "</td>";
		echo "<td valign=\"top\">" . $b_name . "</td>";
		echo "<td valign=\"top\" nowrap>" . $b_phone . "</td>";
		echo "<td valign=\"top\" nowrap>" . $b_mail . "</td>";
		echo "<td valign=\"top\">" . $b_comment . "</td>";
		echo "<td valign=\"top\">" . $add_date . "</td>";
		echo "<td valign=\"top\"><a href=\"?del=$a\" class=\"del\" title=\"удалить\"></a></td>";
        echo "</tr>";
}}		
} //===search		
} //get 
 
 
 
else { 
 
 
 
 
 
 
 
  
 

$count = sizeof($lines); for ($a = $ind ; $a < $end  ; ++$a) { 
 
if (!isset($_GET['page'])) {echo"
<script language=\"javascript\">
    var delay = 0;
    setTimeout(\"document.location.href='".$script_name."?page=".$maxpage."'\", delay);
    </script>";
} 
 
 
//for ( $a = count($lines) - $lm; $a >=0 ; $a--)  {

if (!empty($lines[$a])) {

$lines[$a] = str_replace('"', '', $lines[$a]);
$data = $lines[$a];

list($b_service, $b_date, $b_time, $b_price, $b_name, $b_phone, $b_mail, $b_comment, $add_date, $idord, $confirmh, $spots) = explode(";", $data);


$nomer_l = $a+1;


$b_time = str_replace('/', '<br />', $b_time);
        echo "<tr>";
		echo "<td valign=\"top\" width=\"16\">".$nomer_l."</td>";
		echo "<td valign=\"top\">" . $b_service . "</td>";
		
		
		if (empty($b_date)) { echo "<td valign=\"top\" nowrap>" . $b_time . "</td>"; } else {
        echo "<td valign=\"top\">" . $b_date . "</td>";}
		
		if (empty($b_date)) { echo "<td valign=\"top\">Посуточно</td>"; } else {
		
        echo "<td valign=\"top\" nowrap>" . $b_time . "</td>";}
		
		
		
		echo "<td valign=\"top\">" . $b_price . "";
		
		if ($spots > 1) { echo "<br /><small>(кол-во мест: ".$spots.")</small>"; }
		echo "</td>";
		
		echo "<td valign=\"top\">" . $b_name . "</td>";
		echo "<td valign=\"top\" nowrap>" . $b_phone . "</td>";
		echo "<td valign=\"top\" nowrap>" . $b_mail . "</td>";
		echo "<td valign=\"top\">" . $b_comment . "</td>";
		echo "<td valign=\"top\">" . $add_date . "</td>";
		echo "<td class=\"del_td\"><a href=\"?del=$a\" class=\"del\" title=\"удалить\"></a></td>";
        echo "</tr>";
		
		
		




		

}} 

}

if ($sear == '0' && !empty($_GET['client'])) { echo"<tr><td colspan=\"11\">По запросу: &laquo;".$_GET['client']."&raquo; ни чего не найдено.</td></tr>"; }


echo "</tbody></table>";
if (empty($_GET['client'])) {
print $numpageblock;
}			
//----------------	
  



 echo "<div style=\"clear:both;\"></div>";

  
	
	//========================================Статистика
	
echo "<div style=\"height:20px;\"></div>
<div class=\"title_a\">Статистика всех заказов</div>
";
	
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
		$all_price = +$value[3];
		if (preg_match("/рублей/", $value[3])) {$all_pricer = +$value[3];}
	    if (preg_match("/долларов/", $value[3])) {$all_priced = +$value[3];}
	    if (preg_match("/евро/", $value[3])) {$all_pricee = +$value[3];}
		
	$summar += $all_pricer;
	$summad += $all_priced;
	$summae += $all_pricee;
	
	$servm1 .= $value[0]."**";
	$servm2 .= $value[0]."**";
	
	
    }


$ms1 = explode("**", $servm1);
array_pop($ms1);
$ms2 = explode("**", $servm2);
array_pop($ms2);

$diffz = array_intersect($ms1, $ms2); 
$diffz  = array_count_values($diffz);

echo "<table>
<tr><th colspan=\"2\" style=\"text-align:left;\">Количество заказов:</th></tr>
";
arsort($diffz);
foreach ($diffz  as $k=>$v) {
	echo"
	<tr><td>$k</td><td width=\"120\">$v</td></tr>
	";
	$summaz += $v;
}

echo "<tr><td class=\"aname\">Всего:</td><td width=\"120\" class=\"aname\">$summaz</td></tr></table>";

echo "<div style=\"height:20px;\"></div>";









echo "
<table>
<tr><th colspan=\"2\" style=\"text-align:left;\">Общие суммы заказов:</th></tr>
<tr><td>Рубли:</td><td width=\"120\">$summar</td></tr>
<tr><td>Доллары:</td><td>$summad</td></tr>
<tr><td>Евро:</td><td>$summae</td></tr>
</table>
";


echo" <div class=\"title_a\"><a href=\"sclients.php\">Статистика по клиентам</a></div>";

echo"</div>";


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