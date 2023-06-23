<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
// Validation Check

$continue = true;
$validation = "";

if(empty($_POST['testimonial-name'])){
	$continue = false;
	$validation = "Ваше имя, ";
}
if(empty($_POST['testimonial-email'])){
	$continue = false;
	$validation .= "Ваш Email, ";
}
if(empty($_POST['testimonial-location'])){
	$continue = false;
	$validation .= "Расположение, ";
}
if(empty($_POST['testimonial-title'])){
	$continue = false;
	$validation .= "Заголовок, ";
}
if(empty($_POST['testimonial-message'])){
	$continue = false;
	$validation .= "Запись";
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
	
	// Hotel Details
	
	$hotel_name = "Домик на Волге";
	$hotel_email = "1315469@gmail.com";
	
	// Send Email to Hotel
	
	$message = file_get_contents('system/email/template-hotel-testimonial.php');
	$message = str_replace('[name]', $_POST['testimonial-name'], $message);
	$message = str_replace('[email]', $_POST['testimonial-email'], $message);
	$message = str_replace('[location]', $_POST['testimonial-location'], $message);
	$message = str_replace('[title]', $_POST['testimonial-title'], $message);
	$message = str_replace('[message]', $_POST['testimonial-message'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['testimonial-email']);
	$mail->addAddress($hotel_email, $hotel_name);
	$mail->Subject = 'Новая запись в гостевую книгу от '.$_POST['testimonial-name'];
	$mail->MsgHTML($message);
	if (!$mail->send()) {
		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>Ошибка</strong></div>";
	}
	else {
		$alert = "<div class='alert success'><i class='fa fa-check-circle'></i> <strong>Благодарим Вас за свидетельство.</strong> Мы рассмотрим вашу обратную связь и использовать его, чтобы улучшить свой уровень сервиса.</div>";
	}
}
else {
	$alert = "<div class='alert validate'><i class='fa fa-exclamation-circle'></i> Пожалуйста, заполните следующие поля: <strong>".$validation."</strong></div>";
}
}
?>
<!DOCTYPE HTML>
<!-- Project by ТыВСети for Dmitry Emir -->
<html>
<head>
<meta charset="utf-8">
<title>themelock.com - Write in Guest Book</title>
<link rel="stylesheet" href="system/css/global.css">
<link class="colour" rel="stylesheet" href="system/css/colour-blue.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="system/js/plugins.js"></script>
<script src="system/js/global.js"></script>
<script src="preview/js/styler.js"></script>
</head>
<body>
<div id="pop" class="popform">
	<?=$alert;?>
    <div class="container">
        <p class="title"><strong>Поделитесь своим опытом</strong></p>
        <p>Ваша обратная связь поможет указать нам на то, как мы можем улучшить наш уровень сервиса. Не стесняйтесь поделиться своим опытом.</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input name="testimonial-name" type="text" placeholder="Ваше имя" />
            <input name="testimonial-email" type="text" placeholder="Ваш Email" />
            <input name="testimonial-location" type="text" placeholder="Местонахождение (город / страна)" />
            <input name="testimonial-title" type="text" placeholder="Заголовок" />
            <textarea name="testimonial-message" placeholder="Ваша запись"></textarea>
            <button name="send" value="sendform"><span data-hover="Написать в гостевой книге">Написать в гостевой книге</span></button>
        </form>
    </div>
</div>
</body>
</html>
