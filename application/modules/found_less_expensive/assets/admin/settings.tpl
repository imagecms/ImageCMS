<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/found_less_expensive" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back')}</span></a>
                <button id="settingsSave" type="button" class="btn btn-small btn-primary action_on" data-submit><i class="icon-ok"></i>{lang('Have been saved')}</button>
            </div>
        </div>                            
    </div>
    <form method="post" action="{site_url('admin/components/cp/found_less_expensive/update_settings')}" class="form-horizontal" id="settingsForm">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Properties')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd span9">
                            <div class="control-group m-t_10">
                                <label class="control-label">Почта для получения уведомлений:</label>
                                <div class="controls">
                                    <input type="text" value="{echo $settings['emailTo']}" name="emailTo" id="email"/> 
                                </div>
                            </div>
                            <div class="control-group m-t_10">
                                <label class="control-label">Почта c которой отправлять уведомления:</label>
                                <div class="controls">
                                    <input type="text" value="{echo $settings['emailFrom']}" name="emailFrom" id="email"/> 
                                </div>
                            </div>
                            <div class="control-group m-t_10">
                                <label class="control-label">Тема сообщения:</label>
                                <div class="controls">
                                    <input type="text" value="{echo $settings['emailSubject']}" name="emailSubject" id="email"/> 
                                </div>
                            </div>
                            <div class="control-group m-t_10">
                                <label class="control-label">Шаблон сообщения:</label>
                                <div class="controls">
                                    <textarea name="emailTemplate" style="height:150px;">{echo $settings['emailTemplate']} </textarea>
                                <span class="help-inline">
                                    <b>Вы можете использовать следующие переменные:</b><br>
                                    %linkPage% - ccылка страницы на которой было оставлено уведомление<br>
                                    %linkProduct% - ссылка на продукт найден дешевле<br>
                                </span>
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
