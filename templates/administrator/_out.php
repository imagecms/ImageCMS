<form action=" <?php $BASE_URL ?> admin/components/save_settings/ <?php $name ?> " method="post" id="component_save_form" style="width:100%;">&nbsp;
	<div class="form_text"></div>
	<div class="form_input"><label><input name="status" value="1"  <?php if $enabled == 1 ?>  checked="checked"  <?php /if ?>   type="checkbox" />  <?php lang('a_url_access_on') ?> </label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><label><input name="autoload" value="1"  <?php if $autoload == 1 ?>  checked="checked"  <?php /if ?>   type="checkbox" />  <?php lang('a_autoload') ?> </label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><label><input name="in_menu" value="1"  <?php if $in_menu == 1 ?>  checked="checked"  <?php /if ?>   type="checkbox" />  <?php lang('a_add_to_menu') ?> </label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input">
	    <input type="submit" name="button" class="button" value=" <?php lang('a_save') ?> "
	    onclick="ajax_me('component_save_form'); MochaUI.closeWindow($('edit_component_window'));"/>
	</div>
 <?php form_csrf() ?> </form><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_role_edit') ?> :  <?php echo $model->name ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/roleEdit/ <?php echo $idRole ?> " class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_back') ?> </span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#role_ed_form" data-action="edit" data-submit><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#role_ed_form" data-action="exit"><i class="icon-check"></i> <?php lang('a_footer_save_exit') ?> </button>

                <div class="dropdown d-i_b">   
                     <?php $arr = get_lang_admin_folders() ?> 
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                 <?php if $lang_sel == 'en' ?>  <?php lang('a_english') ?>  <?php else: ?>  <?php lang('a_russian') ?>  <?php /if ?> 
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href=" <?php $BASE_URL ?> admin/rbac/translateRole/ <?php echo $idRole ?> / <?php if $lang_sel == 'en' ?> ru <?php else: ?> en <?php /if ?> ">                                    
                 <?php if $lang_sel == 'en' ?>   <?php lang('a_russian') ?>   <?php else: ?>   <?php lang('a_english') ?>  (beta) <?php /if ?> 
            </a>
        </li> 
    </ul>

</div>
</div>
</div>
</div>

<div class="tab-content clearfix">
    <form method="post" action=" <?php $ADMIN_URL ?>  <?php echo $lang_sel ?> " class="form-horizontal" id="role_ed_form">
        <div class="tab-pane active">
            <div class="tab-pane ">    

                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_param') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="row-fluid">
                                        <div class="control-group m-t_10">
                                            <label class="control-label" for="alt_name"> <?php lang('a_description') ?> :</label>
                                            <div class="controls">
                                                <input type="text" name="alt_name" id="alt_name" value=" <?php echo $model->alt_name ?> " />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Description">Полное описание:</label>
                                            <div class="controls">
                                                <input type="text" name="Description" id="Description" value=" <?php echo $model->description ?> "/>
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
         <?php form_csrf() ?> 
    </form>
</div>
</section><div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_sett_global_sett_menu') ?> </span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/dashboard" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_return') ?> </span></a>
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#saveSettings" data-action="edit" data-submit><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                </div>
            </div>                            
        </div>
        <div class="row-fluid">
            <div class="span3 m-t_10">
                <ul class="nav myTab nav-tabs nav-stacked">
                    <li class="active"><a href="#setings"> <?php lang('a_sett') ?> </a></li>
                    <li><a href="#seo">SEO</a></li>
                    <li><a href="#homePage"> <?php lang('a_main_page') ?> </a></li>
                    <li><a href="#metatag">Управление Мета-тегами</a></li>                          
                </ul>
            </div>
            <div class="span9 content_big_td">
                <form action=" <?php $BASE_URL ?> admin/settings/save" method="post" id="saveSettings">
                    <div class="tab-content">
                        <div class="tab-pane active" id="setings">                                    
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="6">
                                             <?php lang('a_sett') ?> 
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
                                                            <label class="control-label" for="titleNa"> <?php lang('a_site_title') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="titleNa" name="title" value=" <?php $site_title ?> " />
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="site_offline"> <?php lang('a_site_shutdown') ?> :</label>
                                                            <div class="controls">
                                                                <select name="site_offline" id="site_offline">
                                                                     <?php foreach $work_values as $k => $v ?> 
                                                                        <option value=" <?php $k ?> "  <?php if $site_offline == $k ?>  selected="selected"  <?php /if ?>  > <?php $v ?> </option>
                                                                     <?php /foreach ?> 
                                                                </select>
                                                                <span class="help-block">
                                                                     <?php lang('a_site_offline_help') ?> 
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="lang_sel"> <?php lang('a_lang_select') ?> :</label>
                                                            <div class="controls">
                                                                <select name="lang_sel" id="lang_sel">
                                                                     <?php $arr = get_lang_admin_folders() ?> 
                                                                     <?php foreach $arr as $a ?> 
                                                                        <option value=" <?php $a ?> "  <?php if $lang_sel == $a ?> selected="selected" <?php /if ?> >  <?php echo str_replace('_lang', '', $a) ?>   <?php if $a == 'english_lang' ?> (beta) <?php /if ?>  </option>
                                                                     <?php /foreach ?> 
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="template"> <?php lang('a_tpl') ?> :</label>
                                                            <div class="controls">
                                                                <select name="template" id="template">
                                                                     <?php foreach $templates as $k => $v ?> 
                                                                        <option value=" <?php $k ?> "  <?php if $template_selected == $k ?>  selected="selected"  <?php /if ?>  > <?php $k ?> </option>
                                                                     <?php /foreach ?> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="cat_list">Отображать дерево категорий в списке содержимого:</label>
                                                            <div class="controls">
                                                                <select name="cat_list" id="cat_list">
                                                                    <option value="yes"  <?php if $cat_list == 'yes' ?>  selected="selected"  <?php /if ?>  >Да</option>
                                                                    <option value="no"  <?php if $cat_list == 'no' ?>  selected="selected"  <?php /if ?>  >Нет</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="textEditor">Текстовый редактор:</label>
                                                            <div class="controls">
                                                                <select name="text_editor" id="textEditor">
                                                                    <option value="tinymce"  <?php if $text_editor == 'tinymce' ?>  selected="selected"  <?php /if ?>  >TinyMCE</option>
                                                                    <option value="elrte"  <?php if $text_editor == 'elrte' ?>  selected="selected"  <?php /if ?>  >elRTE</option>
                                                                    <option value="none"  <?php if $text_editor == 'none' ?>  selected="selected"  <?php /if ?>  >Native textarea</option>
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
                                            Параметры
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
                                                            <label class="control-label" for="short_titleS"> <?php lang('a_short_title') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="short_titleS" name="short_title" value=" <?php $site_short_title ?> " />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="descriptionN"> <?php lang('a_desc') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="descriptionN" name="description" value=" <?php $site_description ?> " />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="keywordsss"> <?php lang('a_key_words') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="keywordsss" name="keywords" value=" <?php $site_keywords ?> " />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="google_analytics_id"> <?php lang('a_google_id') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="google_analytics_id" name="google_analytics_id" value=" <?php $google_analytics_id ?> " />
                                                                <span class="help-block">
                                                                     <?php lang('a_code_in_google') ?> 
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="google_webmaster"> <?php lang('a_W_G') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="google_webmaster" name="google_webmaster" value=" <?php $google_webmaster ?> " />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="yandex_webmaster"> <?php lang('a_Y_W') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="yandex_webmaster" name="yandex_webmaster" value=" <?php $yandex_webmaster ?> " />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="yandex_metric"> <?php lang('a_yandex_metric') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="yandex_webmaster" name="yandex_metric" value=" <?php $yandex_metric ?> " />
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
                                             <?php lang('a_main_page') ?> 
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
                                                            <label class="control-label" for="main_typesq"> <?php lang('a_category') ?> :</label>
                                                            <div class="controls">

                                                                <input type="radio" id="main_typesq" name="main_type" value="category"  <?php if $main_type == "category" ?>  checked="checked"  <?php /if ?>  />

                                                                <select name="main_page_cat" class="input-small">
                                                                     <?php  $this->view("cats_select.tpl", $this->template_vars);  ?> 
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="main_types"> <?php lang('a_page') ?> :</label>
                                                            <div class="controls">

                                                                <input type="radio" id="main_types" name="main_type" value="page"  <?php if $main_type == "page" ?>  checked="checked"  <?php /if ?>  />

                                                                <input type="text" class="input-small" name="main_page_pid" class="textbox_long" style="width:100px" value=" <?php $main_page_id ?> " /> -  <?php lang('a_page_id') ?> 
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="main_type"> <?php lang('a_module') ?> :</label>
                                                            <div class="controls">

                                                                <input type="radio" id="main_type" name="main_type" value="module"  <?php if $main_type == "module" ?>  checked="checked"  <?php /if ?>  />

                                                                <select name="main_page_module"  class="input-small">
                                                                     <?php foreach $modules as $m ?> 
                                                                         <?php $mData = modules::run('admin/components/get_module_info',$m['name']) ?> 
                                                                         <?php //if $mData['main_page'] === true ?> 
                                                                        <option  <?php if $m['name'] == $main_page_module ?> selected="selected" <?php /if ?>  value=" <?php $m['name'] ?> "> <?php echo $mData['menu_name'] ?> </option>
                                                                         <?php ///if ?> 
                                                                     <?php /foreach ?> 
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
                                             <?php lang('a_meta_tags') ?> 
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
                                                            <label class="control-label" for="add_site_name"> <?php lang('a_site_title') ?> :</label>
                                                            <div class="controls">
                                                                <select name="add_site_name" id="add_site_name">
                                                                    <option value="1"  <?php if $add_site_name == "1" ?> selected="selected" <?php /if ?> > <?php lang('a_yes') ?> </option>
                                                                    <option value="0"  <?php if $add_site_name == "0" ?> selected="selected" <?php /if ?>  > <?php lang('a_no') ?> </option>
                                                                </select>
                                                                <span class="help-block">
                                                                    Будет ли отображатся название сайта в тайтле страницы
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="add_site_name_to_cat"> <?php lang('a_cat_name') ?> :</label>
                                                            <div class="controls">
                                                                <select name="add_site_name_to_cat" id="add_site_name_to_cat">
                                                                    <option value="1"  <?php if $add_site_name_to_cat == "1" ?> selected="selected" <?php /if ?> > <?php lang('a_yes') ?> </option>
                                                                    <option value="0"  <?php if $add_site_name_to_cat == "0" ?> selected="selected" <?php /if ?> > <?php lang('a_no') ?> </option>
                                                                </select>
                                                                <span class="help-block">
                                                                    Будет ли отображатся название категории в тайтле страницы
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="delimiter"> <?php lang('a_separator') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" id="delimiter" value=" <?php $delimiter ?> " name="delimiter" class="textbox_long" style="width:80px;" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="create_keywords"> <?php lang('a_meta_keywords') ?> :</label>
                                                            <div class="controls">
                                                                <select name="create_keywords" id="create_keywords">
                                                                    <option value="auto"  <?php if $create_keywords == "auto" ?> selected="selected" <?php /if ?> > <?php lang('a_auto_form') ?> </option>
                                                                    <option value="empty"  <?php if $create_keywords == "empty" ?> selected="selected" <?php /if ?> > <?php lang('a_leave_empty') ?> </option>
                                                                </select>
                                                                <span class="help-block">
                                                                     <?php lang('a_if_not_pointed') ?> 
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="control-group m-t_10">
                                                            <label class="control-label" for="create_description"> <?php lang('a_meta_description') ?> :</label>
                                                            <div class="controls">
                                                                <select name="create_description" id="create_description">
                                                                    <option value="auto"  <?php if $create_description == "auto" ?> selected="selected" <?php /if ?> > <?php lang('a_auto_form') ?> </option>
                                                                    <option value="empty"  <?php if $create_description == "empty" ?> selected="selected" <?php /if ?> > <?php lang('a_leave_empty') ?> </option>
                                                                </select>
                                                                <span class="help-block">
                                                                     <?php lang('a_if_not_pointed1') ?> 
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
                     <?php form_csrf() ?> 
                </form>                       
            </div>
    </section>
</div><div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Warning!</h4>
    Недостаточно прав для доступа.
</div><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title> <?php lang('a_controll_panel') ?>  - Image CMS</title>
        <meta name="description" content=" <?php lang('a_controll_panel') ?>  - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/style.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-responsive.css"/>
        
    </head>
    <body>
        <?php
        $ci = get_instance();
        if($ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php'))
        die('<span style="font-size:18px;"><br/><br/>'.lang('a_delete_install').'/application/modules/install/install.php</div>');
            ?>
            <div class="main_body">
                <div class="form_login t-a_c" style="min-height: 250px;">
                    <a href="/admin/dashboard" class="d-i_b">
                        <img src=" <?php $THEME ?> /img/logo.png"/>
                    </a><br/>
                    <div id="titleExt"> <?php widget('path') ?> <span class="ext"> <?php lang('lang_forgot_password') ?> </span></div>

                    <form action="" class="t-a_l" method="post">
                        <label>
                             <?php lang('lang_username_or_mail') ?> 
                            <input type="text" name="login" id="login" style="padding-left: 5px;" placeholder="E-mail"/>
                             <?php if validation_errors() OR $info_message ?> 
                                 <?php validation_errors() ?> 
                                 <?php $info_message ?> 
                             <?php /if ?> 
                        </label>
                            

                        <input type="submit" id="submit" class="btn btn-info pull-left" value=" <?php lang('a_send_f') ?> " />
                        <a href=" <?php site_url('/admin/login') ?> " class="pull-right m-t_10"> <?php lang('s_log_out') ?> </a>
                         <?php form_csrf() ?> 
                    </form>
                </div>
            </div>
            <script src=" <?php $THEME ?> /js/jquery-1.8.2.min.js" type="text/javascript"></script>
            <script src=" <?php $THEME ?> /js/scripts.js" type="text/javascript"></script>
    </body>
</html><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_role_create') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/roleList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_back') ?> </span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#role_cr_form" data-action="new" data-submit><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#role_cr_form" data-action="exit"><i class="icon-check"></i> <?php lang('a_save_and_exit') ?> </button>
            </div>
        </div>

    </div>
    <form method="post" action=" <?php $ADMIN_URL ?> roleCreate" class="form-horizontal" id="role_cr_form">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                         <?php lang('a_param') ?> 
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="row-fluid">
                                <div class="control-group m-t_10">
                                    <label class="control-label" for="Name"> <?php lang('a_name') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Name" id="Name" value="" required/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description"> <?php lang('a_desc') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value=""/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description"> <?php lang('a_imp_rbak') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Importance" id="Description" value=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
             <?php if strpos(getCmsNumber(), 'Premium') ?> <a href="#shop" class="btn btn-small">Shop</a> <?php /if ?> 
            <a href="#base" class="btn btn-small active">Base</a>
            <a href="#module" class="btn btn-small">Modules</a>
        </div> 

        <div class="tab-content">
             <?php foreach $types as $key => $type ?> 
                 <?php if  strpos(getCmsNumber(), 'Premium') OR $key!='shop' ?> 
                <div class="tab-pane row  <?php if $key == 'base' ?> active <?php /if ?> " id=" <?php echo $key ?> ">
                     <?php foreach $type as $k => $groups ?>  
                        <div class="span3">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="t-a_c span1">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" />
                                                </span>
                                            </span>
                                        </th>                           
                                        <th> <?php echo $groups['description'] ?> </th>
                                    </tr>                        
                                </thead>
                                <tbody class="sortable">
                                     <?php foreach $groups['privileges'] as $privilege ?> 
                                        <tr>       
                                            <td class="t-a_c">
                                                <span class="frame_label">
                                                    <span class="niceCheck b_n">  
                                                        <input type="checkbox" class="chldcheck"  value=" <?php echo $privilege['id'] ?> " name="Privileges[]"/>
                                                    </span>
                                                </span>
                                            </td>
                                            <td style="word-wrap : break-word;">
                                                <p title=" <?php echo $privilege['description'] ?> "> <?php echo $privilege['title'] ?> </p>
                                            </td>                              
                                        </tr>
                                     <?php /foreach ?> 
                                </tbody>
                            </table>
                        </div>
                     <?php /foreach ?> 
                </div>
                 <?php /if ?> 
             <?php /foreach ?> 
        </div>
         <?php form_csrf() ?> 
    </form>
</section><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="title"> <?php lang('a_widget_edit') ?> <b> <?php $widget.name ?> </b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/widgets_manager/index/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#wid_ed_form"><i class="icon-list-alt icon-white"></i>Сохранить</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#wid_ed_form" data-action="tomain"><i class="icon-check"></i>Сохранить и выйти</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
                <form method="post" action=" <?php $BASE_URL ?> admin/widgets_manager/update_widget/ <?php $widget.id ?> " class="form-horizontal" id="wid_ed_form">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                     <?php lang('a_param') ?> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="inputName"> <?php lang('a_n') ?> :</label>
                                                <div class="controls">
                                                    <input type="text" name="name" id="inputName" value=" <?php $widget.name ?> "/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputDesc"> <?php lang('a_desc') ?> :</label>
                                                <div class="controls">
                                                    <input type="text" name="desc" id="inputDesc" value=" <?php $widget.description ?> ">
                                                    <p class="help-block"> <?php lang('a_short_widget_desc') ?> </p>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputType">HTML код:</label>
                                                <div class="controls">
                                                    <textarea class="elRTE" name="html_code" rows="15"> <?php htmlspecialchars($widget.data) ?> </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="tab-pane"></div>
    </div>
</section><div class="container ">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_tools_panel') ?> </span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a class="btn btn-small pjax btn-success" href="/admin/pages/index"><i class="icon-plus-sign icon-white"></i> <?php lang('a_create_page') ?> </a>
                    <a class="btn btn-small pjax btn-success" href="/admin/categories/create_form"><i class="icon-plus-sign icon-white"></i> <?php lang('a_create_cat') ?> </a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span8 content_big_td">
                <h4> <?php lang('a_new_pages') ?> </h4>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th> <?php lang('a_title') ?> </th>
                     <?php if count($latest)>0 ?> 
                    <th> <?php lang('a_category') ?> </th>
                    <th>URL</th>
                    <th> <?php lang('a_date_and_time_cr') ?> </th>
                    <th class="span1"></th>
                     <?php /if ?> 
                    </thead>
                    <tbody>
                         <?php if count($latest)>0 ?> 
                         <?php foreach $latest as $l ?> 
                        <tr>
                            <td>
                                <a href=" <?php $BASE_URL ?> admin/pages/edit/ <?php $l.id ?> " class="pjax" data-rel="tooltip" data-title=" <?php lang('a_edit') ?> "> <?php truncate($l.title, 40, '...') ?> </a>
                            </td>
                            <td>
                                <a href=" <?php $BASE_URL ?> admin/pages/GetPagesByCategory/ <?php $l.category ?> " class="pjax">
                                     <?php truncate(get_category_name($l.category), 20, '...Без категории') ?> 
                                </a>
                            </td>
                            <td>
                                <a href=" <?php $BASE_URL ?>  <?php $l.cat_url ?>  <?php $l.url ?> " target="_blank"> <?php truncate($l.url, 20, '...') ?> </a>
                            </td>
                            <td> <?php date('Y-m-d H:i:s', $l['created']) ?> </td>
                            <td>
                                <a class="btn btn-small my_btn_s pjax" data-rel="tooltip" data-title=" <?php lang('a_edit') ?> " href=" <?php $BASE_URL ?> admin/pages/edit/ <?php $l.id ?> / <?php $l.lang ?> ">
                                    <i class="icon-edit"></i>
                                </a>
                            </td>
                        </tr>
                         <?php /foreach ?> 
                         <?php else: ?> 
                        <tr>
                            <td>
                                <div class="alert alert-block">
                                    <h4>Ошибка</h4>
                                    Нет недавно добавленых страниц
                                </div>
                            </td>
                        </tr>
                         <?php /if ?> 
                    </tbody>
                </table>
                <h4> <?php lang('a_updated_pages') ?> </h4>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th> <?php lang('a_title') ?> </th>
                     <?php if count($latest)>0 ?> 
                    <th> <?php lang('a_category') ?> </th>
                    <th>URL</th>
                    <th> <?php lang('a_date_and_time_cr') ?> </th>
                    <th class="span1"></th>
                     <?php /if ?> 
                    </thead>
                    <tbody>
                         <?php if count($updated)>0 ?> 
                         <?php foreach $updated as $l ?> 
                        <tr>
                            <td>
                                <a href=" <?php $BASE_URL ?> admin/pages/edit/ <?php $l.id ?> " class="pjax" data-rel="tooltip" data-title=" <?php lang('a_edit') ?> "> <?php truncate($l.title, 40, '...') ?> </a>
                            </td>
                            <td>
                                <a href=" <?php $BASE_URL ?> admin/pages/GetPagesByCategory/ <?php $l.category ?> " class="pjax">
                                     <?php truncate(get_category_name($l.category), 20, '...') ?> 
                                </a>
                            </td>
                            <td>
                                <a href=" <?php $BASE_URL ?>  <?php $l.cat_url ?>  <?php $l.url ?> " target="_blank"> <?php truncate($l.url, 20, '...') ?> </a>
                            </td>
                            <td> <?php date('Y-m-d H:i:s', $l['created']) ?> </td>
                            <td>
                                <a class="btn btn-small my_btn_s pjax" data-rel="tooltip" data-title=" <?php lang('a_edit') ?> " href=" <?php $BASE_URL ?> admin/pages/edit/ <?php $l.id ?> / <?php $l.lang ?> ">
                                    <i class="icon-edit"></i>
                                </a>
                            </td>
                        </tr>
                         <?php /foreach ?> 
                         <?php else: ?> 
                        <tr>
                            <td>
                                <div class="alert alert-block">
                                    <h4>Ошибка</h4>
                                    Нет недавно обновлённых страниц
                                </div>
                            </td>
                        </tr>
                         <?php /if ?> 
                    </tbody>
                </table>
            </div>
            <div class="span4">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td" style="margin-top: 40px;">
                    <thead>
                    <th> <?php lang('a_system') ?> </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                     <?php lang('a_version') ?> :  <?php $cms_number ?>  <br />
                                     <?php if $sys_status.is_update == TRUE ?> 
                                    <a href="#" onclick="ajax_div('page', base_url + 'admin/sys_upgrade');return false;"> <?php lang('a_updates_to_version') ?>   <?php $next_v ?> </a>
                                     <?php else: ?> 
                                     <?php lang('a_no_updates') ?> .
                                     <?php /if ?> 
                                    <br/>
                                    <a href="/admin/sys_info" class="pjax"> <?php lang('a_info') ?> </a> 
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th> <?php lang('a_stat') ?> </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                     <?php lang('a_pages') ?> :  <?php $total_pages ?>  <br />
                                     <?php lang('a_cats') ?> :  <?php $total_cats ?>  <br />
                                     <?php lang('a_comments') ?> :  <?php $total_comments ?>  <br />
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                 <?php if count($comments)>0 ?> 
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th> <?php lang('a_last_comm') ?> </th>
                    </thead>
                    <tbody>
                         <?php foreach $comments as $c ?> 
                        <tr>
                            <td>
                                <span style="font-size:11px;"> <?php date('d-m-Y H:i', $c.date) ?> </span>
                                <br/>
                                <i> <?php $c.user_name ?> :</i>
                                <a class="pjax" href="/admin/components/cp/comments">
                                     <?php truncate($c.text, 50, '...') ?> 
                                </a>
                            </td>
                        </tr>
                         <?php /foreach ?> 
                    </tbody>
                </table>
                 <?php /if ?> 
                 <?php if count($api_news) > 1 ?> 
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th> <?php lang('a_cms_news') ?> </th>
                    </thead>
                    <tbody> 
                         <?php foreach $api_news as $a ?> 
                        <tr><td>
                                <span> <?php date('d-m-Y H:i', $a.publish_date) ?> 
                                    <a style="padding-left:10px;" target="_blank" href="http://www.imagecms.net/blog/news/ <?php $a.url ?> ?utm_source=imagecms&utm_medium=admin&utm_campaign= <?php str_replace(array("http://", "/"), "",site_url()) ?> ">>>></a>
                                </span>
                                <br/>  <?php truncate(strip_tags($a.prev_text), 100) ?> 
                            </td></tr>
                         <?php /foreach ?> 
                    </tbody>
                </table>        
                 <?php /if ?> 
            </div>
        </div>
    </section>
