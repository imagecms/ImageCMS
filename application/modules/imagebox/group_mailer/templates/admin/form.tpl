<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Email mailing", 'group_mailer')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table/" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('back', 'group_mailer')}</span></a>
                <button type="button" class="btn btn-small formSubmit" data-form="#send" ><i class="icon-list-alt"></i>{lang("Send a letter", 'group_mailer')}</button>                   
            </div>
        </div>                            
    </div>               
    <div class="tab-content">
        <!-----------------------------------------------------SETTINGS MAIL-------------------------------------------------------------->
        <div class="tab-pane active" id="mail">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang("Properties", 'group_mailer')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <form id="send" method="post" action="{$BASE_URL}admin/components/cp/group_mailer/send_email">
                                        <div class="control-group">
                                            <label class="control-label" for="subject">{lang("Theme", 'group_mailer')}:
                                                <span class="must">*</span>
                                            </label>
                                            <div class="controls">
                                                <input type="text" name="subject" required="required" class="required" id="subject" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="name">{lang("Your name", 'group_mailer')}:
                                                <span class="must">*</span>
                                            </label>
                                            <div class="controls">
                                                <input type="text" name="name" required="required" class="required" id="name" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="email">{lang("Your e-mail", 'group_mailer')}:
                                                <span class="must">*</span>
                                            </label>
                                            <div class="controls">
                                                <input type="text" id="email" required="required" class="required" name="email" value="{$admin_mail}"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="message">{lang("Message", 'group_mailer')}:
                                                <span class="must">*</span>
                                            </label>
                                            <div class="controls">
                                                <textarea name="message" id="message" class="elRTE required" required="required">{lang("Hello", 'group_mailer')}, %username%.
--------------------------------
                                                    {lang("best regards, administration", 'group_mailer')} {$site_settings.site_title}

                                                    {site_url()}

                                                </textarea> 
                                            </div>
                                        </div>

                                        <div class="span9">
                                            <div class="control-group">
                                                <div class="control-label">{lang("Send to groups", 'group_mailer')}:</div>
                                                <div class="controls">
                                                    {foreach $roles as $role}
                                                        <div class="frame_label m-b_15 d_b no_connection">
                                                            <span class="niceCheck">
                                                                <input type="checkbox" name="roles[]" value="{$role.id}" />
                                                            </span>
                                                            {$role.alt_name}
                                                        </div>
                                                    {/foreach}
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="mailtype">{lang("Formatting", 'group_mailer')}:</label>
                                                <div class="controls">
                                                    <select name="mailtype" id="mailtype">
                                                        <option value="html" selected="selected">{lang("HTML", 'group_mailer')}</option>
                                                        <option value="text">{lang("Plain Text", 'group_mailer')}</option>
                                                    </select>
                                                </div>
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