<? include ('header.php');

$script_name = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'].""; 
$file_name = "../data/cat.dat"; 
$dir = "../data/pict/"; 
$idc = date('dmYHms');
$rnd_num = date('dHms');
$adate = date('d-m-Y');
$crlf = "\n"; 

// проверка формы для редактирования

//==== NAME CAT
if($_GET['name_cat']){

$_GET['name_cat'] = str_replace(array('::', '||', '**'), '', trim($_GET['name_cat']));

$_GET['name_cat'] = str_replace('\"','&quot;',$_GET['name_cat']);
$_GET['name_cat'] = str_replace('"','&quot;',$_GET['name_cat']);

$_GET['name_cat'] = str_replace("\'",'',$_GET['name_cat']);
$_GET['name_cat'] = str_replace("'",'',$_GET['name_cat']);

$_GET['name_cat'] = preg_replace('/\\\\+/','',$_GET['name_cat']); 

$_GET['name_cat'] = preg_replace("|[\r\n]+|", " ", $_GET['name_cat']); 
$_GET['name_cat'] = preg_replace("|[\n]+|", " ", $_GET['name_cat']); 
}
if(!$_GET['name_cat']){
$ERROR["name_cat"]["text"] = "Введите название категории.";
} else { if((strlen($_GET['name_cat'])<3)){
$ERROR["name_cat"]["text"] = "Название введено не корректно.<br />Поле должно содержать только буквы и цифры и быть не менее 3х символов.";
} }
if (strlen($_GET['name_cat'])>70) {$ERROR["name_cat"]["text"] = "Название слишком длинное.";}


//==== DECRIPTION CAT
$_GET['desk_cat'] = str_replace(array('::', '||', '**'), '', trim($_GET['desk_cat']));

$_GET['desk_cat'] = str_replace('\"','&quot;',$_GET['desk_cat']);
$_GET['desk_cat'] = str_replace('"','&quot;',$_GET['desk_cat']);

$_GET['desk_cat'] = str_replace("\'",'',$_GET['desk_cat']);
$_GET['desk_cat'] = str_replace("'",'',$_GET['desk_cat']);

$_GET['desk_cat'] = preg_replace('/\\\\+/','',$_GET['desk_cat']); 

$_GET['desk_cat'] = preg_replace("|[\r\n]+|", " ", $_GET['desk_cat']); 
$_GET['desk_cat'] = preg_replace("|[\n]+|", " ", $_GET['desk_cat']); 

if (strlen($_GET['desk_cat'])>900) {$ERROR["desk_cat"]["text"] = "Описание слишком длинное.";}
//---/проверка

//=====================Добавление

$line_data_add = $idc.'::'.$_GET['name_cat'].'::'.$_GET['desk_cat'].'::'.$adate;


if (array_key_exists('add',$_GET)){
if (is_array($ERROR)) {

echo "
<script language=\"javascript\">
    var delay = 5000;
    setTimeout(\"document.location.href='javascript:history.back();'\", delay);
    </script>
<span class=\"error\">";
foreach($ERROR as $key => $value){
echo "" . $ERROR[$key]["text"] . "<br />";
}
echo "</span></div></body></html>"; exit;

} else {


define('FILENAME_CT', $file_name);
if (!file_get_contents(FILENAME_CT))
{


$fp=fopen("$file_name", "a+"); 
fputs
($fp, "$line_data_add\r"); 
fclose($fp);


} else {
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
//$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 


$fp=fopen("$file_name", "a+"); 
fputs
($fp, "\n$line_data_add\r"); 
fclose($fp);}

echo "<div class=\"done\">Категория добавлена.</div><br /><br />
<script language=\"javascript\">
    var delay = 2000;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script>
	<noscript><meta http-equiv=\"refresh\" content=\"2; url=".$script_name."\"></noscript>";
echo "</div></body></html>"; exit;
}
}



//=====================Перезапись

$line_data_r = $_GET['id_cat'].'::'.$_GET['name_cat'].'::'.$_GET['desk_cat'].'::'.$adate;

$nl = $_GET['nline'];

if (array_key_exists('repl',$_GET)){
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
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script><noscript><meta http-equiv=\"refresh\" content=\"2; url=".$script_name."\"></noscript>";
    echo "</div></body></html>"; exit;       	   
		   
        } else {
            echo "<span class=\"error\">Файл недоступен для записи</span>";
            exit;
        }
    } else {
        echo "<span class=\"error\">Строка не найдена</span>";
        exit;
    }
 
} else {
    echo "<span class=\"error\">Файл пуст</span>";
    exit;
}
}
}

