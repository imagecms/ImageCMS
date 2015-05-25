<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Album editing", 'gallery')}: {$album.name}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery/category/{$album['category_id']}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <button type="button" class="btn btn-small formSubmit btn-primary" data-form="#create_album_form" data-action="edit" data-submit><i class="icon-ok"></i>{lang("Save", 'gallery')}</button> 
                <button type="button" class="btn btn-small formSubmit" data-form="#create_album_form" data-action="close"><i class="icon-check"></i>{lang("Save and go back", 'admin')}</button>
                    {echo create_language_select($languages, $locale, "/admin/components/cp/gallery/edit_album_params/" . $album.id)}
            </div>
        </div>
    </div>
    <table class="table table-bordered content_big_td">
        <tbody>
            <tr>
                <td style="border-top: 0;">
                    <div class="form-horizontal row-fluid">
                        <form method="post" action="{site_url('admin/components/cp/gallery/update_album/' . $album.id . '/' . $locale)}" id="create_album_form">
                            <div class="control-group">
                                <label class="control-label" for="category_id">{lang("Categories", 'gallery')}:</label>
                                <div class="controls">
                                    <select name="category_id" id="category_id">
                                        {foreach $categories as $item}
                                            <option value="{$item.id}"  {if $item.id == $album.category_id}selected="selected"{/if}>{$item.id} - {$item.name}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">{lang("Name", 'gallery')}: <span class="must">*</span></label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" value="{htmlspecialchars($album.name)}" class="required"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="">{lang("Description", 'gallery')}:</label>
                                <div class="controls">
                                    <textarea name="description" class="smallTextarea elRTE">{htmlspecialchars($album.description)}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="">{lang("Position", 'gallery')}:</label>
                                <div class="controls">
                                    <input type="text" name="position" value="{$album.position}" class="textbox_long" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="">{lang("Template file", 'gallery')}:</label>
                                <div class="controls">
                                    <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                    <div class="o_h">
                                        <input type="text" name="tpl_file" value="{$album.tpl_file}" class="textbox_long" />
                                        <div class="help-block">{lang("by default", 'gallery')} album.tpl</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{$album.id}" name="album_id"/>
                            <input type="hidden" value="{$album['category_id']}" name="category_id"/>
                            {form_csrf()}
                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang("Album deletion", 'gallery')}:</h3>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel", 'gallery')}</a>
        <a href="#" class="btn btn-primary" onclick="GalleryAlbums.deleteCategoriesConfirm()" >{lang("Delete", 'gallery')}</a>
    </div>
</div>
