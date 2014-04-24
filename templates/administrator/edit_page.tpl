<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang('Edit page', "admin")}</span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/pages/GetPagesByCategory" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back","admin")}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-action="edit" data-form="#edit_page_form" data-submit><i class="icon-ok icon-white"></i>{lang("Save","admin")}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#edit_page_form"><i class="icon-check"></i>{lang("Save and go back","admin")}</button>
                {if count($langs) > 1}
                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                        {foreach $langs as $l}
                            {if $page_lang == $l.id}
                                {$l.lang_name}
                            {/if}
                        {/foreach}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        {foreach $langs as $l}
                            {if $l.id != $page_lang}
                                <li>
                                    <a href="/admin/pages/edit/{$page_id}/{$l.id}" class="pjax">{$l.lang_name}</a>
                                </li>
                            {/if}
                        {/foreach}
                    </ul>
                </div>
                {/if}
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="m-t_20 pull-right">
            {if $CI->uri->total_segments()==5}
                <a href="/{echo $l.identif}/{$cat_url}{$url}" class="t-d_n m-r_15" target="blank">{lang('Show page','admin')} <span class="f-s_14">&rarr;</span></a>
            {else:}
                <a href="/{$cat_url}{$url}" class="t-d_n m-r_15" target="blank">{lang('Show page','admin')} <span class="f-s_14">&rarr;</span></a>
            {/if}
        </div>
        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
            <a href="#content_article" class="btn btn-small active">{lang("Page","admin")}</a>
            <a href="#parameters_article" class="btn btn-small ">{lang("Properties","admin")}</a>
            <a href="#addfields_article" class="btn btn-small">{lang("Additional fields","admin")}</a>
            <a href="#setings_article" class="btn btn-small">{lang("Settings","admin")}</a>
            {if $moduleAdditions}
                <a href="#modules_additions" class="btn btn-small">{lang('Modules additions', 'admin')}</a>
            {/if}
        </div>
    </div>
    <form method="post" action="{$BASE_URL}admin/pages/update/{$update_page_id}/{$page_lang}" id="edit_page_form" class="form-horizontal" data-pageid="{$update_page_id}">
        <div class="tab-content content_big_td">

            <div class="tab-pane active" id="content_article">


                <table class="table table-striped table-bordered table-hover table-condensed t-l_a">

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
                                            <a onclick="$('.modal').modal();
                                                    return false;" class="btn btn-success btn-small pull-right" href="#"><i class="icon-plus icon-white"></i> {lang("Create a category","admin")}</a>
                                            <div class="o_h">
                                                <select name="category"  id="category_selectbox"  onchange="pagesAdmin.loadCFEditPage()">
                                                    <option value="0" >{lang('No','admin')}</option>
                                                    {$this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['parent_id']));}
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label" for="page_title_u">
                                            {lang("Title","admin")}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="page_title" value="{encode($title)}" id="page_title_u" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang("Preliminary contents","admin")}:
                                        </label>
                                        <div class="controls">
                                            <textarea id="prev_text" class="elRTE" name="prev_text" rows="10" cols="180" >{encode($prev_text)}</textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang("Full contents","admin")}:
                                        </label>
                                        <div class="controls">
                                            <textarea id="full_text" class="elRTE" name="full_text" rows="10" cols="180" >{encode($full_text)}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="parameters_article">



                <table class="table table-striped table-bordered table-hover table-condensed t-l_a">

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

                                <div class="inside_padd span9">
                                    <div class="control-group">
                                        <label class="control-label" for="page_url">
                                            {lang("URL","admin")}:
                                        </label>
                                        <div class="controls">
                                            {if $defLang.id == $page_lang}
                                                <button onclick="translite_title('#page_title_u', '#page_url');" type="button" class="btn btn-small pull-right" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplete','admin')}</button>
                                                <div class="o_h">
                                                    <input type="text" name="page_url" value="{$url}" id="page_url" />
                                                </div>
                                            {else:}
                                                <input type="text" name="page_url" value="{$url}" id="page_url" />
                                            {/if}
                                            <div class="help-block">({lang("Only Latin characters","admin")})</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="tags">
                                            {lang("Tags","admin")}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="search_tags" value="{foreach $tags as $tag}{$tag.value},{/foreach}" id="tags" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="meta_title">
                                            {lang("Meta Title","admin")}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="meta_title" id="meta_title" value="{$meta_title}"  />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_description">
                                            {lang("Meta Description","admin")}:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_description" class="textarea" id="page_description" >{$description}</textarea>
                                            <button  onclick="create_description('#prev_text', '#page_description' );" type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplete','admin')}</button>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_keywords">
                                            {lang("Meta Keywords","admin")}:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_keywords" id="page_keywords">{$keywords}</textarea>
                                            <button  onclick="retrive_keywords('#prev_text', '#keywords_list' );"  type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplete words','admin')}</button>
                                            <div id="keywords_list">
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
                                                <input type="text" name="main_tpl" id="main_tpl" value="{$main_tpl}" />
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
                                                <input type="text" name="full_tpl" id="full_tpl" value="{$full_tpl}" />
                                            </div>
                                            <div class="help-block">{lang("by default","admin")}  page_full.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label"></div>
                                        <div class="controls">
                                            <span class="frame_label no_connection">
                                                <span class="niceCheck b_n">
                                                    <input name="comments_status"  value="1" {if $comments_status == 1} checked="checked" {/if}  type="checkbox" id="comments_status" />
                                                </span>
                                            </span>
                                            {lang("Comment permission","admin")}
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

                <table class="table table-striped table-bordered table-hover table-condensed t-l_a">

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
                                <div class="inside_padd span9">
                                    <div class="control-group">
                                        <label class="control-label" for="post_status">
                                            {lang("Publication status","admin")}:
                                        </label>
                                        <div class="controls">
                                            <select name="post_status" id="post_status">
                                                <option value="publish" {if $post_status == "publish"} selected="selected" {/if} >{lang("Published","admin")}</option>
                                                <option value="pending" {if $post_status == "pending"} selected="selected" {/if} >{lang("Waiting approval ","admin")}</option>
                                                <option value="draft" {if $post_status == "draft"} selected="selected" {/if} >{lang("Unpublished","admin")}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label" for="create_date">
                                            {lang("Time and date of creation","admin")}:    
                                        </label>
                                        <div class="controls">
                                            <div class="pull-left p_r">
                                                <input id="create_date" name="create_date" tabindex="7" value="{$create_date}" type="text" data-placement="top" data-original-title="{lang('choose date','admin')}" data-rel="tooltip" class="datepicker input-small"  />
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <input id="create_time" name="create_time" tabindex="8" type="text" value="{$create_time}" class="input-small" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="publish_date">
                                            {lang("Time and date of publication","admin")}:                 
                                        </label>
                                        <div class="controls">
                                            <div class="pull-left p_r">
                                                <input id="publish_date" name="publish_date" tabindex="7" value="{$publish_date}" type="text" data-placement="top" data-original-title="{lang('choose date','admin')}" data-rel="tooltip" class="datepicker input-small" />
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <input id="publish_time" name="publish_time" tabindex="8" type="text" value="{$publish_time}" class="input-small" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="roles[]">
                                            {lang("Access","admin")}:             
                                        </label>
                                        <div class="controls">
                                            <select multiple="multiple" name="roles[]" id="roles[]">
                                                <option value="0" {$all_selected} >{lang("All","admin")}</option>
                                                {foreach $roles as $role}
                                                    <option {$role.selected} value="{$role.id}">{$role.alt_name}</option>
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



<div class="modal hide fade">
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