<form method="post" action="{site_url('admin/components/cp/social_servises/update_settings')}" id="social_servises" style="width:100%;">
    <div id="settings_tabs">
                <h4>Facebook</h4>
                <div>
               
   		<div class="form_text">Включить интеграцию с <b>facebook</b>?</div>
		<div class="form_input">
                    <input type="checkbox" name="facebook[use]" value="1"{if $settings.use == 1}checked="checked"{/if} />
                </div>
		<div class="form_overflow"></div>
                
   		<div class="form_text">secret key</div>
		<div class="form_input">
                    <input type="text" value="{echo $settings.secretkey}" name="facebook[secretkey]" class="textbox_long"/> 
                </div>
		<div class="form_overflow"></div>
                
                <div class="form_text">application number</div>
		<div class="form_input">
                    <input type="text" value="{echo $settings.appnumber}" name="facebook[appnumber]" class="textbox_long"/> 
                </div>
		<div class="form_overflow"></div>
                
                <div class="form_text">Выбор шаблона для отображения</div>
                <div class="form_input">
                <select name="facebook[template]">
                    {foreach $templates as $k => $v}
                    <option value="{$k}" {if $settings.template == $k} selected="selected" {/if}>{$k}</option>
                    {/foreach}
                </select>
                </div>
                <div class="form_overflow"></div>
                
                </div>
                    <h4>Vkontakte</h4>
                    <div>
                        <div class="form_text">Включить интеграцию с <b>vkontakte</b>?</div>
                        <div class="form_input">
                            <input type="checkbox" name="vk[use]" value="1"{if $vsettings.use == 1}checked="checked"{/if} />
                        </div>
                        <div class="form_overflow"></div>
                        <div class="form_text">application number</div>
                        <div class="form_input">
                            <input type="text" value="{echo $vsettings.appnumber}" name="vk[appnumber]" class="textbox_long"/> 
                        </div>
                        <div class="form_overflow"></div>
                        
                        <div class="form_text">protection key</div>
                        <div class="form_input">
                            <input type="text" value="{echo $vsettings.protkey}" name="vk[protkey]" class="textbox_long"/> 
                        </div>
                        <div class="form_overflow"></div>
                        
                        <div class="form_text">Выбор шаблона для отображения</div>
                        <div class="form_input">
                            <select name="vk[template]">
                                {foreach $templates as $k => $v}
                                <option value="{$k}" {if $vsettings.template == $k} selected="selected" {/if}>{$k}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="form_overflow"></div>
                        
                    </div>
                </div>
		<div style="padding:15px 55px;" class="form_input">
                    <input type="submit" name="button"  class="button_silver_130" value="Сохранить" onclick="ajax_me('social_servises');" /> 
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

