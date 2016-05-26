<script src="/application/modules/translator/assets/js/src-min/ace.js" type="text/javascript" charset="utf-8"></script>

<div class="modal hide fade modal_yandex_translate">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Translation tool', 'translator')}</h3>
        <hr>
        <h4>{lang('Choose languages', 'translator')}:</h4>

        <div>
            <h5><b>{lang('Source', 'translator')}:</b></h5>
            <input class="languageSelect languageFrom" autocomplete="off" tabindex="1" value="" class="ui-autocomplete-input" aria-autocomplete="list" aria-haspopup="true">
            <button class="btn btn-small showAllLanguageList"><i class="icon-chevron-down"></i></button>
            <button class="btn btn-small languageAutoselect" data-rel="tooltip" data-placement="bottom" data-original-title="{lang('Auto define source language', 'translator')}" onclick="Translator.sourceLanguageAutoselect($(this))">
                <i class="icon-font"></i></button>
        </div>
        <div style="margin-top: 7px;">
            <h5><b>{lang('Result', 'translator')}:</b></h5>
            <input class="languageSelect languageTo" autocomplete="off" tabindex="1" value="" class="ui-autocomplete-input" aria-autocomplete="list" aria-haspopup="true">
            <button class="btn btn-small showAllLanguageList"><i class="icon-chevron-down"></i></button>
        </div>
    </div>
    <div class="modal-body">
        <label for="translation_text">
            <h5>{lang('Source text', 'translator')}:</h5>
        </label>
        <textarea id="translation_text" class="translation_text" rows="5"></textarea>
        <span class="icon-chevron-down"></span>
        <label for="translation_result">
            <h5>{lang('Translation text', 'translator')}:</h5>
        </label>
        <textarea id="translation_result" class="translation_result" rows="5"></textarea>
    </div>
    <div class="modal-footer">
        <div class="pull-right">
            <a class="btn btn-primary" onclick="Translator.yandexTranslate($(this))">{lang('Translate', 'translator')}</a>
            <a class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel', 'translator')}</a>
        </div>
    </div>
</div>


<div class="modal hide fade modal_file_edit">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('File editing', 'translator')}</h3>
        {if $editorStyles}
            <div>
                <h5>{lang('Editor theme', 'translator')}:</h5>
                <select class="editorTheme notchosen" onchange="AceEditor.changeTheme($(this))">
                    {foreach $editorStyles as $style}
                        <option {if $settings['editorTheme'] == $style}selected="selected"{/if} value="{echo $style}">{echo $style}</option>
                    {/foreach}
                </select>
            </div>
        {/if}
    </div>
    <div class="modal-body">
        <div id="fileEdit" class="fileEdit"></div>
    </div>
    <div class="modal-footer">
        <div class="pull-left" style="text-align: left">
            <span><b>{lang('Origin string', 'translator')}:</b></span>
            <a onclick="AceEditor.goToLang($(this))"><span class="originStringInFileEdit"></span></a>
            <br>
            <span><b>{lang('Line number', 'translator')}:</b></span>
            <a onclick="AceEditor.goToLang($(this))"><span class="originStringLineInFileEdit"></span></a>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" onclick="Translator.saveEditingFile($(this))">{lang('Save', 'translator')}</a>
            <a class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel', 'translator')}</a>
        </div>
    </div>
</div>

<div class="modal hide fade modal_update_results">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Update results', 'translator')}</h3>
    </div>
    <div class="modal-body">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#newStringsTab" data-toggle="tab">
                        <span class="parsedNewStringsCount"></span> {lang('string(s) wil be added', 'translator')}
                    </a>
                </li>
                <li>
                    <a href="#obsoleteStringsTab" data-toggle="tab">
                        <span class="parsedRemoveStringsCount"></span> {lang('string(s) will be removed', 'translator')}
                    </a>
                </li>
                <li style="display: none;" class="notCorrectStringsLI">
                    <a href="#notCorrectStringsTab" data-toggle="tab">
                        <span class="notCorrectStringsCount"></span> {lang('string(s) will be ignored', 'translator')}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="newStringsTab">
                    <div class="updateResults newStrings">
                    </div>
                </div>
                <div class="tab-pane" id="obsoleteStringsTab">
                    <div class="updateResults obsoleteStrings">
                    </div>
                </div>
                <div class="tab-pane" id="notCorrectStringsTab">
                    <div class="updateResults notCorrectStrings">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn btn-primary" onclick="Translator.update($(this));">{lang('Update', 'translator')}</a>
        <a class="btn" onclick="$('.modal_update_results').modal('hide');">{lang('Cancel', 'translator')}</a>
    </div>
