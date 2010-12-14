{foreach $tree as $item}
    <option onclick="load_pages({$item.id},0); return false;" value="{$item.id}">{for $i=0;$i < $item['level']; $i++}-{/for} {$item.name}</option>
        {if $item['subtree']}
            {$CI->template->assign('tree',$item['subtree'])}
            {include_tpl('cats')}
        {/if}
{/foreach}
