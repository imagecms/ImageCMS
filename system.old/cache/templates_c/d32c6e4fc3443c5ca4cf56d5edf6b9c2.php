<?php if(is_true_array($tree)){ foreach ($tree as $item){ ?>
<?php if(isset($parent_id)){ echo $parent_id; } ?>
	<option value="<?php echo $item['id']; ?>"  <?php if($item['id'] == $parent_id OR $item['id'] == $sel_cat): ?> selected="selected" <?php endif; ?>
	<?php if($item['id'] == $id AND !$page_editing): ?> disabled="disabled" <?php endif; ?>
	>
	<?php for($i=0; $i < $item['level'];$i++){?>-<?php } ?> <?php echo $item['name']; ?>
	</option>
        <?php if($item['subtree']): ?>
            <?php $this->view('cats_select.tpl', array('tree' => $item['subtree'], 'parent_id' => $parent_id, 'sel_cat' => $sel_cat, 'id'=>$id))?>
        <?php endif; ?>
<?php }} ?>
<?php $mabilis_ttl=1415876683; $mabilis_last_modified=1415789033; ///var/www/image-c.loc/templates/administrator/cats_select.tpl ?>