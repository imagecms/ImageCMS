<script src="/application/modules/translator/assets/js/src-min/ace.js" type="text/javascript" charset="utf-8"></script>
<div class="modal hide fade modal_file_edit" style="width: 1000px;left: 33%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('File editing')}</h3>
    </div>
    <div class="modal-body">
        <!--div class="fileLines" style="float: left; height: 380px;overflow: hidden; min-width: 20px; padding-top: 4px;padding-bottom: 4px; padding-left: 5px; background-color: whitesmoke;border: 1px solid #ccc; -webkit-border-top-left-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; -moz-border-radius-left: 3px; border-bottom-left-radius: 3px; border-top-left-radius: 3px;"></div-->
        <!--textarea id="fileEdit" wrap="off" class="fileEdit " style="color: black; border-radius: initial; float: left;height: 390px; width: 925px; overflow: scroll;"></textarea-->
        <div id="fileEdit" class="fileEdit " style="color: black; border-radius: initial; float: left;height: 390px; width: 925px;">
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn btn-primary" onclick="Translator.saveEditingFile($(this))" >{lang('Save')}</a>
        <a class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
    </div>
</div>

<div class="modal hide fade modal_update_results">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Update results')}</h3>
    </div>
    <div class="modal-body">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#newStringsTab" data-toggle="tab">
                        <span class="parsedNewStringsCount" style="font-weight: bold"></span> {lang('strings wil be added')}</a>
                </li>
                <li><a href="#obsoleteStringsTab" data-toggle="tab">
                        <span class="parsedRemoveStringsCount" style="font-weight: bold"></span> {lang('strings will be removed')}</a>
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn btn-primary" onclick="Translator.update($(this));" >{lang('Update','admin')}</a>
        <a class="btn" onclick="$('.modal_update_results').modal('hide');">{lang('Cancel','admin')}</a>
    </div>
