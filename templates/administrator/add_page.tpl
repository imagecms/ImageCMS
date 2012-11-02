<section class="mini-layout">

    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">Создание новой страницы</span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/pages/GetPagesByCategory" class="pjax t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#add_page_form" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#add_page_form" data-action="close"><i class="icon-check"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>  

    <div class="clearfix">
        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
            <a href="#content_article" class="btn btn-small active">{lang('a_content')}</a>
            <a href="#parameters_article" class="btn btn-small ">{lang('a_param')}</a>
            <a href="#addfields_article" class="btn btn-small">{lang('a_additional_fields')}</a>
            <a href="#setings_article" class="btn btn-small">{lang('a_sett')}</a>
        </div>
    </div>             
    <form method="post" action="{$BASE_URL}admin/pages/add" id="add_page_form" class="form-horizontal" >
        <div class="tab-content content_big_td">
            <div class="tab-pane active" id="content_article">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                Содержание
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="category_selectbox">
                                            {lang('a_category')}:
                                        </label>
                                        <div class="controls">
                                            <a onclick="$('.modal').modal(); return false;" class="btn btn-success btn-small pull-right" href="#"><i class="icon-plus icon-white"></i> {lang('a_create_cat')}</a>
                                            <div class="o_h">
                                                <select name="category" id="category_selectbox" onchange="pagesAdmin.loadCFAddPage()"> 
                                                    <option value="0" selected="selected">{lang('a_no')}</option>
                                                    { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat'])); }
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="page_title_u">
                                            {lang('a_title')}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="page_title" value="" id="page_title_u" class="textbox_long required" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label">
                                            {lang('a_prev_cont')}:
                                        </div>
                                        <div class="controls">
                                            <textarea id="prev_text" class="elRTE required" name="prev_text" rows="10" cols="180" ></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label">
                                            {lang('a_full_cont')}:
                                        </div>
                                        <div class="controls">
                                            <textarea id="full_text" class="elRTE" name="full_text" rows="10" cols="180" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="parameters_article">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('a_param')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="page_url">
                                            {lang('a_url')}:
                                        </label>
                                        <div class="controls">
                                            <button onclick="translite_title('#page_title_u', '#page_url');" type="button" class="btn btn-small pull-right" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор</button>
                                            <div class="o_h">
                                                <input type="text" name="page_url" value="" id="page_url"/>
                                            </div>
                                            <div class="help-block">({lang('a_just_lat')})</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="tags">
                                            {lang('a_tags')}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="search_tags" value="" id="tags"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="meta_title">
                                            {lang('a_meta_title')}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="meta_title" id="meta_title" value=""/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_description">
                                            {lang('a_meta_description')}:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_description" class="textarea" id="page_description" rows="8"></textarea>
                                            <button  onclick="create_description('#prev_text', '#page_description' );" type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор</button>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_keywords">
                                            {lang('a_meta_keywords')}:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_keywords" id="page_keywords" rows="8" class="textarea" cols="28"></textarea>
                                            <button  onclick="retrive_keywords('#prev_text', '#keywords_list' );"  type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор слов</button>
                                            <div style="max-width:600px" id="keywords_list">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="main_tpl">
                                            {lang('a_main_tpl')}:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="main_tpl" id="main_tpl" value=""/>
                                            </div>
                                            <div class="help-block">{lang('a_by_default')}  main.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="full_tpl">
                                            {lang('a_page_tpl')}:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="full_tpl" id="full_tpl" value=""/> 
                                            </div>
                                            <div class="help-block">{lang('a_by_default')}  page_full.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="comments_status">
                                            {lang('a_comm_alow')}
                                        </label>
                                        <div class="controls">
                                            <input name="comments_status"  value="1" checked="checked" type="checkbox" id="comments_status" />                        	
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="addfields_article">
                <div id="cfcm_fields_block"></div>
            </div>

            <div class="tab-pane" id="setings_article">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('a_sett')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="post_status">
                                            {lang('a_pub_stat')}:
                                        </label>
                                        <div class="controls">
                                            <select name="post_status" id="post_status">
                                                <option selected="selected" value="publish">{lang('a_published')}</option>
                                                <option value="pending">{lang('a_wait_approve')}</option>
                                                <option value="draft">{lang('a_not_publ')}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="control-group">
                                        <label class="control-label" for="create_date">
                                            {lang('a_date_and_time_cr')}:    
                                        </label>
                                        <div class="controls">
                                            <span class="pull-left p_r">
                                                <input id="create_date" name="create_date" id="create_date" value="{$cur_date}" type="text" data-placement="top" data-original-title="выберите дату" data-rel="tooltip" class="datepicker input-small"/>
                                                <i class="icon-calendar"></i>
                                            </span>
                                            <input id="create_time" name="create_time" tabindex="8" type="text" value="{$cur_time}" class="input-small" />			             	
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('a_date_and_time_p')}:                 
                                        </label>
                                        <div class="controls">
                                            <span class="pull-left p_r">
                                                <input id="publish_date" name="publish_date" tabindex="7" value="{$cur_date}" type="text" data-placement="top" data-original-title="выберите дату" data-rel="tooltip" class="datepicker input-small" />
                                                <i class="icon-calendar"></i>
                                            </span>
                                            <input id="publish_time" name="publish_time" tabindex="8" type="text" value="{$cur_time}" class="input-small" />            	
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="roles">
                                            {lang('a_access')}:             
                                        </label>
                                        <div class="controls">
                                            <select multiple="multiple" name="roles[]" id="roles">
                                                <option value="0">{lang('a_all')}</option>
                                                {foreach $roles as $role}
                                                <option value ="{$role.id}">{$role.alt_name}</option>
                                                {/foreach}
                                            </select>        	
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {form_csrf()}
    </form>
</section>

<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>{lang('a_create_cat')}</h3>
    </div>
    <div class="modal-body">

        <form action="/admin/categories/fast_add/create" method="post" id="fast_add_form" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">
                    {lang('a_name')}
                </label>
                <div class="controls">
                    <input type="text" name="name" value="" class="required">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">
                    {lang('a_parent')}
                </label>
                <div class="controls">
                    <select name="parent_id">
                        <option value="0" selected="selected">{lang('a_no')}</option>
                        { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat'])); }
                    </select>
                </div>
            </div>
        </form>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
        <a href="#" class="btn btn-primary" onclick="pagesAdmin.quickAddCategory()">Создать</a>
    </div>
</div>

<script>
    if (window.hasOwnProperty('pagesAdmin'))
        pagesAdmin.initialize();
</script>