{$i=0} 
<div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <span typeof="v:Breadcrumb">
        <a rel="v:url" property="v:title" href="{site_url()}">{lang('Главная','corporate')}</a> 
    </span>/
    {foreach $navi_cats as $item}         
        {$i++}
        {if $i < count($navi_cats)}
            <span typeof="v:Breadcrumb">
                <a href="{site_url($item.path_url)}">{$item.name}</a>
            </span>  / 
        {else: // Make last element as plain text}
            <span typeof="v:Breadcrumb">
                <span property="v:title" rel="v:url">{$item.name}</span>
            </span>
        {/if}
    {/foreach}
</div>
