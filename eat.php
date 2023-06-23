<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
// Validation Check

$continue = true;
$validation = "";

if(empty($_POST['booking-date'])){
	$continue = false;
	$validation = "Дата бронирования, ";
}
if(empty($_POST['booking-people'])){
	$continue = false;
	$validation .= "Количество людей, ";
}
if(empty($_POST['booking-name'])){
	$continue = false;
	$validation .= "Ваше имя, ";
}
if(empty($_POST['booking-email'])){
	$continue = false;
	$validation .= "Ваш Email, ";
}
if(empty($_POST['booking-phone'])){
	$continue = false;
	$validation .= "Номер телефона";
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
	
	// Hotel Details
	
	$hotel_name = "Домик на Волге";
	$hotel_email = "1315469@gmail.com";
	
	// Send Email to Hotel
	
	$message = file_get_contents('system/email/template-hotel-reservation.php');
	$message = str_replace('[date]', $_POST['booking-date'], $message);
	$message = str_replace('[people]', $_POST['booking-people'], $message);
	$message = str_replace('[name]', $_POST['booking-name'], $message);
	$message = str_replace('[email]', $_POST['booking-email'], $message);
	$message = str_replace('[phone]', $_POST['booking-phone'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['booking-email'], $_POST['booking-name']);
	$mail->addAddress($hotel_email, $hotel_name);
	$mail->Subject = 'Заказ на блюда. Запрос от '.$_POST['booking-name'];
	$mail->MsgHTML($message);
	if (!$mail->send()) {
		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>Произошла ошибка, пожалуйста, позвоните нам, чтобы сделать заказ.</strong></div>";
	}
	else {
		$alert = "<div class='alert success'><i class='fa fa-check-circle'></i> <strong>Благодарим Вас за Ваш запрос бронирования, мы свяжемся с вами как можно скорее.</strong> Для того, чтобы не упустить, пожалуйста, позвоните нам, чтобы мы могли помочь вам раньше.</div>";
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Домик на Волге</title>
<link rel="stylesheet" href="system/css/global.css">
<link class="colour" rel="stylesheet" href="system/css/colour-blue.css">
<link class="pattern" rel="stylesheet" href="system/css/pattern-china.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="system/images/favicon.png" type="image/png">
</head>
<body>
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
                <li><a href="#">Подробные страницы</a>
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
	<header>
    	<div id="header">
        	<div class="h1">
                <h1><span>Что покушать</span>
                <span class="tagline">Домик на Волге</span></h1>
            </div>
        </div>
    </header>
    <!-- Header | END -->
    <!-- Контент | START -->
    <main>
    	<div class="centre">
        	<!-- Слайд-шоу | START -->
        	<div id="slideshow">
                <div class="slider">
                    <div class="item"><img alt="" src="system/images/eat.jpg" width="1200" height="600" /></div>
                </div>
                <div class="nav">
                    <a class="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="next"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
            <!-- Слайд-шоу | END -->
        	<div id="left">
                <div id="content">
                    <h2><strong>Что покушать</strong> в домике на Волге</h2>
                    <p>Домик на Волге может предложить несколько категорий благоустроенных домов, отличающихся, в первую очередь, вместительностью, но обеспечивающих высокий уровень комфорта. Все дома оснащены телевизором, душевой кабиной.</p>
                    <!-- Меню | START -->
                    <section id="menu">
                    	<h3><i class="fa fa-cutlery"></i> Меню</h3>
                    	<div class="menu">
                            <h4>
                            	Завтрак <span>08.30 &ndash; 11.00</span>
                            	<img alt="" src="system/images/eat2.jpg" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Гамбургеры</h5>
                                    <p>Для тех кто не привык долго ждать.</p>
                                    <div class="price">
                                    	<div>$15</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Бифштекс</h5>
                                    <p>Аромат сбивает с ног.</p>
                                    <div class="price">
                                    	<div><span>Маленький</span> $10</div>
                                        <div><span>Большой</span> $18</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Салат Цезарь <span class="tag" title="Стандартный рецепт">С</span></h5>
                                    <p>Вкуснейший салат для настоящих ценителей.</p>
                                    <div class="price">
                                    	<div>$18</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Суп Том-Ям <span class="tag" title="Стандартный рецепт">С</span> <span class="tag" title="Острый">О</span></h5>
                                    <p>Изысканый тайский суп.</p>
                                    <div class="price">
                                    	<div>$19.5</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <h4>
                            	Обед <span>12.00 &ndash; 14.30</span>
                            	<img alt="" src="system/images/eat1.jpg" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Шашлык из свинины</h5>
                                    <p>Нежнейшая шея свинины в ароматном маринаде.</p>
                                    <div class="price">
                                    	<div>$18</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Стейк из баранины</h5>
                                    <p>Свежее, тающее во рту мясо.</p>
                                    <div class="price">
                                    	<div>$22.5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Шашлык из говядины <span class="tag" title="В тандыре">Т</span> <span class="tag" title="На мангале">М</span></h5>
                                    <p>Свежее, тающее во рту мясо.</p>
                                    <div class="price">
                                    	<div>$24</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Куриное филе <span class="tag" title="В тандыре">Т</span> <span class="tag" title="На мангале">М</span></h5>
                                    <p>Свежее, тающее во рту мясо.</p>
                                    <div class="price">
                                    	<div><span>Двойная порция</span> $30</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <h4>
                            	Ужин <span>18.00 &ndash; 20.30</span>
                            	<img alt="" src="system/images/why4.jpg" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Блинчики со сгущенкой</h5>
                                    <p>Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div>$25</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Паровуха из осетра <span class="tag" title="Большое">Б</span></h5>
                                    <p>Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div>$27.5</div>
                                    </div>
                                </li>
                                <li class="featured">
                                    <h5>Мясо по-таёжному <span class="tag">Лучший выбор</span></h5>
                                    <p>Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div>$29</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Царская рыба</h5>
                                    <p>Такого вы точно ещё не пробовали.</p>
                                    <div class="price">
                                    	<div>$28</div>
                                        <div><span>+ Гарнир</span> $30</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Тунец <span class="tag" title="Острое">О</span></h5>
                                    <p>Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div>$30</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3><i class="fa fa-glass"></i> Меню напитков</h3>
                    	<div class="menu">
                            <h4>
                            	Безалкогольные
                            	<img alt="" src="system/images/why5.jpg" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Минеральная вода</h5>
                                    <p>Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div>$5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Coca-cola, Sprite, Fanta</h5>
                                    <p>Такого вы точно ещё не пробовали.</p>
                                    <div class="price">
                                    	<div>$5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Соки свежевыжатые</h5>
                                    <div class="price">
                                    	<div>$4</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <h4>
                            	Кофе <span>Опытного бариста</span>
                            	<img alt="" src="system/images/eat3.jpg" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Капучино</h5>
                                    <div class="price">
                                    	<div>$4.5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Лювак</h5>
                                    <div class="price">
                                    	<div>$4.5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Латте</h5>
                                    <div class="price">
                                    	<div>$4.5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Макиато</h5>
                                    <div class="price">
                                    	<div>$4</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <h4>
                            	Вино <span> Многолетней выдержки</span>
                            	<img alt="" src="system/images/eat4.jpg" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Венето</h5>
                                    <p>2012 - Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div><span>Бокал</span> $10</div>
                                        <div><span>Бутылка</span> $59</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Барбареско</h5>
                                    <p>2010 - Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div><span>Бокал</span> $12</div>
                                        <div><span>Бутылка</span> $65</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Пассито</h5>
                                    <p>2008 - Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div><span>Бокал</span> $18</div>
                                        <div><span>Бутылка</span> $96</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Бароло</h5>
                                    <p>2007 - Такого вы ещё не пробовали.</p>
                                    <div class="price">
                                    	<div><span>Бокал</span> $22</div>
                                        <div><span>Бутылка</span> $115</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <!-- Меню | END -->
                </div>
            </div>
            <!-- Боковая панель | START -->
            <aside class="layout2">
            	<div id="scroll">
                	<!-- Заказ блюд. Форма | START -->
                    <div id="block" class="form">
                        <div class="blocktitle"><span>Заказать</span></div>
                        <?=$alert;?>
                        <form id="reservations" action="<?php echo $_SERVER['PHP_SELF']; ?>#menu" method="post">
                        	<p><strong>+7 908 888 888</strong><br />
                            <a href="mailto:1315469@gmail.com">1315469@gmail.com</a></p>
                        	<div class="fieldgroup">
                                <div class="field calendar"><input name="booking-date" type="text" placeholder="Дата бронирования" id="bookingdate" readonly /><i class="fa fa-calendar-o"></i></div>
                                <div class="field"><input name="booking-people" type="text" placeholder="Количество людей" /></div>
                                <div class="field"><input name="booking-name" type="text" placeholder="Ваше имя" /></div>
                                <div class="field"><input name="booking-email" type="text" placeholder="Ваш Email" /></div>
                                <div class="field"><input name="booking-phone" type="text" placeholder="Номер телефона" /></div>
                            </div>
                            <button name="send" value="sendform"><span data-hover="Заказать">Заказать</span></button>
                        </form>
                    </div>
                    <!-- Заказ блюд. Форма | END -->
                    <!-- Специальный слайд | START -->
                    <div id="specials" class="list">
                        <div class="slider">
                        	<div class="item">
                                <img alt="" src="system/images/hunting.jpg" width="380" height="250" />
                                <div class="details">
                                    <a href="specials.html">
                                        <div class="title">Развлечения<br />
                                        <span>Охота и рыбалка</span></div>
                                        <p>Домик на Волге может предложить несколько категорий благоустроенных домов, отличающихся, в первую очередь, вместительностью.<br />
                                        <strong>Стоимость $249 три часа</strong></p>
                                        <div class="button"><span data-hover="Подробнее">Подробнее</span></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="nav"></div>
                    </div>
                    <!-- Специальный слайд | END -->
                </div>
            </aside>
            <!-- Боковая панель | END -->
        </div>
    </main>
    <!-- Контент | END -->
    <!-- Дополнительно по всему сайту | START -->
    <div id="extras">
    	<div class="centre">
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
                    <a href="https://www.google.com/maps/dir/Current+Location/47.758208,46.4217065" target="_blank"><strong>Получить маршрут</strong></a></p>
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