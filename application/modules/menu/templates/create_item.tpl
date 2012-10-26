<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_create_link')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/menu/menu_item/{$menu.name}" class="t-d_n m-r_15 pjax"><span class="f-s_14"></span>←<span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small formSubmit submit_link" data-form="#page_form"><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit submit_link" data-form="#page_form" data-action="tomain"><i class="icon-ok"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="m-t_10">
            <select class="link_type">
                <option value="page" {if $item.item_type == 'page'}selected="selected"{/if}>Страница</option>
                <option value="category" {if $item.item_type == 'category'}selected="selected"{/if}>Категория</option>
                <option value="module" {if $item.item_type == 'module'}selected="selected"{/if}>Модуль</option>
                <option value="url" {if $item.item_type == 'url'}selected="selected"{/if}>Ссылка</option>
            </select>
        </div>
        {$item.item_type = 'page'}
        <div {if $item.item_type != 'page'}style="display: none;"{/if} id="page" class="edit_holder">
            <form method="post" action="/admin/components/cp/menu/create_item/" id="page_form">
                <input type="hidden" name="menu_id" value="{$menu.id}"/>
                <input type="hidden" name="item_id" value="" id="item_page_id"/>
                <input type="hidden" name="item_type" value="{$item.item_type}"/>
                <div class="row-fluid">
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_pages')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_categories')}:</label>
                                                    <div class="controls">
                                                        <select id="category_sel">
                                                            <option value="0">{lang('amt_root')}</option>
                                                            {$sel = array()}
                                                            {build_cats_tree($cats, $sel)}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">На страницу:</label>
                                                    <div class="controls">
                                                        <select id="per_page">
                                                            <option value="10" selected="selected">10</option>
                                                            <option value="15">15</option>
                                                            <option value="20">20</option>
                                                            <option value="30">30</option>
                                                            <option value="40">40</option>
                                                            <option value="50">50</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Список страниц:</label>
                                                    <div class="controls">
                                                        <div id="pages_list_holder">
                                                            <ul>
                                                                {foreach $pages.pages_list as $p}
                                                                    <li><a class="page_title" data-url="{$p.cat_url}/{$p.url}" data-title="{$p.title}" data-id="{$p.id}">{echo $p.title}</a></li>
                                                                {/foreach}
                                                            </ul>
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
                    <div class="span6">
                        <input type="hidden" id="owner_id" value="{$insert_id}" />
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        Параметры:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_type')}:</label>
                                                    <div class="controls">
                                                        {lang('amt_page')}
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_id')}:</label>
                                                    <div class="controls">
                                                        <span id="page_id_holder">{echo $item.id}</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_title')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="title"  id="item_title" />
                                                    </div>
                                                </div>        
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_parent')}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" class="item_parent_id">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            {foreach $parents as $par}
                                                                <option value="{$par.id}"> - {$par.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_position_after')}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" class="position_after">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            <option value="first">{lang('amt_first')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}"> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_image')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="item_image"  id="page_image" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_access_level')}:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang('amt_all')}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}">{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_hide')}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="hidden" value="1"/> {lang('amt_yes')}
                                                        <input type="radio" name="hidden" value="0" checked="checked"/> {lang('amt_no')}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="newpage" value="1"/> {lang('amt_yes')}
                                                        <input type="radio" name="newpage" value="0" checked="checked"/> {lang('amt_no')}
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
            </form>
        </div>
        <div {if $item.item_type != 'category'}style="display: none;"{/if} id="category" class="edit_holder">
            <form method="post" action="/admin/components/cp/menu/create_item/" id="category_form" >
                <input type="hidden" name="menu_id" value="{$menu.id}"/>
                <input type="hidden" name="item_id" value="" id="cat_input"/>
                <input type="hidden" name="item_type" value="category"/>
                <div class="row-fluid">
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_pages')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_select_category')}:</label>
                                                    <div class="controls">
                                                        <ul>
                                                            {foreach $cats as $c}
                                                                <li><a href="#" class="category_item" data-id="{$c.id}" data-title="{$c.name}">{$c.name}</a></li>
                                                            {/foreach}   
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        Параметры:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_type')}:</label>
                                                    <div class="controls">
                                                        {lang('amt_category')}
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_id')}:</label>
                                                    <div class="controls">
                                                        <span id="cat_id_holder">0</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_title')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="title"  id="item_cat_title" />
                                                    </div>
                                                </div>        
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_parent')}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" class="item_parent_id">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $parent != 0 AND $parent == $p.parent}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_position_after')}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" class="position_after">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            <option value="first">{lang('amt_first')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}"> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_image')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="item_image"  id="page_image" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_access_level')}:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang('amt_all')}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}">{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_hide')}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="hidden" value="1"/> {lang('amt_yes')}
                                                        <input type="radio" name="hidden" value="0" checked="checked"/> {lang('amt_no')}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="newpage" value="1"/> {lang('amt_yes')}
                                                        <input type="radio" name="newpage" checked="checked" value="0"/> {lang('amt_no')}
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
            </form>
        </div>
        <div {if $item.item_type != 'module'}style="display: none;"{/if} id="module" class="edit_holder">
            <form method="post" action="/admin/components/cp/menu/create_item/" id="module_form" >
                <input type="hidden" name="menu_id" value="{$menu.id}"/>
                <input type="hidden" name="item_id" value="0" />
                <input type="hidden" name="item_type" value="module"/>
                <input type="hidden" name="mod_name" value=""/>
                <div class="row-fluid">
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_pages')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_select_module')}:</label>
                                                    <div class="controls">
                                                        <ul>
                                                            {foreach $modules as $module}
                                                                <li><a href="#" class="module_item" data-mname="{$module.name}" id="module_{$module.name}" title="{$module.description}">{$module.menu_name}</a></li>
                                                            {/foreach}   
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        Параметры:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_type')}:</label>
                                                    <div class="controls">
                                                        {lang('amt_module')}
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_name')}:</label>
                                                    <div class="controls">
                                                        <span id="module_name_holder"></span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_title')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="title"  id="module_item_title" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Функция:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="mod_method"/>
                                                        <span class="help-inline">Например: func_name/param1/param2</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_parent')}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" class="item_parent_id">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}"> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_position_after')}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" class="position_after">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            <option value="first">{lang('amt_first')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}"> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_image')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="item_image"  id="page_image" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_access_level')}:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang('amt_all')}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}">{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_hide')}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="hidden" value="1"/> {lang('amt_yes')}
                                                        <input type="radio" name="hidden" checked="checked" value="0"/> {lang('amt_no')}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="newpage" value="1"/> {lang('amt_yes')}
                                                        <input type="radio" name="newpage" checked="checked" value="0"/> {lang('amt_no')}
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
            </form>
        </div>
        <div {if $item.item_type != 'url'}style="display: none;"{/if} id="url" class="edit_holder">
            <form method="post" action="/admin/components/cp/menu/create_item/" id="url_form" >
                <input type="hidden" name="menu_id" value="{$menu.id}">
                <input type="hidden" name="item_id" value="0"/>
                <input type="hidden" name="item_type" value="url"/>
                <div class="row-fluid">
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('amt_url')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_select_page_link')}:</label>
                                                    <div class="controls">
                                                        <input type="text" id="url_to_page" value="" name="item_url"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_sett')}:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        {$r = unserialize($item.roles)}
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_title')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="title"  id="item_title" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_parent')}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" class="item_parent_id">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}"> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_position_after')}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" class="position_after">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            <option value="first">{lang('amt_first')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}"> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_image')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="item_image"  id="page_image" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_access_level')}:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang('amt_all')}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}" {if @in_array($role.id, $r)}selected="selected"{/if}>{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_hide')}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="hidden" value="1"/> {lang('amt_yes')}
                                                        <input type="radio" name="hidden" checked="checked" value="0"/> {lang('amt_no')}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="newpage" value="1"/> {lang('amt_yes')}
                                                        <input type="radio" name="newpage" checked="checked" value="0"/> {lang('amt_no')}
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
            </form>
        </div>                                            
</section>