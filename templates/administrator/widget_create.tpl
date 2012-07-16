<div class="top-navigation">
<ul>
    <li><p>{lang('a_create_widget')}</p></li>
</ul>
</div>

<div class="form_text">{lang('a_n')}:</div>
<div class="form_input">
    <input type="text" name="name" id="widget_name" value="" class="textbox_long" />
    <span class="lite">{lang('a_just_lat')}.</span></div>
<div class="form_overflow"></div>

<div class="form_text">{lang('a_desc')}:</div>
<div class="form_input">
    <input type="text" name="description" id="widget_desc" value="" class="textbox_long"/>
    <span class="lite">{lang('a_short_widget_desc')}.</span></div>
<div class="form_overflow"></div>

<div class="form_text">{lang('a_type')}:</div>
<div class="form_input">
    <select name="widget_type" id="widget_type_sel" onchange="load_create_tpl(); return false;">
        <option value="module">{lang('a_module')}</option>
        <option value="html">{lang['a_html']}</option>
    </select>
</div>
<div class="form_overflow"></div>

<div id="module_info">
    <div class="form_text"></div>
    <div class="form_input" >
        <span id="widget_title">{lang('a_select_widget')}</span>
    </div>
    <div class="form_overflow"></div>
</div>

<div id="html_tpl" style="display:none;">
    <div class="form_text"></div>
    <div class="form_input" >    
        <textarea id="html_code" name="html_code" class="mceEditor" rows="15" cols="180"  style="width:500px;height:250px;"></textarea>
        <br />
        <a href="#" id="load_editr_link" onclick="load_editor(); return false;">{lang('a_load_editor')}</a>       
    </div>
    <div class="form_overflow"></div>
</div>

<div class="footer_block" align="right">
    <input type="button" class="button_130" value="{lang('a_create')}" onclick="create_widget();" />
    <input type="button" class="button" value="{lang('a_cancel')}" onclick="ajax_div('page', base_url + 'admin/widgets_manager/');" />
</div>

<hr/>

<!--  -->
<div id="widget_create_div"></div>

{literal}
    <script type="text/javascript">
    var tinymce_loaded = false;

        window.addEvent('domready', function(){
            ajax_div('widget_create_div', base_url + 'admin/widgets_manager/display_create_tpl/module'); 
        });
    </script>
{/literal}
