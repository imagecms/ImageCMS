{$CI = & get_instance()}
{$documentationObj = $CI->load->module('documentation')}
<ul class="left-menu-out-sec" {if !$display} style="display: none;"{/if}>
    {foreach $tree as $item}
        {$active = false;}
    {if strpos($categoryData['url'], '/'.$item['url'].'/') !== false}{$active = true}{/if}
    <li {if $active}class="active"{/if}>
        <a href="{base_url($item['path_url'])}" class="category level-{echo $level}">{$item['name']}
            {if $categoryData['id'] == $item['id'] && $admin}
                <span data-toggle="modal" href="#myModalEdit" class="glyphicon glyphicon-pencil pull-right editCategory" style="font-size: 15px !important;">
                </span>
            {/if}
        </a>
        <!--Start. Fetch pages -->
        {if ($fetchCategories = unserialize($item['fetch_pages'])) != false}
            {foreach  $fetchCategories as $fetchCategory}
                {$fetchPages = $documentationObj->get_pages_in_category($fetchCategory)}
                <ul {if !$active}style="display: none;"{/if}>
                    {foreach $fetchPages as $page}
                        <li {if $CI->core->core_data['data_type'] == 'page' && $CI->core->core_data['id'] == $page['id']}class="active"{/if}>
                            <a href="{base_url($page['cat_url'].$page['url'])}"
                               class="page level-{echo $level+1}">
                                {$page['title']}
                            </a>
                        </li>
                    {/foreach}
                </ul>
            {/foreach}
        {/if}
        <!--End. Fetch pages -->
        <!-- Start. Pages in category -->
        {$menuPages = $documentationObj->get_pages_in_category($item['id'])}
        <ul {if !$active}style="display: none;"{/if}>
            {foreach $menuPages as $page}
                <li {if $CI->core->core_data['data_type'] == 'page' && $CI->core->core_data['id'] == $page['id']}class="active"{/if}>
                    <a href="{base_url($page['cat_url'].$page['url'])}"
                       class="page level-{echo $level+1}">
                        {$page['title']}
                    </a>
                </li>
            {/foreach}
        </ul>
        <!-- End. Pages in category -->
        <!-- Show category sublevels -->
        {if $item['subtree'] && $item['level']<3}
            {$this->view('left_menu.tpl', array('tree' => $item['subtree'],'cat_path' => $cat_path, 'display' => $active, 'categoryData' => $categoryData,'admin' => $admin, 'level' => $level+1))}
        {/if}
    </li>
{/foreach}
</ul>
