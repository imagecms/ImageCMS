<form action="{$BASE_URL}admin/groups/save/{$id}" method="post" id="groups_edit_form" style="width:100%;">
	<div class="form_text">{lang("Name","admin")}:</div>
	<div class="form_input"><input type="text" name="alt_name" id="alt_name" value="{$alt_name}" class="textbox_short"></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang("Identifier","admin")}:</div>
	<div class="form_input"><input type="text" name="name" value="{$name}" id="name" class="textbox_short"> <h5>({lang("Only Latin characters","admin")})</h5></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang("Description","admin")}:</div>
	<div class="form_input">
	<textarea id="desc" name="desc" class="textearea">{$desc}</textarea>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><input type="submit" name="button" class="button"  value="{lang("Save","admin")}" onclick="ajax_me('groups_edit_form');" ></div>
	<div class="form_overflow"></div>
{form_csrf()}</form>