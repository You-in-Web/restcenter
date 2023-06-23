<?php

// Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru

  $content = get_content();

  // Разбираем содержимое, при помощи регулярных выражений

  $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";

  preg_match_all($pattern, $content, $out, PREG_SET_ORDER);

  $kurs_d = "";

  $kurs_e = "";

  foreach($out as $cur)

  {

    if($cur[2] == 840) $kurs_d = str_replace(",",".",$cur[4]);

    if($cur[2] == 978) $kurs_e   = str_replace(",",".",$cur[4]);

  }

  echo "<small>Курс валют на сегодня:</small>
  
  <ul style=\"margin: 0px; padding: 0px; font-size: 14px; list-style-type: none;\">
  <li>USD - ".$kurs_d." р.</li>";

  echo "<li>EUR - ".$kurs_e." р.</li>
  </ul>
  <br /><small>Данные поступают с <a href=\"http://www.cbr.ru\" target=\"_blank\">www.cbr.ru</a></small>";



function get_content()

{

    // Формируем сегодняшнюю дату

    $date = date("d/m/Y");

    // Формируем ссылку

    $link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date;

    // Загружаем HTML-страницу

    $fd = @fopen($link, "r");

    $text="";

    if (!$fd) echo "Сервер ЦБ не отвечает";

    else

    {

      // Чтение содержимого файла в переменную $text

      while (!feof ($fd)) $text .= fgets($fd, 4096);

      // Закрыть открытый файловый дескриптор

      fclose ($fd);

    }

    return $text;

}

?>