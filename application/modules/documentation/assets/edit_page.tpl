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

                <div id="gideAfterCreatingCategory">
                    <form role="form" id="create_cat" action="/documentation/create_cat" method="POST">
                        <div class="form-group">
                            <label for="name">{lang("Name","documentation")}:</label>
                            <input type="text" class="form-control" id="name" name="name" required="required" placeholder="{lang("Name","documentation")}">
                        </div>

                        <div class="form-group">
                            <label for="url">{lang("URL","documentation")}:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="url" name="url" required="required" placeholder="{lang("URL","documentation")}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="translite_title('#name', '#url');">{lang("AutoFit","documentation")}</button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parent_id">{lang('Parent category','admin')}:</label>
                            <select name="category" class="form-control">
                                <option value="0" selected="selected">{lang("No","admin")}</option>
                                {$this->view("cats_select_edit.tpl", array('tree' => $tree,'sel_cat' => $page['category']));}
                            </select>
                        </div>
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
        <h1 style="display: inline-block;">{lang('Edit page','documentation')}</h1>
        <div class="langSwitcher pull-right">
            <label class="col-lg-4 control-label m-t_10">{lang('Language','documentation')}:</label>
            <div class="col-lg-8">
                <select name="NewPage[lang]" class="form-control" id="changeLangSelect">
                    {foreach $langs as $lang}
                        <option data-page_id="{if $page['lang_alias'] != 0}{echo $page['lang_alias']}{else:}{echo $page['id']}{/if}" 
                                value="{echo $lang['id']}" 
                        {if $page['lang']== $lang['id']}selected="selected"{/if}>
                        {echo $lang['identif']}
                    </option>
                {/foreach}
            </select>
        </div>
    </div>
</div>
</div>
{if $errors}
    <div class="alert alert-block alert-danger fade in">
        {echo $errors}
    </div>
{/if}
<form method="post" action="/documentation/edit_page/{echo $page['id']}{echo $params}">
    <!-- Start. Select with categories names and ids-->
    <h4>{lang('Category','documentation')}:</h4>
    <div class="input-group">
        <select name="NewPage[category]" class="form-control" {if $page['lang_alias'] != 0}readonly="readonly" style="pointer-events: none; cursor: default;"{/if}>
            {$this->view("cats_select_edit.tpl", array('tree' => $tree,'sel_cat' => $page['category']));}
        </select>
        <div class="input-group-btn">
            <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-small">{lang('Create category ','documentation')}</a>
        </div>
    </div>
    <!-- End. Select with categories names and ids-->
    <!-- Start. Name input -->
    <h4>{lang('Name','documentation')}:</h4>
    <div class="group">
        <input type="text" name="NewPage[title]" value="{echo $page['title']}" class="form-control" placeholder="{lang('Title','documentation')}">
    </div>
    <!-- End. Name input-->
    <!-- Start. Url input-->
    <h4>{lang('Url','documentation')}:</h4>
    <div class="group">
        <input {if $page['lang_alias'] != 0}readonly="readonly"{/if} 
                                            type="text" 
                                            name="NewPage[url]" 
                                            value="{echo $page['url']}" 
                                            class="form-control" 
                                            placeholder="{lang('Url','documentation')}">
    </div>
    <!-- End. Url input -->

    <!-- Start. Keywords and description -->
    <h4>{lang('Keywords','documentation')}:</h4>
    <textarea name="NewPage[keywords]" class="form-control verticalResize" rows="3">{if set_value('NewPage[keywords]')}{echo set_value('NewPage[keywords]')}{else:}{echo $page['keywords']}{/if}</textarea>
    <h4>{lang('Description','documentation')}:</h4>
    <textarea name="NewPage[description]" class="form-control verticalResize" rows="3">{if set_value('NewPage[description]')}{echo set_value('NewPage[description]')}{else:}{echo $page['description']}{/if}</textarea>
    <!-- End. Keywords and description -->

    <!-- Start. Textarea with content-->
    <h4>{lang('Content','documentation')}:</h4>
    <textarea class="TinyMCEForm" name="NewPage[prev_text]">
        {echo $page['prev_text']}
    </textarea>
    <!-- End. Textarea with content-->
    <!-- Start. Submit button-->
    <div class="buttonSave">
        <button type="submit" class="btn btn-info pull-right">
            {lang('Save','documentation')}
        </button>
    </div>
    <!-- End. Submit button -->
    {form_csrf()}
</form>
</div>
