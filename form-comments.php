<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
// Validation Check

$continue = true;
$validation = "";

if(empty($_POST['comment-email'])){
	$continue = false;
	$validation .= "Ваш Email, ";
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
	
	// Hotel Details
	
	$hotel_name = "Домик на Волге";
	$hotel_email = "1315469@gmail.com";
	
	// Send Email to Hotel
	
	$message = file_get_contents('system/email/template-hotel-comment.php');
	$message = str_replace('[post]', $_POST['comment-post'], $message);
	$message = str_replace('[email]', $_POST['comment-email'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['comment-email']);
	$mail->addAddress($hotel_email, $hotel_name);
	$mail->Subject = 'Запрос на подписку от '.$_POST['comment-email'];
	$mail->MsgHTML($message);
	if (!$mail->send()) {
		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>Ошибка</strong></div>";
	}
	else {
		$alert = "<div class='alert success'><i class='fa fa-check-circle'></i> <strong>Спасибо за подписку.</strong> Теперь вы будете в курсе всех акций и предложений!.</div>";
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
<title>themelock.com - Leave a Comment</title>
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
        <p class="title"><strong>Подписка на "Домик на Волге"</strong></p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input name="comment-email" type="text" placeholder="Введите Ваш Email" />
            <button name="send" value="sendform"><span data-hover="Оформить подписку">Оформить подписку</span></button>
        </form>
    </div>
</div>
</body>
</html>
