{foreach $tree as $item}
{$parent_id}
	<option value="{$item.id}"  {if $item['id'] == $parent_id OR $item['id'] == $sel_cat} selected="selected" {/if}
	{if $item['id'] == $id AND !$page_editing} disabled="disabled" {/if}
	>
	{for $i=0; $i < $item['level'];$i++}-{/for} {$item.name}
	</option>
        {if $item['subtree']}
            {$this->view('cats_select.tpl', array('tree' => $item['subtree'], 'parent_id' => $parent_id, 'sel_cat' => $sel_cat, 'id'=>$id))}
        {/if}
{/foreach}
