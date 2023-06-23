<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим

include("header.php");

$script_name = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'].""; 
$file_name = "../data/services.dat"; 
$dir = "../data/pict/"; 
$ids = date('dmYHms');
$rnd_num = date('s').rand();



if ($_GET['nlinedel'] || $_GET['nlinedel'] == '0'){
echo"<script language=\"javascript\">
    var delay = 0;
    setTimeout(\"document.location.href='".$script_name."?line=".$_GET['nlinedel']."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"0; url=".$script_name."?line=".$_GET['nlinedel']."\"></noscript>";
	
if (!empty($_GET['delfile'])){
if ( !(@unlink($dir.$_GET['delfile'])) ) die('<span class=\"error\">Ошибка при удалении изображения.</span>');
if ( !(@unlink($dir."small_".$_GET['delfile'])) ) die('<span class=\"error\">Ошибка при удалении уменьшенной копии изображения.</span>');
}


}	

//echo $_GET['nlinedel'];

// проверка формы для редактирования
if($_GET['name_service']){
$deck_service=trim(htmlspecialchars($_GET['name_service']));

$_GET['name_service'] = str_replace(array(':', '|', '\"', '"', '*'), '', trim($_GET['name_service']));

$_GET['name_service'] = str_replace(array('^'), '', trim($_GET['name_service']));
$_GET['name_service'] = str_replace(array('y'), 'у', trim($_GET['name_service']));


}
if(!$_GET['name_service']){
$ERROR["name_service"]["text"] = "Введите название услуги.";
} else { if((strlen($_GET['name_service'])<3)){
$ERROR["name_service"]["text"] = "Название введено не корректно.<br />Поле должно содержать только буквы и цифры и быть не менее 3х символов.";
} }

if (strlen($_GET['name_service'])>70) {$ERROR["name_service"]["text"] = "Название слишком длинное.";}


if(!$_GET['losthr']){
} else { 
if (preg_match("/[^0-9.]/", $_GET['losthr'])){
$ERROR["losthr"]["text"] = "Поле \"Перерыв\" должно содержать только цифры.";
}

if ($_GET['losthr'] > 24) {
$ERROR["losthr"]["text"] = "Перерыв не может быть более 23 часов.";
}
}


if(!$_GET['price_service']){
//$_GET['price_service'] = '0';
//$ERROR["add_price_service"]["text"] = "Введите цену.";
} else { 
$_GET['price_service'] = str_replace(array(','), '.', trim($_GET['price_service']));
if (preg_match("/[^0-9,.-]/", $_GET['price_service'])){
$ERROR["price_service"]["text"] = "Поле \"Цена\" должно содержать только цифры.";
} }
if(empty($_GET['price_service'])){ $_GET['price_service'] = '0'; }

if ($_GET['min_service'] != 0) { if ($_GET['min_service'] < $_GET['max_service']) {
$ERROR["price_service"]["text"] = "Минемальное время предоставления услуги больше,<br />чем разрешенно бронировать\заказывать.";
}}


if(empty($_GET['spot'])){ $_GET['spot'] = '0'; }
if (preg_match("/[^0-9]/", $_GET['spot'])){
$ERROR["spot"]["text"] = "Поле \"Количество мест\" должно содержать только цифры.";
}

if(empty($_GET['spotstop'])){ $_GET['spotstop'] = '0'; }
if (preg_match("/[^0-9]/", $_GET['spotstop'])){
$ERROR["spotstop"]["text"] = "Поле \"Минимум мест\" должно содержать только цифры.";
}

if ($_GET['spotstop'] > $_GET['spot']) {
$ERROR["spots"]["text"] = "Минимум мест не может быть больше макимального количества.";
}

if($_GET['deck_service']){
$deck_service=trim(htmlspecialchars($_GET['deck_service']));

$_GET['deck_service'] = str_replace(array('::', '|', '*'), '', trim($_GET['deck_service']));
$_GET['deck_service'] = str_replace(array('\"', '"'), '&quot;', $_GET['deck_service']); 

$_GET['deck_service'] = str_replace(array('^'), '', trim($_GET['deck_service']));
$_GET['deck_service'] = str_replace(array('y'), 'у', trim($_GET['deck_service']));

$_GET['deck_service'] = preg_replace("|[\r\n]+|", "<br />", $_GET['deck_service']); 
$_GET['deck_service'] = preg_replace("|[\n]+|", "<br />", $_GET['deck_service']); 
}
if (strlen($_GET['deck_service'])>900) {$ERROR["deck_service"]["text"] = "Описание слишком длинное.";}

if($_GET['pict']){
$_GET['pict'] = str_replace(array('^'), '', trim($_GET['pict']));
$_GET['pict'] = str_replace(array('y'), '', trim($_GET['pict']));
}

$nowwd = "$_GET[pon]|*$_GET[vto]|*$_GET[sre]|*$_GET[che]|*$_GET[pat]|*$_GET[sub]|*$_GET[vos]|*";


$mo00 = $_GET['00_minot'];
$mo01 = $_GET['01_minot'];
$mo02 = $_GET['02_minot'];
$mo03 = $_GET['03_minot'];
$mo04 = $_GET['04_minot'];
$mo05 = $_GET['05_minot'];
$mo06 = $_GET['06_minot'];
$mo07 = $_GET['07_minot'];
$mo08 = $_GET['08_minot'];
$mo09 = $_GET['09_minot'];
$mo10 = $_GET['10_minot'];
$mo11 = $_GET['11_minot'];
$mo12 = $_GET['12_minot'];
$mo13 = $_GET['13_minot'];
$mo14 = $_GET['14_minot'];
$mo15 = $_GET['15_minot'];
$mo16 = $_GET['16_minot'];
$mo17 = $_GET['17_minot'];
$mo18 = $_GET['18_minot'];
$mo19 = $_GET['19_minot'];
$mo20 = $_GET['20_minot'];
$mo21 = $_GET['21_minot'];
$mo22 = $_GET['22_minot'];
$mo23 = $_GET['23_minot'];
//=======================================
$md00 = $_GET['00_mindo'];
$md01 = $_GET['01_mindo'];
$md02 = $_GET['02_mindo'];
$md03 = $_GET['03_mindo'];
$md04 = $_GET['04_mindo'];
$md05 = $_GET['05_mindo'];
$md06 = $_GET['06_mindo'];
$md07 = $_GET['07_mindo'];
$md08 = $_GET['08_mindo'];
$md09 = $_GET['09_mindo'];
$md10 = $_GET['10_mindo'];
$md11 = $_GET['11_mindo'];
$md12 = $_GET['12_mindo'];
$md13 = $_GET['13_mindo'];
$md14 = $_GET['14_mindo'];
$md15 = $_GET['15_mindo'];
$md16 = $_GET['16_mindo'];
$md17 = $_GET['17_mindo'];
$md18 = $_GET['18_mindo'];
$md19 = $_GET['19_mindo'];
$md20 = $_GET['20_mindo'];
$md21 = $_GET['21_mindo'];
$md22 = $_GET['22_mindo'];
$md23 = $_GET['23_mindo'];




$line_data_r = "$_GET[name_service]::$_GET[time_servise00]::$_GET[time_servise01]::$_GET[time_servise02]::$_GET[time_servise03]::$_GET[time_servise04]::$_GET[time_servise05]::$_GET[time_servise06]::$_GET[time_servise07]::$_GET[time_servise08]::$_GET[time_servise09]::$_GET[time_servise10]::$_GET[time_servise11]::$_GET[time_servise12]::$_GET[time_servise13]::$_GET[time_servise14]::$_GET[time_servise15]::$_GET[time_servise16]::$_GET[time_servise17]::$_GET[time_servise18]::$_GET[time_servise19]::$_GET[time_servise20]::$_GET[time_servise21]::$_GET[time_servise22]::$_GET[time_servise23]::$_GET[price_service]::$_GET[currensy_service]::$_GET[min_service]::$_GET[max_service]::$_GET[deck_service]::$_GET[no_time]::$_GET[pict]::$_GET[idser]::$_GET[losthr]::$_GET[date_srv]::$_GET[sep_srv]::$_GET[tdh]::$_GET[mpay]::$nowwd::$mo00::$mo01::$mo02::$mo03::$mo04::$mo05::$mo06::$mo07::$mo08::$mo09::$mo10::$mo11::$mo12::$mo13::$mo14::$mo15::$mo16::$mo17::$mo18::$mo19::$mo20::$mo21::$mo22::$mo23::$md00::$md01::$md02::$md03::$md04::$md05::$md06::$md07::$md08::$md09::$md10::$md11::$md12::$md13::$md14::$md15::$md16::$md17::$md18::$md19::$md20::$md21::$md22::$md23::$_GET[cat]::$_GET[disserv]::$_GET[spot]::$_GET[spotstop]::";

//89 items

$nl = $_GET['nline'];

//перезапись строки
	
if (array_key_exists('submit',$_GET)){
if (is_array($ERROR)) {

echo "
<script language=\"javascript\">
    var delay = 5000;
    setTimeout(\"document.location.href='".$script_name."?edit=$nl#$nl'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"5; url=".$script_name."?edit=$nl#$nl\"></noscript>
";
foreach($ERROR as $key => $value){
echo "<span class=\"error\">" . $ERROR[$key]["text"] . "</span>";
}
echo "</div></body></html>"; exit;

} else {


$filename = $file_name;
$contents = file_get_contents($filename);
 
if ($contents) {
    $contents = explode("\n", $contents);
   
    if (isset($contents[$nl])) {
        $contents[$nl] = $line_data_r;
       
        if (is_writable($filename)) {
            if (!$handle = fopen($filename, 'wb')) {
                echo "<span class=\"error\">Не могу открыть файл ($filename)</span>";
                exit;
            }
                   
            if (fwrite($handle, implode("\n", $contents)) === FALSE) {
                echo "<span class=\"error\">Не могу произвести запись в файл ($filename)</span>";
                exit;
            }
           
            fclose($handle);
			



			
			
			
			
			
    echo "<div class=\"done\">Изменения приняты.</div>
	<script language=\"javascript\">
    var delay = 2000;
    setTimeout(\"document.location.href='".$script_name."?edit=".$nl."#".$nl."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"2; url=".$script_name."?edit=".$nl."#".$nl."\"></noscript>";
           	   
		   
        } else {
            echo "<span class=\"error\">Файл недоступен для записи</span>";
            exit;
        }
    } else {
        echo "<span class=\"error\">Услуга не найдена (строка №".$nl." отсутствует)</span>";
        exit;
    }
 
} else {
    echo "<span class=\"error\">Файл пуст</span>";
    exit;
}
}
}





// Блок ПЕРЕМЕЩЕНИЯ ВВЕРХ/ВНИЗ
if(isset($_GET['moves'])) { if ($_GET['moves'] !="") {
$move1=$_GET['moves']; $where=$_GET['where']; 
if ($where=="0") $where="-1";
$move2=$move1-$where;

$file=file("$file_name");
 

$imax=sizeof($file);

	
if (($move2>=$imax) or ($move2<"0")) exit("
<script language=\"javascript\">
    var delay = 1000;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."\"></noscript>
<span class=\"error\">Далее переместить невозможно!</span></div></body></html>
"); 

$nl = chr(13).chr(10);

if ($move1 == $imax-1) { //последняя на верх!!!
$data1=$file[$move1]; 
$data2=$nl.$file[$move2];
$del_l_line = "?line=".$imax."";
}

else if ($move2 == $imax-1) { //предпоследняя вниз!!!
$data1=$nl.$file[$move1]; 
$data2=$file[$move2];
$del_l_line = "?line=".$imax."";
}

else {
$data1=$file[$move1]; 
$data2=$file[$move2];
$del_l_line = "";
}

//$data1=$file[$move1]; 
//$data2=$file[$move2];


$fp=fopen("$file_name", "a+"); 
 

flock ($fp,LOCK_EX); 

ftruncate($fp,0);//УДАЛЯЕМ СОДЕРЖИМОЕ ФАЙЛА 
// меняем местами два соседних раздела




for ($i=0; $i<$imax; $i++) {


if ($move1==$i) { 
fputs
($fp,$data2); 
} 

else if ($move2==$i) { 
fputs
($fp,$data1); 
}

else { 
fputs
($fp,$file[$i]); 
} 

}
 
 
fflush ($fp);


flock ($fp,LOCK_UN);
fclose($fp);
echo "<div class=\"done\">Перемещаю...</div>
	<script language=\"javascript\">
    var delay = 800;
    setTimeout(\"document.location.href='".$script_name."".$del_l_line."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."".$del_l_line."\"></noscript>"; exit; }}

//?line=".$imax."
	
	
switch ($_GET['load']){
case "file":	
if($_FILES["fname"]["size"] > 1024*2*1024)
{
echo "<span class=\"error\">Размер файла превышает 2 мегабайта.</span>
<script language=\"javascript\">
    var delay = 3000;
    setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"3; url=".$script_name."\"></noscript>
</div></body></html>
";
exit;
}

else if (!$_FILES["fname"]["name"]) {
echo "<span class=\"error\">Файл не выбран.</span>
<script language=\"javascript\">
    var delay = 3000;
    setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"3; url=".$script_name."\"></noscript>
</div></body></html>
";
exit;
} else {
$imageinfo = getimagesize($_FILES['fname']['tmp_name']);

}


if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg') {
//echo "Используйте только GIF, JPEG";
echo "<span class=\"error\">Не верный формат. Используйте только JPG и GIF.</span>
<script language=\"javascript\">
    var delay = 3000;
     setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"3; url=".$script_name."\"></noscript>
</div></body></html>
";
exit;
} 


if($imageinfo[0] > 1200) {
//ПРОВЕРКА РАЗРЕШЕНИЯ
echo "<span class=\"error\">Изображение слишком большое ($imageinfo[0]px).<br />Используйте не более 1200 пикселей в ширину.</span>
<script language=\"javascript\">
    var delay = 5000;
     setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"5; url=".$script_name."\"></noscript>
</div></body></html>
";
exit;
} 	


if($imageinfo[0] < 140) {
//ПРОВЕРКА РАЗРЕШЕНИЯ
echo "<span class=\"error\">Изображение слишком маленькое ($imageinfo[0]px).<br />Используйте не менее 140 пикселей в ширину.</span>
<script language=\"javascript\">
    var delay = 4000;
     setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"5; url=".$script_name."\"></noscript>
</div></body></html>
";
exit;
} 	

	
}	


$crlf = "\n" ; 

if (isSet($_GET["line"]) == true)  
{   $file = fopen($file_name,"r+") ; 
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
	echo "<div class=\"mess\">Выполнено!</div>
	<script language=\"javascript\">
    var delay = 1200;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."\"></noscript>
	</div></body></html>"; exit;
    } 





if (is_array($ERROR)) {
echo "<div id=\"b_table\">

<table><tr>
<th width=\"300\" style=\"max-width:300px; width:300px;\">Название, описание, изображение и категория услуги</th>
<th width=\"200\">Режим работы</th>
<th width=\"180\">Цена</th>
<th width=\"180\">Валюта оплаты</th>
<th width=\"160\">За один раз разрешено<br />занять не более:</th>
<th width=\"160\">Услуга предоставляется<br />не менее чем на:</th>
<th width=\"60\">редактировать</th>
<th width=\"60\">удалить</th>
</tr>";


//определяем константу для имени файла
define('FILENAME_AS', $file_name);

// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_AS)) {
         echo "<tr><td colspan=\"8\"> Услуг в базе нет</td></tr>";
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







$cur = $servise[26];
$currensy = array(
"RUB" => "Рубли",
"EUR" => "Евро",
"USD" => "Доллары");


$a_num = $a+1;


if($servise[37] == 1){$mpay = "Оплата только через PayPal";} 
else if($servise[37] == 2) {$mpay = "Предоставляется выбор оплаты, наличными или через PayPal";}
else {$mpay = "Оплата только наличными, по факту";}	




echo "<tr>";


if (isset($_GET["edit"])) {
if ($_GET["edit"] == $a) {


echo "<td class=\"edit\" valign=\"top\" style=\"max-width:300px; width:300px;\"><a name=\"$a\"></a>";




echo "<form action=\"" . $script_name . "?load=file&edit=$a#$a\" method=\"post\" enctype=\"multipart/form-data\">
<div class=\"upload\">Изображение:<br /><small>JPG или GIF, не более 1200px в ширину.</small><br />";




if (empty($servise[31]) && !$_FILES["fname"])
{echo "<input type=\"file\" name=\"fname\" class=\"file-input\" size=\"1\" /><br /><input type=\"submit\" value=\"Загрузить и установить\" />";}

else if(!$_FILES["fname"])
{ 
echo "<input type=\"file\" name=\"fname\" class=\"file-input\"  size=\"1\" /><br /><input type=\"submit\" value=\"Заменить текущее\" /><br />
<center><img src=\"../data/pict/small_$servise[31]?salt=$rnd_num\" /></center>
<a href=\"".$script_name."?del=img&edit=$a#$a\"\" onclick =\"return confirm('Удалить изображение услуги: $servise[0]?');\">Удалить изображение</a>";}

else {echo "Работаю...";}

if ($_GET['del'] == 'img') {echo "<script type = 'text/javascript'>

var delay = 500;
setTimeout(function submit_forms () {document.getElementById('submita').click();}, delay);

</script><noscript><div class=\"error\">Нажмите кнопку \"Применить\"!</div></noscript>"; } 

echo "
</div>
</form>
<br />

<form id=\"eser\" name=\"edit_servise\" action=\"" . $script_name . "?line_edit$a=\" method=\"get\" enctype=\"multipart/form-data\">";

// Загрузка картинки -------------------------------------------------------
$quality = 100;
$smf = $servise[32]; 

function resize ($dir, $filename, $size, $quality, $smf)
{

$ext = strtolower(strrchr(basename($dir.$filename), ".")); // Получаем формат уменьшаемого изображения
$extentions = array('.jpg', '.gif'); // Определяем формат уменьшаемой картинки 

if (in_array($ext, $extentions)) { 

$percent = $size; // Ширина изображения миниатюры

list($width, $height) = getimagesize($dir.$filename); // Возвращает ширину и высоту картинки
$newheight = $height * $percent;
$newwidth = $newheight / $width; 

$thumb = imagecreatetruecolor($percent, $newwidth);
switch ($ext) {
case '.jpg': $source = @imagecreatefromjpeg($dir.$filename); break;
case '.gif': $source = @imagecreatefromgif($dir.$filename); break;
}
 
// php уменьшение изображения
imagecopyresampled($thumb, $source, 0, 0, 0, 0, $percent, $newwidth, $width, $height);


//правильно уменьшаем картинку

//--------------------------------------------------




// Создаем изображение
switch ($ext) {

case '.jpg': imagejpeg($thumb, $dir.'small_'.$smf.'.jpg', $quality); // Для JPEG картинок
break;

case '.gif': imagegif($thumb, $dir.'small_'.$smf.'.gif'); // Для GIF картинки
break;


} 
} else return 'typeError'; 

@imagedestroy($thumb); 
@imagedestroy($source); 

return $filename;
} 


switch ($_GET['load']){
case "file":



$filex = $_FILES["fname"]["name"];
$filex_tmp = $_FILES["fname"]["tmp_name"];

if(copy($filex_tmp,$dir.$filex))
{


if($imageinfo['mime'] == 'image/gif') {
move_uploaded_file($filex_tmp, $dir.$smf.".gif");
chmod ($dir.$smf.".gif", 0777);
echo "<div class=\"upload\"><center><img src=\"".$dir."small_".$smf.".gif?salt=$rnd_num\" /></center></div>";

echo "<input type=\"hidden\" name=\"pict\" value=\"".$smf.".gif\" />
<script type = 'text/javascript'>

var delay = 1200;
setTimeout(function submit_forms () {document.getElementById('submita').click();}, delay);

</script><noscript><div class=\"error\">Нажмите кнопку \"Применить\"!</div></noscript> 
";
}

if($imageinfo['mime'] == 'image/jpeg') {

move_uploaded_file($filex_tmp, $dir.$smf.".jpg");
chmod ($dir.$smf.".jpg", 0777);
echo "<div class=\"upload\"><center><img src=\"".$dir."small_".$smf.".jpg?salt=$rnd_num\" /></center></div>";

echo "<input type=\"hidden\" name=\"pict\" value=\"".$smf.".jpg\" />
<script type = 'text/javascript'>

var delay = 1200;
setTimeout(function submit_forms () {document.getElementById('submita').click();}, delay);

</script><noscript><div class=\"error\">Нажмите кнопку \"Применить\"!</div></noscript> 
";
}



resize ($dir, $filex, 140, 100, $smf);






if ( !(@unlink($dir.$filex)) ) die('<span class="error">Ошибка удаления временного файла.</span>');


echo "<br />";
} else {
echo "Ошибка отправки файла";
}
break;
}

if(!$_FILES["fname"]) {echo "<input type=\"hidden\" name=\"pict\" value=\"$servise[31]\" />";}

//конец загрузки картинки----------------------------------------------------------------

//удаление картинки
switch ($_GET['del']){
case "img":

if ( !(@unlink($dir.$servise[31])) ) die('Error Delete Image.');
if ( !(@unlink($dir."small_".$servise[31])) ) die('Error Delete Small Image.');
echo "<input type=\"hidden\" name=\"pict\" value=\"\" />
<script type = 'text/javascript'>
           var delay = 30;
setTimeout(function submit_forms () {document.getElementById('submita').click();}, delay);
</script><noscript><div class=\"error\">Нажмите кнопку \"Применить\"!</div></noscript>";
}



echo "
<input type=\"hidden\" name=\"nline\" value=\"$a\" />

<input type=\"hidden\" name=\"idser\" value=\"$servise[32]\" />

<input type=\"text\" name=\"name_service\" value=\"$servise[0]\" size=\"22\" class=\"name_s\" />
<hr />
Описание: <small>(необязательно)</small><br />
<textarea cols=\"24\" name=\"deck_service\" class=\"desc_s\">$servise[29]</textarea>";



echo "<hr/>
<label>
<input type=\"checkbox\" name=\"sep_srv\" value=\"1\""; if($servise[35] == 1){echo " checked ";} echo "/> Услуга может предоставляться одновременно с остальными<br /></label>
<span class=\"capt\" title=\"".$sep_capt."\">?</span><div class=\"clear\"></div><hr />";

//=======================================================Категории ред.


//echo'<span class="cat">'.$servise[87].'</span>';

echo'<span class="catv">&#8801; <a href="cat.php">Категории услуг</a></span><br /><br />';

echo'<select name="cat" style="width:100%;">';
echo'<option value=""'; if(empty($servise[87])) {echo' selected ';} echo'>без категории</option>';

$file_cat = "../data/cat.dat";
$catfile = fopen($file_cat,"r") ; 
flock($catfile,LOCK_SH) ; 
$linescat = preg_split("~\r*?\n+\r*?~",fread($catfile,filesize($file_cat))) ;
flock($catfile,LOCK_UN) ; 
fclose($catfile) ; 
$countc = sizeof($linescat); for ($ca = 0 ; $ca < $countc ; ++$ca) {
$catsd = explode("::", $linescat[$ca]); 



echo'<option value="'.$catsd[0].'"'; if($servise[87] == $catsd[0]) {echo' selected ';} echo'>'.$catsd[1].'</option>';

}

echo'</select>';

//===========================================/категории

echo '<hr /><label>
<input type="checkbox" name="disserv" value="no"'; if($servise[88] == 'no') {echo'checked';} echo'/> Отключить услугу</label>';

echo "</td>";
} else {
echo "
<td valign=\"top\" style=\"max-width:300px; width:300px;\">

<div class=\"moves\">
<table>
<tr>
<td class=\"nnsort\">";
$nnn = count($lines)+1;
if ($a != 0) 
{echo '<a href="?moves='.$a.'&where=1" title="переместить услугу выше">&#9650;</a>';} 
else {echo'<span>&#9650;</span>';}
if ($a != $nnn-2) 
{echo '<a href="?moves='.$a.'&where=0" title="переместить услугу вниз">&#9660;</a>';}
else {echo'<span>&#9660;</span>';}
echo"
</td>
<td>$a_num.</td>
<td><strong>$servise[0]</strong></td>
</tr>
</table>
</div>
<hr /><small>$servise[29]</small>";
if (empty($servise[31])){
echo "<center><img src=\"img/no_photo.png\" /></center>";}
else { echo "<center><a href=\"../data/pict/$servise[31]?salt=$rnd_num\" class=\"pirobox_gall\" id=\"$servise[0]\"><img src=\"../data/pict/small_$servise[31]?salt=$rnd_num\" /></a></center>";}
echo "<hr />";
if($servise[35] == 1){echo"<small>Услуга предоставляется одновременно c остальными.</small>";} else {echo"<small>Услуга предоставляется в порядке очереди.</small>";}

//========категория
if (empty($servise[87])) {echo'<hr /><span class="catv">&bull; <a href="cat.php">Без категории</a></span>';}


else {
$file_cat = "../data/cat.dat";
$catfile = fopen($file_cat,"r") ; 
flock($catfile,LOCK_SH) ; 
$linescat = preg_split("~\r*?\n+\r*?~",fread($catfile,filesize($file_cat))) ;
flock($catfile,LOCK_UN) ; 
fclose($catfile) ; 
$countc = sizeof($linescat); for ($ca = 0 ; $ca < $countc ; ++$ca) {
$catsd = explode("::", $linescat[$ca]); 
$strcatid .= 'a_'.$catsd[0].'_z';
 

if($servise[87] == $catsd[0]) {echo'<hr />&bull; <span class="catv"><a href="cat.php">'.$catsd[1].'</a></span>';}


}
if(!preg_match("/a_".$servise[87]."_z/i", $strcatid)) { echo'<hr /><span class="catv">&bull; <a href="cat.php">Категория не найдена!</a></br /><small style="color:red;">Услуга не выводится в меню! Требуется сменить категорию или установить "без категории".</small></span>';}
}//есть категория

//=======/категория

if($servise[88] == 'no') {echo'<hr /><span style="color:red;">Услуга отключена!</span>';}


echo"</td>";

} } else 
{echo 
"<td valign=\"top\" style=\"max-width:300px; width:300px;\">
<div class=\"moves\">
<table>
<tr>
<td class=\"nnsort\">";
$nnn = count($lines)+1;
if ($a != 0) 
{echo '<a href="?moves='.$a.'&where=1" title="переместить услугу выше">&#9650;</a>';} 
else {echo'<span>&#9650;</span>';}
if ($a != $nnn-2) 
{echo '<a href="?moves='.$a.'&where=0" title="переместить услугу вниз">&#9660;</a>';}
else {echo'<span>&#9660;</span>';}
echo"
</td>
<td>$a_num.</td>
<td><strong>$servise[0]</strong></td>
</tr>
</table>
</div>
<hr /><small>$servise[29]</small>";
if (empty($servise[31])){
echo "<center><img src=\"img/no_photo.png\" /></center>";}
else { echo "<center><a href=\"../data/pict/$servise[31]?salt=$rnd_num\" class=\"pirobox_gall\" id=\"$servise[0]\"><img src=\"../data/pict/small_$servise[31]?salt=$rnd_num\" /></a></center>";}
echo "<hr />";
if($servise[35] == 1){echo"<small>Услуга предоставляется одновременно c остальными.</small>";} else {echo"<small>Услуга предоставляется в порядке очереди.</small>";}

//========категория
if (empty($servise[87])) {echo'<hr /><span class="catv">&bull; <a href="cat.php">Без категории</a></span>';}

else {
$file_cat = "../data/cat.dat";
$catfile = fopen($file_cat,"r") ; 
flock($catfile,LOCK_SH) ; 
$linescat = preg_split("~\r*?\n+\r*?~",fread($catfile,filesize($file_cat))) ;
flock($catfile,LOCK_UN) ; 
fclose($catfile) ; 
$countc = sizeof($linescat); for ($ca = 0 ; $ca < $countc ; ++$ca) {
$catsd = explode("::", $linescat[$ca]); 
$strcatid .= 'a_'.$catsd[0].'_z';

if($servise[87] == $catsd[0]) {echo'<hr />&bull; <span class="catv"><a href="cat.php">'.$catsd[1].'</a></span>';}


}
if(!preg_match("/a_".$servise[87]."_z/i", $strcatid)) { echo'<hr /><span class="catv">&bull; <a href="cat.php">Категория не найдена!</a></br /><small style="color:red;">Услуга не выводится в меню! Требуется сменить категорию или установить "без категории".</small></span>';}

}//есть категория

//=======/категория
if($servise[88] == 'no') {echo'<hr /><span style="color:red;">Услуга отключена!</span>';}
echo"</td>";

}




if (isset($_GET["edit"])) {
if ($_GET["edit"] == $a) {

echo "<td class=\"edit\" valign=\"top\"><div id=\"time_edit\">


<label><input type=\"checkbox\" name=\"date_srv\" value=\"1\""; if($servise[34] == 1){echo " checked ";} echo "id=\"date\" onclick=\"check_date()\" />";
echo "
<script language=\"Javascript\" type=\"text/javascript\">

$(document).ready(function() {
if ($('[name=\"date_srv\"]').attr('checked') == 'checked') {
    
	document.getElementById('h_block').classList.add('hidden_block');
	document.getElementById('tdh').classList.remove('hidden_block');
	document.getElementById(\"min_max\").innerHTML='сут.';
	document.getElementById(\"min_max01\").innerHTML='сут.';
    document.getElementById(\"h_nt\").innerHTML='Фиксированная цена?';
} else { 
    document.getElementById('tdh').classList.add('hidden_block');
    document.getElementById(\"min_max\").innerHTML='час.';
	document.getElementById(\"min_max01\").innerHTML='час.';
    document.getElementById(\"h_nt\").innerHTML='Не почасовая оплата?';
	}
 });
 
window.onbeforeunload = check_date()
function check_date(){

  var rarr=document.getElementsByName(\"date_srv\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	
	document.getElementById('h_block').classList.add('hidden_block');
	
	document.getElementById('tdh').classList.remove('hidden_block');
	
	document.getElementById(\"min_max\").innerHTML='сут.';
	document.getElementById(\"min_max01\").innerHTML='сут.';
	document.getElementById(\"h_nt\").innerHTML='Фиксированая цена?';
  }
   else{
    // выбран второй radio
	document.getElementById('h_block').classList.remove('hidden_block');
	document.getElementById('tdh').classList.add('hidden_block');
	
	
	document.getElementById(\"min_max\").innerHTML='час.';
	document.getElementById(\"min_max01\").innerHTML='час.';
	document.getElementById(\"h_nt\").innerHTML='Не почасовая оплата?';
  }   
  
 }
 
 
</script>

";
echo " Услуга предоставляется посуточно </label><hr />";

echo "<div id=\"tdh\">
<label><input type=\"checkbox\" name=\"tdh\" value=\"1\""; if($servise[36] == 1){echo " checked ";} echo " /> <small>Разрешить заказы/бронь на текущую дату</small></label>
</div>";

echo "<div id=\"h_block\"><table>";

echo "<tr class=\"nobb\"><th colspan=\"3\"><small>Сейчас доступно:</small></td></tr>";



$count = sizeof($servise) ; for ($t = 0 ; $t < $count ; ++$t) { 

if (strpos($servise[$t], 'y') !== false) {
$time = $servise[$t];
$time = str_replace('y', '', $time);
//$time_next = $time+1;
$nexttx = $time+1;
$nextt = mb_strlen($nexttx, 'utf8'); 
if ($nextt == '1')
{$time_next = "0".$nexttx;} else {$time_next = $nexttx;}




echo "
<script language=\"Javascript\" type=\"text/javascript\">
function check_$time(){

  var rarr=document.getElementsByName(\"time_servise$time\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('time_tr$time').classList.remove('not_active');
	document.getElementById('time_tr$time').classList.add('active');
  }
  
  if(rarr['1'].checked){
    // выбран второй radio
	document.getElementById('time_tr$time').classList.remove('active');
	document.getElementById('time_tr$time').classList.add('not_active');
  }   
 }</script>";


$ind_ot = 39+$time;
$ind_do = 63+$time;


echo "<tr class=\"active\" id=\"time_tr$time\">
<td nowrap>$time:<select name=\"".$time."_minot\" style=\"width:42px; padding:0;\">";
$options_ot = array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");
foreach ($options_ot as $option_ot) {
    echo '<option value="' . $option_ot . '"';
    if ($option_ot==$servise[$ind_ot]) {echo " selected";} 
    echo ">" . ucfirst($option_ot) . "</option>";
} echo "</select> - $time_next:<select name=\"".$time."_mindo\" style=\"width:42px; padding:0;\">";
$options_do = array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");
foreach ($options_do as $option_do) {
    echo '<option value="' . $option_do . '"';
    if ($option_do==$servise[$ind_do]) {echo " selected";} 
    echo ">" . ucfirst($option_do) . "</option>";
} echo "</select></td>


<td nowrap><label><input type=\"radio\" name=\"time_servise$time\" value=\"".$time."y\" onclick='check_$time()' checked />Да</label></td>
<td nowrap><label><input type=\"radio\" name=\"time_servise$time\" value=\"".$time."^\" onclick='check_$time()' />Нет</label></td>
</tr>";
}} 


echo "<tr class=\"nobb\"><th colspan=\"3\"><small>Добавить:</small></td></tr>";

$count = sizeof($servise) ; for ($t = 0 ; $t < $count ; ++$t) { 
if (strpos($servise[$t], '^') !== false) {
$time = $servise[$t];
$time = str_replace('^', '', $time);
//$time_next = $time+1;
$nexttx = $time+1;
$nextt = mb_strlen($nexttx, 'utf8'); 
if ($nextt == '1')
{$time_next = "0".$nexttx;} else {$time_next = $nexttx;}

echo "
<script language=\"Javascript\" type=\"text/javascript\">
function check_$time(){

  var rarr=document.getElementsByName(\"time_servise$time\");
  
  if(rarr['0'].checked){
    //То выбран первый radio
	document.getElementById('time_tr$time').classList.remove('not_active');
	document.getElementById('time_tr$time').classList.add('active');
  }
  
  if(rarr['1'].checked){
    //То выбран второй radio
	document.getElementById('time_tr$time').classList.remove('active');
	document.getElementById('time_tr$time').classList.add('not_active');
  }   
 }</script>";

echo "<tr class=\"not_active\" id=\"time_tr$time\">
<td nowrap>$time:00 - $time_next:00</td>
<td nowrap><label><input type=\"radio\" name=\"time_servise$time\" value=\"".$time."y\" onclick='check_$time()' />Да</label></td>
<td nowrap><label><input type=\"radio\" name=\"time_servise$time\" value=\"".$time."^\" onclick='check_$time()'checked />Нет</label></td>
</tr>";
}}
echo "</table>";


echo "
<br />
Перерыв:

<select name=\"losthr\">";

$options = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24");
foreach ($options as $option) {
    echo '<option value="' . $option . '"';
    if ($option==$servise[33]) {echo " selected";} 
    echo ">" . ucfirst($option) . "</option>";
} echo "</select> <small>(час.)</small>

<span class=\"capt\" title=\"".$break_capt."\">?</span>
<div style=\"clear:both;\"></div>
</div><hr />";


$nowwde = explode("|*", $servise[38]);

echo "<small>Отметьте не рабочие дни:</small>
<div id=\"acalendar\">

<table><tr>
<td class=\"checked_day\" id=\"dwp\">
<label><input type=\"checkbox\" name=\"pon\" value=\"1\""; if($nowwde[0] == 1){echo " checked ";} echo " onclick=\"check_dwp()\" /><br /><small>Пн</small></label>
</td>
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_dwp() 

function check_dwp()

{

  var rarr=document.getElementsByName(\"pon\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dwp').classList.remove('select_date');
	document.getElementById('dwp').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dwp').classList.remove('checked_day');
	document.getElementById('dwp').classList.add('select_date');
  }   
  
 }

</script>



<td class=\"checked_day\" id=\"dwv\">
<label><input type=\"checkbox\" name=\"vto\" value=\"1\""; if($nowwde[1] == 1){echo " checked ";} echo " onclick=\"check_dwv()\" /><br /><small>Вт</small></label>
</td>
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_dwv() 

function check_dwv()

{

  var rarr=document.getElementsByName(\"vto\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dwv').classList.remove('select_date');
	document.getElementById('dwv').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dwv').classList.remove('checked_day');
	document.getElementById('dwv').classList.add('select_date');
  }   
  
 }

</script>



<td class=\"checked_day\" id=\"dws\">
<label><input type=\"checkbox\" name=\"sre\" value=\"1\""; if($nowwde[2] == 1){echo " checked ";} echo " onclick=\"check_dws()\" /><br /><small>Ср</small></label>
</td>
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_dws() 

function check_dws()

{

  var rarr=document.getElementsByName(\"sre\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dws').classList.remove('select_date');
	document.getElementById('dws').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dws').classList.remove('checked_day');
	document.getElementById('dws').classList.add('select_date');
  }   
  
 }

</script>



<td class=\"checked_day\" id=\"dwc\">
<label><input type=\"checkbox\" name=\"che\" value=\"1\""; if($nowwde[3] == 1){echo " checked ";} echo " onclick=\"check_dwc()\" /><br /><small>Чт</small></label>
</td>
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_dwc() 

function check_dwc()

{

  var rarr=document.getElementsByName(\"che\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dwc').classList.remove('select_date');
	document.getElementById('dwc').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dwc').classList.remove('checked_day');
	document.getElementById('dwc').classList.add('select_date');
  }   
  
 }
</script>



<td class=\"checked_day\" id=\"dwf\">
<label><input type=\"checkbox\" name=\"pat\" value=\"1\""; if($nowwde[4] == 1){echo " checked ";} echo " onclick=\"check_dwf()\" /><br /><small>Пт</small></label>
</td>
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_dwf() 

function check_dwf()

{

  var rarr=document.getElementsByName(\"pat\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dwf').classList.remove('select_date');
	document.getElementById('dwf').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dwf').classList.remove('checked_day');
	document.getElementById('dwf').classList.add('select_date');
  }   
  
 }
</script>



<td class=\"checked_day\" id=\"dwss\">
<label><input type=\"checkbox\" name=\"sub\" value=\"1\""; if($nowwde[5] == 1){echo " checked ";} echo " onclick=\"check_dwss()\" /><br /><small>Сб</small></label>
</td>
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_dwss() 

function check_dwss()

{

  var rarr=document.getElementsByName(\"sub\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dwss').classList.remove('select_date');
	document.getElementById('dwss').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dwss').classList.remove('checked_day');
	document.getElementById('dwss').classList.add('select_date');
  }   
  
 }
</script>




<td class=\"checked_day\" id=\"dwvv\">
<label><input type=\"checkbox\" name=\"vos\" value=\"1\""; if($nowwde[6] == 1){echo " checked ";} echo " onclick=\"check_dwvv()\" /><br /><small>Вс</small></label>
</td>
<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_dwvv() 

function check_dwvv()

{

  var rarr=document.getElementsByName(\"vos\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('dwvv').classList.remove('select_date');
	document.getElementById('dwvv').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('dwvv').classList.remove('checked_day');
	document.getElementById('dwvv').classList.add('select_date');
  }   
  
 }
</script>



</tr></table>
</div>
"; 

echo"
</td>";

} else {

echo "<td valign=\"top\" nowrap>";



if($servise[34] == 1){


echo "Посуточно <br />";
if($servise[36] == 1){echo "<hr /><small style=\"color:green;\">Текущая дата активна.</small>";}
else {echo "<hr /><small style=\"color:red;\">Текущая дата закрыта.</small>";}


//Рабочие дни (вывод)
$nowwde = explode("|*", $servise[38]);


echo "<hr /><div id=\"time_edit\">
Рабочие дни:
<table><tr class=\"nwdw\">
<td "; if($nowwde[0] == 1){echo "class=\"nwtd\"";} echo">Пн</td>
<td "; if($nowwde[1] == 1){echo "class=\"nwtd\"";} echo">Вт</td>
<td "; if($nowwde[2] == 1){echo "class=\"nwtd\"";} echo">Ср</td>
<td "; if($nowwde[3] == 1){echo "class=\"nwtd\"";} echo">Чт</td>
<td "; if($nowwde[4] == 1){echo "class=\"nwtd\"";} echo">Пт</td>
<td "; if($nowwde[5] == 1){echo "class=\"nwtd\"";} echo">Сб</td>
<td "; if($nowwde[6] == 1){echo "class=\"nwtd\"";} echo">Вс</td>
</tr></table></div>";
//-----------


} else {
echo"<ul>";
$count = sizeof($servise) ; for ($t = 0 ; $t < $count ; ++$t) { 
if (strpos($servise[$t], 'y') !== false) {
$time = $servise[$t];
$time = str_replace('y', '', $time);
//$time_next = $time+1;
$nexttx = $time+1;
$nextt = mb_strlen($nexttx, 'utf8'); 
if ($nextt == '1')
{$time_next = "0".$nexttx;} else {$time_next = $nexttx;}

$ind_ot = 39+$time;
$ind_do = 63+$time;

if (empty($servise[$ind_ot])) { $min_wot = "00";}
else {$min_wot = $servise[$ind_ot];}


if (empty($servise[$ind_do])) { $min_wdo = "00";}
else {$min_wdo = $servise[$ind_do];}

echo "<li>$time:$min_wot - $time_next:$min_wdo</li>";
}
}
  
  

echo "</ul>"; 
}

if (!empty($servise[33]) && $servise[33] != 1 && $servise[34] != 1) {
echo "<hr /><small>Перерыв:</small> <span style=\"cursor:help;\" title=\"".$break_capt."\">+".$servise[33]."</span> <small>час.</small>";}

//Рабочие дни (вывод)
if ($servise[34] != 1) {
$nowwde = explode("|*", $servise[38]);


echo "<hr /><div id=\"time_edit\">
Рабочие дни:
<table><tr class=\"nwdw\">
<td "; if($nowwde[0] == 1){echo "class=\"nwtd\"";} echo">Пн</td>
<td "; if($nowwde[1] == 1){echo "class=\"nwtd\"";} echo">Вт</td>
<td "; if($nowwde[2] == 1){echo "class=\"nwtd\"";} echo">Ср</td>
<td "; if($nowwde[3] == 1){echo "class=\"nwtd\"";} echo">Чт</td>
<td "; if($nowwde[4] == 1){echo "class=\"nwtd\"";} echo">Пт</td>
<td "; if($nowwde[5] == 1){echo "class=\"nwtd\"";} echo">Сб</td>
<td "; if($nowwde[6] == 1){echo "class=\"nwtd\"";} echo">Вс</td>
</tr></table></div>";} 
//-----------



echo "<small><a href=\"settings.php#rezhim\">Настройки общего<br />режима работы</a></small>
</td>";

}} else {
echo "<td valign=\"top\" nowrap>";



if($servise[34] == 1){
echo "Посуточно <br />";
if($servise[36] == 1){echo "<hr /><small style=\"color:green;\">Текущая дата активна.</small>";}
else {echo "<hr /><small style=\"color:red;\">Текущая дата закрыта.</small>";}

//Рабочие дни (вывод)
$nowwde = explode("|*", $servise[38]);


echo "<hr /><div id=\"time_edit\">
Рабочие дни:
<table><tr class=\"nwdw\">
<td "; if($nowwde[0] == 1){echo "class=\"nwtd\"";} echo">Пн</td>
<td "; if($nowwde[1] == 1){echo "class=\"nwtd\"";} echo">Вт</td>
<td "; if($nowwde[2] == 1){echo "class=\"nwtd\"";} echo">Ср</td>
<td "; if($nowwde[3] == 1){echo "class=\"nwtd\"";} echo">Чт</td>
<td "; if($nowwde[4] == 1){echo "class=\"nwtd\"";} echo">Пт</td>
<td "; if($nowwde[5] == 1){echo "class=\"nwtd\"";} echo">Сб</td>
<td "; if($nowwde[6] == 1){echo "class=\"nwtd\"";} echo">Вс</td>
</tr></table></div>";
//-----------




} else {
echo"<ul>";
$count = sizeof($servise) ; for ($t = 0 ; $t < $count ; ++$t) { 
if (strpos($servise[$t], 'y') !== false) {
$time = $servise[$t];
$time = str_replace('y', '', $time);
//$time_next = $time+1;
$nexttx = $time+1;
$nextt = mb_strlen($nexttx, 'utf8'); 
if ($nextt == '1')
{$time_next = "0".$nexttx;} else {$time_next = $nexttx;}
$ind_ot = 39+$time;
$ind_do = 63+$time;

if (empty($servise[$ind_ot])) { $min_wot = "00";}
else {$min_wot = $servise[$ind_ot];}


if (empty($servise[$ind_do])) { $min_wdo = "00";}
else {$min_wdo = $servise[$ind_do];}

echo "<li>$time:$min_wot - $time_next:$min_wdo</li>";
}
}
  
  

echo "</ul>"; 
}

