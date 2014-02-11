<div class="wrap">
    <div class="sidebar">
        {include_tpl('../sidebars/sidebar_menu')}
    </div>
    <div class="content">
        <div class="content_bottom">
            <h2>{lang('Contact Us', 'houseFraming')}</h2>
            <div class="contact-form">
                <form method="post" action="{site_url('feedback')}">
                    {if $form_errors}<div class="errors">{$form_errors}</div>{/if}
                    {if $message_sent}
                        <div style="color: green;">{lang('Your message has been sent.', 'feedback')}</div>
                    {else:}
                        <div>
                            <span><label>{lang('Name', 'houseFraming')}</label></span>
                            <span><input name="name" type="text" class="textbox" value="{if $_POST.name}{$_POST.name}{/if}"></span>
                        </div>
                        <div>
                            <span><label>{lang('E-mail', 'houseFraming')}</label></span>
                            <span><input name="email" type="text" class="textbox" value="{if $_POST.email}{$_POST.email}{/if}"></span>
                        </div>
                        <div>
                            <span><label>{lang('Subject', 'houseFraming')}</label></span>
                            <span><textarea name="message">{if $_POST.message}{$_POST.message}{/if}</textarea></span>
                        </div>
                        {if $captcha_type =='captcha'}
                            <div>
                                <span><label>{lang('Protection code', 'houseFraming')}</label></span>
                                <span><input type="text" name="captcha" style="width: 150px" value=""/> {$cap_image}</span>
                            </div>
                        {/if}
                        <div>
                            <span><input type="submit" class="submit_button" value="{lang('Send', 'houseFraming')}"></span>
                        </div>
                        <input type="hidden" name="theme" value="First Theme" />
                        {form_csrf()}
                    {/if}
                </form>
            </div>
            <div class="contact_info">
                <h2>{lang('Find Us Here', 'houseFraming')}</h2>
                <div class="map">
                    {siteinfo('Googlemap')}
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar">
        {include_tpl('../sidebars/sidebar_form')}
    </div>
    <div class="clear"></div>
</div>