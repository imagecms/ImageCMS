<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Full search', 'translator')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/init_window/translator"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'translator')}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <form method="post" action="{site_url('admin/components/init_window/translator/search')}"
                  class="form-horizontal m-t_15" id="search_form">
                <table class="table table-bordered table-hover table-condensed content_small_td table-translator-search">
                    <tbody>
                    <tr>
                        <td colspan="6">
                            <div id="searchPanel" class="clearfix">
                                <div class="pull-left">
                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Search string', 'translator')}
                                            :</label>

                                        <div class="controls">
                                            <input type="text" name="search" value="{echo $search}"
                                                   onkeydown="Search.run(this)">
                                            <button type="button" class="btn btn-small btn-default"
                                                    onclick="$('#search_form').submit()">
                                                <i class="icon-search"></i>
                                                {lang('Search', 'translator')}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {if $searchResultsCount}
                                    <div class="pull-right" style="margin-right: 50px;margin-top: 5px;">
                                        <span><b>{lang('Searched results', 'translator')}:</b></span>
                                        <span><b>{echo $searchResultsCount['total']}</b></span>
                                    </div>
                                {/if}
                                <div class="pull-left">
                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Search type', 'translator')}
                                            :</label>

                                        <div class="controls">
                                            <select name="searchType">
                                                <option value="all"
                                                        {if !$searchType OR $searchType=='all'}selected='selected'{/if}>
                                                    --{lang('All', 'admin')}--
                                                </option>
                                                <option value="origin"
                                                        {if $searchType AND $searchType=='origin'}selected='selected'{/if}>{lang('Origin', 'translator')}</option>
                                                <option value="translation"
                                                        {if $searchType AND $searchType=='translation'}selected='selected'{/if}>{lang('Translation', 'translator')}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>
                    </tr>
                    </tbody>
                </table>

                {if $searchResult}
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    {if $searchResult['modules']}
                        <li class="active">
                            <a href="#modules" data-toggle="tab">{lang('Modules', 'translator')} <span>({echo $searchResultsCount['modules']['total']})</span></a>
                        </li>
                    {/if}
                    {if $searchResult['templates']}
                        <li {if !$searchResult['modules']}class="active"{/if}>
                            <a href="#templates" data-toggle="tab">{lang('Templates', 'translator')} <span>({echo $searchResultsCount['templates']['total']})</span></a>
                        </li>
                    {/if}
                    {if $searchResult['main']}
                        <li {if !$searchResult['templates'] && !$searchResult['modules']}class="active"{/if}>
                            <a href="#main" data-toggle="tab">{lang('Main', 'translator')} <span>({echo $searchResultsCount['main']['total']})</span></a>
                        </li>
                    {/if}
                </ul>
                <div class="tab-content">
                    {if $searchResult['modules']}
                    <div class="tab-pane active" id="modules">
                        <p>
                            {foreach $searchResult['modules'] as $module => $locales}
                            {$module_info = $CI->load->module('admin/components')->get_module_info($module)}
                        <table class="table table-bordered table-hover table-condensed t-l_a">
                            <thead>
                            <tr>
                                <th colspan="5">
                                    {if $module=='admin'}
                                        {echo lang('Admin module', 'translator')}
                                    {else:}
                                        {echo $module_info['menu_name']}
                                    {/if}
                                </th>
                            </tr>
                            <tr>
                                <th class="span1">{lang('Language','translator')}</th>
                                <th>{lang('Origin','translator')}</th>
                                <th>{lang('Translation','translator')}</th>
                                <th class="span2">{lang('Actions','translator')}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach $locales as $locale => $data}
                                {foreach $data as $item}
                                    <tr>
                                        <td>
                                            {echo $languages[$locale]}
                                        </td>
                                        <td>
                                            <textarea rows="2" class="origin" style="max-height: 50px;"
                                                      readonly="readonly">{echo $item['origin']}</textarea>
                                        </td>
                                        <td>
                                            <textarea class="translation"
                                                      style="max-height: 50px;">{echo $item['translation']}</textarea>
                                        </td>
                                        <td class="share_alt">
                                            <button onclick="Search.updateOne(this)" type="button"
                                                    class="btn btn-small btn-primary m-r_5" data-type="modules"
                                                    data-name="{echo $module}" data-locale="{echo $locale}"
                                                    data-original-title="{lang('Save', 'translator')}"
                                                    data-rel="tooltip">
                                                <i class="icon-ok"></i>
                                            </button>
                                            <a href='{site_url("/admin/components/init_window/translator?name=" . $module . "&type=modules&lang=" . $locale . "")}'
                                               target="_blank" class="btn"
                                               data-original-title="{lang('Translation file','translator')}"
                                               data-rel="tooltip">
                                                <i class="icon-share-alt" style="top:-2px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                {/foreach}
                            {/foreach}
                            </tbody>
                        </table>
                        {/foreach}
                        </p>
                    </div>
                {/if}
                    {if $searchResult['templates']}
                        <div class="tab-pane {if !$searchResult['modules']} active{/if}" id="templates">
                            <p>
                                {foreach $searchResult['templates'] as $template => $locales}
                            <table class="table table-bordered table-hover table-condensed t-l_a">
                                <thead>
                                <tr>
                                    <th colspan="5">
                                        {echo $template}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="span1">{lang('Language','translator')}</th>
                                    <th>{lang('Origin','translator')}</th>
                                    <th>{lang('Translation','translator')}</th>
                                    <th class="span2">{lang('Actions','translator')}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {foreach $locales as $locale => $data}
                                    {foreach $data as $item}
                                        <tr>
                                            <td>
                                                {echo $languages[$locale]}
                                            </td>
                                            <td>
                                                <textarea rows="2" class="origin" style="max-height: 50px;"
                                                          readonly="readonly">{echo $item['origin']}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="translation"
                                                          style="max-height: 50px;">{echo $item['translation']}</textarea>
                                            </td>
                                            <td>
                                                <button onclick="Search.updateOne(this)" type="button"
                                                        class="btn btn-small btn-primary" data-type="templates"
                                                        data-name="{echo $template}" data-locale="{echo $locale}">
                                                    <i class="icon-ok"></i>
                                                    {lang('Save', 'translator')}
                                                </button>
                                                <a href='{site_url("/admin/components/init_window/translator?name=" . $template . "&type=templates&lang=" . $locale . "")}'
                                                   target="_blank"
                                                   class="btn btn-large">
                                                    {lang('Translation file','translator')}
                                                    <i class="icon-share-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    {/foreach}
                                {/foreach}
                                </tbody>
                            </table>
                            {/foreach}
                            </p>
                        </div>
                    {/if}
                    {if $searchResult['main']}
                        <div class="tab-pane {if !$searchResult['templates'] && !$searchResult['modules']} active{/if}" id="main">
                            <p>
                                {foreach $searchResult['main'] as $main => $locales}
                            <table class="table table-bordered table-hover table-condensed t-l_a">
                                <thead>
                                <tr>
                                    <th colspan="5">
                                        {echo lang('Main', 'translator')}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="span1">{lang('Language','translator')}</th>
                                    <th>{lang('Origin','translator')}</th>
                                    <th>{lang('Translation','translator')}</th>
                                    <th class="span2">{lang('Actions','translator')}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {foreach $locales as $locale => $data}
                                    {foreach $data as $item}
                                        <tr>
                                            <td>
                                                {echo $languages[$locale]}
                                            </td>
                                            <td>
                                                <textarea rows="2" class="origin" style="max-height: 50px;"
                                                          readonly="readonly">{echo $item['origin']}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="translation"
                                                          style="max-height: 50px;">{echo $item['translation']}</textarea>
                                            </td>
                                            <td>
                                                <button onclick="Search.updateOne(this)" type="button"
                                                        class="btn btn-small btn-primary" data-type="main"
                                                        data-name="main" data-locale="{echo $locale}">
                                                    <i class="icon-ok"></i>
                                                    {lang('Save', 'translator')}
                                                </button>
                                                <a href='{site_url("/admin/components/init_window/translator?name=main&type=main&lang=" . $locale . "")}'
                                                   target="_blank"
                                                   class="btn btn-large">
                                                    {lang('Translation file','translator')}
                                                    <i class="icon-share-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    {/foreach}
                                {/foreach}
                                </tbody>
                            </table>
                            {/foreach}
                            </p>
                        </div>
                    {/if}
        </div>
    </div>

    {else:}
</br>
{if $searchError}
                    <div class="alert alert-error">
                        {echo $searchError}
                    </div>
                {else:}
                    <div class="alert alert-info">
                        {lang('Empty search.','translator')}
                    </div>
                {/if}
                {/if}

                {form_csrf()}
            </form>
        </div>
    </section>
</div>