if (!empty($servise[33]) && $servise[33] != 1 && $servise[34] != 1) {
echo "<hr /><small>Перерыв:</small> <span style=\"cursor:help;\" title=\"".$break_capt."\">+".$servise[33]."</span> <small>час.</small>";}

//Рабочие дни (вывод)
if ($servise[34] != 1) {
$nowwde = explode("|*", $servise[38]);


echo "<hr /><div id=\"time_edit\">
Рабочие дни:
<table><tr class=\"nwdw\">
<td "; if($nowwde[0] == 1){echo "class=\"nwtd\"";} echo">Пн</td>
<td "; if($nowwde[1] == 1){echo "class=\"nwtd\"";} echo">Вт</td>
<td "; if($nowwde[2] == 1){echo "class=\"nwtd\"";} echo">Ср</td>
<td "; if($nowwde[3] == 1){echo "class=\"nwtd\"";} echo">Чт</td>
<td "; if($nowwde[4] == 1){echo "class=\"nwtd\"";} echo">Пт</td>
<td "; if($nowwde[5] == 1){echo "class=\"nwtd\"";} echo">Сб</td>
<td "; if($nowwde[6] == 1){echo "class=\"nwtd\"";} echo">Вс</td>
</tr></table></div>"; }
//-----------




echo "<small><a href=\"settings.php#rezhim\">Настройки общего<br />режима работы</a></small>
</td>";}


