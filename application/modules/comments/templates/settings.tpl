<!--<ul class="breadcrumb">
    <li><a href="#">Главная</a> <span class="divider">/</span></li>
    <li class="active">Список товаров</li>
</ul>-->
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_comment_settings')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/comments" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#comment_settings_form" data-action="tomain"><i class="icon-ok"></i>{lang('a_saves')}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
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
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group m-t_10">
                                                <label class="control-label">{lang('amt_max_comment_length')}:</label>
                                                <div class="controls">
                                                    <input type="text" value="{$settings.max_comment_length}" name="max_comment_length"/> 
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">{lang('amt_restrictions')}:</label>
                                                <div class="controls">
                                                    <input type="text" value="{$settings.period}" name="period"/>
                                                    <span class="help-inline">{lang('amt_restrictions_frequency')}</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" >{lang('amt_disallove_comments_for_unregistered')}</label>
                                                <div class="controls">
                                                    <input type="checkbox" name="can_comment" value="1"  {if $settings.can_comment == 1}checked="checked"{/if} />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">{lang('amt_admin_approve_on')}</label>
                                                <div class="controls" >
                                                    <input type="checkbox" name="use_moderation" value="1" {if $settings.use_moderation}checked="checked"{/if} />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">{lang('amt_use_captcha')}</label>
                                                <div class="controls" >
                                                    <input type="checkbox" name="use_captcha" value="1" {if $settings.use_captcha}checked="checked"{/if} />
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
            </div>
        </div>
        <div class="tab-pane"></div>
    </div>
</section>
