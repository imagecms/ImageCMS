<script type="text/javascript">
    {$settings = $CI->cms_admin->get_settings();}
    var textEditor = '{$settings.text_editor}';

    {if $CI->dx_auth->is_logged_in()}
    var userLogined = true;
    {else:}
    var userLogined = false;
    {/if}

    var locale = '{echo $this->CI->config->item('language')}';

    {if $CI->uri->segment('4') == 'shop'}
    var isShop = true;
    {else:}
    var isShop = false;
    {/if}

    {if MAINSITE}
    var MAINSITE = true;
    {else:}
    var MAINSITE = false;
    {/if}

    var lang_only_number = "{lang("numbers only","admin")}";
    var show_tovar_text = "{lang("show","admin")}";
    var hide_tovar_text = "{lang("don't show", 'admin')}";

    base_url = '{$BASE_URL}';
    theme_url = '{$THEME}';

    var elfToken = '{echo $CI->lib_csrf->get_token()}';

    {literal}
    window.CMS_JS = {
        server_settings: {
            {/literal}
            max_file_uploads: {ini_get('max_file_uploads')},
            {literal}
        }
    };
    {/literal}
</script>