</div>
<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Langs', 'wishlist')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'wishlist')}</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <button id="cancel" disabled="" onclick="Translator.cancel()" type="button" class="btn btn-small action_on btn-primary pjax">
                        <i class="icon-share-alt"></i>
                        {lang('Reset')}
                    </button>
                    <button id="save" type="button" onclick="Translator.save()" class="btn btn-small btn-success pjax">
                        <i class="icon-ok"></i>
                        {lang('Save')}
                    </button>
                    <button id="update" onclick="Translator.parse($(this))" type="button" class="btn btn-small btn-success pjax">
                        <i class="icon-refresh"></i>
                        {lang('Update')}
                    </button>
                    <a href="/admin/components/init_window/translator/createFile" type="button" class="btn btn-small btn-success pjax">
                        <i class="icon-refresh"></i>
                        {lang('Create')}
                    </a>
                    <a href="/admin/components/init_window/translator/exchangeTranslation" type="button" class="btn btn-small btn-success pjax">
                        <i class="icon-refresh"></i>
                        {lang('Exchange')}
                    </a>
                    <button id="update" onclick="Translator.correctPaths($(this))" type="button" class="btn btn-small btn-success pjax">
                        <i class="icon-edit"></i>
                        {lang('Correct paths')}
                    </button>
                    <button id="update" onclick="Translator.translate($(this))" type="button" class="btn btn-small btn-success pjax">
                        <i class="icon-edit"></i>
                        {lang('Translate')}
                    </button>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">
            <div class="statistic" style="display: none; width: 302px; height: 50px; float: right; margin-top: 2px; margin-bottom: 2px;">
                <div class="pull-left">
                    <table class=" table-hover table-bordered" style="width: 140px; height: 50px; padding-left: 10px; border-left: 1px solid #ddd ">
                        <tr>
                            <td style="width: 90px; border: none!important"><b>{lang('All strings')}:</b></td>
                            <td style="width: 50px; border: none!important; color: grey"><b><i class="allStringsCount">300</i></b></td>
                            <td style="width: 100px; border: none!important"><b>{lang('Not translated')}:</b></td>
                            <td style="width: 50px; border: none!important; color: grey"><b><i class="notTranslatedStringsCount">300</i></b></td>
                        </tr>
                        <tr>
                            <td style="width: 90px; border: none!important"><b>{lang('Translated')}:</b></td>
                            <td style="width: 50px; border: none!important; color: grey"><b><i class="translatedStringsCount">400</i></b></td>
                            <td style="width: 100px; border: none!important"><b>{lang('Fuzzy strings')}:</b></td>
                            <td style="width: 50px; border: none!important; color: grey"><b><i class="fuzzyStringsCount">400</i></b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#poTab" data-toggle="tab">{lang('Po file')}</a></li>
                    <li><a href="#poSettingsTab" id="settings" data-toggle="tab">{lang('Settings')}</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="poTab">
                        <div class="pull-left poSelectorsHolder">
                            <div class="d-i_b">
                                <select id="langs" class="" onchange="Selectors.langs($(this))">
                                    {if $langs}
                                        <option value="">-- {lang('Choose locale')} --</option>
                                        {foreach $langs as $locale => $lang}
                                            <option class="{echo $locale}">{echo $locale}</option>
                                        {/foreach}
                                    {else:}
                                        <option>{lang('No locales')}</option>
                                    {/if}
                                </select>
                            </div>
                            <div class="d-i_b">
                                <select id="types" style="display: none" onchange="Selectors.types($(this))">
                                    <option  value="">-- {lang('Choose type')} --</option>
                                    <option class="modules" value="modules">{lang('Modules')}</option>
                                    <option class="templates" value="templates">{lang('Templates')}</option>
                                    <option class="main" value="main">{lang('Main')}</option>
                                </select>
                            </div>
                            <div class="d-i_b">
                                <select id="modules_templates" style="display: none" onchange="Selectors.names($(this))">

                                </select>
                            </div>
                        </div>
                        <div class="pull-right" style="position: relative; right: 150px">
                            <div class="input-append">
                                <input class="span2 searchString" id="appendedInputButtons" type="text">
                                <button id="searchTranslator" class="btn" type="button">Search</button>
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    {lang('Options')}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu searchTranslatorOptions" style="width: 430px; padding-left: 20px" >
                                    <label>
                                        <input id="sensitiveSearch" type="checkbox" class="searchConditions" disabled="">
                                        {lang('Sensitive search')}
                                    </label><br>
                                    <label>
                                        <input id="fullStringSearch" type="checkbox" class="searchConditions" disabled="">
                                        {lang('Whole word search')}
                                    </label><br>
                                    <label>
                                        <input id="regularSearch" type="checkbox" class="searchConditions" disabled="">
                                        {lang('Use regular expration search')}
                                    </label>

                                    <hr><br>

                                    <label>
                                        <input id="originSearch" type="checkbox" class="searchObjects">
                                        {lang('Search in origin strings')}
                                    </label><br>
                                    <label>
                                        <input id="translationSearch" type="checkbox" class="searchObjects">
                                        {lang('Search in translation strings')}
                                    </label><br>
                                    <label>
                                        <input id="commentSearch" type="checkbox" class="searchObjects">
                                        {lang('Search in comments strings')}
                                    </label>
                                </ul>
                            </div>
                        </div>

                        <table id="po_table" style="display: none" class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="t-a_c" style='width: 20px;'>
                                        <a class="fuzzy asc" onclick="Sort.sortFuzzy($(this))">{lang('Fuzzy')}</a>
                                    </th>
                                    <th class="span4 t-a_c">
                                        <a class="originHead sortTable asc" onclick="Sort.go($(this))">{lang('Origin', 'wishlist')}</a>
                                        /
                                        <a class="translation sortTable asc" onclick="Sort.go($(this))">{lang('Translation', 'wishlist')}</a>
                                        /
                                        <a class="defaultSort sortTable" onclick="Sort.default()">{lang('Default sort', 'wishlist')}</a>
                                    </th>
                                    <th style="width: 75px" class="commentTH t-a_c">
                                        <a class="comment sortTable asc" onclick="Sort.go($(this))">{lang('Comment', 'wishlist')}</a>
                                    </th>
                                    <th class="span2 t-a_c" class="linksTH">
                                        {lang('Links', 'wishlist')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <div class="alert alert-info" style="display: none">
                            {lang('There is no Po-file in such locale')}                        
                        </div>
                        <div class="alert alert-info fileNotExist" style="display: none; margin-top: 70px">
                            <span style="font-size:15px">{lang('File not exist')}...</span> 
                            <a style="color: #5bb75b; font-size: 15px" onclick="Translator.createFile($(this))"><i><b>{lang('Create file')}</b></i></a> 
                        </div>


                        <div class="clearfix">
                            <div class="pagination pull-left" style="display: none">
                                <ul>

                                </ul>
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
                            <label for="originLang" style="float: left; margin-top: -7px; margin-right: 10px">
                                <h5>
                                    <b>
                                        {lang('Origins language')}:
                                    </b>
                                </h5>
                            </label>
                            <select id="originLang" style="width: 80px" name="originLang" onchange="Translator.setOriginsLang($(this))">
                                <option value="0">- {lang('No')} -</option>
                                {foreach $locales as $lang}
                                    <option {if $settings['originsLang'] == $lang}selected{/if} value="{$lang}">
                                        {echo $lang}
                                    </option>
                                {/foreach}
                            </select>
                        </div>

                        <div class="YandexApiKeyHolder" style="float: right; margin-top: -35px;"> 
                            <label for="originLang" style="float: left; margin-top: -7px; margin-right: 10px">
                                <h5>
                                    <b>
                                        {lang('Yandex Api Key')}:
                                    </b>
                                </h5>
                            </label>
                            <textarea class="YandexApiKey"  style="width: 500px">{echo $settings['YandexApiKey']}</textarea>
                            <button onclick="Translator.addYandexApiKey($(this))"  type="button" class="btn btn-small btn-success">
                                <i class="icon-ok"></i>
                                {lang('Save')}
                            </button>
                        </div>

                        <form method="post" action="{site_url('admin/components/init_window/translator/createFile')}" class="form-horizontal" id="create_file_form">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="6">
                                            {lang('Po file settings')}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6">
                                            <div class="inside_padd">
                                                <div class="po_settings">

                                                </div>

                                                <div class="control-group pathParseHolder"  style="display: none">
                                                    <label class="control-label" for="file">{lang('Paths')}:</label>
                                                    <div class="controls" >
                                                        <div class="pathHolder span5" style="margin: 0px">
                                                        </div>

                                                        <div class="span13" style="margin-left: 22px; float: left">
                                                            <div class="addPathClone" style="display: none">
                                                                <div class="path">
                                                                    <b style="float: left; font-size: 15px; margin-right: 10px; margin-top: 3px; ">

                                                                    </b>
                                                                    <input type="text" name="path[]" style="width: 390px; margin-bottom: -10px;" value="">
                                                                    <div class="removePath" onclick="Translator.deletePath($(this))"><i class=" icon icon-remove-sign"></i></div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                            <button id="add" type="button" class="btn btn-small btn-success" onclick="Translator.addNewPath($(this))">
                                                                <i class="icon-plus"></i>
                                                                {lang('Add')}
                                                            </button>
                                                        </div>
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
                </div>
            </div>
        </div>
    </section>
</div>