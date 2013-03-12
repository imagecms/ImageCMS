<div id="page" class="tab-pane {if $item.item_type == 'page'}active{/if}">
    <form method="post" action="/admin/components/cp/menu/edit_item/{$item.id}" id="saveForm">
        {$data = unserialize($item.add_data)}
        <input type="hidden" name="menu_id" value="{$menu.id}"/>
        <input type="hidden" name="item_id" value="{$item.item_id}" id="item_page_id"/>
        <input type="hidden" name="item_type" value="page"/>
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
                            <div class="span12">
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
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label">{lang('amt_type')}:</label>
                                    <div class="controls">
                                        <span class="help-block">{lang('amt_page')}</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">{lang('amt_id')}:</label>
                                    <div class="controls">
                                        <span id="page_id_holder" class="help-block">{$item.id}</span>
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
                                        <span class="frame_label no_connection m-r_15">
<!--                                            <span class="niceRadio">
                                                <input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/>
                                            </span> -->
                                                <input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/>
                                                {lang('amt_yes')}
                                        </span>
                                        <span class="frame_label no_connection">
<!--                                            <span class="niceRadio">
                                                <input type="radio" name="hidden" value="0" {if $item.hidden == 0}checked="checked"{/if}/>
                                            </span>-->
                                                <input type="radio" name="hidden" value="0" {if $item.hidden == 0}checked="checked"{/if}/>
                                                {lang('amt_no')}
                                        </span>
                                    </div>
                                </div>            
                                <div class="control-group">
                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                    <div class="controls">
                                        <span class="m-r_15 frame_label no_connection">
<!--                                            <span class="niceRadio">
                                                <input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/>
                                            </span>-->
                                                <input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/>
                                                {lang('amt_yes')}
                                        </span>
                                        <span class="frame_label no_connection">
<!--                                            <span class="niceRadio">
                                                <input type="radio" name="newpage" value="0" {if $data.newpage == 0}checked="checked"{/if}/>
                                            </span> -->
                                                <input type="radio" name="newpage" value="0" {if $data.newpage == 0}checked="checked"{/if}/>
                                                {lang('amt_no')}
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