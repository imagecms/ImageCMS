<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Comment settings", 'comments')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/comments" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'comments')}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#comment_settings_form" data-action="tomain" data-submit><i class="icon-ok"></i>{lang("Save", 'comments')}</button>
            </div>
        </div>                            
    </div>
    <form method="post" action="{site_url('admin/components/cp/comments/update_settings')}" class="form-horizontal m-t_10" id="comment_settings_form">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang("Properties", 'comments')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="control-group m-t_10">
                                <label class="control-label" for="max_comment_length">{lang("Maximum comment length", 'comments')}:</label>
                                <div class="controls number">
                                    <input type="text" value="{$settings.max_comment_length}" name="max_comment_length" id="max_comment_length"/>
                                     <span class="help-block">{lang("O - unlimited comment length", 'comments')}</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="period">{lang("Comment restrictions", 'comments')}:</label>
                                <div class="controls number">
                                    <input type="text" value="{$settings.period}" name="period" id="period"/>
                                    <span class="help-block">{lang("Comment frequency restriction per minute . O - check off", 'comments')}</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label" ></div>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck">
                                            <input type="checkbox" name="can_comment" value="1"  {if $settings.can_comment == 1}checked="checked"{/if} />
                                        </span>
                                        {lang("Forbid comments for unregistered users", 'comments')}
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
                                        {lang("Enable administrator comments approval", 'comments')}
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
                                        {lang("Use the protection code", 'comments')}
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
