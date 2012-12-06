<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_comment_settings')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/comments" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#comment_settings_form" data-action="tomain" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
            </div>
        </div>                            
    </div>
    <form method="post" action="{site_url('admin/components/cp/comments/update_settings')}" class="form-horizontal" id="comment_settings_form">
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
                        <div class="inside_padd span9">
                            <div class="control-group m-t_10">
                                <label class="control-label" for="max_comment_length">{lang('amt_max_comment_length')}:</label>
                                <div class="controls">
                                    <input type="text" value="{$settings.max_comment_length}" name="max_comment_length" id="max_comment_length"/> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="period">{lang('amt_restrictions')}:</label>
                                <div class="controls">
                                    <input type="text" value="{$settings.period}" name="period" id="period"/>
                                    <span class="help-block">{lang('amt_restrictions_frequency')}</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label" ></div>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck">
                                            <input type="checkbox" name="can_comment" value="1"  {if $settings.can_comment == 1}checked="checked"{/if} />
                                        </span>
                                        {lang('amt_disallove_comments_for_unregistered')}
                                    </span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"></div>
                                <div class="controls" >
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck">
                                            <input type="checkbox" name="use_moderation" value="1" {if $settings.use_moderation}checked="checked"{/if} />
                                        </span>
                                        {lang('amt_admin_approve_on')}
                                    </span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"></div>
                                <div class="controls" >
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck">
                                            <input type="checkbox" name="use_captcha" value="1" {if $settings.use_captcha}checked="checked"{/if} />
                                        </span>
                                        {lang('amt_use_captcha')}
                                    </span>
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
