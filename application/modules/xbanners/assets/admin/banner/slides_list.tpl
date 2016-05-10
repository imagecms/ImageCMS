{foreach $bannerImages as $categoryName => $images}
    <table class="table table-edit-banner table-success-banner table-bordered table-hover table-condensed content_big_td" categoryName="{echo $categoryName}">
        <thead>
        <tr>
            <th colspan="7">
                {echo $categoryName}
            </th>
        </tr>
        </thead>
        <tbody data-url="/admin/components/init_window/xbanners/changePositions" class="sortable-slide save_positions ui-sortable">
        {$count = 1}
        {$i=0}
        {foreach $images['images'] as $key => $image}
            <tr>
                <input type="hidden" name="ids" value="{echo $image->getId()}">
                <td class="sortable-move" colspan="1">
                    <span class="hide-count">{$count}</span>
                </td>
                <td class="first-td share_alt" colspan="6">
                    <form method="post"
                          action="{site_url('/admin/components/init_window/xbanners/saveImage')}/{echo $banner->getId()}/{echo $locale}/{echo $image->getId()}"
                          enctype="multipart/form-data"
                          id="edit_banner_image_form_{echo $image->getId()}"
                          class="m-t_10">
                        <input type="hidden" name="image[clicks]" value="{echo $image->getClicks()}">
                        <input type="hidden" name="image[src]" class="input-long" value="{echo $image->getSrc()}"/>

                        <div class="inside_padd">
                            <div class="control-group control-group-photo_album">
                                <label class="control-label" style="display: none;">
                                <span class="btn btn-small p_r" data-url="file">
                                    <i class="icon-camera"></i>
                                    <input type="file" disabled="disabled" name="file-image" title="{lang('Main image','xbanners')}"/>
                                    <input type="hidden" name="variants[mainImageName][]" value="{echo $image->getImageOriginPath()}" class="mainImageName"/>
                                    <input type="hidden" name="changeImage[]" value="" class="changeImage"/>
                                    <input type="hidden" name="variants[MainImageForDel][]" class="deleteImage" value="0"/>
                                </span>
                                </label>

                                <div class="controls photo_album photo_album-v">
                                    <div class="fon" style="display: none"></div>
                                    <div class="btn-group f-s_0" style="display: none">
                                        <button type="button" class="btn change_image btn-small" data-rel="tooltip" data-title="{lang('Edit','xbanners')}" data-original-title="">
                                            <i class="icon-edit"></i></button>
                                    </div>
                                    <div class="photo-block {if $image->getSrc()}isImage{/if}">
                                        <span class="helper"></span>
                                        {if $image->getSrc()}
                                            <img class="offEditImageFon img-polaroid bannerImageToCrop" src="{echo $image->getImageOriginPath()}">
                                        {else:}
                                            <span class='fon-size'>{echo $banner->getWidth()}
                                                x{echo $banner->getHeight()} {echo lang('px', 'xbanners')}</span>
                                        {/if}
                                        <span class='fon-size' style="display:none;">{echo $banner->getWidth()}
                                            x{echo $banner->getHeight()} {echo lang('px', 'xbanners')}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="form-horizontal success-form-horizontal not-margin">
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

                                    <div class="controls" style='margin-top:4px;'>
                                        <span>{echo $image->getName()}</span>
                                    </div>
                                    <div class="controls hide-control">
                                        <input type="text" name="image[name]" class="input-long"
                                               value="{echo htmlspecialchars($image->getName())}"/>
                                        <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                        <div class="d_n">
                                            <p>{echo lang('Slide name', 'xbanners')}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Name">{lang('Activity', 'xbanners')}:</label>

                                    <div class="controls" style='margin-top:4px;'>
                                        {if $image->getActive()}
                                            {if $image->getPermanent()}
                                                {lang('Permanently active', 'xbanners')}
                                            {else:}
                                                {lang('Active', 'xbanners')}
                                                {if $image->getActiveFrom()}
                                                    {lang('from', 'xbanners')}
                                                    {echo date('d-m-Y', $image->getActiveFrom())}
                                                {/if}

                                                {if $image->getActiveTo()}
                                                    {lang('to', 'xbanners')}
                                                    {echo date('d-m-Y', $image->getActiveTo())}
                                                {/if}
                                            {/if}
                                        {else:}
                                            {lang('Inactive', 'xbanners')}
                                        {/if}
                                    </div>
                                    <div class="controls hide-control">
                                        <div class="robotsChecker frame_prod-on_off">
                                            <span class="prod-on_off {if !$image->getActive()}disable_tovar{/if}"></span>
                                            <input type="checkbox" name="image[active]" {if $image->getActive()}checked="checked"{/if} value="" data-val-on="1" data-val-off="0">
                                        </div>
                                    <span class="frame_label {if $image->getPermanent()}active{/if}">
                                        <span class="niceCheck">
                                            <input class="show-date-banner" type="checkbox" {if $image->getPermanent()}checked="checked"{/if} name="image[permanent]" value="1"/>
                                        </span>
                                    </span>
                                        {lang('Permanent banner', 'xbanners')}
                                    </div>
                                </div>
                                <div class="control-group hide-control-group" {if $image->getPermanent()}style="display: none"{/if}>
                                    <label class="control-label hide-control" for="Name">&nbsp;
                                    </label>

                                    <div class="controls hide-control">
                                        <label class="v-a_m" style="width:115px;margin-right:10px; display: inline-block;margin-bottom:0px;">
                                        <span class="o_h d_b p_r">
                                            <input type="text" data-placement="top" data-original-title="{lang('choose a date','admin')}" data-rel="tooltip" class="datepicker " name="image[active_from]" value="{if $image->getActiveFrom()}{echo date('d-m-Y', $image->getActiveFrom())}{/if}" placeholder="{lang('from','admin')}">
                                            <i class="icon-calendar"></i>
                                        </span>
                                        </label>
                                        <label class="v-a_m" style="width:115px; display: inline-block;margin-bottom:0px;">
                                        <span class="o_h d_b p_r">
                                            <input type="text" data-placement="top" data-original-title="{lang('choose a date','admin')}" data-rel="tooltip" class="datepicker " name="image[active_to]" value="{if $image->getActiveTo()}{echo date('d-m-Y', $image->getActiveTo())}{/if}" placeholder="{lang('to','admin')}">
                                            <i class="icon-calendar"></i>
                                        </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group {if !$image->getUrl()}hide-control{/if}">

                                    <label class="control-label" for="Name">{lang('Url', 'xbanners')}:
                                    </label>

                                    <div class="controls" style='margin-top:4px;'>
                                        {if !strstr($image->getUrl(), 'http')}
                                            {$slash = strpos($image->getUrl(), '/') === 0?'':'/';}
                                            {$url = site_url($locale . $slash   . $image->getUrl());}
                                        {else:}
                                            {$url =  $image->getUrl();}
                                        {/if}

                                        {if $url}
                                            <a href="{echo $url}" target="_blank">{$url}</a>
                                        {/if}
                                    </div>
                                    <div class="controls hide-control">
                                        <input type="text" name="image[url]" class="input-long urlcomplete"
                                               value="{echo $image->getUrl()}"/>
                                        <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                        <div class="d_n">
                                            <p>{echo lang('Slide url. Search to find url to your site page or paste remote one.', 'xbanners')}</p>
                                            <br>

                                            <p>{echo lang('External url must be start with http(s)://', 'xbanners')}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    {if $image->getTarget()}
                                    {/*}
                                        <label class="control-label" for="Name">{lang('Url open type', 'xbanners')}
                                            :</label>
                                        { */}
                                        <div class="controls" style='margin-top:4px;'>
                                            {if $image->getTarget()}{lang('transition to a new window', 'xbanners')}{else:}{lang('no', 'xbanners')}{/if}
                                        </div>
                                    {/if}
                                    <div class="controls hide-control">
                            <span class="frame_label">
                                <span class="niceCheck" style="background-position: -46px 0px;">
                                    <input type="checkbox" name="image[target]" {if $image->getTarget()}checked="checked"{/if} value="1"/>
                                </span>
                            </span>
                                        {echo lang('Open slide link in new window tab', 'xbanners')}
                                    </div>
                                </div>

                                {if $allowedPagesOptions}
                                    <div class="control-group">
                                        <label class="control-label" for="Name">{lang('Show in', 'xbanners')}:</label>

                                        <div class="controls" style='margin-top:4px;'>
                                            {echo $categoryName}
                                        </div>
                                        <div class="controls hide-control">
                                <span class="frame_label {if !$image->getAllowedPage()}active{/if}">
                                    <span class="niceCheck">
                                        <input class="show-categories" type="checkbox" {if !$image->getAllowedPage()}checked="checked"{/if} name="image[allowed_page_all]" value="1"/>
                                    </span>
                                </span>
                                            {lang('Show in every page', 'xbanners')}
                                        </div>
                                    </div>
                                    <div class="control-group show-control-group {if $image->getAllowedPage()}toEdit{/if} select-cat-control-group">
                                        <label class="control-label" for="Name">&nbsp;
                                        </label>

                                        <div class="controls">

                                            <select name="image[allowed_page]" class="input-long" style="width: 100%">
                                                <option>--{echo lang('Select page', 'xbanners')}--
                                                </option>
                                                {echo makeSelected($image->getAllowedPage(), $allowedPagesOptions)}
                                            </select>
                                            <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>
                                        </div>
                                    </div>
                                {/if}

                                <div class="control-group {if !$image->getDescription()}hide-control{/if}">
                                    <label class="control-label" for="Name">{lang('Description', 'xbanners')}:</label>

                                    {if $image->getDescription()}
                                        <div class="controls" style="margin-top: 4px;">
                                            {echo $image->getDescription()}
                                        </div>
                                    {/if}

                                    <div class="controls hide-control">
                                        <textarea name="image[description]" class="elRTE">{echo $image->getDescription()}</textarea>
                                        <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                        <div class="d_n">
                                            <p>{echo lang('Slide description text.', 'xbanners')}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="Name">{lang('Statistic', 'xbanners')}:</label>

                                    <div class="controls" style="margin-top: 4px;">
                                        {echo $image->getClicks()}
                                        {echo pluralize($image->getClicks(), array(lang('transitions1',"xbanners"),lang('transitions2',"xbanners"),lang('transitions3',"xbanners"), lang('transitions3',"xbanners")))}
                                    </div>
                                </div>

                                <div class="control-group" style="margin-top:10px; margin-bottom: 10px;">
                                    <div class="controls">
                                        <button type="button"
                                                class="btn btn-default editSlide"
                                                data-form=""
                                                onclick="Banners.showEditable(this)">
                                            <i class="icon-edit icon-trash"></i>
                                            {lang('Edit', 'xbanners')}
                                        </button>
                                        <a style="margin-left:5px;" href="{echo site_url('/admin/components/init_window/xbanners/deleteSlide')}/{echo $banner->getId()}/{echo $image->getId()}/{$locale}"
                                           type="button" class="btn btn-small btn-default deleteSlide pjax">
                                            <i class="icon-trash"></i>
                                            {lang('Delete', 'xbanners')}
                                        </a>
                                        <button style="margin-left:5px;" type="button"
                                                class="btn btn-small btn-primary saveSlide formSubmit"
                                                data-form="#edit_banner_image_form_{echo $image->getId()}" data-submit>
                                            <i class="icon-ok icon-white"></i>
                                            {lang('Save', 'xbanners')}
                                        </button>
                                        <button style="margin-left:5px;" onclick="Banners.hideEditable(this)" type="button" class="btn btn-small action_on btnCloseEditSlide">{lang('Cancel', 'admin')}</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                </td>
            </tr>
            {$count++}
            {$i++}
        {/foreach}
        </tbody>
    </table>
{/foreach}