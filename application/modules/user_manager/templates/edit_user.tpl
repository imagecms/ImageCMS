<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Editing by")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$SELF_URL}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Return')}</span></a>                   
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#update" data-action="close" data-submit><i class="icon-ok icon-white"></i>{lang('Save')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#update" data-action="exit"><i class="icon-check"></i>{lang('Save and exit')}</button>
                </div>
            </div>                            
        </div>
        <div class="tab-pane">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th colspan="6">
                          {lang("User data")}
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
                                            <label class="control-label" for="email">{lang("E-Mail")}</label>
                                            <div class="controls">
                                                <input type="text" name="email" id="email" value="{$email}" class="required email"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="username">{lang("Full name")}</label>
                                            <div class="controls">
                                                <input type="text" name="username" id="email" value="{$username}"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="phone">{lang('Phone')}</label>
                                            <div class="controls">
                                                <input type="text" name="phone" id="phone" value="{$phone}" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="role_id">{lang('Group')}</label>
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
                                            <label class="control-label" for="new_pass">{lang('New password')}</label>
                                            <div class="controls">
                                                <input type="password" name="new_pass" id="new_pass" value=""/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="new_pass_conf">{lang('New password confirmation')}</label>
                                            <div class="controls">
                                                <input type="password" name="new_pass_conf" id="new_pass_conf" value=""/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="banned">{lang('Ban')}</label>
                                            <div class="controls">
                                                <select name="banned" id="banned">
                                                    <option value ="0" selected="selected" >{lang('No')}</option>
                                                    <option value ="1" {if $banned == "1"} selected="selected" {/if}>{lang('Yes')}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="ban_reason">{lang('Ban Reason')}</label>
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