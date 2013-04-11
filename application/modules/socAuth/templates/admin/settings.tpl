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
                            <div class="control-group">
                                <label class="control-label">Использовать авторизацию через Google</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name="useGoogle"{if $settings['useGoogle'] == 'on'} checked="true"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <a href="https://accounts.google.com/o/oauth2/auth?redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socAuth/google&response_type=code&client_id={echo $settings['googleClientID']}&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile" 
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
                            <div class="control-group">
                                <label class="control-label">Использовать авторизацию через ВКонтакте</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name="useVk"{if $settings['useVk'] == 'on'} checked="true"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <a href="http://oauth.vk.com/authorize?client_id={echo $settings['vkClientID']}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socAuth/vk&response_type=code&scope=PERMISSIONS" 
                               title="Зайти через ВКонтакте">
                                Зайти через ВКонтакте
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
                        Настройки авторизации используя акаунт FaceBook
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
                                    <a href="https://developers.facebook.com/apps" target="_blank">Получить</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientID">Client ID:</label>
                                <div class="controls">
                                    <input type = "text" name = "facebookClientID" value = "{$settings['facebookClientID']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientSecret">Client secret:</label>
                                <div class="controls">
                                    <input type = "text" name = "facebookClientSecret" value = "{$settings['facebookClientSecret']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Использовать авторизацию через FaceBook</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name="useFaceBook"{if $settings['useFaceBook'] == 'on'} checked="true"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <a href="https://www.facebook.com/dialog/oauth?client_id={echo $settings['facebookClientID']}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socAuth/facebook&response_type=code" 
                               title="Зайти через FaceBook">
                                Зайти через FaceBook
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
                        Настройки авторизации используя акаунт Yandex
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
                                    <a href="https://oauth.yandex.ru/client/new" target="_blank">Получить</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientID">Client ID:</label>
                                <div class="controls">
                                    <input type = "text" name = "yandexClientID" value = "{$settings['yandexClientID']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientSecret">Client secret:</label>
                                <div class="controls">
                                    <input type = "text" name = "yandexClientSecret" value = "{$settings['yandexClientSecret']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Использовать авторизацию через Yandex</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name="useYandex"{if $settings['useYandex'] == 'on'} checked="true"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <a href="https://oauth.yandex.ru/authorize?response_type=code&client_id={$settings['yandexClientID']}" 
                               title="Яндекс">
                                Войти через Яндекс
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
                        Настройки авторизации используя акаунт Twitter
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="control-group">
                                <span class="control-label">
                                    <span data-title="&lt;b&gt;OAuth client ID&lt;/b&gt;" class="popover_ref" data-original-title="">
                                        <i class="icon-info-sign"></i>
                                    </span>
                                    <div class="d_n">Нужно получить 1 раз</div>&nbsp;Получить OAuth client ID:
                                </span>
                                <div class="controls">
                                    <a href="https://dev.twitter.com/apps/new" target="_blank">Получить</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="twitterConsumerKey">Consumer key:</label>
                                <div class="controls">
                                    <input type = "text" name = "twitterConsumerKey" value = "{$settings['twitterConsumerKey']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="twitterConsumerSecret">Consumer secret:</label>
                                <div class="controls">
                                    <input type = "text" name = "twitterConsumerSecret" value = "{$settings['twitterConsumerSecret']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="twitterCallbackURL">Callback URL:</label>
                                <div class="controls">
                                    <input type = "text" name = "twitterCallbackURL" value = "{$settings['twitterCallbackURL']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="twitterRequestTokenURL">Request token URL:</label>
                                <div class="controls">
                                    <input type = "text" name = "twitterRequestTokenURL" value = "{$settings['twitterRequestTokenURL']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="twitterAuthorizeURL">Authorize URL:</label>
                                <div class="controls">
                                    <input type = "text" name = "twitterAuthorizeURL" value = "{$settings['twitterAuthorizeURL']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="twitterAccessTokenURL">Access token URL:</label>
                                <div class="controls">
                                    <input type = "text" name = "twitterAccessTokenURL" value = "{$settings['twitterAccessTokenURL']}"/>
                                </div>
                            </div>

                            <a href="http://{echo $_SERVER[HTTP_HOST]}/socAuth/twitter" 
                               title="Зайти через Twitter">
                                Зайти через Twitter
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>