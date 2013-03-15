<div id="category" class="tab-pane {if $item.item_type == 'category'}active{/if}">
    <form method="post" action="/admin/components/cp/menu/edit_item/{$item.id}" id="saveForm" >
        {$data = unserialize($item.add_data)}
        <input type="hidden" name="menu_id" value="{$menu.id}"/>
        <input type="hidden" name="item_id" value="{$item.item_id}" id="cat_input"/>
        <input type="hidden" name="item_type" value="category"/>
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
                                    <label class="control-label">{lang('amt_select_category')}:</label>
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
                                        <span class="help-block">{lang('amt_category')}</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">{lang('amt_id')}:</label>
                                    <div class="controls">
                                        <span id="cat_id_holder" class="help-block">{$item.item_id}</span>
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
                                        <span class="m-r_15 frame_label no_connection">
                                            <span class="niceRadio">
                                                <input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/>
                                            </span>
                                            {lang('amt_yes')}
                                        </span>
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio">
                                                <input type="radio" name="hidden" value="0" {if $item.hidden == 0}checked="checked"{/if}/>
                                            </span>
                                            {lang('amt_no')}
                                        </span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">{lang('amt_open_in_new_window')}:</label>
                                    <div class="controls">
                                        <span class="m-r_15">
                                            <span class="frame_label no_connection">
                                                <span class="niceRadio">
                                                    <input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/>
                                                </span>
                                                {lang('amt_yes')}
                                            </span>
                                        </span>
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio">
                                                <input type="radio" name="newpage" value="0" {if $data.newpage == 0}checked="checked"{/if}/>
                                            </span>
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