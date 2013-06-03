<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_editing_user_ba_s')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$SELF_URL}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>                   
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#update" data-action="close" data-submit><i class="icon-ok icon-white"></i>{lang('amt_save')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#update" data-action="exit"><i class="icon-check"></i>{lang('a_save_and_exit')}</button>
                </div>
            </div>                            
        </div>
        <div class="tab-pane">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang('a_data_user_mod')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span9">
                                <div class="form-horizontal">
                                    <form id="update" method="post" action="{$SELF_URL}/update_user/{$id}">


                                        <div class="control-group">
                                            <label class="control-label" for="email">{lang('amt_email')}</label>
                                            <div class="controls">
                                                <input type="text" name="email" id="email" value="{$email}" class="required email"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="username">{lang('a_fio')}</label>
                                            <div class="controls">
                                                <input type="text" name="username" id="email" value="{$username}"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="phone">{lang('a_phone')}</label>
                                            <div class="controls">
                                                <input type="text" name="phone" id="phone" value="{$phone}" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="role_id">{lang('amt_group')}</label>
                                            <div class="controls">
                                                <select name="role_id" id="role_id">
                                                    <option value ="0">Без групы</option>
                                                    {foreach $roles as $role}
                                                        <option value ="{$role.id}" {if $role_id == $role.id}selected="selected"{/if}>{$role.alt_name}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="new_pass">{lang('amt_new_pass')}</label>
                                            <div class="controls">
                                                <input type="password" name="new_pass" id="new_pass" value=""/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="new_pass_conf">{lang('amt_new_pass_confirm')}</label>
                                            <div class="controls">
                                                <input type="password" name="new_pass_conf" id="new_pass_conf" value=""/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="banned">{lang('amt_ban')}</label>
                                            <div class="controls">
                                                <select name="banned" id="banned">
                                                    <option value ="0" selected="selected" >{lang('amt_no')}</option>
                                                    <option value ="1" {if $banned == "1"} selected="selected" {/if}>{lang('amt_yes')}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="ban_reason">{lang('amt_ban_reason')}</label>
                                            <div class="controls">
                                                <input type="text" name="ban_reason" id="ban_reason" value="{$ban_reason}"/>
                                            </div>
                                        </div>                                                
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </section>
</div>