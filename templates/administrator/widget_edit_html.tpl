<div class="top-navigation">
    <ul>
        <li><p>{lang('a_widget_edit')}<b>{$widget.name}</b></p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" method="post" id="edit_html_widget">
<div class="form_text">{lang('a_n')}:</div>
<div class="form_input">
    <input type="text" name="name" id="widget_name" value="{$widget.name}" class="textbox_long" />
    <span class="lite"></span>
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('a_desc')}:</div>
<div class="form_input">
    <input type="text" name="desc" id="widget_desc" value="{$widget.description}" class="textbox_long" />
    <span class="lite">{lang('a_short_widget_desc')}.</span>
</div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input" >    
    <textarea id="html_codeid" name="html_code" class="mceEditor" rows="15" cols="180" style="width:500px;height:250px;">{htmlspecialchars($widget.data)}</textarea>
    <br />
    <a href="#" id="load_editr_link" onclick="load_editor(); return false;">{lang('a_load_editor')}</a>
</div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" class="button" value="{lang('a_save')}" onclick="ajax_me('edit_html_widget');" />
    <a href="#" onclick="ajax_div('page', base_url + 'admin/widgets_manager/'); return false" >{lang('a_to_widget_list')}</a> 
</div>
{form_csrf()}
</form>
