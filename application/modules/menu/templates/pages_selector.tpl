<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Edit link', 'menu')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="#" class="t-d_n m-r_15 pjax"><span class="f-s_14"></span>←<span class="t-d_u">{lang('Go back', "menu")}</span></a>
                <button type="button" class="btn btn-small btn-primary page_item_save"><i class="icon-ok"></i>{lang("Save", "menu")}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="pages">
            <select class="link_type">
                <option value="page">{lang('Page', 'menu')}:</option>
                <option value="category">{lang('Category', 'menu')}:</option>
                <option value="module">{lang('Module', 'menu')}:</option>
                <option value="url">{lang('Link', 'menu')}:</option>
            </select>
            <form method="post" action="/admin/components/cp/menu/insert_menu_item/" id="{$item_type}_form">
                <div class="row-fluid">
                    <div class="span6">
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
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Categories", "menu")}:</label>
                                                    <div class="controls">
                                                        <select id="category_sel">
                                                            <option value="0">{lang("Root", "menu")}</option>
                                                            {$cats}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang('On page', 'menu')}::</label>
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
                                                    <label class="control-label">{lang('Pages list', 'menu')}::</label>
                                                    <div class="controls">
                                                        <div id="pages_list_holder">
                                                            <ul>
                                                                {foreach $pages.pages_list as $item}
                                                                    <li><a href="#" class="page_title" data-title="{$item.title}" data-id="{$item.id}">{echo $item.title}</a></li>
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
                        <table class="table  table-bordered table-hover table-condensed content_big_td">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Parameters', 'menu')}::
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Type", "menu")}:</label>
                                                    <div class="controls">
                                                        {lang("Page", "menu")}
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang("ID", "menu")}:</label>
                                                    <div class="controls">
                                                        <span id="page_id_holder">{$id}</span>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Title", "menu")}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$title}" name="item_title"  id="item_title" />
                                                    </div>
                                                </div>        
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Parent", "menu")}:</label>
                                                    <div class="controls">
                                                        <select name="item_parent_id" id="item_parent_id">
                                                            <option value="0">{lang("No", "menu")}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $parent != 0 AND $parent == $p.parent}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Position after", "menu")}:</label>
                                                    <div class="controls">
                                                        <select name="position_after" id="position_after">
                                                            <option value="0">{lang("No", "menu")}</option>
                                                            <option value="first">{lang("First", "menu")}</option>
                                                            {foreach $parents as $p}
                                                                <option value="{$p.id}" {if $parent != 0 AND $parent == $p.parent}selected="selected"{/if}> - {$p.title}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Image", "menu")}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="page_image"  id="page_image" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Access level", "menu")}:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0">{lang("All", "menu")}</option>
                                                            {foreach $roles as $role}
                                                                <option value ="{$role.id}">{$role.alt_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Hide", "menu")}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="hidden_v" id="page_hidden"/> {lang("Yes", "menu")}
                                                        <input type="radio" name="hidden_v" id="page_nohidden" checked="checked" /> {lang("No", "menu")}
                                                    </div>
                                                </div>            
                                                <div class="control-group">
                                                    <label class="control-label">{lang("Open in the new window", "menu")}:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="new_page" id="page_newpage"  onclick="page_newpage = 1;" /> {lang("Yes", "menu")}
                                                        <input type="radio" name="new_page" id="page_nonewpage" onclick="page_newpage = 0;"  checked="checked" /> {lang("No", "menu")}
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
    </div>
</section>