</div><div class="modal hide fade" id="pages_action_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="mvMv"> <?php lang('a_copy_move_title') ?> </h3>
    </div>
    <div class="modal-body">
         <?php lang('a_category') ?> :
        <select id="CopyMoveCategorySelect" url=" <?php $BASE_URL ?> admin/pages/GetPagesByCategory/">
            <option value="0"> <?php lang('a_without_cat') ?> </option>
             <?php  $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'] ));  ?> 
        </select>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang('a_cancel') ?> </a>
        <a href="#" id="confirmMove" class="btn btn-primary" onclick="pagesAdmin.confirmListAction(' <?php $BASE_URL ?> admin/pages/move_pages/copy')" > <?php lang('a_submit') ?> </a>
    </div>
</div>

<div class="modal hide fade" id="pages_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> <?php lang('a_delete_pages_title') ?> </h3>
    </div>
    <div class="modal-body">
         <?php lang('a_delete_pages_promt') ?> 
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang('a_cancel') ?> </a>
        <a href="#" class="btn btn-primary" onclick="pagesAdmin.confirmListAction(' <?php $BASE_URL ?> admin/pages/delete_pages/')" > <?php lang('a_delete') ?> </a>
    </div>
</div>

<form method="post" action="" class="listFilterForm" id="pagesFilterForm">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_cont_list') ?> </span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small disabled action_on listFilterSubmitButton " disabled="disabled" ><i class="icon-filter"></i> <?php lang('a_filtrate') ?> </button>
                    <button onclick="$('#pages_action_dialog').modal();" type="button" class="btn btn-small disabled action_on pages_action" ><i class="icon-asterisk"></i>  <?php lang('a_copy_product') ?> </button>
                    <button onclick="$('#pages_action_dialog').modal();pagesAdmin.updDialogMove();" type="button" class="btn btn-small disabled action_on pages_action" ><i class="icon-move"></i> <?php lang('a_repalce') ?> </button>
                    <button onclick="$('#pages_delete_dialog').modal();pagesAdmin.updDialogCopy();" type="button" class="btn btn-small btn-danger disabled action_on pages_action pages_delete" ><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
                    <!--<button type="button" class="btn btn-small btn-success" onclick="window.location.href=' <?php $BASE_URL ?> admin/pages'"><i class="icon-plus-sign icon-white"></i> <?php lang('a_create_page') ?> </button>-->
                    <a class="btn btn-small btn-success pjax" href=' <?php $BASE_URL ?> admin/pages'><i class="icon-plus-sign icon-white"></i> <?php lang('a_create_page') ?> </a>
                </div>
            </div>                            
        </div>
        <div class="row-fluid">    
             <?php if $show_cat_list == 'yes' ?> 
                <div class="span3">
                    <ul class="nav nav-tabs nav-stacked m-t_10">
                        <li  <?php if '0'==$cat_id ?>  class="active"  <?php /if ?>  ><a href="/admin/pages/GetPagesByCategory/0" class="pjax"> <?php lang('a_without_cat') ?> </a></li>
                        <li  <?php if 'all'==$cat_id ?>  class="active"  <?php /if ?> ><a href="/admin/pages/GetPagesByCategory" class="pjax">Все категории</a></li>
                    </ul>
                    <ul class="nav nav-tabs nav-stacked">
                         <?php foreach $tree as $cat ?> 
                            <li  <?php if $cat_id==$cat.id ?>  class="active"  <?php /if ?> > <a  href="/admin/pages/GetPagesByCategory/ <?php $cat.id ?> " class="pjax"> <?php $cat.name ?> </a></li>
                             <?php if $cat.subtree ?> 
                                 <?php foreach $cat.subtree as $sc1 ?> 
                                    <li  <?php if $cat_id==$sc1.id ?>  class="active"  <?php /if ?> > <a  href="/admin/pages/GetPagesByCategory/ <?php $sc1.id ?> " class="pjax">&nbsp;&nbsp;&nbsp;<span class="simple_tree">↳</span> <?php $sc1.name ?> </a></li>
                                     <?php if $sc1.subtree ?> 
                                         <?php foreach $sc1.subtree as $sc2 ?> 
                                            <li  <?php if $cat_id==$sc2.id ?>  class="active"  <?php /if ?> > <a  href="/admin/pages/GetPagesByCategory/ <?php $sc2.id ?> " class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="simple_tree">↳</span> <?php $sc2.name ?> </a></li>
                                             <?php if $sc2.subtree ?> 
                                                 <?php foreach $sc2.subtree as $sc3 ?> 
                                                    <li  <?php if $cat_id==$sc3.id ?>  class="active"  <?php /if ?> > <a  href="/admin/pages/GetPagesByCategory/ <?php $sc3.id ?> " class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="simple_tree">↳</span> <?php $sc3.name ?> </a></li>
                                                     <?php if $sc3.subtree ?> 
                                                         <?php foreach $sc3.subtree as $sc4 ?> 
                                                            <li  <?php if $cat_id==$sc4.id ?>  class="active"  <?php /if ?> > <a  href="/admin/pages/GetPagesByCategory/ <?php $sc4.id ?> " class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="simple_tree">↳</span> <?php $sc4.name ?> </a></li>
                                                         <?php /foreach ?> 
                                                     <?php /if ?> 
                                                 <?php /foreach ?> 
                                             <?php /if ?> 
                                         <?php /foreach ?> 
                                     <?php /if ?> 
                                 <?php /foreach ?> 
                             <?php /if ?> 
                         <?php /foreach ?> 
                    </ul>
                </div>
             <?php /if ?> 
            <table class="table table-striped table-bordered table-hover table-condensed pages-table span9"  <?php if $show_cat_list != 'yes' ?>  style="width:100%;" <?php /if ?> >
                <thead>
                    <tr>
                        <th class="t-a_c span1">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox"/>
                                </span>
                            </span>
                        </th>
                        <th class="span1">ID</th>
                        <th class="span4"> <?php lang('a_title') ?> </th>
                        <th class="span3"> <?php lang('a_url') ?> </th>
                     <?php if $show_cat_list != 'yes' ?> <th class="span2"> <?php lang('a_category') ?> </th> <?php /if ?> 
                    <th class="span2"> <?php lang('a_date_create') ?> </th>
                    <th class="span1"> <?php lang('a_status') ?> </th>
                </tr>
                <tr class="head_body">
                    <td>
                    </td>
                    <td class="number">
                        <input type="text" name="id" data-original-title=" <?php lang('a_numbers_only') ?> " value=" <?php $_POST['id'] ?> "/>
                    </td>
                    <td>
                        <input type="text" name="title" value=" <?php $_POST['title'] ?> "/>
                    </td>
                    <td>
                        <input type="text" name="url" value=" <?php $_POST['url'] ?> "/>
                    </td>
                     <?php if $show_cat_list != 'yes' ?> 
                        <td>
                            <select id="categorySelect" url=" <?php $BASE_URL ?> admin/pages/GetPagesByCategory/">
                                <option value="">Все категории</option>
                                <option value="0"  <?php if $cat_id === "0" ?> selected="selected" <?php /if ?> >Без категории</option>
                                 <?php  $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['cat_id']));  ?> 
                            </select>
                        </td> <?php /if ?> 
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody data-url="">
                     <?php if count($pages) ?> 
                         <?php foreach $pages as $page ?> 
                            <tr data-id=" <?php $page.id ?> ">
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" data-id=" <?php $page.id ?> " name="ids" value=" <?php $page.id ?> "/>
                                        </span>
                                    </span>
                                </td>
                                <td><span> <?php $page.id ?> </span></td>
                                <td class="share_alt">
                                    <a href=" <?php $BASE_URL ?>  <?php $page.cat_url ?>  <?php $page.url ?> " target="_blank" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title=" <?php lang('a_goto_site') ?> "><i class="icon-share-alt"></i></a>
                                    <a href=" <?php $BASE_URL ?> admin/pages/edit/ <?php $page.id ?> " class="title pjax" data-rel="tooltip" data-original-title=" <?php lang('a_edit') ?> "> <?php $page.title ?> </a>
                                </td>
                                <td><span> <?php truncate($page.url, 40, '...') ?> </span></td>
                                 <?php if $show_cat_list != 'yes' ?> 
                                    <td>
                                        <span> <?php if $category  ?>  <?php $category.name ?>  <?php else: ?> 

                                             <?php if 0 == $page.category ?> 
                                                 <?php lang('a_without_cat') ?> 
                                             <?php else: ?> 

                                                 <?php foreach $cats  as $c ?>  
                                                     <?php if $c.id == $page.category ?> 
                                                         <?php $c.name ?> 
                                                     <?php /if ?> 
                                                 <?php /foreach ?> 

                                             <?php /if ?> 
                                         <?php /if ?> </span>
                                </td> <?php /if ?> 
                                <td>
                                     <?php date('d-m-Y, H:i', $page.publish_date) ?> 
                                </td>
                                <td>
                                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title=" <?php if $page['post_status'] == 'publish' ?>  <?php lang('a_show') ?>  <?php else: ?>  <?php lang('a_dont_show') ?>  <?php /if ?> " onclick="change_page_status(' <?php $page.id ?> ');">
                                        <span class="prod-on_off  <?php if $page['post_status'] != 'publish' ?> disable_tovar <?php /if ?> " style=" <?php if $page['post_status'] != 'publish' ?> left: -28px; <?php /if ?> "></span>
                                    </div>
                                </td>
                            </tr>
                         <?php /foreach ?> 
                     <?php else: ?> 
                        <tr>
                            <td colspan="6">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="alert alert-info" style="margin: 18px;">По Вашему запросу ничего не найдено</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                     <?php /if ?> 
                </tbody>
            </table>
        </div>
         <?php if $paginator > '' ?> 
            <div class="clearfix">
                 <?php $paginator ?> 
            </div>
         <?php /if ?> 
    </section>
</form><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_create') ?>   <?php lang('a_privilege') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/privilegeList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#priv_cr_form" data-action="close" data-submit><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#priv_cr_form" data-action="exit"><i class="icon-check"></i> <?php lang('a_footer_save_exit') ?> </button>                
            </div>
        </div>

    </div>
    <form method="post" action=" <?php $ADMIN_URL ?> privilegeCreate" class="form-horizontal" id="priv_cr_form">
        <div class="tab-content">
            <div class="tab-pane active" id="params">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_param') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="control-group m-t_10">
                                        <label class="control-label" for="Name"> <?php lang('a_name') ?> :</label>
                                        <div class="controls">
                                            <input type="text" name="Name" id="Name" value="" required/>
                                        </div>
                                    </div>                                   
                                    <div class="control-group">
                                        <label class="control-label" for="Title"> <?php lang('a_desc') ?> :</label>
                                        <div class="controls">
                                            <input type="text" name="Title" id="Title" value=""/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="Description">Полное описание:</label>
                                        <div class="controls">
                                            <textarea type="text" name="Description" id="Description" value=""></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="GroupId"> <?php lang('a_group') ?> </label>
                                        <div class="controls">
                                            <select name="GroupId" id="GroupId">
                                                 <?php foreach $groups as $group ?> 
                                                    <option value=" <?php echo $group->id ?> "> <?php echo ShopCore::encode($group->description) ?> </option>
                                                 <?php /foreach ?> 
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
         <?php form_csrf() ?> 
    </form>
</section><div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_cat_translate') ?> </span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/categories/edit/ <?php $orig_cat.id ?> " class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_back') ?> </span></a>
                    <button type="button" class="btn btn-small btn-success  action_on formSubmit" data-action="close" data-form="#save"><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-action="exit" data-form="#save"><i class="icon-check"></i> <?php lang('a_footer_save_exit') ?> </button>

					
                                <div class="dropdown d-i_b">
                                    <?php foreach $langs as $l ?> 
									 <?php if $lang == $l.id ?> 
									<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                                         <?php $l.lang_name ?> 
                                     <span class="caret"></span>
                                    </a>
									 <?php /if ?> 
									 <?php /foreach ?> 

                                    <ul class="dropdown-menu">
									 <?php foreach $langs as $l ?> 
									 <?php if $l.id != $lang ?> 
										 <?php if $l.default ?> 
										<li><a href="/admin/categories/edit/ <?php $orig_cat.id ?> " class="pjax"> <?php $l.lang_name ?> </a></li>
										 <?php else: ?> 
                                        <li><a href="/admin/categories/translate/ <?php $orig_cat.id ?> / <?php $l.id ?> " class="pjax"> <?php $l.lang_name ?> </a></li>
                                         <?php /if ?> 
									 <?php /if ?> 
									 <?php /foreach ?> 
                                    </ul>
                                </div>
                </div>
            </div>                            
        </div>
        <form method="post" active=" <?php $BASE_URL ?> admin/categories/translate/ <?php $orig_cat.id ?> / <?php $lang ?> " id="save">
            <div class="content_big_td">
                
                <div class="tab-content">
                    <div class="tab-pane active">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                         <?php lang('a_info') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span9">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="name"> <?php lang('a_name') ?> :</label>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="name" value=" <?php $cat.name ?> "/>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
							                            <label class="control-label" for="Img">
							                             <?php lang('a_image') ?> :                            
							                            </label>
							                        	<div class="controls">
											    		<div class="group_icon pull-right">
														<button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>   <?php lang('a_select_image') ?> </button>
                                                            </div>
                                                            <div class="o_h">
									                		    <input type="text" name="image" id="Img" value=" <?php $cat.image ?> ">				    
																</div>
											    		</div>
							                        </div>
                                                    
                                                    <div class="control-group">
                                                        <label class="control-label" for="short_desc"> <?php lang('a_desc') ?> :</label>
                                                        <div class="controls">
                                                            <textarea class="elRTE" name="short_desc" id="short_desc" > <?php htmlspecialchars($cat.short_desc) ?> </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="control-group"><label class="control-label" for="title"> <?php lang('a_meta_title') ?> :</label>
                                                        <div class="controls">
                                                            <input type="text" name="title" value=" <?php $cat.title ?> " id="title" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group"><label class="control-label" for="description"> <?php lang('a_meta_description') ?> :</label>
                                                        <div class="controls">
                                                            <textarea id="description"  name="description"  rows="10" cols="180" > <?php $cat.description ?> </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group"><label class="control-label" for="keywords"> <?php lang('a_meta_keywords') ?> :</label>
                                                        <div class="controls">
                                                            <textarea id="keywords" name="keywords" rows="10" cols="180" > <?php $cat.keywords ?> </textarea>
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
            </div>
            </div>
    </section>
</div>
 <?php form_csrf() ?> 
</form>
<div id="elFinder"></div><form action=" <?php $BASE_URL ?> admin/groups/save/ <?php $id ?> " method="post" id="groups_edit_form" style="width:100%;">
	<div class="form_text"> <?php lang('a_name') ?> :</div>
	<div class="form_input"><input type="text" name="alt_name" id="alt_name" value=" <?php $alt_name ?> " class="textbox_short"></div>
	<div class="form_overflow"></div>

	<div class="form_text"> <?php lang('a_identif') ?> :</div>
	<div class="form_input"><input type="text" name="name" value=" <?php $name ?> " id="name" class="textbox_short"> <h5>( <?php lang('a_just_lat') ?> )</h5></div>
	<div class="form_overflow"></div>

	<div class="form_text"> <?php lang('a_desc') ?> :</div>
	<div class="form_input">
	<textarea id="desc" name="desc" class="textearea"> <?php $desc ?> </textarea>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><input type="submit" name="button" class="button"  value=" <?php lang('a_save') ?> " onclick="ajax_me('groups_edit_form');" ></div>
	<div class="form_overflow"></div>
 <?php form_csrf() ?> </form><div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="title"> <?php lang('a_sys_info') ?> </span>
            </div>
        </div>
        <div class="row-fluid">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <tbody>
                    <tr>
                        <td class="span2"> <?php lang('a_server_load') ?> :</td>
                        <td>
                             <?php if function_exists('sys_getloadavg') AND is_array(sys_getloadavg()) ?> 
                                 <?php $load_averages = sys_getloadavg() ?> 
                                 <?php $server_load = $load_averages[0].' '.$load_averages[1].' '.$load_averages[2] ?> 
                             <?php /if ?>  
                        </td>
                    </tr>
                    <tr>
                        <td class="span2">
                            <?php lang('a_server') ?>  
                        </td>
                        <td>
                             <?php lang('a_os') ?> :<span style="padding-left:3px;"><?php echo PHP_OS ?></span><br />
                            PHP:<span style="padding-left:3px;"><?php echo PHP_VERSION ?></span> 
                            <a href="/admin/sys_info/phpinfo" class="pjax"> phpinfo</a>
                        </td>
                    </tr>
                     <?php if $db_version ?> 
                        <tr>
                            <td class="span2">
                                 <?php lang('a_db') ?> 
                            </td>
                            <td>
                                 <?php lang('a_version') ?> :  <?php $db_version ?> <br/>
                                 <?php lang('a_period') ?> :  <?php $db_rows ?> <br/>
                                 <?php lang('a_size') ?> :  <?php $db_size ?> 
                            </td>
                        </tr>
                     <?php /if ?> 
                    <tr>
                        <td class="span2"> <?php lang('a_write_perm') ?> </td>
                        <td>
                             <?php foreach $folders as $k => $v ?> 
                                 <?php if $v == TRUE ?> 
                                     <?php $color='green' ?> 
                                 <?php else: ?> 
                                     <?php $color='#E25B5B' ?> 
                                 <?php /if ?> 
                                <span style="color: <?php $color ?> ;"> <?php $k ?> </span><br />
                             <?php /foreach ?> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </section>
</div>
 <?php lang('a_select_cat') ?> :
<select id="move_cat_id">
<option value="0" selected="selected"> <?php lang('a_no') ?> </option>
 <?php  $this->view("cats_select.tpl", $this->template_vars);  ?> 
</select>
<br/>
<br/>
<div align="center">
<input type="submit" name="button"  class="button" value=" <?php lang('a_send') ?> " onclick="move_to_cat(' <?php $action ?> '); MochaUI.closeWindow($('move_pages_window')); return false;" />
<input type="submit" name="button"  class="button" value=" <?php lang('a_cancel') ?> " onclick="MochaUI.closeWindow($('move_pages_window')); return false;" />
</div>
 <?php if !$ADMIN_URL ?> 
     <?php $ADMIN_URL = '/admin/components/run/shop/' ?> 
 <?php /if ?> 
<nav class="navbar navbar-inverse">
    <ul class="nav">
        <li class="homeAnchor" ><a href=" <?php $ADMIN_URL ?> dashboard" class="pjax "><i class="icon-home"></i><span>Главная</span></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i>Заказы<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="nav-header"> <?php lang('a_orders') ?> </li>
                <li><a href=" <?php $ADMIN_URL ?> orders/index" class="pjax">Все заказы</a></li>
                <li><a href=" <?php $ADMIN_URL ?> orderstatuses" class="pjax">Статусы заказов</a></li>
                <li class="nav-header"> <?php lang('a_callbacks') ?> </li>
                <li><a href=" <?php $ADMIN_URL ?> callbacks" class="pjax">Колбеки</a></li>
                <li><a href=" <?php $ADMIN_URL ?> callbacks/statuses" class="pjax">Статусы колбеков</a></li>
                <li><a href=" <?php $ADMIN_URL ?> callbacks/themes" class="pjax">Темы колбеков</a></li>
                <li class="nav-header"> <?php lang('a_notifications') ?> </li>
                <li><a href=" <?php $ADMIN_URL ?> notifications" class="pjax">Сообщения о появлении</a></li>
                <li><a href=" <?php $ADMIN_URL ?> notificationstatuses/index" class="pjax">Статусы о появлении</a></li>
                <li class="nav-header">Прочее</li>                                  
                <li><a class="pjax" href="/admin/components/cp/comments">Комментарии</a></li>

            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i>Каталог товаров<b class="caret"></b></a>
            <ul class="dropdown-menu">

                <li><a href="/admin/components/run/shop/categories/index" class="pjax">Категории</a>    </li>
                <li><a href="/admin/components/run/shop/search/index" class="pjax">Товары</a></li>
                <li><a href="/admin/components/run/shop/properties/index" class="pjax">Свойства товаров</a></li>
                <li><a href="/admin/components/run/shop/kits/index" class="pjax">Наборы товаров</a></li>
                <li><a href="/admin/components/run/shop/search/index?WithoutImages=1" class="pjax">Товары без картинок</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>Пользователи<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href=" <?php $ADMIN_URL ?> users/index" class="pjax">Список пользователей</a></li>
                <li><a href="/admin/rbac/roleList" class="pjax">Управление правами доступа</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i>Компоненты<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/components/run/shop/brands/index" class="pjax">Бренды</a></li>
                <li><a href="/admin/components/run/shop/warehouses/index" class="pjax">Склады</a></li>
                <li><a href="/admin/components/run/shop/banners/index" class="pjax">Баннеры</a></li>
                <li><a href="/admin/components/run/shop/discounts/index" class="pjax"> <?php lang('a_reg_discount_sh') ?> </a></li>
                <li><a href="/admin/components/run/shop/comulativ/index" class="pjax">Накопительние скидки</a></li>
                <li><a href="/admin/components/run/shop/gifts" class="pjax">Подарочные сертификаты</a></li>
                <li><a href="/admin/components/run/shop/customfields" class="pjax">Дополнительные поля</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i>Настройки<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/components/run/shop/settings" class="pjax">Глобальные настройки</a></li>
                <li><a href="/admin/components/run/shop/currencies" class="pjax">Валюты</a></li>
                <li><a href="/admin/components/run/shop/deliverymethods/index" class="pjax">Способы доставки</a></li>
                <li><a href="/admin/components/run/shop/paymentmethods/index" class="pjax">Способы оплаты</a></li>
                <li><a href="/admin/components/run/shop/system/import">Автоматизация</a></li>
            </ul>
        </li>
    </ul>
        <a class="btn btn-small pull-right btn-info" onclick=" loadBaseInterface();"  href="#"><span class="f-s_14">←</span> Администрировать сайт </a>
</nav>
<form action=" <?php $BASE_URL ?> admin/categories/fast_add/create" method="post" id="fast_add_form" style="width:100%;">

	<div class="form_text"> <?php lang('a_n') ?> :</div>
	<div class="form_input">
        <input type="text" name="name" value="" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text"> <?php lang('a_parent') ?> :</div>
	<div class="form_input">
        <select name="parent_id">
        <option value="0" selected="selected"> <?php lang('a_no') ?> </option>
         <?php  $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat']));  ?> 
        </select>
    </div>

	<div class="form_overflow"></div>

    <div class="form_text"></div>
	<div class="form_input">
    	<input type="submit" name="button" class="button" value="Создать" onclick="ajax_me('fast_add_form');" />
    	<input type="button" name="button" class="button" value="Отмена"  onclick="MochaUI.closeWindow($('fast_add_cat_w')); return false;" />
	</div>

