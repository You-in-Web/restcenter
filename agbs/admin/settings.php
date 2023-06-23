<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
include("header.php"); 
include("d_calendar.php");
include("d_calendar_n.php");

$access = array();  
$access = file("../data/access.php");  
// Разносим значения по переменным – пропуская первую строку файла - 0  
$login = trim($access[1]);  
$passw = trim($access[2]);  


// местоположение скрипта
$self = $_SERVER['PHP_SELF']; 

unset($ERROR);//на всякий пожарный, чтоб лишнего не выплыло
// проверка формы имени и пароля 
$admin_name=trim(htmlspecialchars($_POST["admin_name"]));
if(!$_POST['admin_name']){
$ERROR["admin_name"]["text"] = "Введите имя администратора.";
} else { if((strlen($_POST['admin_name'])<3) || (preg_match("/[^a-zA-Z0-9а-яА-Я ]/u", $_POST['admin_name']))){
$ERROR["admin_name"]["text"] = "Имя администратора должно содержать только буквы и цифры и быть не менее 3х символов.";
} }

$admin_pass = $_POST['admin_pass'];
if(!$_POST['admin_pass']){
$ERROR["admin_pass"]["text"] = "Пароль не может быть пустым";
} else { if((strlen($_POST['admin_pass'])<3) || (preg_match("/[^a-zA-Z0-9а-яА-Я ]/u", $_POST['admin_pass']))){
$ERROR["admin_pass"]["text"] = "Пароль содержит недопустимые символы или менее 3х знаков.";
} }
if ($admin_pass == 'admin'){$ERROR["admin_pass"]["text"] = "Введите свой пароль.";}
$nosaadd = $_POST['admin_pass'];
// проверка формы почтовых настроек 

$_POST["title_com_e"] = str_replace(array('\"'), '', trim($_POST["title_com_e"]));
$title_com_e = trim(htmlspecialchars($_POST["title_com_e"]));


$email_com_e=trim(htmlspecialchars($_POST["email_com_e"]));
if(!$_POST['email_com_e']){
$ERROR1["email_com_e"]["text"] = "Введите E-mail организации.";
} else {if(!preg_match('/.+@.+\..+/i', $_POST['email_com_e'])){
$ERROR1["email_com_e"]["text"] = "E-mail организации введён не корректно.";
} }


$_POST["caption_mail_e"] = str_replace(array('\"'), '', trim($_POST["caption_mail_e"]));
$caption_mail_e=trim(htmlspecialchars($_POST["caption_mail_e"]));


$admin_email_e=trim(htmlspecialchars($_POST["admin_email_e"]));
if(!$_POST['admin_email_e']){
$ERROR1["admin_email_e"]["text"] = "Введите E-mail администратора.";
} else {if(!preg_match('/.+@.+\..+/i', $_POST['admin_email_e'])){
$ERROR1["admin_email_e"]["text"] = "E-mail администратора введён не корректно.";
}}




$_POST["caption_order_e"] = str_replace(array('\"'), '', trim($_POST["caption_order_e"]));
$caption_order_e=trim(htmlspecialchars($_POST["caption_order_e"]));

$calendar_type_e = $_POST["calendar_type_e"];

$dd1 = $_POST["dd1"];
$dd2 = $_POST["dd2"];
$dd3 = $_POST["dd3"];
$dd4 = $_POST["dd4"];
$dd5 = $_POST["dd5"];
$dd6 = $_POST["dd6"];
$dd7 = $_POST["dd7"];
$dd8 = $_POST["dd8"];
$dd9 = $_POST["dd9"];
$dd10 = $_POST["dd10"];
$dd11 = $_POST["dd11"];
$dd12 = $_POST["dd12"];
$dd13 = $_POST["dd13"];
$dd14 = $_POST["dd14"];
$dd15 = $_POST["dd15"];
$dd16 = $_POST["dd16"];
$dd17 = $_POST["dd17"];
$dd18 = $_POST["dd18"];
$dd19 = $_POST["dd19"];
$dd20 = $_POST["dd20"];
$dd21 = $_POST["dd21"];
$dd22 = $_POST["dd22"];
$dd23 = $_POST["dd23"];
$dd24 = $_POST["dd24"];
$dd25 = $_POST["dd25"];
$dd26 = $_POST["dd26"];
$dd27 = $_POST["dd27"];
$dd28 = $_POST["dd28"];
$dd29 = $_POST["dd29"];
$dd30 = $_POST["dd30"];
$dd31 = $_POST["dd31"];

