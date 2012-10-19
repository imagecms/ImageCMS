<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_edit_user_mod')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/categories/cat_list" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                    <button type="submit" class="btn btn-small action_on formSubmit" data-action="close" data-form="#save"><i class="icon-ok"></i>{lang('a_save')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-action="exit" data-form="#save"><i class="icon-check"></i>{lang('a_footer_save_exit')}</button>

                    <div class="dropdown d-i_b">
                        {foreach $langs as $l}
                            {if $l['default'] == 1}
                                <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                                    {$l.lang_name}
                                    <span class="caret"></span>

                                </a>
                            {/if}   
                        {/foreach}
                        <ul class="dropdown-menu">
                            {foreach $langs as $l}
                                <li><a href="{$BASE_URL}admin/categories/translate/{$id}/{$l.id}">{$l.lang_name}</a></li>
                            {/foreach}
                        </ul>

                    </div>
                </div>
            </div>                            
        </div>
        <form method="post" action="{$BASE_URL}admin/categories/create/update/{$id}" id="save">
            <div class="content_big_td">
                <div class="clearfix">
                    <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                        <a href="#parameters" class="btn btn-small active">{lang('param')}</a>
                        <a href="#metatag" class="btn btn-small">{lang('a_meta_tags')}</a>
                        <a href="#dodPol" class="btn btn-small">{lang('a_addit_fiel_bas_a')}</a>
                    </div>                    
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="parameters">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_info')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="name">{lang('a_name')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="name" value="{$name}" id="name">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="url">{lang('a_url')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <div class="">
                                                                    <button onclick="translite_title('#name', '#url');" type="button" class="btn btn-small" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('a_auto_fit_by_url')}</button>
                                                                </div>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="url" value="{$url}" id="url">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="parent_id">{lang('a_parent')}:</label>
                                                        <div class="controls">
                                                            <select name="parent_id" id="parent_id">
                                                                <option value="0">{lang('a_no')}</option>
                                                                {  $this->view("cats_select.tpl", $this->template_vars)}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="category_field_group">{lang('a_fields_group')}:</label>
                                                        <div class="controls">

                                                            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                            <select name="category_field_group" id="category_field_group">
                                                                <option value="-1">{lang('a_no')}</option>
                                                                {foreach $f_groups as $k => $v}
                                                                    <option value="{$k}" {if $k == $category_field_group} selected="selected" {/if}>{$v}</option>
                                                                {/foreach}
                                                            </select>
                                                            <p class="help-block">Основной шаблон категории. По умолчанию category.tpl</p>

                                                            <div class="group_icon help-block">
                                                                <span class="frame_label no_connection">
                                                                    <span class="niceCheck b_n">
                                                                        <input type="checkbox" value="1" name="category_apply_for_subcats"> 
                                                                    </span>
                                                                    {lang('a_apply_for_subcats')}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="field_group">{lang('a_pages_fields_group')}:</label>
                                                        <div class="controls">
                                                            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                            <select name="field_group" id="field_group">
                                                                <option value="-1">{lang('a_no')}</option>
                                                                {foreach $f_groups as $k => $v}
                                                                    <option value="{$k}" {if $k == $field_group} selected="selected" {/if}>{$v}</option>
                                                                {/foreach}
                                                            </select>
                                                            <p class="help-block">{lang('a_select_fields_group')}</p>
                                                            <div class="group_icon help-block">
                                                                <span class="frame_label no_connection">
                                                                    <span class="niceCheck b_n">
                                                                        <input type="checkbox" value="1" name="apply_for_subcats"> 
                                                                    </span>
                                                                    {lang('a_apply_for_subcats')}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    	<div class="control-group">
                                                            <label class="control-label" for="Img">{lang('a_image')}:
                                                                <span class="btn btn-small p_r" data-url="file">
                                                                    <i class="icon-camera"></i>&nbsp;&nbsp;{lang('a_select_image')}
                                                                    <input type="file" class="btn-small btn" id="Img" name="image">
                                                                </span>                                              
                                                            </label>
                                                            <div class="controls">
                                                            {if $image}
                                                            	<img src="$image" class="img-polaroid " style="width: 100px; ">
                                                            {else:}
                                                            	<img src="{$THEME}/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                                                            {/if}
                                                            </div>
                                                        </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="position">{lang('a_position')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="position" value="{$position}" id="position">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="short_desc">{lang('a_desc')}:</label>
                                                        <div class="controls">
                                                            <textarea name="short_desc" id="short_desc" class="elRTE">{htmlspecialchars($short_desc)}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_page_view')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="order_by">{lang('a_sort')}:</label>
                                                        <div class="controls">
                                                            <div class="pull-left span6">
                                                                <select name="order_by" id="order_by">
                                                                    <option value="publish_date" {if $order_by == "publish_date"} selected="selected" {/if}>{lang('a_by_date')}</option>
                                                                    <option value="title" {if $order_by == "title"} selected="selected" {/if}>{lang('a_by_abc')}</option>
                                                                    <option value="position" {if $order_by == "position"} selected="selected" {/if}>{lang('a_by_pos')}</option>
                                                                </select>
                                                            </div>
                                                            <div class="pull-left span6">

                                                                <select name="sort_order">
                                                                    <option value="desc" {if $sort_order == "desc"} selected="selected" {/if}>{lang('a_desc_order')}</option>
                                                                    <option value="asc" {if $sort_order == "asc"} selected="selected" {/if}>{lang('a_asc_order')}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="per_page">{lang('a_records_count')}:</label>
                                                        <div class="controls">

                                                            <input type="text" name="per_page" value="{$per_page}" id="per_page" />
                                                            <div class="frame_label no_connection m-t_10">
                                                                <span class="niceCheck b_n">
                                                                    <input type="checkbox" name="comments_default" value="1" {if $comments_default == 1 } checked="checked" {/if}  />  
                                                                </span>
                                                                {lang('a_comm_by_def')}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="fetch_pages">{lang('a_disp_pages_f_other_cats')}:</label>
                                                        <div class="controls">

                                                            <div class="o_h">
                                                                <select name="fetch_pages[]"  multiple="multiple" size="5" id="fetch_pages">
                                                                    {foreach $include_cats as $c}
                                                                        <option value="{$c.id}"> {for $i=0; $i < $c.level;$i++}-{/for} {$c.name}</option>
                                                                    {/foreach}
                                                                </select>

                                                            </div>
                                                        </div></div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="main_tp">{lang('a_main_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="main_tpl" value="{$main_tpl}"  id="main_tp" />                                                                              </div>
                                                            <p class="help-block">{lang('a_main_tpl_by_def')}  main.tpl</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="tpl">{lang('a_cat_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="tpl" value="{$tpl}" id="tpl" /> 

                                                            </div>
                                                            <p class="help-block">{lang('a_main_cat_tpl_by_def')}  category.tpl</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="page_tpl">{lang('a_pages_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="page_tpl" value="{$page_tpl}" id="page_tpl" />                                                           
                                                            </div>
                                                            <p class="help-block">{lang('a_pages_view_tpl_by_def')} page_full.tpl</p>
                                                        </div>
                                                    </div>                                             
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="metatag">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_meta_tags')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">

                                                    <div class="control-group"><label class="control-label" for="title">{lang('a_meta_title')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="title" value="{$title}" id="title" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group"><label class="control-label" for="description">{lang('a_meta_description')}:</label>
                                                        <div class="controls">
                                                            <textarea id="description" name="description"  rows="10" cols="180" >{$description}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group"><label class="control-label" for="keywords">{lang('a_meta_keywords')}:</label>
                                                        <div class="controls">
                                                            <textarea id="keywords" name="keywords" rows="10" cols="180" >{$keywords}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="dodPol">


                        {($hook = get_hook('admin_tpl_edit_category')) ? eval($hook) : NULL;}



                    </div>
                </div>
            </div>
            </div>
            </div>
    </section>
</div>
{form_csrf()}
</form>