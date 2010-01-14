{if $tree}
    <ul>
        {foreach $tree as $item}
        <li><a onclick="cats_options({$item.id});" >{$item.name}</a>
            {if $item.subtree}
                { $this->view("cats_tree_css.tpl", array('tree' => $item['subtree'] )); }
            {/if}
            </li>
        {/foreach}
    </ul>
{/if}