</div>
<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Translator', 'translator')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'translator')}</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <button id="save" type="button" onclick="Translator.save()" class="btn btn-small btn-primary pjax">
                        <i class="icon-white icon-ok"></i>
                        {lang('Save', 'translator')}
                    </button>
                    <button id="update" onclick="Translator.parse($(this))" type="button" class="btn btn-small btn-success">
                        <i class="icon-white icon-refresh"></i>
                        {lang('Update', 'translator')}
                    </button>
                    {if !MAINSITE}
                    <a class="pjax btn btn-small btn-default" style="text-decoration: none" href="/admin/components/init_window/translator/search">
                        <i class="icon-white icon-search"></i>
                        {lang('Full search', 'translator')}
                    </a>
                    {/if}
                <span class="btn-group" style="display: inline-block;">
                    <button type="button" class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-list"></i>
                        {lang('Others', 'translator')}<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="left:auto;right: 0px;">
                        {if !MAINSITE}
                        <li>
                            <a style="text-decoration: none" href="/admin/components/init_window/translator/createFile">{lang('Create translation file', 'translator')}</a>
                        </li>
                        <li>
                            <a style="text-decoration: none" href="/admin/components/init_window/translator/exchangeTranslation">{lang('Translation exchange', 'translator')}</a>
                        </li>
                        <li><a onclick="Translator.correctPaths($(this))">{lang('Correct paths', 'translator')}</a></li>
                        <li class="divider"></li>
                        {/if}

                        <li><a onclick="Translator.translate($(this))">{lang('Translate all', 'translator')}</a></li>
                        <li>
                            <a onclick="Translator.translate($(this), true)">{lang('Translate untranslated', 'translator')}</a>
                        </li>
                        <li>
                            <a onclick="Translator.showYandexTranslateWindow()">{lang('Translation tool', 'translator')}</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a style="text-decoration: none" href="/admin/components/init_window/translator/settings">{lang('Settings', 'translator')}</a>
                        </li>
                        <li class="divider"></li>
                        <li><a onclick="Translator.cancel()">{lang('Clear translator memory', 'translator')}</a></li>
                    </ul>
                </span>
                </div>
            </div>
        </div>
        <div class="row-fluid">


            <div class="statistic">
                <table class="table-bordered">
                    <tr>
                        <td><b>{lang('All strings', 'translator')}: <span class="allStringsCount"></span></b></td>
                        <td><b>{lang('Fuzzy strings', 'translator')}: <span class="fuzzyStringsCount"></span></b></td>
                        <td><b>{lang('Translated', 'translator')}: <span class="translatedStringsCount"></span></b></td>
                        <td><b>{lang('Not translated', 'translator')}:
                                <span class="notTranslatedStringsCount"></span></b></td>
                    </tr>
                </table>
            </div>


            <div class="tabbable m-t_15"> <!-- Only required for left/right tabs -->
                <div class="myTab btn-group" data-toggle="buttons-radio">
                    <a href="#poTab" class="btn btn-small active">{lang('Translation file', 'translator')}</a>
                    <a href="#poSettingsTab" id="settings" class="btn btn-small">{lang('Translation file settings', 'translator')}</a>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="poTab">
                        <div class="pull-left poSelectorsHolder">
                            <div class="d-i_b">
                                <select id="langs" onchange="Selectors.langs($(this)); {if MAINSITE}Selectors.types($('#types')){/if}" class="notchosen">
                                    {if $langs}
                                        <option value="">-- {lang('Choose locale', 'translator')} --</option>
                                        {foreach $langs as $locale}
                                            <option class="{echo $locale}">{echo $locale}</option>
                                        {/foreach}
                                    {else:}
                                        <option>{lang('No locales', 'translator')}</option>
                                    {/if}
                                </select>
                            </div>
                            <div class="d-i_b">
                                <select id="types" style="display: none" onchange="Selectors.types($(this))" class="notchosen">
                                    {if !MAINSITE}
                                    <option value="">-- {lang('Choose type', 'translator')} --</option>
                                    <option class="main" value="main">{lang('Main', 'translator')}</option>
                                    <option class="modules" value="modules">{lang('Modules', 'translator')}</option>
                                    {/if}
                                    <option class="templates" value="templates">{lang('Templates', 'translator')}</option>
                                </select>
                            </div>
                            <div class="d-i_b">
                                <select id="modules_templates" style="display: none" class="notchosen" onchange="Selectors.names($(this))">
                                    {echo $names}
                                </select>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="input-append poSearchHolder">
                                <input class="span2 searchString" placeholder="{lang('Please, enter search string...', 'translator')}" onkeypress="Search.goOnEnterPress()" id="appendedInputButtons" type="text">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    {lang('Options', 'translator')}
                                    <span class="caret"></span>
                                </a>
                                <button id="searchTranslator" class="btn" type="button">
                                    <i class="icon-search" style="margin-right: 0;"></i></button>
                                <ul class="dropdown-menu searchTranslatorOptions">
                                    <label>
                                        <input id="sensitiveSearch" type="checkbox" class="searchConditions">
                                        {lang('Sensitive search', 'translator')}
                                    </label><br>
                                    <label>
                                        <input id="fullStringSearch" type="checkbox" class="searchConditions">
                                        {lang('Whole word search', 'translator')}
                                    </label><br>
                                    <label>
                                        <input id="regularSearch" type="checkbox" class="searchConditions">
                                        {lang('Use regular expration search', 'translator')}
                                    </label>

                                    <hr>
                                    <br>

                                    <label>
                                        <input id="originSearch" type="checkbox" checked="ckecked" class="searchObjects">
                                        {lang('Search in origin strings', 'translator')}
                                    </label><br>
                                    <label>
                                        <input id="translationSearch" type="checkbox" checked="ckecked" class="searchObjects">
                                        {lang('Search in translation strings', 'translator')}
                                    </label><br>
                                    <label>
                                        <input id="commentSearch" type="checkbox" checked="ckecked" class="searchObjects">
                                        {lang('Search in comments strings', 'translator')}
                                    </label>
                                </ul>
                            </div>
                        </div>

                        <table id="po_table" class="table  table-bordered table-condensed t-l_a">
                            <thead>
                            <tr>
                                <th style="width: 50px">
                                    <a class="fuzzy sortTable" onclick="Sort.sortFuzzy($(this))">{lang('Fuzzy', 'translator')}
                                        <span class="f-s_14 asc">↑</span>
                                        <span class="f-s_14 desc">↓</span>
                                    </a>
                                </th>
                                <th class="t-a_c">
                                    <a class="originHead sortTable" onclick="Sort.go($(this))">{lang('Origin', 'translator', 'wishlist')}
                                        <span class="f-s_14 asc">↑</span>
                                        <span class="f-s_14 desc">↓</span>
                                    </a>
                                    /
                                    <a class="translation sortTable" onclick="Sort.go($(this))">{lang('Translation', 'translator')}
                                        <span class="f-s_14 asc">↑</span>
                                        <span class="f-s_14 desc">↓</span>
                                    </a>
                                    /
                                    <a class="defaultSort sortTable" onclick="Sort.default($(this))">{lang('Default sort', 'translator')}</a>
                                </th>
                                <th class="commentTH t-a_c">
                                    <a class="comment sortTable" onclick="Sort.go($(this))">{lang('Comment', 'translator')}
                                        <span class="f-s_14 asc">↑</span>
                                        <span class="f-s_14 desc">↓</span>
                                    </a>
                                </th>
                                <th class="span3 t-a_c" class="linksTH">
                                    {lang('Paths to contains files', 'translator')}
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <div class="alert alert-info" style="display: none">
                            {lang('There is no Po-file in such locale', 'translator')}
                        </div>
                        <div class="alert alert-error fileNotExist">
                            <span class="errors"></span>
                            <a class="needToCreate" onclick="Translator.createFile($(this))"><i><b>{lang('Create file', 'translator')}</b></i></a>
                        </div>


                        <div class="clearfix">
                            <div class="pagination pull-left" style="display: none">
                                <ul></ul>
                            </div>
                            <div class="pagination pull-right">
                                <select id="per_page" style="max-width:60px; display: none" onchange="Pagination.perPage()" class="notchosen">
                                    <option class="per_page10" value="10">10</option>
                                    <option class="per_page20" value="20">20</option>
                                    <option class="per_page30" value="30">30</option>
                                    <option class="per_page40" value="40">40</option>
                                    <option class="per_page50" value="50">50</option>
                                    <option class="per_page60" value="60">60</option>
                                    <option class="per_page70" value="70">70</option>
                                    <option class="per_page80" value="80">80</option>
                                    <option class="per_page90" value="90">90</option>
                                    <option class="per_page100" value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="poSettingsTab">
                        <div style="display: none;">
                            <div class="originLangHolder">
                                <label for="originLang">
                                    <h5>
                                        <b>
                                            {lang('Origins language', 'translator')}:
                                        </b>
                                    </h5>
                                </label>
                                <input id="originLang" class="languageSelect languageFrom" autocomplete="off" tabindex="1" value="{echo $languages_names[$settings['originsLang']]}" class="ui-autocomplete-input" aria-autocomplete="list" aria-haspopup="true" locale="{echo $settings['originsLang']}">
                                <button class="btn btn-small showAllLanguageList"><i class="icon-chevron-down"></i>
                                </button>
                                <button class="btn btn-small languageAutoselect" data-rel="tooltip" data-placement="bottom" data-original-title="{lang('Auto define source language', 'translator')}" onclick="Translator.sourceLanguageAutoselect($(this))">
                                    <i class="icon-font"></i></button>
                            </div>

                            <div class="YandexApiKeyHolder">
                                <label for="originLang">
                                    <h5>
                                        <b>
                                            {lang('Yandex Api Key', 'translator')}:
                                        </b>
                                    </h5>
                                    <a href="http://api.yandex.ru/translate/" target="blanck">{lang('Get Yandex Api key', 'translator')}</a>
                                </label>
                                <textarea class="YandexApiKey">{echo $settings['YandexApiKey']}</textarea>
                                <button onclick="Translator.addYandexApiKey($(this))" type="button" class="btn btn-small btn-primary">
                                    <i class="icon-ok"></i>
                                    {lang('Save', 'translator')}
                                </button>
                            </div>
                            <br>
                            <hr>
                        </div>
                        <form method="post" action="{site_url('admin/components/init_window/translator/createFile')}" class="form-horizontal" id="po_settings_form">
                            <table style="width: 49%; float: left;" class="table  table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <tr style="height: 48px;">
                                    <th colspan="6">
                                        {lang('Translation file information', 'translator')}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="po_settings"></div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <br>

                            <div class="" style="width: 49%; float: right; margin-top: -18px;">
                                <table class="po_path_table table  table-bordered table-hover table-condensed t-l_a">
                                    <thead>
                                    <tr>
                                        <th colspan="3">
                                            <h5 style="float: left">
                                                <b style="color: black;">
                                                    {lang('Searched langs paths', 'translator')}
                                                </b>
                                                 <span data-title="{lang('Paths usage', 'translator')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>

                                                <div class="d_n">
                                                    {lang('Paths define where to search phrases for translation. Folder location which contains files with this phrases.', 'translator')}
                                                    <br/>
                                                    <b>{lang('Basic path', 'translator')}</b>
                                                    - {lang('Defines relatively to .po file location(folder), which contains translation phrases.', 'translator')}
                                                    <br/>

                                                    <b>{lang('Additional paths', 'translator')}</b>
                                                    - {lang('Defines additional locations to search translation phrases. From location where points main path.', 'translator')}
                                                    <br/>

                                                    <b>{lang('All paths must be relative', 'translator')}</b>
                                                    <br/>

                                                </div>
                                            </h5>

                                            <div class="additionalSearchPaths" style="float: right; margin-top: 5px; font-weight: normal">
                                                <span data-title="{lang('Additional searched paths', 'translator')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>

                                                <div class="d_n">
                                                    {lang('You can hold and translate phrases from modules and Main translation file in this file', 'translator')}
                                                    .<br/>
                                                    {lang('Choose one from list, it will be added', 'translator')}.
                                                </div>
                                                <select onchange="Translator.addAdditionalPath(this)" style="width: 300px;">
                                                    <option value="">
                                                        -- {lang('Add additional search place','translator')} --
                                                    </option>
                                                    <option value="main">{lang('Main', 'translator')}</option>
                                                    {foreach $modules as $module}
                                                        <option value="{echo $module['com_name']}">{echo lang('Module', 'translator')}
                                                            : {echo $module['menu_name']}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="span1">
                                            №
                                        </th>
                                        <th class="span5">
                                            {lang('Path', 'translator')}
                                        </th>
                                        <th class="span2">
                                            {lang('Delete', 'translator')}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="pathParseHolder">

                                    </tbody>
                                </table>

                                <div class="inside_padd translate-source">
                                    <button id="add" type="button" class="btn" onclick="Translator.addNewPath($(this))">
                                        <i class="icon-plus"></i>
                                        {lang('Add', 'translator')}
                                    </button>
                                </div>


                            </div>
                            {form_csrf()}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>