if($servise[34] == 1){$ed = 'сут.';} else {$ed = 'час.';}

if (isset($_GET["edit"])) {
if ($_GET["edit"] == $a) {
echo "<td class=\"edit\" valign=\"top\" width=\"180\" style=\"max-width:180px!important;\">
<input type=\"text\" name=\"price_service\" value=\"$servise[25]\" size=\"3\" />
<br /><small>(оставте пустым если бесплатно или поставте знак &laquo;-&raquo; если цена варьируется)</small>
<hr />


<div id=\"h_nt\"></div><br />
<label>
<input type=\"checkbox\" name=\"no_time\" value=\"1\""; if($servise[30] == 1){echo"checked";} echo"/> <small>Да</small></label><br />
<label>

<span class=\"capt\" title=\"".$notime_capt."\">?</span>
</div>
";

//paypal-------------------------------------------------//

echo "<div style=\"clear:both;\"></div><hr />
<label><input type=\"radio\" name=\"mpay\" value=\"\""; if($servise[37] != 1){echo"checked";} else {echo"checked";} echo"/>
<small>Оплата только наличными, по факту</small></label><br /><br />"; 
echo "
<label><input type=\"radio\" name=\"mpay\" value=\"1\""; if($servise[37] == 1){echo"checked";} echo"/>
<small>Оплата только через PayPal</small></label><br /><br />"; 

echo "
<label><input type=\"radio\" name=\"mpay\" value=\"2\""; if($servise[37] == 2){echo"checked";} echo"/>
<small>Предоставлять выбор, оплатить через PayPal или наличными</small></label>"; 

echo "<hr />";

echo"
Количество мест:<br />
<input type=\"number\" min=\"0\" max=\"999\" name=\"spot\" value=\"".$servise[89]."\" style=\"width:120px;\" /><br />
<small>(0 - не устанавливать)</small><hr />";

//if (!empty($servise[89]) && $servise[89] > 0){
echo"
<small>Минимум мест за один заказ:</small><br />
<input type=\"number\" min=\"0\" name=\"spotstop\" value=\"".$servise[90]."\" style=\"width:120px;\" /><br />
<small>(0 - не ограничивать)</small>";

//echo"<input type=\"hidden\" min=\"0\" name=\"spotstop\" value=\"0\" />";
//}


echo "</td>";
} 


else {
echo "<td valign=\"top\" width=\"180\" style=\"max-width:180px!important;\">";

if ($servise[25] > 0 && $servise[30] == 0) {echo" $servise[25]<hr /> <small>в $ed</small><hr />$mpay";}
else if ($servise[25] > 0 && $servise[30] == 1) 
{
if ($servise[34] == 1) 
{echo" $servise[25]<hr /> <small>фиксированная цена</small><hr />$mpay";}
else
{echo" $servise[25]<hr /> <small>не почасовая оплата</small><hr />$mpay";}
}
else if ($servise[25] == '-') {echo "цена варьируется";}

else {echo "бесплатно";}


if (!empty($servise[89]) && $servise[89] > 0){
echo"<hr />
Количество мест: ".$servise[89]."<br />";
if ($servise[90] > 0) {echo"<small>Минимум мест за один заказ: ".$servise[90]."</small><br />";}
}

echo "</td>";} }

