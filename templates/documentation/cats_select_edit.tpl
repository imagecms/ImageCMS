{foreach $tree as $item}
	<option value="{$item['id']}"  {if $item['id'] == $sel_cat} selected="selected" {/if}>
	{for $i=0; $i < $item['level'];$i++}-{/for} {$item['name']}
	</option>
        {if $item['subtree'] && $item['level'] <2}
            {$this->view('cats_select_edit.tpl', array('tree' => $item['subtree'], 'sel_cat' => $sel_cat))}
        {/if}
{/foreach}
