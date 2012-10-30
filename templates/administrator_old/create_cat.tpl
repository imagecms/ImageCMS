<form method="post" action="{$BASE_URL}admin/categories/create/new" id="create_cat_form" style="width:100%">

<div id="create_cat_tabs">
<h4>{lang('a_param')}</h4>
    <div>
        <div class="form_text">{lang('a_name')}:</div>
        <div class="form_input"><input type="text" name="name" id="cat_name" value="" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_url')}:</div>
        <div class="form_input">
            <input type="text" name="url" id="cat_url" value="" class="textbox_long" />
           <img onclick="translite_cat_name($('cat_name').value);" align="absmiddle" style="cursor:pointer" src="{$THEME}/images/translit.png" width="16" height="16" /> 
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_parent')}:</div>
        <div class="form_input">
            <select name="parent_id">
            <option value="0" selected="selected">{lang('a_no')}</option>
            { $this->view("cats_select.tpl", $this->template_vars); }
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
            <input type="text" name="image" id="cat_image" value="" class="textbox_long" />
            <img src="{$THEME}/images/images.png" width="16" height="16" title="{lang('a_select_image')}" style="cursor:pointer;" align="absmiddle"  onclick="tinyBrowserPopUp('image', 'cat_image');" />
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_desc')}:</div>
        <div class="form_input">
             <textarea name="short_desc" id="short_desc" class="mceEditor"></textarea>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_position')}:</div>
        <div class="form_input"><input type="text" name="position" value="0" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text"></div>
        <div class="form_input"><h3>{lang('a_page_view')}</h3></div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_sort')}:</div>
        <div class="form_input">
            <select name="order_by">
            <option value="publish_date" selected="selected">{lang('a_by_date')}</option>    
            <option value="title">{lang('a_by_abc')}</option>    
            <option value="position">{lang('a_by_pos')}</option>    
            </select>

            <select name="sort_order">
            <option value="desc" selected="selected">{lang('a_desc_order')}</option> 
            <option value="asc">{lang('a_asc_order')}</option>    
            </select>
        </div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_records_count')}:</div>
        <div class="form_input">
           <input type="text" name="per_page" value="15" class="textbox_long" /> 
        </div>
        <div class="clear"></div>

        <div class="form_text"></div>
        <div class="form_input">
           <label><input type="checkbox" name="comments_default" value="1" /> {lang('a_comm_by_def')}</label> 
        </div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_disp_pages_f_other_cats')}:</div>
        <div class="form_input">
        <select name="fetch_pages[]"  multiple="multiple">
            {foreach $include_cats as $c}
               <option value="{$c.id}"> {for $i=0; $i < $c.level;$i++}-{/for} {$c.name}</option>
            {/foreach}
        </select>
        </div>
        <div class="clear"></div>

        <div class="form_text">{lang('a_main_tpl')}:</div>
        <div class="form_input">
            <input type="text" name="main_tpl" value="" class="textbox_short" /> .tpl
            <div class="lite">{lang('a_main_tpl_by_def')}  main.tpl</div> 
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_cat_tpl')}:</div>
        <div class="form_input">
            <input type="text" name="tpl" value="" class="textbox_short" /> .tpl
            <div class="lite">{lang('a_main_cat_tpl_by_def')}  category.tpl</div> 
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_pages_tpl')}:</div>
        <div class="form_input">
            <input type="text" name="page_tpl" value="" class="textbox_short" /> .tpl
            <div class="lite">{lang('a_pages_view_tpl_by_def')}  page_full.tpl</div>  
        </div>
        <div class="form_overflow"></div>
    </div>


<h4>{lang('a_meta_tags')}</h4>
    <div>
        <div class="form_text">{lang('a_meta_title')}:</div>
        <div class="form_input"><input type="text" name="title" value="" class="textbox_long" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_meta_description')}:</div>
        <div class="form_input"><textarea name="description" rows="2" cols="48"></textarea></div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('a_meta_keywords')}:</div>
        <div class="form_input"><textarea name="keywords" rows="2" cols="48"></textarea></div>
        <div class="form_overflow"></div>
    </div>

    {($hook = get_hook('admin_tpl_create_category')) ? eval($hook) : NULL;}

</div>

{form_csrf()}

<div class="footer_block" align="right">
    <input type="submit" name="button" class="button_130" value="{lang('a_create')}" onclick="ajax_me('create_cat_form');" />
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