</form>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_edit') ?>   <?php lang('a_privilege') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/privilegeEdit/ <?php echo $idRole ?> " class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_go_back') ?> </span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#priv_ed_form" data-action="close" data-submit><i class="icon-ok"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#priv_ed_form" data-action="exit"><i class="icon-check"></i> <?php lang('a_save_and_exit') ?> </button>    

                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                 <?php if $lang_sel == 'en' ?>  <?php lang('a_english') ?>  <?php else: ?>  <?php lang('a_russian') ?>  <?php /if ?> 
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href=" <?php $BASE_URL ?> admin/rbac/translatePrivilege/ <?php echo $idRole ?> / <?php if $lang_sel == 'en' ?> ru <?php else: ?> en <?php /if ?> ">                                   
                 <?php if $lang_sel == 'en' ?>   <?php lang('a_russian') ?>   <?php else: ?>   <?php lang('a_english') ?>  (beta) <?php /if ?> 
            </a>
        </li> 
    </ul>

</div>
</div>
</div>

</div>
<form method="post" action=" <?php $ADMIN_URL ?>  <?php echo $lang_sel ?> " class="form-horizontal" id="priv_ed_form">
    <div class="tab-content">
        <div class="tab-pane active" id="params">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                             <?php lang('a_param') ?> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span9">                                
                                <div class="control-group">
                                    <label class="control-label" for="Title"> <?php lang('a_desc') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Title" id="Title" value=" <?php echo $model->title ?> "/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description">Полное описание:</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value=" <?php echo $model->description ?> "/>
                                    </div>
                                </div>                                
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
     <?php form_csrf() ?> 
</form>
</section>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> <?php lang('a_widget_deleting') ?> </h3>
    </div>
    <div class="modal-body">
        <p> <?php lang('a_delete_selected_widgets') ?> </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/widgets_manager/delete')" > <?php lang('a_delete') ?> </a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang('a_cancel') ?> </a>
    </div>
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_widgets_list') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_wid"><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
                <a href="/admin/widgets_manager/create_tpl" type="button" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i> <?php lang('a_create_widget') ?> </a>
            </div>
        </div>  
    </div>
     <?php if $error ?> 
        <br>
        <div class="alert alert-error">
             <?php $error ?> 
        </div>
     <?php else: ?>    
         <?php if count($widgets)>0 ?> 
            <form method="post" action="#" class="form-horizontal">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th class="span1 t-a_c">
                                <span class="frame_label no_connection">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th class="span1"> <?php lang('a_id') ?> </th>
                            <th> <?php lang('a_n') ?> </th>
                            <th> <?php lang('a_type') ?> </th>
                            <th> <?php lang('a_desc') ?> </th>
                            <th class="span2 t-a_c"> <?php lang('a_sett') ?> </th>
                        </tr>    
                    </thead>
                    <tbody>
                         <?php foreach $widgets as $widget ?> 
                            <tr class="simple_tr">
                                <td class="span1 t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="ids" value=" <?php $widget.name ?> "/>
                                        </span>
                                    </span>
                                </td>
                                <td> <?php $widget.id ?> </td>
                                <td> 
                                    <a 
                                         <?php if $widget.config == TRUE ?>  
                                            class="pjax" href="/admin/widgets_manager/edit_module_widget/ <?php $widget.id ?> "
                                         <?php /if ?>   
                                         <?php if $widget.type == 'html' ?>  
                                            class="pjax" href="/admin/widgets_manager/edit_html_widget/ <?php $widget.id ?> "
                                         <?php /if ?> 
                                        data-rel="tooltip" data-title=" <?php lang('a_edit') ?> "> <?php $widget.name ?> </a>
                                </td>
                                <td>
                                     <?php switch $widget.type ?> 
                                     <?php case 'module': ?> 
                                     <?php lang('a_module') ?>   <?php $widget.data ?> 
                                     <?php break ?> 
                                     <?php case 'html': ?> 
                                     <?php lang('a_html') ?> 
                                     <?php break ?> 
                                     <?php /switch ?> 
                                </td>
                                <td> <?php $widget.description ?> </td>
                                <td class="span2 t-a_c">
                                     <?php if $widget.config == TRUE ?> 
                                        <a class="btn-small btn pjax" href="/admin/widgets_manager/edit/ <?php $widget.id ?> " data-rel="tooltip" data-title=" <?php lang('a_sett') ?> "><i class="icon-wrench"></i></a>
                                     <?php /if ?> 
                                </td>
                            </tr>
                         <?php /foreach ?> 
                    </tbody>
                </table>
            </form>
         <?php else: ?> 
            </br>
            <div class="alert alert-info">
                 <?php lang('a_no_widgets_created') ?> 
            </div>
         <?php /if ?> 
     <?php /if ?>         
</section> <?php literal ?> 
<script type="text/javascript">
function show_m_install_window(id)
 <?php 
        MochaUI.module_install_window = function() <?php 
            new MochaUI.Window( <?php 
                id: 'mod_install_w',
                title: 'Установка модуля',
                type: 'modal',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/mod_search/display_install_window/' + id,
                width: 540,
                height: 480
             ?> );
         ?> 

        MochaUI.module_install_window();
 ?> 
</script>

<style>
    #modules_list_table th  <?php 
        font-weight:bold;
        background-color:#DCDCDC;
        background-image:url(' <?php /literal ?>  <?php $THEME ?>  <?php literal ?> /images/form_button.png');
        padding:5px;
        color:#fff;
     ?> 

    .mod_desc  <?php  ?> 

    .mod_desc:hover  <?php 
        background-color:#F0F0F0;     
     ?> 
</style>

 <?php /literal ?> 

<div class="top-navigation">
    <ul>
        <li>
        <form style="width:100%;" onsubmit="pages_table.filter(this.id); return false;">Поиск:
                <input type="text" name="keyword"  />
                <input type="submit" value="Поиск" class="button_green" onclick="showMessage(' <?php lang('a_message') ?> ', ' <?php lang('a_modules_search_in_dev') ?> '); return false;" />
          <?php form_csrf() ?> 
         </form>
        </li>
        <li>
             <?php if $install_type == 'ftp' ?> 
                <span class="help-block"> <?php lang('a_for_simple_install') ?>  ./application/modules/</span>
             <?php /if ?> 
        </li>
    </ul>
</div>

<table border="0" width="100%" cellpadding="3" cellspacing="3">
<tr valign="top">
    <td>
         <?php if $action == 'list_modules' ?> 
             <?php if count($modules) > 0 ?> 
                <table border="0" cellpadding="3" cellspacing="4" width="100%" id="modules_list_table">
                <thead>
                    <th> <?php lang('a_n') ?> </th>
                    <th> <?php lang('a_version') ?> </th>
                    <th> <?php lang('a_desc') ?> </th>
                    <th> <?php lang('a_actions') ?> </th>
                </thead>

                 <?php foreach $modules as $m ?> 
                <tr valign="top" class="mod_desc">
                    <td style="min-width:150px;"> <?php $m.name ?> </td>
                    <td style="min-width:50px;"> <?php $m.version ?> </td>
                    <td style="min-width:300px;"> <?php $m.description ?> </td>
                    <td width="100px;" align="right">
                        <div style="padding-right:50px;">
                        <a href="#" onclick="show_m_install_window( <?php $m.id ?> ); return false;"> <?php lang('a_install') ?> </a>
                        </div>
                    </td>
                </tr>
                 <?php /foreach ?> 
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                    <div id="pagination">
                         <?php $pagination ?> 
                    </div>
                    </td>
                    <td></td>
                </tr>
                </table>

             <?php else: ?> 
                 <?php lang('a_for_your_request') ?> 
             <?php /if ?> 
         <?php /if ?> 

         <?php if $action == 'main' ?> 
    

                <table border="0" cellpadding="3" cellspacing="4" width="100%" id="modules_list_table">
                <thead>
                    <th> <?php lang('a_modules_search') ?> </th>
                </thead>

                
                <tr valign="top">
                    <td style="min-width:150px;"> <?php lang('a_modules_search_text') ?> </td>
                </tr>
                
                </table>
         <?php /if ?> 

    </td>

    <td width="200px" valign="top">

        <table border="0" cellpadding="3" cellspacing="4" id="modules_list_table">
        <thead>
            <th width="200px"> <?php lang('a_categories') ?> </th>
        </thead>

        <tr valign="top" width="100%">
            <td>
            <!-- Category list -->
             <?php foreach $categories as $k ?> 
                <a hreh="#" onclick="ajax_div('page', base_url + 'admin/mod_search/category/ <?php $k.id ?> '); return false;"> <?php $k.title ?> </a><br/>
             <?php /foreach ?> 
            </td>
        </tr>

        </table>

    </td>
</tr>
</table>
 <?php if $tree ?> 
    <ul >
         <?php foreach $tree as $item ?> 
        <li ><a style="display:block;width:100%;"><div style="display:block;width:100%;"><div onclick="cats_options( <?php $item.id ?> ,' <?php $page_lang ?> ');" > <?php $item.name ?> </div>
<img onclick="edit_category( <?php $item.id ?> ); return false;" class="penedit" src=" <?php $THEME ?> /images/tree/edit_dir.png" align="right" border="0" alt=" <?php lang('a_change_cat_data') ?> " title=" <?php lang('a_change_cat_data') ?> ">
<img onclick="ajax_div('page', base_url + 'admin/categories/create_form/ <?php $item.id ?> '); return false;" class="penedit" src=" <?php $THEME ?> /images/tree/add_subdir.png" align="right" border="0" alt=" <?php lang('a_add_subcat') ?> " title=" <?php lang('a_add_subcat') ?> ">
<img onclick="ajax_div('page', base_url + 'admin/pages/index/category/ <?php $item.id ?> '); return false;" class="penedit" src=" <?php $THEME ?> /images/tree/add_page.png" align="right" border="0" alt=" <?php lang('a_add_article') ?> " title=" <?php lang('a_add_article') ?> ">
</div></a>   <?php if $item.subtree ?> 
                 <?php  $this->view("cats_tree_css.tpl", array('tree' => $item['subtree'], 'page_lang' => $page_lang, 'THEME' => $THEME));  ?> 
             <?php /if ?> 
            </li>
         <?php /foreach ?> 
    </ul>
 <?php /if ?> 
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_role_group_list') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="$('.modal').modal();"><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
                <a class="btn btn-small btn-success pjax" href="/admin/components/run/shop/rbac/group_create" ><i class="icon-plus-sign icon-white"></i>Создать групу ролей</a>
            </div>
        </div>  
    </div>
    <div class="tab-content">
         <?php if count($model)>0 ?> 
        <div class="row-fluid">
            <form method="post" action="#" class="form-horizontal" data-url-delete="/admin/components/run/shop/rbac/group_delete">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th class="span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" value="On"/>
                                    </span>
                                </span>
                            </th>
                            <th class="span1"> <?php echo $model[0]->getLabel('Id') ?> </th>
                            <th> <?php echo $model[0]->getLabel('Name') ?> </th>
                            <th> <?php echo $model[0]->getLabel('Description') ?> </th>
                        </tr>    
                    </thead>
                    <tbody class="sortable" id="rltbl">
                         <?php foreach $model as $item ?> 
                        <tr>
                            <td>
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" value=" <?php echo $item->getId() ?> " name="id"/>
                                    </span>
                                </span>
                            </td>
                            <td> <?php echo $item->getId() ?> </td>
                            <td>
                                <a class="pjax" href="/admin/components/run/shop/rbac/group_edit/ <?php echo $item->getId() ?> "> <?php echo ShopCore::encode($item->getName()) ?> </a>
                            </td>
                            <td>
                                 <?php echo $item->getDescription() ?> 
                            </td>
                        </tr>
                         <?php /foreach ?> 
                    </tbody>
                </table>
            </form>
        </div>
         <?php else: ?> 
        </br>
        <div class="alert alert-info">
             <?php lang('a_list') ?>   <?php lang('a_group') ?>   <?php lang('a_privilegy') ?>   <?php lang('a_empty') ?> 
        </div>
         <?php /if ?> 
    </div>
</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> <?php lang('a_delete_group') ?> ?</h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');"> <?php lang('a_footer_cancel') ?> </a>
        <a href="" class="btn btn-primary" onclick="shopCategories.deleteCategoriesConfirm();$('.modal').modal('hide');"> <?php lang('a_delete') ?> </a>
    </div>
</div><div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_lang_edit') ?> </span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/languages" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_return') ?> </span></a>
                    <button type="submit"   class="btn btn-small btn-success formSubmit" data-form="#editLang" data-action="edit"><i class="icon-list-alt icon-white"></i> <?php lang('a_save') ?> </button>
                    <button type="submit"   class="btn btn-small formSubmit" data-form="#editLang" data-action="close"><i class="icon-ok"></i> <?php lang('a_save_and_exit') ?> </button>
                </div>
            </div>                            
        </div>
        <div class="content_big_td">
            <div class="tab-content">
                <div class="tab-pane active" id="parameters">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">
                                     <?php lang('a_sett') ?> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <form action=" <?php $BASE_URL ?> admin/languages/update/ <?php $id ?> " method="post" id="editLang">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName"> <?php lang('a_name') ?> :</label>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="" value=" <?php $lang_name ?> " />
                                                        </div>
                                                    </div>    
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName"> <?php lang('a_identif') ?> :</label>
                                                        <div class="controls">
                                                            <input type="text" name="identif" id="" value=" <?php $identif ?> "  />
                                                        </div>
                                                    </div> 
                                                    <div class="row-fluid">
                                                        <!--<div class="control-group">
                                                            <label class="control-label" for="inputName"> <?php lang('a_image_url') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" name="image" id="" value=" <?php $image ?> "/>
                                                            </div>
                                                        </div>-->
                                                        <div class="control-group">
                                                            <label class="control-label" for="Img">
                                                                 <?php lang('a_image_url') ?> :
                                                            </label>
                                                            <div class="controls">
                                                                <div class="group_icon pull-right">            
                                                                    <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                                        return false;"><i class="icon-picture"></i>   <?php lang('a_select_image') ?> </button>
                                                                </div>
                                                                <div class="o_h">		            
                                                                    <input type="text" name="image" id="Img" value=" <?php $image ?> ">					
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputParent"> <?php lang('a_folder') ?> :</label>
                                                            <div class="controls">
                                                                <select name="folder">
                                                                     <?php foreach $lang_folders as $folder ?> 
                                                                        <option  <?php if $folder == $folder_selected ?>  selected="selected"  <?php /if ?>  > <?php $folder ?> </option>
                                                                     <?php /foreach ?> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputParent"> <?php lang('a_tpl') ?> :</label>
                                                            <div class="controls">
                                                                <select name="template">
                                                                     <?php foreach $templates as $template ?> 
                                                                        <option  <?php if $template == $template_selected ?>  selected="selected"  <?php /if ?>  > <?php $template ?> </option>
                                                                     <?php /foreach ?> 
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
        </div>
    </section>
</div>
<div id="elFinder"></div><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="title"> <?php lang('a_widget_edit') ?> <b> <?php $widget.name ?> </b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/widgets_manager/index/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_create') ?> </span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#wid_ed_form" data-submit><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#wid_ed_form" data-action="tomain"><i class="icon-check"></i> <?php lang('a_save_and_exit') ?> </button>
            </div>
        </div>                            
    </div>
    <form method="post" action=" <?php $BASE_URL ?> admin/widgets_manager/update_widget/ <?php $widget.id ?> /info" class="form-horizontal" id="wid_ed_form">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                         <?php lang('a_param') ?> 
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd span9">
                            <div class="control-group m-t_10">
                                <label class="control-label" for="inputName"> <?php lang('a_n') ?> :</label>
                                <div class="controls">
                                    <input type="text" name="name" id="inputName" value=" <?php $widget.name ?> "/>
                                    <p class="help-block"> <?php lang('a_just_lat') ?> </p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputDesc"> <?php lang('a_desc') ?> :</label>
                                <div class="controls">
                                    <input type="text" name="desc" id="inputDesc" value=" <?php $widget.description ?> ">
                                    <p class="help-block"> <?php lang('a_short_widget_desc') ?> </p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_role_group_edit') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/groupEdit/ <?php echo $id ?> " class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#group_ed_form" data-action="tomain" data-submit><i class="icon-ok"></i> <?php lang('a_save') ?> </button>                
                <button type="button" class="btn btn-small formSubmit" data-form="#group_ed_form" data-action="toedit"><i class="icon-check"></i>Сохранить и выйти</button>

                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                 <?php if $lang_sel == 'en' ?>  <?php lang('a_english') ?>  <?php else: ?>  <?php lang('a_russian') ?>  <?php /if ?> 
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href=" <?php $BASE_URL ?> admin/rbac/translateGroup/ <?php echo $id ?> / <?php if $lang_sel == 'en' ?> ru <?php else: ?> en <?php /if ?> ">                                   
                 <?php if $lang_sel == 'en' ?>   <?php lang('a_russian') ?>   <?php else: ?>   <?php lang('a_english') ?>  (beta) <?php /if ?> 
            </a>
        </li> 
    </ul>

</div>
</div>
</div>

</div>  
<form method="post" action=" <?php $ADMIN_URL ?>  <?php echo $lang_sel ?> " class="form-horizontal" id="group_ed_form">
    <div class="tab-content">
        <div class="tab-pane active" id="params">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                             <?php lang('a_param') ?> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span9">
                                <div class="control-group">
                                    <label class="control-label" for="Description"> <?php lang('a_desc') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value=" <?php echo $model->description ?> "/>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
     <?php form_csrf() ?> 
</form>
</section><div id="groups-tabs-block"  style="float:left;width:100%">
	<h4 title=" <?php lang('a_prev_cont') ?> "> <?php lang('a_group_list') ?> </h4>
		<div>
			<table cellpadding="2" cellpadding="2" width="100%">
						<tr style="background-color:#EDEDED">
							<td><b> <?php lang('a_id') ?> </b></td>
							<td><b> <?php lang('a_name') ?> </b></td>
							<td><b> <?php lang('a_identif') ?> </b></td>
							<td><b> <?php lang('a_desc') ?> </b></td>
							<td></td>
						</tr>
						<tbody>
					 <?php foreach $roles as $group ?> 
					<tr>
						<td> <?php $group.id ?> </td>
						<td> <?php $group.alt_name ?> </td>
						<td> <?php $group.name ?> </td>
						<td> <?php $group.desc ?> </td>
						<td>
						<img src=" <?php $THEME ?> /images/edit_page.png" width="16" height="16" style="cursor:pointer;" onclick="edit_group(' <?php $group.id ?> ');">
						<img src=" <?php $THEME ?> /images/delete.png" width="16" height="16" style="cursor:pointer;" onclick="delete_group(' <?php $group.id ?> ');">
						</td>
					</tr>
					 <?php /foreach ?> 

					</tbody>
			</table>
		</div>

	<h4 title=" <?php lang('a_param') ?> "> <?php lang('a_create') ?> </h4>
		<div>
		<form action=" <?php $BASE_URL ?> admin/groups/create" method="post" id="groups_create_form" style="width:100%;">
			<div class="form_text"> <?php lang('a_name') ?> :</div>
			<div class="form_input"><input type="text" name="alt_name" id="alt_name" class="textbox_short"></div>
			<div class="form_overflow"></div>

			<div class="form_text"> <?php lang('a_identif') ?> :</div>
			<div class="form_input"><input type="text" name="name" id="name" class="textbox_short"> ( <?php lang('a_just_lat') ?> )</div>
			<div class="form_overflow"></div>

			<div class="form_text"> <?php lang('a_desc') ?> :</div>
			<div class="form_input">
			<textarea id="desc" name="desc" ></textarea>
			</div>
			<div class="form_overflow"></div>

			<div class="form_text"></div>
			<div class="form_input"><input type="submit" name="button" class="button"  value=" <?php lang('a_create') ?> " onclick="ajax_me('groups_create_form');" ></div>
			<div class="form_overflow"></div>
		 <?php form_csrf() ?> 
        </form>
		</div>
</div>

 <?php literal ?> 
		<script type="text/javascript">
		var groups_tabs = new SimpleTabs('groups-tabs-block',  <?php 
		selector: 'h4'
		 ?> );
		</script>
 <?php /literal ?> <section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_widget_creating') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/widgets_manager/index/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_return') ?> </span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#wid_cr_form" data-action="tomain" data-submit><i class="icon-plus-sign icon-white"></i> <?php lang('a_create') ?> </button>
                <!--<button type="button" class="btn btn-small formSubmit" data-form="#wid_cr_form" data-action="tomain"><i class="icon-check"></i> <?php lang('a_save_and_exit') ?> </button>-->
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <form method="post" action=" <?php $BASE_URL ?> admin/widgets_manager/create" class="form-horizontal" id="wid_cr_form">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_param') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group m-t_10">
                                        <label class="control-label" for="inputName"> <?php lang('a_n') ?> :</label>
                                        <div class="controls">
                                            <input type="text" name="name" id="inputName" class="required"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputDesc"> <?php lang('a_desc') ?> :</label>
                                        <div class="controls">
                                            <input type="text" name="desc" id="inputDesc">
                                            <p class="help-block"> <?php lang('a_short_widget_desc') ?> </p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputType"> <?php lang('a_type') ?> :</label>
                                        <div class="controls">
                                            <select id="inputType" name="type">
                                                <option value="module"> <?php lang('a_module') ?> </option>
                                                <option value="html"> <?php lang('a_html') ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group" id="mod_name">
                                        <label class="control-label"> <?php lang('a_module_name') ?> :</label>
                                        <div class="controls">
                                            <span class="selmod">Выберите тип модуля с таблицы ниже</span>
                                            <input type="hidden" class="required" name="module" value="" id="sw">
                                            <input type="hidden" name="method" value="" id="swm">
                                        </div>
                                    </div>

                                    <div class="control-group" id="textareaholder" style="display:none;">
                                        <label class="control-label">HTML:</label>
                                        <div class="controls" style="top: 6px;">
                                            <textarea name="html_code" rows="15" class="elRTE"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed" id="moduleholder">
                        <thead>
                            <tr>
                                <th class="t-a_c span1"></th>
                                <th class="span3"> <?php lang('a_name') ?> </th>
                                <th class="span5"> <?php lang('a_desc') ?> </th>
                                <th class="span2"> <?php lang('a_type') ?> </th>
                            </tr>
                        </thead>
                        <tbody class="sortable ui-sortable">
                             <?php foreach $blocks as $block ?> 
                                 <?php $mtype = $block.module ?> 
                                 <?php $type = $block.module_name ?> 
                                 <?php foreach $block.widgets as $item ?> 
                                    <tr data-original-title="">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceRadio b_n selwid" data-title=" <?php $item.title ?> " data-mname=" <?php $mtype ?> " data-method=" <?php $item.method ?> ">
                                                    <input type="radio" name="one_column" />
                                                </span>
                                            </span>
                                        </td>
                                        <td><p> <?php $item.title ?> </p></td>
                                        <td><p> <?php $item.description ?> </p></td>
                                        <td><p> <?php $type ?> </p></td>
                                    </tr>
                                 <?php /foreach ?> 
                             <?php /foreach ?> 
                        </tbody>
                    </table>
                </div>
                 <?php form_csrf() ?> 
            </form>
        </div>
    </div>
    <div class="tab-pane"></div>
</div>
</section>


