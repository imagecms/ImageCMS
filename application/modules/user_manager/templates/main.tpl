<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('a_sue_man_del_u_2')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('a_use_man_del_u_1')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$BASE_URL}admin/components/cp/user_manager/deleteAll')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
        </div>
    </div>


    <div id="delete_dialog" title="{lang('a_sue_man_del_u_2')}" style="display: none">
        {lang('a_sue_man_del_u_3')}
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
                    <a href="/admin/components/modules_table/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$SELF_URL}/create_user/'"><i class="icon-plus-sign icon-white"></i>{lang('a_user_create')}</button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$BASE_URL}admin/components/cp/user_manager/create'"><i class="icon-plus-sign icon-white"></i>{lang('a_u_manager_create_group')}</button>                    
                </div>
            </div>                            
        </div>
        <div class="clearfix">
            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                <a href="#users" class="btn btn-small active">{lang('amt_users')}</a>
                <!--<a href="#group" class="btn btn-small">{lang('amt_groups')}</a>-->
                <!--<a href="#privilege" class="btn btn-small">{lang('amt_perm_div')}</a>-->

            </div>   
        </div>
        <div class="tab-content clearfix">
            <!----------------------------------------------------- USERS-------------------------------------------------------------->
            <div class="tab-pane active" id="users">
                <button type="button" class="btn btn-small btn-danger action_on disabled pull-right" style="margin-top:-26px;" onclick="delete_function.deleteFunction()" disabled="disabled"><i class="icon-trash icon-white"></i> {lang('a_delete')}</button>
                <a href="/admin/components/init_window/user_manager"  title="{lang('a_cancel_filter')}" type="button" class="btn btn-small pjax action_on  pull-right" style="margin-top:-26px; margin-bottom: 10px; margin-right: 3px;"><i class="icon-refresh"></i> {lang('a_cancel_filter')}</a>
                <button type="button" class="btn btn-small disabled listFilterSubmitButton pull-right " style="margin-top:-26px; margin-right: 3px;" disabled="disabled"><i class="icon-filter"></i> {lang('a_filter_admin')}</button>

                <form method="get" action="/admin/components/cp/user_manager/search/" id="ordersListFilter" class="listFilterForm">
                    <table class="table table-striped table-bordered table-hover table-condensed" style="clear: both;">
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
                                <th class="span3">{lang('a_us_in_admin')}</th>
                                <th class="span3">{lang('a_email')}</th>
                                <th class="span2">{lang('a_u_man_group_sa_yser')}</th>
                                <th class="span1">{lang('a_banned')}</th>
                                <th class="span2">{lang('a_b_last_ip')}</th>
                            </tr>

                            <tr class="head_body">
                                <td></td>
                                <td></td>                                    
                                <td><input type="text" id="nameAutoC" name="s_data"/></td>
                                <td><input type="text" id="emailAutoC"  name="s_email"/></td>
                                        
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
                                    <td><a href="{$SELF_URL}/edit_user/{echo $user.id}" class="pjax">{echo $user.username}</a></td>                            
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
{/*}
            <!-- ---------------------------------------------------Блок видалення групп------------------------------------------------- -->    
            <div class="modal hide fade modal_dels">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>{lang('a_use_man_group_del_3')}</h3>
                </div>
                <div class="modal-body">
                    <p>{lang('a_use_man_group_del_2')}</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary" onclick="delete_functionS.deleteFunctionConfirmS('{$BASE_URL}admin/components/cp/user_manager/delete')" >{lang('a_delete')}</a>
                    <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
                </div>
            </div>


            <div id="delete_dialog" title="{lang('a_use_man_group_del_3')}" style="display: none">
                {lang('a_use_man_group_del_3')}
            </div>
            <!-- ---------------------------------------------------Блок видалення групп-------------------------------------------------- -->

            <!----------------------------------------------------- GROUP-------------------------------------------------------------->
            <div class="tab-pane" id="group">
                <button type="button" class="btn btn-small btn-danger disabled action_on pull-right" style="margin-top:-26px; " onclick="delete_functionS.deleteFunctionS()"><i class="icon-trash icon-white"></i> {lang('a_delete')}</button>

                <table class="table table-striped table-bordered table-hover table-condensed pull-right">
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
                    </thead>
                    <tbody>
                        {foreach $roles as $group}
                            <tr class="simple_tr">
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" id="group_del"  name="ids" data-id-group="1" value="{$group.id}"/>
                                        </span>
                                    </span>
                                </td>
                                <td><p>{$group.id}</p></td>
                                <td><a href="{$SELF_URL}/edit/{$group.id}" class="pjax">{$group.alt_name}</a></td>
                                <td>{$group.name}</td>
                                <td><p>{$group.desc}</p></td>                               
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
            </div>
            <!----------------------------------------------------- PRIVILEGE-------------------------------------------------------------->

            <div class="tab-pane" id="privilege"> 
                <button type="button" class="btn btn-small btn-primary action_on formSubmit pull-right" style="margin-top:-26px; margin-bottom: 10px;" data-form="#save" data-submit><i class="icon-ok icon-white"></i> {lang('a_save')}</button>
                <form action="{$SELF_URL}/update_role_perms/{$role.id}" method="post" id="save" style="clear:both;">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
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
                                        <div class="form-horizontal span9">
                                            <form id="create" method="post" active="{$BASE_URL}admin/components/cp/user_manager/create">
                                                <div class="control-group">
                                                    <label class="control-label" for="role_id">{lang('amt_group')}</label>
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
            </div>{ */}
            </form>
        </div>
    </section>
</div>