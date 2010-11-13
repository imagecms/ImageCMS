<form method="post" action="{$BASE_URL}admin/pages/update/{$update_page_id}" id="edit_page_form{$update_page_id}" style="width:100%;">

<div style="float:left; position:absolute;padding:3px;margin-left:350px;">
    <input type="button" title="Просмотр страницы на сайте" style="cursor:pointer;border:0px;width:16px;height:16px;background: transparent url({$THEME}/images/page_view.png) no-repeat;margin-right:10px;" value=" " onclick="
    {literal}
    new MochaUI.Window({
    {/literal}
					id: 'page_{$update_page_id}',
					title: '{site_url($category.path_url . $url)}',
                    loadMethod: 'iframe',
                    maximizable: true,
                    resizable : false,
                    minimizable : false,
					contentURL: '{site_url($category.path_url . $url)}',
					type: 'window',
					width: 500,
					height: 500
				{literal}
                });
                {/literal}

    MochaUI.Desktop.maximizeWindow( $('page_{$update_page_id}') ); 

    return false;
    " />
    <input type="submit" title="Сохранить" style="cursor:pointer;border:0px;width:16px;height:16px;background: transparent url({$THEME}/images/save_page.png) no-repeat;" value=" " onclick="ajax_me('edit_page_form{$update_page_id}');" />
</div>

