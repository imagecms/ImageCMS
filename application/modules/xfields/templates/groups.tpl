<form action="{$SELF_URL}/create_group" method="post" id="xfield_add_group_form">
<div class="form_text">Имя:</div>
<div class="form_input">
    <input type="text" name="name" value="" class="textbox_long" />
</div>
<div class="form_overflow"></div> 

<div class="form_text">Заголовок:</div>
<div class="form_input">
    <input type="text" name="title" value="" class="textbox_long" />
</div>
<div class="form_overflow"></div> 

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" class="button" value="Создать" onclick="ajax_me('xfield_add_group_form');" />
</div>
<div class="form_overflow"></div> 
</form>

{foreach $groups as $group}
<div id="groups_list" style="border:3px solid #9FB73A; padding:10px; width:350px; margin-left:50px; margin-top:10px; height: 30px;">
        <div style="float:left;">
        <b>Имя:</b> {$group.name} <br />
        <b>Заголовок:</b> {$group.title}
        </div>
        <div style="float:right;" align="right">
            <img  src="{$THEME}/images/edit.png" style="cursor:pointer;" onclick="edit_group({$group.id});" />
            <img  src="{$THEME}/images/delete.png" style="cursor:pointer;" onclick="delete_group({$group.id});" />
        </div>
</div>
{/foreach}
