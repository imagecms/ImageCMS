<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Category editing", 'gallery')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <button type="button" class="btn btn-small formSubmit btn-primary is-reload" data-form="#create_category_form" data-action="edit" data-submit><i class="icon-ok"></i>{lang("Save", 'gallery')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#create_category_form" data-action="close"><i class="icon-check"></i>{lang("Save and exit", 'gallery')}</button>
                    {echo create_language_select($languages, $locale, "/admin/components/cp/gallery/edit_category/" . $category.id)}
            </div>
        </div>
    </div>
    <table class="table table-bordered content_big_td">
        <tbody>
            <tr>
                <td style="border-top: 0;">
                    <div class="form-horizontal row-fluid">
                        <form method="post" action="{site_url('admin/components/cp/gallery/update_category/' . $category.id . '/' . $locale)}" id="create_category_form">
                            <div class="control-group">
                                <label class="control-label" for="name">{lang("Name", 'gallery')}: <span class="must">*</span></label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" value="{$category.name}" class="required"/>
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
                                    <input type="text" name="position" id="position" value="{$category.position}" class="textbox_long" />
                                </div>
                            </div>
                            {form_csrf()}
                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
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