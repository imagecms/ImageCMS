<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{lang('Create category','documentation')}</h4>
            </div>
            <div class="modal-body">
                <!-- Start. Modal validation errors block -->
                <div class="alert alert-block alert-danger fade in modalErrosBlock" style="display: none;"></div>
                <!-- End. Modal validation errors block -->

                <!-- Start. Modal category created succes block -->
                <div class="alert alert-block alert-success fade in modalCategoryCreatedSuccesBlock" style="display: none;">
                    {lang("Category created success","documentation")}
                </div>
                <!-- End. Modal category created succes block -->

                <div id="hideAfterCreatingCategory">
                    <form role="form" id="create_cat" action="/documentation/create_cat" method="POST">
                        <div class="form-group">
                            <label for="name">{lang("Name","documentation")}:</label>
                            <input type="text" class="form-control" maxlength="256" id="name" name="name" placeholder="{lang("Name","documentation")}">
                        </div>
                        <div class="form-group">
                            <label for="url">{lang("URL","documentation")}:</label>
                            <input type="text" class="form-control" id="url" maxlength="256" name="url" placeholder="{lang("URL","documentation")}">
                        </div>
                        <button class="btn btn-xs pull-right"
                                onclick="$('.togle_fade_modal').fadeToggle();
                                        return false;">{lang("META","documentation")}</button>
                        <div class="togle_fade_modal" style="display: none">

                            <div class="form-group">
                                <label for="meta_title">{lang("Meta Title","documentation")}:</label>
                                <input type="text" 
                                       value="" 
                                       class="form-control" 
                                       maxlength="256" 
                                       name="meta_title" 
                                       placeholder="{lang("Meta Title","documentation")}"/>
                            </div>
                            <div class="form-group">
                                <label for="keywords">{lang("Keywords","documentation")}:</label>
                                <input type="text" 
                                       value="" 
                                       class="form-control" 
                                       maxlength="256" 
                                       name="keywords" 
                                       placeholder="{lang("keywords","documentation")}"/>
                            </div>
                            <div class="form-group">
                                <label for="description">{lang("Description","documentation")}:</label>
                                <input type="text" 
                                       value="" 
                                       class="form-control" 
                                       maxlength="256" 
                                       name="description"  
                                       placeholder="{lang("description","documentation")}"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="parent_id">{lang('Parent category','documentation')}:</label>
                            <select name="category" class="form-control">
                                <option value="0" selected="selected">{lang("No","documentation")}</option>
                                {$this->view("cats_select_edit.tpl", array('tree' => $tree,'sel_cat' => $page['category']));}
                            </select>
                        </div>
                        {form_csrf()}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" onclick="createCategory()">{lang("Save changes","documentation")}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="container">
    <div class="page-header">
        <h1>{lang('Create new page','documentation')}</h1>
    </div>
    {if $errors}
        <div class="alert alert-block alert-danger fade in">
            {echo $errors}
        </div>
    {/if}
    <form method="post" action="/documentation/create_new_page{echo $params}">
        <!-- Start. Select with categories names and ids-->
        <h4>{lang('Category','documentation')}:</h4>
        <div class="input-group">
            <select name="NewPage[category]" class="form-control" {if $params != null}readonly="readonly"  style="pointer-events: none; cursor: default;"{/if}>
                {if $_POST['NewPage']['category'] != null}
                    {$sel_cat = $_POST['NewPage']['category']}
                {else:}
                    {$sel_cat = $mainPage['category']}
                {/if}
                {$this->view("cats_select_create.tpl", array('tree' => $tree,'sel_cat' => $sel_cat));}
            </select>
            <div class="input-group-btn">
                <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-small">{lang('Create category ','documentation')}</a>
            </div>
        </div>
        <!-- End. Select with categories names and ids-->
        <!-- Start. Name input -->
        <h4>{lang('Name','documentation')}:</h4>
        <div class="group">
            <input type="text" name="NewPage[title]" maxlength="254" value="{echo set_value('NewPage[title]')}" class="form-control" placeholder="{lang('Title','documentation')}">
        </div>
        <!-- End. Name input-->
        <!-- Start. Url input-->
        <h4>{lang('Url','documentation')}:</h4>
        <div class="group">
            <input {if $params != null}readonly="readonly"{/if} 
                                       type="text" 
                                       name="NewPage[url]" 
                                       maxlength="254"
                                       value="{if set_value('NewPage[url]') != null}{echo set_value('NewPage[url]')}{else:}{echo $mainPage['url']}{/if}" 
                                       class="form-control" 
                                       placeholder="{lang('Url','documentation')}"/>
        </div>
        <!-- End. Url input -->

        <!-- Start. Keywords and description -->
        <button class="btn btn-xs pull-right"
                onclick="$('.togle_fade').fadeToggle();
                        return false;">{lang("META","documentation")}</button>
        <div class="togle_fade" style="display: none">
            <h4>{lang('Meta Title','documentation')}:</h4>
            <input name="NewPage[meta_title]" class="form-control">{set_value('NewPage[meta_title]')}</input>
            <h4>{lang('Keywords','documentation')}:</h4>
            <textarea name="NewPage[keywords]" class="form-control verticalResize" rows="3">{set_value('NewPage[keywords]')}</textarea>
            <h4>{lang('Description','documentation')}:</h4>
            <textarea name="NewPage[description]" class="form-control verticalResize" rows="3">{echo set_value('NewPage[description]')}</textarea>
        </div>
        <!-- End. Keywords and description -->

        <!-- Start. Textarea with content-->
        <h4>{lang('Content','documentation')}:</h4>
        <textarea class="TinyMCEForm" name="NewPage[prev_text]">
            {echo set_value('NewPage[prev_text]')}
        </textarea>
        <!-- End. Textarea with content-->
        <!-- Start. Submit button-->
        <div class="buttonSave">
            <button type="submit" class="btn btn-success pull-right">
                {lang('Save','documentation')}
            </button>
        </div>
        <!-- End. Submit button -->
        {form_csrf()}
    </form>
</div>
