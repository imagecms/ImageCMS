<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Widget settings", 'core')}<b> {$widget.name}</b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/widgets_manager/index" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span>
                    <span class="t-d_u">{lang("Go back", 'admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#widget_form" data-submit>
                    <i class="icon-ok"></i>{lang("Save", 'admin')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain">
                    <i class="icon-check"></i>{lang("Save and go back", 'admin')}</button>
            </div>
        </div>
    </div>
    <form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" id="widget_form" method="post" class="form-horizontal">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang("Settings", 'core')}</th>
            </thead>
            <tbody>
            <tr>
                <td>
                    <div class="inside_padd">
                        <div class="control-group">
                            <label class="control-label" for="categories">{lang("Categories", 'core')}:</label>

                            <div class="controls">
                                <select name="settings[categories][]" multiple="multiple" id="categories">
                                    <option disabled="disabled"></option>
                                    {build_cats_tree($cats, $widget.settings.categories)}
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="search_type">{lang("Search type", 'core')}:</label>

                            <div class="controls">
                                <select name="settings[search_type]" id="search_type">
                                    <option value="title"  {if $widget.settings.search_type == 'title'} selected="selected" {/if} >{lang("By page title", 'core')}</option>
                                    <option value="tags" {if $widget.settings.search_type == 'tags'} selected="selected" {/if}>{lang("By pages tags", 'core')}</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="limit">{lang("Similar pages limit", 'core')}:</label>

                            <div class="controls">
                                <input type="text" name="settings[limit]" value="{$widget.settings.limit}" id="limit"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="min_compare_symbols">{lang("Minimum symbol in words to compare", 'core')}
                                :</label>

                            <div class="controls">
                                <input type="text" name="settings[min_compare_symbols]" value="{$widget.settings.min_compare_symbols}" id="min_compare_symbols"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="max_short_description_words">{lang("Maximum short description words count", 'core')}
                                :</label>

                            <div class="controls">
                                <input type="text" name="settings[max_short_description_words]" value="{$widget.settings.max_short_description_words}" id="max_short_description_words"/>
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