{if $none_group}
<div class="g_header">Вне групп</div>
<div class="table_block">
    {foreach $none_group as $item}
		<div class="form_text">
		    <input type="checkbox" name="xfields[]" title="{$item.name}" value="{$item.id}" {$item.checked}  />
		</div>
		<div class="form_input">
			{$item.html}
		</div>
		<div class="form_overflow"><hr/></div>
    { /foreach } 
</div>
{/if}

{foreach $groups as $group}
{if $group['fields']}
    <div id="g_delimiter"></div>
    <div class="g_header">{$group.title}</div>
    <div class="table_block">
    {foreach $group['fields'] as $item}
        <div class="form_text">
            <input type="checkbox" title="{$item.name}" name="xfields[]" value="{$item.id}" {$item.checked} />
        </div>
        <div class="form_input">
            {$item.html}
        </div>
        <div class="form_overflow"><hr /></div>
    { /foreach }
    </div>
{/if}
{/foreach}



{literal}
<style>
    #g_delimiter {
        padding-top:20px;
    }
    .g_header {
        width: 250px;
        border-bottom: 2px solid #9CBD3B; 
        padding: 2px;
        padding-left: 5px;
        background-color:#C3E972; 
        font-weight:bold;
        margin-left:10px;
    }
    .table_block {
        border: 2px solid #9CBD3B;
        width: 580px;
        margin-left:10px;
    }
</style>
{/literal}

<!--
<div style="padding:15px;">
	<a href="#" onclick="com_admin('xfields'); return false;"  id="show_xfields_editor"> Редактировать поля </a>
	<div id="edit_xfields"></div>
</div> -->
