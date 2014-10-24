<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Button social networks module settings', 'share')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'share')}</span></a>
                <button type="button" class="btn btn-small formSubmit btn-primary" data-form="#widget_form"><i class="icon-ok"></i>{lang("Save", 'share')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain"><i class="icon-check"></i>{lang("Save and go back", 'share')}</button>
            </div>
        </div>                            
    </div>
    <div class="btn-group myTab m-t_10" data-toggle="buttons-radio">
        <a href="#likes" class="btn btn-small active">{lang('Share buttons', 'share')}</a>
        <a href="#share_buttons" class="btn btn-small">{lang('Buttons I like', 'share')}</a>
    </div>
    <form action="{$BASE_URL}admin/components/cp/share/update_settings" id="widget_form" method="post" class="form-horizontal">
        <div class="tab-content">
            <div class="tab-pane active" id="likes">
                <div class="row-fluid">
                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                        <th>{lang("Settings", 'share')}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">{lang('Я.ру', 'share')}<span class="check_yandex"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1" name="ss[yaru]" {if $settings['yaru'] == '1'}checked="checked"{/if} id="yarucheck"/> 
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="symcount">{lang('VK', 'share')}<span class="check_vkcom"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1" name="ss[vkcom]" {if $settings['vkcom'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="newscount">{lang('Facebook', 'share')}<span class="check_facebook"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1" name="ss[facebook]" {if $settings['facebook'] == 1}checked="checked"{/if}/>    
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">{lang('Twitter', 'share')}<span class="check_twitter"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[twitter]" value="1" {if $settings['twitter'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">{lang('Odnoklassniki', 'share')}<span class="check_odnoclass"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[odnoclass]" value="1" {if $settings['odnoclass'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">{lang('My World', 'share')}<span class="check_myworld"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[myworld]" value="1" {if $settings['myworld'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">{lang('Livejournal', 'share')}<span class="check_lj"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[lj]" value="1" {if $settings['lj'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">{lang('Friendfeed', 'share')}<span class="check_ff"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[ff]" value="1" {if $settings['ff'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">{lang('My circle', 'share')}<span class="check_mc"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[mc]" value="1" {if $settings['mc'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">{lang('Google+', 'share')}<span class="check_gg"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[gg]" value="1" {if $settings['gg'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">{lang('External view', 'share')}:</label>
                                                <div class="controls">
                                                    <select name="ss[type]">
                                                        <option value="counter" {if $settings['type'] == 'counter'}selected="selected"{/if}>{lang('counter', 'share')}</option>
                                                        <option value="button" {if $settings['type'] == 'button'}selected="selected"{/if}>{lang('button', 'share')}</option>
                                                        <option value="link" {if $settings['type'] == 'link'}selected="selected"{/if}>{lang('link', 'share')}</option>
                                                        <option value="icon" {if $settings['type'] == 'icon'}selected="selected"{/if}>{lang('icon and menu', 'share')}</option>
                                                        <option value="none" {if $settings['type'] == 'none'}selected="selected"{/if}>{lang('only icons', 'share')}</option>
                                                    </select>
                                                </div>            
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="share_buttons">
                <div class="row-fluid">
                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                        <th>{lang("Settings", 'share')}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">{lang('Facebook', 'share')}<span class="check_facebook"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[facebook_like]" value="1" {if $settings['facebook_like'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">{lang('Вконтакте', 'share')}<span class="check_vkcom"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[vk_like]" value="1" {if $settings['vk_like'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">{lang('Ваш API ID', 'share')}<span class="check_vkcom"></span></label>
                                                <div class="controls">
                                                    <input type="text" name="ss[vk_apiid]" value="{$settings['vk_apiid']}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">{lang('Google +', 'share')}<span class="check_gg"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[gg_like]" value="1" {if $settings['gg_like'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">{lang('Twitter', 'share')}<span class="check_twitter"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[twitter_like]" value="1" {if $settings['twitter_like'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
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
        </div>
    </form>
</section>
<!--                <div class="form_text">Код для вставки в шаблон:  echo $CI->load->module('share')->_make_share_form()</div>
                <div class="form_overflow"></div>-->

