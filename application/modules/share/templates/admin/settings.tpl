<form method="post" action="{site_url('admin/components/cp/share/update_settings')}" id="soc_serv" style="width:100%;">
    <div id="settings_tabs">
                <h4>Набор сервисов</h4>
                <div>
<!--                <div class="form_text">Код для вставки в шаблон:  echo $CI->load->module('share')->_make_share_form()</div>
                <div class="form_overflow"></div>-->
                
   		<div class="form_text">Я.ру<span class="check_yandex"></span></div>
		<div class="form_input">
                    <input type="checkbox" value="1" name="ss[yar]u" {if $settings.yar == 1}checked="checked"{/if}/> 
                </div>
		<div class="form_overflow"></div>

   		<div class="form_text">Вконтакте<span class="check_vkcom"></span></div>
		<div class="form_input">
                    <input type="checkbox" value="1" name="ss[vkcom]" {if $settings.vkcom == 1}checked="checked"{/if}/>
                </div>
		<div class="form_overflow"></div>

                <div class="form_text">Facebook<span class="check_facebook"></span></div>
		<div class="form_input">
                    <input type="checkbox" value="1" name="ss[facebook]" {if $settings.facebook == 1}checked="checked"{/if}/>    
                </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Twitter<span class="check_twitter"></span></div>
		<div class="form_input">
                    <input type="checkbox" name="ss[twitter]" value="1" {if $settings.twitter == 1}checked="checked"{/if}/>
                </div>
		<div class="form_overflow"></div>

                <div class="form_text">Одноклассники<span class="check_odnoclass"></span></div>
		<div class="form_input">
                    <input type="checkbox" name="ss[ondoclass]" value="1" {if $settings.odnoclass == 1}checked="checked"{/if}/>
                </div>
		<div class="form_overflow"></div>

                <div class="form_text">МойМир<span class="check_myworld"></span></div>
		<div class="form_input">
                    <input type="checkbox" name="ss[myworld]" value="1" {if $settings.myworld == 1}checked="checked"{/if}/>
                </div>
		<div class="form_overflow"></div>

   		<div class="form_text">Livejournal<span class="check_lj"></span></div>
		<div class="form_input">
                    <input type="checkbox" name="ss[lj]" value="1" {if $settings.lj == 1}checked="checked"{/if}/>
                </div>
		<div class="form_overflow"></div>

   		<div class="form_text">Friendfeed<span class="check_ff"></span></div>
		<div class="form_input">
                    <input type="checkbox" name="ss[ff]" value="1" {if $settings.ff == 1}checked="checked"{/if}/>
                </div>
		<div class="form_overflow"></div> 
                
                <div class="form_text">Мой круг<span class="check_mc"></span></div>
		<div class="form_input">
                    <input type="checkbox" name="ss[mc]" value="1" {if $settings.mc == 1}checked="checked"{/if}/>
                </div>
		<div class="form_overflow"></div>
                
                <div class="form_text">Google+<span class="check_gg"></span></div>
		<div class="form_input">
                    <input type="checkbox" name="ss[gg]" value="1" {if $settings.gg == 1}checked="checked"{/if}/>
                </div>
		<div class="form_overflow"></div>
                
                <div class="form_text">Внешний вид</div>
		<div class="form_input">
                    <select name="ss[type]">
                        <option value="button" {if $settings.type == 'button'}selected="selected"{/if}>кнопка</option>
                        <option value="link" {if $settings.type == 'link'}selected="selected"{/if}>ссылка</option>
                        <option value="icon" {if $settings.type == 'icon'}selected="selected"{/if}>иконки и меню</option>
                        <option value="none" {if $settings.type == 'none'}selected="selected"{/if}>только иконки</option>
                    </select>
                    
                </div>
		<div class="form_overflow"></div>
   		
                </div>
                    <h4>Кнопки "Мне нравится"</h4>
                    <div>
                        <div class="form_text">Facebook<span class="check_facebook"></span></div>
                        <div class="form_input">
                            <input type="checkbox" name="ss[facebook_like]" value="1" {if $settings.facebook_like == 1}checked="checked"{/if}/>
                        </div>
                        <div class="form_overflow"></div>
                        
                        <div class="form_text">Вконтакте<span class="check_vkcom"></span></div>
                        <div class="form_input">
                            <input type="checkbox" name="ss[vk_like]" value="1" {if $settings.vk_like == 1}checked="checked"{/if}/>
                        </div>
                        <div class="form_overflow"></div>
                        
                        <div class="form_text">Ваш API ID<span class="check_vkcom"></span></div>
                        <div class="form_input">
                            <input type="text" name="ss[vk_apiid]" value="{$settings.vk_apiid}" class="textbox_short"/>
                        </div>
                        <div class="form_overflow"></div>
                        
                        <div class="form_text">Google +<span class="check_gg"></span></div>
                        <div class="form_input">
                            <input type="checkbox" name="ss[gg_like]" value="1" {if $settings.gg_like == 1}checked="checked"{/if}/>
                        </div>
                        <div class="form_overflow"></div>
                        
                        <div class="form_text">Twitter<span class="check_twitter"></span></div>
                        <div class="form_input">
                            <input type="checkbox" name="ss[twitter_like]" value="1" {if $settings.twitter_like == 1}checked="checked"{/if}/>
                        </div>
                        <div class="form_overflow"></div>
                        
                    </div>
                </div>
		<div style="padding:15px 55px;" class="form_input">
                    <input type="submit" name="button"  class="button_silver_130" value="Сохранить" onclick="ajax_me('soc_serv');" /> 
                </div>
		<div class="form_overflow"></div> 
{form_csrf()}</form>

{literal}
<script type="text/javascript">
		var settings_tabs = new SimpleTabs('settings_tabs', {
		selector: 'h4'
		});
</script>
{/literal}

