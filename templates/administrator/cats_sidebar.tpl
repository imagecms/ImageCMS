<div class="rdTreeFirebug">
<ul id="desktop_tree">
<li><a style="display:block;width:100%;"><img class="penedit-root" onclick="ajax_div('page', base_url + 'admin/categories/create_form/0'); return false;"  src="{$THEME}/images/tree/add_subdir.png" align="right" border="0" alt="{lang('a_add_subcat')}" title="{lang('a_add_subcat')}">
<img class="penedit-root" onclick="ajax_div('page', base_url + 'admin/pages/index/category/0'); return false;" src="{$THEME}/images/tree/add_page.png" align="right" border="0" alt="{lang('a_add_article')}" title="{lang('a_add_article')}">
<div id="root_tree" ondblclick='myTree.expandAll()' onclick="cats_options(0,'');" style="display:inline;" title="{lang('a_dbl_click')}">{$_SERVER.SERVER_NAME}</div>
</a>
{ $this->view("cats_tree_css.tpl", $data) }
</li>
</ul>
</div>
<script>
var myTree = new rdTree('desktop_tree');
myTree.select("root_tree");
</script>
