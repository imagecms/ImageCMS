<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="title">{lang('a_widget_edit')}<b>{$widget.name}</b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/widgets_manager/index/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_create')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#wid_ed_form" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#wid_ed_form" data-action="tomain"><i class="icon-check"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
                <form method="post" action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}/info" class="form-horizontal" id="wid_ed_form">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('a_param')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="inputName">{lang('a_n')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="name" id="inputName" value="{$widget.name}"/>
                                                    <p class="help-block">{lang('a_just_lat')}</p>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputDesc">{lang('a_desc')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="desc" id="inputDesc" value="{$widget.description}">
                                                    <p class="help-block">{lang('a_short_widget_desc')}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="tab-pane"></div>
    </div>
</section>