<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_backup_copy') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#createBackup" data-submit><i class="icon-plus-sign icon-white"></i> <?php lang('a_create') ?> </button>
            </div>
        </div>                            
    </div>
    <form action=" <?php $BASE_URL ?> admin/backup/create" method="post" id="createBackup">
        <div class="form-horizontal">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                             <?php lang('a_param') ?> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="control-group m-t_10">
                                    <div class="control-label"></div>
                                    <div class="controls">
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="save_type" value="local" checked="checked" id="inputName"/>
                                            </span>
                                             <?php lang('a_local_copy') ?> 
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="control-label"></div>
                                    <div class="controls">
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="save_type" value="server" /> 
                                            </span>
                                             <?php lang('a_save_on_server') ?> 
                                        </span>
                                        <p class="help-block"> <?php lang('a_save_path') ?>  ./application/backups.</p>
                                    </div>
                                </div>

                                <div class="control-group m-t_10">
                                    <div class="control-label"></div>
                                    <div class="controls">
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="save_type" value="email" />
                                            </span>
                                             <?php lang('a_send_mail') ?> 
                                        </span>
                                        <input type="text" name="email" class="input-large" value=" <?php $user.email ?> " />
                                    </div>
                                </div>
                                <div class="control-group m-t_10">
                                    <label class="control-label" for="inputLocal"> <?php lang('a_file_format') ?> :</label>
                                    <div class="controls">
                                        <span class="frame_label no_connection m-r_15">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="file_type" value="gzip" checked="checked"/>
                                            </span>
                                            gzip
                                        </span>
                                        <span class="frame_label no_connection m-r_15">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="file_type" value="zip" />
                                            </span>
                                            zip
                                        </span>
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="file_type" value="sql" />
                                            </span>
                                            sql
                                        </span>
                                    </div>
                                </div> 
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</section><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/style.css">
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-notify.css">
    </head>
    <body>
        <div class="main_body">

            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container">

                    <a href="/admin" class="logo span3">
                        <img src=" <?php $THEME ?> /img/logo.png"/>
                    </a>
                    <div class="pull-right span3">
                        <div class="clearfix">
                            <div class="pull-left m-r_10">Здравствуйте, <a href="#">Admin<i class="my_icon exit_ico"></i></a></div>
                            <div class="pull-right m-l_10">Просмотр <a href=" <?php $BASE_URL ?> " target="_blank">сайта <span class="f-s_14">→</span></a></div>
                        </div>
                        <form method="post" action="#">
                            <div class="input-append search">
                                <button class="btn pull-right"><i class="icon-search"></i></button>
                                <div class="o_h">
                                    <input id="appendedInputButton" size="16" type="text" class="input-large" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]' autocomplete="off" tabindex="1">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="btn-group">
                        <div class="span4 d-i_b">
                            <a href="#" class="btn btn-large" data-title="asdfg" data-rel="tooltip">
                                <i class="icon-bask active"></i>
                                <span class="badge badge-important">6</span>
                            </a>
                            <a href="#" class="btn btn-large" data-title="asdfg" data-rel="tooltip">
                                <i class="icon-report_exists"></i>
                            </a>
                            <a href="#" class="btn btn-large" data-title="asdfg" data-rel="tooltip">
                                <i class="icon-callback"></i>
                            </a>
                            <a href="#" class="btn btn-large" data-title="asdfg" data-rel="tooltip">
                                <i class="icon-comment_head"></i>
                            </a>
                        </div>
                    </div>
                </section>
            </header>
            <div class="frame_nav">
                <div class="container">
                    <nav class="navbar navbar-inverse">
                        <ul class="nav">
                            <li ><a href="/admin/pages"><i class="icon-home"></i><span>Главная</span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-align-justify"></i> <?php lang('a_content') ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/pages"> <?php lang('a_create') ?> </a></li>
                                    <li><a href="/admin/pages/GetPagesByCategory/0">Все содержимое по категориях</a></li>
                                    <li><a href="/admin/pages/GetPagesByCategory/0"> <?php lang('a_without_cat') ?> </a></li>
                                    <li class="divider"></li>
                                    <li><a href="/admin/components/cp/cfcm"> <?php lang('a_field_constructor') ?> </a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list"></i> <?php lang('a_categories') ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/categories/create_form"> <?php lang('a_create') ?> </a></li>
                                    <li><a href="/admin/categories/cat_list"> <?php lang('a_edit') ?> </a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i> <?php lang('a_menu') ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">

                                    <li><a href="/admin/components/cp/menu"> <?php lang('a_control') ?> </a></li>
                                    <li class="divider"></li>
                                     <?php foreach $menus as $menu ?> 
                                        <li><a href="/admin/components/cp/menu/menu_item/ <?php $menu.name ?> "> <?php $menu.main_title ?> </a></li>
                                     <?php /foreach ?> 

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-circle-arrow-down"></i> <?php lang('a_modules') ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/components/modules_table/"> <?php lang('a_all_modules') ?> </a></li>
                                    <li><a href="/admin/mod_search/"> <?php lang('a_search') ?> </a></li>
                                    <li class="divider returnFalse"></a></li>
                                     <?php if $components ?> 
                                         <?php foreach $components as $component ?> 
                                             <?php if $component['installed'] == TRUE AND $component['admin_file'] == 1 ?> 
                                                <li><a href="/admin/components/cp/ <?php $component.com_name ?> "> <?php $component.menu_name ?> </a></li>
                                             <?php /if ?> 
                                         <?php /foreach ?> 
                                     <?php /if ?> 
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i> <?php lang('a_widgets') ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/widgets_manager/create_tpl"> <?php lang('a_create') ?> </a></li>
                                    <li><a href="/admin/widgets_manager"> <?php lang('a_edit') ?> </a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd"></i> <?php lang('a_system') ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/settings"> <?php lang('a_site_settings') ?> </a></li>
                                    <li><a href="/admin/languages"> <?php lang('a_languages') ?> </a></li>
                                    <li class="dropdown"><a class="returnFalse arrow-right" href=""> <?php lang('a_cache') ?> </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:delete_cache('all')"> <?php lang('a_clean_all') ?> </a></li>
                                            <li><a href="javascript:delete_cache('expried')"> <?php lang('a_clean_old') ?> </a></li>
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="/admin/admin_logs"> <?php lang('a_event_journal') ?> </a></li>
                                    <li><a href="/admin/backup"> <?php lang('a_backup_copy') ?> </a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="btn btn-small pull-right btn-info" href="#">Администрировать сайт <span class="f-s_14">→</span></a>
                    </nav>
                </div>
            </div>
            <div class="container" id="mainContent">
                 <?php $content ?> 
            </div>
            <div class="hfooter"></div>
        </div>
        <footer>
            <div class="container">
                <div class="row-fluid">
                    <div class="span4">
                        Интерфейс:
                        <div class="dropup d-i_b">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                Русский
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Английский</a></li>
                                <li><a href="#">Русский</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span4 t-a_c">
                        Версия: <b>3.01.26</b>
                        <div class="muted">Помогите нам стать еще лучше - <a href="#">сообщите об ошибке</a></div>
                    </div>
                    <div class="span4 t-a_r">
                        <div class="muted">Copyright © imageCMS 2013</div>
                        <a href="http://wiki.imagecms.net" target="blank">Документация</a>
                    </div>
                </div>
            </div>
        </footer>
        <script src=" <?php $THEME ?> /js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/bootstrap.min.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/bootstrap-notify.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/jquery-ui-1.7.3.custom.min.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/pjax/jquery.pjax.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/jquery.form.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/scripts.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/functions.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/admin_base.js" type="text/javascript"></script>
         <?php literal ?> 
            <script>

            $(document).ready(function() <?php 
                    //menu active sniffer
                    $('a.pjax').on('click', function(e) <?php 
                            $('nav li').removeClass('active');
                            $(this).closest('li').addClass('active').closest('li.dropdown').addClass('active').removeClass('open');
                            $.pjax( <?php url: $(this).attr('href'), container:'#mainContent' ?> );
                    return false;
                 ?> )
             ?> )


            </script>
             ?> 
         <?php /literal ?> 
        <div id="jsOutput" style="display: none;"></div>
    </body>
</html> <?php foreach $widgets as $item ?> 
<div class="widget_block">
    <div class="widget_header"><b> <?php $item.module_name ?>  </b></div>

    <div class="info_container">
     <?php foreach $item.widgets as $widget  ?> 
        <div class="widget_info" onclick="select_widget(' <?php $item.module ?> ',' <?php $widget.method ?> ',' <?php $widget.title ?> ');">
            <a> <?php $widget.title ?> </a>
            <p> <?php $widget.description ?> </p>
        </div>
     <?php /foreach ?> 
    </div>

</div>
 <?php /foreach ?> 


 <?php literal ?> 
    <script type="text/javascript">
        var selected_module = '';
        var selected_method = '';
    </script>

    <style type="text/css">
        .widget_block  <?php 
            width:300px;
            border:2px solid #A2C449;
            margin:5px;
            float:left;
         ?> 

        .widget_header  <?php 
            background-color:#E4F5A9;
            padding:5px;
            padding-left:11px;
         ?> 

        .widget_info  <?php 
            padding-left:10px;
            border-bottom:1px solid silver;
         ?> 

        .widget_info:hover  <?php  
            background-color: #D1E2EB;
            cursor:pointer; 
         ?> 

        .info_container  <?php 
         /*   height:200px;
            overflow:auto;
        */
         ?> 
    </style>
 <?php /literal ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title> <?php lang('a_controll_panel') ?>  | Image CMS</title>
	<meta name="description" content=" <?php lang('a_controll_panel') ?>  - Image CMS" />

	<link rel="stylesheet" href=" <?php $THEME ?> /css/content.css" type="text/css" />
	<link rel="stylesheet" href=" <?php $THEME ?> /css/rdTree.css" type="text/css" />
	<link rel="stylesheet" href=" <?php $THEME ?> /css/calendar.css" type="text/css" />
	<link rel="stylesheet" href=" <?php $THEME ?> /css/sortableTable.css" type="text/css" />
	<link rel="stylesheet" href=" <?php $THEME ?> /css/alertbox.css" type="text/css" />
	<link rel="stylesheet" href=" <?php $THEME ?> /css/Autocompleter.css" type="text/css" />
	<link rel="stylesheet" href=" <?php $THEME ?> /css/ui.css" type="text/css" />

    
    <script  type="text/javascript">
        var theme = ' <?php $THEME ?> ';
        var base_url = ' <?php $BASE_URL ?> ';
        var h_steps = 0;
        var cur_pos = 0;
        var tt = 0;
    </script>

	<!--[if IE]>
		<script type="text/javascript" src=" <?php $JS_URL ?> /mocha/excanvas-compressed.js"></script>
	<![endif]-->

	<script type="text/javascript" src=" <?php $JS_URL ?> /compress_js.php"></script>

	<script type="text/javascript" src=" <?php $JS_URL ?> /tinymce/tiny_mce.js.php"></script>
	<script type="text/javascript" src=" <?php $JS_URL ?> /tinymce/plugins/tinybrowser/tb_tinymce.js.php"></script>
	<script type="text/javascript" src=" <?php $JS_URL ?> /tinymce/plugins/tinybrowser/tb_standalone.js.php"></script>
    
    <!-- jQuery with noConflict -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <!-- jQuery with noConflict -->

     <?php ($hook = get_hook('admin_tpl_desktop_head')) ? eval($hook) : NULL; ?> 

     <?php literal ?> 
    <script type="text/javascript">
        window.addEvent('domready', function() <?php 
            ajax_div('page', base_url + 'admin/dashboard/index');
         ?> );
    </script>
     <?php /literal ?> 

     <?php $editor ?> 

    
     <?php check_admin_redirect() ?> 

</head>
<body>
<NOSCRIPT>
    <div style="
         font-size:15px;
         font-weight:bold;
         color:red;
         width:700px;
         margin:200px auto;
         padding:40px;
         border:2px solid #eedddd;
         border-radius:10px;">
        <img src=" <?php $THEME ?> /images/logo1.png" width="130px;" />
        <div style="margin-top:40px;" > <?php lang('a_use_js') ?> </div>
    </div>
</NOSCRIPT>
<div id="desktop">

<div id="desktopHeader">

<div id="desktopTitlebarWrapper">

	<div id="desktopTitlebar">
            <img src=" <?php $THEME ?> /images/logo1.png" id="cmsLogo" onclick="ajax_div('page', base_url + 'admin/dashboard/index'); return false;" style="cursor:pointer;" width="130px;" /> 
        <h2 class="tagline">
 
		</h2>
		<div id="topNav">
			<ul class="menu-right">
            <li>
                <img src=" <?php $THEME ?> /images/left.png" style="cursor:pointer" title="Назад (Ctrl + Left)" onclick="history_back();">
				<img src=" <?php $THEME ?> /images/right.png" style="cursor:pointer" title="Вперед (Ctrl + Right)" onclick="history_forward();">
				<img src=" <?php $THEME ?> /images/refresh.png" style="cursor:pointer" class="refresh" title="Обновить  (Ctrl + R)" onclick="history_refresh();">
            </li>
			</ul>
		</div>
	</div>
    <div class="toolbox" style="display:none;">
	   	
    </div>
</div>

<div style="float:right;color:#fff;padding-top:11px;padding-right:8px;"> 
     <?php lang('a_wellcome') ?> , <span style="color: #CCCCCC"> <?php $username ?> </span>
</div>

<div id="desktopNavbar">
<ul>
	<li><a class="returnFalse" href="#"> <?php lang('a_cont') ?> </a>
		<ul>
			<li><a id="add_page_link" href="#"> <?php lang('a_create') ?> </a></li>
			<li><a id="" href="#" class="returnFalse" onclick="ajax_div('page',base_url + 'admin/pages/GetPagesByCategory/0');"> <?php lang('a_without_cat') ?> </a></li>
			<li class="divider"><a id="" href="#" onclick="com_admin('cfcm'); return false;"> <?php lang('a_field_constructor') ?> </a></li>
		</ul>
	</li>

	<li><a class="returnFalse" href=""> <?php lang('a_categories') ?> </a>
		<ul>
			<li><a id="create_cat_link_" href="#" onclick="ajax_div('page', base_url + 'admin/categories/create_form'); return false;"> <?php lang('a_create') ?> </a></li>
				<li><a class="returnFalse" onclick="ajax_div('page', base_url + 'admin/categories/cat_list'); return false;" href="#"> <?php lang('a_edit') ?> </a></li>
		</ul>
	</li>

	<li><a class="returnFalse" href=""> <?php lang('a_menu') ?> </a>
		<ul>
			<li><a href="#" id="menu_manager_link" onclick="com_admin('menu'); return false;"> <?php lang('a_control') ?> </a></li>
			<li class="divider returnFalse"><a href="#"></a></li>
             <?php foreach $menus as $menu ?> 
			<li><a href="#" onclick="ajax_div('page',base_url + 'admin/components/cp/menu/menu_item/ <?php $menu.name ?> '); return false;"> <?php $menu.main_title ?> </a></li>
             <?php /foreach ?> 
		</ul>
	</li>

	<li>
	<a class="returnFalse" href="#" onclick="ajax_div('page', base_url + 'admin/components/modules_table/'); return false;"> <?php lang('a_modules') ?> </a>
		<ul>
                    <li><a id="all_modules_link" href="#" onclick="ajax_div('page', base_url + 'admin/components/modules_table/'); return false;"> <?php lang('a_all_modules') ?> </a></li> 
                    <li><a id="mod_search_link" href="#" onclick="ajax_div('page', base_url + 'admin/mod_search/'); return false;"> <?php lang('a_search') ?> </a></li>
                    <li class="divider returnFalse"><a href="#"></a></li>
                     <?php if $components ?> 
                         <?php foreach $components as $component ?> 
                             <?php if $component['installed'] == TRUE AND $component['admin_file'] == 1 ?> 
                                <li><a id="" href="#" onclick="com_admin(' <?php $component.com_name ?> '); return false;"> <?php $component.menu_name ?> </a></li>
                             <?php /if ?> 
                         <?php /foreach ?> 
                     <?php /if ?> 
		</ul>
	</li>

	<li><a class="returnFalse" href="#" onclick="ajax_div('page', base_url + 'admin/widgets_manager'); return false;"> <?php lang('a_widgets') ?> </a>
	</li>

	<li>
	<a class="returnFalse" href=""> <?php lang('a_system') ?> </a>
		<ul>
			<li><a id="settings_link" class="returnFalse" href="#"> <?php lang('a_site_settings') ?> </a></li>
            <!-- <li><a id="main_page_link" href="">Главная Страница</a></li> -->
			<li><a id="languages_link" href=""> <?php lang('a_languages') ?> </a></li> 
			<li><a class="returnFalse arrow-right" href=""> <?php lang('a_cache') ?> </a>
				<ul>
					<li><a  href="javascript:delete_cache('all')"> <?php lang('a_clean_all') ?> </a></li>
					<li><a  href="javascript:delete_cache('expried')"> <?php lang('a_clean_old') ?> </a></li>
				</ul>
			</li>
            <li class="divider"><a href="#" onclick="ajax_div('page', base_url + 'admin/admin_logs'); return false;"> <?php lang('a_event_journal') ?> </a></li>
            <li><a href="#" onclick="ajax_div('page', base_url + 'admin/backup'); return false;"> <?php lang('a_backup_copy') ?> </a></li>
		</ul>
	</li>

	<li><a href=" <?php $BASE_URL ?> " target="_blank"> <?php lang('a_show_site') ?> </a></li>
	<li><a href=" <?php $BASE_URL ?> admin/logout"> <?php lang('a_exit') ?> </a></li>
</ul>



</div>
<img id="spinner2" src=" <?php $THEME ?> /images/spinner-placeholder.gif" />
</div>

<div id="dockWrapper">
	<div id="dock">
		<div id="dockPlacement"></div>
		<div id="dockAutoHide"></div>
		<div id="dockSort"><div id="dockClear" class="clear"></div></div>
	</div>
</div>

<div id="pageWrapper"></div>

</div><!-- desktop end -->
</body>
</html>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_edit') ?>   <?php lang('a_privilege') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/privilegeList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_go_back') ?> </span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#priv_ed_form" data-action="close" data-submit><i class="icon-ok"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#priv_ed_form" data-action="exit"><i class="icon-check"></i> <?php lang('a_save_and_exit') ?> </button>    

                <div class="dropdown d-i_b">   
                     <?php $arr = get_lang_admin_folders() ?>                    
                     <?php foreach $arr as $a ?> 
                         <?php if $lang_sel == $a ?> 
                            <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                         <?php if $a == 'english_lang' ?>  <?php lang('a_english') ?>  <?php else: ?>  <?php lang('a_russian') ?>  <?php /if ?> 
                        <span class="caret"></span>
                    </a>
                 <?php /if ?>    
             <?php /foreach ?> 
            <ul class="dropdown-menu">
                 <?php foreach $arr as $a ?> 
                    <li>
                        <a href=" <?php $BASE_URL ?> admin/rbac/translatePrivilege/ <?php echo $model->id ?> / <?php if $a == 'russian_lang' ?> en <?php else: ?> ru <?php /if ?> ">

                     <?php if $a == 'english_lang' ?>  <?php lang('a_russian') ?>   <?php else: ?>   <?php lang('a_english') ?>  (beta) <?php /if ?> 
                </a>
            </li>                          
         <?php /foreach ?> 
    </ul>

</div>
</div>
</div>

</div>
<form method="post" action=" <?php $ADMIN_URL ?>  <?php echo $model->id ?> " class="form-horizontal" id="priv_ed_form">
    <div class="tab-content">
        <div class="tab-pane active" id="params">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                             <?php lang('a_param') ?> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span9">
                                <div class="control-group m-t_10">
                                    <label class="control-label" for="Name"> <?php lang('a_name') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Name" id="Name" value=" <?php echo $model->name ?> " required/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Title"> <?php lang('a_desc') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Title" id="Title" value=" <?php echo $model->title ?> "/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description">Полное описание:</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value=" <?php echo $model->description ?> "/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="GroupId"> <?php lang('a_group') ?> </label>
                                    <div class="controls">
                                        <select name="GroupId" id="GroupId">
                                             <?php foreach $groups as $group ?> 
                                                <option  <?php if $model->group_id == $group->id ?>  selected="selected"  <?php /if ?>  value=" <?php echo $group->id ?> "> <?php echo ShopCore::encode($group->description) ?> </option>
                                             <?php /foreach ?> 
                                        </select>
                                    </div>
                                </div>    
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
     <?php form_csrf() ?> 
