<div class="modal hide fade" id='myModal'>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Create group', 'banners')}</h3>
    </div>
    <div class="modal-body">
        <p>{lang('Group name', 'banners')}</p>
        <input type="text" name="nameGroup" id="nameGroup">
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="groupCreate();
        $('#myModal').modal('hide')">{lang('Create', 'banners')}</a>
    </div>
</div>

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Editing banner', 'banners')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/banners" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'banners')}</span></a>
                <button onclick="selects()" type="button" class="btn btn-small btn-primary formSubmit" data-form="#image_upload_form" data-submit><i class="icon-ok icon-white"></i>{lang('Save', 'banners')}</button>
                <button onclick="selects()" type="button" class="btn btn-small action_on formSubmit" data-form="#image_upload_form" data-action="tomain"><i class="icon-check"></i>{lang('Save and exit', 'banners')}</button>
                {echo create_language_select($languages, $locale, "/admin/components/init_window/banners/edit/".$banner['id'])}
            </div>
        </div>
    </div>
    <form method="post" action="/admin/components/init_window/banners/edit/{echo $banner['id']}/{$locale}" enctype="multipart/form-data" id="image_upload_form" class="m-t_10">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Options', 'banners')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label" for="Name">{lang('Name', 'banners')} {$translatable}: <span class="must">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="name" id="Name" value="{echo $banner['name']}" required/>
                                    </div>
                                    <div class="controls">
                                        <span class="frame_label no_connection m-r_15">
                                            <span class="niceCheck" style="background-position: -46px 0px; ">
                                                <input type="checkbox" name="active" value="1" {if $banner['active'] == true}checked="checked"{/if}>
                                            </span>
                                            {lang('Active', 'banners')}
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="Text">{lang('Text banner', 'banners')} {$translatable}:</label>
                                    <div class="controls">
                                        <textarea name="description" id="Text" class="elRTE" >{echo $banner['description']}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Url"> {lang('URL', 'banners')} {$translatable}:</label>
                                    <div class="controls">
                                        <input type="text" name="url" id="Url" value="{if trim($banner['url'])}{echo $banner['url']}{/if}"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="Url"> {lang('Banner group', 'banners')} {$translatable}:</label>
                                    <div class="controls">
                                        <div class="">
                                            <select class="span3 notchosen"
                                            id="appendedInputButton"
                                            ondblclick="groupDel()"
                                            type="text"
                                            name="group[]"
                                            multiple="multiple">
                                            {foreach $groups as $group}
                                            <option value="{echo $group.name}"{if in_array($group.name,unserialize($banner.group))}selected="selected"{/if}>{echo $group.name}</option>
                                            {/foreach}
                                        </select>

                                        <a class="btn" style="margin-left: 10px;" onclick="$('#myModal').modal('show')"> <i class="icon-plus-sign"></i> {lang('Create group', 'banners')}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="data">{lang('Selected items', 'banners')}:</label>
                                <div class="controls">
                                    <select id="data" name="data[]" multiple="multiple" class="notchosen" style="height:200px; max-width: 500px !important" >
                                        {foreach unserialize($banner['where_show']) as $w}
                                        <option  ondblclick='delEntity(this)' value="{echo $w}">{get_entity_mod($w)}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="banner_type">{lang('Show in categories (select items)', 'banners')}:</label>
                                <div class="controls">
                                    <select id="banner_type" onchange="autosearch(this, '/admin/components/init_window/banners/autosearch', '#autodrop', 'autodrop')">
                                        <option value="default">--{lang('select essence', 'banners')}--</option>
                                        <option value="main">{lang('Main', 'banners')}</option>
                                        {if $is_shop}
                                        <option value="product">{lang('Product', 'banners')}</option>
                                        <option value="shop_category">{lang('Product category', 'banners')}</option>
                                        <option value="brand">{lang('Brand', 'banners')}</option>
                                        {/if}
                                        <option value="category">{lang('Pages categories', 'banners')}</option>
                                        <option value="page">{lang('Pages', 'banners')}</option>
                                    </select>
                                    <div id="autodrop"></div>

                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">{lang('Active until', 'banners')}:</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n" onclick="$('#active_to').fadeToggle()">
                                            <input required="required"
                                            type="checkbox"
                                            {if $banner['active_to'] == -1}checked="checked"{/if}
                                            name="active_to_permanent"/>
                                        </span>
                                    </span>
                                    {lang('Banner permanent', 'banners')}
                                </div>
                                <div class="controls">
                                    <input class="datepicker"
                                    id="active_to"
                                    required="required"
                                    type="text"
                                    {if $banner['active_to'] == -1}style="display: none"{/if}
                                    value="{if $banner['active_to']}{echo date('Y-m-d',$banner['active_to'])}{else:}{echo $date}{/if}"
                                    name="active_to" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="Img">
                                    {lang('Image', 'banners')}: <span class="must">*</span>
                                </label>
                                <div class="controls">
                                    <div class="group_icon pull-right">
                                            <a href="{echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=Img');}" class="btn  iframe-btn" type="button">
                                                <i class="icon-picture"></i>
                                                {lang('Choose an image ', 'banners')}
                                            </a>
                                    </div>
                                    <div class="o_h" id="banerChangePhoto">
                                        <input type="text" name="photo" id="Img" value="{echo $banner['photo'];}" required="required">
                                    </div>
                                    <div id="Img-preview" style="width: 400px;" class="m-t_20">
                                        {if $banner['photo']}
                                        <img src="{echo $banner['photo']}" class="img-polaroid">
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<div id="elFinder"></div>
</section>