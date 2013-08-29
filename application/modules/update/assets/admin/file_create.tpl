<section class="mini-layout">
    
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Добавления оновлений</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/update/file_update" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#file_create" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                

            </div>
        </div>                            
    </div>
    <form method="post" action="" enctype="multipart/form-data" id="file_create">
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
                                    <label class="control-label" for="build_id">Номер build:</label>
                                    <div class="controls">
                                        <input type="text" name="build_id" id="build_id" value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="version">Версія:</label>
                                    <div class="controls">
                                        <select name="version" id="version">
                                            <option value="corp">Корпоративний</option>
                                            <option value="pro">Профессиональный</option>
                                            <option value="premium">Премиум</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Архив обновления:</label>
                                    <div class="controls">
                                        <input style="opacity: 100 !important; box-shadow: none; position: static !important" type="file" name="path_zip"/>
                                        
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Хеш сумма файлов обновления:</label>
                                    <div class="controls">
                                        <input style="opacity: 100 !important; box-shadow: none; position: static !important" type="file" name="path_hash"/>
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