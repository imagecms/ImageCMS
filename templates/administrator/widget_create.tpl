<div class="top-navigation">
<ul>
    <li><p>Создать виджет</p></li>
</ul>
</div>

<div class="form_text">Имя:</div>
<div class="form_input">
    <input type="text" name="name" id="widget_name" value="" class="textbox_long" />
    <span class="lite">Только латинские символи.</span></div>
<div class="form_overflow"></div>

<div class="form_text">Описание:</div>
<div class="form_input">
    <input type="text" name="description" id="widget_desc" value="" class="textbox_long"/>
    <span class="lite">Краткое описание виджета.</span></div>
<div class="form_overflow"></div>

<div class="form_text">Тип:</div>
<div class="form_input">
    <select name="widget_type" id="widget_type_sel" onchange="load_create_tpl(); return false;">
        <option value="module">Модуль</option>
        <option value="html">HTML</option>
    </select>
</div>
<div class="form_overflow"></div>

<div id="module_info">
    <div class="form_text"></div>
    <div class="form_input" >
        <span id="widget_title">Выбeрите виджет из списка ниже и нажмите "Создать".</span>
    </div>
    <div class="form_overflow"></div>
</div>

<div id="html_tpl" style="display:none;">
    <div class="form_text"></div>
    <div class="form_input" >    
        <textarea id="html_code" name="html_code" class="mceEditor" rows="15" cols="180"  style="width:500px;height:250px;"></textarea>
        <br />
        <a href="#" id="load_editr_link" onclick="load_editor(); return false;">Загрузить редактор </a>       
    </div>
    <div class="form_overflow"></div>
</div>

<div class="footer_block" align="right">
    <input type="button" class="button_130" value="Создать" onclick="create_widget();" />
    <input type="button" class="button" value="Отмена" onclick="ajax_div('page', base_url + 'admin/widgets_manager/');" />
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
