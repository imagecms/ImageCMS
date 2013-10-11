<form action="{$BASE_URL}admin/categories/fast_add/create" method="post" id="fast_add_form" style="width:100%;">

	<div class="form_text">{lang("Name","admin")}:</div>
	<div class="form_input">
        <input type="text" name="name" value="" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('Parent','admin')}:</div>
	<div class="form_input">
        <select name="parent_id">
        <option value="0" selected="selected">{lang("No","admin")}</option>
        { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat'])); }
        </select>
    </div>

	<div class="form_overflow"></div>

    <div class="form_text"></div>
	<div class="form_input">
    	<input type="submit" name="button" class="button" value="{lang('Create','admin')}" onclick="ajax_me('fast_add_form');" />
    	<input type="button" name="button" class="button" value="{lang('Cancel','admin')}"  onclick="MochaUI.closeWindow($('fast_add_cat_w')); return false;" />
	</div>

</form>