</form>
</section><div class="container">       
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_create_cat') ?> </span>
            </div>

            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/categories/cat_list" class="t-d_n m-r_15"><span class="f-s_14 pjax">←</span> <span class="t-d_u"> <?php lang('a_back') ?> </span></a>
                    <button type="button" class="btn btn-small action_on btn-success formSubmit" data-action="edit" data-form="#save" data-submit><i class="icon-plus-sign icon-white"></i> <?php lang('a_create_cat') ?> </button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#save"><i class="icon-check"></i> <?php lang('a_cre_exit_form') ?> </button>                   
                </div>
            </div>                            
        </div>
        <div class="content_big_td">
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#parameters" class="btn btn-small active"> <?php lang('param') ?> </a>
                    <a href="#metatag" class="btn btn-small"> <?php lang('a_meta_tags') ?> </a>
                </div>                    
            </div>
            <form method="post" id="save" action=" <?php $BASE_URL ?> admin/categories/create/new" >
                <div class="tab-content">
                    <div class="tab-pane active" id="parameters">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                         <?php lang('param') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="name"> <?php lang('a_name') ?> :</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" id="name" required>
                                                    </div>
                                                </div>      

                                                <div class="control-group">
                                                    <label class="control-label" for="url"> <?php lang('a_url') ?> :</label>

                                                    <div class="controls">
                                                        <div class="group_icon pull-right">
                                                            <div class="">                                                                           
                                                                <button onclick="translite_title('#name', '#url');" type="button" class="btn btn-small" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp; <?php lang('a_auto_fit_by_url') ?> </button>
                                                            </div>
                                                        </div>
                                                        <div class="o_h">
                                                            <input type="text" name="url" id="url">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="parent_id"> <?php lang('a_parent') ?> :</label>
                                                    <div class="controls">
                                                        <select id="parent_id" name="parent_id">
                                                            <option value="0" selected="selected"> <?php lang('a_no') ?> </option>
                                                             <?php  $this->view("cats_select.tpl", $this->template_vars);  ?> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="category_field_group"> <?php lang('a_fields_group') ?> :</label>
                                                    <div class="controls">
                                                         <?php $f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select() ?> 
                                                        <select name="category_field_group" id="category_field_group">
                                                            <option value="-1"> <?php lang('a_no') ?> </option>
                                                             <?php foreach $f_groups as $k => $v ?> 
                                                            <option value=" <?php $k ?> "  <?php if $k == $category_field_group ?>  selected="selected"  <?php /if ?> > <?php $v ?> </option>
                                                             <?php /foreach ?> 
                                                        </select>

                                                        <p class="help-block"> <?php lang('a_sel_gr_fld_f_subcats') ?> .</p>
                                                        <span class="frame_label no_connection m-t_20">
                                                            <span class="niceCheck b_n">
                                                                <input type="checkbox" value="1" name="category_apply_for_subcats" /> 
                                                            </span>
                                                             <?php lang('a_apply_for_subcats') ?> 
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="field_group"> <?php lang('a_pages_fields_group') ?> :</label>
                                                    <div class="controls">
                                                         <?php $f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select() ?> 
                                                        <select name="field_group" id="field_group">
                                                            <option value="-1"> <?php lang('a_no') ?> </option>
                                                             <?php foreach $f_groups as $k => $v ?> 
                                                            <option value=" <?php $k ?> "  <?php if $k == $field_group ?>  selected="selected"  <?php /if ?> > <?php $v ?> </option>
                                                             <?php /foreach ?> 
                                                        </select>
                                                        <span class="help-block"> <?php lang('a_select_fields_group') ?> .</span>
                                                        <span class="frame_label no_connection m-t_20">
                                                            <span class="niceCheck b_n">
                                                                <input type="checkbox" value="1" name="apply_for_subcats" /> 
                                                            </span>
                                                             <?php lang('a_apply_for_subcats') ?> 
                                                        </span>
                                                    </div>
                                                </div>
                                                         
                                                <div class="control-group">
                                                    <label class="control-label" for="Img">
                                                         <?php lang('a_image') ?> :                            
                                                    </label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">
                                                            <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>   <?php lang('a_select_image') ?> </button>
                                                        </div>
                                                        <div class="o_h">
                                                            <input type="text" name="image" id="Img"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="position"> <?php lang('a_position') ?> :</label>
                                                    <div class="controls">
                                                        <input type="text" name="position" value="0"  id="position" />
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="short_desc"> <?php lang('a_desc') ?> :</label>
                                                    <div class="controls">
                                                        <textarea name="short_desc" id="short_desc" class="elRTE"></textarea>
                                                    </div>
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
                                         <?php lang('a_page_view') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="order_by"> <?php lang('a_sort') ?> :</label>
                                                    <div class="controls">
                                                        <div class="pull-left span6 p-r_10">
                                                            <select name="order_by" id="order_by">
                                                                <option value="publish_date" selected="selected"> <?php lang('a_by_date') ?> </option>    
                                                                <option value="title"> <?php lang('a_by_abc') ?> </option>    
                                                                <option value="position"> <?php lang('a_by_pos') ?> </option>    
                                                            </select>
                                                        </div>
                                                        <div class="pull-left span6 p-l_10">
                                                            <select name="sort_order">
                                                                <option value="desc" selected="selected"> <?php lang('a_desc_order') ?> </option> 
                                                                <option value="asc"> <?php lang('a_asc_order') ?> </option>    
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="per_page"> <?php lang('a_records_count') ?> :</label>
                                                    <div class="controls">
                                                        <input type="text" name="per_page" value="15" id="per_page"/> 
                                                        <div class="frame_label no_connection m-t_20">
                                                            <span class="niceCheck b_n">
                                                                <input type="checkbox" name="comments_default" value="1" />
                                                            </span>
                                                             <?php lang('a_comm_by_def') ?> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="fetch_pages"> <?php lang('a_disp_pages_f_other_cats') ?> :</label>
                                                    <div class="controls">

                                                        <div class="o_h">
                                                            <select name="fetch_pages[]"  multiple="multiple" size="5" id="fetch_pages">
                                                                 <?php foreach $include_cats as $c ?> 
                                                                <option value=" <?php $c.id ?> ">  <?php for $i=0; $i < $c.level;$i++ ?> - <?php /for ?>   <?php $c.name ?> </option>
                                                                 <?php /foreach ?> 
                                                            </select>

                                                        </div>
                                                    </div></div>

                                                <div class="control-group">
                                                    <label class="control-label" for="main_tpl"> <?php lang('a_main_tpl') ?> :</label>
                                                    <div class="controls">
                                                        <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                        <div class="o_h">
                                                            <input type="text" name="main_tpl" value=""  id="main_tpl" />                                                                              </div>
                                                        <span class="help-block"> <?php lang('a_main_tpl_by_def') ?>   main.tpl</span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="tpl"> <?php lang('a_cat_tpl') ?> :</label>
                                                    <div class="controls">
                                                        <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                        <div class="o_h">
                                                            <input type="text" name="tpl" value="" id="tpl" /> 

                                                        </div>
                                                        <span class="help-block"> <?php lang('a_main_cat_tpl_by_def') ?>   category.tpl</sapn>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="page_tp"> <?php lang('a_pages_tpl') ?> :</label>
                                                    <div class="controls">
                                                        <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                        <div class="o_h">
                                                            <input type="text" name="page_tpl" value="" id="page_tp" />                                                           
                                                        </div>
                                                        <span class="help-block"> <?php lang('a_pages_view_tpl_by_def') ?>  page_full.tpl</span>
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
                                         <?php lang('a_meta_tags') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="title"> <?php lang('a_meta_title') ?> :</label>
                                                    <div class="controls">
                                                        <input type="text" name="title" value="" id="title" />
                                                    </div>
                                                </div>
                                                <div class="control-group"><label class="control-label" for="descriptions"> <?php lang('a_meta_description') ?> :</label>
                                                    <div class="controls">
                                                        <textarea id="descriptions"  name="description" rows="10" cols="180" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group"><label class="control-label" for="keywordss"> <?php lang('a_meta_keywords') ?> :</label>
                                                    <div class="controls">
                                                        <textarea id="keywordss" name="keywords" rows="10" cols="180" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>   
                     <?php ($hook = get_hook('admin_tpl_create_category')) ? eval($hook) : NULL; ?> 
                     <?php form_csrf() ?> 
            </form>
            <div class="tab-pane">

            </div>
        </div>
</div>
</section>
</div>
<div id="elFinder"></div><div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_edit_user_mod') ?> </span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/categories/cat_list" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_back') ?> </span></a>
                    <button type="submit" class="btn btn-small btn-primary action_on formSubmit" data-action="edit" data-form="#save" data-submit><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#save"><i class="icon-check"></i> <?php lang('a_footer_save_exit') ?> </button>

                    <div class="dropdown d-i_b">
                         <?php foreach $langs as $l ?> 
                         <?php if $l['default'] == 1 ?> 
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                             <?php $l.lang_name ?> 
                            <span class="caret"></span>

                        </a>
                         <?php /if ?>    
                         <?php /foreach ?> 
                        <ul class="dropdown-menu">
                             <?php foreach $langs as $l ?> 
                             <?php if !$l.default ?> 
                            <li><a href=" <?php $BASE_URL ?> admin/categories/translate/ <?php $id ?> / <?php $l.id ?> "> <?php $l.lang_name ?> </a></li>
                             <?php /if ?> 
                             <?php /foreach ?> 
                        </ul>

                    </div>
                        
                </div>
            </div>                            
        </div>
        <form method="post" action=" <?php $BASE_URL ?> admin/categories/create/update/ <?php $id ?> " id="save" class="form-horizontal">
            <div class="content_big_td">
                <div class="clearfix">
                    <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                        <a href="#parameters" class="btn btn-small active"> <?php lang('param') ?> </a>
                        <a href="#metatag" class="btn btn-small"> <?php lang('a_meta_tags') ?> </a>
                        <a href="#dodPol" class="btn btn-small"> <?php lang('a_addit_fiel_bas_a') ?> </a>
                    </div>                    
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="parameters">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                         <?php lang('a_info') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="name"> <?php lang('a_name') ?> :</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" value=" <?php $name ?> " id="name">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="url"> <?php lang('a_url') ?> :</label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">
                                                            <div>
                                                                <button onclick="translite_title('#name', '#url');" type="button" class="btn btn-small" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp; <?php lang('a_auto_fit_by_url') ?> </button>
                                                            </div>
                                                        </div>
                                                        <div class="o_h">
                                                            <input type="text" name="url" value=" <?php $url ?> " id="url">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="parent_id"> <?php lang('a_parent') ?> :</label>
                                                    <div class="controls">
                                                        <select name="parent_id" id="parent_id">
                                                            <option value="0"> <?php lang('a_no') ?> </option>
                                                             <?php   $this->view("cats_select.tpl", $this->template_vars) ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="category_field_group"> <?php lang('a_fields_group') ?> :</label>
                                                    <div class="controls">

                                                         <?php $f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select() ?> 
                                                        <select name="category_field_group" id="category_field_group">
                                                            <option value="-1"> <?php lang('a_no') ?> </option>
                                                             <?php foreach $f_groups as $k => $v ?> 
                                                            <option value=" <?php $k ?> "  <?php if $k == $category_field_group ?>  selected="selected"  <?php /if ?> > <?php $v ?> </option>
                                                             <?php /foreach ?> 
                                                        </select>
                                                        <p class="help-block"> <?php lang('a_sel_gr_fld_f_subcats') ?> </p>
                                                        <span class="frame_label no_connection m-t_20">
                                                            <span class="niceCheck b_n">
                                                                <input type="checkbox" value="1" name="category_apply_for_subcats" 
                                                                 <?php if  $settings['category_apply_for_subcats']== '1' ?>  checked  <?php /if ?> > 
                                                            </span>
                                                             <?php lang('a_apply_for_subcats') ?> 
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="field_group"> <?php lang('a_pages_fields_group') ?> :</label>
                                                    <div class="controls">
                                                         <?php $f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select() ?> 
                                                        <select name="field_group" id="field_group">
                                                            <option value="-1"> <?php lang('a_no') ?> </option>
                                                             <?php foreach $f_groups as $k => $v ?> 
                                                            <option value=" <?php $k ?> "  <?php if $k == $field_group ?>  selected="selected"  <?php /if ?> > <?php $v ?> </option>
                                                             <?php /foreach ?> 
                                                        </select>
                                                        <p class="help-block"> <?php lang('a_select_fields_group') ?> </p>
                                                        <span class="frame_label no_connection m-t_20">
                                                            <span class="niceCheck b_n">
                                                                <input type="checkbox" value="1" name="apply_for_subcats"
                                                                        <?php if  $settings['apply_for_subcats']== '1' ?>  checked  <?php /if ?> >  
                                                            </span>
                                                             <?php lang('a_apply_for_subcats') ?> 
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="control-group">
                                                    <label class="control-label" for="Img">
                                                         <?php lang('a_image') ?> :                            
                                                    </label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">
                                                            <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>   <?php lang('a_select_image') ?> </button>
                                                        </div>
                                                        <div class="o_h">
                                                            <input type="text" name="image" id="Img" value=" <?php $image ?> ">				    
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="control-group">
                                                    <label class="control-label" for="position"> <?php lang('a_position') ?> :</label>
                                                    <div class="controls">
                                                        <input type="text" name="position" value=" <?php $position ?> " id="position">
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="short_desc"> <?php lang('a_desc') ?> :</label>
                                                    <div class="controls">
                                                        <textarea name="short_desc" id="short_desc" class="elRTE"> <?php htmlspecialchars($short_desc) ?> </textarea>
                                                    </div>
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
                                         <?php lang('a_page_view') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="order_by"> <?php lang('a_sort') ?> :</label>
                                                    <div class="controls">
                                                        <div class="pull-left span6">
                                                            <select name="order_by" id="order_by">
                                                                <option value="publish_date"  <?php if $order_by == "publish_date" ?>  selected="selected"  <?php /if ?> > <?php lang('a_by_date') ?> </option>
                                                                <option value="title"  <?php if $order_by == "title" ?>  selected="selected"  <?php /if ?> > <?php lang('a_by_abc') ?> </option>
                                                                <option value="position"  <?php if $order_by == "position" ?>  selected="selected"  <?php /if ?> > <?php lang('a_by_pos') ?> </option>
                                                            </select>
                                                        </div>
                                                        <div class="pull-left span6">

                                                            <select name="sort_order">
                                                                <option value="desc"  <?php if $sort_order == "desc" ?>  selected="selected"  <?php /if ?> > <?php lang('a_desc_order') ?> </option>
                                                                <option value="asc"  <?php if $sort_order == "asc" ?>  selected="selected"  <?php /if ?> > <?php lang('a_asc_order') ?> </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="per_page"> <?php lang('a_records_count') ?> :</label>
                                                    <div class="controls">

                                                        <input type="text" name="per_page" value=" <?php $per_page ?> " id="per_page" />
                                                        <div class="frame_label no_connection m-t_20">
                                                            <span class="niceCheck b_n">
                                                                <input type="checkbox" name="comments_default" value="1"  <?php if $comments_default == 1  ?>  checked="checked"  <?php /if ?>   />  
                                                            </span>
                                                             <?php lang('a_comm_by_def') ?> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="fetch_pages"> <?php lang('a_disp_pages_f_other_cats') ?> :</label>
                                                    <div class="controls">

                                                        <div class="o_h">
                                                            <select name="fetch_pages[]"  multiple="multiple" size="5" id="fetch_pages">
                                                                 <?php if !$fetch_pages ?> 
                                                                 <?php $fetch_pages = Array() ?> 
                                                                 <?php /if ?> 
                                                                 <?php foreach $include_cats as $c ?> 
                                                                <option value=" <?php $c.id ?> "  <?php if in_array($c.id, $fetch_pages) ?>   selected="selected"  <?php /if ?> >  <?php for $i=0; $i < $c.level;$i++ ?> - <?php /for ?>   <?php $c.name ?> </option>
                                                                 <?php /foreach ?> 
                                                            </select>

                                                        </div>
                                                    </div></div>
                                                <div class="control-group">
                                                    <label class="control-label" for="main_tp"> <?php lang('a_main_tpl') ?> :</label>
                                                    <div class="controls">
                                                        <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                        <div class="o_h">
                                                            <input type="text" name="main_tpl" value=" <?php $main_tpl ?> "  id="main_tp" />                                                                              </div>
                                                        <p class="help-block"> <?php lang('a_main_tpl_by_def') ?>   main.tpl</p>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="tpl"> <?php lang('a_cat_tpl') ?> :</label>
                                                    <div class="controls">
                                                        <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                        <div class="o_h">
                                                            <input type="text" name="tpl" value=" <?php $tpl ?> " id="tpl" /> 

                                                        </div>
                                                        <p class="help-block"> <?php lang('a_main_cat_tpl_by_def') ?>   category.tpl</p>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="page_tpl"> <?php lang('a_pages_tpl') ?> :</label>
                                                    <div class="controls">
                                                        <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                        <div class="o_h">
                                                            <input type="text" name="page_tpl" value=" <?php $page_tpl ?> " id="page_tpl" />                                                           
                                                        </div>
                                                        <p class="help-block"> <?php lang('a_pages_view_tpl_by_def') ?>  page_full.tpl</p>
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
                                         <?php lang('a_meta_tags') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="control-group"><label class="control-label" for="title"> <?php lang('a_meta_title') ?> :</label>
                                                    <div class="controls">
                                                        <input type="text" name="title" value=" <?php $title ?> " id="title" />
                                                    </div>
                                                </div>
                                                <div class="control-group"><label class="control-label" for="description"> <?php lang('a_meta_description') ?> :</label>
                                                    <div class="controls">
                                                        <textarea id="description" name="description"  rows="10" cols="180" > <?php $description ?> </textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group"><label class="control-label" for="keywords"> <?php lang('a_meta_keywords') ?> :</label>
                                                    <div class="controls">
                                                        <textarea id="keywords" name="keywords" rows="10" cols="180" > <?php $keywords ?> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="dodPol">
                         <?php echo $this->CI->load->module('cfcm/admin')->form_from_category_group($id, $id, 'category') ?> 
                    </div>
                </div>
            </div>
             <?php form_csrf() ?> 
        </form>
    </section>
</div>
<div id="elFinder"></div><div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3> <?php lang('a_rbak_delete_role') ?> </h3>
        </div>
        <div class="modal-body">
            <p> <?php lang('a_rbak_del_role_gro') ?> </p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm(' <?php $ADMIN_URL ?> roleDelete')" > <?php lang('a_delete') ?> </a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
        </div>
    </div>


    <div id="delete_dialog" style="display: none">
         <?php lang('a_rb_del_roles') ?> 
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <form method="post" action="#">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title"> <?php lang('a_role_list') ?> </span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_role"><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
                        <a class="btn btn-small pjax btn-success" href="/admin/rbac/roleCreate" ><i class="icon-plus-sign icon-white"></i> <?php lang('a_rbak_new_role') ?> </a>
                    </div>
                </div>  
            </div>
            <div class="tab-content m-t_20">
                 <?php if count($model)>0 ?> 
                    <div class="row-fluid">
                        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                            <thead>
                                <tr>
                                    <th class="span1">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox"/>
                                            </span>
                                        </span>
                                    </th>
                                    <th class="span1"> <?php lang('a_id') ?> </th>
                                    <th> <?php lang('a_name') ?> </th>
                                    <th> <?php lang('a_desc') ?> </th>                                   
                                </tr>    
                            </thead>
                            <tbody>
                                 <?php foreach $model as $item ?> 
                                    <tr data-id=" <?php echo $item->id ?> " data-imp= <?php echo $item->importance ?> >
                                        <td> <?php if $item->id != 1 ?> 
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" value=" <?php echo $item->id ?> " name="ids"/>
                                                </span>
                                            </span>
                                                 <?php /if ?> 
                                        </td>
                                        <td><a class="pjax" href="/admin/rbac/roleEdit/ <?php echo $item->id ?> "> <?php echo $item->id ?> </a></td>
                                        <td>
                                            <a class="pjax" href="/admin/rbac/roleEdit/ <?php echo $item->id ?> "> <?php echo $item->alt_name ?> </a>
                                        </td>
                                        <td>
                                             <?php echo $item->description ?> 
                                        </td>
                                    </tr>
                                 <?php /foreach ?> 
                            </tbody>
                        </table>
                    </div>
                 <?php else: ?> 
                    </br>
                    <div class="alert alert-info">
                         <?php lang('a_list') ?>   <?php lang('a_role') ?>   <?php lang('a_empty') ?> 
                    </div>
                 <?php /if ?> 
            </div>
        </section>
    </form>
</div><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_role_edit') ?> :  <?php echo $model->alt_name ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/roleList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_back') ?> </span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#role_ed_form" data-action="edit" data-submit><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#role_ed_form" data-action="exit"><i class="icon-check"></i> <?php lang('a_footer_save_exit') ?> </button>

                <div class="dropdown d-i_b">   
                     <?php $arr = get_lang_admin_folders() ?>                    
                     <?php foreach $arr as $a ?> 
                         <?php if $lang_sel->lang_sel == $a ?> 
                            <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                         <?php if $a == 'english_lang' ?>  <?php lang('a_english') ?>  <?php else: ?>  <?php lang('a_russian') ?>  <?php /if ?> 
                        <span class="caret"></span>
                    </a>
                 <?php /if ?>    
             <?php /foreach ?> 
            <ul class="dropdown-menu">
                 <?php foreach $arr as $a ?> 
                    <li>
                        <a href=" <?php $BASE_URL ?> admin/rbac/translateRole/ <?php echo $model->id ?> / <?php if $a == 'russian_lang' ?> en <?php else: ?> ru <?php /if ?> ">
                     <?php if $a == 'english_lang' ?>  <?php lang('a_russian') ?>   <?php else: ?>   <?php lang('a_english') ?>  (beta) <?php /if ?> 
                </a>
            </li>                          
         <?php /foreach ?> 
    </ul>
</div>
</div>
</div>
</div>
<form method="post" action=" <?php $ADMIN_URL ?>  <?php echo $model->id ?> " class="form-horizontal" id="role_ed_form">
    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
        <thead>
            <tr>
                <th colspan="6">
                     <?php lang('a_param') ?> 
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <div class="row-fluid">
                            <div class="control-group m-t_10">
                                <label class="control-label" for="Name"> <?php lang('a_name') ?> :</label>
                                <div class="controls">
                                    <input type="text" name="Name" id="Name" value=" <?php echo $model->name ?> " />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="alt_name"> <?php lang('a_description') ?> :</label>
                                <div class="controls">
                                    <input type="text" name="alt_name" id="alt_name" value=" <?php echo $model->alt_name ?> "/>
                                </div>
                            </div>          
                            <div class="control-group">
                                <label class="control-label" for="Description">Полное описание:</label>
                                <div class="controls">
                                    <input type="text" name="Description" id="Description" value=" <?php echo $model->description ?> "/>
                                </div>
                            </div>    
                            <div class="control-group">
                                <label class="control-label" for="Importance"> <?php lang('a_imp_rbak') ?> :</label>
                                <div class="controls">
                                    <input type="text" name="Importance" id="Importance" value=" <?php echo $model->importance ?> "/>
                                </div>
                            </div>    
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
         <?php if strpos(getCmsNumber(), 'Premium') ?> <a href="#shop" class="btn btn-small">Магазин</a> <?php /if ?> 
        <a href="#base" class="btn btn-small active">Базовая</a>
        <a href="#module" class="btn btn-small">Модули</a>
    </div> 
    <div class="tab-content">
         <?php foreach $types as $key => $type ?> 
             <?php if  strpos(getCmsNumber(), 'Premium') OR  $key!='shop' ?> 
            <div class="tab-pane row  <?php if $key == 'base' ?> active <?php /if ?> " id=" <?php echo $key ?> ">
                 <?php foreach $type as $k => $groups ?>  
                    <div class="span3">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="t-a_c span1">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" />
                                            </span>
                                        </span>
                                    </th>                           
                                    <th> <?php echo $groups['description'] ?> </th>
                                </tr>                        
                            </thead>
                            <tbody class="sortable">
                                 <?php foreach $groups['privileges'] as $privilege ?> 
                                     <?php $checked = null ?> 
                                 <?php if in_array((int)$privilege['id'], $privilegeCheck) ?>  <?php $checked = 1 ?>  <?php /if ?> 
                                <tr  <?php if $checked == 1 ?> class="active" <?php /if ?> >       
                                    <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">  
                                                <input type="checkbox" class="chldcheck"  value=" <?php echo $privilege['id'] ?> " name="Privileges[]"  <?php if $checked == 1 ?>  checked="checked"  <?php /if ?> />
                                            </span>
                                        </span>
                                    </td>
                                    <td style="word-wrap : break-word;">
                                        <p title=" <?php echo $privilege['description'] ?> "> <?php echo $privilege['title'] ?> </p>
                                    </td>
                                    <!--<td><a href="/admin/rbac/deletePermition/ <?php echo $privilege['id'] ?> " class="pjax">удаление</a></td>-->
                                </tr>
                             <?php /foreach ?> 
                        </tbody>
                    </table>
                </div>
             <?php /foreach ?> 
        </div>
         <?php /if ?> 
     <?php /foreach ?> 
</div>
 <?php form_csrf() ?> 
