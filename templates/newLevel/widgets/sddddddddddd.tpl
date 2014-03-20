{$i=0}
<div>
    <b>{lang('Navigation', 'navigation')}:</b>
    {foreach $navi_cats as $item}
        {$i++}
        {if $i < count($navi_cats)}
            <a href="{site_url($item.path_url)}">{$item.name}</a> /
        {else:}
            {$item.name}
        {/if}
    {/foreach}
</div>
