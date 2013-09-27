<div class="container">
    <div class="content center">
        <div id="titleExt"><h5>{widget('path')}<span class="ext">{lang('Contacts', 'feedback')}</span></h5></div>
        <div id="contact">
            <div class="left">
                {if $form_errors}
                    <div class="errors">
                        {$form_errors}
                    </div>
                {/if}

                {if $message_sent}
                    <div style="color: green;">
                        {lang('Your message has been sent.', 'feedback')}
                    </div>
                {/if}

                <form action="{site_url('feedback')}" method="post">
                    <div class="textbox" style="margin-top: 15px;">
                        <label for="name">{lang('Your name', 'feedback')}</label>
                        <input type="text" id="name" name="name" class="text" value="{if $_POST.name}{$_POST.name}{/if}"
                               placeholder="{lang('Your name', 'feedback')}"/>
                    </div>

                    <div class="textbox" style="margin-top: 15px;">
                        <label for="email">{lang('Email')}</label>
                        <input type="text" id="email" name="email" class="text" value="{if $_POST.email}{$_POST.email}{/if}" placeholder="{lang('Email')}"/>
                    </div>

                    <label for="theme">{lang('Subject', 'feedback')}</label>
                    <input type="text" id="theme" name="theme" class="text" value="{if $_POST.theme}{$_POST.theme}{/if}" placeholder="{lang('Subject', 'feedback')}"/>
            </div>
            <label for="theme">{lang('Message', 'feedback')}</label>
            <div class="textbox" style="margin-top: 15px;">
                <textarea cols="45" rows="10" name="message" id="message" placeholder="{lang('Message text', 'feedback')}">{if $_POST.message}{$_POST.message}{/if}</textarea>

            </div>

            <div style="margin-top: 15px;">
                {$cap_image}
            </div>
            <div class="comment_form_info">
                {if $captcha_type =='captcha'}
                    <div class="textbox captcha" style="margin-top: 15px;">
                        <label for="captcha">{lang('Protection code', 'feedback')}</label>
                        <input type="text" name="captcha" id="recaptcha_response_field" value="" placeholder="{lang('Protection code', 'feedback')}"/>
                    </div>
                {/if}
            </div>


            <div style="margin-top: 15px;">
                <input type="submit" id="submit" class="submit" value="{lang('Send', 'feedback')}" />
            </div>
            {form_csrf()}
            </form>
        </div>
        <div class="right">
            <div id="detail">
                {//widget('contacts')}
            </div>
        </div>
    </div>
</div>
</div>