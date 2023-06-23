<?php session_start();  
// Помещаем содержимое файла в массив  
$access = array();  
$access = file("access.php");  
// Разносим значения по переменным – пропуская первую строку файла - 0  
$login = trim($access[1]);  
$passw = trim($access[2]);  
// Проверям были ли посланы данные  
if(!empty($_POST['enter']))  
{  
        $_SESSION['login'] = $_POST['login'];  
        $_SESSION['passw'] = $_POST['passw'];  
		
}  

// Если ввода не было, или они не верны  
// просим их ввести  
if(empty($_SESSION['login']) or  
   $login != $_SESSION['login'] or  
   $passw != $_SESSION['passw']    )  

{  
   ?>  

     <form action=index.php method=post>  
     Логин <input class=input name=login value="">  
     Пароль <input class=input name=passw value="">  
     <input type=hidden name=enter value=yes>  
     <input class=button type=submit value="Вход">  
	
   <?php  
   die;  
}  
?>
<br />
<a href="logout.php" ><b>Выход</b></a>