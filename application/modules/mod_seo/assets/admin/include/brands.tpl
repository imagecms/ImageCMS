<table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
    <thead>
    <tr>
        <th colspan="6">{lang('Brands','mod_seo')} [{$locale}]</th>
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
                                                        <b>%ID%</b> - {lang('Brand ID','mod_seo')} <br/>
                                                        <b>%name%</b> - {lang('Brand name','mod_seo')}<br/>
                                                        <b>%desc%</b> - {lang('Brand description','mod_seo')}<br/>
                                                        <b>%pagenumber%</b> - {lang("Current page number",'mod_seo')}<br/>
                                                        <br/>
                                                        {lang('Additional params for using with brand name','mod_seo')}:<br/>
                                                        <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                        <b>%name[t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                    </div>
                                                    Meta-title:
                                                </span>
                                                <span class="span8 discount-name">
                                                    <textarea name='brandTemplate'>{$settings.brandTemplate}</textarea>
                                                </span>
                    </label>

                    <label class="control-group">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Brand ID','mod_seo')} <br/>
                                                        <b>%name%</b> - {lang('Brand name','mod_seo')}<br/>
                                                        <b>%desc%</b> - {lang('Brand description','mod_seo')}<br/>
                                                        <b>%pagenumber%</b> - {lang("Current page number",'mod_seo')}<br/>
                                                        <br/>
                                                        {lang('Additional params for using with brand name','mod_seo')}:<br/>
                                                        <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                        <b>%name[t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                    </div>
                                                    Meta-description:
                                                </span>
                                                <span class="span8 discount-name">
                                                    <textarea name='brandTemplateDesc'>{$settings.brandTemplateDesc}</textarea>
                                                </span>
                    </label>

                    <label class="control-group">
                                                <span class="span4">
                                                    <span class="popover_ref" data-original-title="" data-title="{lang('Variables, can use to', 'mod_seo')}:">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%number%</b> - {lang('Page number','mod_seo')}<br/>
                                                    </div>
                                                    {lang('Unique pagination pages','mod_seo')}:
                                                </span>
                                                <span class="span8 discount-name">
                                                    <textarea name='brandPaginationTemplate'>{$settings.brandPaginationTemplate}</textarea>
                                                </span>
                    </label>

                    <label class="control-group">
                                                <span class="span4">
                                                    {lang('Description length','mod_seo')}:
                                                </span>
                                                <span class="span8 discount-name">
                                                    <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='brandTemplateDescCount' value="{$settings.brandTemplateDescCount}" />
                                                </span>
                    </label>

                    <label class="control-group">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>

                                                    <div class="d_n">
                                                        <b>%name%</b> - {lang('Brand name','mod_seo')}<br/>
                                                        <b>%pagenumber%</b> - {lang("Current page number",'mod_seo')}<br/>
                                                        <br/>
                                                        {lang('Additional params for using with brand name','mod_seo')}:<br/>
                                                        <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                        <b>%name[t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                    </div>
                                                    {lang('Meta-keywords', 'mod_seo')}:
                                                </span>
                                                <span class="span8 discount-name">
                                                    <textarea name='brandTemplateKey'>{$settings.brandTemplateKey}</textarea>
                                                </span>
                    </label>

                    <div class="control-group">
                        <div class="frame_label no_connection">
                            <span class="span4">{lang('Active','mod_seo')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n v-a_t">
                                                            <input class="span4" name="useBrandPattern" {if $settings.useBrandPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="frame_label no_connection">
                            <span class="span4">{lang('Use only for empty metadata','mod_seo')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n v-a_t">
                                                            <input class="span4" name="useBrandPatternForEmptyMeta" {if $settings.useBrandPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
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