//-------------

else {
echo "<td valign=\"top\" width=\"180\" style=\"max-width:180px!important;\">";

if ($servise[25] > 0 && $servise[30] == 0) {echo" $servise[25]<hr /> <small>в $ed</small><hr />$mpay";}
else if ($servise[25] > 0 && $servise[30] == 1) 
{
if ($servise[34] == 1) 
{echo" $servise[25]<hr /> <small>фиксированная цена</small><hr />$mpay";}
else
{echo" $servise[25]<hr /> <small>не почасовая оплата</small><hr />$mpay";}
}
else if ($servise[25] == '-') {echo "цена варьируется";}

else {echo "бесплатно";}

if (!empty($servise[89]) && $servise[89] > 0){
echo"<hr />
Количество мест: ".$servise[89]."<br />";
if ($servise[90] > 0) {echo"<small>Минимум мест за один заказ: ".$servise[90]."</small><br />";}
}

echo "</td>";}


//=============/price



if (isset($_GET["edit"])) {
if ($_GET["edit"] == $a) {

$cur = $servise[26];
$currensy = array(
"RUB" => "Рубли",
"EUR" => "Евро",
"USD" => "Доллары");

echo"<td class=\"edit\" valign=\"top\">
<select name=\"currensy_service\">";
$options = array("RUB", "EUR", "USD");
foreach ($options as $option) {
    echo '<option value="' . $option . '"';
    if ($option == $cur) {echo " selected";} 
    echo ">" . ucfirst($option) . "</option>";}
    echo "</select><hr />"; require_once('../inc/rate.php'); echo "</td>";
} else {echo "<td valign=\"top\">$currensy[$cur] ($cur)</td>"; 
} } else {echo "<td valign=\"top\">$currensy[$cur] ($cur)</td>";}



