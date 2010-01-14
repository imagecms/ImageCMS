<form action="{$SELF_URL}/create_group" method="post" id="xfield_move_form">
<div class="form_text">Группа:</div>
<div class="form_input">
    <select name="group_id" id="group_id_select">
        <option value="0">Нет</option>
        {foreach $groups as $group}
        <option value="{$group.id}">{$group.title}</option>
        {/foreach}
    </select>
</div>
<div class="form_overflow"></div> 

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" class="button" value="Отправить" onclick="move_fields(); MochaUI.closeWindow($('move_xfields_w')); return false; ">
    <input type="submit" class="button" value="Отмена" onclick="MochaUI.closeWindow($('move_xfields_w')); return false;">
</div>
<div class="form_overflow"></div> 
<form>
