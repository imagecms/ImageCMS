{if $useGoogle == 'on' && $google != 'linked'}
    {if $google != 'main'}
        <a href="https://accounts.google.com/o/oauth2/auth?redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/google&response_type=code&client_id={echo $googleClientID}&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile" 
           title="Google">
            <img src="/application/modules/socauth/assets/images/g.png"/>
        </a>
    {/if}
{elseif $useGoogle == 'on'}
    <img src="/application/modules/socauth/assets/images/g.png" 
         onclick="unlinkSocial('google')"
         style="opacity: 0.3;"
         title="{lang('Unsubscribe', 'socauth')}"/>
{/if}

{if $useVk == 'on' && $vk != 'linked'}
    {if $vk != 'main'}
        <a href="http://oauth.vk.com/authorize?client_id={$vkClientID}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/vk&response_type=code&scope=PERMISSIONS&display=popup" 
           title="{lang('VK', 'socauth')}">
            <img src="/application/modules/socauth/assets/images/vk.png"/>
        </a>
    {/if}
{elseif $useVk == 'on'}
    <img src="/application/modules/socauth/assets/images/vk.png" 
         onclick="unlinkSocial('vk')"
         style="opacity: 0.3;"
         title="{lang('Unsubscribe', 'socauth')}"/>
{/if}

{if $useFaceBook == 'on' && $fb != 'linked'}
    {if $fb != 'main'}
        <a href="https://www.facebook.com/dialog/oauth?client_id={$facebookClientID}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/facebook&response_type=code&scope=email" 
           title="FaceBook">
            <img src="/application/modules/socauth/assets/images/fb.png"/>
        </a>
    {/if}
{elseif $useFaceBook == 'on'}
    <img src="/application/modules/socauth/assets/images/fb.png" 
         onclick="unlinkSocial('fb')"
         style="opacity: 0.3;"
         title="{lang('Unsubscribe', 'socauth')}"/>
{/if}

{if $useYandex == 'on' && $ya != 'linked'}
    {if $ya != 'main'}
        <a href="https://oauth.yandex.ru/authorize?response_type=code&client_id={$yandexClientID}&display=popup" 
           title="{lang('Yandex', 'socauth')}">
            <img src="/application/modules/socauth/assets/images/ya.png"/>
        </a>
    {/if}
{elseif $useYandex == 'on'}
    <img src="/application/modules/socauth/assets/images/ya.png" 
         onclick="unlinkSocial('ya')"
         style="opacity: 0.3;"
         title="{lang('Unsubscribe', 'socauth')}"/>
{/if}