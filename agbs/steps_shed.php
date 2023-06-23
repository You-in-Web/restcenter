<?php $this_file = basename($_SERVER['SCRIPT_NAME']); ?>

<?php if ($this_file == 'schedule.php') { ?>
<div id="steps">
<span class="point">Выбор даты</span>
<span class="way_point">&#160;</span>
<span class="point">Выбор услуги</span>
<span class="way_point">&#160;</span>
<span class="point">Оформление</span>
</div>
<div class="b_clear">&#160;</div>

<?php } else if ($this_file == 'booking_shed.php' && !$_POST["select_service"]) { ?>
<div id="steps">
<span class="point_active">Выбор даты</span>
<span class="way_point">&#160;</span>
<span class="point">Выбор услуги</span>
<span class="way_point">&#160;</span>
<span class="point">Оформление</span>
</div>
<div class="b_clear">&#160;</div>


<?php }   ?>

<?php if ($_POST["select_service"] && !$_POST['select_time']){ ?>
<div id="steps">
<span class="point_active">Выбор даты</span>
<span class="way_point_active">&#160;</span>
<span class="point_active">Выбор услуги</span>
<span class="way_point">&#160;</span>
<span class="point">Оформление</span>
</div>
<div class="b_clear">&#160;</div>
<?php } ?>

<?php if ($_POST["select_service"] && $_POST['select_time'] && is_array($ERROR)) { ?>
<div id="steps">
<span class="point_active">Выбор даты</span>
<span class="way_point_active">&#160;</span>
<span class="point_active">Выбор услуги</span>
<span class="way_point">&#160;</span>
<span class="point">Оформление</span>
</div>
<div class="b_clear">&#160;</div>
<?php } ?>

<?php if ($_POST["select_service"] && $_POST['select_time'] && !is_array($ERROR)) { ?>
<div id="steps">
<span class="point_active">Выбор даты</span>
<span class="way_point_active">&#160;</span>
<span class="point_active">Выбор услуги</span>
<span class="way_point_active">&#160;</span>
<span class="point_active">Оформление</span>
</div>
<div class="b_clear">&#160;</div>

<?php } ?>
