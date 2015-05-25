<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Create a menu item", "menu")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/menu/menu_item/{$menu.name}" class="t-d_n m-r_15 pjax"><span class="f-s_14"></span>←<span class="t-d_u">{lang("Go back", "menu")}</span></a>
                <button type="button" class="btn btn-small btn-success formSubmit submit_link" data-form="#page_form" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create", "menu")}</button>
                <button type="button" class="btn btn-small formSubmit submit_link" data-form="#page_form" data-action="tomain"><i class="icon-check"></i>{lang("Create and exit", "menu")}</button>
            </div>
        </div>                            
    </div>
    <div class="row">
        {//$item.item_type = 'page'}
        <div class="span5">
            <ul class="btn-group myTab m-t_10 nav-tabs horiz link_type">
                <li class="btn btn-small active"><a href="#page">{lang("Page", "menu")}</a></li>
                <li class="btn btn-small"><a href="#category">{lang("Categories", "menu")}</a></li>
                <li class="btn btn-small"><a href="#module">{lang("Module", "menu")}</a></li>
                <li class="btn btn-small"><a href="#url">{lang("Link", "menu")}</a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content form-horizontal">
        <div id="page" class="tab-pane active">
            <form method="post" action="/admin/components/cp/menu/create_item/" id="page_form">
                {$data = unserialize($item.add_data)}
                <input type="hidden" name="menu_id" value="{$menu.id}"/>
                <input type="hidden" name="item_id" value="{$item.item_id}" id="item_page_id"/>
                <input type="hidden" name="item_type" value="page"/>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Pages", "menu")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label">{lang("Categories", "menu")}:</label>
                                            <div class="controls">
                                                <select id="category_sel">
                                                    <option value="0">{lang("Root", "menu")}</option>
                                                    {$sel = array()}
                                                    {echo build_cats_tree($cats, $sel)}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">{lang('On page', 'menu')}:</label>
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
                                            <label class="control-label">{lang('Pages list', 'menu')}:</label>
                                            <div class="controls">
                                                <div id="pages_list_holder" class="span3">
                                                    <ul class="nav myTab nav-tabs nav-stacked">
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
                <input type="hidden" id="owner_id" value="{$insert_id}" />
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Options', 'menu')}:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label">{lang("Type", "menu")}:</label>
                                            <div class="controls">
                                                <span class="help-block">{lang("Page", "menu")}</span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">{lang("ID", "menu")}: <span class="must">*</span></label>
                                            <div class="controls">
                                                <span id="page_id_holder" class="help-block">{$item.id}</span>
                                            </div>
                                        </div>   
                                        <div class="control-group">
                                            <label class="control-label">{lang("Title", "menu")}: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" value="{$item.title}" name="title"  id="item_title" />
                                            </div>
                                        </div>        
                                        <div class="control-group">
                                            <label class="control-label">{lang("Parent", "menu")}:</label>
                                            <div class="controls">
                                                <select name="parent_id" id="item_parent_id">
                                                    <option value="0">{lang("No", "menu")}</option>
                                                    {foreach $parents as $par}
                                                        <option value="{$par.id}" {if $item.parent_id != 0 AND $item.parent_id == $par.id}selected="selected"{/if}> - {$par.title}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>            
                                        <div class="control-group">
                                            <label class="control-label" for="Img0">
                                                {lang("Image", "menu")}:
                                            </label>
                                            <div class="controls">
                                                <div class="group_icon pull-right">            
                                                    <button class="btn btn-small" onclick="elFinderPopup('image', 'Img0');
                                                            return false;"><i class="icon-picture"></i>  {lang('Choose an image ', "menu")}</button>
                                                </div>
                                                <div class="o_h">		            
                                                    <input type="text" name="page_item_image" id="Img0" value="{$item.item_image}">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="control-group">
                                            <label class="control-label">{lang("Access level", "menu")}:</label>
                                            <div class="controls">
                                                {$r  = unserialize($item.roles)}
                                                {if !is_array($r)}
                                                    {$r = array()}
                                                {/if}
                                                <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                    <option value="0">{lang("All", "menu")}</option>
                                                    {foreach $roles as $role}
                                                        <option value ="{$role.id}" {if in_array($role.id, $r)}selected="selected"{/if}>{$role.alt_name}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>    
                                        <div class="control-group">
                                            <label class="control-label">{lang("Hide", "menu")}:</label>
                                            <div class="controls">
                                                <span class="frame_label no_connection m-r_15">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="page_hidden" value="1"/>
                                                    </span> {lang("Yes", "menu")}
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="page_hidden" value="0" checked="checked"/>
                                                    </span>
                                                    {lang("No", "menu")}
                                                </span>
                                            </div>
                                        </div>            
                                        <div class="control-group">
                                            <label class="control-label">{lang("Open in the new window", "menu")}:</label>
                                            <div class="controls">
                                                <span class="m-r_15 frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="page_newpage" value="1"/>
                                                    </span> {lang("Yes", "menu")}
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="page_newpage" value="0" checked="checked"/>
                                                    </span> {lang("No", "menu")}
                                                </span>
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
        <div id="category" class="tab-pane">
            <form method="post" action="/admin/components/cp/menu/create_item/" id="category_form" >
                {$data = unserialize($item.add_data)}
                <input type="hidden" name="menu_id" value="{$menu.id}"/>
                <input type="hidden" name="item_id" value="{$item.item_id}" id="cat_input"/>
                <input type="hidden" name="item_type" value="category"/>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Pages", "menu")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label">{lang("Choose a category", "menu")}:</label>
                                            <div class="controls">
                                                <ul>
                                                    {build_cats_tree_ul_li($cats)}  
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Options', 'menu')}:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label">{lang("Type", "menu")}:</label>
                                            <div class="controls">
                                                <span class="help-block">{lang("Categories", "menu")}</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">{lang("ID", "menu")}: <span class="must">*</span></label>
                                            <div class="controls">
                                                <span id="cat_id_holder" class="help-block">{$item.item_id}</span>
                                            </div>
                                        </div>    
                                        <div class="control-group">
                                            <label class="control-label">{lang("Title", "menu")}: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" value="{$item.title}" name="title"  id="item_cat_title" />
                                            </div>
                                        </div>        
                                        <div class="control-group">
                                            <label class="control-label">{lang("Parent", "menu")}:</label>
                                            <div class="controls">
                                                <select name="parent_id" id="item_parent_id">
                                                    <option value="0">{lang("No", "menu")}</option>
                                                    {foreach $parents as $p}
                                                        <option value="{$p.id}" {if $item.parent_id != 0 AND $item.parent_id == $p.id}selected="selected"{/if}> - {$p.title}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>            
                                        <div class="control-group">
                                            <label class="control-label" for="Img1">
                                                {lang("Image", "menu")}:
                                            </label>
                                            <div class="controls">
                                                <div class="group_icon pull-right">            
                                                    <button class="btn btn-small" onclick="elFinderPopup('image', 'Img1');
                                                            return false;"><i class="icon-picture"></i>  {lang('Choose an image ', "menu")}</button>
                                                </div>
                                                <div class="o_h">		            
                                                    <input type="text" name="cat_item_image" id="Img1" value="{$item.item_image}">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="control-group">
                                            <label class="control-label">{lang("Access level", "menu")}:</label>
                                            <div class="controls">
                                                <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                    <option value="0">{lang("All", "menu")}</option>
                                                    {foreach $roles as $role}
                                                        <option value ="{$role.id}" {if in_array($role.id, $r)}selected="selected"{/if}>{$role.alt_name}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>    
                                        <div class="control-group">
                                            <label class="control-label">{lang("Hide", "menu")}:</label>
                                            <div class="controls">
                                                <span class="m-r_15 frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="cat_hidden" value="1"/>
                                                    </span>
                                                    {lang("Yes", "menu")}
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="cat_hidden" value="0"checked="checked"/>
                                                    </span>
                                                    {lang("No", "menu")}
                                                </span>
                                            </div>
                                        </div>            
                                        <div class="control-group">
                                            <label class="control-label">{lang("Open in the new window", "menu")}:</label>
                                            <div class="controls">
                                                <span class="m-r_15">
                                                    <span class="frame_label no_connection">
                                                        <span class="niceRadio">
                                                            <input type="radio" name="cat_newpage" value="1"/>
                                                        </span>
                                                        {lang("Yes", "menu")}
                                                    </span>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="cat_newpage" value="0" checked="checked"/>
                                                    </span>
                                                    {lang("No", "menu")}
                                                </span>
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
        <div id="module" class="tab-pane">
            <form method="post" action="/admin/components/cp/menu/create_item/" id="module_form">
                <div class="m-t_20"><h4>{lang("Select module", "menu")}:</h4></div>
                <div class="row-fluid">
                    <div class="span3">
                        <input type="hidden" name="menu_id" value="{$menu.id}"/>
                        <input type="hidden" name="item_id" value="0" />
                        <input type="hidden" name="item_type" value="module"/>
                        <input type="hidden" name="mod_name" value="{$data.mod_name}"/>
                        <ul class="nav myTab nav-tabs nav-stacked">
                            {foreach $modules as $module}
                                <li><a href="#" class="module_item" data-mname="{$module.name}" id="module_{$module.name}" title="{$module.description}">{$module.menu_name}</a></li>
                                {/foreach}   
                        </ul>
                    </div>
                    <div class="span9">
                        <table class="table  table-bordered table-hover table-condensed content_big_td">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Parameters', 'menu')}:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Type", "menu")}:</label>
                                                    <div class="controls">
                                                        <span class="help-block">
                                                            {lang("Module", "menu")}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Name", "menu")}: <span class="must">*</span></label>
                                                    <div class="controls">
                                                        <span id="module_name_holder" class="help-block">{$data.mod_name}</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Title", "menu")}: <span class="must">*</span></label>
                                                    <div class="controls">
                                                        <input type="text" value="{$item.title}" name="title"  id="module_item_title" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('Function', 'menu')}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$data.method}" name="mod_method"/>
                                                        <span class="help-inline">{lang('For example', 'menu')}: func_name/param1/param2</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Parent", "menu")}:</label>
                                                    <div class="controls">
                                                        <select name="parent_id" id="item_parent_id">
                                                            <option value="0">{lang("No", "menu")}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $item.position != 0 AND $item.postion == $p.postion + 1}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                
                                                        
                                                <div class="control-group">
                                                    <label class="control-label" for="Img2">
                                                        {lang("Image", "menu")}:
                                                    </label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">            
                                                            <button class="btn btn-small" onclick="elFinderPopup('image', 'Img2');
                                                                    return false;"><i class="icon-picture"></i>  {lang('Choose an image ', "menu")}</button>
                                                        </div>
                                                        <div class="o_h">		            
                                                            <input type="text" name="module_item_image" id="Img2" value="{$item.item_image}">
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Access level", "menu")}:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang("All", "menu")}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}" {if in_array($role.id, $r)}selected="selected"le{/if}>{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Hide", "menu")}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15">
                                                            <span class="frame_label no_connection">
                                                                <span class="niceRadio">
                                                                    <input type="radio" name="module_hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/>
                                                                </span>
                                                            </span>
                                                            {lang("Yes", "menu")}
                                                        </span>
                                                        <span class="frame_label no_connection">
                                                            <span class="niceRadio">
                                                                <input type="radio" name="module_hidden" value="0" checked="checked"/>
                                                            </span>
                                                            {lang("No", "menu")}
                                                        </span>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Open in the new window", "menu")}:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15">
                                                            <span class="frame_label no_connection">
                                                                <span class="niceRadio">
                                                                    <input type="radio" name="module_newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/>
                                                                </span>
                                                                {lang("Yes", "menu")}
                                                            </span>
                                                        </span>
                                                        <span class="frame_label no_connection">
                                                            <span class="niceRadio">
                                                                <input type="radio" name="module_newpage" value="0" checked="checked"/>
                                                            </span>
                                                            {lang("No", "menu")}
                                                        </span>
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
        <div id="url" class="tab-pane">
            <form method="post" action="/admin/components/cp/menu/create_item/{$item.id}" id="url_form" >
                <input type="hidden" name="menu_id" value="{$menu.id}">
                <input type="hidden" name="item_id" value="0"/>
                <input type="hidden" name="item_type" value="url"/>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("URL", "menu")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label">{lang("Specify or select a link to the page", "menu")}: <span class="must">*</span></label>
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
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Settings", "menu")}:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                {$r = unserialize($item.roles)}
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label">{lang("Title", "menu")}: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" value="{$item.title}" name="title"  id="item_title" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">{lang("Parent", "menu")}:</label>
                                            <div class="controls">
                                                <select name="parent_id" id="item_parent_id">
                                                    <option value="0">{lang("No", "menu")}</option>
                                                    {foreach $parents as $p}
                                                        <option value="{$p.id}" {if $item.position != 0 AND $item.postion == $p.postion + 1}selected="selected"{/if}> - {$p.title}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>            
                                        <div class="control-group">
                                            <label class="control-label" for="Img3">
                                                {lang("Image", "menu")}:
                                            </label>
                                            <div class="controls">
                                                <div class="group_icon pull-right">            
                                                    <button class="btn btn-small" onclick="elFinderPopup('image', 'Img3');
                                                            return false;"><i class="icon-picture"></i>  {lang('Choose an image ', "menu")}</button>
                                                </div>
                                                <div class="o_h">		            
                                                    <input type="text" name="url_item_image" id="Img3" value="{$item.item_image}">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="control-group">
                                            <label class="control-label">{lang("Access level", "menu")}:</label>
                                            <div class="controls">
                                                <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                    <option value="0">{lang("All", "menu")}</option>
                                                    {foreach $roles as $role}
                                                        <option value ="{$role.id}" {if @in_array($role.id, $r)}selected="selected"{/if}>{$role.alt_name}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>    
                                        <div class="control-group">
                                            <label class="control-label">{lang("Hide", "menu")}:</label>
                                            <div class="controls">
                                                <span class="m-r_15">
                                                    <span class="frame_label no_connection">
                                                        <span class="niceRadio">
                                                            <input type="radio" name="url_hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/>
                                                        </span>
                                                        {lang("Yes", "menu")}
                                                    </span>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="url_hidden" value="0" checked="checked"/>
                                                    </span>
                                                    {lang("No", "menu")}
                                                </span>
                                            </div>
                                        </div>            
                                        <div class="control-group">
                                            <label class="control-label">{lang("Open in the new window", "menu")}:</label>
                                            <div class="controls">
                                                <span class="m-r_15">
                                                    <span class="frame_label no_connection">
                                                        <span class="niceRadio">
                                                            <input type="radio" name="url_newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/>
                                                        </span>
                                                        {lang("Yes", "menu")}
                                                    </span>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="url_newpage" value="0" checked="checked"/>
                                                    </span>
                                                    {lang("No", "menu")}
                                                </span>
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
</section>
<!--div id="elFinder"></div-->