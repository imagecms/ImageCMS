<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang("Edit page")}</span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/pages/GetPagesByCategory" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back")}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-action="edit" data-form="#edit_page_form" data-submit><i class="icon-ok icon-white"></i>{lang("Have been saved")}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#edit_page_form"><i class="icon-check"></i>{lang("Save and go back")}</button>
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
                        <li><a href="/admin/pages/edit/{$page_id}/{$l.id}" class="pjax">{$l.lang_name}</a></li>
                        {/if}
                        {/foreach}
                    </ul>
                </div>
            </div>
        </div>                            
    </div>  

    <div class="clearfix">
        <div class="m-t_20 pull-right">
            <a href="/{$cat_url}{$url}" class="t-d_n m-r_15" target="blank">{lang('a_show_page')} <span class="f-s_14">&rarr;</span></a>
        </div>
        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
            <a href="#content_article" class="btn btn-small active">{lang("Content")}</a>
            <a href="#parameters_article" class="btn btn-small ">{lang("Properties")}</a>
            <a href="#addfields_article" class="btn btn-small">{lang("Additional fields")}</a>
            <a href="#setings_article" class="btn btn-small">{lang("Settings")}</a>
        </div>
    </div>             
    <form method="post" action="{$BASE_URL}admin/pages/update/{$update_page_id}/{$page_lang}" id="edit_page_form" class="form-horizontal" data-pageid="{$update_page_id}">
        <div class="tab-content content_big_td">

            <div class="tab-pane active" id="content_article">


                <table class="table table-striped table-bordered table-hover table-condensed">

                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Content")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="category_selectbox">
                                            {lang("Categories")}:
                                        </label>
                                        <div class="controls">
                                            <a onclick="$('.modal').modal(); return false;" class="btn btn-success btn-small pull-right" href="#"><i class="icon-plus icon-white"></i> {lang("Create a category")}</a>
                                            <div class="o_h">
                                                <select name="category"  id="category_selectbox"  onchange="pagesAdmin.loadCFEditPage()">
                                                    <option value="0" >{lang("No")}</option>
                                                    { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['parent_id'])); }
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label" for="page_title_u">
                                            {lang("Title")}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="page_title" value="{encode($title)}" id="page_title_u" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang("Preliminary contents")}:
                                        </label>
                                        <div class="controls">
                                            <textarea id="prev_text" class="elRTE" name="prev_text" rows="10" cols="180" >{encode($prev_text)}</textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang("Full contents")}:
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



                <table class="table table-striped table-bordered table-hover table-condensed">

                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Properties")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">

                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="page_url">
                                            {lang("URL")}:
                                        </label>
                                        <div class="controls">
                                            {if $defLang.id == $page_lang}
                                            <button onclick="translite_title('#page_title_u', '#page_url');" type="button" class="btn btn-small pull-right" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplite')}</button>
                                            <div class="o_h">
                                                <input type="text" name="page_url" value="{$url}" id="page_url" />
                                            </div>
                                            {else:}
                                            <input type="text" name="page_url" value="{$url}" id="page_url" disabled="disabled" />
                                            {/if}
                                            <div class="help-block">({lang("Only Latin characters")})</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="tags">
                                            {lang("Tags")}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="search_tags" value="{foreach $tags as $tag}{$tag.value},{/foreach}" id="tags" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="meta_title">
                                            {lang("Meta Title")}:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="meta_title" id="meta_title" value="{$meta_title}"  />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_description">
                                            {lang("Meta Description")}:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_description" class="textarea" id="page_description" >{$description}</textarea>
                                            <button  onclick="create_description('#prev_text', '#page_description' );" type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplite')}</button>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_keywords">
                                            {lang("Meta Keywords")}:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_keywords" id="page_keywords">{$keywords}</textarea>
                                            <button  onclick="retrive_keywords('#prev_text', '#keywords_list' );"  type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('Autocomplite words')}</button>
                                            <div id="keywords_list">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="main_tpl">
                                            {lang("Main template")}:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="main_tpl" id="main_tpl" value="{$main_tpl}" />
                                            </div>
                                            <div class="help-block">{lang("by default")}  main.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="full_tpl">
                                            {lang("Page Template")}:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="full_tpl" id="full_tpl" value="{$full_tpl}" />
                                            </div>
                                            <div class="help-block">{lang("by default")}  page_full.tpl</div>
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
                                            {lang("Comment permission")}
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
                                {lang("Settings")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="post_status">
                                            {lang("Publication status")}:
                                        </label>
                                        <div class="controls">
                                            <select name="post_status" id="post_status">
                                                <option value="publish" {if $post_status == "publish"} selected="selected" {/if} >{lang("Published or Has been published")}</option>
                                                <option value="pending" {if $post_status == "pending"} selected="selected" {/if} >{lang("Pending approval or Awaiting approval ")}</option>
                                                <option value="draft" {if $post_status == "draft"} selected="selected" {/if} >{lang("Has not been published")}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label" for="create_date">
                                            {lang("Time and date of creation")}:    
                                        </label>
                                        <div class="controls">
                                            <div class="pull-left p_r">
                                                <input id="create_date" name="create_date" tabindex="7" value="{$create_date}" type="text" data-placement="top" data-original-title="{lang('choose date')}" data-rel="tooltip" class="datepicker input-small"  />
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <input id="create_time" name="create_time" tabindex="8" type="text" value="{$create_time}" class="input-small" />			             	
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="publish_date">
                                            {lang("Time and date of publication")}:                 
                                        </label>
                                        <div class="controls">
                                            <div class="pull-left p_r">
                                                <input id="publish_date" name="publish_date" tabindex="7" value="{$publish_date}" type="text" data-placement="top" data-original-title="{lang('choose date')}" data-rel="tooltip" class="datepicker input-small" />
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <input id="publish_time" name="publish_time" tabindex="8" type="text" value="{$publish_time}" class="input-small" />            	
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="roles[]">
                                            {lang("Access")}:             
                                        </label>
                                        <div class="controls">
                                            <select multiple="multiple" name="roles[]" id="roles[]">
                                                <option value="0" {$all_selected} >{lang("All")}</option>
                                                {foreach $roles as $role}
                                                <option {$role.selected} value="{$role.id}">{$role.name}</option>
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
        <h3>{lang("Create a category")}</h3>
    </div>
    <div class="modal-body">

        <form action="/admin/categories/fast_add/create" method="post" id="fast_add_form" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">
                    {lang("Name")}
                </label>
                <div class="controls">
                    <input type="text" name="name" value="" class="required">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">
                    {lang("Parent")}
                </label>
                <div class="controls">
                    <select name="parent_id">
                        <option value="0" selected="selected">{lang("No")}</option>
                        { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat'])); }
                    </select>
                </div>
            </div>
        </form>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel')}</a>
        <a href="#" class="btn btn-primary" onclick="pagesAdmin.quickAddCategory()">{lang('Create')}</a>
    </div>
</div>
<script>
    if (window.hasOwnProperty('pagesAdmin'))
        pagesAdmin.initialize();
</script>