<table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
    <thead>
    <tr>
        <th colspan="6">{lang('Gallery category','mod_seo')} [{$locale}]</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">
            <div class="inside_padd discount-out">
                <div class="form-horizontal">
                    <label class="control-group">
                            <span class="span4">
                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                    <i class="icon-info-sign"></i>
                                </span>
                                <div class="d_n">
                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                </div>
                                Meta-title:
                               </span>
                            <span class="span8 discount-name">
                                <textarea name='galleryCategoryTemplate'>{$settings.galleryCategoryTemplate}</textarea>
                            </span>
                    </label>

                    <label class="control-group">
                        <span class="span4">
                                 <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                        <i class="icon-info-sign"></i>
                                 </span>
                                <div class="d_n">
                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                    <b>%desc%</b> - {lang('Gallery category description','mod_seo')}<br/>
                                </div>
                            Meta-description:
                        </span>
                        <span class="span8 discount-name">
                            <textarea name='galleryCategoryTemplateDesc'>{$settings.galleryCategoryTemplateDesc}</textarea>
                        </span>
                    </label>


                    <label class="control-group">
                        <span class="span4">
                            {lang('Description length','mod_seo')}:
                        </span>
                        <span class="span8 discount-name">
                            <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='galleryCategoryTemplateDescCount' value="{$settings.galleryCategoryTemplateDescCount}" />
                        </span>
                    </label>


                    <label class="control-group">
                        <span class="span4">
                            <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                    <i class="icon-info-sign"></i>
                                </span>
                                <div class="d_n">
                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                </div>
                            {lang('Meta-keywords', 'mod_seo')}:
                        </span>
                        <span class="span8 discount-name">
                            <textarea name='galleryCategoryTemplateKey'>{$settings.galleryCategoryTemplateKey}</textarea>
                        </span>
                    </label>

                    <div class="control-group">
                        <div class="frame_label no_connection">
                            <span class="span4">{lang('Active','mod_seo')}:</span>
                            <span class="span8 discount-name">
                                <span class="niceCheck b_n v-a_t">
                                    <input class="span4" name="useGalleryCategoryPattern" {if $settings.useGalleryCategoryPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>