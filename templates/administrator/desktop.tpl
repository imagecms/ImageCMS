<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>{lang('a_controll_panel')} | Image CMS</title>
	<meta name="description" content="{lang('a_controll_panel')} - Image CMS" />

	<link rel="stylesheet" href="{$THEME}/css/content.css" type="text/css" />
	<link rel="stylesheet" href="{$THEME}/css/rdTree.css" type="text/css" />
	<link rel="stylesheet" href="{$THEME}/css/calendar.css" type="text/css" />
	<link rel="stylesheet" href="{$THEME}/css/sortableTable.css" type="text/css" />
	<link rel="stylesheet" href="{$THEME}/css/alertbox.css" type="text/css" />
	<link rel="stylesheet" href="{$THEME}/css/Autocompleter.css" type="text/css" />
	<link rel="stylesheet" href="{$THEME}/css/ui.css" type="text/css" />

    
    <script  type="text/javascript">
        var theme = '{$THEME}';
        var base_url = '{$BASE_URL}';
        var h_steps = 0;
        var cur_pos = 0;
        var tt = 0;
    </script>

	<!--[if IE]>
		<script type="text/javascript" src="{$JS_URL}/mocha/excanvas-compressed.js"></script>
	<![endif]-->

	<script type="text/javascript" src="{$JS_URL}/compress_js.php"></script>

	<script type="text/javascript" src="{$JS_URL}/tinymce/tiny_mce.js.php"></script>
	<script type="text/javascript" src="{$JS_URL}/tinymce/plugins/tinybrowser/tb_tinymce.js.php"></script>
	<script type="text/javascript" src="{$JS_URL}/tinymce/plugins/tinybrowser/tb_standalone.js.php"></script>
    
    <!-- jQuery with noConflict -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <!-- jQuery with noConflict -->

    {($hook = get_hook('admin_tpl_desktop_head')) ? eval($hook) : NULL;}

    {literal}
    <script type="text/javascript">
        window.addEvent('domready', function(){
            ajax_div('page', base_url + 'admin/dashboard/index');
        });
    </script>
    {/literal}

    {$editor}

    
    {check_admin_redirect()}

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
        <img src="{$THEME}/images/logo1.png" width="130px;" />
        <div style="margin-top:40px;" >{lang('a_use_js')}</div>
    </div>
</NOSCRIPT>
<div id="desktop">

<div id="desktopHeader">

<div id="desktopTitlebarWrapper">

	<div id="desktopTitlebar">
            <img src="{$THEME}/images/logo1.png" id="cmsLogo" onclick="ajax_div('page', base_url + 'admin/dashboard/index'); return false;" style="cursor:pointer;" width="130px;" /> 
        <h2 class="tagline">
 
		</h2>
		<div id="topNav">
			<ul class="menu-right">
            <li>
                <img src="{$THEME}/images/left.png" style="cursor:pointer" title="Назад (Ctrl + Left)" onclick="history_back();">
				<img src="{$THEME}/images/right.png" style="cursor:pointer" title="Вперед (Ctrl + Right)" onclick="history_forward();">
				<img src="{$THEME}/images/refresh.png" style="cursor:pointer" class="refresh" title="Обновить  (Ctrl + R)" onclick="history_refresh();">
            </li>
			</ul>
		</div>
	</div>
    <div class="toolbox" style="display:none;">
	   	
    </div>
</div>

<div style="float:right;color:#fff;padding-top:11px;padding-right:8px;"> 
    {lang('a_wellcome')}, <span style="color: #CCCCCC">{$username}</span>
</div>

<div id="desktopNavbar">
<ul>
	<li><a class="returnFalse" href="#">{lang('a_cont')}</a>
		<ul>
			<li><a id="add_page_link" href="#">{lang('a_create')}</a></li>
			<li><a id="" href="#" class="returnFalse" onclick="ajax_div('page',base_url + 'admin/pages/GetPagesByCategory/0');">{lang('a_without_cat')}</a></li>
			<li class="divider"><a id="" href="#" onclick="com_admin('cfcm'); return false;">{lang('a_field_constructor')}</a></li>
		</ul>
	</li>

	<li><a class="returnFalse" href="">{lang('a_categories')}</a>
		<ul>
			<li><a id="create_cat_link_" href="#" onclick="ajax_div('page', base_url + 'admin/categories/create_form'); return false;">{lang('a_create')}</a></li>
				<li><a class="returnFalse" onclick="ajax_div('page', base_url + 'admin/categories/cat_list'); return false;" href="#">{lang('a_edit')}</a></li>
		</ul>
	</li>

	<li><a class="returnFalse" href="">{lang('a_menu')}</a>
		<ul>
			<li><a href="#" id="menu_manager_link" onclick="com_admin('menu'); return false;">{lang('a_control')}</a></li>
			<li class="divider returnFalse"><a href="#"></a></li>
            {foreach $menus as $menu}
			<li><a href="#" onclick="ajax_div('page',base_url + 'admin/components/cp/menu/menu_item/{$menu.name}'); return false;">{$menu.main_title}</a></li>
            {/foreach}
		</ul>
	</li>

	<li>
	<a class="returnFalse" href="#" onclick="ajax_div('page', base_url + 'admin/components/modules_table/'); return false;">{lang('a_modules')}</a>
		<ul>
		<li><a id="all_modules_link" href="#" onclick="ajax_div('page', base_url + 'admin/components/modules_table/'); return false;">{lang('a_all_modules')}</a></li> 
		<li><a id="mod_search_link" href="#" onclick="ajax_div('page', base_url + 'admin/mod_search/'); return false;">{lang('a_search')}</a></li>
	    <li class="divider returnFalse"><a href="#"></a></li>
			{if $components}
			{foreach $components as $component}
                {if $component['installed'] == TRUE AND $component['admin_file'] == 1}
				<li><a id="" href="#" onclick="com_admin('{$component.com_name}'); return false;">{$component.menu_name}</a>
				</li>
                {/if}
			{/foreach}
			{/if}
		</ul>
	</li>

	<li><a class="returnFalse" href="#" onclick="ajax_div('page', base_url + 'admin/widgets_manager'); return false;">{lang('a_widgets')}</a>
	</li>

	<li>
	<a class="returnFalse" href="">{lang('a_system')}</a>
		<ul>
			<li><a id="settings_link" class="returnFalse" href="#">{lang('a_site_settings')}</a></li>
            <!-- <li><a id="main_page_link" href="">Главная Страница</a></li> -->
			<li><a id="languages_link" href="">{lang('a_languages')}</a></li> 
			<li><a class="returnFalse arrow-right" href="">{lang('a_cache')}</a>
				<ul>
					<li><a  href="javascript:delete_cache('all')">{lang('a_clean_all')}</a></li>
					<li><a  href="javascript:delete_cache('expried')">{lang('a_clean_old')}</a></li>
				</ul>
			</li>
            <li class="divider"><a href="#" onclick="ajax_div('page', base_url + 'admin/admin_logs'); return false;">{lang('a_event_journal')}</a></li>
            <li><a href="#" onclick="ajax_div('page', base_url + 'admin/backup'); return false;">{lang('a_backup_copy')}</a></li>
		</ul>
	</li>

	<li><a href="{$BASE_URL}" target="_blank">{lang('a_show_site')}</a></li>
	<li><a href="{$BASE_URL}admin/logout">{lang('a_exit')}</a></li>
</ul>



</div>
<img id="spinner2" src="{$THEME}/images/spinner-placeholder.gif" />
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
