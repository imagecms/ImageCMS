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
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#saveSettings" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang("Save","admin")}</button>
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
                </ul>
            </div>
            <div class="span9 content_big_td">
                <form action="{$BASE_URL}admin/settings/save" method="post" id="saveSettings">
                    <div class="tab-content">
                        <div class="tab-pane active" id="setings">
                            <table class="table table-striped table-bordered table-hover table-condensed">
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
                                                            <label class="control-label" for="site_offline">{lang('Site shutdown', 'admin')}:</label>
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
                                                            <label class="control-label" for="lang_sel">{lang('Select admin language', "admin")}:</label>
                                                            <div class="controls">
                                                                <select name="lang_sel" id="lang_sel">
                                                                    <option value="english_lang" {if strstr($lang_sel, 'english')}selected="selected"{/if}> {lang('English', 'admin')}</option>
                                                                    <option value="russian_lang" {if strstr($lang_sel, 'russian')}selected="selected"{/if}> {lang('Russian', 'admin')}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="template">{lang('Template', 'admin')}:</label>
                                                            <div class="controls">
                                                                <select name="template" id="template">
                                                                    {foreach $templates as $k => $v}
                                                                        <option value="{$k}" {if $template_selected == $k} selected="selected" {/if} >{$k}</option>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="cat_list">{lang('Display category tree in the content','admin')}:</label>
                                                            <div class="controls">
                                                                <select name="cat_list" id="cat_list">
                                                                    <option value="yes" {if $cat_list == 'yes'} selected="selected" {/if} >{lang('Yes','admin')}</option>
                                                                    <option value="no" {if $cat_list == 'no'} selected="selected" {/if} >{lang('No','admin')}</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="textEditor">{lang('Text editor','admin')}:</label>
                                                            <div class="controls">
                                                                <select name="text_editor" id="textEditor">
                                                                    <option value="tinymce" {if $text_editor == 'tinymce'} selected="selected" {/if} >TinyMCE</option>
                                                                    <option value="elrte" {if $text_editor == 'elrte'} selected="selected" {/if} >elRTE</option>
                                                                    <option value="none" {if $text_editor == 'none'} selected="selected" {/if} >Native textarea</option>
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

                        <div class="tab-pane" id="seo">
                            <table class="table table-striped table-bordered table-hover table-condensed">
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
                                                            <label class="control-label" for="google_analytics_id">{lang('ID Google Analytics', "admin")}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="google_analytics_id" name="google_analytics_id" value="{$google_analytics_id}" />
                                                                <span class="help-block">
                                                                    {lang('The code should be in the format ua-54545845', 'admin')}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="google_webmaster">{lang("G.Webmaster")}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="google_webmaster" name="google_webmaster" value="{$google_webmaster}" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="yandex_webmaster">{lang('Ya.Webmaster')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="yandex_webmaster" name="yandex_webmaster" value="{$yandex_webmaster}" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="yandex_metric">{lang('ID for yandex metric',"admin")}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="yandex_webmaster" name="yandex_metric" value="{$yandex_metric}" />
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
                            <table class="table table-striped table-bordered table-hover table-condensed">
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

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="main_typesq">{lang('Categories',"admin")}:</label>
                                                            <div class="controls">

                                                                <input type="radio" id="main_typesq" name="main_type" value="category" {if $main_type == "category"} checked="checked" {/if} />

                                                                <select name="main_page_cat" class="input-large">
                                                                    { $this->view("cats_select.tpl", $this->template_vars); }
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="main_types">{lang('Page',"admin")}:</label>
                                                            <div class="controls">
                                                                <input type="radio" id="main_types" name="main_type" value="page" {if $main_type == "page"} checked="checked" {/if} />

                                                                <input type="text" class="input-small" name="main_page_pid" class="textbox_long" style="width:100px" value="{$main_page_id}" /> - {lang("Page ID","admin")}
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="main_type">{lang('Module',"admin")}:</label>
                                                            <div class="controls">

                                                                <input type="radio" id="main_type" name="main_type" value="module" {if $main_type == "module"} checked="checked" {/if} />

                                                                <select name="main_page_module"  class="input-large">
                                                                    {foreach $modules as $m}
                                                                        {$mData = modules::run('admin/components/get_module_info',$m['name'])}
                                                                        {//if $mData['main_page'] === true}
                                                                        <option {if $m['name'] == $main_page_module}selected="selected"{/if} value="{$m['name']}">{echo $mData['menu_name']}</option>
                                                                        {///if}
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
                            <table class="table table-striped table-bordered table-hover table-condensed">
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
                                                            <label class="control-label" for="add_site_name">{lang('Site name',"admin")}:</label>
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
                                                            <label class="control-label" for="add_site_name_to_cat">{lang('Category name',"admin")}:</label>
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
                                                            <label class="control-label" for="delimiter">{lang('Separator',"admin")}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="delimiter" value="{$delimiter}" name="delimiter" class="textbox_long" style="width:80px;" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="create_keywords">{lang('Meta Keywords',"admin")}:</label>
                                                            <div class="controls">
                                                                <select name="create_keywords" id="create_keywords">
                                                                    <option value="auto" {if $create_keywords == "auto"}selected="selected"{/if}>{lang('Auto formation',"admin")}</option>
                                                                    <option value="empty" {if $create_keywords == "empty"}selected="selected"{/if}>{lang('Leave empty',"admin")}</option>
                                                                </select>
                                                                <span class="help-block">
                                                                    {lang('If not given or specified',"admin")}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="create_description">{lang('Meta Description',"admin")}:</label>
                                                            <div class="controls">
                                                                <select name="create_description" id="create_description">
                                                                    <option value="auto" {if $create_description == "auto"}selected="selected"{/if}>{lang('Auto formation',"admin")}</option>
                                                                    <option value="empty" {if $create_description == "empty"}selected="selected"{/if}>{lang('Leave empty',"admin")}</option>
                                                                </select>
                                                                <span class="help-block">
                                                                    {lang('If not specified',"admin")}
                                                                </span>
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
                            <table class="table table-striped table-bordered table-hover table-condensed">
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
                                                            <label class="control-label" for="site_offline">{lang('Choose language','admin')}:</label>
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
                                                    </div>
                                                    {$i = 1}
                                                    {foreach $meta_langs as $lan => $meta}
                                                        <div class="lan {if $i!= 1}d_n{/if}" id="lang_form{echo $lan}">
                                                            <input  {if $i!= 1}disabled="disabled"{/if}type="hidden" name="lang_ident" value="{echo $lan}">
                                                            <div class="row-fluid">
                                                                <div class="control-group m-t_10">
                                                                    <label class="control-label" for="titleNa">{lang('Site name', 'admin')}:</label>
                                                                    <div class="controls">
                                                                        <input {if $i!= 1}disabled="disabled"{/if} type="text" id="titleNa" name="name" value="{echo $meta.name}" />
                                                                    </div>
                                                                </div>

                                                                <div class="control-group m-t_10">
                                                                    <label class="control-label" for="short_titleS">{lang('Short site name', 'admin')}:</label>
                                                                    <div class="controls">
                                                                        <input {if $i!= 1}disabled="disabled"{/if} type="text" id="short_titleS" name="short_name" value="{echo $meta.short_name}" />
                                                                    </div>
                                                                </div>

                                                                <div class="control-group m-t_10">
                                                                    <label class="control-label" for="descriptionN">{lang('Description', 'admin')}:</label>
                                                                    <div class="controls">
                                                                        <input {if $i!= 1}disabled="disabled"{/if} type="text" id="descriptionN" name="description" value="{echo $meta.description}" />
                                                                    </div>
                                                                </div>

                                                                <div class="control-group m-t_10">
                                                                    <label class="control-label" for="keywordsss">{lang('Keywords', 'admin')}:</label>
                                                                    <div class="controls">
                                                                        <input {if $i!= 1}disabled="disabled"{/if} type="text" id="keywordsss" name="keywords" value="{echo $meta.keywords}" />
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        {$i++}
                                                    {/foreach}
                                                </div>
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
                            <table class="table table-striped table-bordered table-hover table-condensed">
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
                                                    <div class="row-fluid">

                                                        <div class="control-group">
                                                            <label class="control-label" for="siteinfo_companytype">{lang('Company type', 'admin')} <i class="icon-info-sign" data-original-title="{$tooltipText} 'siteinfo_companytype'"></i></label>
                                                            <div class="controls">
                                                                <textarea rows="1" id="siteinfo_companytype" name="siteinfo_companytype">{$siteinfo_companytype}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="siteinfo_address">{lang('Address', 'admin')} <i class="icon-info-sign" data-original-title="{$tooltipText} 'siteinfo_address'"></i></label>
                                                            <div class="controls">
                                                                <textarea rows="1" id="siteinfo_address" name="siteinfo_address">{$siteinfo_address}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="siteinfo_mainphone">{lang('Main phone', 'admin')} <i class="icon-info-sign" data-original-title="{$tooltipText} 'siteinfo_mainphone'"></i></label>
                                                            <div class="controls">
                                                                <textarea rows="1" id="siteinfo_mainphone" name="siteinfo_mainphone">{$siteinfo_mainphone}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="siteinfo_adminemail">{lang('Admin email', 'admin')}<i class="icon-info-sign" data-original-title="{$tooltipText} 'siteinfo_adminemail'"></i></label>
                                                            <div class="controls">
                                                                <textarea rows="1" id="siteinfo_adminemail" name="siteinfo_adminemail">{$siteinfo_adminemail}</textarea>
                                                            </div>
                                                        </div>

                                                        <hr />
                                                        <div class="control-group">
                                                            <label class="control-label" for="">{lang('Contacts', 'admin')} <i class="icon-info-sign" data-original-title="{$tooltipText} {lang('that you entered as a contact type', 'admin')}"></i></label>  
                                                            <div class="controls">
                                                                <table id="siteinfo_contacts_table">
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
                                                                                    <button type="button" class="btn btn-small btn-danger si_remove_contact_row">
                                                                                        <i class="icon-trash icon-white"></i>
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
                                                                                <button type="button" class="btn btn-small btn-danger si_remove_contact_row">
                                                                                    <i class="icon-trash icon-white"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr> 
                                                                    {/if}

                                                                </table>
                                                            </div>
                                                            <p id="siteinfo_contacts_controls" style='text-align:right; padding-top:7px;'>
                                                                <a class="btn btn-small btn-success" id="siteinfo_addcontact">
                                                                    <span class="icon-plus-sign icon-white"></span>
                                                                    {lang('Add contact', 'admin')}
                                                                </a>
                                                            </p>
                                                        </div>

                                                        <hr />
                                                        <div class="control-group">
                                                            <label class="control-label">{lang('Logo', 'admin')} <i class="icon-info-sign" data-original-title="{$tooltipText} 'siteinfo_logo'"></i></label>
                                                            <input type="file" id="siteinfo_logo" name="siteinfo_logo" data-url="file">
                                                            <input type="hidden" id="si_delete_logo" class="si_delete_image" name="si_delete_logo" value="0">

                                                            <div class="controls siteinfo_logoimage">
                                                                <div class='siteinfo_image_container'>
                                                                    {$logo = siteinfo('siteinfo_logo_url')}
                                                                    {if !empty($logo)}
                                                                        <button type="button" class="btn btn-small remove_btn">
                                                                            <i class="icon-trash"></i>
                                                                        </button>
                                                                        <img class="img-polaroid" src="{$logo}" alt="{lang('Click to select the image', 'admin')}" />
                                                                    {else:}
                                                                        <img class="img-polaroid" src="{$BASE_URL}templates/administrator/images/select-picture.png" alt="{lang('Click to select the image', 'admin')}" />
                                                                    {/if}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Favicon <i class="icon-info-sign" data-original-title="{$tooltipText} 'siteinfo_favicon'"></i></label>
                                                            <input type="file" id="siteinfo_favicon" name="siteinfo_favicon" data-url="file">
                                                            <input type="hidden" id="si_delete_favicon" class="si_delete_image" name="si_delete_favicon" value="0">

                                                            <div class="controls siteinfo_faviconimage">
                                                                <div class='siteinfo_image_container'>
                                                                    {$favicon = siteinfo('siteinfo_favicon_url')}
                                                                    {if !empty($favicon)}
                                                                        <button type="button" class="btn btn-small remove_btn">
                                                                            <i class="icon-trash"></i>
                                                                        </button>
                                                                        <img class="img-polaroid" src="{$favicon}" alt="{lang('Click to select the image', 'admin')}" />
                                                                    {else:}
                                                                        <img class="img-polaroid" src="{$BASE_URL}templates/administrator/images/select-picture.png" alt="{lang('Click to select the image', 'admin')}" />
                                                                    {/if}
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

                        </div> <!-- Інформація про сайт - Завершення -->
                    </div>
                </form> 
            </div>
        </div>
    </section>
</div>
