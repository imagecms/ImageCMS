<form action="{$SELF_URL}/update_group/{$group.id}" method="post" id="xgroup_edit_form">
<div class="form_text">Имя:</div>
<div class="form_input">
    <input type="text" name="name" value="{$group.name}" class="textbox_long" />
</div>
<div class="form_overflow"></div> 

<div class="form_text">Заголовок:</div>
<div class="form_input">
    <input type="text" name="title" value="{$group.title}" class="textbox_long" />
</div>
<div class="form_overflow"></div> 

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" class="button" value="Сохранить" onclick="ajax_me(this.form.id); MochaUI.closeWindow($('edit_xfield_g_w'));" />
    <input type="submit" class="button" value="Отмена" onclick="MochaUI.closeWindow($('edit_xfield_g_w')); return false;" />
</div>
<div class="form_overflow"></div> 
</form>
