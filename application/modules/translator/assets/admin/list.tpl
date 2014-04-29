<script src="/application/modules/translator/assets/js/src-min/ace.js" type="text/javascript" charset="utf-8"></script>
<div class="modal hide fade modal_file_edit">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('File editing', 'translator')}</h3>
        {if $editorStyles}
            <div>
                <h5>{lang('Editor theme', 'translator')}:</h5>
                <select class="editorTheme" onchange="AceEditor.changeTheme($(this))">
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
            <a class="btn btn-primary" onclick="Translator.saveEditingFile($(this))" >{lang('Save', 'translator')}</a>
            <a class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel', 'translator')}</a>
        </div>
    </div>
</div>

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
            <button class="btn btn-small languageAutoselect" data-rel="tooltip" data-placement="bottom" data-original-title="{lang('Auto define source language', 'translator')}" onclick="Translator.sourceLanguageAutoselect($(this))"><i class="icon-font"></i></button>
        </div>
        <div class="pull-right" style="margin-top: -35px;">
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
            <a class="btn btn-primary" onclick="Translator.yandexTranslate($(this))" >{lang('Translate', 'translator')}</a>
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
        <a class="btn btn-primary" onclick="Translator.update($(this));" >{lang('Update', 'translator','admin')}</a>
        <a class="btn" onclick="$('.modal_update_results').modal('hide');">{lang('Cancel', 'translator','admin')}</a>
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
                    <span class="btn-group">
                        <button type="button" class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown" style="margin-top: -5px;">
                            <i class="icon-white icon-list"></i>
                            {lang('Others', 'translator')}<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="pjax" style="text-decoration: none" href="/admin/components/init_window/translator/createFile">{lang('Create', 'translator')}</a></li>
                            <li><a class="pjax" style="text-decoration: none" href="/admin/components/init_window/translator/exchangeTranslation">{lang('Translation exchange', 'translator')}</a></li>
                            <li><a onclick="Translator.correctPaths($(this))">{lang('Correct paths', 'translator')}</a></li>
                            <li class="divider"></li>
                            <li><a onclick="Translator.translate($(this))">{lang('Translate all', 'translator')}</a></li>
                            <li><a onclick="Translator.translate($(this), true)">{lang('Translate untranslated', 'translator')}</a></li>
                            <li><a onclick="Translator.showYandexTranslateWindow()">{lang('Translation tool', 'translator')}</a></li>
                            <li class="divider"></li>
                            <li><a onclick="Translator.cancel()">{lang('Reset', 'translator')}</a></li>
                        </ul>
                    </span>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">
            <div class="statistic">
                <div class="statisticTitle">
                    <h5>
                        <b>{lang('Statistic', 'translator')}:</b>     
                    </h5>
                </div>
                <div class="pull-left">
                    <table class=" table-hover table-bordered">
                        <tr>
                            <td style="width: 90px;"><b>{lang('All strings', 'translator')}:</b></td>
                            <td style="width: 50px; color: grey"><b><i class="allStringsCount"></i></b></td>
                            <td style="width: 100px;"><b>{lang('Fuzzy strings', 'translator')}:</b></td>
                            <td style="width: 50px; color: grey"><b><i class="fuzzyStringsCount"></i></b></td>

                        </tr>
                        <tr>
                            <td style="width: 90px;"><b>{lang('Translated', 'translator')}:</b></td>
                            <td style="width: 50px; color: grey"><b><i class="translatedStringsCount"></i></b></td>
                            <td style="width: 100px;"><b>{lang('Not translated', 'translator')}:</b></td>
                            <td style="width: 50px; color: grey"><b><i class="notTranslatedStringsCount"></i></b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#poTab" data-toggle="tab">{lang('Translation file', 'translator')}</a></li>
                    <li><a href="#poSettingsTab" id="settings" data-toggle="tab">{lang('Settings', 'translator')}</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="poTab">
                        <div class="pull-left poSelectorsHolder">
                            <div class="d-i_b">
                                <select id="langs" onchange="Selectors.langs($(this))">
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
                                <select id="types" style="display: none" onchange="Selectors.types($(this))">
                                    <option  value="">-- {lang('Choose type', 'translator')} --</option>
                                    <option class="modules" value="modules">{lang('Modules', 'translator')}</option>
                                    <option class="templates" value="templates">{lang('Templates', 'translator')}</option>
                                    <option class="main" value="main">{lang('Main', 'translator')}</option>
                                </select>
                            </div>
                            <div class="d-i_b">
                                <select id="modules_templates" style="display: none" onchange="Selectors.names($(this))">
                                </select>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="input-append poSearchHolder">
                                <input class="span2 searchString" placeholder="{lang('Please, enter search string...', 'translator')}" onkeypress="Search.goOnEnterPress()" id="appendedInputButtons" type="text">
                                <button id="searchTranslator" class="btn" type="button">{lang('Search', 'translator')}</button>
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    {lang('Options', 'translator')}
                                    <span class="caret"></span>
                                </a>
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

                                    <hr><br>

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
                        <hr>
                        <table id="po_table" class="table table-striped table-bordered table-hover table-condensed t-l_a">
                            <thead>
                                <tr>
                                    <th style="width: 50px">
                                        <a class="fuzzy sortTable" onclick="Sort.sortFuzzy($(this))">{lang('Fuzzy', 'translator')}
                                            <span class="f-s_14 asc" >↑</span>
                                            <span class="f-s_14 desc" >↓</span>
                                        </a>
                                    </th>
                                    <th class="t-a_c">
                                        <a class="originHead sortTable" onclick="Sort.go($(this))">{lang('Origin', 'translator', 'wishlist')}
                                            <span class="f-s_14 asc" >↑</span>
                                            <span class="f-s_14 desc" >↓</span>
                                        </a>
                                        /
                                        <a class="translation sortTable" onclick="Sort.go($(this))">{lang('Translation', 'translator')}
                                            <span class="f-s_14 asc" >↑</span>
                                            <span class="f-s_14 desc" >↓</span>
                                        </a>
                                        /
                                        <a class="defaultSort sortTable" onclick="Sort.default($(this))">{lang('Default sort', 'translator')}</a>
                                    </th>
                                    <th class="commentTH t-a_c">
                                        <a class="comment sortTable" onclick="Sort.go($(this))">{lang('Comment', 'translator')}
                                            <span class="f-s_14 asc" >↑</span>
                                            <span class="f-s_14 desc" >↓</span>
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
                            <div class="pagination pull-right" style="margin-right: 25px;">
                                <select id="per_page" style="max-width:60px; display: none" onchange="Pagination.perPage()" >
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

                        <div class="originLangHolder">
                            <label for="originLang">
                                <h5>
                                    <b>
                                        {lang('Origins language', 'translator')}:
                                    </b>
                                </h5>
                            </label>
                            <input id="originLang" class="languageSelect languageFrom" autocomplete="off" tabindex="1" value="{echo $languages_names[$settings['originsLang']]}" class="ui-autocomplete-input" aria-autocomplete="list" aria-haspopup="true" locale="{echo $settings['originsLang']}">
                            <button class="btn btn-small showAllLanguageList"><i class="icon-chevron-down"></i></button>
                            <button class="btn btn-small languageAutoselect" data-rel="tooltip" data-placement="bottom" data-original-title="{lang('Auto define source language', 'translator')}" onclick="Translator.sourceLanguageAutoselect($(this))"><i class="icon-font"></i></button>
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
                            <button onclick="Translator.addYandexApiKey($(this))"  type="button" class="btn btn-small btn-success">
                                <i class="icon-ok"></i>
                                {lang('Save', 'translator')}
                            </button>
                        </div>
                        <br>
                        <hr>

                        <form method="post" action="{site_url('admin/components/init_window/translator/createFile')}" class="form-horizontal" id="po_settings_form">
                            <table style="width: 49%; float: left;" class="table table-striped table-bordered table-hover table-condensed t-l_a">
                                <thead>
                                    <tr>
                                        <th>
                                            {lang('Translation file information', 'translator')}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6">
                                            <div class="inside_padd span9">
                                                <div class="po_settings"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <br>
                            <table style="width: 49%; float: right; margin-top: -28px;" class="po_path_table table table-striped table-bordered table-hover table-condensed t-l_a">
                                <caption>
                                    <b><h5>{lang('Searched langs paths', 'translator')}</h5></b>
                                </caption>
                                <thead>
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
                            <button style="float: right" id="add" type="button" class="btn btn-small btn-success" onclick="Translator.addNewPath($(this))">
                                <i class="icon-plus"></i>
                                {lang('Add', 'translator')}
                            </button>

                            {form_csrf()}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>