</form>
</section><div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3> <?php lang('a_module_delete') ?> </h3>
        </div>
        <div class="modal-body">
            <p> <?php lang('a_delete_selected_modules') ?> </p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/deinstall')" > <?php lang('a_delete') ?> </a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang('a_cancel') ?> </a>
        </div>
    </div>


    <div id="delete_dialog" title=" <?php lang('a_module_delete') ?> " style="display: none">
         <?php lang('a_delete_module') ?> 
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <form method="post" action="#">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title" id="allM"> <?php lang('a_all_modules') ?> </span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="module_delete"><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
                    </div>
                </div>    
            </div>
            <div class="btn-group myTab m-t_10" data-toggle="buttons-radio">
                <a href="#modules" class="btn btn-small active" onclick="$('#allM').html(' <?php lang('a_all_modules') ?> ')"> <?php lang('a_modules') ?> </a>
                <a href="#set_modul" class="btn btn-small" onclick="$('#allM').html(' <?php lang('a_install_modules') ?> ')"> <?php lang('a_install_modules') ?> </a>
            </div>
            <div class="tab-content">
                 <?php if count($installed) != 0 ?> 
                    <div class="tab-pane active" id="modules">
                        <div class="row-fluid">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="span1 t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox"/>
                                                </span>
                                            </span>
                                        </th>
                                        <th class="span3"> <?php lang('a_module') ?> </th>
                                        <th class="span3"> <?php lang('a_desc') ?> </th>
                                        <th class="span2"> <?php lang('a_url') ?> </th>
                                        <th class="span2 t-a_c"> <?php lang('a_autoload') ?> </th>
                                        <th class="span2 t-a_c"> <?php lang('a_url_access') ?> </th>
                                        <th class="span2 t-a_c"> <?php lang('a_show_in_menu') ?> </th>
                                    </tr>
                                </thead>
                                <tbody class="sortable save_positions" data-url="/admin/components/save_components_positions">
                                     <?php foreach $installed as $module ?> 
                                        <tr data-id=" <?php $module.id ?> ">
                                            <td class="t-a_c">
                                                <span class="frame_label">
                                                     <?php if $module.name != 'shop' ?> 
                                                    <span class="niceCheck b_n">
                                                        <input type="checkbox" name="ids" value=" <?php $module.name ?> "/>
                                                    </span>
                                                     <?php /if ?> 
                                                </span>
                                            </td>
                                            <td>
                                                 <?php if $module['admin_file'] == 1 ?> 
                                                     <?php if $module.name == 'shop' ?> 
                                                         <?php $module.menu_name ?> 
                                                     <?php else: ?> 
                                                        <a href="/admin/components/init_window/ <?php $module.name ?> " class="pjax"> <?php $module.menu_name ?> </a>
                                                     <?php /if ?> 
                                                 <?php else: ?> 
                                                     <?php $module.menu_name ?> 
                                                 <?php /if ?> 
                                                <!--                                    <a href="#">Пользователи</a>-->
                                            </td>
                                            <td>
                                                <p> <?php $module.description ?> </p>
                                            </td>
                                            <td class="urlholder">
                                                <p> <?php if $module['enabled'] == "1" ?>  <?php anchor($module.identif,$module.identif,array('target'=>'_blank')) ?>  <?php else: ?> - <?php /if ?> </p>
                                            </td>
                                            <td class="t-a_c">
                                                <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title=" <?php lang('a_turn_on') ?> "  data-off=" <?php lang('a_turn_off') ?> ">
                                                    <span class="prod-on_off autoload_ch  <?php if !$module.autoload ?> disable_tovar <?php /if ?> " data-mid=" <?php $module.id ?> "></span>
                                                </div>
                                            </td>
                                            <td class="t-a_c">
                                                <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title=" <?php lang('a_turn_on') ?> "  data-off=" <?php lang('a_turn_off') ?> ">
                                                    <span class="prod-on_off urlen_ch  <?php if !$module.enabled ?> disable_tovar <?php /if ?>   <?php if $module.name == 'filter' ?> disabled <?php /if ?> " data-mid=" <?php $module.id ?> " data-murl=" <?php $BASE_URL ?>  <?php $module.identif ?> " data-mname=" <?php $module.identif ?> "></span>
                                                </div>
                                            </td>
                                            <td class="t-a_c">
                                                <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title=" <?php lang('a_turn_on') ?> "  data-off=" <?php lang('a_turn_off') ?> ">
                                                    <span class="prod-on_off show_in_menu  <?php if $module.in_menu == 0 ?> disable_tovar <?php /if ?> " data-mid=" <?php $module.id ?> "></span>
                                                </div>
                                            </td>
                                        </tr>
                                     <?php /foreach ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                 <?php else: ?> 
                    <h3> <?php lang('a_modules_not_installed') ?> </h3>
                 <?php /if ?> 
                <div class="tab-pane" id="set_modul">
                     <?php if count($not_installed) > 0 ?> 
                        <div class="row-fluid" id="nimc">
                            <table class="table table-striped table-bordered table-hover table-condensed" id="nimt">
                                <thead>
                                    <tr>
                                        <th class="span3"> <?php lang('a_module') ?> </th>
                                        <th class="span3"> <?php lang('a_desc') ?> </th>
                                        <th class="span2"> <?php lang('a_version') ?> </th>
                                        <th class="span1"> <?php lang('a_install') ?> </th>
                                    </tr>
                                </thead>
                                <tbody class="nim">
                                     <?php foreach $not_installed as $module ?> 
                                        <tr>
                                            <td>
                                                <a href="#"> <?php $module.menu_name ?> </a>
                                            </td>
                                            <td>
                                                <p> <?php $module.description ?> </p>
                                            </td>
                                            <td class="fdel">
                                                <p> <?php $module.version ?> </p>
                                            </td>
                                            <td class="fdel2">
                                                <a href="#" class="mod_instal" data-mname=" <?php $module.com_name ?> " data-mid=" <?php $module.id ?> "> <?php lang('a_install') ?> </a>
                                            </td>
                                        </tr>
                                     <?php /foreach ?> 
                                </tbody>
                            </table>
                        </div>
                     <?php else: ?> 
                        </br>
                        <div class="alert alert-info">
                             <?php lang('a_no_modules_for_install') ?> 
                        </div>
                     <?php /if ?> 
                </div>
            </div>
        </section>
    </form>
</div><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n"> <?php lang('a_editing_page') ?> </span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/pages/GetPagesByCategory" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_back') ?> </span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-action="edit" data-form="#edit_page_form" data-submit><i class="icon-ok icon-white"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#edit_page_form"><i class="icon-check"></i> <?php lang('a_save_and_exit') ?> </button>
                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                         <?php foreach $langs as $l ?> 
                         <?php if $page_lang == $l.id ?> 
                         <?php $l.lang_name ?> 
                         <?php /if ?> 
                         <?php /foreach ?> 
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                         <?php foreach $langs as $l ?> 
                         <?php if $l.id != $page_lang ?> 
                        <li><a href="/admin/pages/edit/ <?php $page_id ?> / <?php $l.id ?> " class="pjax"> <?php $l.lang_name ?> </a></li>
                         <?php /if ?> 
                         <?php /foreach ?> 
                    </ul>
                </div>
            </div>
        </div>                            
    </div>  

    <div class="clearfix">
        <div class="m-t_20 pull-right">
            <a href="/ <?php $cat_url ?>  <?php $url ?> " class="t-d_n m-r_15" target="blank"> <?php lang('a_show_page') ?>  <span class="f-s_14">&rarr;</span></a>
        </div>
        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
            <a href="#content_article" class="btn btn-small active"> <?php lang('a_content') ?> </a>
            <a href="#parameters_article" class="btn btn-small "> <?php lang('a_param') ?> </a>
            <a href="#addfields_article" class="btn btn-small"> <?php lang('a_additional_fields') ?> </a>
            <a href="#setings_article" class="btn btn-small"> <?php lang('a_sett') ?> </a>
        </div>
    </div>             
    <form method="post" action=" <?php $BASE_URL ?> admin/pages/update/ <?php $update_page_id ?> / <?php $page_lang ?> " id="edit_page_form" class="form-horizontal" data-pageid=" <?php $update_page_id ?> ">
        <div class="tab-content content_big_td">

            <div class="tab-pane active" id="content_article">


                <table class="table table-striped table-bordered table-hover table-condensed">

                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_content') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="category_selectbox">
                                             <?php lang('a_category') ?> :
                                        </label>
                                        <div class="controls">
                                            <a onclick="$('.modal').modal(); return false;" class="btn btn-success btn-small pull-right" href="#"><i class="icon-plus icon-white"></i>  <?php lang('a_create_cat') ?> </a>
                                            <div class="o_h">
                                                <select name="category"  id="category_selectbox"  onchange="pagesAdmin.loadCFEditPage()">
                                                    <option value="0" > <?php lang('a_no') ?> </option>
                                                     <?php  $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['parent_id']));  ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label" for="page_title_u">
                                             <?php lang('a_title') ?> :
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="page_title" value=" <?php encode($title) ?> " id="page_title_u" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                             <?php lang('a_prev_cont') ?> :
                                        </label>
                                        <div class="controls">
                                            <textarea id="prev_text" class="elRTE" name="prev_text" rows="10" cols="180" > <?php encode($prev_text) ?> </textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                             <?php lang('a_full_cont') ?> :
                                        </label>
                                        <div class="controls">
                                            <textarea id="full_text" class="elRTE" name="full_text" rows="10" cols="180" > <?php encode($full_text) ?> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="parameters_article">



                <table class="table table-striped table-bordered table-hover table-condensed">

                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_param') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">

                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="page_url">
                                             <?php lang('a_url') ?> :
                                        </label>
                                        <div class="controls">
                                             <?php if $defLang.id == $page_lang ?> 
                                            <button onclick="translite_title('#page_title_u', '#page_url');" type="button" class="btn btn-small pull-right" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор</button>
                                            <div class="o_h">
                                                <input type="text" name="page_url" value=" <?php $url ?> " id="page_url" />
                                            </div>
                                             <?php else: ?> 
                                            <input type="text" name="page_url" value=" <?php $url ?> " id="page_url" disabled="disabled" />
                                             <?php /if ?> 
                                            <div class="help-block">( <?php lang('a_just_lat') ?> )</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="tags">
                                             <?php lang('a_tags') ?> :
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="search_tags" value=" <?php foreach $tags as $tag ?>  <?php $tag.value ?> , <?php /foreach ?> " id="tags" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="meta_title">
                                             <?php lang('a_meta_title') ?> :
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="meta_title" id="meta_title" value=" <?php $meta_title ?> "  />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_description">
                                             <?php lang('a_meta_description') ?> :
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_description" class="textarea" id="page_description" > <?php $description ?> </textarea>
                                            <button  onclick="create_description('#prev_text', '#page_description' );" type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор</button>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_keywords">
                                             <?php lang('a_meta_keywords') ?> :
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_keywords" id="page_keywords"> <?php $keywords ?> </textarea>
                                            <button  onclick="retrive_keywords('#prev_text', '#keywords_list' );"  type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор слов</button>
                                            <div id="keywords_list">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="main_tpl">
                                             <?php lang('a_main_tpl') ?> :
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="main_tpl" id="main_tpl" value=" <?php $main_tpl ?> " />
                                            </div>
                                            <div class="help-block"> <?php lang('a_by_default') ?>   main.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="full_tpl">
                                             <?php lang('a_page_tpl') ?> :
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="full_tpl" id="full_tpl" value=" <?php $full_tpl ?> " />
                                            </div>
                                            <div class="help-block"> <?php lang('a_by_default') ?>   page_full.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label"></div>
                                        <div class="controls">
                                            <span class="frame_label no_connection">
                                                <span class="niceCheck b_n">
                                                    <input name="comments_status"  value="1"  <?php if $comments_status == 1 ?>  checked="checked"  <?php /if ?>   type="checkbox" id="comments_status" />
                                                </span>
                                            </span>
                                             <?php lang('a_comm_alow') ?> 
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>

            <div class="tab-pane" id="addfields_article">
                <div id="cfcm_fields_block"></div>
            </div>

            <div class="tab-pane" id="setings_article">

                <table class="table table-striped table-bordered table-hover table-condensed">

                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_sett') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="post_status">
                                             <?php lang('a_pub_stat') ?> :
                                        </label>
                                        <div class="controls">
                                            <select name="post_status" id="post_status">
                                                <option value="publish"  <?php if $post_status == "publish" ?>  selected="selected"  <?php /if ?>  > <?php lang('a_published') ?> </option>
                                                <option value="pending"  <?php if $post_status == "pending" ?>  selected="selected"  <?php /if ?>  > <?php lang('a_wait_approve') ?> </option>
                                                <option value="draft"  <?php if $post_status == "draft" ?>  selected="selected"  <?php /if ?>  > <?php lang('a_not_publ') ?> </option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label" for="create_date">
                                             <?php lang('a_date_and_time_cr') ?> :    
                                        </label>
                                        <div class="controls">
                                            <div class="pull-left p_r">
                                                <input id="create_date" name="create_date" tabindex="7" value=" <?php $create_date ?> " type="text" data-placement="top" data-original-title="выберите дату" data-rel="tooltip" class="datepicker input-small"  />
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <input id="create_time" name="create_time" tabindex="8" type="text" value=" <?php $create_time ?> " class="input-small" />			             	
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="publish_date">
                                             <?php lang('a_date_and_time_p') ?> :                 
                                        </label>
                                        <div class="controls">
                                            <div class="pull-left p_r">
                                                <input id="publish_date" name="publish_date" tabindex="7" value=" <?php $publish_date ?> " type="text" data-placement="top" data-original-title="выберите дату" data-rel="tooltip" class="datepicker input-small" />
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <input id="publish_time" name="publish_time" tabindex="8" type="text" value=" <?php $publish_time ?> " class="input-small" />            	
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="roles[]">
                                             <?php lang('a_access') ?> :             
                                        </label>
                                        <div class="controls">
                                            <select multiple="multiple" name="roles[]" id="roles[]">
                                                <option value="0"  <?php $all_selected ?>  > <?php lang('a_all') ?> </option>
                                                 <?php foreach $roles as $role ?> 
                                                <option  <?php $role.selected ?>  value=" <?php $role.id ?> "> <?php $role.name ?> </option>
                                                 <?php /foreach ?> 
                                            </select>        	
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

         <?php form_csrf() ?> 
    </form>
</section>



<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3> <?php lang('a_create_cat') ?> </h3>
    </div>
    <div class="modal-body">

        <form action="/admin/categories/fast_add/create" method="post" id="fast_add_form" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">
                     <?php lang('a_name') ?> 
                </label>
                <div class="controls">
                    <input type="text" name="name" value="" class="required">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">
                     <?php lang('a_parent') ?> 
                </label>
                <div class="controls">
                    <select name="parent_id">
                        <option value="0" selected="selected"> <?php lang('a_no') ?> </option>
                         <?php  $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat']));  ?> 
                    </select>
                </div>
            </div>
        </form>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
        <a href="#" class="btn btn-primary" onclick="pagesAdmin.quickAddCategory()">Создать</a>
    </div>
</div>
<script>
    if (window.hasOwnProperty('pagesAdmin'))
        pagesAdmin.initialize();
</script>
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_sett_base_create_new_language') ?> </span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/languages" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u"> <?php lang('a_return') ?> </span></a>
                    <button type="submit" class="btn btn-small btn-success formSubmit" data-form="#createLang" data-action="edit" data-submit><i class="icon-plus-sign icon-white"></i> <?php lang('a_create') ?> </button>
                </div>
            </div>                            
        </div>
        <div class="content_big_td">
            <div class="tab-content">
                <div class="tab-pane active" id="parameters">
                    <form action=" <?php $BASE_URL ?> admin/languages/insert" method="post"  id="createLang" >
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                         <?php lang('a_param') ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span9">
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="name"> <?php lang('a_name') ?> :</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" id="name" required/>
                                                    </div>
                                                </div>    
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="identif"> <?php lang('a_identif') ?> :</label>
                                                        <div class="controls">
                                                            <input type="text" name="identif" id="identif" required/>
                                                        </div>
                                                    </div> 
                                                    <div class="row-fluid">
                                                        <!--<div class="control-group">
                                                            <label class="control-label" for="image"> <?php lang('a_image_url') ?> :</label>
                                                            <div class="controls">
                                                                <input type="text" name="image" id="image"/>
                                                            </div>
                                                        </div>  -->
                                                        <div class="control-group">
                                                            <label class="control-label" for="Img">
                                                                 <?php lang('a_image_url') ?> :
                                                            </label>
                                                            <div class="controls">
                                                                <div class="group_icon pull-right">            
                                                                    <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                                        return false;"><i class="icon-picture"></i>   <?php lang('a_select_image') ?> </button>
                                                                </div>
                                                                <div class="o_h">		            
                                                                    <input type="text" name="image" id="Img" value="">					
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="folder"> <?php lang('a_folder') ?> :</label>
                                                            <div class="controls">
                                                                <select name="folder" id="folder">
                                                                     <?php foreach $lang_folders as $folder ?> 
                                                                    <option value=" <?php $folder ?> "> <?php $folder ?> </option>
                                                                     <?php /foreach ?> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="template"> <?php lang('a_tpl') ?> :</label>
                                                            <div class="controls">
                                                                <select name="template" id="template">
                                                                     <?php foreach $templates as $tpl_folder ?> 
                                                                    <option value=" <?php $tpl_folder ?> "> <?php $tpl_folder ?> </option>
                                                                     <?php /foreach ?> 
                                                                </select>
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
                         <?php form_csrf() ?> 
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="elFinder"></div>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left"> <?php gettext('a_email') ?> 
            <span class="help-inline"></span>
            <span class="title w-s_n">Создание новой страницы</span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/pages/GetPagesByCategory" class="pjax t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#add_page_form" data-action="edit" data-submit><i class="icon-plus-sign icon-white"></i> <?php lang('a_create') ?> </button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#add_page_form" data-action="close"><i class="icon-check"></i> <?php lang('a_save_and_exit') ?> </button>
            </div>
        </div>                            
    </div>  
    <div class="clearfix">
        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
            <a href="#content_article" class="btn btn-small active"> <?php lang('a_content') ?> </a>
            <a href="#parameters_article" class="btn btn-small "> <?php lang('a_param') ?> </a>
            <a href="#addfields_article" class="btn btn-small"> <?php lang('a_additional_fields') ?> </a>
            <a href="#setings_article" class="btn btn-small"> <?php lang('a_sett') ?> </a>
        </div>
    </div>             
    <form method="post" action=" <?php $BASE_URL ?> admin/pages/add" id="add_page_form" class="form-horizontal" >
        <div class="tab-content content_big_td">
            <div class="tab-pane active" id="content_article">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_content') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="category_selectbox">
                                             <?php lang('a_category') ?> :
                                        </label>
                                        <div class="controls">
                                            <a onclick="$('.modal').modal(); return false;" class="btn btn-success btn-small pull-right" href="#"><i class="icon-plus-sign icon-white"></i>  <?php lang('a_create_cat') ?> </a>
                                            <div class="o_h">
                                                <select name="category" id="category_selectbox" onchange="pagesAdmin.loadCFAddPage()"> 
                                                    <option value="0" selected="selected"> <?php lang('a_no') ?> </option>
                                                     <?php  $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat']));  ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="page_title_u">
                                             <?php lang('a_title') ?> :
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="page_title" value="" id="page_title_u" required/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label">
                                             <?php lang('a_prev_cont') ?> :
                                        </div>
                                        <div class="controls">
                                            <textarea id="prev_text" class="elRTE required" name="prev_text" rows="10" cols="180" ></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label">
                                             <?php lang('a_full_cont') ?> :
                                        </div>
                                        <div class="controls">
                                            <textarea id="full_text" class="elRTE" name="full_text" rows="10" cols="180" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="parameters_article">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_param') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="page_url">
                                             <?php lang('a_url') ?> :
                                        </label>
                                        <div class="controls">
                                            <button onclick="translite_title('#page_title_u', '#page_url');" type="button" class="btn btn-small pull-right" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор</button>
                                            <div class="o_h">
                                                <input type="text" name="page_url" value="" id="page_url"/>
                                            </div>
                                            <div class="help-block">( <?php lang('a_just_lat') ?> )</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="tags">
                                             <?php lang('a_tags') ?> :
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="search_tags" value="" id="tags"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="meta_title">
                                             <?php lang('a_meta_title') ?> :
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="meta_title" id="meta_title" value=""/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_description">
                                             <?php lang('a_meta_description') ?> :
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_description" class="textarea" id="page_description" rows="8"></textarea>
                                            <button  onclick="create_description('#prev_text', '#page_description' );" type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор</button>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_keywords">
                                             <?php lang('a_meta_keywords') ?> :
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_keywords" id="page_keywords" rows="8" class="textarea" cols="28"></textarea>
                                            <button  onclick="retrive_keywords('#prev_text', '#keywords_list' );"  type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;Автоподбор слов</button>
                                            <div style="max-width:600px" id="keywords_list">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="main_tpl">
                                             <?php lang('a_main_tpl') ?> :
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="main_tpl" id="main_tpl" value=""/>
                                            </div>
                                            <div class="help-block"> <?php lang('a_by_default') ?>   main.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="full_tpl">
                                             <?php lang('a_page_tpl') ?> :
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="full_tpl" id="full_tpl" value=""/> 
                                            </div>
                                            <div class="help-block"> <?php lang('a_by_default') ?>   page_full.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label">
                                        </div>
                                        <div class="controls">
                                            <span class="frame_label no_connection">
                                                <span class="niceCheck b_n">
                                                    <input name="comments_status"  value="1" checked="checked" type="checkbox" id="comments_status" />                        	
                                                </span>
                                                 <?php lang('a_comm_alow') ?> 
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="addfields_article">
                <div id="cfcm_fields_block"></div>
            </div>

            <div class="tab-pane" id="setings_article">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_sett') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span12">
                                    <div class="control-group">
                                        <label class="control-label" for="post_status">
                                             <?php lang('a_pub_stat') ?> :
                                        </label>
                                        <div class="controls">
                                            <select name="post_status" id="post_status">
                                                <option selected="selected" value="publish"> <?php lang('a_published') ?> </option>
                                                <option value="pending"> <?php lang('a_wait_approve') ?> </option>
                                                <option value="draft"> <?php lang('a_not_publ') ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="control-group">
                                        <label class="control-label" for="create_date">
                                             <?php lang('a_date_and_time_cr') ?> :    
                                        </label>
                                        <div class="controls">
                                            <span class="pull-left p_r">
                                                <input id="create_date" name="create_date" value=" <?php $cur_date ?> " type="text" data-placement="top" data-original-title="выберите дату" data-rel="tooltip" class="datepicker input-small"/>
                                                <i class="icon-calendar"></i>
                                            </span>
                                            <input id="create_time" name="create_time" tabindex="8" type="text" value=" <?php $cur_time ?> " class="input-small" />			             	
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="publish_date">
                                             <?php lang('a_date_and_time_p') ?> :                 
                                        </label>
                                        <div class="controls">
                                            <span class="pull-left p_r">
                                                <input id="publish_date" name="publish_date" tabindex="7" value=" <?php $cur_date ?> " type="text" data-placement="top" data-original-title="выберите дату" data-rel="tooltip" class="datepicker input-small" />
                                                <i class="icon-calendar"></i>
                                            </span>
                                            <input name="publish_time" tabindex="8" type="text" value=" <?php $cur_time ?> " class="input-small" />            	
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="roles">
                                             <?php lang('a_access') ?> :             
                                        </label>
                                        <div class="controls">
                                            <select multiple="multiple" name="roles[]" id="roles">
                                                <option value="0"> <?php lang('a_all') ?> </option>
                                                 <?php foreach $roles as $role ?> 
                                                <option value =" <?php $role.id ?> "> <?php $role.name ?> </option>
                                                 <?php /foreach ?> 
                                            </select>        	
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
         <?php form_csrf() ?> 
    </form>
</section>

<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3> <?php lang('a_create_cat') ?> </h3>
    </div>
    <div class="modal-body">

        <form action="/admin/categories/fast_add/create" method="post" id="fast_add_form" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">
                     <?php lang('a_name') ?> 
                </label>
                <div class="controls">
                    <input type="text" name="name" value="" class="required">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">
                     <?php lang('a_parent') ?> 
                </label>
                <div class="controls">
                    <select name="parent_id">
                        <option value="0" selected="selected"> <?php lang('a_no') ?> </option>
                         <?php  $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat']));  ?> 
                    </select>
                </div>
            </div>
        </form>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
        <a href="#" class="btn btn-primary" onclick="pagesAdmin.quickAddCategory()">Создать</a>
    </div>
</div>

<script>
    if (window.hasOwnProperty('pagesAdmin'))
        pagesAdmin.initialize();
</script><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_role_group_edit') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/groupList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#group_ed_form" data-action="tomain" data-submit><i class="icon-ok"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#group_ed_form" data-action="tocreate"><i class="icon-check"></i>Сохранить и создать новую группу</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#group_ed_form" data-action="toedit"><i class="icon-check"></i>Сохранить и редактировать</button>

                <div class="dropdown d-i_b">   
                     <?php $arr = get_lang_admin_folders() ?>                    
                     <?php foreach $arr as $a ?> 
                         <?php if $lang_sel == $a ?> 
                            <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                         <?php if $a == 'english_lang' ?>  <?php lang('a_english') ?>  <?php else: ?>  <?php lang('a_russian') ?>  <?php /if ?> 
                        <span class="caret"></span>
                    </a>
                 <?php /if ?>    
             <?php /foreach ?> 
            <ul class="dropdown-menu">
                 <?php foreach $arr as $a ?> 
                    <li>
                        <a href=" <?php $BASE_URL ?> admin/rbac/translateGroup/ <?php echo $model->id ?> / <?php if $a == 'russian_lang' ?> en <?php else: ?> ru <?php /if ?> ">

                     <?php if $a == 'english_lang' ?>  <?php lang('a_russian') ?>   <?php else: ?>   <?php lang('a_english') ?>  (beta) <?php /if ?> 
                </a>
            </li>                          
         <?php /foreach ?> 
    </ul>

