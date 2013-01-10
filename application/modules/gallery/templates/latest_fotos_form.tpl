<section class="mini-layout">
         <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_widget_settings')}<b>{$widget.name}</b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/widgets_manager/index" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form"><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain"><i class="icon-edit"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="row-fluid">
            <form action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}" id="widget_form" method="post" class="form-horizontal">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th>{lang('a_sett')}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="inside_padd">
                                    <div class="row-fluid">
                                        <div class="control-group">
                                            <label class="control-label" for="comcount">{lang('a_images_limit')}:</label>
                                            <div class="controls">
                                                <input id="comcount" type="text" name="limit" value="{$widget.settings.limit}"/> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="symcount">{lang('a_algorithm')}:</label>
                                            <div class="controls">
                                                <select name="order" id="symcount"> 
                                                    <option value="latest" {if $widget.settings.order=='latest'}selected="selected"{/if}>{lang('a_latest_images')}</option>
                                                    <option value="random" {if $widget.settings.order=='random'}selected="selected"{/if}>{lang('a_random_images')}</option>
                                                </select> 
                                            </div>
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
    </div>
</section>