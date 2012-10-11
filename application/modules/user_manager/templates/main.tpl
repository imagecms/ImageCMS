<div class="container">
    <ul class="breadcrumb">
        <li><a href="#">Главная</a> <span class="divider">/</span></li>
        <li class="active">Список товаров</li>
    </ul>
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Редактировать пункт меню</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$SELF_URL}/create_user/'"><i class="icon-list-alt icon-white"></i>Создать пользователя</button>
                    <button type="button" class="btn btn-small action_on"><i class="icon-ok"></i>Сохранить</button>
                    <button type="button" class="btn btn-small action_on"><i class="icon-check"></i>Сохранить и выйти</button>
                </div>
            </div>                            
        </div>
        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
            <a href="#users" class="btn btn-small active">{lang('amt_users')}</a>
            <a href="#create_user" class="btn btn-small">{lang('amt_to_create')}</a>
            <a href="#search" class="btn btn-small">{lang('amt_search')}</a>
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
                                <td>{echo $user.username}</td>                            
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
            <!----------------------------------------------------- CREATE USER-------------------------------------------------------------->
            <div class="tab-pane" id="create_user">
                <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang('a_dm_edit')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="row-fluid">
                                        <form id="createDelivery" method="post" active="{$ADMIN_URL}deliverymethods/create">

                                            <div class="control-group">
                                                <label class="control-label" for="Name">{lang('amt_user_login')}</label>
                                                <div class="controls">
                                                    <input type="text" name="username" value=""/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="Name">{lang('amt_new_pass')}</label>
                                                <div class="controls">
                                                    <input type="password" name="password" value="" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="Name">{lang('amt_new_pass_confirm')}</label>
                                                <div class="controls">
                                                    <input type="password" name="password_conf" value=""/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="Name">{lang('amt_email')}</label>
                                                <div class="controls">
                                                    <input type="text" name="email" value="" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="Name">{lang('amt_group')}</label>
                                                <div class="controls">
                                                    <select name="role">
				{foreach $roles as $role}
				  <option value ="{$role.id}">{$role.alt_name}</option>
				{/foreach}
				</select>
                                                </div>
                                            </div>
                                            
                                            
                                            {form_csrf()}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> 

            </div>
            <!----------------------------------------------------- SEARCH-------------------------------------------------------------->
            <div class="tab-pane" id="search">
                Search
            </div>
            <!----------------------------------------------------- GROUP-------------------------------------------------------------->
            <div class="tab-pane" id="group">
                Group
            </div>
            <!----------------------------------------------------- PRIVILEGE-------------------------------------------------------------->
            <div class="tab-pane" id="privilege">
                Privilege
            </div>
        </div>
    </section>
</div>