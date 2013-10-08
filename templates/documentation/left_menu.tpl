<ul class="" {if !$display} style="display: none;"{/if}>
    {foreach $tree as $item}
        {$active = false;}
        {if strpos($categoryData['url'], '/'.$item['url'].'/') !== false}{$active = true}{/if}
        <li {if $active}class="active"{/if}>
             <a href="{base_url($item['path_url'])}">{$item['name']}  
             {if $categoryData['id'] == $item['id'] && $admin}
                 <span data-toggle="modal" href="#myModalEdit" class="glyphicon glyphicon-pencil pull-right editCategory">
                 </span>
             {/if}
             </a>
            <!-- Show category sublevels -->
            {if $item['subtree'] && $item['level']<2}
                <span class="tree_menu_icon glyphicon glyphicon-chevron-right"></span>
                {$this->view('left_menu.tpl', array('tree' => $item['subtree'],'cat_path' => $cat_path, 'display' => $active, 'categoryData' => $categoryData,'admin' => $admin))}
            {/if}
        </li>
    {/foreach}
</ul>
