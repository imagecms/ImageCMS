<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Модуль пример</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/sample_mail" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="button" class="btn btn-small formSubmit" data-form="#sample_module_settings"><i class="icon-ok"></i>{lang('a_save')}</button>
                    <button type="button" class="btn btn-small formSubmit" data-form="#sample_module_settings" data-action="tomain"><i class="icon-edit"></i>{lang('a_save_and_exit')}</button>
                        {echo create_language_select($languages, $locale, "/admin/components/cp/sample_mail/edit/".$model.name)}
                </div>
            </div>                            
        </div>
        <div class="tab-pane active" id="mail">
            <table class="table table-striped table-bordered table-hover table-condensed">
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
                                <div class="form-horizontal">
                                    <div class="row-fluid">
                                        <form id="sample_module_settings" method="post" action="{$BASE_URL}admin/components/cp/sample_module/settings">
                                            <div class="control-group">
                                                <label class="control-label" for="mailTo">Email Администратора</label>
                                                <div class="controls">
                                                    <input type="text" name="mailTo" id="mailTo" value="{$mailTo}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="useEmailNotification">Уведомлять по email</label>
                                                <div class="controls">
                                                    <select name="useEmailNotification">
                                                        <option {if $useEmailNotification == 'TRUE'}selected="selected"{/if} value="TRUE">Да</option>
                                                        <option {if $useEmailNotification == 'FALSE'}selected="selected"{/if}value="FALSE">Нет</option>
                                                    </select>                                                    
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="key">Секретный ключ</label>
                                                <div class="controls">
                                                    <input type="text" name="key" id="key" value="{$key}"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </section>
</div>
