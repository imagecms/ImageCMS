<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Widget settings", 'core')}<b> {$widget.name}</b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/widgets_manager/index" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#widget_form" data-submit><i class="icon-ok"></i>{lang("Save", 'admin')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain"><i class="icon-check"></i>{lang("Save and go back", 'admin')}</button>
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
                                <label class="control-label" for="comcount">{lang("Pages", 'core')}:</label>
                                <div class="controls">
                                    <select name="display" id="comcount">
                                        <option value="recent"  {if $widget.settings.display == 'recent'} selected="selected" {/if} >{lang("Latest", 'core')}</option>
                                        <option value="popular" {if $widget.settings.display == 'popular'} selected="selected" {/if}>{lang("Popular", 'core')}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="symcount">{lang("Categories", 'core')}:</label>
                                <div class="controls">
                                    <select name="categories[]" multiple="multiple" id="symcount">
                                        <option value="0">{lang("Without a category", 'core')}</option>
                                        <option disabled="disabled"> </option>
                                        {build_cats_tree($cats, $widget.settings.categories)}
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="newscount">{lang("Number of news for display", 'core')}:</label>
                                <div class="controls">
                                    <input type="text" name="news_count" value="{$widget.settings.news_count}" id="newscount"/> 
                                </div>            
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="maxsym">{lang("Maximum number of characters", 'core')}:</label>
                                <div class="controls">
                                    <input type="text" name="max_symdols" value="{$widget.settings.max_symdols}" id="maxsym"/>
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