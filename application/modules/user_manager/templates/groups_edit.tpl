<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Editing Groups", 'user_manager')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$SELF_URL}#group" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Return', 'user_manager')}</span></a>
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#update" data-action="close" data-submit><i class="icon-ok icon-white"></i>{lang('Save', 'user_manager')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#update" data-action="exit"><i class="icon-check"></i>{lang('Save and exit', 'user_manager')}</button>
                </div>
            </div>                            
        </div>
        <div class="tab-pane">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang("Group data", 'user_manager')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <form id="update" method="post" action="{$BASE_URL}admin/components/cp/user_manager/save/{$id}">
                                        <div class="control-group">
                                            <label class="control-label" for="username">{lang('Name', 'user_manager')}</label>
                                            <div class="controls">
                                                <input type="text" name="alt_name" id="alt_name" value="{$alt_name}" required/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="email">{lang('Identifier', 'user_manager')}</label>
                                            <div class="controls">
                                                <input type="text" name="name" value="{$name}" id="name" required/>
                                                <span class="help-block">{lang('Identifier', 'user_manager')}</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="role_id">{lang('Description', 'user_manager')}</label>
                                            <div class="controls">
                                                <textarea id="desc" name="desc" class="textearea">{$desc}</textarea>
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