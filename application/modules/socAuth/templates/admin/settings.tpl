<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки авторизации через посторонние сервисы </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#settings_form" data-action="save"><i class="icon-ok"></i>{lang('a_save')}</button>
            </div>
        </div>                            
    </div>
    <form method="post" action="{site_url('admin/components/cp/socAuth/update_settings')}" class="form-horizontal" id="settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        Настройки авторизации используя акаунт Google
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="control-group">
                                <span class="control-label">
                                    <span data-title="&lt;b&gt;OAuth2 client ID&lt;/b&gt;" class="popover_ref" data-original-title="">
                                        <i class="icon-info-sign"></i>
                                    </span>
                                    <div class="d_n">Нужно получить 1 раз</div>&nbsp;Получить OAuth2 client ID:
                                </span>
                                <div class="controls">
                                    <a href="https://code.google.com/apis/console#access" target="_blank">Получить</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientID">Client ID:</label>
                                <div class="controls">
                                    <input type = "text" name = "googleClientID" value = "{$settings['googleClientID']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientSecret">Client secret:</label>
                                <div class="controls">
                                    <input type = "text" name = "googleClientSecret" value = "{$settings['googleClientSecret']}"/>
                                </div>
                            </div>
                            <a href="https://accounts.google.com/o/oauth2/auth?redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socAuth&response_type=code&client_id={echo $settings['googleClientID']}&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile" 
                               title="Войти через Google">
                                Войти через Google
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        Настройки авторизации используя акаунт VK
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="control-group">
                                <span class="control-label">
                                    <span data-title="&lt;b&gt;OAuth2 client ID&lt;/b&gt;" class="popover_ref" data-original-title="">
                                        <i class="icon-info-sign"></i>
                                    </span>
                                    <div class="d_n">Нужно получить 1 раз</div>&nbsp;Получить OAuth2 client ID:
                                </span>
                                <div class="controls">
                                    <a href="http://vk.com/editapp?act=create" target="_blank">Получить</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientID">Client ID:</label>
                                <div class="controls">
                                    <input type = "text" name = "vkClientID" value = "{$settings['vkClientID']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientSecret">Client secret:</label>
                                <div class="controls">
                                    <input type = "text" name = "vkClientSecret" value = "{$settings['vkClientSecret']}"/>
                                </div>
                            </div>
                            <a href="http://oauth.vk.com/authorize?client_id={echo $settings['vkClientID']}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socAuth&response_type=code&scope=PERMISSIONS" 
                               title="Зайти через ВКонтакте">
                                Зайти через ВКонтакте
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>