<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Create a category", 'gallery')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'gallery')}</span></a>
                <button type="button" class="btn btn-small action_on formSubmit btn-success" data-form="#create_category_form" data-action="edit" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create", 'gallery')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#create_category_form" data-action="close"><i class="icon-check"></i>{lang("Create and exit", 'gallery')}</button>
            </div>
        </div>
    </div>
    <div class="inside_padd">
        <div class="form-horizontal row-fluid">
            <div class="span9">
                <form method="post" action="{site_url('admin/components/cp/gallery/create_category')}" id="create_category_form">
                    <div class="control-group">
                        <label class="control-label" for="name">{lang("Name", 'gallery')}:</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" value="" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="g_c_desc">{lang("Description", 'gallery')}:</label>
                        <div class="controls">
                            <textarea name="description" id="g_c_desc" class="smallTextarea elRTE">{htmlspecialchars($category.description)}</textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="position">{lang("Position", 'gallery')}:</label>
                        <div class="controls number">
                            <input type="text" name="position" id="position" value=""/>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Removing categories', 'gallery')}</h3>
    </div>
    <div class="modal-body">
        <p>{lang('Remove selected category', 'gallery')}?</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel", 'gallery')}</a>
        <a href="#" class="btn btn-primary" onclick="GalleryCategories.deleteCategoriesConfirm()" >{lang("Delete", 'gallery')}</a>
    </div>
</div>