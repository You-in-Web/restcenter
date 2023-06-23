<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
// Validation Check

$continue = true;
$validation = "";

if(empty($_POST['contact-name'])){
	$continue = false;
	$validation = "First Name, ";
}
if(empty($_POST['contact-email'])){
	$continue = false;
	$validation .= "Email Address, ";
}
if(empty($_POST['contact-phone'])){
	$continue = false;
	$validation .= "Phone Number";
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
	
	// Hotel Details
	
	$hotel_name = "Домик на Волге";
	$hotel_email = "qooobo@gmail.com";
	
	// Send Email to Guest
	
	$message = file_get_contents('system/email/template-guest.php');
	$message = str_replace('[name]', $_POST['contact-name'], $message);
	$message = str_replace('[email]', $_POST['contact-email'], $message);
	$message = str_replace('[phone]', $_POST['contact-phone'], $message);
	$message = str_replace('[arrival]', $_POST['contact-arrival'], $message);
	$message = str_replace('[departure]', $_POST['contact-departure'], $message);
	$message = str_replace('[rooms]', $_POST['contact-rooms'], $message);
	$message = str_replace('[adults]', $_POST['contact-adults'], $message);
	$message = str_replace('[children]', $_POST['contact-children'], $message);
	$message = str_replace('[message]', $_POST['contact-message'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($hotel_email, $hotel_name);
	$mail->addAddress($_POST['contact-email'], $_POST['contact-name']);
	$mail->Subject = $hotel_name.' Booking Request';
	$mail->MsgHTML($message);
	$mail->IsHTML(true);
	$mail->send();
	
	// Send Email to Hotel
	
	$message = file_get_contents('system/email/template-hotel.php');
	$message = str_replace('[name]', $_POST['contact-name'], $message);
	$message = str_replace('[email]', $_POST['contact-email'], $message);
	$message = str_replace('[phone]', $_POST['contact-phone'], $message);
	$message = str_replace('[arrival]', $_POST['contact-arrival'], $message);
	$message = str_replace('[departure]', $_POST['contact-departure'], $message);
	$message = str_replace('[rooms]', $_POST['contact-rooms'], $message);
	$message = str_replace('[adults]', $_POST['contact-adults'], $message);
	$message = str_replace('[children]', $_POST['contact-children'], $message);
	$message = str_replace('[message]', $_POST['contact-message'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['contact-email'], $_POST['contact-name']);
	$mail->addAddress($hotel_email, $hotel_name);
	$mail->Subject = 'Booking Request from '.$_POST['contact-name'];
	$mail->MsgHTML($message);
	if (!$mail->send()) {
		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>There was an error, please call us to make a booking.</strong></div>";
	}
	else {
		$alert = "<div class='alert success'><i class='fa fa-check-circle'></i> <strong>Thank you for your booking request, we will get back to you as soon as possible.</strong> To avoid missing out, please give us a call so that we may assist you sooner.</div>";
	}
}
else {
	$alert = "<div class='alert validate'><i class='fa fa-exclamation-circle'></i> Please fill out the following fields: <strong>".$validation."</strong></div>";
}
}
?>
<!DOCTYPE HTML>
<!-- Project by ТыВСети for Dmitry Emir -->
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Домик на Волге</title>
<link rel="stylesheet" href="system/css/global.css">
<link class="colour" rel="stylesheet" href="system/css/colour-blue.css">
<link class="pattern" rel="stylesheet" href="system/css/pattern-china.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body class="fullwidth">
<!-- Панель навигации | START -->
<div id="nav">
    <div class="centre">
        <a href="index.html" class="logo"><img alt="" src="system/images/logo.png" /></a>
        <nav>
            <ul>
            	<li class="mobile"><a href="contact.php" class="navbook">Book Online</a></li>
                <li><a href="index.html">Главная</a>
                </li>
                <li><a href="#">Жилье</a>
                	<ul>
                    	<li><a href="bigHouse.html">Большой дом</a></li>
                        <li><a href="bigHouseRoom.html">Комната большого дома</a></li>
                        <li><a href="smallHouse.html">Малый дом</a></li>
                        <li><a href="smallHouseRoom.html">Комната малого дома</a></li>
                    </ul>
                </li>
                <li><a href="about.html">Подробные страницы</a>
                	<ul>
                    	<li><a href="about.html">О нас</a></li>
                        <li><a href="specials.html">Специальные предложения</a></li>
                        <li><a href="gallery.html">Фото галерея</a></li>
                        <li><a href="location.html">Место нахождения</a></li>
                        <li><a href="why.html">Почему нас выбирают</a></li>
                        <li><a href="eat.php">Что покушать</a></li>
                        <li><a href="place.html">Вместительность домиков</a></li>
                        <li><a href="guest-book.html">Гостевая книга</a></li>
                        <li><a href="faqs.html">Часто задаваемые вопросы</a></li>
                        <li><a href="sitemap.html">Карта сайта</a></li>
                        <li><a class="promopopup">Подпишитесь на нас</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Контакты</a></li>
            </ul>
            <a id="pull"><i class="fa fa-bars"></i></a>
        </nav>
        <a href="contact.php" class="book"><span data-hover="Бронировать">Бронировать</span> <i class="fa fa-check-circle"></i></a>
        <div class="shadow"></div>
    </div>
</div>
<!-- Панель навигации | END -->
<div id="container">
	<!-- Header | Start -->
	<header>
    	<div id="header">
        	<div class="h1">
                <h1><span>Контакты</span>
                <span class="tagline">Домик на Волге</span></h1>
            </div>
        </div>
    </header>
    <!-- Header | END -->
    <!-- Контент | START -->
    <main>
    	<div class="centre">
            <!-- Главная картинка | START -->
        	<div id="contact">
            	<img src="system/images/1.jpg" width="1200" height="400" alt="" />      
            </div>
            
        </div>
     </main>
            <!-- Главная картинка | END -->
            <!-- Форма для брони | START -->
            <p class="broniri">Забронируйте домик прямо сейчас!</p>
            <?
            include ('agbs.php');
            ?>
            <!-- Форма для брони | END -->
     <main>
            <!-- Контактная форма | START -->
         <div class="centre">
            <h2 style="margin:0;"><strong>+7 908 888 88 88</strong></h2>
            <p style="margin:0;"><a href="mailto:1315469@gmail.com">1315469@gmail.com</a><br />
            ул. возле озера, с. Никольское, Россия<br />
            <a href="location.html"><i class="fa fa-map-marker"></i> Исследуйте Наше местоположение</a></p>
        </div>
            <!-- Контактная форма | END -->
        <!-- Google Map | START -->
        <script>
			function initialize() {
			var latlng = new google.maps.LatLng(47.758208,46.4217065);
			var myOptions = {
			zoom: 14,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false
			};
			var map = new google.maps.Map(document.getElementById('googlemap'), myOptions);
			var marker = new google.maps.Marker({
			position: latlng, 
			map: map,
			icon: "system/images/point.png"
			});
			}
			function loadScript() {
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&'+'callback=initialize';
			document.body.appendChild(script);
			}
			window.onload = loadScript;
		</script>
    	<div id="map">
            <div id="googlemap"></div>
        </div>
        <!-- Google Map | END -->
    </main>
    <!-- Контент | END -->
    
    <!-- Специальные развлечения | START -->
     <div id="extras">
    	<div class="centre">
            <!-- Развлечения | START -->
            <div id="specials" class="list">
                <div class="back">
                    <div class="slider">
                    	<div class="item">
                        	<img alt="" src="system/images/hunting.jpg" width="1200" height="400" />
                            <div class="details">
                                <a href="specials.html">
                                    <div class="title">Развлечения<br />
                                    <span>Охота и рыбалка</span></div>
                                    <p>Домик на Волге может предложить несколько категорий благоустроенных домов, отличающихся, в первую очередь, вместительностью.<br />
                                    <strong>Стоимость $249 за три часа</strong></p>
                                    <div class="button"><span data-hover="Подробнее">Подробнее</span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav"></div>
            </div>
            <!-- Развлечения | END -->
        	<!-- Отзывы | START -->
            <div class="recent">
                <a href="guest-book.html">
                	<div class="date">
                    	<span class="month">Дек</span>
                        <span class="day">12</span>
                    </div>
                    <p class="title">Отзыв клиента 1</p>
                    <p>Домик на Волге может предложить несколько категорий домов...</p>
                </a>
                <a href="guest-book.html">
                	<div class="date">
                    	<span class="month">Июл</span>
                        <span class="day">27</span>
                    </div>
                    <p class="title">Отзыв клиента 2</p>
                    <p>Домик на Волге может предложить несколько категорий домов...</p>
                </a>
            </div>
            <!-- Отзывы | END -->
        	<!-- Отзыв | START -->
            <div class="footertestimonial">
            	<i class="fa fa-quote-left"></i>
                <p class="title">Тема отзыва клиента</p>
                <p>Домик на Волге может предложить несколько категорий благоустроенных домов, отличающихся, в первую очередь, вместительностью, но обеспечивающих высокий уровень комфорта. Все дома оснащены телевизором, душевой кабиной, современной сантехникой и мебелью...</p>
                <div class="author">&ndash; <strong>Иван Иванович</strong> <span>(Волгоград, Россия)</span></div>
                <a href="guest-book.html" class="button"><span data-hover="Читать гостевую книгу">Читать гостевую книгу</span></a>
            </div>
            <!-- Отзыв | END -->
        </div>
    </div>
    <!-- Специальные предложения | END -->
    <!-- Footer | START -->
    <footer>
    	<div id="footer">
        	<div class="centre">
                <!-- Социальные сети | START -->
                <div class="news">
                	<div class="title"><span>Подписка</span></div>
                    <div class="subscribe">
                        <a href="form-comments.php" target="_blank" class="button" id="button"><span data-hover="Оформить подписку">Оформить подписку</span></a>
                    </div>
                    <div class="social">
                    	<a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" title="Google+"><i class="fa fa-google-plus"></i></a>
                        <a href="#" title="Pinterest"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                </div>
                <!-- Социальные сети | END -->
            	<!-- Контакты | START -->
            	<div class="contact">
                	<p><strong class="phone">+7 908 888 88 88</strong><br />
                    <a href="mailto:1315469@gmail.com">1315469@gmail.com</a><br /><br />
                    <i class="fa fa-map-marker"></i> ул. возле озера<br />
                    с. Никольское, Россия<br />
                    <a href="https://www.google.com/maps/dir/55.975008,92.8674034/%D0%9D%D0%B8%D0%BA%D0%BE%D0%BB%D1%8C%D1%81%D0%BA%D0%BE%D0%B5,+%D0%90%D1%81%D1%82%D1%80%D0%B0%D1%85%D0%B0%D0%BD%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C,+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F/@50.6654835,50.7406029,4z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x41066c68f1c9e431:0x446ad3225d16e154!2m2!1d46.389944!2d47.760319" target="_blank"><strong>Получить маршрут</strong></a></p>
                </div>
                <!-- Контакты | END -->
                <div class="dark"></div>
            </div>
        </div>
        <!-- Footer заключение | START -->
    	<div id="footerlinks">
        	<div class="centre">
            	<span>Copyright &copy;  <strong>Домик на Волге</strong></span><a href="index.html">Главная</a><a href="sitemap.html">Карта сайта</a><a href="http://xn--b1agj8add3d.xn--p1ai/" target="_blank">Сайт создан компанией ТыВСети</a>
            </div>
        </div>
        <!-- Footer заключение | END -->
    </footer>
    <!-- Footer | END -->
</div>
<!-- Подписка | START -->
<div id="pop">
	<img alt="" src="" width="400" height="150" />
    <div class="container">
        <p class="title"><strong>Подпишитесь на нас,</strong><br />
        и получайте свежие новости</p>
        <p>Будьте в курсе последних специальных предложений от Домика на Волге.</p>
        <form>
            <input name="comment-email" type="text" placeholder="Email" />
            <a href="form-comments.php" target="_blank" class="button"><span data-hover="Подписывайтесь чтобы не пропустить!">Подписывайтесь чтобы не пропустить!</span></a>
        </form>
        <p class="close closepop"><a>Продолжить просмотр сайта</a></p>
        <i class="fa fa-close closepop"></i>
    </div>
</div>
<!-- Подписка | END -->
<script src="system/js/plugins.js"></script>
<script src="system/js/global.js"></script>
</body>
</html>