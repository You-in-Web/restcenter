<?
@session_start();
error_reporting(0);
//if (!isset($_SESSION['key'])) { echo "invalid session"; exit(); }

// �������� ���������� ����� � ������  
$access = array();  
$access = file("../data/access.php");  
// �������� �������� �� ���������� � ��������� ������ ������ ����� - 0  
$login = trim($access[1]);  
$passw = trim($access[2]);  
// �������� ���� �� ������� ������  
if(!empty($_POST['enter']))  
{  
        $_SESSION['login'] = $_POST['login'];  
        $_SESSION['passw'] = $_POST['passw'];  
$ERROR["login"]["text"] = "<span class=\"error\">�� ������ �����.</span>";
$ERROR["passw"]["text"] = "<span class=\"error\">�� ������ ������.</span>";
}
		

// ���� ����� �� ����, ��� ��� �� �����  
// ������ �� ������  
if(empty($_SESSION['login']) or  
   $login != $_SESSION['login'] or  
   $passw != $_SESSION['passw']    )  

{  
?>  
<?php require_once("../data/config.php"); ?> 
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $title_com; ?> - ���� � ������ ���������� AgBS</title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="stylesheet" type="text/css" href="admin.css" media="screen" />

</head>

<body>



<div id="main">
<br /><br />
<div id="b_table_login">
<table>
     <form action=index.php method=post> 
     <tr><th colspan="2"><strong><?php echo $title_com; ?></strong> <br /> AgBS</th></tr>	 
     <tr><td>�����:</td> <td align="center"><input type="text" class=input name=login value=""></td></tr>  
     <tr><td>������:</td> <td align="center"><input type="password" class=input name=passw value=""></td></tr>  
     <input type=hidden name=enter value=yes>  
     <tr><td colspan="2" align="center"><input class=button type=submit value="����"></td></tr>
</table>
</div>	 


<?php 

if($login != $_SESSION['login']) {
echo "<br /><center>".$ERROR["login"]["text"]."</center>";
} else {echo"";}


if($passw != $_SESSION['passw']) {
echo "<br /><center>".$ERROR["passw"]["text"]."</center>";
} else {echo"";}

?>


</div>
</body>
</html>
   <?php  
   die;  
} 
?>
<?php require_once("../data/config.php"); ?> 

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $title_com; ?> - ������ ���������� AgBS</title>
<meta name="robots" content="noindex, nofollow"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="stylesheet" type="text/css" href="admin.css" media="screen" />
<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="../js/hoverIntent.js"></script>
		<script type="text/javascript" src="../js/superfish.js"></script>
		<script type="text/javascript">
		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
		</script>
</head>

<body>
<div id="main">

<div id="top">

</div>

<div id="main_menu">
<ul class="sf-menu">

<li>
<a href="index.php">����</a>				
<ul>
<li><a href="aservices.php">������</a></li>
<li><a href="back.php">������</a></li>
<li><a href="settings.php">���������</a></li>
</ul>				
</li>

</ul>

<div class="title_top"><img src="img/title_top.png" width="40" height="40" border="0" alt="" align="left" /><span>AgBS</span> <span class="n_com"><?php echo $title_com; ?></span>
<?php
$days = array(
'Sunday' => '�����������', 
'Monday' => '�����������', 
'Tuesday' => '�������', 
'Wednesday' => '�����', 
'Thursday' => '�������', 
'Friday' => '�������', 
'Saturday' => '�������'); 
$tw = date("l");
 ?>

</div>
<div id="helo">

����� ���������� <? echo "$login"; ?>! 
<span class="t_date" title="���� �� �������">�������: <?php echo date('d.m.Y');?> (<?php echo $days[$tw];?>)</span>
<a href="logout.php" >�����</a> </div>
</div>
<div class="top">&#160;</div>