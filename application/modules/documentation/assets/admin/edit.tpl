<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Edit content', 'admin')}</span>
        </div>
    </div>
    <div class="row-fluid">
        {if $errors}
            <div class="alert alert-block alert-danger fade in">
                {echo $errors}
            </div>
        {/if}
        <form method="post" action="/documentation/edit_page/{echo $pageId}">
            <!-- Start. Select with categories names and ids-->
            <h4>{lang('Category','documentation')}:</h4>
            <div class="input-group">
                <select name="NewPage[category]" class="form-control">
                    {$categoriesTree}
                </select>
            </div>

            <!-- End. Select with categories names and ids-->
            <!-- Start. Name input -->
            <h4>{lang('Name','documentation')}:</h4>
            <div class="input-group">
                <input type="text" name="NewPage[title]" value="{echo $page['title']}" class="form-control" placeholder="{lang('Title','documentation')}">
            </div>
            <!-- End. Name input-->
            <!-- Start. Url input-->
            <h4>{lang('Url','documentation')}:</h4>
            <div class="input-group">
                <input type="text" name="NewPage[url]" value="{echo $page['url']}" class="form-control" placeholder="{lang('Url','documentation')}">
            </div>
            <!-- End. Url input -->
            <!-- Start. Textarea with content-->
            <h4>{lang('Content','documentation')}:</h4>
            <textarea class="TinyMCEForm" name="NewPage[prev_text]">{echo $page['prev_text']}</textarea>
            <!-- End. Textarea with content-->
            <!-- Start. Submit button-->
            <div class="buttonSave">
                <button type="submit" class="btn btn-info">
                    {lang('Save','documentation')}
                </button>
            </div>
            <!-- End. Submit button -->
            {form_csrf()}
        </form>
    </div>
</section>