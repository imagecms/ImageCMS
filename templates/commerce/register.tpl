<div id="titleExt"><h5><span class="ext">{lang('lang_register')}</span></h5></div>

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

<br/>

<form action="" class="form" method="post">

        <div class="fieldName">{lang('lang_login')}</div>
        <div class="field">      
            <input type="text" size="30" name="username" id="username" value="{set_value('username')}"/>
        </div>
        <div class="clear"></div>


        <div class="fieldName">{lang('lang_email')}</div>
        <div class="field">      
            <input type="text" size="30" name="email" id="email" value="{set_value('email')}" />
        </div>
        <div class="clear"></div>
 

        <div class="fieldName">{lang('lang_password')}</div>
        <div class="field">      
            <input type="password" size="30" name="password" id="password" value="{set_value('password')}" />
        </div>
        <div class="clear"></div>

        
        <div class="fieldName">{lang('lang_confirm_password')}</div>
        <div class="field">      
            <input type="password" class="text" size="30" name="confirm_password" id="confirm_password" />
        </div>
        <div class="clear"></div>

        {if $cap_image} 
        <div class="fieldName">{$cap_image}</div>
        {if $captcha_type == 'captcha'}
        <div class="field">
            <input type="text" name="captcha" id="captcha" />            
        </div>
        {/if}
        <div class="clear"></div>        
        {/if} 

        <div class="fieldName"></div>
        <div class="field">
            <input type="submit" id="submit" class="submit" value="{lang('lang_submit')}" />              
        </div>
        <div class="clear"></div>

        <div class="fieldName"></div>
        <div class="field">      
            <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
            &nbsp;
            <a href="{site_url('auth/login')}">Вход</a>
        </div>
        <div class="clear"></div>

{form_csrf()}
</form>

