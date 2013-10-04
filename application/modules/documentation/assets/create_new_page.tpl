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
                {if $_POST['NewPage']['category'] != null}{$sel_cat = $_POST['NewPage']['category']}{else:}{$sel_cat = $mainPage['category']}{/if}
                {$this->view("cats_select_create.tpl", array('tree' => $tree,'sel_cat' => $sel_cat));}
            </select>
        </div>
        <!-- End. Select with categories names and ids-->
        <!-- Start. Name input -->
        <h4>{lang('Name','documentation')}:</h4>
        <div class="group">
            <input type="text" name="NewPage[title]" value="{echo set_value('NewPage[title]')}" class="form-control" placeholder="{lang('Title','documentation')}">
        </div>
        <!-- End. Name input-->
        <!-- Start. Url input-->
        <h4>{lang('Url','documentation')}:</h4>
        <div class="group">
            <input {if $params != null}readonly="readonly"{/if} 
                    type="text" 
                    name="NewPage[url]" 
                    value="{if set_value('NewPage[url]') != null}{echo set_value('NewPage[url]')}{else:}{echo $mainPage['url']}{/if}" 
                    class="form-control" 
                    placeholder="{lang('Url','documentation')}">
        </div>
        <!-- End. Url input -->
        
        <!-- Start. Keywords and description -->
        <h4>{lang('Keywords','documentation')}:</h4>
        <textarea name="NewPage[keywords]" class="form-control verticalResize" rows="3">{set_value('NewPage[keywords]')}</textarea>
        <h4>{lang('Description','documentation')}:</h4>
        <textarea name="NewPage[description]" class="form-control verticalResize" rows="3">{echo set_value('NewPage[description]')}</textarea>
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
