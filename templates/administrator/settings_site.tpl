
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Global settings','admin')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <!--<a href="/admin/dashboard" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back","admin")}</span></a>-->
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#saveSettings" data-action="edit" data-submit>
                        <i class="icon-ok icon-white"></i>{lang("Save","admin")}</button>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3 m-t_10">
                <ul class="nav myTab nav-tabs nav-stacked">
                    <li class="active"><a href="#setings">{lang('General Settings',"admin")}</a></li>
                    <li><a href="#seo">{lang('Analysts settings', 'admin')}</a></li>
                    <li><a href="#homePage">{lang('Main page','admin')}</a></li>
                    <li><a href="#metatag">{lang('Management of Meta Tags','admin')}</a></li>
                    <li><a href="#metatag_edit">{lang('Enter Meta Tags','admin')}</a></li>
                    <li><a href="#site_info_tab">{lang('Site information','admin')}</a></li>
                    <li><a href="#users_registration">{lang('Users registration','admin')}</a></li>
                </ul>
            </div>
            <div class="span9">
                <form action="{$BASE_URL}admin/settings/save" method="post" id="saveSettings">
                    <div class="tab-content">
                        <div class="tab-pane active" id="setings">
                            <table class="table  table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('General Settings',"admin")}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="site_offline">{lang('Site shutdown', 'admin')}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="site_offline" id="site_offline">
                                                                {foreach $work_values as $k => $v}
                                                                    <option value="{$k}" {if $site_offline == $k} selected="selected" {/if} >{$v}</option>
                                                                {/foreach}
                                                            </select>
                                                                <span class="help-block">
                                                                    {lang('The site will be available only to the Administrator', 'admin')}
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="lang_sel">{lang('Select admin language', "admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="lang_sel" id="lang_sel">
                                                                {foreach $langs as $language}
                                                                    <option value="{echo $language['locale']}" {if $lang_sel == $language['locale']}selected="selected"{/if}> {echo $language['lang_name']}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    {if !defined('MAINSITE')}
                                                        <div class="control-group">
                                                            <label class="control-label" for="template">{lang('Template', 'admin')}
                                                                :</label>

                                                            <div class="controls">
                                                                <select name="template" id="template" onchange="$('#license_agreement_link').attr('href', '/admin/settings/license_agreement?template_name=' + $(this).val())">
                                                                    {foreach $templates as $k => $v}
                                                                        <option value="{$k}" {if $template_selected == $k} selected="selected" {/if} >{$k}</option>
                                                                    {/foreach}
                                                                </select>
                                                                    <span class="help-block" id='license_link' style="display: none">
                                                                        {lang('Installing the template you agree to the', 'admin')}
                                                                        <a target="_blank" href="/admin/settings/license_agreement?template_name={$template_selected}" id="license_agreement_link">
                                                                            {lang('license agreement', 'admin')}
                                                                        </a>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    {else:}
                                                        <input name='template' type='hidden' value="{echo $template_selected}">
                                                    {/if}
                                                    <div class="control-group">
                                                        <label class="control-label" for="cat_list">{lang('Display category tree in the content','admin')}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="cat_list" id="cat_list">
                                                                <option value="yes" {if $cat_list == 'yes'} selected="selected" {/if} >{lang('Yes','admin')}</option>
                                                                <option value="no" {if $cat_list == 'no'} selected="selected" {/if} >{lang('No','admin')}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="www_redirect">{lang('Site redirect','admin')}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="www_redirect" id="www_redirect">
                                                                <option value="without" {if $www_redirect == 'without'} selected="selected" {/if} >
                                                                    {lang('Without redirect', 'admin')}
                                                                </option>
                                                                <option value="from_www" {if $www_redirect == 'from_www'} selected="selected" {/if} >
                                                                    {langf('From www.|site| to |site|', 'admin', ['site' => $CI->uri->getHost(true)])}
                                                                </option>
                                                                <option value="to_www" {if $www_redirect == 'to_www'} selected="selected" {/if} >
                                                                    {langf('From |site| to www.|site|', 'admin', ['site' => $CI->uri->getHost(true)])}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="control-group">
                                                        <label class="control-label" for="textEditor">{lang('Text editor','admin')}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="text_editor" id="textEditor">
                                                                <option value="tinymce" {if $text_editor == 'tinymce'} selected="selected" {/if} >
                                                                    TinyMCE
                                                                </option>
                                                                <option value="none" {if $text_editor == 'none'} selected="selected" {/if} >
                                                                    Native textarea
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="comcount">{lang("Open the site for indexing robots", 'admin')}
                                                            :</label>

                                                        <div class="controls">
                                                            <div class="robotsChecker frame_prod-on_off">
                                                                <span onclick="visualSettingMenu('robots_settings_status', 'robots_status', false)" class="prod-on_off{if !$robots_status} disable_tovar{/if}"></span>
                                                                <input type="checkbox" name="robots_status" value="1" data-val-on="1" data-val-off="0" {if $robots_status}checked="checked"{/if}>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div id="robots_settings_status" class="control-group" {if !$robots_status} style="display:none"{/if}>
                                                        <div class="controls">
                                                            <div>
                                                                <label><input onclick="visualSettingMenu('robots_settings', 'robots_settings_status', true)" type="checkbox" name="robots_settings_status" value="1" {if $robots_settings_status}checked="checked"{/if}>
                                                                    - {lang('Configuring robots file manually','admin')}
                                                                </label>
                                                                <textarea id="robots_settings" name="robots_settings" {if !$robots_settings_status} style="display:none"{/if}>{echo $robots_settings}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {literal}
                            <script type="text/javascript">
                                function visualSettingMenu(idEditedEl, name, invert) {
                                    var check = $('input[name="' + name + '"]').attr('checked');
                                    if (check == 'checked' && !invert) {
                                        $('#' + idEditedEl).hide(400);
                                    } else if (check == 'checked' && invert) {
                                        $('#' + idEditedEl).show(400);
                                    } else if (check != 'checked' && invert) {
                                        $('#' + idEditedEl).hide(400);
                                    } else {
                                        $('#' + idEditedEl).show(400);
                                    }
                                }
                            </script>
                        {/literal}
                        <div class="tab-pane" id="seo">
                            <table class="table  table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Analysts settings', 'admin')}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="google_analytics_id">{lang('ID Google Analytics', "admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <input type="text" id="google_analytics_id" name="google_analytics_id" value="{$google_analytics_id}"/>
                                                                <span class="help-block">
                                                                    {lang('The code should be in the format ua-54545845', 'admin')}
                                                                </span>
                                                            <input type="checkbox" name="google_analytics_ee" {if $google_analytics_ee == 1}checked="checked"{/if}/>
                                                            {lang('Use Enhanced Ecommerce - Web Tracking', "admin")}
                                                            (beta)
                                                        </div>
                                                    </div>
                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="google_webmaster">{lang("G.Webmaster")}
                                                            :</label>

                                                        <div class="controls">
                                                            <input type="text" id="google_webmaster" name="google_webmaster" value="{$google_webmaster}"/>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="yandex_webmaster">{lang('Ya.Webmaster')}
                                                            :</label>

                                                        <div class="controls">
                                                            <input type="text" id="yandex_webmaster" name="yandex_webmaster" value="{$yandex_webmaster}"/>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="yandex_metric">{lang('ID for yandex metric',"admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <input type="text" id="yandex_webmaster" name="yandex_metric" value="{$yandex_metric}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="homePage">
                            <table class="table  table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Main page',"admin")}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">

                                                    <div class="control-group m-t_10 frame_label no_connection">
                                                        <label class="control-label" for="main_typesq">{lang('Categories',"admin")}
                                                            :</label>

                                                        <div class="controls ctext">
                                                                <span class="niceRadio b_n">
                                                                    <input type="radio" id="main_typesq" name="main_type" value="category" {if $main_type == "category"} checked="checked" {/if} />
                                                                </span>

                                                            <select name="main_page_cat" class="input-large">
                                                                { $this->view("cats_select.tpl", $this->template_vars);
                                                                }
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10 frame_label no_connection">
                                                        <label class="control-label" for="main_types">{lang('Page',"admin")}
                                                            :</label>

                                                        <div class="controls ctext">
                                                                <span class="niceRadio b_n">
                                                                    <input type="radio" id="main_types" name="main_type" value="page" {if $main_type == "page"} checked="checked" {/if} />
                                                                </span>
                                                            <select name="main_page_pid" class="input-large">
                                                                {foreach $pages as $p}
                                                                    <option  {if $p['id'] == $pageSetting}selected="selected"{/if} value="{$p['id']}">{echo $p['title']}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10 frame_label no_connection">
                                                        <label class="control-label" for="main_type">{lang('Module',"admin")}
                                                            :</label>

                                                        <div class="controls ctext">
                                                                <span class="niceRadio b_n">
                                                                    <input type="radio" id="main_type" name="main_type" value="module" {if $main_type == "module"} checked="checked" {/if} />
                                                                </span>
                                                            <select name="main_page_module" class="input-large">
                                                                {foreach $modules as $m}
                                                                    {$mData = modules::run('admin/components/get_module_info',$m['name'])}
                                                                    <option {if $m['name'] == $main_page_module}selected="selected"{/if} value="{$m['name']}">{echo $mData['menu_name']}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="metatag">
                            <table class="table  table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Meta tags',"admin")}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="add_site_name">{lang('Site name',"admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="add_site_name" id="add_site_name">
                                                                <option value="1" {if $add_site_name == "1"}selected="selected"{/if}>{lang('Yes',"admin")}</option>
                                                                <option value="0" {if $add_site_name == "0"}selected="selected"{/if} >{lang('No',"admin")}</option>
                                                            </select>
                                                                <span class="help-block">
                                                                    {lang('Whether to display the site name in the title page','admin')}
                                                                </span>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="add_site_name_to_cat">{lang('Category name',"admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="add_site_name_to_cat" id="add_site_name_to_cat">
                                                                <option value="1" {if $add_site_name_to_cat == "1"}selected="selected"{/if}>{lang("Yes","admin")}</option>
                                                                <option value="0" {if $add_site_name_to_cat == "0"}selected="selected"{/if}>{lang("No","admin")}</option>
                                                            </select>
                                                                <span class="help-block">
                                                                    {lang('Whether to display the category name in the title page','admin')}
                                                                </span>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="delimiter">{lang('Separator',"admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <input type="text" id="delimiter" value="{$delimiter}" name="delimiter" class="textbox_long" style="width:80px;"/>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="create_keywords">{lang('Meta Keywords',"admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="create_keywords" id="create_keywords">
                                                                <option value="auto" {if $create_keywords == "auto"}selected="selected"{/if}>{lang('Auto formation',"admin")}</option>
                                                                <option value="empty" {if $create_keywords == "empty"}selected="selected"{/if}>{lang('Leave empty',"admin")}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="create_description">{lang('Meta Description',"admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="create_description" id="create_description">
                                                                <option value="auto" {if $create_description == "auto"}selected="selected"{/if}>{lang('Auto formation',"admin")}</option>
                                                                <option value="empty" {if $create_description == "empty"}selected="selected"{/if}>{lang('Leave empty',"admin")}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="metatag_edit">
                            <table class="table  table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Enter Meta Tags','admin')}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="site_offline">{lang('Choose language','admin')}
                                                            :</label>

                                                        <div class="controls">
                                                            <select name="site_langs" onchange="ch_lan(this)">
                                                                {$i = 1}
                                                                {foreach $langs as $lan}
                                                                    <option value="{echo $lan['id']}" {if $i == 1} selected="selected" {/if} >{echo $lan['lang_name']}</option>
                                                                    {$i++}
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    {$i = 1}
                                                    {foreach $meta_langs as $lan => $meta}
                                                        <div class="lan {if $i!= 1}d_n{/if}" id="lang_form{echo $lan}">
                                                            <input {if $i!= 1}disabled="disabled" {/if}type="hidden" name="lang_ident" value="{echo $lan}">

                                                            <div class="control-group m-t_10">
                                                                <label class="control-label" for="titleNa">{lang('Site name', 'admin')}
                                                                    :</label>

                                                                <div class="controls">
                                                                    <input {if $i!= 1}disabled="disabled"{/if} type="text" id="titleNa" name="name" value="{echo $meta.name}"/>
                                                                </div>
                                                            </div>

                                                            <div class="control-group m-t_10">
                                                                <label class="control-label" for="short_titleS">{lang('Short site name', 'admin')}
                                                                    :</label>

                                                                <div class="controls">
                                                                    <input {if $i!= 1}disabled="disabled"{/if} type="text" id="short_titleS" name="short_name" value="{echo $meta.short_name}"/>
                                                                </div>
                                                            </div>

                                                            <div class="control-group m-t_10">
                                                                <label class="control-label" for="descriptionN">{lang('Description', 'admin')}
                                                                    :</label>

                                                                <div class="controls">
                                                                    <input {if $i!= 1}disabled="disabled"{/if} type="text" id="descriptionN" name="description" value="{echo $meta.description}"/>
                                                                </div>
                                                            </div>

                                                            <div class="control-group m-t_10">
                                                                <label class="control-label" for="keywordsss">{lang('Keywords', 'admin')}
                                                                    :</label>

                                                                <div class="controls">
                                                                    <input {if $i!= 1}disabled="disabled"{/if} type="text" id="keywordsss" name="keywords" value="{echo $meta.keywords}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {$i++}
                                                    {/foreach}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            {form_csrf()}

                        </div>

                        <div class="tab-pane" id="site_info_tab"> <!-- Інформація про сайт -->
                            {$tooltipText = lang('Please use function siteinfo() with the parameter', 'admin')}
                            <table class="table  table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Site information','admin')}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <input type="hidden" name="default_locale_hidden" value="{echo MY_Controller::getCurrentLocale()}">

                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" data-toggle="ttip" for="siteinfo_companytype">
                                                            {lang('For language', 'admin')}
                                                        </label>

                                                        <div class="controls">
                                                            <select name="siteinfo_locale" id="siteinfo_locale">
                                                                {foreach $langs as $lan}
                                                                    <option value="{echo $lan['identif']}" {if $lan['default']} selected="selected" {/if} >{echo $lan['lang_name']}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="control-group">
                                                        <label class="control-label" for="siteinfo_companytype">
                                                            {lang('Company type', 'admin')}
                                                            <i class="icon-info-sign" data-toggle="ttip" data-title="{$tooltipText} 'siteinfo_companytype'"></i>
                                                        </label>

                                                        <div class="controls">
                                                            <textarea rows="1" id="siteinfo_companytype" name="siteinfo_companytype">{$siteinfo_companytype}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="siteinfo_address">{lang('Address', 'admin')}
                                                            <i class="icon-info-sign" data-toggle="ttip" data-title="{$tooltipText} 'siteinfo_address'"></i>
                                                        </label>

                                                        <div class="controls">
                                                            <textarea rows="1" id="siteinfo_address" name="siteinfo_address">{$siteinfo_address}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="siteinfo_mainphone">{lang('Main phone', 'admin')}
                                                            <i class="icon-info-sign" data-toggle="ttip" data-title="{$tooltipText} 'siteinfo_mainphone'"></i>
                                                        </label>

                                                        <div class="controls">
                                                            <textarea rows="1" id="siteinfo_mainphone" name="siteinfo_mainphone">{$siteinfo_mainphone}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="siteinfo_adminemail">{lang('Admin email', 'admin')}
                                                            <i class="icon-info-sign" data-toggle="ttip" data-title="{$tooltipText} 'siteinfo_adminemail'"></i>
                                                        </label>

                                                        <div class="controls">
                                                            <textarea rows="1" id="siteinfo_adminemail" name="siteinfo_adminemail">{$siteinfo_adminemail}</textarea>
                                                        </div>
                                                    </div>

                                                    <hr/>
                                                    <div class="control-group">
                                                        <label class="control-label" for="">{lang('Contacts', 'admin')}
                                                            <i class="icon-info-sign" data-toggle="ttip" data-title="{$tooltipText}, {lang('that you entered as a contact type', 'admin')}"></i>
                                                        </label>

                                                        <div class="controls">
                                                            <table id="siteinfo_contacts_table" class="content_small_td">
                                                                {if count($contacts) > 0}
                                                                    {foreach $contacts as $contact_name => $contact_value}
                                                                        <tr class="siteinfo_contact_row">
                                                                            <td>
                                                                                <input type='text' placeholder="{lang('Contact type',  'admin')}" class="siteinfo_contactkey" name="siteinfo_contactkey[]" value="{$contact_name}">
                                                                            </td>
                                                                            <td>
                                                                                <textarea rows="1" placeholder="{lang('Value', 'admin')}" class="siteinfo_contactvalue" name="siteinfo_contactvalue[]">{$contact_value}</textarea>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-small si_remove_contact_row" data-rel="tooltip" data-title="{lang('Remove', 'admin')}">
                                                                                    <i class="icon-trash"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    {/foreach}
                                                                {else:}
                                                                    <tr class="siteinfo_contact_row" data-original-title="{$tooltipText} {lang('you entered as a contact type', 'admin')}">
                                                                        <td>
                                                                            <input type='text' placeholder="{lang('Contact type', 'admin')}" class="siteinfo_contactkey" name="siteinfo_contactkey[]" value="">
                                                                        </td>
                                                                        <td>
                                                                            <textarea rows="1" placeholder="{lang('Value', 'admin')}" class="siteinfo_contactvalue" value="" name="siteinfo_contactvalue[]"></textarea>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-small si_remove_contact_row" data-rel="tooltip" data-title="{lang('Remove', 'admin')}">
                                                                                <i class="icon-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                {/if}

                                                            </table>
                                                            <p id="siteinfo_contacts_controls" style='padding-top:7px;margin-left: 152px;'>
                                                                <a class="btn" id="siteinfo_addcontact">
                                                                    <span class="icon-plus-sign"></span>
                                                                    {lang('Add contact', 'admin')}
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="users_registration"> <!-- Інформація про сайт -->
                            {$tooltipText = lang('Please use function siteinfo() with the parameter', 'admin')}
                            <table class="table  table-bordered table-hover table-condensed content_big_td">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Users registration','admin')}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="form-horizontal">
                                                <input type="hidden" name="default_locale_hidden" value="{echo MY_Controller::getCurrentLocale()}">

                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" data-toggle="ttip" for="users_registration_role_id">
                                                            {lang('Users registration role', 'admin')}:
                                                        </label>

                                                        <div class="controls">
                                                            <select name="users_registration_role_id" id="users_registration_role_id">
                                                                <option {if !$users_registration_role_id} selected="selected" {/if}value="0">{lang('Without role', 'admin')}</option>
                                                                {foreach $users_roles as $role}
                                                                    <option value="{echo $role->id}" {if $users_registration_role_id === $role->id} selected="selected" {/if} >{echo $role->alt_name}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Інформація про сайт - Завершення -->
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
