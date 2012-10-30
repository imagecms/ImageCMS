<form method="post" action="{$BASE_URL}admin/categories/create/update/{$id}" id="edit_cat_form" style="width:100%;">

<div id="edit_cat_tabs">
<h4>{lang('a_param')}</h4>
    <div style="padding:2px;">
        {if count($langs) > 1}
        <div class="form_text">{lang('a_edit_on_language')}:</div>
        <div class="form_input">
            {foreach $langs as $l}
                <a href="javascript:translate_category_window({$id}, {$l.id});" style="padding-right:5px;">{$l.lang_name}</a>
            {/foreach}
        </div>
        <div class="form_overflow"></div>
        {/if}

        <div class="form_text">{lang('a_name')}:</div>
        <div class="form_input"><input type="text" name="name" id="cat_name" value="{$name}" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_url')}:</div>
        <div class="form_input">
            <input type="text" name="url" id="cat_url" value="{$url}" class="textbox_long" />
           <img onclick="translite_cat_name($('cat_name').value);" align="absmiddle" style="cursor:pointer" src="{$THEME}/images/translit.png" width="16" height="16" />
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_parent')}:</div>
        <div class="form_input">
            <select name="parent_id">
            <option value="0">{lang('a_no')}</option>
            {  $this->view("cats_select.tpl", $this->template_vars)}
            </select>
        </div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_fields_group')}:</div>
        <div class="form_input">
            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
            <select name="category_field_group">
                <option value="-1">{lang('a_no')}</option>
            {foreach $f_groups as $k => $v}
                <option value="{$k}" {if $k == $category_field_group} selected="selected" {/if}>{$v}</option>
            {/foreach}
            </select>

            <br>
            <label><input type="checkbox" value="1" name="category_apply_for_subcats"> {lang('a_apply_for_subcats')}</label>
            <br/>

            <div class="lite">{lang('a_sel_gr_fld_f_subcats')}.</div>
        </div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_pages_fields_group')}:</div>
        <div class="form_input">
            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
            <select name="field_group">
                <option value="-1">{lang('a_no')}</option>
            {foreach $f_groups as $k => $v}
                <option value="{$k}" {if $k == $field_group} selected="selected" {/if}>{$v}</option>
            {/foreach}
            </select>

            <br>
            <label><input type="checkbox" value="1" name="apply_for_subcats"> {lang('a_apply_for_subcats')}</label>
            <br/>

            <div class="lite">{lang('a_select_fields_group')}.</div>
        </div>
        <div class="clear"></div>


        <div class="form_text">{lang('a_image')}:</div>
        <div class="form_input">
            <input type="text" name="image" id="cat_image" value="{$image}" class="textbox_long" />
            <img src="{$THEME}/images/images.png" width="16" height="16" title="{lang('a_select_image')}" style="cursor:pointer;" align="absmiddle"  onclick="tinyBrowserPopUp('image', 'cat_image');" />
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_desc')}:</div>
        <div class="form_input">
             <textarea name="short_desc" id="short_desc" class="mceEditor textarea">{htmlspecialchars($short_desc)}</textarea>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_position')}:</div>
        <div class="form_input"><input type="text" name="position" value="{$position}" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text"></div>
        <div class="form_input"><h3>{lang('a_page_view')}</h3></div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_sort')}:</div>
        <div class="form_input">
            <select name="order_by">
            <option value="publish_date" {if $order_by == "publish_date"} selected="selected" {/if}>{lang('a_by_date')}</option>
            <option value="title" {if $order_by == "title"} selected="selected" {/if}>{lang('a_by_abc')}</option>
            <option value="position" {if $order_by == "position"} selected="selected" {/if}>{lang('a_by_pos')}</option>
            </select>

            <select name="sort_order">
            <option value="desc" {if $sort_order == "desc"} selected="selected" {/if}>{lang('a_desc_order')}</option>
            <option value="asc" {if $sort_order == "asc"} selected="selected" {/if}>{lang('a_asc_order')}</option>
            </select>
        </div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_records_count')}:</div>
        <div class="form_input">
           <input type="text" name="per_page" value="{$per_page}" class="textbox_long" />
        </div>
        <div class="clear"></div>

        <div class="form_text"></div>
        <div class="form_input">
           <label><input type="checkbox" name="comments_default" value="1" {if $comments_default == 1 } checked="checked" {/if}  />  {lang('a_comm_by_def')}</label>
        </div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_disp_pages_f_other_cats')}:</div>
        <div class="form_input">

        <select name="fetch_pages[]"  multiple="multiple">
            {foreach $include_cats as $c}
            {if $c.id == $id}
               <option disabled="disabled" value="{$c.id}"> {for $i=0; $i < $c.level;$i++}-{/for} {$c.name}</option>
            {else:}
                <option value="{$c.id}"{foreach $fetch_pages as $k => $v}{if $v == $c.id} selected="selected" {/if}{/foreach}>{for $i=0; $i < $c.level;$i++}-{/for} {$c.name}</option>
            {/if}
            {/foreach}
        </select>
        </div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_main_tpl')}:</div>
        <div class="form_input">
            <input type="text" name="main_tpl" value="{$main_tpl}" class="textbox_short" /> .tpl
            <div class="lite">{lang('a_main_tpl_by_def')}  main.tpl</div>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_cat_tpl')}:</div>
        <div class="form_input">
            <input type="text" name="tpl" value="{$tpl}" class="textbox_short" /> .tpl
            <div class="lite">{lang('a_main_cat_tpl_by_def')}  category.tpl</div>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_pages_tpl')}:</div>
        <div class="form_input">
            <input type="text" name="page_tpl" value="{$page_tpl}" class="textbox_short" /> .tpl
            <div class="lite">{lang('a_pages_view_tpl_by_def')}  page_full.tpl</div>
        </div>
        <div class="form_overflow"></div>
    </div>


<h4>{lang('a_meta_tags')}</h4>
    <div>
        <div class="form_text">{lang('a_meta_title')}:</div>
        <div class="form_input"><input type="text" name="title" value="{$title}" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_meta_description')}:</div>
        <div class="form_input"><textarea name="description" rows="2" cols="48">{$description}</textarea></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_meta_keywords')}:</div>
        <div class="form_input"><textarea name="keywords" rows="2" cols="48">{$keywords}</textarea></div>
        <div class="form_overflow"></div>
    </div>

    {($hook = get_hook('admin_tpl_edit_category')) ? eval($hook) : NULL;}

</div>

{form_csrf()}

<div class="footer_block" align="right">
    <input type="submit" name="button" class="button_silver_130" value="{lang('a_save')}" onclick="ajax_me('edit_cat_form');" />
    <input type="submit" name="button" class="button" value="{lang('a_cancel')}" onclick="ajax_div('page', base_url + 'admin/categories/cat_list'); return false;" />
</div>

</form>

{literal}
<script type="text/javascript">
		var edit_cat_tabs = new SimpleTabs('edit_cat_tabs', {
    		selector: 'h4'
		});

        load_editor();

        function translate_category_window(cat_id, lang)
        {
            MochaUI.search_p_Window = function(){
                new MochaUI.Window({
                    id: 'translate_category_w',
                    title: 'Первевод категории',
                    loadMethod: 'xhr',
                    contentURL: base_url + 'admin/categories/translate/' + cat_id + '/' + lang,
                    width: 600,
                    height: 600
                });
            }

            MochaUI.search_p_Window();
        }
</script>
{/literal}
