<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Удаление пользователя</h3>
        </div>
        <div class="modal-body">
            <p>Удалить выбранных пользователей?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$BASE_URL}admin/components/cp/user_manager/deleteAll')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">Отмена</a>
        </div>
    </div>


    <div id="delete_dialog" title="Удаление пользователя" style="display: none">
        Удалить пользователя?
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_manager_user_mod')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table/" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$SELF_URL}/create_user/'"><i class="icon-list-alt icon-white"></i>{lang('a_user_create')}</button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$BASE_URL}admin/components/cp/user_manager/create'"><i class="icon-list-alt icon-white"></i>{lang('a_u_manager_create_group')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#save" ><i class="icon-ok"></i>{lang('a_save')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#save"><i class="icon-check"></i>{lang('a_save_and_exit')}</button>
                     <button type="button" class="btn btn-small disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash"></i>{lang('a_delete')}</button>
                </div>
            </div>                            
        </div>
        <div class="clearfix">
            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                <a href="#users" class="btn btn-small active">{lang('amt_users')}</a>
                <a href="#group" class="btn btn-small">{lang('amt_groups')}</a>
                <a href="#privilege" class="btn btn-small">{lang('amt_perm_div')}</a>
            </div>   
<div class="m-t_20 pull-right">

                    <button type="button" class="btn btn-small action_on disabled listFilterSubmitButton"><i class="icon-filter"></i>{lang('a_filter_admin')}</button>
                    <a href="/admin/components/init_window/user_manager"  title="{lang('a_cancel_filter')}" type="button" class="btn btn-small pjax action_on disabled"><i class="icon-refresh"></i>{lang('a_cancel_filter')}</a>
                </div>
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
                            <th class="span1">{lang('a_ID')}</th>
                            <th class="span3">{lang('a_us_in_admin2')}</th>
                            <th class="span3">{lang('a_email')}</th>
                            <th class="span2">{lang('a_u_man_group_sa_yser')}</th>
                            <th class="span1">{lang('a_banned')}</th>
                            <th class="span2">{lang('a_b_last_ip')}</th>
                        </tr>
                    <form method="get" action="/admin/components/cp/user_manager/search/" id="ordersListFilter" class="listFilterForm">
                        <tr class="head_body">
                            <td></td>
                            <td></td>                                    
                            <td><input type="text" data-provide="typeahead" data-items="5" id="usersName" name="s_data"/></td>
                            <td><input type="text" data-provide="typeahead" data-items="5" id="usersEmail" name="s_data"/></td>
                            <td><select name="role" id="role">
                                    <option value ="0">{lang('amt_all_groups')}</option>
                                    {foreach $roles as $role}
                                        <option value ="{$role.id}">{$role.alt_name}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                            {foreach $users as $user}
                                <tr>
                                    <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" name="ids" data-id-group="1" value="{echo $user.id}"/>
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
                </form>
                <div align="center" style="padding:5px;">

                    {$paginator}

                </div>
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
                                                                    <option class="pjax" onclick="window.location.href='{$BASE_URL}admin/components/cp/user_manager/{$role.id}';" value ="{$role.id}" {if $role.id == $selected_role} selected="selected" {/if} >{$role.alt_name}</option>
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
