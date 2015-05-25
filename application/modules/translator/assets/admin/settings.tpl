<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Translator settings', 'translator')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/init_window/translator"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'admin')}</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#settings_form">
                        <i class="icon-ok"></i>
                        {lang('Save', 'translator')}
                    </button>
                    <button type="button" class="btn btn-small btn-default action_on formSubmit" data-action="exit" data-form="#settings_form">
                        <i class="icon-check"></i>
                        {lang('Save and exit', 'admin')}
                    </button>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <form method="post" action="{site_url('admin/components/init_window/translator/settings')}" class="form-horizontal" id="settings_form">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Settings', 'translator')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">

                                    <div class="control-group">
                                        <label for="file" style="" class="control-label">
                                            <span class="span4">
                                                <span data-title="{lang('Information', 'translator')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    {lang('Language name of source string which need to translate.', 'translator')}
                                                </div>
                                                {lang('Origins language', 'translator')}:
                                            </span>
                                        </label>

                                        <div class="controls">
                                            <input id="originLang" class="languageSelect languageFrom" autocomplete="off" value="{echo $languages_names[$settings['originsLang']]}" class="ui-autocomplete-input" aria-autocomplete="list" aria-haspopup="true">
                                            <button class="btn btn-small showAllLanguageList"><i class="icon-chevron-down"></i></button>
                                            <input type="hidden" name="settings[originsLang]" value="{echo $settings['originsLang']}">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">
                                            <span class="span4">
                                                <span data-title="{lang('Information', 'translator')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    {lang('Key that needed for translation with Yandex Translation Api service.', 'translator')}
                                                </div>
                                                {lang('Yandex Api Key', 'translator')}:
                                            </span>
                                        </label>
                                        <div class="controls">
                                            <textarea class="YandexApiKey" cols="80" name="settings[YandexApiKey]">{echo $settings['YandexApiKey']}</textarea>
                                            <a href="https://tech.yandex.ru/keys/get/?service=trnsl" target="blanck">{lang('Get Yandex Api key', 'translator')}</a>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">
                                            <span class="span4">
                                                <span data-title="{lang('Usage', 'translator')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    {lang('To display translation form press Ctrl+Alt and move mouse cursor on string title.', 'translator')}
                                                </div>
                                                {lang('Show fast translation form', 'translator')}:
                                            </span>
                                        </label>

                                        <div class="controls">
                                            <span class="frame_label no_connection">
                                                <br>
                                                <span class="niceCheck {if $settings['showApiForm']}active{/if}" style="background-position: -46px 0px;">
                                                    <input type="checkbox" name="settings[showApiForm]" {if $settings['showApiForm']}checked="checked" {/if} value="1">
                                                </span>
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
        </div>
    </section>
</div>