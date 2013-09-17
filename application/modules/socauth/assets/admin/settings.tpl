<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Authorization settings through third-party services', 'socauth')} </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'socauth')}</span></a>
                <button type="button" 
                        class="btn btn-small btn-primary action_on formSubmit" 
                        data-form="#settings_form" 
                        data-action="save">
                    <i class="icon-ok"></i>{lang('Save', 'socauth')}
                </button>
            </div>
        </div>                            
    </div>
    <form method="post" action="{site_url('admin/components/cp/socauth/update_settings')}" class="form-horizontal" id="settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                       {lang('Authorization settings using your Google account', 'socauth')}
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
                                    <div class="d_n">{lang('Need to get 1 time', 'socauth')}</div>&nbsp;{lang('Get', 'socauth')} OAuth2 client ID:
                                </span>
                                <div class="controls">
                                    <a href="https://code.google.com/apis/console#access" target="_blank">{lang('Get', 'socauth')}</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientID">Client ID:</label>
                                <div class="controls number">
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
                                <label class="control-label">{lang('Use authorization via Google', 'socauth')}</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name="useGoogle"{if $settings['useGoogle'] == 'on'} checked="true"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Use authorization via VK account', 'socauth')}
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
                                <div class="d_n">{lang('Need to get 1 time', 'socauth')}</div>&nbsp;{lang('Get', 'socauth')} OAuth2 client ID:
                                </span>
                                <div class="controls">
                                    <a href="http://vk.com/editapp?act=create" target="_blank">{lang('Get', 'socauth')}</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientID">Application ID:</label>
                                <div class="controls number">
                                    <input type = "text" name = "vkClientID" value = "{$settings['vkClientID']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientSecret">Secure key:</label>
                                <div class="controls">
                                    <input type = "text" name = "vkClientSecret" value = "{$settings['vkClientSecret']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"> {lang('Use authorization via VK', 'socauth')}</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name="useVk"{if $settings['useVk'] == 'on'} checked="true"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Authorization settings using your FaceBook account', 'socauth')}
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
                                     <div class="d_n">{lang('Need to get 1 time', 'socauth')}</div>&nbsp;{lang('Get', 'socauth')} OAuth2 client ID:
                                </span>
                                <div class="controls">
                                    <a href="https://developers.facebook.com/apps" target="_blank">{lang('Get', 'socauth')}</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientID">App ID:</label>
                                <div class="controls number">
                                    <input type = "text" name = "facebookClientID" value = "{$settings['facebookClientID']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientSecret">App Secret:</label>
                                <div class="controls">
                                    <input type = "text" name = "facebookClientSecret" value = "{$settings['facebookClientSecret']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">{lang('Use authorization via FaceBook', 'socauth')}</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name="useFaceBook"{if $settings['useFaceBook'] == 'on'} checked="true"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                         {lang('Authorization settings using your Yandex account', 'socauth')} 
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
                                     <div class="d_n">{lang('Need to get 1 time', 'socauth')}</div>&nbsp;{lang('Get', 'socauth')} OAuth2 client ID:
                                </span>
                                <div class="controls">
                                    <a href="https://oauth.yandex.ru/client/new" target="_blank">{lang('Get', 'socauth')}</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientID">{lang('Appication Id', 'socauth')}:</label>
                                <div class="controls number">
                                    <input type = "text" name = "yandexClientID" value = "{$settings['yandexClientID']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="ClientSecret">{lang('Appication password', 'socauth')}:</label>
                                <div class="controls">
                                    <input type = "text" name = "yandexClientSecret" value = "{$settings['yandexClientSecret']}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">{lang('Use authorization via Yandex', 'socauth')}</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name="useYandex"{if $settings['useYandex'] == 'on'} checked="true"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!--<table class="table table-striped table-bordered table-hover table-condensed">
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

                            <a href="http://{echo $_SERVER[HTTP_HOST]}/socauth/twitter" 
                               title="Зайти через Twitter">
                                Зайти через Twitter
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>-->
    </form>
</section>