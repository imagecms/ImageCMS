<div class="container">
    <div class="content center">
        <div id="titleExt"><h5>{widget('path')}<span class="ext">{lang('Contacts')}</span></h5></div>
        <div id="contact">
            <div class="left">

                {if $form_errors}
                    <div class="errors">
                        {$form_errors}
                    </div>
                {/if}

                {if $message_sent}
                    <div style="color: green;">
                          {lang('Your message has been sent.')}
                    </div>
                {/if}

                <form action="{site_url('feedback')}" method="post">
                    <div class="textbox" style="margin-top: 15px;">
                        <input type="text" id="name" name="name" class="text" value="{if $_POST.name}{$_POST.name}{/if}"
                               placeholder="{lang('Your name')}"/>
                    </div>

                    <div class="textbox" style="margin-top: 15px;">
                        <input type="text" id="email" name="email" class="text" value="{if $_POST.email}{$_POST.email}{/if}" placeholder="Email"/>
                    </div>

                    <div class="textbox" style="margin-top: 15px;">
                        <input type="text" id="theme" name="theme" class="text" value="{if $_POST.theme}{$_POST.theme}{/if}" placeholder="Тема"/>
                    </div>

                    <div class="textbox" style="margin-top: 15px;">
                        <textarea cols="45" rows="10" name="message" id="message" placeholder="Текст Сообщения">{if $_POST.message}{$_POST.message}{/if}</textarea>
                    </div>

                    <div style="margin-top: 15px;">
                        {$cap_image}
                    </div>
                    <div class="comment_form_info">
                        {if $captcha_type =='captcha'}
                            <div class="textbox captcha" style="margin-top: 15px;">
                                <input type="text" name="captcha" id="recaptcha_response_field" value="" placeholder="{lang('Protection code')}"/>
                            </div>
                        {/if}
                    </div>


                    <div style="margin-top: 15px;">
                        <input type="submit" class="submit" value="{lang('Comment')}" />
                    </div>
                    {form_csrf()}
                </form>
            </div>
            <div class="right">
                <div id="detail">
                    <!--<h2 id="title">Контакты</h2>-->
                    {//widget('contacts')}
                </div>
            </div>
        </div>
    </div>
</div>