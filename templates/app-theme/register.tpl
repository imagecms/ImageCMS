<div id="box">
  <div class="block" id="block-login">
    <h2>{lang('lang_register')}</h2>        

    <div class="login" style="padding:20px;"> 

    {if $info_message}
    <div class="flash">
        <div class="message error">
            <p>{$info_message}</p>
        </div>
    </div>
    {/if}

    <!--
    {if validation_errors()}
    <div class="flash">
        <div class="message error">
            <p>{validation_errors()}</p>
        </div>
    </div>
    {/if}
    -->

      <form action="" class="form login" method="post">

        <div class="group">
          <div class="left">
            <label class="label right">{lang('lang_login')}</label>
          </div>
          <div class="right">
            <input type="text" class="text_field" size="30" name="username" />
             {form_error('username','<span class="form_error">','</span>')} 
          </div>              
          <div class="clear"></div>
        </div>

        <div class="group">
          <div class="left">
            <label class="label right">{lang('lang_email')}</label>
          </div>
          <div class="right">
            <input type="text" class="text_field" size="30" name="email" />
             {form_error('email','<span class="form_error">','</span>')} 
          </div>              
          <div class="clear"></div>
        </div>

        <div class="group">
          <div class="left">
            <label class="label right">{lang('lang_password')}</label>
          </div>
          <div class="right">
            <input type="text" class="text_field" size="30" name="password" />
             {form_error('password','<span class="form_error">','</span>')} 
          </div>              
          <div class="clear"></div>
        </div>

        <div class="group">
          <div class="left">
            <label class="label right">{lang('lang_confirm_password')}</label>
          </div>
          <div class="right">
            <input type="text" class="text_field" size="30" name="confirm_password" />
             {form_error('confirm_password','<span class="form_error">','</span>')} 
          </div>              
          <div class="clear"></div>
        </div>

       {if $cap_image}
        <div class="group">
          <div class="left">
            <label class="label right">{lang('lang_captcha')}</label>
          </div>
          <div class="right">
                {$cap_image}
               <input type="text" class="text_field" size="30" name="captcha" /> 
               {form_error('captcha','<span class="form_error">','</span>')} 
          </div>              
          <div class="clear"></div>
        </div>
        {/if}

        <div class="group navform">
          <div class="right">
            <input type="submit" class="button" value="{lang('lang_submit')}" />
          </div>
          <div class="clear"></div>
        </div>            
      {form_csrf()}</form>

        <div align="center">
            <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
            &nbsp;
            <a href="{site_url($modules.auth . '/login')}">{lang('lang_login_page')}</a>
        </div>

      </div>
    </div>
</div>
<p>&nbsp;</p>
