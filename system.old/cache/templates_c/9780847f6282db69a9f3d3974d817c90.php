<?php $i=0?> 
<div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <span typeof="v:Breadcrumb">
        <a rel="v:url" property="v:title" href="<?php echo site_url (); ?>"><?php echo lang ('Главная','corporate'); ?></a> 
    </span>/
    <?php if(is_true_array($navi_cats)){ foreach ($navi_cats as $item){ ?>         
        <?php $i++?>
        <?php if($i < count($navi_cats)): ?>
            <span typeof="v:Breadcrumb">
                <a href="<?php echo site_url ( $item['path_url'] ); ?>"><?php echo $item['name']; ?></a>
            </span>  / 
        <?php else: // Make last element as plain text?>
            <span typeof="v:Breadcrumb">
                <span property="v:title" rel="v:url"><?php echo $item['name']; ?></span>
            </span>
        <?php endif; ?>
    <?php }} ?>
</div>
<?php $mabilis_ttl=1415876622; $mabilis_last_modified=1415789038; ///var/www/image-c.loc/templates/corporate/widgets/path.tpl ?>