//--------------------------------------------------------------

$dd_n1 = $_POST["dd_n1"];
$dd_n2 = $_POST["dd_n2"];
$dd_n3 = $_POST["dd_n3"];
$dd_n4 = $_POST["dd_n4"];
$dd_n5 = $_POST["dd_n5"];
$dd_n6 = $_POST["dd_n6"];
$dd_n7 = $_POST["dd_n7"];
$dd_n8 = $_POST["dd_n8"];
$dd_n9 = $_POST["dd_n9"];
$dd_n10 = $_POST["dd_n10"];
$dd_n11 = $_POST["dd_n11"];
$dd_n12 = $_POST["dd_n12"];
$dd_n13 = $_POST["dd_n13"];
$dd_n14 = $_POST["dd_n14"];
$dd_n15 = $_POST["dd_n15"];
$dd_n16 = $_POST["dd_n16"];
$dd_n17 = $_POST["dd_n17"];
$dd_n18 = $_POST["dd_n18"];
$dd_n19 = $_POST["dd_n19"];
$dd_n20 = $_POST["dd_n20"];
$dd_n21 = $_POST["dd_n21"];
$dd_n22 = $_POST["dd_n22"];
$dd_n23 = $_POST["dd_n23"];
$dd_n24 = $_POST["dd_n24"];
$dd_n25 = $_POST["dd_n25"];
$dd_n26 = $_POST["dd_n26"];
$dd_n27 = $_POST["dd_n27"];
$dd_n28 = $_POST["dd_n28"];
$dd_n29 = $_POST["dd_n29"];
$dd_n30 = $_POST["dd_n30"];
$dd_n31 = $_POST["dd_n31"];

$allow_sms_e = $_POST["allow_sms_e"];
$admin_phone1_e = $_POST["admin_phone1_e"];
$api_id_sms_e = $_POST["api_id_sms_e"];
$sms_ot_e = $_POST["sms_ot_e"];
$sms_do_e = $_POST["sms_do_e"];
$transl_sms_e = $_POST["transl_sms_e"];

$interval_e = $_POST["interval_e"];

$lost_hr_e = $_POST["lost_hr_e"];

$formul_e = $_POST["formul_e"];

$shed_e = $_POST["shed_e"];

$steps_e = $_POST["steps_e"];

$captcha_e = $_POST["captcha_e"];

$style_e = $_POST["style_e"];

$paym_e = $_POST["paym_e"];

$paya_e = $_POST["paya_e"];

$horus_e = $_POST["horus_e"];

$color_e = $_POST["color_e"];
if (empty($_POST["color_e"])) {$color_e = '#eb3f16';}