<div id="tabs-block"  style="float:left;width:100%">

	<h4>Содержание</h4>
	<div id="text_id2" style="padding-left:10px;">

        { $this->template_vars['page_editing'] = TRUE }

        <div style="padding:3px;"></div>
        <div id="fast_category_list" style="float:left;">
            Категория: <select name="category" onchange="change_comments_status();" id="category_selectbox">
                <option value="0">Нет</option>
                   { $this->view("cats_select.tpl", $this->template_vars ) }
                </select>
        </div>

        <img  src="{$THEME}/images/plus2.png" style="padding-left:5px;padding-top:2px;cursor:pointer;float:left;" onclick="show_fast_add_cat();" title="Создать категорию" />

		<div class="form_overflow" style="padding:5px;"></div>

		Заголовок:
        <input type="text" name="page_title" value="{htmlspecialchars($title)}" id="page_title_u" class="textbox_long" /> 
		<div class="form_overflow"></div>
 
        <div id="page_header"> Предварительное содержание:</div>
         {if $orig_page}
            {literal}
                <script type="text/javascript">
                var prevSlide = new Fx.Slide('orig_prev_text');
                prevSlide.hide();

                $('toggle_prev').addEvent('click', function(e){
                    e = new Event(e);
                    prevSlide.toggle();
                    e.stop();
                });
                </script>
            {/literal}
         <div style="width:75%" id="res1">
            <div id="handler1" style="float:right; height:20px;">
                <img src="{$THEME}/images/arrow-up-right.png" id="toggle_prev" />
            </div>
            <div  id="orig_prev_text">
                {$text = str_replace('&nbsp', ' ', $orig_page.prev_text)}
                {//$text = strip_tags($text)}
                {$text}
            </div>
         </div>
         {/if}
		<textarea id="prev_text" class="mceEditor" name="prev_text" rows="15" cols="180"  style="width:700px;height:400px;">
		    {encode($prev_text)}
		</textarea>

        <div id="page_header"> Полное содержание:</div>
         {if $orig_page}
            {literal}
                <script type="text/javascript">
                var fullSlide = new Fx.Slide('orig_full_text');
                fullSlide.hide();

                $('toggle_full').addEvent('click', function(e){
                    e = new Event(e);
                    fullSlide.toggle();
                    e.stop();
                });
                </script>
            {/literal}
         <div style="width:75%;" id="res1">
            <div id="handler1" style="float:right; height:20px;">
                <img src="{$THEME}/images/arrow-up-right.png" id="toggle_full" />
            </div>
            <div  id="orig_full_text" >
                {$text = str_replace('&nbsp', ' ', $orig_page.full_text)}
                {//$text = strip_tags($text)}
                {$text} 
            </div>
         </div>
         {/if}
		<textarea id="full_text" class="mceEditor" name="full_text" rows="15" cols="180" style="width:700px;height:400px;">
		    {encode($full_text)}
		</textarea>
    </div>

	<h4 title="Настройки">Настройки</h4>
	<div style="padding:8px;">

		<div class="form_text">URL:</div>
		<div class="form_input"><input type="text" name="page_url" {if $lang_alias != 0} disabled="disabled" {/if} value="{$url}" id="page_url" class="textbox_long" /> 
        <img onclick="translite_title($('page_title_u').value);" align="absmiddle" style="cursor:pointer" src="{$THEME}/images/translit.png" width="16" height="16" title="Транслитерация заголовка." /> 
        <div class="lite">(только латинские символы)</div>
        </div>
        <div class="form_overflow"></div>

		<div class="form_text">Теги:</div>
		<div class="form_input"><input type="text" name="search_tags" value="{foreach $tags as $tag}{$tag.value},{/foreach}" id="tags" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">Meta title:</div>
		<div class="form_input"><input type="text" name="meta_title" value="{$meta_title}" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">Meta description:</div>
		<div class="form_input">
		<textarea name="page_description" class="textarea" id="page_description" rows="8" cols="48">{$description}</textarea>
		<img onclick="create_description(  tinyMCE.get('prev_text').getContent() );" src="{$THEME}/images/arrow-down.png" title="Сгенерировать описание" style="cursor:pointer" width="16" height="16" />
		</div>
		<div class="form_overflow"></div>

		<div class="form_text">Meta keywords:</div>
		<div class="form_input">
			<textarea name="page_keywords" id="page_keywords" class="textarea" rows="8" cols="28">{$keywords}</textarea>
			<img src="{$THEME}/images/arrow-down.png" style="cursor:pointer" width="16" height="16" title="Сгенерировать ключевые слова" onclick="retrive_keywords( tinyMCE.get('full_text').getContent() + tinyMCE.get('prev_text').getContent() );" />

			<div style="max-width:600px" id="keywords_list">

			</div>
		</div>
		<div class="form_overflow"></div>

		<div class="form_text">Шаблон Страницы:</div>
		<div class="form_input">
			<input type="text" name="full_tpl" value="{$full_tpl}" class="textbox_long" /> .tpl
		</div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
			<label><input type="checkbox" name="comments_status" value="1" {if $comments_status == 1} checked="checked" {/if} /> Разрешить комментирование</label>
		</div>
		<div class="form_overflow"></div>

	</div>

    {($hook = get_hook('admin_tpl_edit_page')) ? eval($hook) : NULL;}

</div>

<div id="sidebar2">
    <div><h3><a onclick="side_panel('show');">показать настройки</a></h3></div>
</div>

<div id="sidebar1">
	<div id="side_bar_right"><h3>Настройки (<a onclick="side_panel('hide');">скрыть</a>)</h3></div>

    <div style="padding:5px;" id="vertical_slide">
        <p style="padding-left:15px;">
        <b>Статус публикации: </b><br />
            <select name="post_status" id="post_status">
                <option value="publish" {if $post_status == "publish"} selected="selected" {/if} >Опубликовано</option>
                <option value="pending" {if $post_status == "pending"} selected="selected" {/if} >Ожидает одобрения</option>
                <option value="draft" {if $post_status == "draft"} selected="selected" {/if} >Не опубликовано</option>
            </select>
        </p>

        <hr />

        <p style="padding-left:15px;">
            <b>Дата и время публикации:</b>
            <p style="padding-left:15px;"><input id="publish_date" name="publish_date" tabindex="7" value="{$publish_date}" type="text" class="textbox_short" /></p>
            <p style="padding-left:15px;"><input id="publish_time" name="publish_time" tabindex="8" type="text" value="{$publish_time}" class="textbox_short" /></p>
        </p>

        <hr />

        <p style="padding-left:15px">
        <b>Доступ:</b><br />
            <select multiple="multiple" name="roles[]">
                <option value="0" {$all_selected} >Все</option>
                {foreach $roles as $role}
                  <option {$role.selected} value="{$role.id}">{$role.alt_name}</option>
                {/foreach}
            </select>
        </p>

        <hr />

        <div style="padding-left:15px;">
            {if $show_langs == "1"}
            <b>Редактировать на языке:</b>
                <div style="padding-left:15px;">
                    <ul>
                        {foreach $langs as $lang}
                        <li><a {if $page_lang == $lang['id']} style="font-weight:bold;" {/if} href="#" onclick="change_edit_lang('{$page_id}','{$lang.id}'); return false;">{$lang.lang_name}</a></li>
                        {/foreach}
                    </ul>
                </div>
            {/if}
        </div>

        <hr />

        <div style="padding-left:15px;">
        <b>Действия:</b>
                <div style="padding-left:15px;">
                <ul>
                    <li><a href="#" onclick="confirm_delete_page('{$update_page_id}'); return false;">Удалить</a></li>
                </ul>
                </div>
        </div>

        {($hook = get_hook('admin_tpl_edit_page_side_bar')) ? eval($hook) : NULL;}

    </div>
</div>

    <div style="padding:10px;clear:left;">
        <input type="submit" name="button" id="page_save_button" class="button_silver_130" value="Сохранить" onclick="ajax_me('edit_page_form{$update_page_id}');" />
    </div>
{form_csrf()}</form>

{literal}
    <style>
    #res1 {
        background:#EEEEEE none repeat scroll 0 0;
        border-color:#F5F5F5 #DDDDDD #DDDDDD #F5F5F5;
        border-style:solid;
        border-width:1px;
        color:#222222;
        font-size:11px;
        font-weight:normal;
        margin:0;
        overflow:auto;
        padding:2px 5px;
        position:relative;
    }
    </style>

	<script type="text/javascript">
		window.addEvent('domready', function() {
			pub_date_cal = new Calendar({ publish_date: 'Y-m-d' }, { direction: .0, tweak: {x: -150, y: 22} });

            var sp_param = Cookie.read('sidepanel');
            if (sp_param == 'show')
            {
                document.getElementById('sidebar1').style.display='none';
                document.getElementById('sidebar2').style.display='block';
            }

			new Autocompleter.Request.JSON('tags', base_url + 'admin/pages/json_tags', {
    			'postVar': 'search_tags'
			});

			var cms_tabs = new SimpleTabs('tabs-block', {
			selector: 'h4'
			});

            load_editor();

		});
	</script>
{/literal}
