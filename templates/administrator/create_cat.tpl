<form method="post" action="{$BASE_URL}admin/categories/create/new" >
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="#">Главная</a> <span class="divider">/</span></li>
            <li class="active">Список товаров</li>
        </ul>

        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang('a_param')}</span>
                </div>

                <div class="pull-right">
                    <div class="d-i_b">                        
                        <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                        <button type="submit" value="{lang('a_create')}" onclick="ajax_me('create_cat_form');" class="btn btn-small action_on"><i class="icon-ok"></i>Сохранить</button>
                        <button type="button" class="btn btn-small action_on"><i class="icon-check"></i>Сохранить и выйти</button>
                        <div class="dropdown d-i_b">
                            <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                                Русский
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Английский</a></li>
                            </ul>
                        </div>
                    </div>
                </div>                            
            </div>
            <div class="content_big_td">
                <div class="clearfix">
                    <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                        <a href="#parameters" class="btn btn-small active">Параметры</a>
                        <a href="#metatag" class="btn btn-small">Метатеги</a>
                    </div>
                    <div class="pull-right m-t_20">
                        <a href="#">Просмотр страницы <span class="f-s_14">→</span></a>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="parameters">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        Информация
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="form-horizontal">

                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName">{lang('a_name')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="inputName">
                                                        </div>
                                                    </div>      

                                                    <div class="control-group">
                                                        <label class="control-label" for="inputUrl">{lang('a_url')}:</label>

                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <div class="">                                                                           
                                                                    <button type="button" class="btn btn-small" onclick="translite_cat_name($('cat_name').value);"><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор</button>
                                                                </div>
                                                            </div>


                                                            <div class="o_h">
                                                                <input type="text" name="url" id="cat_url">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="inputParent">{lang('a_parent')}:</label>
                                                        <div class="controls">
                                                            <select id="inputParent" name="parent_id">
                                                                <option value="0" selected="selected">{lang('a_no')}</option>
                                                                { $this->view("cats_select.tpl", $this->template_vars); }
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="inputGroupField">{lang('a_fields_group')}:</label>
                                                        <div class="controls">
                                                            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                            <select name="category_field_group" id="inputParent">
                                                                <option value="-1">{lang('a_no')}</option>
                                                                {foreach $f_groups as $k => $v}
                                                                    <option value="{$k}" {if $k == $category_field_group} selected="selected" {/if}>{$v}</option>
                                                                {/foreach}
                                                            </select>

                                                            <p class="help-block">{lang('a_sel_gr_fld_f_subcats')}.</p>
                                                            <div class="group_icon help-block">
                                                                <span class="frame_label no_connection">
                                                                    <span class="niceCheck b_n">
                                                                        <input type="checkbox" value="1" name="category_apply_for_subcats" /> 
                                                                    </span>
                                                                    {lang('a_apply_for_subcats')}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName">{lang('a_pages_fields_group')}:</label>
                                                        <div class="controls">
                                                            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                            <select name="field_group">
                                                                <option value="-1">{lang('a_no')}</option>
                                                                {foreach $f_groups as $k => $v}
                                                                    <option value="{$k}" {if $k == $field_group} selected="selected" {/if}>{$v}</option>
                                                                {/foreach}
                                                            </select>
                                                            <p class="help-block">{lang('a_select_fields_group')}.</p>
                                                            <div class="group_icon help-block">
                                                                <span class="frame_label no_connection">
                                                                    <span class="niceCheck b_n">
                                                                        <input type="checkbox" value="1" name="apply_for_subcats" /> 
                                                                    </span>
                                                                    {lang('a_apply_for_subcats')}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="inputImg">{lang('a_image')}:</label>
                                                        <div class="controls">
                                                            <div>
                                                                <span class="f_l span8">
                                                                    <input type="text" disabled="disabled" name="image" id="cat_image" value="" class="textbox_long" />                                                                
                                                                </span>
                                                                <span class="btn btn-small p_r">
                                                                    <i class="icon-camera" ></i>&nbsp;&nbsp;{lang('a_select_image')}
                                                                    <input type="file" class="btn-small btn" id="inputImg" />
                                                                </span>
                                                            </div>
                                                            <p class="help-block span8">
                                                                <img src="img/temp/50X50.png" class="img-polaroid pull-right m-l_15">                                                          
                                                                A longer block of help text that breaks onto a new line and may extend beyond one line.
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName">{lang('a_position')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="position" value="0"  id="inputName" />
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label t-a_l" for="inputDescr">{lang('a_desc')}:</label>
                                                        <div class="controls c_b">
                                                            <textarea name="short_desc" id="short_desc" class="mceEditor"></textarea>
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
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label">{lang('a_sort')}:</label>
                                                        <div class="controls">
                                                            <div class="pull-left span6">
                                                                <select name="order_by">
                                                                    <option value="publish_date" selected="selected">{lang('a_by_date')}</option>    
                                                                    <option value="title">{lang('a_by_abc')}</option>    
                                                                    <option value="position">{lang('a_by_pos')}</option>    
                                                                </select>
                                                            </div>
                                                            <div class="pull-left span6">
                                                                <select name="sort_order">
                                                                    <option value="desc" selected="selected">{lang('a_desc_order')}</option> 
                                                                    <option value="asc">{lang('a_asc_order')}</option>    
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputRecCount">{lang('a_records_count')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="per_page" value="15"/> 
                                                            <div class="frame_label no_connection m-t_10">
                                                                <span class="niceCheck b_n">
                                                                    <input type="checkbox" name="comments_default" value="1" />
                                                                </span>
                                                                {lang('a_comm_by_def')}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputShowOtherCat">{lang('a_disp_pages_f_other_cats')}:</label>
                                                        <div class="controls">

                                                            <div class="o_h">
                                                                <select name="fetch_pages[]"  multiple="multiple" size="5">
                                                                    {foreach $include_cats as $c}
                                                                        <option value="{$c.id}"> {for $i=0; $i < $c.level;$i++}-{/for} {$c.name}</option>
                                                                    {/foreach}
                                                                </select>

                                                            </div>
                                                        </div></div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="inputMainTpl">{lang('a_main_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="main_tpl" value=""  id="inputMainTpl" />                                                                              </div>
                                                            <p class="help-block">{lang('a_main_tpl_by_def')}  main.tpl</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputMainTpl">{lang('a_cat_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="tpl" value="" id="inputMainTpl" /> 

                                                            </div>
                                                            <p class="help-block">{lang('a_main_cat_tpl_by_def')}  category.tpl</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputMainTpl">{lang('a_pages_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="page_tpl" value="" id="inputMainTpl" />                                                           
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
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label">
                                                            {lang('a_meta_title')}:
                                                        </label>
                                                        <div class="controls">
                                                            <input type="text" name="title" value="" id="page_title_u" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">
                                                            {lang('a_meta_description')}:
                                                        </label>
                                                        <div class="controls">
                                                            <textarea id="prev_text" class="mceEditor" name="description" rows="10" cols="180" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">
                                                            {lang('a_meta_keywords')}:
                                                        </label>
                                                        <div class="controls">
                                                            <textarea id="prev_text" class="mceEditor" name="keywords" rows="10" cols="180" ></textarea>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>   
                    {($hook = get_hook('admin_tpl_create_category')) ? eval($hook) : NULL;}
                    {form_csrf()}
                    </form>
                    <div class="tab-pane">

                    </div>
                </div>
            </div>
        </section>
    </div>

    {literal}
        <script type="text/javascript">
                                                        
                load_editor();
        </script>
    {/literal}