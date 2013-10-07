<ul class="">
    {foreach $tree as $item}
        {$active = false;}
        {if strpos($cat_path, $item['url'].'/') !== false}{$active = true}{/if}
        <li {if $active}class="active"{/if}>
            
            <a href="{base_url($item['path_url'])}">{$item['name']}</a>
            {if $item['subtree']}
                <span class="tree_menu_icon glyphicon glyphicon-chevron-right"></span>
                {$this->view('left_menu.tpl', array('tree' => $item['subtree'], 'cat_path' => $cat_path, 'display' => $active))}
            {/if}
        </li>
    {/foreach}
</ul>