if (isset($_GET["edit"])) {
if ($_GET["edit"] == $a) {
echo"<td class=\"edit\" valign=\"top\"><select name=\"min_service\">";
$options = array("0", "1", "2", "3", "4", "5", "6", "7", "8");
foreach ($options as $option) {
    echo '<option value="' . $option . '"';
    if ($option==$servise[27]) {echo " selected";} 
    echo ">" . ucfirst($option) . "</option>";
} echo "</select>
<br /><div id=\"min_max\"></div>
<br /><span class=\"capt\" title=\"".$min_capt."\">?</span><div style=\"clear:both;\"></div><hr />
</td>";} 



else {if ($servise[27] != 0) {echo"<td valign=\"top\">$servise[27] $ed</td>";} else {echo"<td valign=\"top\">неограничено</td>";}} } else {if ($servise[27] != 0) {echo"<td valign=\"top\">$servise[27] $ed</td>";} 
else {echo"<td valign=\"top\">неограничено</td>";}}



if (isset($_GET["edit"])) {
if ($_GET["edit"] == $a) {
echo"<td class=\"edit\" valign=\"top\"><select name=\"max_service\">";
$options = array("0", "2", "3", "4", "5", "6", "7", "8");
foreach ($options as $option) {
    echo '<option value="' . $option . '"';
    if ($option==$servise[28]) {echo " selected";} 
    echo ">" . ucfirst($option) . "</option>";
} echo "</select>
<br /><div id=\"min_max01\"></div>
<br /><span class=\"capt\" title=\"".$max_capt."\">?</span><div style=\"clear:both;\"></div><hr />

</td>";} 
else {if ($servise[28] != 0) {echo"<td valign=\"top\">$servise[28] $ed</td>";} else {echo"<td valign=\"top\">неограничено</td>";}} } else {if ($servise[28] != 0) {echo"<td valign=\"top\">$servise[28] $ed</td>";} 
else {echo"<td valign=\"top\">неограничено</td>";}}











if (isset($_GET["edit"])) {
if ($_GET["edit"] == $a) { 



echo "<td class=\"edit\" align=\"center\"><input id=\"submita\" type=\"submit\" name=\"submit\" value=\"Применить\" /><hr /><a href=\"".$script_name."\" class=\"close_link\">Закрыть</a></td></form>";
} else {echo "<td align=\"center\"><div class=\"edit_button\"><a href=\"" . $script_name . "?edit=" . $a . "#$a\" title=\"Редактировать услугу\">
<img src=\"img/pen.png\" width=\"32\" height=\"32\" border=\"0\" alt=\"Редактировать\" /></a></div></td>";} 
} else {echo "<td align=\"center\"><div class=\"edit_button\"><a href=\"" . $script_name . "?edit=" . $a . "#$a\" title=\"Редактировать услугу\">
<img src=\"img/pen.png\" width=\"32\" height=\"32\" border=\"0\" alt=\"Редактировать\" /></a></div></td>";}




echo "<td class=\"del_td\" align=\"center\">

<form name=\"del_img_ser\" method=\"get\">

<input type=\"hidden\" name=\"nlinedel\" value=\"$a\" />
<input type=\"hidden\" name=\"delfile\" value=\"$servise[31]\" />

<input type=\"submit\" onclick =\"return confirm('Удалить услугу: $servise[0]?');\" id=\"delet\" value=\"\" title=\"Удалить услугу\" />

</form>";

}
echo "</td></tr>";

} 
}
?> 
<script type="text/javascript">
function open_close(id_spol) {
var obj = "";
if (document.getElementById) obj = document.getElementById(id_spol).style;
else if (document.all) obj = document.all[id_spol];
else if (document.layers) obj = document.layers[id_spol];
else return 1;

if (obj.display == "") obj.display = "none";
else if (obj.display != "none") obj.display = "none";
else obj.display = "";
}
</script>

