<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_rss_channel_sett')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#rss_settings_form" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <form action="{$BASE_URL}admin/components/cp/rss/settings_update" id="rss_settings_form" method="post" class="form-horizontal">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                <th>{lang('a_sett')}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="inside_padd span9">
                                <div class="control-group">
                                    <label class="control-label" for="comcount">{lang('amt_tname')}:</label>
                                    <div class="controls">
                                        <input type="text" name="title" value="{$settings.title}" id="comcount"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="symcount">{lang('amt_description')}:</label>
                                    <div class="controls">
                                        <textarea class="mceEditor" name="description" id="symcount">{$settings.description}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="selectcat">{lang('amt_categories')}:</label>
                                    <div class="controls">
                                        <select name="categories[]" multiple="multiple" id="selectcat">
                                            <option value="0" {if $settings.categories.0 == 0} selected="selected" {/if}>{lang('amt_without_category')}</option>
                                            <option disabled="disabled"> </option>
                                            {echo build_cats_tree($cats, $settings.categories)}
                                        </select>
                                        <span class="help-inline">{lang('amt_sel_cat_f_trans')}</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="pages_count">{lang('amt_pages_count')}:</label>
                                    <div class="controls">
                                        <input type="text" name="pages_count" value="{$settings.pages_count}" id="pages_count"/>
                                        <span class="help-inline">{lang('amt_select_pages_count_for_display')}</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="cache">{lang('amt_cache')}:</label>
                                    <div class="controls">
                                        <input type="text" name="cache_ttl" value="{$settings.cache_ttl}" id="cache"/>
                                        <span class="help-inline">{lang('amt_cache_life_in_minutes')}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            {form_csrf()}
        </form>
    </div>
</section>