<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Album creating", 'gallery')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <button type="button" name="button" class="btn formSubmit btn-success" data-form="#create_album_form" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create", 'admin')}</button> 
                <button type="button" name="button" class="btn formSubmit" data-form="#create_album_form" data-submit data-action="exit"><i class="icon-check"></i>{lang("Create and exit", 'admin')}</button> 
            </div>
        </div>
    </div>
    <table class="table table-bordered content_big_td">
        <tbody>
            <tr>
                <td style="border-top: 0;">
                    <div class="form-horizontal row-fluid">
                        <form method="post" action="{site_url('admin/components/cp/gallery/create_album')}" id="create_album_form">
                            <div class="control-group">
                                <label class="control-label" for="category_id">{lang("Categories", 'gallery')}:</label>
                                <div class="controls">
                                    <select name="category_id" id="category_id">
                                        <!-- <option value="0">{lang('No', 'gallery')}</option> -->
                                        {foreach $categories as $item}
                                            <option value="{$item.id}">{$item.id} - {$item.name}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">{lang("Name", 'gallery')}: <span class="must">*</span></label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" value="" class="required"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="description">{lang("Description", 'gallery')}:</label>
                                <div class="controls">
                                    <textarea name="description" id="description" class="smallTextarea elRTE"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="tpl_file">{lang("Template file", 'gallery')}:</label>
                                <div class="controls">
                                    <div class="pull-right help-block">.tpl</div>
                                    <div class="o_h">
                                        <input type="text" name="tpl_file" id="tpl_file" value=""/>
                                        <span class="help-block">{lang("by default", 'gallery')}: album.tpl</span>
                                    </div>
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