<script language="JavaScript">
 function functionvniz(){
document.getElementById('addtr1').scrollIntoView();
}
</script>

<tr><td colspan="8" class="open" onClick="open_close('addtr1'), open_close('addtr2'), functionvniz()"><span><b>+</b> Добавить услугу</span></td></tr>



<tr id="addtr1" style="display:none;">
<form name="add_servise" method="GET" action="add_service.php">
<th class="add_th" width="300" style="max-width:300px; width:300px;">Название и описание услуги</th>
<th class="add_th">Режим работы</th>
<th class="add_th" width="180" style="max-width:180px!important;">Цена</th>
<th class="add_th">Валюта оплаты</th>
<th class="add_th">За один раз разрешено<br />занять не более:</th>
<th class="add_th">Услуга предоставляется<br />не менее чем на:</th>
<th class="add_th" colspan="2">Добавить</th>

</tr>


<tr id="addtr2" style="display:none;">

<td valign="top" width="300" style="max-width:300px; width:300px;">
<input type="text" name="add_name_service" size="22" class="name_s" />
<hr />
Описание: <small>(необязательно)</small><br />
<textarea cols="24" name="deck_service" class="desc_s"></textarea>
<br />
<small>Если нужно установить изображение, вы сможете сделать это после добавления услуги, в режиме редактирования.</small>


