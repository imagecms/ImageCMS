<div id="categories">
<div class="rdTreeFirebug demotree">
<ul id="desktop_tree">
<li><a id="root_tree" ondblclick='myTree.expandAll()' onclick="cats_options(0,'');" title="Двойной щелчок - развернуть все категории">root</a>
{ $this->view("cats_tree_css.tpl", $data) }
</li>
</ul>
</div>
<script>
var myTree = new rdTree('desktop_tree');
myTree.select("root_tree");
</script>
</div>
