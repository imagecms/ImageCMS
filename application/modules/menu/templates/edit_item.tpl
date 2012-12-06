<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_edit_menu_item')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/menu/menu_item/{$menu.name}" class="t-d_n m-r_15 pjax"><span class="f-s_14"></span>←<span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit submit_link" data-form="#{$item.item_type}_form" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit submit_link" data-form="#{$item.item_type}_form" data-action="tomain"><i class="icon-ok"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content content_big_td">
        <div class="m-t_10">
            <select class="link_type input-xxlarge">
                <option value="page" {if $item.item_type == 'page'}selected="selected"{/if}>{lang('a_page')}</option>
                <option value="category" {if $item.item_type == 'category'}selected="selected"{/if}>{lang('a_category')}</option>
                <option value="module" {if $item.item_type == 'module'}selected="selected"{/if}>{lang('a_module')}</option>
                <option value="url" {if $item.item_type == 'url'}selected="selected"{/if}>{lang('amt_link')}</option>
            </select>
        </div>
        <div {if $item.item_type != 'page'}style="display: none;"{/if} id="page" class="edit_holder">
            <form method="post" action="/admin/components/cp/menu/edit_item/{$item.id}" id="page_form">
                {$data = unserialize($item.add_data)}
                <input type="hidden" name="menu_id" value="{$menu.id}"/>
                <input type="hidden" name="item_id" value="{$item.item_id}" id="item_page_id"/>
                <input type="hidden" name="item_type" value="page"/>
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
                                                            {echo build_cats_tree($cats, $sel)}
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
                                                        <span id="page_id_holder">{$item.id}</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_title')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$item.title}" name="title"  id="item_title" />
                                                    </div>
                                                </div>        
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_parent')}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" id="item_parent_id">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            {foreach $parents as $par}
                                                                <option value="{$par.id}" {if $item.parent_id != 0 AND $item.parent_id == $par.id}selected="selected"{/if}> - {$par.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_position_after')}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" id="position_after">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            <option value="first">{lang('amt_first')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $item.position != 0 AND $item.postion == $p.postion + 1}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="Img">
                                                        {lang('amt_image')}:
                                                    </label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">            
                                                            <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>  {lang('a_select_image')}</button>
                                                        </div>
                                                        <div class="o_h">		            
                                                            <input type="text" name="item_image" id="Img" value="{$item.item_image}">					
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_access_level')}:</label>
                                                    <div class="controls">
                                                        {$r  = unserialize($item.roles)}
                                                        {if !is_array($r)}
                                                            {$r = array()}
                                                        {/if}
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang('amt_all')}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}" {if in_array($role.id, $r)}selected="selected"{/if}>{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_hide')}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15"><input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/> {lang('amt_yes')}</span>
                                                        <input type="radio" name="hidden" value="0" {if $item.hidden == 0}checked="checked"{/if}/> {lang('amt_no')}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15"><input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/> {lang('amt_yes')}</span>
                                                        <input type="radio" name="newpage" value="0" {if $data.newpage == 0}checked="checked"{/if}/> {lang('amt_no')}
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
            <form method="post" action="/admin/components/cp/menu/edit_item/{$item.id}" id="category_form" >
                {$data = unserialize($item.add_data)}
                <input type="hidden" name="menu_id" value="{$menu.id}"/>
                <input type="hidden" name="item_id" value="{$item.item_id}" id="cat_input"/>
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
                                                        <span id="cat_id_holder">{$item.item_id}</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_title')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$item.title}" name="title"  id="item_cat_title" />
                                                    </div>
                                                </div>        
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_parent')}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" id="item_parent_id">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $item.parent_id != 0 AND $item.parent_id == $p.id}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_position_after')}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" id="position_after">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            <option value="first">{lang('amt_first')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $item.position != 0 AND $item.postion == $p.postion + 1}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="Img">
                                                        {lang('amt_image')}:
                                                    </label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">            
                                                            <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>  {lang('a_select_image')}</button>
                                                        </div>
                                                        <div class="o_h">		            
                                                            <input type="text" name="item_image" id="Img" value="{$item.item_image}">					
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_access_level')}:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang('amt_all')}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}" {if in_array($role.id, $r)}selected="selected"{/if}>{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_hide')}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15"><input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/> {lang('amt_yes')}</span>
                                                        <input type="radio" name="hidden" value="0" {if $item.hidden == 0}checked="checked"{/if}/> {lang('amt_no')}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15"><input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/> {lang('amt_yes')}</span>
                                                        <input type="radio" name="newpage" value="0" {if $data.newpage == 0}checked="checked"{/if}/> {lang('amt_no')}
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
            <form method="post" action="/admin/components/cp/menu/edit_item/{$item.id}" id="module_form" >
                <input type="hidden" name="menu_id" value="{$menu.id}"/>
                <input type="hidden" name="item_id" value="0" />
                <input type="hidden" name="item_type" value="module"/>
                <input type="hidden" name="mod_name" value="{$data.mod_name}"/>
                <div class="row-fluid">
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_module')}
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
                                                        <span id="module_name_holder">{$data.mod_name}</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_title')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$item.title}" name="title"  id="module_item_title" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Функция:</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$data.method}" name="mod_method"/>
                                                        <span class="help-inline">Например: func_name/param1/param2</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_parent')}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" id="item_parent_id">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $item.position != 0 AND $item.postion == $p.postion + 1}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_position_after')}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" id="position_after">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            <option value="first">{lang('amt_first')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $item.position != 0 AND $item.postion == $p.postion + 1}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="Img">
                                                        {lang('amt_image')}:
                                                    </label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">            
                                                            <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>  {lang('a_select_image')}</button>
                                                        </div>
                                                        <div class="o_h">		            
                                                            <input type="text" name="item_image" id="Img" value="{$item.item_image}">					
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_access_level')}:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang('amt_all')}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}" {if in_array($role.id, $r)}selected="selected"le{/if}>{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_hide')}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15"><input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/> {lang('amt_yes')}</span>
                                                        <input type="radio" name="hidden" value="0" {if $item.hidden == 0}checked="checked"{/if}/> {lang('amt_no')}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15"><input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/> {lang('amt_yes')}</span>
                                                        <input type="radio" name="newpage" value="0" {if $data.newpage == 0}checked="checked"{/if}/> {lang('amt_no')}
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
            <form method="post" action="/admin/components/cp/menu/edit_item/{$item.id}" id="url_form" >
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
                                                        <input type="text" id="url_to_page" value="{echo $data.url}" name="item_url"/>
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
                                                        <input type="text" value="{$item.title}" name="title"  id="item_title" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_parent')}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" id="item_parent_id">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $item.position != 0 AND $item.postion == $p.postion + 1}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_position_after')}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" id="position_after">
                                                            <option value="0">{lang('amt_no')}</option>
                                                            <option value="first">{lang('amt_first')}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $item.position != 0 AND $item.postion == $p.postion + 1}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="Img">
                                                        {lang('amt_image')}:
                                                    </label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">            
                                                            <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>  {lang('a_select_image')}</button>
                                                        </div>
                                                        <div class="o_h">		            
                                                            <input type="text" name="item_image" id="Img" value="{$item.item_image}">					
                                                        </div>
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
                                                        <span class="m-r_15"><input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/> {lang('amt_yes')}</span>
                                                        <input type="radio" name="hidden" value="0" {if $item.hidden == 0}checked="checked"{/if}/> {lang('amt_no')}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15"><input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/> {lang('amt_yes')}</span>
                                                        <input type="radio" name="newpage" value="0" {if $data.newpage == 0}checked="checked"{/if}/> {lang('amt_no')}
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
<div id="elFinder"></div>