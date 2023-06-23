<?php //ARGENTUM BOOKIG SYSTEM / FEB. 2015 || Автор: Шаклеин Максим
 include("inc/header.php"); ?>

<?php if ($steps == '1') { include("steps.php"); } ?>
<div id="select_service">


<p class="date_p">Выберите услугу:</p>

<?php include("services.php"); ?>

</div>

<?php include("inc/footer.php"); ?>