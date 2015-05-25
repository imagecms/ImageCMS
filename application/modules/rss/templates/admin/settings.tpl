<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("RSS channel options or specifications", 'rss')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#rss_settings_form" data-submit><i class="icon-ok"></i>{lang("Save", 'rss')}</button>
            </div>
        </div>
    </div>
    <form action="{$BASE_URL}admin/components/cp/rss/settings_update" id="rss_settings_form" method="post" class="form-horizontal m-t_10">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang("Settings", 'rss')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd">
                            <div class="control-group">
                                <label class="control-label" for="comcount">{lang("Name", 'rss')}:</label>
                                <div class="controls">
                                    <input type="text" name="title" value="{$settings.title}" id="comcount"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="symcount">{lang("Description", 'rss')}:</label>
                                <div class="controls">
                                    <textarea class="mceEditor" name="description" id="symcount">{$settings.description}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectcat">{lang("Categories", 'rss')}:</label>
                                <div class="controls">
                                    <select name="categories[]" multiple="multiple" id="selectcat">
                                        <option value="0" {if $settings.categories.0 == 0} selected="selected" {/if}>{lang("Without a category", 'rss')}</option>
                                        <option disabled="disabled"> </option>
                                        {echo build_cats_tree($cats, $settings.categories)}
                                    </select>
                                    <span class="help-block">{lang("Choose transmition categories", 'rss')}</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="pages_count">{lang("Number of pages", 'rss')}:</label>
                                <div class="controls">
                                    <input type="text" name="pages_count" value="{$settings.pages_count}" id="pages_count"/>
                                    <span class="help-block">{lang("Specify the number of pages for display", 'rss')}</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="cache">{lang("Cache", 'rss')}:</label>
                                <div class="controls">
                                    <input type="text" name="cache_ttl" value="{$settings.cache_ttl}" id="cache"/>
                                    <span class="help-block">{lang("Specify caсhe lifetime in minutes", 'rss')}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {form_csrf()}
    </form>
</section>