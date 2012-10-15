<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_manager_user_mod')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$SELF_URL}/create_user/'"><i class="icon-list-alt icon-white"></i>Создать пользователя</button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$BASE_URL}admin/components/cp/user_manager/create'"><i class="icon-list-alt icon-white"></i>Создать группу</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#save" ><i class="icon-ok"></i>Сохранить</button>
                    <button type="button" class="btn btn-small action_on"><i class="icon-check"></i>Сохранить и выйти</button>
                </div>
            </div>                            
        </div>
        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
            <a href="#users" class="btn btn-small active">{lang('amt_users')}</a>
            <a href="#group" class="btn btn-small">{lang('amt_groups')}</a>
            <a href="#privilege" class="btn btn-small">{lang('amt_perm_div')}</a>
        </div>        
        <div class="tab-content">
            <!----------------------------------------------------- USERS-------------------------------------------------------------->
            <div class="tab-pane active" id="users">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="t-a_c span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th class="span1">{lang('amt_id')}</th>
                            <th class="span3">{lang('a_login')}</th>
                            <th class="span3">{lang('a_email')}</th>
                            <th class="span2">{lang('a_group')}</th>
                            <th class="span1">{lang('a_banned')}</th>
                            <th class="span2">{lang('a_b_last_ip')}</th>
                        </tr>
                        <tr class="head_body">
                            <td></td>
                            <td></td>
                            <td>
                                <select>
                                    <option>Login</option>
                                    <option>Email</option>
                                    <option>Group</option>
                                </select>
                            </td>                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        {foreach $users as $user}
                            <tr>
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </td>
                                <td><p>{echo $user.id}</p></td>
                                <td><a href="{$SELF_URL}/edit_user/{echo $user.id}">{echo $user.username}</a></td>                            
                                <td>{$user.email}</td>
                                <td><p>{$user.role_alt_name}</p></td>
                                <td>
                                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" onclick="change_status('{$BASE_URL}admin/components/cp/user_manager/actions/{echo $user.id}');" >
                                        <span class="prod-on_off {if $user.banned == 1}disable_tovar{/if}" ></span>
                                    </div>
                                    </div>
                                </td>
                                <td><p>{$user.last_ip}</p></td>
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
            </div>

            <!----------------------------------------------------- GROUP-------------------------------------------------------------->
            <div class="tab-pane" id="group">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="t-a_c span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th class="span1">{lang('amt_id')}</th>
                            <th class="span3">{lang('amt_tname')}</th>
                            <th class="span3">{lang('amt_identif')}</th>
                            <th class="span2">{lang('amt_description')}</th>
                        </tr>
                        <tr class="head_body">
                            <td></td>
                            <td></td>
                            <td>
                                <select>
                                    <option>Login</option>
                                    <option>Email</option>
                                    <option>Group</option>
                                </select>
                            </td>                          

                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        {foreach $roles as $group}
                            <tr>
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </td>
                                <td><p>{$group.id}</p></td>
                                <td><a href="{$SELF_URL}/edit/{$group.id}">{$group.alt_name}</a></td>                            
                                <td>{$group.name}</td>
                                <td><p>{$group.desc}</p></td>                               
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
            </div>
            <!----------------------------------------------------- PRIVILEGE-------------------------------------------------------------->
          
            <div class="tab-pane" id="privilege">    
                <form action="{$SELF_URL}/update_role_perms" method="post" id="save">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('a_param')}
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
                                                    <label class="control-label" for="role_id">{lang('amt_group')}</label>
                                                    <div class="controls">
                                                     <select name="role_id" id="role_id">
	    {foreach $roles as $role}
		    <option onclick="change_status('{$BASE_URL}admin/components/cp/user_manager/show_edit_prems_tpl/{$role.id}');" value ="{$role.id}" {if $role.id == $selected_role} selected="selected" {/if} >{$role.alt_name}</option>
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
    </section>
</div>
