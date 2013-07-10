<div class="grid_5">
    <h2>Our Address
        <span>port galeleu misleui ster</span>
    </h2>
    <div class="map">
        <figure class="img_inner">
            <iframe src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Brooklyn,+New+York,+NY,+United+States&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=61.282355,146.513672&amp;ie=UTF8&amp;hq=&amp;hnear=Brooklyn,+Kings,+New+York&amp;ll=40.649974,-73.950005&amp;spn=0.01628,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
        </figure>
        <div class="clear"></div>
        <div class="indents9">
            <address>
                <dl>
                    <dt>
                    8901 Marmora Road,<br>
                    Glasgow, D04 89GR. </dt>
                    <dd><span>Freephone:</span> +1 800 559 6580</dd>
                    <dd><span>Telephone:</span> +1 800 603 6035</dd>
                    <dd><span>FAX:</span> +1 800 889 9898<br>
                        E-mail: <a href="#" class="link-1">mail@demolink.org</a></dd>
                </dl>
            </address>
        </div>	
    </div>
</div>
<div class="grid_11">
    <h2>Контакты
        <span>контактная информация нашей компании для быстрой связи</span>
    </h2>
        {if $form_errors}
            <div class="success">{$form_errors}</div>
        {/if}
        {if $message_sent}
            <div class="success">Ваше сообщение отправлено!<br>
            </div>
        {/if}
    <form id="form" action="{site_url('feedback')}" method="post">
        <fieldset>
            <label class="name">
                <input type="text" name="name" value="{if $_POST.name}{$_POST.name}{/if}" placeholder="Ваше Имя"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильное имя.</span><span class="empty error-empty">*Это поле объязательно для заполнения.</span> </label>
            <label class="email">
                <input type="text" id="email" name="email" class="text" value="{if $_POST.email}{$_POST.email}{/if}" placeholder="Email"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильный email адрес.</span><span class="empty error-empty">*Это поле объязательно.</span> </label>
            <label class="name">
                <input type="text" name="theme" value="{if $_POST.theme}{$_POST.theme}{/if}" placeholder="Тема"/>
                <br class="clear">
                <span class="error error-empty">*Вы ввели неправильную тему.</span><span class="empty error-empty">*Это поле объязательно для заполнения.</span> </label>
            <label class="message">
                <textarea name="message" id="message" placeholder="Текст Сообщения">{if $_POST.message}{$_POST.message}{/if}</textarea>
                <br class="clear">
                <span class="error">*Сообщение слишком короткое.</span> <span class="empty">*Это поле объязательно.</span> </label>
            <div class="clear"></div>

            {if $captcha_type =='captcha'}    
                <div class="textbox captcha" style="margin-top: 15px;">
                    {$cap_image}
                    <input type="text" name="captcha" id="recaptcha_response_field" value="" placeholder="Код протекции"/>
                </div>
            {/if}
            <br class="clear">
            <div class="btns">
                <a data-type="reset" class="btn">очистить</a>
                <a data-type="submit" class="btn" onclick="document.getElementById('form').submit()"> {lang('lang_comment_button')} </a>
                {form_csrf()}
            </div>
        </fieldset>
    </form>
</div>