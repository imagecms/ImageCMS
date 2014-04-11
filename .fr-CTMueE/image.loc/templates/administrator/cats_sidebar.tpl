<div class="rdTreeFirebug">
<ul id="desktop_tree">
<li><a style="display:block;width:100%;"><img class="penedit-root" onclick="ajax_div('page', base_url + 'admin/categories/create_form/0'); return false;"  src="{$THEME}/images/tree/add_subdir.png" align="right" border="0" alt="{lang("Add a subcategory","admin")}" title="{lang("Add a subcategory","admin")}">
<img class="penedit-root" onclick="ajax_div('page', base_url + 'admin/pages/index/category/0'); return false;" src="{$THEME}/images/tree/add_page.png" align="right" border="0" alt="{lang("Add an article","admin")}" title="{lang("Add an article","admin")}">
<div id="root_tree" ondblclick='myTree.expandAll()' onclick="cats_options(0,'');" style="display:inline;" title="{lang("Double click to show all categories","admin")}">{$_SERVER.SERVER_NAME}</div>
</a>
{ $this->view("cats_tree_css.tpl", $data) }
</li>
</ul>
</div>
<script>
var myTree = new rdTree('desktop_tree');
myTree.select("root_tree");
</script>