</div>
</div>
</div>

</div>  
<form method="post" action=" <?php $ADMIN_URL ?>  <?php echo $model->id ?> " class="form-horizontal" id="group_ed_form">
    <div class="tab-content">
        <div class="tab-pane active" id="params">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                             <?php lang('a_param') ?> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span9">
                                <div class="control-group m-t_10">
                                    <label class="control-label" for="Name"> <?php lang('a_name') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Name" id="Name" value=" <?php echo $model->name ?> " required/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description"> <?php lang('a_desc') ?> :</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value=" <?php echo $model->description ?> "/>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th class="span1">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox" value="On"/>
                                </span>
                            </span>
                        </th>
                        <th> <?php //echo $model->getLabel('Privileges') ?> </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="sortable">
                     <?php foreach $privileges as $privilege ?> 
                        <tr>
                            <td>
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" value=" <?php echo $privilege->id ?> " name="Privileges[]"  <?php if $privilege->group_id == $model->id ?>  checked="checked" disabled="disabled" <?php /if ?> />
                                    </span>
                                </span>
                            </td>
                            <td>
                                 <?php echo $privilege->title ?> 
                            </td>
                            <td> <?php echo $privilege->description ?> </td>
                        </tr>
                     <?php /foreach ?> 
                </tbody>
            </table>                            
        </div>
    </div>
     <?php form_csrf() ?> 
</form>
</section><div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3> <?php lang('a_language_delete') ?> </h3>
        </div>
        <div class="modal-body">
            <p> <?php lang('a_delete_selected_languages') ?> </p>
            <p> <?php lang('a_warning_ld') ?> </p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/languages/delete')" > <?php lang('a_delete') ?> </a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang('a_cancel') ?> </a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_languages') ?> </span>
            </div>  
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="module_delete"><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href = '/admin/languages/create_form'" data-submit><i class="icon-plus-sign icon-white"></i> <?php lang('a_create_language') ?> </button>
                </div>
            </div>
        </div>
        <div class="content_big_td">
            <div class="tab-content">
                <div class="tab-pane active" id="lang">
                    <div class="row-fluid">
                        <div class="form-horizontal">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="span1 t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox"/>
                                                </span>
                                            </span>
                                        </th>
                                        <th class="span4"> <?php lang('a_name') ?> </th>
                                        <th class="span4"> <?php lang('a_folder') ?> </th>
                                        <th class="span4"> <?php lang('a_identif') ?> </th>
                                        <th class="span4"> <?php lang('a_tpl') ?> </th>
                                        <th class="span2"> <?php lang('a_image') ?> </th>
                                        <th class="span2"> <?php lang('a_by_default') ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php foreach $langs as $lang ?>                                   
                                    <tr class="simple_tr">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" name="ids" value=" <?php $lang.id ?> "/>
                                                </span>
                                            </span>
                                        </td>
                                        <td><p><a href=" <?php $BASE_URL ?> admin/languages/edit/ <?php $lang.id ?> " data-rel="tooltip" data-title=" <?php lang('a_edit') ?> "> <?php $lang.lang_name ?> </a></p></td>
                                        <td><p> <?php $lang.folder ?> </p></td>
                                        <td><p> <?php $lang.identif ?> </p></td>
                                        <td><p> <?php $lang.template ?> </p></td>
                                        <td><p><img src=" <?php $lang.image ?> " width="16" height="16" /></p></td>
                                        <td class="t-a_c"><button class="btn btn-small lan_def  <?php if $lang.default == 1 ?>  btn-primary active  <?php /if ?> " data-id=" <?php $lang.id ?> "><i class="icon-star"></i></button></td>
                                    </tr>
                                     <?php /foreach ?>      
                                </tbody>
                            </table>   
                        </div>
                        <!--                        <div class="clearfix">
                                                    <div class="pagination pull-left">
                                                        <ul> <?php $paginator ?> 
                                                        </ul>
                                                    </div>
                                                    <div class="pagination pull-right">
                                                    </div>
                                                </div>-->
                    </div>
                </div> 
            </div>
        </div>   
    </section>
</div><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title> <?php lang('a_controll_panel') ?>  - Image CMS</title>
        <meta name="description" content=" <?php lang('a_controll_panel') ?>  - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/style.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-responsive.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-notify.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/jquery/custom-theme/jquery-ui-1.8.23.custom.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/jquery/custom-theme/jquery-ui-1.8.16.custom.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/jquery/custom-theme/jquery.ui.1.8.16.ie.css"/>
    </head>
    <body>

         <?php $ci = get_instance(); ?> 
         <?php if $ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php') ?> 
             <?php chmod(APPPATH.'modules/install/install.php', 0777) ?> 
             <?php if !rename(APPPATH.'modules/install/install.php', APPPATH.'modules/install/_install.php') ?> 
                 <?php die('<span style="font-size:18px;"><br/><br/>'.lang('a_delete_install').'/application/modules/install/install.php</div>') ?> 
             <?php /if ?> 
         <?php /if ?> 

        <div class="main_body">
            <div class="form_login t-a_c">
                <a href="/admin/dashboard" class="d-i_b">
                    <img src=" <?php $THEME ?> /img/logo.png"/>
                </a><br/>
                <form method="post" action=" <?php $BASE_URL ?> admin/login/" class="standart_form t-a_l" id="with_out_article">
                     <?php if $login_failed ?> 
                        <label>
                            Пользователя с таким Е-mail не найден
                        </label>
                         <?php $login_failed ?> 
                     <?php /if ?> 
                    <label>
                        <input type="text" name="login" placeholder=" <?php lang('a_email') ?> "/> <?php $login_error ?> 
                        <span class="icon-user"></span>
                    </label>
                    <label>
                        <input type="password" name="password" placeholder=" <?php lang('a_pass') ?> "/> <?php $password_error ?> 
                        <span class="icon-lock"></span>
                    </label>
                     <?php if $use_captcha == "1" ?> 

                        <label style="margin-bottom:50px">
                             <?php $lang_captcha ?> :<br/>
                            <div id="captcha"> <?php $cap_image ?> </div>
                            <a href="" onclick="ajax_div('captcha', ' <?php $BASE_URL ?> /admin/login/update_captcha');
                                    return false;"> <?php lang('a_code_refresh') ?> </a>
                            <input type="text" name="captcha" /> <?php $captcha_error ?> 
                        </label>
                     <?php /if ?> 
                    <div class="o_h">
                        <div class="pull-left frame_label">
                            <span class="frame_label">
                                <span class="niceCheck">
                                    <input type="checkbox" name="remember" value="1"/>
                                </span>
                                 <?php lang('a_remember') ?> 
                            </span>
                        </div>
                        <a href=" <?php $BASE_URL ?> admin/login/forgot_password/" class="pull-right"> <?php lang('a_forget_pass') ?> </a>
                    </div>
                    <input type="submit" value=" <?php lang('a_enter_sys') ?> " class="btn btn-info" style="margin-top: 26px;"/>
                     <?php form_csrf() ?> 
                </form>
            </div>
        </div>
        <script src=" <?php $THEME ?> /js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/scripts.js" type="text/javascript"></script>
    </body>
</html>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_roles_list') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a class="btn btn-small btn-success pjax" href="/admin/rbac/privilegeCreate" ><i class="icon-plus-sign icon-white"></i> <?php lang('a_create_group') ?> </a>
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="$('.modal').modal();"><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
            </div>
        </div>  
    </div>
    <div class="tab-content clearfix">
        <form method="post" action=" <?php $ADMIN_URL ?>  <?php echo $model->id ?> " class="form-horizontal" id="role_ed_form">
            <div class="tab-pane active">
                 <?php foreach $groups as $key =>$group ?>  
                    <div class="span3">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="t-a_c span1">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" />
                                            </span>
                                        </span>
                                    </th>                           
                                    <th> <?php echo $group->description ?> </th>
                                </tr>                        
                            </thead>
                            <tbody>
                                 <?php foreach $group->privileges as $privilege ?>                              
                                    <tr>       
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">       
                                                    <input type="checkbox" class="chldcheck"  value=" <?php echo $privilege->id ?> " name="ids" />
                                                </span>
                                            </span>
                                        </td>
                                        <td><a href="/admin/rbac/privilegeEdit/ <?php echo $privilege->id ?> "> <?php echo $privilege->title ?> </a></td>                               
                                    </tr>
                                 <?php /foreach ?> 
                            </tbody>
                        </table>
                    </div>
                 <?php /foreach ?> 
            </div>
             <?php form_csrf() ?> 
        </form>
    </div>

</section>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3> <?php lang('a_rbak_delete_role') ?> </h3>
    </div>
    <div class="modal-body">
        <p> <?php lang('a_rbak_del_role_gro') ?> </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm(' <?php $ADMIN_URL ?> privilegeDelete')" > <?php lang('a_delete') ?> </a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
    </div>
</div>


<div id="delete_dialog" style="display: none">
     <?php lang('a_rb_del_roles') ?> 
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- --><div class="rdTreeFirebug">
<ul id="desktop_tree">
<li><a style="display:block;width:100%;"><img class="penedit-root" onclick="ajax_div('page', base_url + 'admin/categories/create_form/0'); return false;"  src=" <?php $THEME ?> /images/tree/add_subdir.png" align="right" border="0" alt=" <?php lang('a_add_subcat') ?> " title=" <?php lang('a_add_subcat') ?> ">
<img class="penedit-root" onclick="ajax_div('page', base_url + 'admin/pages/index/category/0'); return false;" src=" <?php $THEME ?> /images/tree/add_page.png" align="right" border="0" alt=" <?php lang('a_add_article') ?> " title=" <?php lang('a_add_article') ?> ">
<div id="root_tree" ondblclick='myTree.expandAll()' onclick="cats_options(0,'');" style="display:inline;" title=" <?php lang('a_dbl_click') ?> "> <?php $_SERVER.SERVER_NAME ?> </div>
</a>
 <?php  $this->view("cats_tree_css.tpl", $data)  ?> 
