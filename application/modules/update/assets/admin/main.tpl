<section class="mini-layout">

    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки обновления</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/update/file_update" class="btn btn-small">Файли обновления</a>
                <a href="/admin/components/init_window/update/user_update" class="btn btn-small">Ключи обновления</a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#update_sett" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>


            </div>
        </div>                            
    </div>
    <form method="post" action="" enctype="multipart/form-data" id="update_sett">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('param')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">                                
                                    <div class="control-group">
                                        <label class="control-label" for="name_server">Сервер обновления</label>
                                        <div class="controls">
                                            <input type="text" name="name_server" id="name_servaer" value="{echo $data.name_server}" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="wsdl_path">wsdl file</label>
                                        <div class="controls">
                                            <input type="text" name="wsdl_path" id="wsdl_path" value="{echo $data.wsdl_path}" />
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>                               
    </form>
</section>