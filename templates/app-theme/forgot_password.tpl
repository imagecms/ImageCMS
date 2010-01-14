<div id="box">
  <div class="block" id="block-login">
    <h2>{lang('lang_forgot_password')}</h2>        

    <div class="login" style="padding:20px;"> 

    {if $info_message}
    <div class="flash">
        <div class="message notice">
            <p>{$info_message}</p>
        </div>
    </div>
    {/if}

      <form action="" class="form login" method="post">
        <div class="group">
          <div class="left">
            <label class="label right">{lang('lang_username_or_mail')}</label>
          </div>
          <div class="right">
            <input type="text" class="text_field" size="30" name="login" />
             {form_error('username','<span class="form_error">','</span>')} 
          </div>              
          <div class="clear"></div>
        </div>

        <div class="group navform">
          <div class="right">
            <input type="submit" class="button" value="{lang('lang_submit')}" />
          </div>
          <div class="clear"></div>
        </div>            
      {form_csrf()}</form>

        <div align="center">
            <a href="{site_url($modules.auth . '/login')}">{lang('lang_login_page')}</a>
            &nbsp;
            <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>
        </div>

      </div>
    </div>
</div>
<p>&nbsp;</p>