</li>
</ul>
</div>
<script>
var myTree = new rdTree('desktop_tree');
myTree.select("root_tree");
</script>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title> <?php lang('a_controll_panel') ?>  - Image CMS</title>
        <meta name="description" content=" <?php lang('a_controll_panel') ?>  - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/style.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-responsive.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-notify.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/jquery/custom-theme/jquery-ui-1.8.23.custom.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/jquery/custom-theme/jquery-ui-1.8.16.custom.css"/>
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/jquery/custom-theme/jquery.ui.1.8.16.ie.css"/>
    </head>
    <body>
        <?php
        $ci = get_instance();
        if($ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php'))
        die('<span style="font-size:18px;"><br/><br/>'.lang('a_delete_install').'/application/modules/install/install.php</div>');        
        ?>
        <div class="main_body">
            <div class="form_login t-a_c">
                <a href="/admin/dashboard" class="d-i_b">
                    <img src=" <?php $THEME ?> /img/logo.png"/>
                </a><br/>
                Извините но у вас устаревший браузер.<br />

                Обновить или скачать новые браузеры можно здесь:
                <div>
                    <a href="http://www.mozilla.org/ru/firefox/new/" target="_blank"><img title="FireFox" src=" <?php $THEME ?> /img/firefox.png"/></a>
                    <a href="http://ru.opera.com/" target="_blank"><img title="Opera" src=" <?php $THEME ?> /img/opera.png"/></a>
                    <a href="http://www.google.com/intl/ru/chrome/browser/" target="_blank"><img title="Google Chrom" src=" <?php $THEME ?> /img/google.png"/></a>
                    <!--<a href="http://www.mozilla.org/ru/firefox/new/" target="_blank"><img title="Safari" src=" <?php $THEME ?> /img/safari.png"/></a>-->
                </div>
            </div>
        </div>
        <script src=" <?php $THEME ?> /js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/scripts.js" type="text/javascript"></script>
    </body>
</html>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_role_group_list') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="$('.modal').modal();"><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
                <a class="btn btn-small btn-success pjax" href="/admin/rbac/groupCreate" ><i class="icon-plus-sign icon-white"></i>Создать групу ролей</a>
            </div>
        </div>  
    </div>
    <div class="tab-content">
         <?php if count($model) > 0 ?> 
            <div class="row-fluid">            
                <form method="post" action="#" class="form-horizontal" data-url-delete="/admin/rbac/groupDelete">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th class="span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" value="On"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1"> <?php lang('a_id') ?> </th>
                                <th> <?php lang('a_name') ?> </th>
                                <th> <?php lang('a_desc') ?> </th>
                            </tr>    
                        </thead>
                        <tbody id="rltbl">
                             <?php foreach $model as $item ?> 
                                <tr>
                                    <td>
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" value=" <?php echo $item->id ?> " name="ids"/>
                                            </span>
                                        </span>
                                    </td>
                                    <td> <?php echo $item->id ?> </td>
                                    <td>
                                        <a class="pjax" href="/admin/rbac/groupEdit/ <?php echo $item->id ?> "> <?php echo ShopCore::encode($item->name) ?> </a>
                                    </td>
                                    <td>
                                         <?php echo $item->description ?> 
                                    </td>
                                </tr>
                             <?php /foreach ?> 
                        </tbody>
                    </table>
                </form>
            </div>
         <?php else: ?> 
            </br>
            <div class="alert alert-info">
                 <?php lang('a_list') ?>   <?php lang('a_group') ?>   <?php lang('a_privilegy') ?>   <?php lang('a_empty') ?> 
            </div>
         <?php /if ?> 
    </div>
</section>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Удаление выбраних групп</h3>
    </div>
    <div class="modal-body">
        <p>Удалить группу?</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm(' <?php $ADMIN_URL ?> groupDelete')" > <?php lang('a_delete') ?> </a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
    </div>
</div>


<div id="delete_dialog" style="display: none">
     <?php lang('a_rb_del_roles') ?> 
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->adssd<html>ds fsf sdf sdf sdf sdf</html>
asd jahdkadsjahs dgjhasd<div id="mod-tabs-block">

	<h4> <?php lang('a_desc') ?> </h4>
    <div>
         <?php $module.description ?> 

        <p style="padding:5px;">
            <b> <?php lang('a_author') ?> :</b>  <?php $module.author ?> 
            <br />
            <b> <?php lang('a_version') ?> :</b>  <?php $module.version ?> 
        </p>

        <div align="center" style="padding:5px;">
         <?php if $install_type == 'ftp' ?> 
            <input type="button" value=" <?php lang('a_install') ?> " class="button_silver" onclick="show_connection_block();" />
         <?php else: ?> 
            <input type="button" value=" <?php lang('a_install') ?> " class="button_silver" onclick="ajax_request(' <?php $BASE_URL ?> admin/mod_search/connect_ftp/ <?php $module.id ?> ');" />
         <?php /if ?> 
            
            <a href=" <?php $module.file ?> " target="_blank"> <?php lang('a_download') ?> </a>
        </div>

    </div>

     <?php if $module.faq != '' ?> 
        <h4>FAQ</h4>
        <div>
             <?php $module.faq ?> 
        </div>
     <?php /if ?> 

</div>

<div id="connetction_form" style="display:none;">
 <?php if $install_type == 'ftp' ?> 
<form method="post" action=" <?php $BASE_URL ?> admin/mod_search/connect_ftp/ <?php $module.id ?> " id="connect_ftp_form" style="width:100%;" >
		<div class="form_text"></div>
		<div class="form_input">
            <h3> <?php lang('a_ftp_sett') ?>  </h3>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_host') ?> </div>
		<div class="form_input"><input type="text" name="host" value="localhost" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_port') ?> </div>
		<div class="form_input"><input type="text" name="port" value="21"  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_login') ?> </div>
		<div class="form_input"><input type="text" name="login" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_pass') ?> </div>
		<div class="form_input"><input type="text" name="password" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_root_path') ?> </div>
		<div class="form_input">
            <input type="text" name="root_folder" value=""  class="textbox_long" />
            <br />
            <span class="help-block"> <?php lang('a_for_example') ?> : /domains/mysite/public_html/</span>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
               <input type="submit" value=" <?php lang('a_forward') ?> " class="button_silver" onclick="ajax_me('connect_ftp_form');" /> 
        </div>
		<div class="form_overflow"></div>
</form>
 <?php /if ?> 

</div>

 <?php literal ?> 
	<script type="text/javascript">
    
            function show_connection_block()
             <?php 
                $('mod-tabs-block').setStyle('display', 'none');
                $('connetction_form').setStyle('display', 'block');
             ?> 

            var mod_info_tabs = new SimpleTabs('mod-tabs-block',  <?php 
			selector: 'h4'
			 ?> );        

	</script>
 <?php /literal ?> 
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_search_results') ?> : " <?php $search_title ?> "</span>
            </div>                          
        </div>
        <div class="row-fluid">
             <?php if isset($users) ?> 
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#pages" class="btn btn-small  <?php if count($pages) ?>  active <?php /if ?> "> <?php lang('a_pages') ?>  
                        <span style="top:-13px;" class="badge  <?php if count($pages) ?> badge-important <?php /if ?> "> <?php count($pages) ?> </span>
                    </a>
                    <a href="#users" class="btn btn-small  <?php if !count($pages) && count($users) ?>  active <?php /if ?> "> <?php lang('a_users') ?> 
                        <span style="top:-13px;" class="badge  <?php if count($users) ?>  badge-important <?php /if ?> "> <?php count($users) ?> </span>
                    </a>
                </div>
            </div>
             <?php /if ?> 
            
            <div class="tab-content">
            <div class="tab-pane  <?php if count($pages) || !count($users) ?>  active  <?php /if ?>  " id="pages">
	     <?php if count($pages) ?> 
            <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                <thead>
                    <tr>
                        <th class="span1">ID</th>
                        <th class="span4"> <?php lang('a_title') ?> </th>
                        <th class="span3"> <?php lang('a_url') ?> </th>
                        <th class="span2">Категория</th>
                        <th class="span1"> <?php lang('a_status') ?> </th>
                    </tr>
                </thead>
                <tbody >
                    
                     <?php foreach $pages as $page ?> 
                    <tr data-id=" <?php $page.id ?> ">
                        <td><span> <?php $page.id ?> </span></td>
                        <td class="share_alt">
                            <a href=" <?php $BASE_URL ?>  <?php $page.cat_url ?>  <?php $page.url ?> " target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title=" <?php lang('a_goto_site') ?> "><i class="icon-share-alt"></i></a>
                            <a href=" <?php $BASE_URL ?> admin/pages/edit/ <?php $page.id ?> " class="title pjax"> <?php $page.title ?> </a>
                        </td>
                        <td><span> <?php truncate($page.url, 40, '...') ?> </span></td>
                        <td><span>
			 <?php $categories[$page.category] ?> 
			</span></td>
                        <td>
                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title=" <?php if $page['post_status'] == 'publish' ?>  <?php lang('a_show') ?>  <?php else: ?>  <?php lang('a_dont_show') ?>  <?php /if ?> " onclick="change_page_status(' <?php $page.id ?> ');">
                                <span class="prod-on_off  <?php if $page['post_status'] != 'publish' ?> disable_tovar <?php /if ?> " style=" <?php if $page['post_status'] != 'publish' ?> left: -28px; <?php /if ?> "></span>
                            </div>
                        </td>
                    </tr>
                     <?php /foreach ?> 
                </tbody>
            </table>
	     <?php else: ?> 
                <div class="alert alert-info" style="margin: 18px;"> <?php lang('a_not_found') ?> </div>
             <?php /if ?>    
            </div>
            
            <div class="tab-pane   <?php if !count($pages) && count($users) ?>  active <?php /if ?> " id="users">
                 <?php if count($users) ?> 
                    
                    <table class="table table-striped table-bordered table-hover table-condensed" style="clear: both;">
                        <thead>
                            <tr>
                                <th class="span1"> <?php lang('a_ID') ?> </th>
                                <th class="span3"> <?php lang('a_us_in_admin') ?> </th>
                                <th class="span3"> <?php lang('a_email') ?> </th>
                                <th class="span2"> <?php lang('a_u_man_group_sa_yser') ?> </th>
                                <th class="span1"> <?php lang('a_banned') ?> </th>
                                <th class="span2"> <?php lang('a_b_last_ip') ?> </th>
                            </tr>
                        </thead>
                        <tbody>
                                 <?php foreach $users as $user ?> 
                                <tr>
                                    <td><p> <?php echo $user.id ?> </p></td>
                                    <td><a href="/admin/components/cp/user_manager/edit_user/ <?php echo $user.id ?> " class="pjax"> <?php echo $user.username ?> </a></td>                            
                                    <td> <?php $user.email ?> </td>
                                    <td><p> <?php $user.role_alt_name ?> </p></td>
                                    <td>
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" onclick="change_status(' <?php $BASE_URL ?> admin/components/cp/user_manager/actions/ <?php echo $user.id ?> ');" >
                                            <span class="prod-on_off  <?php if $user.banned == 1 ?> disable_tovar <?php /if ?> " ></span>
                                        </div>
                                        </div>
                                    </td>
                                    <td><p> <?php $user.last_ip ?> </p></td>
                                </tr>
                             <?php /foreach ?> 
                        </tbody>
                    </table>
                    
                 <?php else: ?> 
                    <div class="alert alert-info" style="margin: 18px;"> <?php lang('a_not_found') ?> </div>
                 <?php /if ?> 
            </div>
            </div>
            
        </div>
         <?php if $paginator > '' ?> 
        <div class="clearfix">
             <?php $paginator ?> 
        </div>
         <?php /if ?> 
    </section><div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3> <?php lang('a_del_catego_ba') ?> </h3>
        </div>
        <div class="modal-body">
            <p> <?php lang('a_del_category_selec') ?> ?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm(' <?php $BASE_URL ?> /admin/categories/delete')" > <?php lang('a_delete') ?> </a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');"> <?php lang('a_cancel') ?> </a>
        </div>
    </div>


    <div id="delete_dialog" title=" <?php lang('a_del_categoy_ba') ?> " style="display: none">
         <?php lang('a_del_catego_ba') ?> ?
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_category') ?> </span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash icon-white"></i> <?php lang('a_delete') ?> </button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href=' <?php $BASE_URL ?> /admin/categories/create_form'"><i class="icon-plus-sign icon-white"></i> <?php lang('create_cat') ?> </button>
                </div>
            </div>                            
        </div>       
        <div class="frame_table table table-striped table-bordered table-hover table-condensed pages-table">
            <div id="category">
                <div class="row-category head">
                    <div class="t-a_c">
                        <span class="frame_label">
                            <span class="niceCheck b_n">
                                <input type="checkbox"/>
                            </span>
                        </span>
                    </div>
                    <div> <?php lang('a_id') ?> </div>
                    <div> <?php lang('a_title') ?> </div>
                    <div> <?php lang('a_url') ?> </div>
                    <div> <?php lang('a_pages') ?> </div>
                </div>
                <div class="body_category frame_level">
                    <div class="sortable save_positions" data-url="/admin/categories/save_positions/">
                         <?php $catTreeHTML ?>                                               
                    </div>
                </div>
            </div>


    </section>
</div>
<div class="hfooter"></div><section class="mini-layout" style="padding-top: 39px; ">
        <div class="frame_title clearfix" style="top: 207px; width: 1168px; ">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_not_found') ?> </span>
            </div>                      
        </div>
        <div class="content_big_td row-fluid">
            <div class="tab-content">
                <br/>
                <div class="alert alert-error span11">
                     <?php $message ?> 
                </div>
            </div>
        </div>
</section><div class="top-navigation">
    <ul>
        <li><p> <?php lang('a_sys_update') ?> .</p></li>
    </ul>
</div>

<div style="clear:both;"></div>

<div id="notice_error" style="min-width:600px;width:600px;margin-top:15px;">
    <b> <?php lang('a_atten') ?> :</b>  <?php lang('a_make_backup') ?> 
</div>

<form method="post" action=" <?php $BASE_URL ?> admin/sys_upgrade/make_upgrade" id="make_upgrade_form" style="width:100%;" >
		<div class="form_text"></div>
		<div class="form_input">
            <h3> <?php lang('a_ftp_sett') ?> </h3>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_host') ?> </div>
		<div class="form_input"><input type="text" name="host" value="localhost" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_port') ?> </div>
		<div class="form_input"><input type="text" name="port" value="21"  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_login') ?> </div>
		<div class="form_input"><input type="text" name="login" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_pass') ?> </div>
		<div class="form_input"><input type="text" name="password" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text"> <?php lang('a_root_path') ?> </div>
		<div class="form_input">
            <input type="text" name="root_folder" value=""  class="textbox_long" />
            <br />
            <span class="help-block"> <?php lang('a_example_path') ?> </span>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
               <input type="submit" value=" <?php lang('a_refresh') ?> " class="button_silver" onclick="ajax_me('make_upgrade_form');" /> 
        </div>
		<div class="form_overflow"></div>
</form>
 <?php foreach $tree as $item ?> 
 <?php $parent_id ?> 
	<option value=" <?php $item.id ?> "   <?php if $item['id'] == $parent_id OR $item['id'] == $sel_cat ?>  selected="selected"  <?php /if ?> 
	 <?php if $item['id'] == $id AND !$page_editing ?>  disabled="disabled"  <?php /if ?> 
	>
	 <?php for $i=0; $i < $item['level'];$i++ ?> - <?php /for ?>   <?php $item.name ?> 
	</option>
         <?php if $item['subtree'] ?> 
             <?php $this->view('cats_select.tpl', array('tree' => $item['subtree'], 'parent_id' => $parent_id, 'sel_cat' => $sel_cat, 'id'=>$id)) ?> 
         <?php /if ?> 
 <?php /foreach ?> 
<div class="row-category" >
    <div class="t-a_c">
        <span class="frame_label">
            <span class="niceCheck b_n">
                <input type="checkbox" name="ids" value=" <?php $item.id ?> "/>
            </span>
        </span>
    </div>       
    <div><p> <?php $item.id ?> </p></div>
    <div><div class="title  <?php if $item.parent_id > 0 ?>  lev  <?php /if ?> " onclick="edit_category( <?php $item.id ?> );
            return false;">
             <?php if count($item.subtree) ?> 
                <button type="button" class="btn btn-small my_btn_s"
                        style="display: none;" data-rel="tooltip"
                        data-placement="top" data-original-title="свернуть категорию">
                    <i class="my_icon icon-minus"></i>
                </button>
                <button type="button" class="btn btn-small my_btn_s btn-primary"
                        data-rel="tooltip" data-placement="top"
                        data-original-title="розвернуть категорию">
                    <i class="my_icon icon-plus"></i>
                </button>
             <?php else: ?> 
                <span class="simple_tree">↳</span>
             <?php /if ?> 
            <a href="/admin/categories/edit/ <?php $item.id ?> " data-rel="tooltip" data-placement="top" data-original-title="редактировать категорию"  class="pjax"> <?php truncate($item.name, 100) ?> </a>
        </div></div>
    <div class="share_alt" >
        <a href=" <?php $BASE_URL ?>  <?php $item.path_url ?> " target="_blank" class="f_l"> <?php truncate($item.url, 75) ?> </a>
        <a target="_blank" href=" <?php $BASE_URL ?>  <?php $item.path_url ?> " class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="перейти на сайт"><i class="icon-share-alt"></i></a>
    </div>
    <div><p> <?php $item['pages'] ?> </p></div>
</div><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_role_group_create') ?> </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href=" <?php $BASE_URL ?> admin/rbac/groupList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#group_cr_form" data-action="tomain" data-submit><i class="icon-ok"></i> <?php lang('a_save') ?> </button>
                <button type="button" class="btn btn-small  formSubmit" data-form="#group_cr_form" data-action="tocreate"><i class="icon-check"></i>Сохранить и создать новую групу</button>
                <button type="button" class="btn btn-small  formSubmit" data-form="#group_cr_form" data-action="toedit"><i class="icon-check"></i>Сохранить и редактировать</button>
            </div>
        </div>

    </div>
    <form method="post" action=" <?php $ADMIN_URL ?> " class="form-horizontal" id="group_cr_form">
        <div class="tab-content">
            <div class="tab-pane active" id="params">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                 <?php lang('a_param') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="control-group m-t_10">
                                        <label class="control-label" for="Name"> <?php lang('a_name') ?> :</label>
                                        <div class="controls">
                                            <input type="text" name="Name" id="Name" value="" />
                                        </div>
                                    </div>
                                        <!--required-->
                                    <div class="control-group">
                                        <label class="control-label" for="Description"> <?php lang('a_desc') ?> :</label>
                                        <div class="controls">
                                            <input type="text" name="Description" id="Description" value=""/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="Description">Группа:</label>
                                        <div class="controls">
                                            <select name="type">
                                                <option value="shop">Shop</option>
                                                <option value="base">Base</option>
                                                <option value="module">Module</option>
                                            
                                            </select>
                                            <!--<input type="text" name="Description" id="Description" value=""/>-->
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th class="span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" value="On"/>
                                    </span>
                                </span>
                            </th>
                            <th> <?php //echo $model->getLabel('Privileges') ?> </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php foreach $privileges as $privilege ?> 
                            <tr>
                                <td>
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" value=" <?php echo $privilege->id ?> " name="Privileges[]"/>
                                        </span>
                                    </span>
                                </td>
                                <td>
                                     <?php echo $privilege->name ?> 
                                </td>
                                <td> <?php echo $privilege->description ?> </td>
                            </tr>
                         <?php /foreach ?> 
                    </tbody>
                </table>
            </div>
            <div class="tab-pane">                     
            </div>
        </div>
         <?php form_csrf() ?> 
    </form>
</section> <!DOCTYPE html>
<html>
    <head>
        <title> <?php lang('a_controll_panel') ?>  | Image CMS</title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta name="description" content=" <?php lang('a_controll_panel') ?>  - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="ImageCMS">
        
        <link rel="icon" type="image/x-icon" href=" <?php $THEME ?> /images/favicon.png"/>

        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap_complete.css">
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/style.css">
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-responsive.css">
        <!--
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/bootstrap-notify.css">
        -->

        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/jquery/custom-theme/jquery-ui-1.8.16.custom.css">
        <link rel="stylesheet" type="text/css" href=" <?php $THEME ?> /css/jquery/custom-theme/jquery.ui.1.8.16.ie.css">


        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/Aristo/css/Aristo/Aristo.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/js/elrte-1.3/css/elrte.min.css" media="screen" charset="utf-8">

        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/elfinder.min.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/js/elfinder-2.0/css/theme.css" media="screen" charset="utf-8">

    </head>
    <body>
        <div class="main_body">
            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container"> 
                     <?php if $ADMIN_URL ?> 
                        <a href=" <?php $ADMIN_URL ?> dashboard" class="logo pull-left pjax">
                         <?php else: ?> 
                            <a href="/admin/dashboard" class="logo pull-left pjax">
                             <?php /if ?> 
                            <img src=" <?php $THEME ?> /img/logo.png"/>
                        </a>

                         <?php if $CI->dx_auth->is_logged_in() ?> 
                            <div class="pull-right span4">
                                <div class="clearfix">
                                    <span class="m-r_10">
                                         <?php lang('a_wellcome') ?> ,
                                         <?php if $CI->dx_auth->get_username() ?> 
                                            <a href=" <?php echo base_url() ?> admin/components/cp/user_manager/edit_user/ <?php echo $CI->dx_auth->get_user_id() ?> " id="user_name">
                                                 <?php echo $CI->dx_auth->get_username() ?> 
                                            </a>
                                            <a href="/admin/logout"><i class="my_icon exit_ico"></i></a>
                                         <?php else: ?> 
                                             <?php echo lang('a_guest') ?> 
                                         <?php /if ?> 
                                    </span>
                                    <span class="m-l_10">Просмотр <a href=" <?php $BASE_URL ?> " target="_blank">сайта <span class="f-s_14">→</span></a></span>
                                </div>
                                <form method="get" action=" <?php if $ADMIN_URL ?> /admin/components/run/shop/search/advanced <?php else: ?> /admin/admin_search <?php /if ?> " id="adminAdvancedSearch">
                                    <div class="input-append search">
                                        <button id="adminSearchSubmit" type="submit" class="btn pull-right"><i class="icon-search"></i></button>
                                        <div class="o_h">
                                            <input id=" <?php if $ADMIN_URL ?> shopSearch <?php else: ?> baseSearch <?php /if ?> " name="q" size="16" type="text"  autocomplete="off" tabindex="1" value=" <?php $_GET['q'] ?> ">
                                        </div>
                                    </div>
                                </form>
                            </div>



                             <?php if SHOP_INSTALLED ?> 
                                <div class="btn-group" id="topPanelNotifications" style="display: none;">
                                    <div class="span4 d-i_b">
                                        <a href="/admin/components/run/shop/orders/index" class=" pjax btn btn-large" data-title="Заказы" data-rel="tooltip" data-original-title="Заказы">
                                            <i class="icon-bask "></i>
                                        </a>
                                        <a href="#" class="btn btn-large pjax" data-title=" <?php lang('a_product_no_icon') ?> " data-rel="tooltip" data-original-title="">
                                            <i class="icon-report_exists"></i>
                                        </a>
                                        <a href="#" class="btn btn-large pjax" data-title="Callback" data-rel="tooltip" data-original-title="Callback">
                                            <i class="icon-callback "></i>
                                        </a>
                                        <a href="/admin/components/cp/comments" class="btn btn-large pjax" data-title=" <?php lang('a_last_comm') ?> " data-rel="tooltip" data-original-title=" <?php lang('a_last_comm') ?> ">
                                            <i class="icon-comment_head "></i>
                                        </a>
                                    </div>
                                </div>
                             <?php /if ?> 
                         <?php /if ?> 


                </section>
            </header>

             <?php if $CI->dx_auth->is_logged_in() ?> 
                <div class="frame_nav" id="mainAdminMenu">
                    <div class="container" id="baseAdminMenu">
                        <nav class="navbar navbar-inverse">


                             <?php include('templates/administrator/inc/menus.php'); ?> 

                            <ul class="nav">
                             <?php foreach $baseMenu as $li ?> 
                                <li class=" <?php $li.class ?>   <?php if $li.subMenu ?>  dropdown <?php /if ?> ">
                                     <?php if $li.subMenu ?> 
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" <?php $li.icon ?> "></i> <?php echo (bool)lang($li.text)?lang($li.text):$li.text ?> <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                             <?php foreach $li.subMenu as $sli ?> 
                                                 <?php if $sli.menusList ?> 
                                                     <?php if !$menus ?> 
                                                         <?php $CI->load->module('menu'); $menus=$CI->menu->get_all_menus() ?> 
                                                     <?php /if ?> 

                                                    <li><a href="/admin/components/cp/menu/index" class="pjax"> <?php lang('a_control') ?> </a></li>
                                                    <li class="divider"></li>
                                                     <?php foreach $menus as $menu ?> 
                                                        <li><a href="/admin/components/cp/menu/menu_item/ <?php $menu.name ?> " class="pjax"> <?php $menu.main_title ?> </a></li>
                                                     <?php /foreach ?> 
                                                 <?php /if ?> 


                                                 <?php if $sli.modulesList ?> 
                                                     <?php if !$components ?> 
                                                         <?php $CI->load->module('admin/components'); $components = $CI->components->find_components(TRUE) ?> 
                                                     <?php /if ?> 

                                                     <?php foreach $components as $component ?> 
                                                         <?php if $component['installed'] == TRUE AND $component['admin_file'] == 1 ?> 
                                                            <li><a href="/admin/components/cp/ <?php $component.com_name ?> " class="pjax"> <?php $component.menu_name ?> </a></li>
                                                         <?php /if ?> 
                                                     <?php /foreach ?> 
                                                 <?php /if ?> 

                                                <li  <?php if $sli.divider ?>  class="divider" <?php /if ?>  <?php if $sli.header ?>  class="nav-header" <?php /if ?> > <?php if $sli.link ?> <a href=" <?php $sli.link ?> " class="pjax"> <?php echo (bool)lang($sli.text)?lang($sli.text):$sli.text ?> </a> <?php else: ?>  <?php echo (bool)lang($sli.text)?lang($sli.text):$sli.text ?>  <?php /if ?> </li>


                                             <?php /foreach ?> 
                                        </ul>
                                     <?php else: ?> 
                                        <a href=" <?php $li.link ?> " class="pjax"><i class=" <?php $li.icon ?> "></i><span> <?php $li.text ?> </span></a>
                                     <?php /if ?> 
                                </li>
                             <?php /foreach ?> 
                            </ul>

                             <?php if SHOP_INSTALLED ?> 
                                <a class="btn btn-small pull-right btn-info" onclick="loadShopInterface();" href="#">Администрировать магазин <span class="f-s_14">→</span></a>
                             <?php /if ?> 
                        </nav>
                    </div>

                     <?php if SHOP_INSTALLED ?> 
                        <div style="display:none;" class="container" id="shopAdminMenu"  >
                            <nav class="navbar navbar-inverse">
                            <ul class="nav">
                                 <?php foreach $shopMenu as $li ?> 
                                    <li class=" <?php $li.class ?>   <?php if $li.subMenu ?>  dropdown <?php /if ?> ">
                                         <?php if $li.subMenu ?> 
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" <?php $li.icon ?> "></i> <?php echo (bool)lang($li.text)?lang($li.text):$li.text ?> <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                 <?php foreach $li.subMenu as $sli ?> 
                                                    <li  <?php if $sli.divider ?>  class="divider" <?php /if ?>  <?php if $sli.header ?>  class="nav-header" <?php /if ?> >
                                                         <?php if $sli.link ?> 
                                                            <a href=" <?php site_url($sli.link) ?> " class="pjax"> <?php echo (bool)lang($sli.text)?lang($sli.text):$sli.text ?> </a>
                                                         <?php else: ?> 
                                                             <?php echo (bool)lang($sli.text)?lang($sli.text):$sli.text ?> 
                                                         <?php /if ?> 
                                                    </li>
                                                 <?php /foreach ?> 
                                            </ul>
                                             <?php else: ?> 
                                            <a href=" <?php $li.link ?> " class="pjax"><i class=" <?php $li.icon ?> "></i><span> <?php $li.text ?> </span></a>
                                         <?php /if ?> 
                                    </li>
                                 <?php /foreach ?> 
                            </ul>
                                <a class="btn btn-small pull-right btn-info" onclick=" loadBaseInterface();"  href="#"><span class="f-s_14">←</span> Администрировать сайт </a>
                            </nav>
                        </div>
                     <?php /if ?> 
                </div>
             <?php /if ?> 
            <div id="loading"></div>
            <div class="container" id="mainContent">
                 <?php $content ?> 
            </div>
            <div class="hfooter"></div>
        </div>
        <footer>
            <div class="container">
                <div class="row-fluid">
                    <div class="span4">
                        Интерфейс:
                        <div class="dropup d-i_b">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                 <?php lang('a_'.$this->CI->config->item('language')) ?> 
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/settings/switch_admin_lang/english"> <?php lang('a_english') ?>  (beta)</a></li>
                                <li><a href="/admin/settings/switch_admin_lang/russian"> <?php lang('a_russian') ?> </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span4 t-a_c">
                         <?php lang('a_version') ?> : <b> <?php echo getCMSNumber() ?> </b>
                        <div class="muted">Помогите нам стать еще лучше - <a href="#" id="rep_bug">сообщите об ошибке</a></div>
                    </div>
                    <div class="span4 t-a_r">
                        <div class="muted">Copyright © ImageCMS 2013</div>
                        <a href="http://wiki.imagecms.net" target="blank">Документация</a>
                    </div>
                </div>
            </div>
        </footer>
        <div id="elfinder"></div>
        <div class="standart_form frame_rep_bug">
            <form method="post" action="">
                <label>
                     <?php lang('a_your_remark') ?> :
                    <textarea></textarea>
                </label>
                <input type="submit" value=" <?php lang('a_send_report') ?> " class="btn btn-info"/>
                <input type="button" value=" <?php lang('a_cancel') ?> " class="btn btn-info" style="float:right" name="cancel_button"/>
                <input type="hidden" value=" <?php $_SERVER['REMOTE_ADDR'] ?> " id="ip_address"/>
            </form>
        </div>
        <script>
             <?php $settings = $CI->cms_admin->get_settings(); ?> 
            var textEditor = ' <?php $settings.text_editor ?> ';
             <?php if $CI->dx_auth->is_logged_in() ?> 
                var userLogined = true;
             <?php else: ?> 
                var userLogined = false;
             <?php /if ?> 
                
                var locale = ' <?php echo $this->CI->config->item('language') ?> ';
                var base_url = " <?php site_url() ?> ";
        </script>

        <script src=" <?php $THEME ?> /js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/pjax/jquery.pjax.min.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/bootstrap.min.js" type="text/javascript"></script>
        <script async="async" src=" <?php $THEME ?> /js/bootstrap-notify.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/jquery.form.js" type="text/javascript"></script>        

        <script async="async" src=" <?php $THEME ?> /js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>

        <script src=" <?php $THEME ?> /js/functions.js" type="text/javascript"></script>
        <script src=" <?php $THEME ?> /js/scripts.js" type="text/javascript"></script>

        <script type="text/javascript" src="/js/elrte-1.3/js/elrte.min.js"></script>
        <script type="text/javascript" src="/js/elfinder-2.0/js/elfinder.min.js"></script>


         <?php if $this->CI->config->item('language') == 'russian' ?> 
            <script async="async" src=" <?php $THEME ?> /js/jquery-validate/messages_ru.js" type="text/javascript"></script>
            <script type="text/javascript" src="/js/elrte-1.3/js/i18n/elrte.ru.js"></script>
            <script type="text/javascript" src="/js/elfinder-2.0/js/i18n/elfinder.ru.js"></script>
         <?php /if ?> 


        <!--
        <script src=" <?php $THEME ?> /js/admin_base.min.js" type="text/javascript"></script>       
        -->

        <script src=" <?php $THEME ?> /js/admin_base_i.js" type="text/javascript"></script>       
        <script src=" <?php $THEME ?> /js/admin_base_m.js" type="text/javascript"></script>       
        <script src=" <?php $THEME ?> /js/admin_base_r.js" type="text/javascript"></script>       
        <script src=" <?php $THEME ?> /js/admin_base_v.js" type="text/javascript"></script>       
        <script src=" <?php $THEME ?> /js/admin_base_y.js" type="text/javascript"></script>               
        <script type="text/javascript" src="/js/tiny_mce/jquery.tinymce.js"></script>
        <script>
             <?php if $CI->uri->segment('4') == 'shop' ?> 
                var isShop = true;
             <?php else: ?> 
                var isShop = false;
             <?php /if ?> 
                var lang_only_number = " <?php lang('a_numbers_only') ?> ";
                var show_tovar_text = " <?php lang('a_show') ?> ";
                var hide_tovar_text = " <?php lang('a_dont_show') ?> ";
             <?php literal ?> 

            $(document).ready(function() <?php 
            		
                if (!isShop)
                 <?php 
                    $('#shopAdminMenu').hide();
                    $('#topPanelNotifications').hide();   
                 ?> 
                else
                    $('#baseAdminMenu').hide();
             ?> )
            
            function number_tooltip_live() <?php 
                $('.number input').each(function() <?php 
                    $(this).attr( <?php 
                        'data-placement':'top', 
                        'data-title': lang_only_number
                     ?> );
                 ?> )
                number_tooltip();
             ?> 
            function prod_on_off() <?php 
                $('.prod-on_off').die('click').live('click', function() <?php 
                    var $this = $(this);
                    if (!$this.hasClass('disabled')) <?php 
                        if ($this.hasClass('disable_tovar')) <?php 
                            $this.animate( <?php 
                                'left': '0'
                             ?> , 200).removeClass('disable_tovar');
                            if ($this.parent().data('only-original-title') == undefined) <?php 
                                $this.parent().attr('data-original-title', show_tovar_text)
                                $('.tooltip-inner').text(show_tovar_text);
                             ?> 
                            $this.next().attr('checked', true).end().closest('td').next().children().removeClass('disabled').removeAttr('disabled');
                                if ($this.attr('data-page') != undefined) $('.setHit, .setHot, .setAction').removeClass('disabled').removeAttr('disabled');
                         ?> 
                        else <?php 
                            $this.animate( <?php 
                                'left': '-28px'
                             ?> , 200).addClass('disable_tovar');
                            if ($this.parent().data('only-original-title') == undefined) <?php 
                                $this.parent().attr('data-original-title', hide_tovar_text)
                                $('.tooltip-inner').text(hide_tovar_text);
                             ?> 
                            $this.next().attr('checked', false).end().closest('td').next().children().addClass('disabled').attr('disabled','disabled');
                            if ($this.attr('data-page') != undefined) $('.setHit, .setHot, .setAction').addClass('disabled').attr('disabled','disabled')
                         ?> 
                     ?> 
                 ?> );
             ?> 
            $(window).load(function() <?php 
                number_tooltip_live();
                prod_on_off();
             ?> )
            base_url = ' <?php /literal ?>  <?php $BASE_URL ?>  <?php literal ?> ';
             <?php /literal ?> 

            
            var elfToken = ' <?php echo $CI->lib_csrf->get_token() ?> ';
            </script>
        <div id="jsOutput" style="display: none;"></div>    
    </body>
</html><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"> <?php lang('a_cache') ?> </span>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
                <div class="form-horizontal">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                     <?php lang('a_clear_cache') ?>                                     
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="control-group m-t_10">
                                            <label class="control-label" for="inputName"> <?php lang('a_all_cache_file') ?> :</label>
                                            <div class="controls">
                                                <span class="filesCount"> <?php echo $allFile ?> </span>                                                      
                                            </div>
                                        </div>
                                        <div class="control-group m-t_10">
                                            <label class="control-label" for="inputLocal"> <?php lang('a_clean_old') ?> </label>
                                            <div class="controls">                                                        
                                                <button type="button" data-target="/admin/delete_cache" data-param="expried" id="inputLocal" class="btn btn-small clearCashe btn-danger" ><i class="icon-trash icon-white" ></i> Очистить</button>
                                            </div>
                                        </div>
                                        <div class="control-group m-t_10">
                                            <label class="control-label" for="inputLocal2"> <?php lang('a_clean_all') ?> </label>
                                            <div class="controls">                                                        
                                                <button type="button" data-target="/admin/delete_cache" data-param="all" id="inputLocal2" class="btn btn-small clearCashe btn-danger"><i class="icon-trash icon-white" ></i> Очистить</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane"></div>
    </div>
</section><div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"> <?php lang('a_event_journal') ?> </span>
            </div>                                                   
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="modules">
                <div class="row-fluid">
                    <div class="form-horizontal">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>                                              
                                    <th class="span2"> <?php lang('a_us_in_admin') ?> </th>
                                    <th class="span3"> <?php lang('a_d_m_admin') ?> </th>
                                    <th class="span5"> <?php lang('a_action_admin') ?> </th>
                                </tr>
                            </thead>
                            <tbody class="sortable ui-sortable">
                                 <?php foreach $messages as $m ?>                                   
                                <td><p> <?php $m.username ?> </p></td>
                                <td><p> <?php date('d-m-Y H:i:s', $m.date) ?> </p></td>
                                <td><p> <?php $m.message ?> </p></td>
                                </tr>
                             <?php /foreach ?>                                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>   
            <div class="clearfix">
                     <?php $paginator ?> 
            </div>
    </section>
</div>