<?php
echo "<div style=\"clear:both;\"></div><hr/>
<label>
<input type=\"checkbox\" name=\"sep_srv\" value=\"1\" /> Услуга может предоставляться одновременно с остальными<br /></label>
<span class=\"capt\" title=\"".$sep_capt."\">?</span>
";


//=======================================================Категории ред.


echo'<div style="clear:both;"></div><hr />';

echo'<span class="catv">&#8801; <a href="cat.php">Категории услуг</a></span><br /><br />';

echo'<select name="cat" style="width:100%;">';
echo'<option value=""'; if(empty($servise[87])) {echo' selected ';} echo'>без категории</option>';

$file_cat = "../data/cat.dat";
$catfile = fopen($file_cat,"r") ; 
flock($catfile,LOCK_SH) ; 
$linescat = preg_split("~\r*?\n+\r*?~",fread($catfile,filesize($file_cat))) ;
flock($catfile,LOCK_UN) ; 
fclose($catfile) ; 
$countc = sizeof($linescat); for ($ca = 0 ; $ca < $countc ; ++$ca) {
$catsd = explode("::", $linescat[$ca]); 



echo'<option value="'.$catsd[0].'">'.$catsd[1].'</option>';

}

echo'</select>';

//===========================================/категории




?>
</td>