// =====================================Блок ПЕРЕМЕЩЕНИЯ ВВЕРХ/ВНИЗ

if(isset($_GET['moves'])) { if ($_GET['moves'] !="") {
$move1=$_GET['moves']; $where=$_GET['where']; 
if ($where=="0") $where="-1";
$move2=$move1-$where;

$file=file($file_name);
 

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
$del_l_line = "?delet_moves=".$imax."#".$_GET['moves']."";
} 

else if ($move2 == $imax-1) { //предпоследняя вниз!!!
$data1=$nl.$file[$move1]; 
$data2=$file[$move2];
$del_l_line = "?delet_moves=".$imax."#".$_GET['moves']."";
}

else {
$data1=$file[$move1]; 
$data2=$file[$move2];
$del_l_line = "#".$_GET['moves']."";
}

//$data1=$file[$move1]; 
//$data2=$file[$move2];


$fp=fopen($file_name, "a+"); 
 

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
    </script><noscript><meta http-equiv=\"refresh\" content=\"0; url=".$script_name."".$del_l_line."\"></noscript>
	</div></body></html>
	"; exit; }}

//=============================/перемещение





//======================================================DELET
if (isSet($_GET['delet']) == true) {

$file = fopen($file_name,"r+") ; 
    flock($file,LOCK_EX) ; 
    @$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;	

//Убиваем
	
    if (isSet($lines[(integer) $_GET['delet']]) == true) 
    {   unset($lines[(integer) $_GET['delet']]) ; 
        @fseek($file,0) ; 
        $data_size = 0 ; 
        @ftruncate($file,fwrite($file,implode($crlf,$lines))) ; 
        @fflush($file) ; 
    } 

    @flock($file,LOCK_UN) ; 
    @fclose($file) ; 

	
echo"
<span class=\"error\"><i class=\"icon-ok\"></i>Категория удалена.</span>
<script language=\"javascript\">
    var delay = 1200;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script>
	<noscript><meta http-equiv=\"refresh\" content=\"1; url=".$script_name."\"></noscript>
	
	</div></body></html>
"; exit;
} //delet

//======================================================DELET Moves
if (isSet($_GET['delet_moves']) == true) {

$file = fopen($file_name,"r+") ; 
    flock($file,LOCK_EX) ; 
    @$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;	

//Убиваем
	
    if (isSet($lines[(integer) $_GET['delet_moves']]) == true) 
    {   unset($lines[(integer) $_GET['delet_moves']]) ; 
        @fseek($file,0) ; 
        $data_size = 0 ; 
        @ftruncate($file,fwrite($file,implode($crlf,$lines))) ; 
        @fflush($file) ; 
    } 

    @flock($file,LOCK_UN) ; 
    @fclose($file) ; 

echo"
<script language=\"javascript\">
    var delay = 0;
    setTimeout(\"document.location.href='".$script_name."'\", delay);
    </script>
	<noscript><meta http-equiv=\"refresh\" content=\"0; url=".$script_name."\"></noscript>
	
	</div></body></html>
"; exit;
} //======================delet moves


//==============Вывод

//определяем константу для имени файла
define('FILENAME_WCT', $file_name);

// проверяем наличие содержимого в файле, считывая содержимое файла в строку
if (!file_get_contents(FILENAME_WCT))
         { echo '<div class="mess">Категорий в базе нет</div>';}
else {
    // если есть, выводим


if (is_array($ERROR)) {
echo '<div id="b_table">

<table><tr>

<th class="nnsort"></th>
<th class="nn">№</th>
<th>Название</th>
<th>Описание</th>
<th>Дата</th>
<th width="60" style="width:60px!important;">редактировать</th>
<th width="60" style="width:60px!important;">удалить</th>
</tr>';


//=========================================строки
$file = fopen($file_name,"r") ; 
flock($file,LOCK_SH) ; 
$lines = preg_split("~\r*?\n+\r*?~",fread($file,filesize($file_name))) ;
flock($file,LOCK_UN) ; 
fclose($file) ; 

$count = sizeof($lines); for ($a = 0 ; $a < $count ; ++$a) {

$nnn = count($lines)+1;

$nn = $a+1;

if (isset($_GET['edit']) && $_GET['edit'] == $a) { //edit


echo '<tr>';
echo '<form name="edit" method="get" action="'.$script_name.'">';
echo '<td class="nnsort" align="center"><a name="'.$a.'"></a>';
if ($a != 0) 
{echo '<a href="?moves='.$a.'&where=1" title="переместить строку выше">&#9650;</a>';} 
else {echo'<span>&#9650;</span>';}
if ($a != $nnn-2) 
{echo '<a href="?moves='.$a.'&where=0" title="переместить строку вниз">&#9660;</a>';}
else {echo'<span>&#9660;</span>';}
echo '</td>';	

echo '<td class="nn">'.$nn.'</td>';	

$tdata = explode("::", $lines[$a]); 
//array_pop($tdata);

echo '<td class="" valign="top"><input type="text" name="name_cat" value="'.$tdata[1].'" class="name_s" /></td>';

echo '<td class="" valign="top"><textarea name="desk_cat" style="width:300px;">'.$tdata[2].'</textarea></td>';

echo '<td class="" valign="top">'.$adate.'</td>';

echo '<input type="hidden" name="nline" value="'.$a.'" />';
echo '<input type="hidden" name="id_cat" value="'.$tdata[0].'" />';	
echo '<input type="hidden" name="repl" value="yes" />';	

echo '<td class="" align="center"><a href="javascript:document.edit.submit()" title="Сохранить">Сохранить</a></td>';
echo '<td class="" align="center"><a href="'.$script_name.'#'.$a.'" title="Отменить">Закрыть</a></td>';	
echo '</form>';
echo '</tr>';



} else { // view

echo '<tr>';

echo '<td class="nnsort" align="center"><a name="'.$a.'"></a>';
if ($a != 0) 
{echo '<a href="?moves='.$a.'&where=1" title="переместить строку выше">&#9650;</a>';} 
else {echo'<span>&#9650;</span>';}
if ($a != $nnn-2) 
{echo '<a href="?moves='.$a.'&where=0" title="переместить строку вниз">&#9660;</a>';}
else {echo'<span>&#9660;</span>';}
echo '</td>';	

echo '<td class="nn" align="center">'.$nn.'</td>';	

$tdata = explode("::", $lines[$a]); 
//array_pop($tdata);

echo '<td><strong>'.$tdata[1].'</strong></td>';

echo '<td><i>'.$tdata[2].'</i></td>';

echo '<td>'.$tdata[3].'</td>';

echo '<td align="center"><div class="edit_button"><a href="'.$script_name.'?edit='.$a.'#'.$a.'" title="Редактировать категорию">
<img src="img/pen.png" width="32" height="32" border="0" alt="Редактировать" /></a></div></td>';


echo '<td class="del_td" align="center"><a href="?delet='.$a.'" title="Удалить" onclick ="return confirm(\'Удалить категорию: '.$tdata[1].'?\');"><img src="img/trash.png" width="32" height="32" border="0" alt="Удалить" /></a></td>';	

echo '</tr>';




}//edit - view

} //count lines

} //файл не пуст

} //no error
echo '</table></div>';
echo'

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
document.getElementById("addtr1").scrollIntoView();
}
</script>';


echo"
<div id=\"b_table\">
<table>
<tr><td colspan=\"8\" class=\"open\" onClick=\"open_close('addtr1'), open_close('addtr2'), functionvniz()\"><span><b>+</b> Добавить категорию</span></td></tr>";


echo'
<tr id="addtr1" style="display:none;">
<form name="addcat" method="get" action="'.$script_name.'">

<th class="nn add_th" align="center">№</th>

<th class="add_th">Название</th>
<th class="add_th">Описание</th>
<th class="add_th">Дата</th>

<th class="add_th" width="60"></th>
</tr>
';

echo'<tr id="addtr2" style="display:none;">';

echo '<td class="nn edit" valign="top">'.$nnn.'</td>';

echo '<td class="edit" valign="top"><input type="text" name="name_cat" value="" /></td>';

echo '<td class="edit" valign="top"><textarea name="desk_cat" style="width:300px;"></textarea></td>';

echo '<td class="edit">'.$adate.'</td>';



echo'<td align="center"><input type="submit" name="add" value="Добавить" /></td>';

echo '</tr>';



echo '</table></div>';
	




include ('footer.php');
?>