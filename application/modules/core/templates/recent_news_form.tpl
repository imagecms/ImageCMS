<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_widget_settings')}<b>{$widget.name}</b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/widgets_manager/index" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#widget_form" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain"><i class="icon-edit"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>
    <form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" id="widget_form" method="post" class="form-horizontal">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
                <th>{lang('a_sett')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd span9">
                            <div class="control-group">
                                <label class="control-label" for="comcount">{lang('amt_pages')}:</label>
                                <div class="controls">
                                    <select name="display" id="comcount">
                                        <option value="recent"  {if $widget.settings.display == 'recent'} selected="selected" {/if} >{lang('amt_last')}</option>
                                        <option value="popular" {if $widget.settings.display == 'popular'} selected="selected" {/if}>{lang('amt_popular')}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="symcount">{lang('amt_categories')}:</label>
                                <div class="controls">
                                    <select name="categories[]" multiple="multiple" id="symcount">
                                        <option value="0">{lang('amt_without_category')}</option>
                                        <option disabled="disabled"> </option>
                                        {build_cats_tree($cats, $widget.settings.categories)}
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="newscount">{lang('amt_displayed_news_count')}:</label>
                                <div class="controls">
                                    <input type="text" name="news_count" value="{$widget.settings.news_count}" id="newscount"/> 
                                </div>            
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="maxsym">{lang('amt_max_char_count')}:</label>
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