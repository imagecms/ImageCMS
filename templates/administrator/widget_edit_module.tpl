<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="title">{lang("Widget editing","admin")}<b> {$widget.name}</b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/widgets_manager/index/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Return","admin")}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#wid_ed_form" data-submit><i class="icon-ok icon-white"></i>{lang("Save","admin")}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#wid_ed_form" data-action="tomain"><i class="icon-check"></i>{lang("Save and go back","admin")}</button>
            </div>
        </div>                            
    </div>
    <form method="post" action="{$BASE_URL}admin/widgets_manager/update_widget/{$widget.id}/info" class="form-horizontal" id="wid_ed_form">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang("Properties","admin")}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd span9">
                            <div class="control-group m-t_10">
                                <label class="control-label" for="inputName">{lang("Name","admin")}:</label>
                                <div class="controls">
                                    <input type="text" name="name" id="inputName" value="{$widget.name}"/>
                                    <p class="help-block">{lang("Only Latin characters","admin")}</p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputDesc">{lang("Description","admin")}:</label>
                                <div class="controls">
                                    <input type="text" name="desc" id="inputDesc" value="{$widget.description}">
                                    <p class="help-block">{lang("Short widget description","admin")}</p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {include_tpl('modules_additions')}
    </form>
</section>