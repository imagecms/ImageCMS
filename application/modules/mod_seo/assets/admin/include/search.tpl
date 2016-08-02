<table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
    <thead>
    <tr>
        <th colspan="6">{lang('Search', 'mod_seo')} [{$locale}]</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">
            <div class="inside_padd discount-out">
                <div class="form-horizontal">
                    <label class="control-group">
                                                <span class="span4">
                                                    Meta-title:
                                                </span>
                                                <span class="span8 discount-name">
                                                    <textarea name='searchTemplate'>{$settings.searchTemplate}</textarea>
                                                </span>
                    </label>

                    <label class="control-group">
                                                <span class="span4">
                                                    Meta-description:
                                                </span>
                                                <span class="span8 discount-name">
                                                    <textarea name='searchTemplateDesc'>{$settings.searchTemplateDesc}</textarea>
                                                </span>
                    </label>

                    <label class="control-group">
                                                <span class="span4">
                                                    Meta-keywords:
                                                </span>
                                                <span class="span8 discount-name">
                                                    <textarea name='searchTemplateKey'>{$settings.searchTemplateKey}</textarea>
                                                </span>
                    </label>

                    <div class="control-group">
                        <div class="frame_label no_connection">
                            <span class="span4">{lang('Active','mod_seo')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n v-a_t">
                                                            <input class="span4" name="useSearchPattern" {if $settings.useSearchPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
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
