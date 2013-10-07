<ul class="">
    {foreach $tree as $item}
        <!-- Check show category for group -->
        {if $item['menu_cat'] == null || $item['menu_cat'] == 'all' || $item['menu_cat'] == $group}
            {$active = false;$admin = $CI->dx_auth->is_admin();}
        {if strpos($categoryData['url'], $item['url'].'/') !== false}{$active = true}{/if}
        <li {if $active}class="active"{/if}>
            <a href="{base_url($item['path_url'])}">{$item['name']}  
                {if $categoryData['id'] == $item['id'] && $admin}
                    <span class="glyphicon glyphicon-pencil pull-right editCategory" data-cat_id="{echo $item['id']}">
                    </span>
                {/if}
            </a>
            <!-- Show category sublevels -->
            {if $item['subtree']}
                <span class="tree_menu_icon glyphicon glyphicon-chevron-right"></span>
                {$this->view('left_menu.tpl', array('tree' => $item['subtree'], 'cat_path' => $cat_path, 'display' => $active, 'categoryData' => $categoryData, 'admin' =>$admin))}
            {/if}
        </li>
    {/if}
{/foreach}
</ul>
