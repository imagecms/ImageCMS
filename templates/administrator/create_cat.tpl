<form method="post" action="{$BASE_URL}admin/categories/create/new" id="create_cat_form" style="width:100%">

<div id="create_cat_tabs">
<h4>Параметры</h4>
    <div>
        <div class="form_text">Название:</div>
        <div class="form_input"><input type="text" name="name" id="cat_name" value="" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">URL:</div>
        <div class="form_input">
            <input type="text" name="url" id="cat_url" value="" class="textbox_long" />
           <img onclick="translite_cat_name($('cat_name').value);" align="absmiddle" style="cursor:pointer" src="{$THEME}/images/translit.png" width="16" height="16" /> 
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">Родитель:</div>
        <div class="form_input">
            <select name="parent_id">
            <option value="0" selected="selected">Нет</option>
            { $this->view("cats_select.tpl", $this->template_vars); }
            </select>
        </div>
        <div class="clear"></div>

        <div class="form_text">Группа полей:</div>
        <div class="form_input">
            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
            <select name="category_field_group">
                <option value="-1">Нет</option>
            {foreach $f_groups as $k => $v}
                <option value="{$k}" {if $k == $category_field_group} selected="selected" {/if}>{$v}</option>
            {/foreach}
            </select>
            <div class="lite">Выберите группу полей для категории.</div>
        </div>
        <div class="clear"></div>

        <div class="form_text">Группа полей страниц:</div>
        <div class="form_input">
            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
            <select name="field_group">
                <option value="-1">Нет</option>
            {foreach $f_groups as $k => $v}
                <option value="{$k}" {if $k == $field_group} selected="selected" {/if}>{$v}</option>
            {/foreach}
            </select>
            <div class="lite">Выберите группу полей, которая будет отображаться при создании страниц в данной категории.</div>
        </div>
        <div class="clear"></div>

        <div class="form_text">Изображение:</div>
        <div class="form_input">
            <input type="text" name="image" id="cat_image" value="" class="textbox_long" />
            <img src="{$THEME}/images/images.png" width="16" height="16" title="Выбрать Изображение" style="cursor:pointer;" align="absmiddle"  onclick="tinyBrowserPopUp('image', 'cat_image');" />
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">Описание:</div>
        <div class="form_input">
             <textarea name="short_desc" id="short_desc" class="mceEditor"></textarea>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">Позиция:</div>
        <div class="form_input"><input type="text" name="position" value="0" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text"></div>
        <div class="form_input"><h3>Отображение страниц</h3></div>
        <div class="clear"></div>

        <div class="form_text">Сортировать:</div>
        <div class="form_input">
            <select name="order_by">
            <option value="publish_date" selected="selected">По дате</option>    
            <option value="title">По Алфавиту</option>    
            <option value="position">По Позиции</option>    
            </select>

            <select name="sort_order">
            <option value="desc" selected="selected">Убыванию</option> 
            <option value="asc">Возрастанию</option>    
            </select>
        </div>
        <div class="clear"></div>

        <div class="form_text">Записей на странице:</div>
        <div class="form_input">
           <input type="text" name="per_page" value="15" class="textbox_long" /> 
        </div>
        <div class="clear"></div>

        <div class="form_text"></div>
        <div class="form_input">
           <label><input type="checkbox" name="comments_default" value="1" /> Комментирование страниц по умолчанию</label> 
        </div>
        <div class="clear"></div>

        <div class="form_text">Отображать страницы с других категорий:</div>
        <div class="form_input">
        <select name="fetch_pages[]"  multiple="multiple">
            {foreach $include_cats as $c}
               <option value="{$c.id}"> {for $i=0; $i < $c.level;$i++}-{/for} {$c.name}</option>
            {/foreach}
        </select>
        </div>
        <div class="clear"></div>

        <div class="form_text">Главный шаблон:</div>
        <div class="form_input">
            <input type="text" name="main_tpl" value="" class="textbox_short" /> .tpl
            <div class="lite">Главный шаблон категории. По умолчанию  main.tpl</div> 
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">Шаблон Категории:</div>
        <div class="form_input">
            <input type="text" name="tpl" value="" class="textbox_short" /> .tpl
            <div class="lite">Основний шаблон категории. По умолчанию  category.tpl</div> 
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">Шаблон Страниц:</div>
        <div class="form_input">
            <input type="text" name="page_tpl" value="" class="textbox_short" /> .tpl
            <div class="lite">Шаблон просмотра страниц. По умолчанию  page_full.tpl</div>  
        </div>
        <div class="form_overflow"></div>
    </div>


<h4>Мета Теги</h4>
    <div>
        <div class="form_text">Meta Title:</div>
        <div class="form_input"><input type="text" name="title" value="" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Meta Description:</div>
        <div class="form_input"><textarea name="description" rows="2" cols="48"></textarea></div>
        <div class="form_overflow"></div>

        <div class="form_text">Meta Keywords:</div>
        <div class="form_input"><textarea name="keywords" rows="2" cols="48"></textarea></div>
        <div class="form_overflow"></div>
    </div>

    {($hook = get_hook('admin_tpl_create_category')) ? eval($hook) : NULL;}

</div>

{form_csrf()}

<div class="footer_block" align="right">
    <input type="submit" name="button" class="button_130" value="Создать" onclick="ajax_me('create_cat_form');" />
</div>

</form>

{literal}
<script type="text/javascript">
		var create_cat_tabs = new SimpleTabs('create_cat_tabs', {
		selector: 'h4'
		});

        load_editor();
</script>
{/literal}
