{foreach $tree as $item}
    <a title="{$item.name}" href="#" onclick="set_category_data({$item.id}); return false;" id="cat_{$item.id}"  style="display:block;font-size:13px;padding:5px;">
    {for $i=0; $i < $item['level']; $i++}-{/for} {$item.name}
    </a>
        {if $item['subtree']}
            {$CI->template->assign('tree',$item['subtree'])}
            {include_tpl('cats_list')}
        {/if}
{/foreach}
