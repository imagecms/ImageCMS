<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки модуля кнопок соцсетей</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form"><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain"><i class="icon-edit"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>
    <div class="btn-group myTab m-t_10" data-toggle="buttons-radio">
        <a href="#likes" class="btn btn-small active">Набор сервисов</a>
        <a href="#share_buttons" class="btn btn-small">Кнопки "Мне нравится"</a>
    </div>
    <form action="{$BASE_URL}admin/components/cp/share/update_settings" id="widget_form" method="post" class="form-horizontal">
        <div class="tab-content">
            <div class="tab-pane active" id="likes">
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                        <th>{lang('a_sett')}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">Я.ру<span class="check_yandex"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1" name="ss[yaru]" {if $settings['yaru'] == '1'}checked="checked"{/if} id="yarucheck"/> 
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="symcount">Вконтакте<span class="check_vkcom"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1" name="ss[vkcom]" {if $settings['vkcom'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="newscount">Facebook<span class="check_facebook"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1" name="ss[facebook]" {if $settings['facebook'] == 1}checked="checked"{/if}/>    
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">Twitter<span class="check_twitter"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[twitter]" value="1" {if $settings['twitter'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">Одноклассники<span class="check_odnoclass"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[odnoclass]" value="1" {if $settings['odnoclass'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">МойМир<span class="check_myworld"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[myworld]" value="1" {if $settings['myworld'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">Livejournal<span class="check_lj"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[lj]" value="1" {if $settings['lj'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">Friendfeed<span class="check_ff"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[ff]" value="1" {if $settings['ff'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">Мой круг<span class="check_mc"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[mc]" value="1" {if $settings['mc'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">Google+<span class="check_gg"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[gg]" value="1" {if $settings['gg'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>            
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="maxsym">Внешний вид:</label>
                                                <div class="controls">
                                                    <select name="ss[type]">
                                                        <option value="button" {if $settings['type'] == 'button'}selected="selected"{/if}>кнопка</option>
                                                        <option value="link" {if $settings['type'] == 'link'}selected="selected"{/if}>ссылка</option>
                                                        <option value="icon" {if $settings['type'] == 'icon'}selected="selected"{/if}>иконки и меню</option>
                                                        <option value="none" {if $settings['type'] == 'none'}selected="selected"{/if}>только иконки</option>
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
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                        <th>{lang('a_sett')}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">Facebook<span class="check_facebook"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[facebook_like]" value="1" {if $settings['facebook_like'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">Вконтакте<span class="check_vkcom"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[vk_like]" value="1" {if $settings['vk_like'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">Ваш API ID<span class="check_vkcom"></span></label>
                                                <div class="controls">
                                                    <input type="text" name="ss[vk_apiid]" value="{$settings['vk_apiid']}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">Google +<span class="check_gg"></span></label>
                                                <div class="controls">
                                                    <span class="frame_label">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="ss[gg_like]" value="1" {if $settings['gg_like'] == 1}checked="checked"{/if}/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="yarucheck">Twitter<span class="check_twitter"></span></label>
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

