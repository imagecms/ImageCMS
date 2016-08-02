<table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
    <thead>
    <tr>
        <th colspan="6">{lang('All hits, actions, hots','mod_seo')} [{$locale}]</th>
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
                                <textarea name='BestsellerTemplate'>{$settings.BestsellerTemplate}</textarea>
                            </span>
                    </label>

                    <label class="control-group">
                        <span class="span4">
                            Meta-description:
                        </span>
                        <span class="span8 discount-name">
                            <textarea name='BestsellerTemplateDesc'>{$settings.BestsellerTemplateDesc}</textarea>
                        </span>
                    </label>

                    <label class="control-group">
                        <span class="span4">
                            {lang('Meta-keywords', 'mod_seo')}:
                        </span>
                        <span class="span8 discount-name">
                            <textarea name='BestsellerTemplateKey'>{$settings.BestsellerTemplateKey}</textarea>
                        </span>
                    </label>

                    <div class="control-group">
                        <div class="frame_label no_connection">
                            <span class="span4">{lang('Active','mod_seo')}:</span>
                            <span class="span1">
                                <span class="niceCheck b_n v-a_t">
                                    <input class="span4" name="useBestsellerPattern" {if $settings.useBestsellerPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
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