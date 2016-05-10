<form method="post"
      action="/admin/components/init_window/xbanners/saveImage/{echo $banner->getId()}/{echo $locale}"
      enctype="multipart/form-data"
      id="create_banner_image_form" class="m-t_10">

    {if count($bannerImages) > 1}
        <div class="control-group" style="position: absolute; right: 0;top: -50px;">
            <label class="control-label" for="Name" style="position: relative; top: 30px; left: -65px;">{lang('Show', 'xbanners')}
            </label>

            <div class="controls">
                <select name="image[allowed_page]" onchange="Banners.showImagesCategory(this)">
                    <option value="all">--{echo lang('All', 'xbanners')}--</option>
                    {foreach $bannerImages as $categoryName => $images}
                        <option value="{echo $categoryName}">{echo $categoryName}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if}

    <table class="table {if $bannerImages}addNewSlide{/if} addNewSlidecss table-bordered table-hover table-condensed table-edit-banner content_big_td">
        <thead>
            <tr>
                <th colspan="6">
                    {lang('Add new slide', 'xbanners')}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <div class="control-group control-group-photo_album">
                            <label class="control-label" style="display: none;">
                                <span class="btn btn-small p_r" data-url="file" >
                                    <i class="icon-camera"></i>
                                    <input type="file" name="file-image" class="input-long" />
                                    <input type="hidden" name="variants[mainImageName][]" value="" class="mainImageName" />
                                    <input type="hidden" name="changeImage[]" value="" class="changeImage" />
                                    <input type="hidden" name="variants[MainImageForDel][]" class="deleteImage" value="0"/>
                                </span>
                            </label>
                            <div class="controls  photo_album photo_album-v">
                                <div class="fon"></div>
                                <div class="btn-group f-s_0">
                                    <button type="button" class="btn change_image btn-small" data-rel="tooltip" data-title="{lang('Edit','xbanners')}" data-original-title=""><i class="icon-edit"></i></button>
                                </div>
                                <div class="photo-block">
                                    <span class="helper"></span>
                                    <span class='fon-size'>{echo $banner->getWidth()}x{echo $banner->getHeight()} {echo lang('px', 'xbanners')}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label" for="Name">{lang('Size', 'xbanners')}:
                                </label>

                                <div class="controls">
                                    {echo $banner->getWidth()}
                                    x{echo $banner->getHeight()} {echo lang('px', 'xbanners')}
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Name">{lang('Name', 'xbanners')}:
                                </label>

                                <div class="controls">
                                    <input type="text" name="image[name]" class="input-long"
                                           value=""/>
                                    <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                    <div class="d_n">
                                        <p>{echo lang('Slide name', 'xbanners')}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Name">{lang('Activity', 'xbanners')}:
                                </label>

                                <div class="controls">
                                    <div class="robotsChecker frame_prod-on_off">
                                        <span class="prod-on_off"></span>
                                        <input type="checkbox" name="image[active]" checked="checked" value="" data-val-on="1" data-val-off="0">
                                    </div>
                                    <span class="frame_label active">
                                        <span class="niceCheck">
                                            <input class="show-date-banner" type="checkbox" checked="checked" name="image[permanent]" value="1"/>
                                        </span>
                                    </span>
                                    {lang('Permanent banner', 'xbanners')}
                                </div>
                            </div>
                            <div class="control-group hide-control-group" style="display: none;">
                                <label class="control-label" for="Name">&nbsp;
                                </label>

                                <div class="controls">
                                    <label class="v-a_m" style="width:115px;margin-right:10px; display: inline-block;margin-bottom:0px;">
                                        <span class="o_h d_b p_r">
                                            <input type="text" data-placement="top" data-original-title="{lang('choose a date','admin')}" data-rel="tooltip" class="datepicker " name="image[active_from]" value="{$_GET['dateCreated_f']}" placeholder="{lang('from','admin')}">
                                            <i class="icon-calendar"></i>
                                        </span>
                                    </label>
                                    <label class="v-a_m" style="width:115px; display: inline-block;margin-bottom:0px;">
                                        <span class="o_h d_b p_r">
                                            <input type="text" data-placement="top" data-original-title="{lang('choose a date','admin')}" data-rel="tooltip" class="datepicker " name="image[active_to]" value="{$_GET['dateCreated_t']}" placeholder="{lang('to','admin')}">
                                            <i class="icon-calendar"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Name">{lang('Url', 'xbanners')}:</label>

                                <div class="controls">

                                    <input type="text" data-locale="{$locale}" name="image[url]" class="input-long urlcomplete"
                                           value=""/>
                                    <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                    <div class="d_n">
                                        <p>{echo lang('Slide url. Search to find url to your site page or paste remote one.', 'xbanners')}</p>
                                        <br>
                                        <p>{echo lang('External url must be start with http(s)://', 'xbanners')}</p
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                {/*}
                                <label class="control-label" for="Name">{lang('Url open type', 'xbanners')}:</label>
                                { */}
                                <div class="controls">
                                    <span class="frame_label">
                                        <span class="niceCheck" style="background-position: -46px 0px;">
                                            <input type="checkbox" name="image[target]" value="1"/>
                                        </span>
                                    </span>
                                    {echo lang('Open slide link in new window tab', 'xbanners')}
                                </div>
                            </div>
                            {if !is_null($allowedPagesOptions)}
                                <div class="control-group">
                                    <label class="control-label" for="Name">{lang('Show in', 'xbanners')}:
                                    </label>

                                    <div class="controls">
                                        <span class="frame_label">
                                            <span class="niceCheck" style="background-position: -46px 0px;">
                                                <input class="show-categories" type="checkbox" checked name="image[permanent]" value="1"/>
                                            </span>
                                        </span>
                                        {lang('Show in every page', 'xbanners')}
                                    </div>
                                </div>
                                <div class="control-group show-control-group">
                                    <label class="control-label" for="Name">&nbsp;
                                    </label>

                                    <div class="controls">
                                        <select name="image[allowed_page]" class="span5">
                                            <option>--{echo lang('Select page', 'xbanners')}--</option>
                                            {echo $allowedPagesOptions}
                                        </select>
                                        <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                        <div class="d_n">
                                            <p>{echo lang("Page where banner's slide should be placed.", 'xbanners')}</p>
                                        </div>
                                    </div>
                                </div>
                            {/if}

                            <div class="control-group">
                                <label class="control-label" for="Name">{lang('Description', 'xbanners')}:</label>

                                <div class="controls">

                                    <textarea name="image[description]" class="elRTE"></textarea>
                                    <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                    <div class="d_n">
                                        <p>{echo lang('Slide description text.', 'xbanners')}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="button"
                                            class="btn btn-small btn-success formSubmit"
                                            data-form="#create_banner_image_form" data-submit
                                            data-action="toedit">
                                        <i class="icon-plus-sign icon-white"></i>
                                        {lang('Add', 'xbanners')}
                                    </button>
                                    {if !count($bannerImages) == 0}
                                        <button style="margin-left:5px;" onclick="" type="button" class="btn btn-small action_on btnCloseNewSlide">{lang('Cancel', 'admin')}</button>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>

