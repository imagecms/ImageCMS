
{if $useGoogle == 'on'}
    <a href="https://accounts.google.com/o/oauth2/auth?redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/google&response_type=code&client_id={echo $googleClientID}&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile" 
       title="Google">
        Войти через Google
    </a><br>
{/if}

{if $useVk == 'on'}
    <a href="http://oauth.vk.com/authorize?client_id={$vkClientID}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/vk&response_type=code&scope=PERMISSIONS" 
       title="ВКонтакте">
        Зайти через ВКонтакте
    </a><br>
{/if}

{if $useFaceBook == 'on'}
    <a href="https://www.facebook.com/dialog/oauth?client_id={$facebookClientID}&redirect_uri=http://{echo $_SERVER[HTTP_HOST]}/socauth/facebook&response_type=code" 
       title="FaceBook">
        Зайти через FaceBook
    </a><br>
{/if}

{if $useYandex == 'on'}
    <a href="https://oauth.yandex.ru/authorize?response_type=code&client_id={$yandexClientID}" 
       title="Яндекс">
        Войти через Яндекс
    </a><br>
{/if}