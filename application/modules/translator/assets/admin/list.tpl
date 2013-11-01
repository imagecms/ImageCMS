<div class="modal hide fade modal_file_edit">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Delete products','admin')}</h3>
    </div>
    <div class="modal-body">
        <textarea class=""></textarea>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$ADMIN_URL}products/ajaxDeleteProducts')" >{lang('Delete','admin')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
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
                <li class="active"><a href="#newStringsTab" data-toggle="tab">{lang('New strings')}</a></li>
                <li><a href="#obsoleteStringsTab" data-toggle="tab">{lang('Obsolete strings')}</a></li>
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
                    <button id="cancel" disabled="" onclick="Translator.cancel()" type="button" class="btn btn-small action_on btn-primary">
                        <i class="icon-share-alt"></i>
                        {lang('Cancel')}
                    </button>
                    <button id="save" type="button" onclick="Translator.save()" class="btn btn-small btn-success">
                        <i class="icon-ok"></i>
                        {lang('Save')}
                    </button>
                    <button id="update" onclick="Translator.parse($(this))" type="button" class="btn btn-small btn-success">
                        <i class="icon-refresh"></i>
                        {lang('Update')}
                    </button>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#poTab" data-toggle="tab">{lang('Po file')}</a></li>
                    <li><a href="#poSettingsTab" id="settings" data-toggle="tab">{lang('Settings')}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="poTab">
                        <div class="pull-left">
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
                                        <input id="sensitiveSearch" type="checkbox">
                                        {lang('Sensitive search')}
                                    </label><br>
                                    <label>
                                        <input id="fullStringSearch" type="checkbox">
                                        {lang('Whole word search')}
                                    </label><br>
                                    <label>
                                        <input id="regularSearch" type="checkbox">
                                        {lang('Use regular expration search')}
                                    </label><br>
                                    <label>
                                        <input id="originSearch" type="checkbox">
                                        {lang('Search in origin strings')}
                                    </label><br>
                                    <label>
                                        <input id="translationSearch" type="checkbox">
                                        {lang('Search in translation strings')}
                                    </label><br>
                                    <label>
                                        <input id="commentSearch" type="checkbox">
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
                                    <th class="span4">
                                        <a class="originHead sortTable asc" onclick="Sort.go($(this))">{lang('Origin', 'wishlist')}</a>
                                        /
                                        <a class="translation sortTable asc" onclick="Sort.go($(this))">{lang('Translation', 'wishlist')}</a>
                                        /
                                        <a class="defaultSort sortTable" onclick="Sort.default()">{lang('Default sort', 'wishlist')}</a>
                                    </th>
                                    <th style="width: 75px">
                                        <a class="comment sortTable asc" onclick="Sort.go($(this))">{lang('Comment', 'wishlist')}</a>
                                    </th>
                                    <th class="span2">
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
                            <select id="originLang" style="width: 60px" name="originLang" onchange="Translator.setOriginsLang($(this))">
                                <option value="0">- {lang('No')} -</option>
                                {foreach $locales as $lang}
                                    <option {if $settings['originsLang'] == $lang}selected{/if} value="{$lang}">
                                        {echo $lang}
                                    </option>
                                {/foreach}
                            </select>
                        </div>
                            <div class="pathParseHolder" style="display: none">
                            <label>
                                <h5>
                                    <b>
                                        {lang('Parser paths')}:
                                    </b>
                                </h5>
                            </label>
                            <div class="pathHolder span5" style="margin: 0px">

                            </div>

                            <div class="span13" style="margin-left: 22px;">
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
            </div>

        </div>
    </section>
</div>