{if $tree}
    <ul >
        {foreach $tree as $item}
        <li ><a style="display:block;width:100%;"><div style="display:block;width:100%;"><div onclick="cats_options({$item.id},'{$page_lang}');" >{$item.name}</div>
<img onclick="edit_category({$item.id}); return false;" class="penedit" src="{$THEME}/images/tree/edit_dir.png" align="right" border="0" alt="{lang('a_change_cat_data')}" title="{lang('a_change_cat_data')}">
<img onclick="ajax_div('page', base_url + 'admin/categories/create_form/{$item.id}'); return false;" class="penedit" src="{$THEME}/images/tree/add_subdir.png" align="right" border="0" alt="{lang('a_add_subcat')}" title="{lang('a_add_subcat')}">
<img onclick="ajax_div('page', base_url + 'admin/pages/index/category/{$item.id}'); return false;" class="penedit" src="{$THEME}/images/tree/add_page.png" align="right" border="0" alt="{lang('a_add_article')}" title="{lang('a_add_article')}">
</div></a>  {if $item.subtree}
                { $this->view("cats_tree_css.tpl", array('tree' => $item['subtree'], 'page_lang' => $page_lang, 'THEME' => $THEME)); }
            {/if}
            </li>
        {/foreach}
    </ul>
{/if}