<td valign="top">

<?php  
echo "
<label><input type=\"checkbox\" name=\"date_srv\" value=\"1\" id=\"date\" onclick=\"check_date02()\" />";
echo "
<script language=\"Javascript\" type=\"text/javascript\">

$(document).ready(function() {
if ($('[name=\"date_srv\"]').attr('checked') == 'checked') {
    
	document.getElementById('h_block02').classList.add('hidden_block');
	document.getElementById('tdh02').classList.remove('hidden_block');
	
	document.getElementById(\"min_max02\").innerHTML='сут.';
	document.getElementById(\"min_max03\").innerHTML='сут.';
    document.getElementById(\"h_nt02\").innerHTML='Фиксированная цена?';
} else { 
    document.getElementById('tdh02').classList.add('hidden_block');
    document.getElementById(\"min_max02\").innerHTML='час.';
	document.getElementById(\"min_max03\").innerHTML='час.';
    document.getElementById(\"h_nt02\").innerHTML='Не почасовая оплата?';
	}
 });
 
window.onbeforeunload = check_date02()
function check_date02(){

  var rarr=document.getElementsByName(\"date_srv\");
  
  if(rarr['0'].checked){
    // выбран первый radio
	
	document.getElementById('h_block02').classList.add('hidden_block');
	document.getElementById('tdh02').classList.remove('hidden_block');
	
	
	document.getElementById(\"min_max02\").innerHTML='сут.';
	document.getElementById(\"min_max03\").innerHTML='сут.';
	document.getElementById(\"h_nt02\").innerHTML='Фиксированая цена?';
  }
   else{
    // выбран второй radio
	document.getElementById('h_block02').classList.remove('hidden_block');
	document.getElementById('tdh02').classList.add('hidden_block');
	
	document.getElementById(\"min_max02\").innerHTML='час.';
	document.getElementById(\"min_max03\").innerHTML='час.';
	document.getElementById(\"h_nt02\").innerHTML='Не почасовая оплата?';
  }   
  
 }
 
 
</script>

";
echo " Услуга предоставляется посуточно </label><hr />";
echo "<div id=\"tdh02\">
<label><input type=\"checkbox\" name=\"tdh\" value=\"1\" /> <small>Разрешить заказы/бронь на текущую дату</small></label>
</div>";

?>

<div id="h_block02">
<?php include("add_time.php"); ?>

<br />

Перерыв:
<select name="losthr">
<option value="0">0</option>
<option value="1" selected>1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
</select><small> (час.)</small>
<span class="capt" title="<?php echo $break_capt; ?>">?</span>
<div style="clear:both;"></div>
</div>
<hr />

<?php

echo "
<div id=\"acalendar\">
<small>Отметьте не рабочие дни:</small>
<table><tr class=\"nwd\">
<td id=\"pa\">
<label><input type=\"checkbox\" name=\"apon\" value=\"1\" onclick=\"check_pa()\" /> <small>Пн</small></label>

<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_pa() 
function check_pa()
{
  var rarr=document.getElementsByName(\"apon\");
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('pa').classList.remove('select_date');
	document.getElementById('pa').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('pa').classList.remove('checked_day');
	document.getElementById('pa').classList.add('select_date');
  }   
 }
</script>

</td>

<td id=\"va\">
<label><input type=\"checkbox\" name=\"avto\" value=\"1\" onclick=\"check_va()\" /> <small>Вт</small></label>

<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_va() 
function check_va()
{
  var rarr=document.getElementsByName(\"avto\");
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('va').classList.remove('select_date');
	document.getElementById('va').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('va').classList.remove('checked_day');
	document.getElementById('va').classList.add('select_date');
  }   
 }
</script>

</td>

<td id=\"sr\">
<label><input type=\"checkbox\" name=\"asre\" value=\"1\" onclick=\"check_sr()\" /> <small>Ср</small></label>

<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_sr() 
function check_sr()
{
  var rarr=document.getElementsByName(\"asre\");
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('sr').classList.remove('select_date');
	document.getElementById('sr').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('sr').classList.remove('checked_day');
	document.getElementById('sr').classList.add('select_date');
  }   
 }
</script>

</td>

<td id=\"ch\">
<label><input type=\"checkbox\" name=\"ache\" value=\"1\" onclick=\"check_ch()\" /> <small>Чт</small></label>

<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_ch() 
function check_ch()
{
  var rarr=document.getElementsByName(\"ache\");
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('ch').classList.remove('select_date');
	document.getElementById('ch').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('ch').classList.remove('checked_day');
	document.getElementById('ch').classList.add('select_date');
  }   
 }
</script>

</td>

<td id=\"pt\">
<label><input type=\"checkbox\" name=\"apat\" value=\"1\" onclick=\"check_pt()\" /> <small>Пт</small></label>

<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_pt() 
function check_pt()
{
  var rarr=document.getElementsByName(\"apat\");
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('pt').classList.remove('select_date');
	document.getElementById('pt').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('pt').classList.remove('checked_day');
	document.getElementById('pt').classList.add('select_date');
  }   
 }
</script>
</td>

<td id=\"sb\">
<label><input type=\"checkbox\" name=\"asub\" value=\"1\" onclick=\"check_sb()\" /> <small>Сб</small></label>

<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_sb() 
function check_sb()
{
  var rarr=document.getElementsByName(\"asub\");
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('sb').classList.remove('select_date');
	document.getElementById('sb').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('sb').classList.remove('checked_day');
	document.getElementById('sb').classList.add('select_date');
  }   
 }
</script>
</td>

<td id=\"vs\">
<label><input type=\"checkbox\" name=\"avos\" value=\"1\" onclick=\"check_vs()\" /> <small>Вс</small></label>

<script language=\"Javascript\" type=\"text/javascript\">
window.onbeforeunload = check_vs() 
function check_vs()
{
  var rarr=document.getElementsByName(\"avos\");
  if(rarr['0'].checked){
    // выбран первый radio
	document.getElementById('vs').classList.remove('select_date');
	document.getElementById('vs').classList.add('checked_day');
  }
   else{
    // выбран второй radio
	document.getElementById('vs').classList.remove('checked_day');
	document.getElementById('vs').classList.add('select_date');
  }   
 }
</script>
</td>

</tr></table>
</div>
";

?>
</td>

<td valign="top" width="180" style="max-width:180px!important;">
<input type="text" name="add_price_service" value="" size="3" />
<br /><small>(оставте пустым если бесплатно или поставте знак &laquo;-&raquo; если цена варьируется)</small>
<hr />

<div id="h_nt02"></div>
<br />
<label><input type="checkbox" name="no_time" value="1" /> <small>Да</small></label><br />

<span class="capt" title="<?php echo $notime_capt; ?>">?</span>

<?php
//paypal-------------------------------------------------//

echo "<div style=\"clear:both;\"></div><hr />
<label><input type=\"radio\" name=\"mpay\" value=\"\" checked />
<small>Оплата только наличными, по факту</small></label><br /><br />"; 
echo "
<label><input type=\"radio\" name=\"mpay\" value=\"1\" />
<small>Оплата только через PayPal</small></label><br /><br />"; 
echo "
<label><input type=\"radio\" name=\"mpay\" value=\"2\" />
<small>Предоставлять выбор, оплатить через PayPal или наличными</small></label>"; 
?>
</td>

<td valign="top">
<select name="add_currensy_service">
<option value="RUB" selected>Рубли</option>
<option value="EUR">Евро</option>
<option value="USD">Доллары</option>
</select>
<hr />
<?php require_once('../inc/rate.php'); ?>
</td>

<td valign="top">
<select name="add_min_service">
<option value="0" selected>0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
</select>
<br />
<div id="min_max02"></div>
<br />
<span class="capt" title="<?php echo $min_capt; ?>">?</span><div style="clear:both;"></div><hr />
</td>

<td valign="top">
<select name="add_max_service">
<option value="0" selected>0</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
</select>
<br />
<div id="min_max03"></div>
<br />
<span class="capt" title="<?php echo $max_capt; ?>">?</span><div style="clear:both;"></div><hr />
</td>
<input type="hidden" name="idser" value="<?php echo $ids; ?>" />
<td colspan="2" align="center"><input type="submit" name="add" value="Добавить" /></td>

</form>
</tr>



</table>
</div>

<? } ?>
 

 </div>

<br />
<?php include("footer.php"); ?>