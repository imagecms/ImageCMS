<h2><?php echo lang('Directories checking', 'install')?></h2>
<p>
    <?php echo lang('To continue the installation, install the write rights', 'install')?>(chmod 0777) <?php echo lang('to the following directories', 'install')?>:

    <ul class="list">
    <?php foreach ($dirs as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?><?php if('ok'==$v) { ?> <i class=" icon-ok-circle"></i> <?php } else { ?> <i class=" icon-minus-sign"></i> <?php } ?></li>
    <?php } ?>
    </ul>
</p>

<h2><?php echo lang('Verifying the PHP', 'install')?></h2>
<p>
    <?php echo lang('In order to continue the installation of the system, set the PHP options', 'install') ?>:
    <ul class="list">
    <?php foreach ($allow_params as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?><?php if('ok'==$v) { ?> <i class=" icon-ok-circle"></i> <?php } else { ?> <i class=" icon-minus-sign"></i> <?php } ?></li>
    <?php } ?>
    </ul>
</p>


<h2><?php echo lang('Verifying the PHP modules', 'install')?></h2>
<p>
    <?php echo lang('For best performance, install the PHP modules', 'install') ?>:
    <ul class="list">
    <?php foreach ($exts as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?><?php if('ok'==$v) { ?> <i class=" icon-ok-circle"></i> <?php } else { ?> <i class=" icon-minus-sign"></i> <?php } ?></li>
    <?php } ?>
    </ul>
</p>

<h2><?php echo lang('Verifying locales', 'install')?></h2>
<p>
    <?php echo lang('To use these locales, install them on the server', 'install') ?>:
    <ul class="list">
    <?php foreach ($locales as $k => $v) { ?>
        <li class="<?php echo $v ?>"><?php echo $k?><?php if('ok'==$v) { ?> <i class=" icon-ok-circle"></i> <?php } else { ?> <i class=" icon-minus-sign"></i> <?php } ?></li>
    <?php } ?>
    </ul>
</p>



<p align="left">
<br/>
<a href="<?php echo $next_link ?>" class="btn btn-success"><i class="icon-ok icon-white"></i> <?php echo lang('Next', 'install') ?></a>
<a href="" type="submit" class="btn" ><i class="icon-refresh"></i> <?php echo lang('Update', 'install')?></a>
</p>
