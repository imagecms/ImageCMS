{if $useGoogle == 'on'}
    <a href="https://accounts.google.com/o/oauth2/auth?redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/google&response_type=code&client_id={echo $googleClientID}&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile" 
       title="Google">
        <img src="/application/modules/socauth/assets/images/g.png"/>
    </a>
{/if}

{if $useVk == 'on'}
    <a href="http://oauth.vk.com/authorize?client_id={$vkClientID}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/vk&response_type=code&scope=PERMISSIONS&display=popup" 
       title="{lang('VK', 'socauth')}">
        <img src="/application/modules/socauth/assets/images/vk.png"/>
    </a>
{/if}

{if $useFaceBook == 'on'}
    <a href="https://www.facebook.com/dialog/oauth?client_id={$facebookClientID}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/facebook&response_type=code&scope=email" 
       title="FaceBook">
        <img src="/application/modules/socauth/assets/images/fb.png"/>
    </a>
{/if}

{if $useYandex == 'on'}
    <a href="https://oauth.yandex.ru/authorize?response_type=code&client_id={$yandexClientID}&display=popup" 
       title="{lang('Yandex', 'socauth')}">
        <img src="/application/modules/socauth/assets/images/ya.png"/>
    </a>
{/if}