
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_sett_global_sett_menu')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/dashboard" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#saveSettings" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                </div>
            </div>                            
        </div>
        <div class="row-fluid">
            <div class="span3 m-t_10">
                <ul class="nav myTab nav-tabs nav-stacked">
                    <li class="active"><a href="#setings">{lang('a_sett')}</a></li>
                    <li><a href="#homePage">{lang('a_main_page')}</a></li>
                    <li><a href="#metatag">{lang('a_meta_tags')}</a></li>                          
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
                                        {lang('a_sett')}
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
                                                            <label class="control-label" for="titleNa">{lang('a_site_title')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="titleNa" name="title" value="{$site_title}" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="short_titleS">{lang('a_short_title')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="short_titleS" name="short_title" value="{$site_short_title}" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="descriptionN">{lang('a_desc')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="descriptionN" name="description" value="{$site_description}" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="keywordsss">{lang('a_key_words')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="keywordsss" name="keywords" value="{$site_keywords}" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="google_analytics_id">{lang('a_google_id')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="google_analytics_id" name="google_analytics_id" value="{$google_analytics_id}" />
                                                                <span class="help-block">
                                                                    {lang('a_code_in_google')}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="google_webmaster">{lang('a_W_G')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="google_webmaster" name="google_webmaster" value="{$google_webmaster}" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="yandex_webmaster">{lang('a_Y_W')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="yandex_webmaster" name="yandex_webmaster" value="{$yandex_webmaster}" />
                                                            </div>
                                                        </div>
                                                            
                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="yandex_metric">{lang('a_yandex_metric')}:</label>
                                                            <div class="controls">
                                                                <input type="text" id="yandex_webmaster" name="yandex_metric" value="{$yandex_metric}" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="site_offline">{lang('a_site_shutdown')}:</label>
                                                            <div class="controls">
                                                                <select name="site_offline" id="site_offline">
                                                                    {foreach $work_values as $k => $v}
                                                                        <option value="{$k}" {if $site_offline == $k} selected="selected" {/if} >{$v}</option>
                                                                    {/foreach}
                                                                </select>
                                                                <span class="help-block">
                                                                    {lang('a_site_offline_help')}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="lang_sel">{lang('a_lang_select')}:</label>
                                                            <div class="controls">
                                                                <select name="lang_sel" id="lang_sel">
                                                                    {$arr = get_lang_admin_folders()}
                                                                    {foreach $arr as $a}
                                                                        <option value="{$a}" {if $lang_sel == $a}selected="selected"{/if}> {echo str_replace('_lang', '', $a)} {if $a == 'english_lang'}(beta){/if} </option>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="template">{lang('a_tpl')}:</label>
                                                            <div class="controls">
                                                                <select name="template" id="template">
                                                                    {foreach $templates as $k => $v}
                                                                        <option value="{$k}" {if $template_selected == $k} selected="selected" {/if} >{$k}</option>
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

                    <div class="tab-pane" id="homePage">                                    
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_main_page')}
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
                                                        <label class="control-label" for="main_typesq">{lang('a_category')}:</label>
                                                        <div class="controls">

                                                            <input type="radio" id="main_typesq" name="main_type" value="category" {if $main_type == "category"} checked="checked" {/if} />

                                                            <select name="main_page_cat" class="input-small">
                                                                { $this->view("cats_select.tpl", $this->template_vars); }
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="main_types">{lang('a_page')}:</label>
                                                        <div class="controls">

                                                            <input type="radio" id="main_types" name="main_type" value="page" {if $main_type == "page"} checked="checked" {/if} />

                                                            <input type="text" class="input-small" name="main_page_pid" class="textbox_long" style="width:100px" value="{$main_page_id}" /> - {lang('a_page_id')}
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="main_type">{lang('a_module')}:</label>
                                                        <div class="controls">

                                                            <input type="radio" id="main_type" name="main_type" value="module" {if $main_type == "module"} checked="checked" {/if} />

                                                            <select name="main_page_module"  class="input-small">
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
                                        {lang('a_meta_tags')}
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
                                                        <label class="control-label" for="add_site_name">{lang('a_site_title')}:</label>
                                                        <div class="controls">
                                                            <select name="add_site_name" id="add_site_name">
                                                                <option value="1" {if $add_site_name == "1"}selected="selected"{/if}>{lang('a_yes')}</option>
                                                                <option value="0" {if $add_site_name == "0"}selected="selected"{/if} >{lang('a_no')}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="add_site_name_to_cat">{lang('a_cat_name')}:</label>
                                                        <div class="controls">
                                                            <select name="add_site_name_to_cat" id="add_site_name_to_cat">
                                                                <option value="1" {if $add_site_name_to_cat == "1"}selected="selected"{/if}>{lang('a_yes')}</option>
                                                                <option value="0" {if $add_site_name_to_cat == "0"}selected="selected"{/if}>{lang('a_no')}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="delimiter">{lang('a_separator')}:</label>
                                                        <div class="controls">
                                                            <input type="text" id="delimiter" value="{$delimiter}" name="delimiter" class="textbox_long" style="width:80px;" />
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="create_keywords">{lang('a_meta_keywords')}:</label>
                                                        <div class="controls">
                                                            <select name="create_keywords" id="create_keywords">
                                                                <option value="auto" {if $create_keywords == "auto"}selected="selected"{/if}>{lang('a_auto_form')}</option>
                                                                <option value="empty" {if $create_keywords == "empty"}selected="selected"{/if}>{lang('a_leave_empty')}</option>
                                                            </select>
                                                            <span class="help-block">
                                                                {lang('a_if_not_pointed')}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="create_description">{lang('a_meta_description')}:</label>
                                                        <div class="controls">
                                                            <select name="create_description" id="create_description">
                                                                <option value="auto" {if $create_description == "auto"}selected="selected"{/if}>{lang('a_auto_form')}</option>
                                                                <option value="empty" {if $create_description == "empty"}selected="selected"{/if}>{lang('a_leave_empty')}</option>
                                                            </select>
                                                            <span class="help-block">
                                                                {lang('a_if_not_pointed1')}
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
                </div>
            {form_csrf()}
            </form>                       
            </div>
    </section>
</div>