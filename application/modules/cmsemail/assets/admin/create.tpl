<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Creating mail template', 'cmsemail')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/cmsemail/index" class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Go back', 'cmsemail')}</span>
                </a>
                <button type="button" class="btn btn-small formSubmit btn-success" data-form="#email_form" data-action="save">
                    <i class="icon-plus-sign icon-white"></i>{lang('Create', 'cmsemail')}
                </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#email_form" data-action="tomain">
                    <i class="icon-edit"></i>{lang('Create and exit', 'cmsemail')}
                </button>
            </div>
        </div>
    </div>
    <form action="{$BASE_URL}admin/components/cp/cmsemail/create" id="email_form" method="post" class="form-horizontal m-t_10">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang('Settings', 'cmsemail')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd">
                            <div class="row-fluid">
                                <div class="control-group">
                                    <label class="control-label" for="comcount">{lang('Template name (only latin)', 'cmsemail')}: <span class="must">*</span></label>
                                    <div class="controls">
                                        <input id="comcount" type="text" required class="required" name="mail_name" value=""/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="comcount2">{lang('From', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <input id="comcount2" type="text" name="sender_name" value=""/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="comcount3">{lang('From email', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <input id="comcount3" type="text" name="from_email" value=""/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="comcount4">{lang('Theme', 'cmsemail')}: <span class="must">*</span></label>
                                    <div class="controls">
                                        <input id="comcount4" type="text" required class="required" name="mail_theme" value=""/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="comcount5">{lang('Message type', 'cmsemail')}:</label>
                                    <div class="controls">
                                        &nbsp; HTML &nbsp;
                                        <span class="frame_label">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="mail_type" value="html" checked="checked" id="comcount5"/>
                                            </span>
                                        </span>
                                        &nbsp; Text &nbsp;
                                        <span class="frame_label">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="mail_type" value="text" id="comcount5"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="userMailText">{lang('Template user mail', 'cmsemail')}: <span class="must">*</span></label>
                                    <div class="controls">
                                        <textarea class="elRTE" name="userMailText" id="userMailText"></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="userMailTextRadio">{lang('Send email to user', 'cmsemail')}: </label>
                                    <div class="controls">
                                        &nbsp; {lang('Yes', 'cmsemail')} &nbsp;
                                        <span class="frame_label">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="userMailTextRadio" value="1" checked="checked" id="userMailTextRadio"/>
                                            </span>
                                        </span>
                                        &nbsp; {lang('No', 'cmsemail')} &nbsp;
                                        <span class="frame_label">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="userMailTextRadio" value="0" id="userMailTextRadio"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="adminMailText">{lang('Admin mail template', 'cmsemail')}: <span class="must">*</span></label>
                                    <div class="controls">
                                        <textarea class="elRTE" name="adminMailText" id="adminMailText"></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="adminMailTextRadio">{lang('Send email to admin', 'cmsemail')}:</label>
                                    <div class="controls">
                                        &nbsp; {lang('Yes', 'cmsemail')} &nbsp;
                                        <span class="frame_label">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="adminMailTextRadio" value="1" checked="checked" id="adminMailTextRadio"/>
                                            </span>
                                        </span>
                                        &nbsp; {lang('No', 'cmsemail')} &nbsp;
                                        <span class="frame_label">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="adminMailTextRadio" value="0" id="adminMailTextRadio"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="comcount3">{lang('Admin address', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <input id="comcount3" type="text" name="admin_email" value=""/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="symcount2">{lang('Template description', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <textarea class="elRTE" name="mail_desc" id="symcount2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {form_csrf()}
    </form>
</section>
