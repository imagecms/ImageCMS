<div id="module" class="tab-pane {if $item.item_type == 'module'}active{/if}">
    <form method="post" action="/admin/components/cp/menu/edit_item/{$item.id}" id="saveForm">
        <div class="m-t_20"><h4>{lang('amt_select_module')}:</h4></div>
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
                                                <span class="help-block">
                                                    {lang('amt_module')}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">{lang('amt_name')}:</label>
                                            <div class="controls">
                                                <span id="module_name_holder" class="help-block">{$data.mod_name}</span>
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
                                                <span class="m-r_15">
                                                    <span class="frame_label no_connection">
<!--                                                        <span class="niceRadio">
                                                            <input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/>
                                                        </span>-->
                                                            <input type="radio" name="hidden" value="1" {if $item.hidden == 1}checked="checked"{/if}/>
                                                    </span>
                                                    {lang('amt_yes')}
                                                </span>
                                                <span class="frame_label no_connection">
<!--                                                    <span class="niceRadio">
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
                                                <span class="m-r_15">
                                                    <span class="frame_label no_connection">
<!--                                                        <span class="niceRadio">
                                                            <input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/>
                                                        </span>-->
                                                            <input type="radio" name="newpage" value="1" {if $data.newpage == 1}checked="checked"{/if}/>
                                                        {lang('amt_yes')}
                                                    </span>
                                                </span>
                                                <span class="frame_label no_connection">
<!--                                                    <span class="niceRadio">
                                                        <input type="radio" name="newpage" value="0" {if $data.newpage == 0}checked="checked"{/if}/>
                                                    </span>-->
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
            </div>
        </div>
    </form>
</div>