<div class="tab-pane" id="privilege"> 
    <button type="button" class="btn btn-small btn-primary action_on formSubmit pull-right" style="margin-top:-26px; margin-bottom: 10px;" data-form="#save"><i class="icon-ok"></i>{lang('Save', 'user_manager')}</button>
    <form action="{$SELF_URL}/update_role_perms" method="post" id="save" style="clear:both;">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                         {lang('Properties', 'user_manager')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <div class="row-fluid">
                                    <form id="create" method="post" active="{$BASE_URL}admin/components/cp/user_manager/create">
                                        <div class="control-group">
                                            <label class="control-label" for="role_id">{lang('Group', 'user_manager')}</label>
                                            <div class="controls">
                                                <select name="role_id" id="role_id">
                                                    {foreach $roles as $role}
                                                        <option class="pjax" value="{$role.id}" {if $role.id == $selected_role} selected="selected" {/if} >{$role.alt_name}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table> 
        {foreach $groups as $group_k => $group_v}
            <div class="span3">
                <table class="table  table-bordered table-hover table-condensed t-l_a">
                    <thead>
                        <tr>
                            <th class="t-a_c span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" />
                                    </span>
                                </span>
                            </th>                           
                            <th>{$group_names[$group_k]}</th>
                        </tr>                        
                    </thead>
                    <tbody class="sortable">
                        {foreach $group_v as $k => $v}
                            <tr>       
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"  name="{$k}" value="1" {if array_key_exists($k, $permissions)} checked="checked" {/if}/>
                                        </span>
                                    </span>
                                </td>
                                <td><p>{$v}</p></td>                               
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
            </div>
        {/foreach}
</div>
</form>
</div>