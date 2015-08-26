<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Create a new user', 'user_manager')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">

                    <a href="/admin/components/cp/user_manager" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'user_manager')}</span></a>
                    <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#create" data-action="close" data-submit><i class="icon-plus-sign icon-white"></i>{lang('Сreate', 'user_manager')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#create" data-action="exit"><i class="icon-check"></i>{lang('Create and exit', 'user_manager')}</button>

                </div>
            </div>
        </div>


        <!----------------------------------------------------- CREATE USER-------------------------------------------------------------->
        <div class="tab-pane">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang('New user', 'user_manager')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="row-fluid">
                                        <form id="create" method="post" active="{$SELF_URL}/create_user/">

                                            <div class="control-group">
                                                <label class="control-label" for="email">{lang('Email', 'user_manager')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="email" id="email" value="" class="required email" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="username">{lang('Full name', 'user_manager')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="username" id="username" value="" required autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="phone">{lang('Phone number', 'user_manager')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="phone" id="phone" value="" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="password">{lang('New password', 'user_manager')}:</label>
                                                <div class="controls">
                                                    <input type="password" name="password" id="password" value="" required autocomplete="off"/>
                                                </div>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label" for="password_conf">{lang('Confirm the password', 'user_manager')}:</label>
                                                <div class="controls">
                                                    <input type="password" name="password_conf" id="password_conf" value="" required/>
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="role">{lang('Group', 'user_manager')}:</label>
                                                <div class="controls">
                                                    <select name="role" id="role">
                                                        <option value="0">{lang('No group', 'user_manager')}</option>
                                                        {foreach $roles as $role}
                                                            <option value ="{$role.id}">{$role.alt_name}</option>
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
        </div>
    </section>
</div>