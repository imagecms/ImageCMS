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
</div>

<div id="tabs-block"  style="float:left;width:100%">
	<h4>{lang('a_content')}</h4>
	<div id="text_id2" style="padding-left:10px;">

        { $this->template_vars['page_editing'] = TRUE }

        <div style="padding:3px;"></div>
        <div id="fast_category_list" style="float:left;">
            {lang('a_category')}: <select name="category" onchange="change_comments_status();" id="category_selectbox">
                <option value="0">{lang('a_no')}</option>
                   { $this->view("cats_select.tpl", $this->template_vars ) }
                </select>
        </div>

        <img  src="{$THEME}/images/plus2.png" style="padding-left:5px;padding-top:2px;cursor:pointer;float:left;" onclick="show_fast_add_cat();" title="{lang('a_create_cat')}" />

		<div class="form_overflow" style="padding:5px;"></div>

		{lang('a_title')}:
        <input type="text" name="page_title" value="{htmlspecialchars($title)}" id="page_title_u" class="textbox_long" /> 
		<div class="form_overflow"></div>
 
        <div id="page_header"> {lang('a_prev_cont')}:</div>
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

        <div id="page_header"> {lang('a_full_cont')}:</div>
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

		<div style="height:25px;"></div>
    </div>

	<h4 title="Настройки">{lang('a_sett')}</h4>
	<div style="padding:8px;">

		<div class="form_text">{lang('a_url')}:</div>
		<div class="form_input"><input type="text" name="page_url" {if $lang_alias != 0} disabled="disabled" {/if} value="{$url}" id="page_url" class="textbox_long" /> 
        <img onclick="translite_title($('page_title_u').value);" align="absmiddle" style="cursor:pointer" src="{$THEME}/images/translit.png" width="16" height="16" title="{lang('a_trans_title')}." /> 
        <div class="lite">({lang('a_just_lat')})</div>
        </div>
        <div class="form_overflow"></div>

		<div class="form_text">{lang('a_tags')}:</div>
		<div class="form_input"><input type="text" name="search_tags" value="{foreach $tags as $tag}{$tag.value},{/foreach}" id="tags" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_meta_title')}:</div>
		<div class="form_input"><input type="text" name="meta_title" value="{$meta_title}" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_meta_description')}:</div>
		<div class="form_input">
		<textarea name="page_description" class="textarea" id="page_description" rows="8" cols="48">{$description}</textarea>
		<img onclick="create_description(  tinyMCE.get('prev_text').getContent() );" src="{$THEME}/images/arrow-down.png" title="{lang('a_gen_desc')}" style="cursor:pointer" width="16" height="16" />
		</div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_meta_keywords')}:</div>
		<div class="form_input">
			<textarea name="page_keywords" id="page_keywords" class="textarea" rows="8" cols="28">{$keywords}</textarea>
			<img src="{$THEME}/images/arrow-down.png" style="cursor:pointer" width="16" height="16" title="{lang('a_gen_key_words')}" onclick="retrive_keywords( tinyMCE.get('full_text').getContent() + tinyMCE.get('prev_text').getContent() );" />

			<div style="max-width:600px" id="keywords_list">

			</div>
		</div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_main_tpl')}:</div>
		<div class="form_input">
			<input type="text" name="main_tpl" value="{$main_tpl}" class="textbox_long" /> .tpl
			<div class="lite">{lang('a_by_default')}  main.tpl</div>
		</div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_page_tpl')}:</div>
		<div class="form_input">
			<input type="text" name="full_tpl" value="{$full_tpl}" class="textbox_long" /> .tpl
			<div class="lite">{lang('a_by_default')}  page_full.tpl</div>
		</div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
			<label><input type="checkbox" name="comments_status" value="1" {if $comments_status == 1} checked="checked" {/if} /> {lang('a_comm_alow')}</label>
		</div>
		<div class="form_overflow"></div>

	</div>

    {($hook = get_hook('admin_tpl_edit_page')) ? eval($hook) : NULL;}

</div>

<div id="sidebar2">
    <div><h3><a onclick="side_panel('show');">{lang('a_show_sett')}</a></h3></div>
</div>

