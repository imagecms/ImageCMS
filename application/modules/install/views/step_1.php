<h2>Проверка директорий</h2>
<p>
    Для того, чтобы продолжить установку системы, установите права на запись(chmod 0777) на следующие директории:

    <ul class="list">
    <?php foreach ($dirs as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?><?php if('ok'==$v) { ?> <i class=" icon-ok-circle"></i> <?php } else { ?> <i class=" icon-minus-sign"></i> <?php } ?></li>
    <?php } ?>
    </ul>
</p>

<h2>Проверка параметров PHP</h2>
<p>
    <ul class="list">
    <?php foreach ($allow_params as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?><?php if('ok'==$v) { ?> <i class=" icon-ok-circle"></i> <?php } else { ?> <i class=" icon-minus-sign"></i> <?php } ?></li>
    <?php } ?>
    </ul>
</p>


<h2>Проверка модулей PHP</h2>
<p>
    <ul class="list">
    <?php foreach ($exts as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?><?php if('ok'==$v) { ?> <i class=" icon-ok-circle"></i> <?php } else { ?> <i class=" icon-minus-sign"></i> <?php } ?></li>
    <?php } ?>
    </ul>
</p>



<p align="left">
<br/>
<a href="<?php echo $next_link ?>" class="btn btn-success"><i class="icon-ok icon-white"></i> Далее</a>
<a href="" type="submit" class="btn" ><i class="icon-refresh"></i> Обновить</a>
</p>
