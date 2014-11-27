{foreach $tree as $item}
    <option value="{$item.id}">{for $i=0;$i < $item['level']; $i++}-{/for} {$item.name}</option>
        {if $item['subtree']}
            {$CI->template->assign('tree',$item['subtree'])}
            {include_tpl('cats')}
        {/if}
{/foreach}
