<h2>Проверка директорий</h2>
<p>
    Для того, чтобы продолжить установку системы, установите права на запись(chmod 0777) на следующие директории:

    <ul class="list">
    <?php foreach ($dirs as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?></li>
    <?php } ?>
    </ul>
</p>

<h2>Проверка параметров PHP</h2>
<p>
    <ul class="list">
    <?php foreach ($allow_params as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?></li>
    <?php } ?>
    </ul>
</p>


<h2>Проверка модулей PHP</h2>
<p>
    <ul class="list">
    <?php foreach ($exts as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?></li>
    <?php } ?>
    </ul>
</p>



<p align="left">
<br/>
<a href="<?php echo $next_link ?>"><input type="submit" class="button_130" value="Далее"></a>
<a href=""><input type="submit" class="button_130" value="Обновить"></a>
</p>