//--записываем новые логин и пароль
if (array_key_exists('admin_access',$_POST)){
if (is_array($ERROR)) {


foreach($ERROR as $key => $value){
echo "<span class=\"error\">" . $ERROR[$key]["text"] . "</span>
<script language='Javascript' type='text/javascript'>
  <!--
  function reload()
  {location = \"$self\"}; 
  setTimeout('reload()', 3000);
  -->
  </script>
"; die;}


} else { 
$admpas = sha1($admin_pass);
$fp=fopen("../data/access.php", "wb"); 
fputs
($fp, "<?php die; ?>\r\n$admin_name\r\n$admpas\r\n$nosaadd"); 
fclose($fp);

echo "<div class=\"done\">Данные для доступа изменены! Выполните вход.</div>";
echo "
<script language='Javascript' type='text/javascript'>
  <!--
  function reload()
  {location = \"$self\"}; 
  setTimeout('reload()', 3000);
  -->
  </script>";
} }
?>



<?php if(is_array($ERROR1) && is_array($ERROR)){ ?>
<div id="b_table_settings">

<form name="admin" method="post" action="<?php echo $self; ?>">
<table class="accad">
<tr><th colspan="2">Сменить учетные данные</th></tr>

<tr>
<td width="190" valign="top">Имя администратора:</td>
<td valign="top"><input type="text" name="admin_name" value="<?php echo $login;?>" /></td>
</tr>

<tr>
<td valign="top">Пароль:</td>
<td valign="top"><input type="password" name="admin_pass" value="admin" /></td>
</tr>

<tr>
<td colspan="2" align="center">
<input type="submit" name="admin_access" value="Применить" />
</td>
</tr>
</table>
</form>
</div>
<br />
<?php } ?>

<?php
//--записываем данные по настройкам
if (array_key_exists('email_settings',$_POST)){
if (is_array($ERROR1)) {

echo "<ul class=\"error\">";
foreach($ERROR1 as $key => $value){
echo "<li>" . $ERROR1[$key]["text"] . "</li>";}
echo "</ul>";

} else { 

$fp=fopen("../data/config.php", "wb"); 
fputs
($fp, '<?php 
$title_com = "'.$title_com_e.'"; 
$com_email = "'.$email_com_e.'"; 
$admin_email = "'.$admin_email_e.'"; 
$caption_mail = "'.$caption_mail_e.'";
$caption_order = "'.$caption_order_e.'";
$calendar_type = "'.$calendar_type_e.'";
$date_dis = array(
"1" => "'.$dd1.'",
"2" => "'.$dd2.'",
"3" => "'.$dd3.'",
"4" => "'.$dd4.'",
"5" => "'.$dd5.'",
"6" => "'.$dd6.'",
"7" => "'.$dd7.'",
"8" => "'.$dd8.'",
"9" => "'.$dd9.'",
"10" => "'.$dd10.'",
"11" => "'.$dd11.'",
"12" => "'.$dd12.'",
"13" => "'.$dd13.'",
"14" => "'.$dd14.'",
"15" => "'.$dd15.'",
"16" => "'.$dd16.'",
"17" => "'.$dd17.'",
"18" => "'.$dd18.'",
"19" => "'.$dd19.'",
"20" => "'.$dd20.'",
"21" => "'.$dd21.'",
"22" => "'.$dd22.'",
"23" => "'.$dd23.'",
"24" => "'.$dd24.'",
"25" => "'.$dd25.'",
"26" => "'.$dd26.'",
"27" => "'.$dd27.'",
"28" => "'.$dd28.'",
"29" => "'.$dd29.'",
"30" => "'.$dd30.'",
"31" => "'.$dd31.'"); 
//-----------------------
$date_dis_n = array(
"1" => "'.$dd_n1.'",
"2" => "'.$dd_n2.'",
"3" => "'.$dd_n3.'",
"4" => "'.$dd_n4.'",
"5" => "'.$dd_n5.'",
"6" => "'.$dd_n6.'",
"7" => "'.$dd_n7.'",
"8" => "'.$dd_n8.'",
"9" => "'.$dd_n9.'",
"10" => "'.$dd_n10.'",
"11" => "'.$dd_n11.'",
"12" => "'.$dd_n12.'",
"13" => "'.$dd_n13.'",
"14" => "'.$dd_n14.'",
"15" => "'.$dd_n15.'",
"16" => "'.$dd_n16.'",
"17" => "'.$dd_n17.'",
"18" => "'.$dd_n18.'",
"19" => "'.$dd_n19.'",
"20" => "'.$dd_n20.'",
"21" => "'.$dd_n21.'",
"22" => "'.$dd_n22.'",
"23" => "'.$dd_n23.'",
"24" => "'.$dd_n24.'",
"25" => "'.$dd_n25.'",
"26" => "'.$dd_n26.'",
"27" => "'.$dd_n27.'",
"28" => "'.$dd_n28.'",
"29" => "'.$dd_n29.'",
"30" => "'.$dd_n30.'",
"31" => "'.$dd_n31.'"); 
$allow_sms = "'.$allow_sms_e.'";
$admin_phone1 = "'.$admin_phone1_e.'";
$api_id_sms = "'.$api_id_sms_e.'";
$sms_ot = "'.$sms_ot_e.'";
$sms_do = "'.$sms_do_e.'";
$transl_sms = "'.$transl_sms_e.'";
$interval = "'.$interval_e.'";
$formul = "'.$formul_e.'";
$shed = "'.$shed_e.'";
$steps = "'.$steps_e.'";
$acaptcha = "'.$captcha_e.'";
$style = "'.$style_e.'";
$paym = "'.$paym_e.'";
$paya = "'.$paya_e.'";
$horus = "'.$horus_e.'";
$color = "#'.$color_e.'";
?>'); 
fclose($fp);

echo "<div class=\"done\">Изменения приняты.</div>";

echo '
<script language="Javascript" type="text/javascript">
 
  function reload()
  {location = "'.$self.'"}; 
  setTimeout("reload()", 2000);
  </script>';
} }

?>


<?php if(is_array($ERROR1) && is_array($ERROR)){ ?>

<div id="b_table_settings">
<form name="email_s" method="post" action="<?php echo $self; ?>">
<table>
<tr><th colspan="2">Настройки</th></tr>
<tr>
<td width="190" valign="top">Название организации:</td>
<td valign="top">
<input type="text" name="title_com_e" value="<?php echo $title_com;?>" />
</td>
</tr>

<tr>
<td valign="top">E-mail организации:<br />
<small>С этого адреса будут приходить уведомления заказчику.</small></td>
<td valign="top"><input type="text" name="email_com_e" value="<?php echo $com_email;?>" /></td>
</tr>

<tr>
<td valign="top">E-mail администратора:<br />
<small>На этот адрес будут приходить копиии уведомлений.</small></td>
<td valign="top"><input type="text" name="admin_email_e" value="<?php echo $admin_email;?>" /></td>
</tr>

<tr>
<td valign="top">Подпись в письме заказчику:<br />
<small>Текст внизу уведомления.</small></td>
<td valign="top"><textarea name="caption_mail_e"><?php echo $caption_mail;?></textarea></td>
</tr>

<tr>
<td valign="top">Дополнительная информация:<br />
<small>Текст выводимый пользователю после совершения заказа.</small></td>
<td valign="top"><textarea name="caption_order_e"><?php echo $caption_order;?></textarea></td>
</tr>



<tr>
<td valign="top"><a name="rezhim"></a>Режим работы:<br />
<small>Выберете тип календаря.</small></td>

<td valign="top" nowrap>
<!--<select name="calendar_type_e" style="width:40px;">
<?php
//$options = array("0", "1", "2", "3");
//foreach ($options as $option) {
//echo '<option value="' . $option . '"';
//if ($option == $calendar_type) {echo " selected";} 
//echo ">" . ucfirst($option) . "</option>";}
?>
</select>--->
<ul style="list-style-type: none; margin: 0; padding: 0;">
<li><label><input type="radio" value="0" name="calendar_type_e" <?php if ($calendar_type == '0') {echo "checked ";}?>/> - Доступны все дни</label></li>
<li><label><input type="radio" value="1" name="calendar_type_e" <?php if ($calendar_type == '1') {echo "checked ";}?>/> - Только выходные</label></li>
<li><label><input type="radio" value="2" name="calendar_type_e" <?php if ($calendar_type == '2') {echo "checked ";}?>/> - Только будни</label></li>
<li><label><input type="radio" value="3" name="calendar_type_e" <?php if ($calendar_type == '3') {echo "checked ";}?>/> - Отключить приём заказов </label></li>
</ul>

<small>Если имеются отмеченные (не рабочие) дни в<br />календарях, они так же останутся не активными.</small>
</td>
</tr>


<tr>
<td valign="top">
Задействовать активный интервал:<br />
<small>Для бронирования\заказов будет доступен только текущий и следующий месяц:</small><br />
</td>
<td valign="top">
<label><input type="radio" value="0" name="interval_e" <?php if ($interval == '0') {echo "checked ";}?>/>Да</label><br />
<label><input type="radio" value="1" name="interval_e" <?php if ($interval == '1') {echo "checked ";}?>/>Нет</label><br />
<small>Если нет, то сделать заказ можно на любой не истёкший месяц.</small>
</td>
</tr>


<tr>
<td valign="top">Не рабочие дни <br />в текущем месяце - <br /><strong><?php echo "$Month_n[$month]"; ?></strong><br />
</td>
<td valign="top">
<div id="acalendars">

<?php echo $calendar . "</tr></table>"; ?>

</div>
</td>
</tr>


<tr>
<td valign="top">Не рабочие дни <br />в cледующем месяце - <br /><strong><?php echo $Month_n[$month_next]; ?></strong><br />
</td>
<td valign="top">
<div id="acalendars">

<?php echo $calendar_n . "</tr></table>"; ?>

</div>
<br />
<small>Выберете дни, которые будут недоступны для бронирования\заказов.</small><hr />
<small><span class="error_m">Внимание.</span><br />
При переходе на следующий месяц, отмеченные числа будут перенесены. Необходимо актуализировать эти настройки с началом каждого месяца.</small>
</td>
</tr>





<tr>
<td valign="top">SMS <!-- <sup><small style="color:red;">(beta)</small></sup> --><br />
<small>Что бы получать сообщения о заказах, зарегестрируйтесь на <a href="http://sms.ru" target="_blank" title="Отправка sms на зарегистрированный номер - бесплатно. (Сайт откроется в новой вкладке.)">sms.ru</a></small>
<br />
<span class="capt" title="Формат сообщений: [ЗАКАЗ - Имя заказчика номер тел. Услуга Дата Время] Внимание. Сообщения автоматически обрезаются до 70 символов, при включенной транслитерации до 160, т.к. sms с большем кол-вом символов не доставляются.">?</span>
</td>

<td valign="top" nowrap>


<label><input type="checkbox" value="1" name="allow_sms_e" id="act_in" onClick="submit_forms()" <?php if ($allow_sms == '1') {echo "checked ";}?> /> Включить уведомления по sms</label>
<br />
<br />
<small>Номер телефона администратора:</small><br />
<input type="text" name="admin_phone1_e" value="<?php echo $admin_phone1;?>" id="phone1" disabled /> <small>правило ввода: 79005553311</small>


<br /><br />

<small>Ваш <b>api_id</b> на sms.ru</small><br />
<input type="text" name="api_id_sms_e" value="<?php echo $api_id_sms;?>" id="apiid" style="width: 100%;" disabled />
<br /><br />
Время получения сообщений:
<br />
<small>С:</small> <select name="sms_ot_e" id="mot" style="width:60px;">
<?php
$options = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23");
foreach ($options as $option) {
echo '<option value="' . $option . '"';
if ($option == $sms_ot) {echo " selected";} 
echo ">" . ucfirst($option) . "</option>";}
?>
</select><small>:00</small>

&#160;<small>-</small>&#160;

<small>До:</small> <select name="sms_do_e" id="mdo" style="width:60px;">
<?php
$options = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23");
foreach ($options as $option) {
echo '<option value="' . $option . '"';
if ($option == $sms_do) {echo " selected";} 
echo ">" . ucfirst($option) . "</option>";}
?>
</select><small>:00</small>

<script language="JavaScript">
function submit_forms() {

      var chkInput = document.getElementById('act_in');

var txtInput1 = document.getElementById('phone1');	  
var txtInput2 = document.getElementById('apiid');

var txtInput3 = document.getElementById('mot');
var txtInput4 = document.getElementById('mdo');	  

      txtInput1.disabled = !chkInput.checked;
	  txtInput2.disabled = !chkInput.checked;
	  txtInput3.disabled = !chkInput.checked;
	  txtInput4.disabled = !chkInput.checked;
}
</script>
<br /><br />
<label><input type="checkbox" value="1" name="transl_sms_e" <?php if ($transl_sms == '1') {echo "checked ";}?> /> Включить транслитерацию сообщений <br />(рекомендуется)</label><br />
<small>При включенной транслитерации русские буквы<br />переводятся в латинские и количество символов<br />в sms увеличивается с 70 до 160.</small>
</td>
</tr>


<tr>
<td valign="top">Включить каптчу:<br />
<small>Защита от автоматической отправки формы заказа(требуется ввести код с картинки).</small></td>

<td valign="top" nowrap>

<label><input type="radio" value="1" name="captcha_e" <?php if ($acaptcha == '1') {echo "checked ";}?>/> Да </label><br/>
<label><input type="radio" value="0" name="captcha_e" <?php if ($acaptcha == '0') {echo "checked ";}?>/> Нет </label>

<br />

</td>
</tr>

<tr>
<td valign="top">
Расписание:<br />
<small>Показывать расписание посетителям:</small><br />
</td>
<td valign="top">
<label><input type="radio" value="1" name="shed_e" <?php if ($shed == '1') {echo "checked ";}?>/>Да</label><br />
<label><input type="radio" value="0" name="shed_e" <?php if ($shed == '0') {echo "checked ";}?>/>Нет</label><br />

</td>
</tr>

<tr>
<td valign="top">
Индикация шагов:<br />
<small>Отображать панель индикации шагов:</small><br />
</td>
<td valign="top">
<label><input type="radio" value="1" name="steps_e" <?php if ($steps == '1') {echo "checked ";}?>/>Да</label><br />
<label><input type="radio" value="0" name="steps_e" <?php if ($steps == '0') {echo "checked ";}?>/>Нет</label><br />

</td>
</tr>



<tr>
<td valign="top">Формулировка:<br />
<small>Выберете как должно формулироваться действие системы:</small></td>

<td valign="top" nowrap>

<label><input type="radio" value="1" name="formul_e" <?php if ($formul == '1') {echo "checked ";}?>/> Забронировать </label><br/>
<label><input type="radio" value="2" name="formul_e" <?php if ($formul == '2') {echo "checked ";}?>/> Заказать </label>

<br />

</td>
</tr>


<tr>
<td valign="top">Фон:<br />
<small>Выберете тему оформления:</small></td>

<td valign="top" nowrap>
<label><input type="radio" value="3" name="style_e" <?php if ($style == '3') {echo "checked ";}?>/> Albus (светлая)</label><br/>
<label><input type="radio" value="1" name="style_e" <?php if ($style == '1') {echo "checked ";}?>/> Argentum (нейтральная)</label><br/>
<label><input type="radio" value="2" name="style_e" <?php if ($style == '2') {echo "checked ";}?>/> Nigrum (тёмная)</label><br/>
<label><input type="radio" value="0" name="style_e" <?php if ($style == '0') {echo "checked ";}?>/> Iframe (для использования в iframe)</label><br/>


<br />
<br />

</td>
</tr>


<tr>
<td valign="top">Цвет элементов:
</td>
<td valign="top">

 <div id="color-picker" class="cp-default">
            <div class="picker-wrapper">
                <div id="picker" class="picker"></div>
                <div id="picker-indicator" class="picker-indicator"></div>
            </div>
            <div class="slide-wrapper">
                <div id="slide" class="slide"></div>
                <div id="slide-indicator" class="slide-indicator"></div>
            </div>
        </div>
<input type="text" name="color_e" class="color {pickerMode:'HVS',pickerBorder:0,pickerInset:0,pickerFace:26,pickerFaceColor:'#e9e9e9'}" value="<?php if (!empty($_POST['color_e'])) { echo $_POST['cilor_e'];} else { echo $color; }?>" />



<div class="clear"></div>
</td>
</tr>





<tr>
<td valign="top">PayPal:<br />
<small>Настройки PayPal:</small></td>

<td valign="top" nowrap>
e-mail аккаунта на PayPal<br />
<input type="text" name="paym_e" value="<?php echo $paym;?>" /><br />
<small>Если оставить это поле пустым, то независимо от<br />настроек оплаты в услугах, будет работать режим оплаты по факту.</small>
<hr />
<label><input type="checkbox" value="1" name="paya_e" <?php if ($paya == '1') {echo "checked ";}?>/> Режим отладки.</label><br/>
<small>Тестирование процесса приёма платежей через<br /><a href="http://www.sandbox.paypal.com" target="_blank">www.sandbox.paypal.com</a>.<br />Внимание. За операциями в sandbox (песочнице)<br />не стоят реальные денежные средства.<br />
В этом режиме, вы можете тестировать<br />механизм приёма платежей.
</small>

<br />

</td>
</tr>


<tr>
<td valign="top">
Часовой пояс:<br />
<small>Если реальное время отличается от времени на сервере:</small>
</td>
<td valign="top">
<select name="horus_e" style="width:55px;">
<?php
$options = array("-8", "-7", "-6", "-5", "-4", "-3", "-2", "-1", "0", "+1", "+2", "+3", "+4", "+5", "+6", "+7", "+8");
foreach ($options as $option) {
echo '<option value="' . $option . '"';
if (empty($option)) {$option = 0;}
if ($option == $horus) {echo " selected";} 

echo ">" . ucfirst($option) . "</option>";}
?>
</select><br /><br />

<table class="times"><tr>
<td>Текущее время на сервере:</td><td><b><?php echo date("G:i"); ?></b></td></tr>
<tr>
<td>Текущее время в системе:</td><td><b><?php 
$chrc = date("G");

if (strpos($horus, '+') !== false) {
$horus = str_replace('+', '', $horus);
$this_horus = $chrc+$horus;
}

else if (strpos($horus, '-') !== false) {
$horus = str_replace('-', '', $horus);
$this_horus = $chrc-$horus;
}
else if ($horus == 0) {$this_horus = $chrc;}

echo $this_horus.date(":i");
?></b>
</td>
</tr>
</table>


</td>
</tr>



<tr>
<td colspan="2" align="center">

<input type="submit" name="email_settings" value="Применить" />
</td>
</tr>
</table>
</form>
</div>
<?php } ?>


<br />

<?php include("footer.php"); ?>