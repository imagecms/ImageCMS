<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_sim_settings')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#social_servises" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
            </div>
        </div>                            
    </div>
    <div class="btn-group myTab m-t_10" data-toggle="buttons-radio">
        <a href="#Facebook" class="btn btn-small active" >Facebook</a>
        <a href="#VK" class="btn btn-small" >VKontakte</a>
    </div>        
    <form method="post" action="/admin/components/cp/social_servises/update_settings" class="form-horizontal" id="social_servises">
        <div class="tab-content">
            <div class="tab-pane active" id="Facebook">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                Facebook
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="control-group">
                                        <div class="control-label"></div>
                                        <div class="controls">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" name="facebook[use]" value="1" {if $settings.use == 1}checked="checked"{/if} id="foncheck" />
                                                </span>
                                                {lang('a_facebook_on')}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="secretkey">{lang('a_secret_key')}:</label>
                                        <div class="controls">
                                            <input type="text" value="{echo $settings.secretkey}" name="facebook[secretkey]" id="secretkey"/> 
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="appnumber">{lang('a_application_number')}:</label>
                                        <div class="controls">
                                            <input type="text" value="{echo $settings.appnumber}" name="facebook[appnumber]" id="appnumber"/> 
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="seltpl">{lang('a_select_template')}:</label>
                                        <div class="controls">
                                            <select name="facebook[template]" id="seltpl">
                                                {foreach $templates as $k => $v}
                                                <option value="{$k}" {if $settings.template == $k} selected="selected" {/if}>{$k}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="VK">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                Vkontakte
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="control-group">
                                        <div class="control-label"></div>
                                        <div class="controls">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" name="vk[use]" value="1"{if $vsettings.use == 1}checked="checked"{/if} id="foncheck" />
                                                </span>
                                                {lang('a_vk_on')}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="protkey">{lang('a_protection_key')}:</label>
                                        <div class="controls">
                                            <input type="text" value="{echo $vsettings.protkey}" name="vk[protkey]" id="protkey"/> 
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="vappnumber">{lang('a_application_number')}:</label>
                                        <div class="controls">
                                            <input type="text" value="{echo $vsettings.appnumber}" name="vk[appnumber]" id="vappnumber"/> 
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="vseltpl">{lang('a_select_template')}:</label>
                                        <div class="controls">
                                            <select name="vk[template]" id="vseltpl">
                                                {foreach $templates as $k => $v}
                                                <option value="{$k}" {if $vsettings.template == $k} selected="selected" {/if}>{$k}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {form_csrf()}
    </form>
</section>