{if !$isSubTree}
    <option value="0">{lang('No','admin')}</option>
{/if}
{foreach $tree as $item}
    <option value="{$item.id}" {if $item['id'] == $parent_id OR $item['id'] == $sel_cat} selected="selected" {/if}
            {if $item['id'] == $id AND !$page_editing} disabled="disabled" {/if}
    >
        {for $i=0; $i < $item['level'];$i++}-{/for} {$item.name}
    </option>
    {if $item['subtree'] && $item.id !== $id }
        {$this->view('cats_select.tpl', array('isSubTree' => true, 'children_ids' => $children_ids, 'tree' => $item['subtree'], 'parent_id' => $parent_id, 'sel_cat' => $sel_cat, 'id'=>$id))}
    {/if}
{/foreach}
