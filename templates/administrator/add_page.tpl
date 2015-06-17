<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang('Creating new page','admin')}</span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/pages/GetPagesByCategory" class="pjax t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','admin')}</span></a>
                <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#add_page_form" data-action="edit" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create","admin")}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#add_page_form" data-action="close"><i class="icon-check"></i>{lang("Create and exit","admin")}</button>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
            <a href="#content_article" class="btn btn-small active">{lang("Page","admin")}</a>
            <a href="#parameters_article" class="btn btn-small ">{lang("Properties","admin")}</a>
            <a href="#addfields_article" class="btn btn-small">{lang("Additional fields","admin")}</a>
            <a href="#setings_article" class="btn btn-small">{lang("Settings","admin")}</a>
            {if $moduleAdditions}
            <a href="#modules_additions" class="btn btn-small">{lang('Modules additions','admin')}</a>
            {/if}
        </div>
    </div>
    <form method="post" action="{$BASE_URL}admin/pages/add" id="add_page_form" class="form-horizontal" >
        <div class="tab-content">
            <div class="tab-pane active" id="content_article">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Page","admin")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="category_selectbox">
                                            {lang("Category","admin")}:
                                        </label>
                                        <div class="controls">
                                            <div>
                                                <select style="width:699px" name="category" class="notchosen" id="category_selectbox" onchange="pagesAdmin.loadCFAddPage()">
                                                    <option value="0" selected="selected">{lang("No","admin")}</option>
                                                    { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat'])); }
                                                </select>
                                                <a onclick="$('.addCategoryModal').modal(); return false;" class="btn m-l_10" href="#">
                                                    <i class="icon-plus-sign"></i> {lang("Create a category","admin")}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="page_title_u">
                                            {lang("Title","admin")}: <span class="must">*</span>
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="page_title" value="" id="page_title_u" required/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label">
                                            {lang("Preliminary contents","admin")}: <span class="must">*</span>
                                        </div>
                                        <div class="controls">
                                            <textarea id="prev_text" class="elRTE" required name="prev_text" rows="10" cols="180" ></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label">
                                            {lang("Full contents","admin")}:
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
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Properties","admin")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="page_url">
                                            {lang("URL","admin")}:
                                        </label>
                                        <div class="controls">
                                            <button onclick="translite_title('#page_title_u', '#page_url');" type="button" class="btn m-l_10" style="float:right;" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplete','admin')}</button>
                                            <div class="o_h">
                                                <input type="text" name="page_url" value="" id="page_url"/>
                                            </div>
                                            <div class="help-block">({lang("Only Latin characters","admin")})</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="tags">
                                            {lang("Tags","admin")}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="search_tags" value="" id="tags"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="meta_title">
                                            {lang("Meta Title","admin")}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="meta_title" id="meta_title" value=""/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_description">
                                            {lang("Meta Description","admin")}:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_description" class="textarea" id="page_description" rows="8"></textarea>
                                            <button  onclick="create_description('#prev_text', '#page_description' );" type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplete','admin')}</button>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_keywords">
                                            {lang("Meta Keywords","admin")}:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_keywords" id="page_keywords" rows="8" class="textarea" cols="28"></textarea>
                                            <button  onclick="retrive_keywords('#prev_text', '#keywords_list' );"  type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplete words','admin')}</button>
                                            <div style="max-width:600px" id="keywords_list">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="main_tpl">
                                            {lang("Main template","admin")}:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="main_tpl" id="main_tpl" value=""/>
                                            </div>
                                            <div class="help-block">{lang("by default","admin")}  main.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="full_tpl">
                                            {lang("Page Template","admin")}:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="full_tpl" id="full_tpl" value=""/>
                                            </div>
                                            <div class="help-block">{lang("by default","admin")}  page_full.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label">
                                        </div>
                                        <div class="controls">
                                            <span class="frame_label no_connection">
                                                <span class="niceCheck b_n">
                                                    <input name="comments_status"  value="1" type="checkbox" id="comments_status" />
                                                </span>
                                                {lang("Comment permission","admin")}
                                            </span>
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
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Settings","admin")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="post_status">
                                            {lang("Publication status","admin")}:
                                        </label>
                                        <div class="controls">
                                            <select name="post_status" id="post_status">
                                                <option selected="selected" value="publish">{lang("Published","admin")}</option>
                                                <option value="pending">{lang("Waiting approval ","admin")}</option>
                                                <option value="draft">{lang("Unpublished","admin")}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="create_date">
                                            {lang("Time and date of creation","admin")}:
                                        </label>
                                        <div class="controls">
                                            <span class="pull-left p_r">
                                                <label>
                                                    <input id="create_date" name="create_date" value="{$cur_date}" type="text" data-placement="top" data-original-title="{lang('choose date','admin')}" data-rel="tooltip" class="datepicker input-medium"/>
                                                    <i class="icon-calendar"></i>
                                                </label>
                                            </span>
                                            <input id="create_time" name="create_time" tabindex="8" type="text" value="{$cur_time}" class="input-small" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="publish_date">
                                            {lang("Time and date of publication","admin")}:
                                        </label>
                                        <div class="controls">
                                            <span class="pull-left p_r">
                                                <label>
                                                    <input id="publish_date" name="publish_date" tabindex="7" value="{$cur_date}" type="text" data-placement="top" data-original-title="{lang('choose date','admin')}" data-rel="tooltip" class="datepicker input-medium"/>
                                                    <i class="icon-calendar"></i>
                                                </label>
                                            </span>
                                            <input name="publish_time" tabindex="8" type="text" value="{$cur_time}" class="input-small" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="roles">
                                            {lang("Access","admin")}:
                                        </label>
                                        <div class="controls">
                                            <select multiple="multiple" name="roles[]" id="roles">
                                                <option value="0">{lang("All","admin")}</option>
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
            {include_tpl('modules_additions')}
        </div>
        {form_csrf()}
    </form>
</section>

<div class="modal addCategoryModal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>{lang("Create a category","admin")}</h3>
    </div>
    <div class="modal-body">

        <form action="/admin/categories/fast_add/create" method="post" id="fast_add_form" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">
                    {lang("Name","admin")}
                </label>
                <div class="controls">
                    <input type="text" name="name" value="" class="required">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">
                    {lang("Parent","admin")}
                </label>
                <div class="controls">
                    <select name="parent_id">
                        <option value="0" selected="selected">{lang("No","admin")}</option>
                        { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat'])); }
                    </select>
                </div>
            </div>
        </form>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
        <a href="#" class="btn btn-primary" onclick="pagesAdmin.quickAddCategory()">{lang('Create','admin')}</a>
    </div>
</div>

<script>
if (window.hasOwnProperty('pagesAdmin'))
    pagesAdmin.initialize();
</script>