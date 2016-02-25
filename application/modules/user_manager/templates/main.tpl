<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang("Deleting a user", 'user_manager')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang("Remove selected users?", 'user_manager')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$BASE_URL}admin/components/cp/user_manager/deleteAll')" >{lang('Delete', 'user_manager')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel', 'user_manager')}</a>
        </div>
    </div>

    <div class="modal hide fade modal_role_change">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('Change user role','admin')}</h3>
        </div>
        <div class="modal-body">
            <p>
                <label class="v-a_m" style="width:115px;margin-right:10px; display: inline-block;margin-bottom:8px;">
                    {lang('Role', 'admin')}:
                </label>
                <select class="roleSelect">
                    <option value ="0">{lang('Without group', 'user_manager')}</option>
                    {foreach $roles as $role}
                        <option value ="{$role.id}">{$role.alt_name}</option>
                    {/foreach}
                </select>
            </p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="Users.changeRoleModal(this)" >{lang('Save','admin')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
        </div>
    </div>



    <div id="delete_dialog" title="{lang("Deleting a user", 'user_manager')}" style="display: none">
        {lang("Delete a user?", 'user_manager')}
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Corporate site users", 'user_manager')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'admin')}</span></a>

                    <button type="button" class="d_n btn btn-small disabled listFilterSubmitButton pull-right " disabled="disabled"><i class="icon-filter"></i> {lang('Filter admin', 'user_manager')}</button>
                    <button type="button" class="btn disabled action_on" onclick="delete_function.deleteFunction()" disabled="disabled"><i class="icon-trash"></i> {lang('Delete', 'user_manager')}</button>
                    <a href="/admin/components/init_window/user_manager"  title="{lang('Cancel filtering', 'user_manager')}" type="button" class="btn pjax action_on disabled" {/*}{if !$_GET || (count($_GET) == 1 && $_GET['_pjax'])}disabled="disabled"{/if}{ */}>
                        <i class="icon-refresh"></i> {lang('Cancel filtering', 'user_manager')}
                    </a>
                    <button type="button" class="btn btn-small disabled action_on" onclick="$('.modal_role_change').modal('show')">
                        <i class="icon-edit"></i>{lang('Change role','admin')}
                    </button>

                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href = '{$SELF_URL}/create_user/'"><i class="icon-plus-sign icon-white"></i>{lang('User create', 'user_manager')}</button>
                    <!--<button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$BASE_URL}admin/components/cp/user_manager/create'"><i class="icon-plus-sign icon-white"></i>{lang('Create a Group', 'user_manager')}</button>-->
                </div>
            </div>
        </div>
        {/*<div class="clearfix">
        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
            <a href="#users" class="btn btn-small active">{lang('Users', 'user_manager')}</a>
            <!--<a href="#group" class="btn btn-small">{lang('Groups', 'user_manager')}</a>-->
            <!--<a href="#privilege" class="btn btn-small">{lang('Access rights differentiation system', 'user_manager')}</a>-->

        </div>
    </div>*/}
    <div class="tab-content clearfix m-t_5">
        <!----------------------------------------------------- USERS-------------------------------------------------------------->
        <div class="tab-pane active" id="users">
            <form method="get" action="/admin/components/cp/user_manager/search" id="ordersListFilter" class="listFilterForm m-t_15">
                <table class="table  table-bordered table-hover table-condensed t-l_a" style="clear: both;">
                    <thead>
                        <tr>
                            <th class="t-a_c span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th>{lang("ID", 'user_manager')}</th>
                            <th>{lang("User", 'user_manager')}</th>
                            <th>{lang("E-mail", 'user_manager')}</th>
                            <th>{lang("Group", 'user_manager')}</th>
                            <th>{lang("Banned", 'user_manager')}</th>
                            <th>{lang("Last IP", 'user_manager')}</th>
                        </tr>

                        <tr class="head_body">
                            <td></td>
                            <td></td>
                            <td><input type="text" id="nameAutoC" {if isset($_GET['s_data'])}value="{echo htmlspecialchars($_GET['s_data'])}"{/if} name="s_data"/></td>
                            <td><input type="text" id="emailAutoC" {if isset($_GET['s_email'])}value="{echo htmlspecialchars($_GET['s_email'])}"{/if} name="s_email"/></td>

                            <td><select name="role" id="role">
                                <option {if $_GET['role']==0}selected{/if} value ="0">{lang('All groups', 'user_manager')}</option>
                                <option {if $_GET['role']==="without"}selected{/if} value ="without">{lang('Without group', 'user_manager')}</option>
                                {foreach $roles as $role}
                                <option value ="{$role.id}"{if $role.id==$role_id || $_GET['s_role'] == $role.id} selected="selected"{/if}>{$role.alt_name}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    {if $users}
                    {foreach $users as $user}
                    <tr class="simple_tr">
                        <td class="t-a_c">
                            {if $user.id != $CI->dx_auth->get_user_id()}
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox" id="user_del" name="ids" data-id-group="1" value="{echo $user.id}"/>
                                </span>
                            </span>
                            {/if}
                        </td>
                        <td><p>{echo $user.id}</p></td>
                        <td><a href="{$SELF_URL}/edit_user/{echo $user.id}" class="">{echo $user.username}</a></td>
                        <td>{$user.email}</td>
                        <td>
                            <select class="userRoleSelect_{echo $user.id}" onchange="Users.changeRoleId(this, {echo $user.id})">
                                {foreach $roles as $role}
                                    <option {if $role.id == $user.role_id} selected {/if}value="{echo $role.id}">{echo $role.alt_name}</option>
                                {/foreach}
                                <option {if !$user.role_id}selected{/if} value ="0">{lang('Without group', 'user_manager')}</option>
                            </select>
                        </td>
                        <td>
                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" onclick="change_status('{$BASE_URL}admin/components/cp/user_manager/actions/{echo $user.id}');" >
                                {if $user.id != $CI->dx_auth->get_user_id()}
                                <span class="prod-on_off {if !$user.banned}disable_tovar{/if}" ></span>
                                {/if}
                            </div>
                        </div>
                    </td>
                    <td><p>{$user.last_ip}</p></td>
                </tr>
                {/foreach}
                {/if}

            </tbody>
        </table>
        {if !$users}
        <div class="row-fluid news">
            <div class="span12">
                <div class="alert alert-warning">
                    <p>{lang('There are no results.', 'user_manager')}</p>
                </div>
            </div>
        </div>
        {/if}
    </form>
    <div align="center" style="padding:5px;">
        {$paginator}
    </div>
</div>
</form>
</div>
</section>
</div>