<div style="padding:5px;color:#73BACD;background-color:#73BACD;color:#fff">
    <h2>{lang('amt_create_menu')}:</h2>
</div>
    <form action="{$SELF_URL}/create_menu" method="post" id="form_create_root_menu">
        <div class="form_text">{lang('amt_name')}:</div>
        <div class="form_input"><input type="text" class="textbox" name="menu_name" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('amt_tname')}:</div>
        <div class="form_input"><input type="text" class="textbox" name="main_title" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('amt_description')}:</div>
        <div class="form_input"><input type="text" class="textbox" name="menu_desc" /></div>
        <div class="form_overflow"></div>
        
        <div class="form_text">{lang('amt_template_folder')}:</div>
        <div class="form_input"><input type="text" class="textbox" name="menu_tpl" value="{$tpl}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('amt_open_menu_folder')}:</div>
        <div class="form_input">
        	<input type="text" class="textbox" name="menu_expand_level" value="{$expand_level}" />        	
        </div>
        <div class="form_overflow"></div>        

        <div class="form_text"></div>
        <div class="form_input">
            <input type="submit" value="{lang('amt_to_create')}" class="button" onclick="ajax_me(this.form.id);" />
            <input type="submit" value="{lang('amt_cancel')}" class="button" onclick="MochaUI.closeWindow($('create_menu_w')); return false;" />
        </div>
        <div class="form_overflow"></div>
    {form_csrf()}</form>