<div id="sidebar1">
	<div id="side_bar_right"><h3>{lang('a_sett')} (<a onclick="side_panel('hide');">{lang('a_hide')}</a>)</h3></div>

    <div style="padding:5px;" id="vertical_slide">
        <p style="padding-left:15px;">
        <b>{lang('a_pub_stat')}: </b><br />
            <select name="post_status" id="post_status">
                <option value="publish" {if $post_status == "publish"} selected="selected" {/if} >{lang('a_published')}</option>
                <option value="pending" {if $post_status == "pending"} selected="selected" {/if} >{lang('a_wait_approve')}</option>
                <option value="draft" {if $post_status == "draft"} selected="selected" {/if} >{lang('a_not_publ')}</option>
            </select>
        </p>

        <hr />
	
	<p style="padding-left:15px;">
	    <b>{lang('a_date_and_time_cr')}:</b>
		<p style="padding-left:15px;"><input id="create_date" name="create_date" tabindex="7" value="{$create_date}" type="text" class="textbox_short" /></p>
		<p style="padding-left:15px;"><input id="create_time" name="create_time" tabindex="8" type="text" value="{$create_time}" class="textbox_short" /></p>
	    </p>
	<hr />

        <p style="padding-left:15px;">
            <b>{lang('a_date_and_time_p')}:</b>
            <p style="padding-left:15px;"><input id="publish_date" name="publish_date" tabindex="7" value="{$publish_date}" type="text" class="textbox_short" /></p>
            <p style="padding-left:15px;"><input id="publish_time" name="publish_time" tabindex="8" type="text" value="{$publish_time}" class="textbox_short" /></p>
        </p>

        <hr />

        <p style="padding-left:15px">
        <b>{lang('a_access')}:</b><br />
            <select multiple="multiple" name="roles[]">
                <option value="0" {$all_selected} >{lang('a_all')}</option>
                {foreach $roles as $role}
                  <option {$role.selected} value="{$role.id}">{$role.alt_name}</option>
                {/foreach}
            </select>
        </p>

        <hr />

        <div style="padding-left:15px;">
            {if $show_langs == "1"}
            <b>{lang('a_edit_on_language')}:</b>
                <div style="padding-left:15px;">
                    <ul>
                        {foreach $langs as $lang}
                        <li><a {if $page_lang == $lang['id']} style="font-weight:bold;" {/if} href="#" onclick="change_edit_lang('{$page_id}','{$lang.id}'); return false;">{$lang.lang_name}</a></li>
                        {/foreach}
                    </ul>
                </div>
            {/if}
        </div>

        {($hook = get_hook('admin_tpl_edit_page_side_bar')) ? eval($hook) : NULL;}

    </div>
</div>

{form_csrf()}

<div class="footer_block" align="right">
    <input type="submit" name="button" id="page_save_button" class="button_silver_130" value="{lang('a_save')}" onclick="ajax_me('edit_page_form{$update_page_id}');" />
    <input type="submit" class="button_red" value="{lang('a_delete')}" onclick="confirm_delete_page('{$update_page_id}'); return false;" />
</div>

</form>

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
			create_date_cal = new Calendar({ create_date: 'Y-m-d' }, { direction: .0, tweak: {x: -150, y: 22} });

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
	    
	    function load_editor2()        {
                    tinyMCE.init({
                        mode : 'specific_textareas',
                        editor_selector : 'mceEditor2',
                        language: 'ru',
                        theme : 'advanced',
                        skin : "o2k7",
                        skin_variant : "silver",
                        plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
                        theme_advanced_buttons1 : "imagebox, bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,undo,redo,|,forecolor,backcolor,|,styleselect,formatselect,fontselect,fontsizeselect ",
                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,outdent,indent,blockquote,|,link,unlink,anchor,image,media,|,pagebreak,cleanup,code,|,fullscreen ",
                        theme_advanced_buttons3 : "",
                        theme_advanced_toolbar_location : "top",
                        theme_advanced_toolbar_align : "left",
                        theme_advanced_statusbar_location : "bottom",
                        theme_advanced_resizing : true,
                        content_css : theme + "/css/content.css",
                        paste_use_dialog : false,
                        theme_advanced_resizing : true,
                        file_browser_callback : "tinyBrowser",
                        theme_advanced_resize_horizontal : true,
                        apply_source_formatting : true,
                        force_br_newlines : true,
                        force_p_newlines : false,
                        relative_urls : false,
                        setup : function(ed) {
                            ed.addButton('imagebox', {
                                title : 'Imagebox',
                                image : '/application/modules/imagebox/templates/images/button.png',
                                onclick : function() {
                                    show_main_window();
                                    }
                                    });
                            },
                            });
                    };
		    
		var editor_loaded = false;
		
		$('tabs-block').getElements('a').addEvent('mouseover', function(event){
		    if (!editor_loaded)
		    {
			load_editor2();
			editor_loaded = true;
		    }
		    });

		});
	</script>
{/literal}
